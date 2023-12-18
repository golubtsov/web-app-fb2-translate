<?php

namespace App\Console\Commands\Traits;

trait ClearTranslationsAndZipsFoldersInStorageTrait
{
    private function clearTranslationsAndZipsFoldersInStorage(): void
    {
        exec('rm -rfv ' . storage_path() . '/app/public/translations/*');
        exec('rm -rfv ' . storage_path() . '/app/public/zips/*');
    }
}
