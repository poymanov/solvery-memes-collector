<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @mixin IdeHelperVkParsingSource
 */
class VkParsingSource extends Model
{
    use HasFactory;
    use SoftDeletes;
}
