<?php
namespace App\Http\Controllers;

use App\Services\EmailTemplateService;
use App\Http\Requests\EmailTemplateRequestHandler;
use Illuminate\Http\Request;

/**
 * Controller for managing email templates
 * Uses service pattern for business logic
 */
class EmailTemplateController extends Controller
{
    /** @var EmailTemplateService */
    protected $emailTemplateService;
    
    /** @var EmailTemplateRequestHandler */
    protected $requestHandler;

    /**
     * Initialize controller with required dependencies
     * @param EmailTemplateService $emailTemplateService Service for email template operations
     * @param EmailTemplateRequestHandler $requestHandler Handler for validating template requests
     */
    public function __construct(EmailTemplateService $emailTemplateService, EmailTemplateRequestHandler $requestHandler)
    {
        $this->emailTemplateService = $emailTemplateService;
        $this->requestHandler = $requestHandler;
    }

    /**
     * Display list of email templates
     * @return \Illuminate\View\View
     */
    public function index()
    {
        try {
            // Fetch all email templates from service
            $email_templates = $this->emailTemplateService->getAllEmailTemplates();
            return view('emails.email-template', compact('email_templates'));
        } catch (\Exception $e) {
            // Return to previous page if error occurs
            return back();
        }
    }

    /**
     * Save or update an email template
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function save(Request $request)
    {
        try {
            // Validate and sanitize the request data
            $data = $this->requestHandler->validateSaveRequest($request);
            
            // Attempt to save the template
            $emailTemplate = $this->emailTemplateService->saveTemplate($data);

            // Return with appropriate success/error message
            return back()->with(
                $emailTemplate ? 'success' : 'error', 
                $emailTemplate ? __('Email template saved!') : __('Email template save failed!')
            );
        } catch (\Exception $e) {
            return back();
        }
    }

    /**
     * Get formatted template text by template type
     * @param string $type Template type identifier
     * @param mixed $data Optional data for template formatting
     * @return mixed Formatted template text or redirect response
     */
    public function getFormattedTextByType($type, $data = null)
    {
        try {
            // Retrieve and format template text based on type
            return $this->emailTemplateService->getFormattedTextByType($type, $data);
        } catch (\Exception $e) {
            return back();
        }
    }
}
