<?php

namespace App\Http\Resources\Book;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class BookDescriptionResource extends JsonResource
{
    private string $description;

    public static $wrap = '';

    public function __construct(string $description)
    {
        $this->description = $description;
    }

    public function toArray(Request $request): array
    {
        return [
            'description' => $this->description,
        ];
    }
}
