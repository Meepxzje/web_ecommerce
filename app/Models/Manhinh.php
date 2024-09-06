<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Manhinh extends Model
{
    use HasFactory;
    protected $table = 'manhinhs';
    protected $fillable = ['ten'];
}
