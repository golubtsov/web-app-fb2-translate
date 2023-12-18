<?php

namespace App\View\Components\Book;

use App\Models\Book;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Query\Builder;
use Illuminate\View\Component;

class Card extends Component
{
    public Book|Builder $book;

    public function __construct(Book|Builder $book)
    {
        $this->book = $book;
    }

    public function render(): View|Closure|string
    {
        return view('components.book.card');
    }
}
