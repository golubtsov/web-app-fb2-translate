<?php

namespace App\View\Components\Titles;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class MainTitle extends Component
{
    public string $title;

    public function __construct(string $title = '')
    {
        $this->title = $title;
    }

    public function render(): View|Closure|string
    {
        return view('components.titles.main-title');
    }
}
