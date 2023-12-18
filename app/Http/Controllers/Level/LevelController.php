<?php

namespace App\Http\Controllers\Level;

use App\Http\Controllers\Controller;
use App\Models\Level;
use Illuminate\Http\Request;
use Illuminate\View\View;

class LevelController extends Controller
{
    public function index(): view
    {
        return view('levels.main')->with([
            'levels' => Level::all(),
        ]);
    }
}
