<?php

namespace Modules\EmailTemplate\App\Services;

use Modules\EmailTemplate\App\Models\EmailTemplate;

class EmailTemplateService
{
    /**
     * Get all email templates
     */
    public function getAllEmailTemplates()
    {
        return EmailTemplate::all();
    }

    /**
     * Save or update an email template
     */
    public function saveTemplate($data)
    {
        $emailTemplate = !empty($data['id']) ? EmailTemplate::find($data['id']) : null;
        
        if ($emailTemplate) {
            $emailTemplate->update($data);
        } else {
            $emailTemplate = EmailTemplate::create($data);
        }

        return $emailTemplate;
    }

    /**
     * Get formatted text by type
     */
    public function getFormattedTextByType($type, $data = null)
    {
        return EmailTemplate::getFormattedTextByType($type, $data);
    }
} 