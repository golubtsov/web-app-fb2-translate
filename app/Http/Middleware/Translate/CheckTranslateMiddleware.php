<?php

namespace App\Http\Middleware\Translate;

use App\Models\Translate;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckTranslateMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {
        $id = (int)array_reverse(explode('/', $request->getUri()))[1];

        $book = Translate::query()
            ->find($id);

        if (!is_null($book)) {
            return $next($request);
        }

        return redirect()->route('main');
    }
}
