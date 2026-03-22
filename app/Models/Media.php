<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Media extends Model
{
    protected $table = 'media';

    protected $fillable = [
        'page_id',
        'group',
        'key',
        'disk',
        'path',
        'is_external',
        'alt_text',
        'caption',
        'category',
        'sort_order',
    ];

    protected function casts(): array
    {
        return [
            'is_external' => 'boolean',
        ];
    }

    protected $appends = ['url'];

    public function page(): BelongsTo
    {
        return $this->belongsTo(Page::class);
    }

    public function getUrlAttribute(): string
    {
        if ($this->is_external) {
            return $this->path;
        }

        return Storage::disk($this->disk ?: 'public')->url($this->path);
    }
}
