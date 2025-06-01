<?php

namespace Modules\EmailTemplate\App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\EmailTemplate\App\Models\EmailTemplate;
use Modules\EmailTemplate\App\Services\EmailTemplateService;
use Modules\EmailTemplate\App\Http\Requests\EmailTemplateRequest;

class EmailTemplateController extends Controller
{
    protected $emailTemplateService;

    public function __construct(EmailTemplateService $emailTemplateService)
    {
        $this->emailTemplateService = $emailTemplateService;
    }

    /**
     * Display a listing of email templates
     */
    public function index()
    {
        $email_templates = $this->emailTemplateService->getAllEmailTemplates();
        return view('emailtemplate::index', compact('email_templates'));
    }

    /**
     * Save or update an email template
     */
    public function save(Request $request)
    {
        try {
            $data = $request->validate([
                'id' => 'nullable|exists:email_templates,id',
                'name' => 'required|string|max:255',
                'type' => 'required|string|max:255',
                'subject' => 'required|string',
                'message' => 'required|string',
            ]);

            $emailTemplate = $this->emailTemplateService->saveTemplate($data);

            return back()->with(
                $emailTemplate ? 'success' : 'error',
                $emailTemplate ? __('Email template saved!') : __('Email template save failed!')
            );
        } catch (\Exception $e) {
            return back()->with('error', $e->getMessage());
        }
    }

    /**
     * Get formatted template text by type
     */
    public function getFormattedTextByType($type, $data = null)
    {
        try {
            return $this->emailTemplateService->getFormattedTextByType($type, $data);
        } catch (\Exception $e) {
            return back()->with('error', $e->getMessage());
        }
    }
}
