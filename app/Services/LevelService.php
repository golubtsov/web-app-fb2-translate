<?php

namespace App\Services;

use Illuminate\Http\Request;

class LevelService
{
    public static function getLevelInNormalFormat(Request $request): string
    {
        $urlElems = explode('/', $request->url());

        $level = array_reverse($urlElems)[1];

        $levelElems = explode('-', $level);

        $levelElems[0] = strtoupper($levelElems[0]);

        return implode(' ', $levelElems);
    }

    public static function getLevelWithoutFirstLetter(Request $request): string
    {
        $levelFromUri = array_reverse(explode('/', $request->path()))[1];

        $arrLevelFromUri = explode('-', $levelFromUri);

        array_shift($arrLevelFromUri);

        return implode('-', $arrLevelFromUri);
    }
}
