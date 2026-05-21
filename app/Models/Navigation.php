<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Model;

#[Fillable(['name', 'route', 'position', 'page_id'])]
class Navigation extends Model
{
    public function page(): BelongsTo {
        return $this->belongsTo(Page::class);
    }

    public function categories(): Navigation|HasMany {
        return $this->hasMany(Category::class)->orderBy('position');
    }
}
