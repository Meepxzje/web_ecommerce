<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dophangiai extends Model
{
    use HasFactory;
    protected $table = 'dophangiais';
    protected $fillable = ['ten'];
}
