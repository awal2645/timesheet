<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Smtp extends Model
{
    use HasFactory;

    protected $fillable = ['host', 'port', 'username', 'password', 'encryption', 'mail_from_name', 'mail_from_address', 'created_by'];
}
