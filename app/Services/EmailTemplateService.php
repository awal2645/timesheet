<?php

namespace App\Services;

use App\Models\EmailTemplate;

class EmailTemplateService
{
    public function getAllEmailTemplates()
    {
        return EmailTemplate::all();
    }

    public function saveTemplate($data)
    {
        $emailTemplate = !empty($data['id']) ? EmailTemplate::find($data['id']) : null;
        
        if ($emailTemplate) {
            $emailTemplate->update($data);
        } else {
            $data['type'] = $data['type'] ?? '';
            $emailTemplate = EmailTemplate::create($data);
        }

        return $emailTemplate;
    }

    public function getFormattedTextByType($type, $data = null)
    {
        $typeData = $this->getDataByType($type, $data);
        $formatter = $this->getFormatterByType($type, $typeData);
        $emailTemplate = EmailTemplate::where('type', $type)->first();

        return [
            'subject' => $this->replacePlaceholders($emailTemplate->subject ?? '', $formatter),
            'message' => $this->replacePlaceholders($emailTemplate->message ?? '', $formatter),
        ];
    }

    private function replacePlaceholders($text, $formatter)
    {
        return html_entity_decode(str_replace($formatter['search'], $formatter['replace'], $text));
    }

    private function getDataByType($type, $data = null)
    {
        $returnData = [];

        if (in_array($type, [
            'new_edited_job_available',
            'new_job_available',
            'new_plan_purchase',
            'new_user_registered',
            'plan_purchase',
            'new_pending_candidate',
            'new_candidate',
            'new_company_pending',
            'new_company',
            'update_company_pass',
            'verify_subscription_notification'
        ])) {
            $returnData = $data;
        }

        return $returnData;
    }

    private function getFormatterByType($type, $data = null)
    {
        $format = [];

        switch ($type) {
            case 'new_edited_job_available':
            case 'new_job_available':
                $format['search'] = ['{admin_name}'];
                $format['replace'] = [$data['admin_name'] ?? ''];
                break;
            case 'new_plan_purchase':
                $format['search'] = ['{admin_name}', '{user_name}', '{plan_label}'];
                $format['replace'] = [$data['admin_name'] ?? '', $data['user_name'] ?? '', $data['plan_label'] ?? ''];
                break;
            case 'new_user_registered':
                $format['search'] = ['{admin_name}', '{user_role}'];
                $format['replace'] = [$data['admin_name'] ?? '', $data['user_role'] ?? ''];
                break;
            case 'plan_purchase':
                $format['search'] = ['{user_name}', '{plan_type}'];
                $format['replace'] = [$data['user_name'] ?? '', $data['plan_type'] ?? ''];
                break;
            case 'new_pending_candidate':
            case 'new_candidate':
            case 'new_company_pending':
            case 'new_company':
                $format['search'] = ['{user_name}', '{user_email}', '{user_password}'];
                $format['replace'] = [$data['user_name'] ?? '', $data['user_email'] ?? '', $data['user_password'] ?? ''];
                break;
            case 'update_company_pass':
                $format['search'] = ['{user_name}', '{user_email}', '{password}', '{account_type}'];
                $format['replace'] = [$data['user_name'] ?? '', $data['user_email'] ?? '', $data['password'] ?? '', $data['account_type'] ?? ''];
                break;
            case 'verify_subscription_notification':
                $format['search'] = ['{verify_subscription}'];
                $format['replace'] = [$data['verify_subscription'] ?? ''];
                break;
        }

        return $format;
    }
}
