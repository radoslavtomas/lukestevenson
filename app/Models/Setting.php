<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;

#[Fillable(['page_title', 'page_subtitle', 'page_description', 'page_keywords', 'address_line1', 'address_line2', 'address_line3', 'postcode', 'phone', 'email', 'map'])]
class Setting extends Model
{
}
