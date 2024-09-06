<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Danhmuc extends Model
{
    use HasFactory;

    protected $table = 'danhmuc';

    protected $fillable = ['ten','parentid'];

    public function sanphams()
    {
        return $this->hasMany(Sanpham::class, 'danhmucid');
    }

    // Quan hệ với danh mục con
    public function subcategories()
    {
        return $this->hasMany(Danhmuc::class, 'parentid');
    }

    // Quan hệ với danh mục cha
    public function parent()
    {
        return $this->belongsTo(Danhmuc::class, 'parentid');
    }

    // Lấy tất cả các danh mục con
    public function allSubcategories()
    {
        return $this->subcategories()->with('allSubcategories');
    }

}
