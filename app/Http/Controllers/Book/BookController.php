<?php

namespace App\Http\Controllers\Book;

use App\Http\Controllers\Controller;
use App\Http\Resources\Book\BookDescriptionResource;
use App\Http\Resources\Translate\IdTranslateResource;
use App\Services\BookService;
use App\Services\LevelService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class BookController extends Controller
{
    public function index(Request $request): view
    {
        return view('books.main')->with([
            'level' => strtoupper(explode('/', $request->path())[0]),
            'books' => BookService::getBooksByLevel(LevelService::getLevelWithoutFirstLetter($request)),
        ]);
    }

    public function getBookDescription(int $id): JsonResponse
    {
        $description = BookService::getBookDescription($id);

        return (new BookDescriptionResource($description))->response();
    }

    public function translate(int $id): JsonResponse
    {
        $translate = BookService::translate($id);

        if ($translate !== false) {
            return (new IdTranslateResource($translate))->response();
        }

        return response()->json([
            'message' => __('main.errors.not_translate'),
        ], 500);
    }
}
