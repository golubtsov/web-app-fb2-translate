<?php

namespace App\Console\Commands;

use App\Console\Commands\Traits\ClearTranslationsAndZipsFoldersInStorageTrait;
use App\Models\Book;
use App\Models\Level;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use simplehtmldom\HtmlWeb;
use stdClass;

class LoadBooks extends Command
{
    use ClearTranslationsAndZipsFoldersInStorageTrait;

    private string $siteUri = 'https://english-e-reader.net';
    protected $signature = 'app:load-books';

    protected $description = 'Команда скачивает данные о книгах с этого сайта https://english-e-reader.net';

    public function handle(): void
    {
        $this->clearTranslationsAndZipsFoldersInStorage();
        $this->loadLanguageLevels();
        $this->loadBooks();
    }

    private function loadLanguageLevels(): void
    {
        $this->info('Заполнение языковых уровней ...');

        $html = (new HtmlWeb())->load($this->siteUri);

        $levelLinks = $html->find('.dropdown-menu li a');

        foreach ($levelLinks as $levelLink) {

            if (str_contains($levelLink->attr['href'], '/level/')) {
                try {
                    DB::beginTransaction();

                    Level::query()->create([
                        'url' => $levelLink->attr['href'],
                        'name' => $levelLink->plaintext,
                    ]);

                    DB::commit();
                } catch (\Exception $exception) {
                    DB::rollBack();
                    $this->error($exception->getMessage());
                    exit();
                }
            }
        }

        $this->info('Языковые уровни заполнены');
    }
    private function loadBooks(): void
    {
        $this->info('Заполнение книг');

        $levels = Level::all();

        foreach ($levels as $level) {
            $this->info($level->name);

            $siteUriLevel = $this->siteUri . $level->url;

            $html = (new HtmlWeb())->load($siteUriLevel);

            $links = $html->find('div.book-container a');
            $titles = $html->find('div.book-container h4');
            $authors = $html->find('div.book-container .cover');

            foreach ($links as $index => $link) {

                $this->warn($link->attr['href']);

                try {
                    DB::beginTransaction();

                    Book::query()->create([
                        'title' => $titles[$index]->_[5],
                        'author' => $authors[$index]->_[5],
                        'link' => $link->attr['href'],
                        'level_id' => $level->id,
                    ]);

                    DB::commit();
                } catch (\Exception $exception) {
                    DB::rollBack();
                    $this->error($exception->getMessage());
                    exit();
                }
            }
        }

        $this->info('Книги загружены');
    }
}
