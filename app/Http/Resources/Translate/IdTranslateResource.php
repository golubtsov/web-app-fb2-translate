<?php

namespace App\Http\Resources\Translate;

use App\Models\Translate;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Query\Builder;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class IdTranslateResource extends JsonResource
{
    private Translate|Model|Builder $translate;

    public static $wrap = '';

    public function __construct(int $id)
    {
        $this->translate = Translate::query()->find($id);
    }

    public function toArray(Request $request): array
    {
        return [
            'id' => $this->translate->id,
            'name' => $this->translate->zip_name,
        ];
    }
}
