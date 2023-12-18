<?php

namespace App\Http\Middleware\Level;

use App\Models\Level;
use App\Services\LevelService;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckLevelMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {
        $levelFromUri = array_reverse(explode('/', $request->path()))[1];

        $arrLevelFromUri = explode('-', $levelFromUri);

        array_shift($arrLevelFromUri);

        return is_null(Level::query()->where('url', '/level/' . implode('-', $arrLevelFromUri))->first())
            ? redirect()->route('main')
            : $next($request);
    }
}
