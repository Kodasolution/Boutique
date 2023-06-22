<?php

namespace App\Models;

use App\Models\Size;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ProductSize extends Model
{
    use HasFactory;
    protected $guarded=[];
/**
 * Get all of the comments for the ProductSize
 *
 * @return \Illuminate\Database\Eloquent\Relations\HasMany
 */
// public function sizePro()
// {
//     return $this->hasMany(ProductSize::class,'size_id','id');
// }
}
