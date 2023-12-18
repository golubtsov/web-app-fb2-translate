<?php

namespace App\Http\Middleware\Translate;

use App\Models\Book;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckTranslateOfBookMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {
        $id = (int)array_reverse(explode('/', $request->getUri()))[1];

        $book = Book::query()
            ->with('translate')
            ->find($id);

        if (!is_null($book) && is_null($book->translate)) {
            return $next($request);
        }

        return response()->json([
            'message' => __('main.errors.have_translate'),
        ]);
    }
}
