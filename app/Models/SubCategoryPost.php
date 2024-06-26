<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubCategoryPost extends Model
{
    use HasFactory;
    protected $fillable = ['sub_category_id', 'post_id', 'category_id'];

    public function rCategory()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    public function rSubCategory()
    {
        return $this->belongsTo(SubCategory::class, 'sub_category_id');
    }
}
