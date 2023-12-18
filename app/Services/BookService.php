<?php

namespace App\Services;

use App\Models\Book;
use App\Models\Level;
use App\Models\Translate;
use App\Translator\Translator;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Http;
use RecursiveDirectoryIterator;
use RecursiveIteratorIterator;
use simplehtmldom\HtmlWeb;
use Nigo\Translator\Document\Fb2ParallelDocumentGenerator;
use ZipArchive;

class BookService
{
    private static string $siteUrl = 'https://english-e-reader.net';

    public static function getBooksByLevel(string $levelName): Collection
    {
        $levelName = '/level/' . $levelName;

        $level = Level::query()
            ->where('url', $levelName)
            ->first();

        return $level->books()->with('translate')->get();
    }

    public static function getBookDescription(int $id): string
    {
        $book = Book::query()->find($id);

        $url = self::$siteUrl . $book->link;

        $html = (new HtmlWeb())->load($url);

        return $html->find('.book .row .row .text-justify')[0]->plaintext;
    }

    public static function translate(int $id): int|false
    {
        $book = Book::query()->find($id);

        $arrBookLink = explode('/', $book->link);

        $downloadLinkForBookTxt = self::$siteUrl . '/download?link=' . end($arrBookLink) . '&format=txt';

        $downloadLinkForBookFb2 = self::$siteUrl . '/download?link=' . end($arrBookLink) . '&format=fb2';

        $bookTextTxt = Http::get($downloadLinkForBookTxt)->body();

        $bookTextFb2 = Http::get($downloadLinkForBookFb2)->body();

        $savePathFolder = storage_path() . '/app/public/translations/' . $book->title;

        mkdir($savePathFolder);

        $generator = new Fb2ParallelDocumentGenerator('ru', $savePathFolder);

        file_put_contents($savePathFolder . '/' . $book->title . '.fb2', $bookTextFb2);

        $generator->setNewTranslator((new Translator()));

        if ($generator->generate($bookTextTxt, $book->title)) {

            $zipArchive = self::createZipArchive($savePathFolder, $book->title);

            if ($zipArchive !== false) {
                $translate = Translate::query()->create([
                    'book_id' => $book->id,
                    'zip_name' => $zipArchive,
                ]);

                return $translate->id;
            }
        }

        return false;
    }

    public static function createZipArchive(string $pathToFolder, string $filename): string|false
    {
        $zip = new ZipArchive();

        $zipPath = storage_path() . '/app/public/zips/' . $filename . '.zip';

        if ($zip->open($zipPath, ZipArchive::CREATE) === TRUE) {
            $folder = $pathToFolder;

            $files = new RecursiveIteratorIterator(new RecursiveDirectoryIterator($folder));

            foreach ($files as $file) {
                $filePath = $file->getRealPath();
                $relativePath = substr($filePath, strlen($folder) + 1);

                if (!$file->isDir()) {
                    $zip->addFile($filePath, $relativePath);
                }
            }

            $zip->close();

            return $filename . '.zip';
        } else {
            return false;
        }
    }
}
