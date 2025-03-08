<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Support\Str;

class Flashcard extends Model
{
    use HasFactory, HasUuids;

    protected $keyType = 'string';
    public $incrementing = false;

    protected $fillable = [
        'text',
        'imgUrl',
        'description',
        'language',
        'isMarked',
        'deckId',
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            if (empty($model->id)) { // Nếu chưa có id, tạo UUID mới
                $model->id = (string) Str::uuid();
            }
        });
    }

    public function deck()
    {
        return $this->belongsTo(Deck::class, 'deckId');
    }
}
