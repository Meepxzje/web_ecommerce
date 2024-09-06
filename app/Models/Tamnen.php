<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tamnen extends Model
{
    use HasFactory;
    protected $table = 'tamnens';
    protected $fillable = ['ten'];
}
