<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

#[Fillable(['page_id', 'navigation_id', 'is_dynamic', 'name', 'url', 'position'])]
class Category extends Model
{
    public function navigation(): BelongsTo
    {
        return $this->belongsTo(Navigation::class, 'navigation_id', 'id');
    }

    public function page(): BelongsTo
    {
        return $this->belongsTo(Page::class, 'page_id', 'id');
    }
}
