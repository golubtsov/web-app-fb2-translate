<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property int $id
 * @property int $book_id
 * @property string $zip_name
 * @property Carbon $created_at
 */
class Translate extends Model
{
    use HasFactory;

    protected $fillable = [
        'book_id',
        'zip_name',
    ];

    public function book(): BelongsTo
    {
        return $this->belongsTo(Book::class);
    }
}
