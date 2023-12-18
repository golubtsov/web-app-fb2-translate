<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

/**
 * @property int $id
 * @property string $title
 * @property string $link
 * @property string $author
 * @property Carbon $created_at
 * @property HasOne $level
 * @property HasOne $translate
 */
class Book extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'link',
        'author',
        'level_id',
    ];

    public function level(): HasOne
    {
        return $this->hasOne(Level::class);
    }

    public function translate(): HasOne
    {
        return $this->hasOne(Translate::class);
    }
}
