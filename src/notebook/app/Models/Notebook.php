<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Casts;

class Notebook extends Model
{
    use HasFactory;

    protected $fillable = [
        'full_name',
        'company',
        'phone',
        'email',
        'date_of_birth',
        'photo'
    ];

    protected $casts = [
        'date_of_birth' => 'date',
        'email' => Casts\Email::class,
        'phone' => Casts\Phone::class,
        'photo' => Casts\Image::class,
    ];
}
