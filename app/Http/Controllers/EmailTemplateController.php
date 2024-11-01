<?php
namespace App\Http\Controllers;

use App\Services\EmailTemplateService;
use App\Http\Requests\EmailTemplateRequestHandler;
use Illuminate\Http\Request;

class EmailTemplateController extends Controller
{
    protected $emailTemplateService;
    protected $requestHandler;

    public function __construct(EmailTemplateService $emailTemplateService, EmailTemplateRequestHandler $requestHandler)
    {
        $this->emailTemplateService = $emailTemplateService;
        $this->requestHandler = $requestHandler;
    }

    public function index()
    {
        try {
            $email_templates = $this->emailTemplateService->getAllEmailTemplates();
            return view('emails.email-template', compact('email_templates'));
        } catch (\Exception $e) {
            return back();
        }
    }

    public function save(Request $request)
    {
        try {
            $data = $this->requestHandler->validateSaveRequest($request);
            $emailTemplate = $this->emailTemplateService->saveTemplate($data);

            return back()->with(
                $emailTemplate ? 'success' : 'error', 
                $emailTemplate ? __('Email template saved!') : __('Email template save failed!')
            );
        } catch (\Exception $e) {
            return back();
        }
    }

    public function getFormattedTextByType($type, $data = null)
    {
        try {
            return $this->emailTemplateService->getFormattedTextByType($type, $data);
        } catch (\Exception $e) {
            return back();
        }
    }
}
