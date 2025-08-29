<?php

namespace Modules\EmailReminders\App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\EmailReminders\Database\factories\ReminderTemplateFactory;

class ReminderTemplate extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [];
    
    protected static function newFactory(): ReminderTemplateFactory
    {
        //return ReminderTemplateFactory::new();
    }
}
