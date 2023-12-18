<?php

namespace App\Http\Controllers\Translate;

use App\Http\Controllers\Controller;
use App\Models\Translate;
use Illuminate\Http\Request;

class TranslateController extends Controller
{
    public function download(int $id)
    {
        $translate = Translate::query()->find($id);

        return response()->download(storage_path() . '/app/public/zips/' . $translate->zip_name);
    }
}
