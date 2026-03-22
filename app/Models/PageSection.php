<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Model;

class PageSection extends Model
{
    protected $fillable = [
        'page_id',
        'section_name',
        'field_name',
        'field_value',
    ];

    public function page(): BelongsTo
    {
        return $this->belongsTo(Page::class);
    }
}
