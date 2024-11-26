<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cms extends Model
{
    use HasFactory;

    protected $fillable = [
        'banner_image',
        'approach_image',
        'client_image1',
        'client_image2',
        'client_image3',
        'client_image4',
        'client_image5',
    ];
}
