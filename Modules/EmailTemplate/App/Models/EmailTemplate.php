<?php

namespace Modules\EmailTemplate\App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmailTemplate extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'type',
        'subject',
        'message',
    ];

    /**
     * Get the formatted text for a specific type
     *
     * @param string $type
     * @param array $data
     * @return array
     */
    public static function getFormattedTextByType($type, $data = [])
    {
        $template = self::where('type', $type)->first();
        
        if (!$template) {
            return [
                'subject' => '',
                'message' => ''
            ];
        }

        $subject = $template->subject;
        $message = $template->message;

        // Replace placeholders in subject and message
        foreach ($data as $key => $value) {
            $subject = str_replace('{' . $key . '}', $value, $subject);
            $message = str_replace('{' . $key . '}', $value, $message);
        }

        return [
            'subject' => $subject,
            'message' => $message
        ];
    }
} 