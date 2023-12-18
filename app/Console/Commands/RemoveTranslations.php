<?php

namespace App\Console\Commands;

use App\Console\Commands\Traits\ClearTranslationsAndZipsFoldersInStorageTrait;
use Illuminate\Console\Command;

class RemoveTranslations extends Command
{
    use ClearTranslationsAndZipsFoldersInStorageTrait;

    protected $signature = 'app:clear-translations';

    protected $description = 'Команда очищает переводы и zip-архивы в папке ./storage/app/public/*';

    public function handle(): void
    {
        $this->clearTranslationsAndZipsFoldersInStorage();
    }
}
