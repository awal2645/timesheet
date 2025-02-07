<?php

namespace Database\Seeders;

use App\Models\EmailTemplate;
use Illuminate\Database\Seeder;

class EmailTemplateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Fetch the app name
        $appName = config('app.name');

        $email_templates = [
            [
                'name' => 'New Plan Purchased',
                'type' => 'new_plan_purchase',
                'subject' => 'Congratulations on Your New Plan! 🎉',
                'message' => "<div style='box-sizing:border-box;font-family:Arial,sans-serif;font-size:16px;text-align:center;background-color:#f4f6ff;color:#000;margin:0;padding:20px;width:100%;'>
                    <div style='background:#fff;color:#2c1d66;font-family:Arial,sans-serif;font-size:16px;text-align:left;max-width:680px;margin:0 auto 20px;border:1px solid #e5e4e6;border-radius:10px;padding:20px;'>
                    <h1 style='color:#0b4dc4;'>New Plan Purchased</h1>
                    <p><strong>{user_name}</strong> has successfully purchased the <strong>{plan_label}</strong> plan!</p>
                    <p>Thank you for your purchase!</p>
                    <p>If you have any questions, feel free to contact our support team at <a href='mailto:support@zenxservices.com' style='color:#2c1d66;'>support@zenxservices.com</a>.</p>
                    <p>We appreciate your choice to partner with Zenxserv Technologies. We look forward to serving you!</p>
                    </div>
                    <small style='font-size:12px;color:#2c1d66;'>© " . date('Y') . " $appName. All rights reserved.</small>
                    </div>",
            ],
            [
                'name' => 'Employer Invite Notification',
                'type' => 'employer_invite',
                'subject' => 'Verify Your Email Address',
                'message' => "<div style='box-sizing:border-box;font-family:Arial,sans-serif;font-size:16px;text-align:center;background-color:#f4f6ff;color:#000;margin:0;padding:20px;width:100%;'>
                    <div style='background:#fff;color:#2c1d66;font-family:Arial,sans-serif;font-size:16px;text-align:left;max-width:680px;margin:0 auto 20px;border:1px solid #e5e4e6;border-radius:10px;padding:20px;'>
                    <h1 style='color:#0b4dc4;'>Welcome to {app_name}</h1>
                    <p>Thank you for your invitation.</p>
                    <p>To access all of our innovative features and services, please verify your email address.</p>
                    <p><a href='{verify_link}' style='background-color:#1fa8f8;color:#fff;font-size:14px;padding:15px 20px;border-radius:5px;text-decoration:none;display:inline-block;'>Verify Now</a></p>
                    <p>Once your email is verified, you'll be ready to explore everything Zenxserv Technologies has to offer.</p>
                    <p>If you need assistance or have any questions, don't hesitate to reach out to our support team at <a href='mailto:support@zenxservices.com' style='color:#2c1d66;'>support@zenxservices.com</a>.</p>
                    <p>We are excited to have you onboard!</p>
                    </div>
                    <small style='font-size:12px;color:#2c1d66;'>© {year} Zenxserv Technologies Pvt Ltd. All rights reserved.</small>
                    </div>",
            ],
            [
                'name' => 'Employee Invite Notification',
                'type' => 'employee_invite',
                'subject' => 'Verify Your Email Address',
                'message' => "<div style='box-sizing:border-box;font-family:Arial,sans-serif;font-size:16px;text-align:center;background-color:#f4f6ff;color:#000;margin:0;padding:20px;width:100%;'>
                    <div style='background:#fff;color:#2c1d66;font-family:Arial,sans-serif;font-size:16px;text-align:left;max-width:680px;margin:0 auto 20px;border:1px solid #e5e4e6;border-radius:10px;padding:20px;'>
                    <h1 style='color:#0b4dc4;'>Welcome to {app_name}</h1>
                    <p>Thank you for your invitation.</p>
                    <p>To unlock access to all our innovative features, kindly verify your email address.</p>
                    <p><a href='{verify_link}' style='background-color:#1fa8f8;color:#fff;font-size:14px;padding:15px 20px;border-radius:5px;text-decoration:none;display:inline-block;'>Verify Now</a></p>
                    <p>Once verified, you will be able to explore everything Zenxserv Technologies has to offer.</p>
                    <p>If you need any help, feel free to contact our support team at <a href='mailto:support@zenxservices.com' style='color:#2c1d66;'>support@zenxservices.com</a>.</p>
                    <p>We are thrilled to have you with us!</p>
                    </div>
                    <small style='font-size:12px;color:#2c1d66;'>© {year} Zenxserv Technologies Pvt Ltd. All rights reserved.</small>
                    </div>",
            ],
            [
                'name' => 'Client Invite Notification',
                'type' => 'client_invite',
                'subject' => 'Verify Your Email Address',
                'message' => "<div style='box-sizing:border-box;font-family:Arial,sans-serif;font-size:16px;text-align:center;background-color:#f4f6ff;color:#000;margin:0;padding:20px;width:100%;'>
                    <div style='background:#fff;color:#2c1d66;font-family:Arial,sans-serif;font-size:16px;text-align:left;max-width:680px;margin:0 auto 20px;border:1px solid #e5e4e6;border-radius:10px;padding:20px;'>
                    <h1 style='color:#0b4dc4;'>Welcome to {app_name}</h1>
                    <p>Thank you for your invitation.</p>
                    <p>To begin using our innovative services, please verify your email address.</p>
                    <p><a href='{verify_link}' style='background-color:#1fa8f8;color:#fff;font-size:14px;padding:15px 20px;border-radius:5px;text-decoration:none;display:inline-block;'>Verify Now</a></p>
                    <p>Once your email is verified, you'll have full access to all Zenxserv Technologies services.</p>
                    <p>If you have any questions, don't hesitate to reach out to our support team at <a href='mailto:support@zenxservices.com' style='color:#2c1d66;'>support@zenxservices.com</a>.</p>
                    <p>We look forward to working with you!</p>
                    </div>
                    <small style='font-size:12px;color:#2c1d66;'>© {year} Zenxserv Technologies Pvt Ltd. All rights reserved.</small>
                    </div>",
            ],
            [
                'name' => 'Timesheet Update Notification',
                'type' => 'timesheet_update',
                'subject' => 'Your Timesheet Has Been Updated',
                'message' => "<div style='box-sizing:border-box;font-family:Arial,sans-serif;font-size:16px;text-align:center;background-color:#f4f6ff;color:#000;margin:0;padding:20px;width:100%;'>
                    <div style='background:#fff;color:#2c1d66;font-family:Arial,sans-serif;font-size:16px;text-align:left;max-width:680px;margin:0 auto;border:1px solid #e5e4e6;border-radius:10px;padding:20px;'>
                        <h1 style='color:#0b4dc4;'>Timesheet Updated</h1>
                        <p>Your timesheet has been updated successfully.</p>
                        <a href='{link}' style='background-color:#007bff;color:#fff;padding:10px 20px;border-radius:5px;text-decoration:none;display:inline-block;'>View Timesheet</a> <br> <br>
                        <p>If you have any questions, please don't hesitate to contact our support team.</p>
                    </div>
                    <div style='text-align:center;margin-top:20px;'>
                        <small style='font-size:12px;color:#2c1d66;'>© {year} Zenxserv Technologies Pvt Ltd. All rights reserved.</small>
                    </div>
                </div>",
            ],
            [
                'name' => 'Timesheet Submission',
                'type' => 'timesheet_submission',
                'subject' => 'New Timesheet Submission',
                'message' => "<div style='box-sizing:border-box;font-family:Helvetica,Arial,sans-serif;font-size:16px;text-align:center;background-color:#edf2f7;color:#000;margin:0;padding:20px;width:100%;'>
                    <div style='background:#fff;color:#718096;font-family:Helvetica,Arial,sans-serif;font-size:16px;text-align:left;max-width:600px;margin:0 auto 20px;border:1px solid #e5e4e6;border-radius:10px;padding:20px;'>
                    <h1 style='color:#0b4dc4;'>New Timesheet Submission</h1>
                        Your Employee <strong>{name}</strong> has submitted a timesheet.<br><br>
                        Please review the timesheet and take appropriate action.<br><br>
                        <a id='approveBtn' href='{link}' style='background-color:#007bff;color:#fff;padding:10px 20px;border-radius:5px;text-decoration:none;display:inline-block;'>View Timesheet</a><br><br>
                        Best regards,<br><strong>{app_name}</strong></p>
                    </div>
                    <small>© {year} {app_name}. All rights reserved.</small>
                </div>",
            ],
            [
                'name' => 'Leave Application Submitted',
                'type' => 'leave_application_submitted',
                'subject' => 'Leave Application Submitted',
                'message' => "<div style='box-sizing:border-box;font-family:Arial,sans-serif;font-size:16px;text-align:center;background-color:#f4f6ff;color:#000;margin:0;padding:20px;width:100%;'>
                    <div style='background:#fff;color:#2c1d66;font-family:Arial,sans-serif;font-size:16px;text-align:left;max-width:680px;margin:0 auto 20px;border:1px solid #e5e4e6;border-radius:10px;padding:20px;'>
                    <h1 style='color:#0b4dc4;'>Leave Application Submitted</h1>
                    <p>Dear <strong>{user_name}</strong>,</p>
                    <p>Your leave application for the period from <strong>{start_date}</strong> to <strong>{end_date}</strong> has been successfully submitted.</p>
                    <p>Thank you for your application!</p>
                    <p>If you have any questions, please feel free to contact our support team at <a href='mailto:support@zenxservices.com' style='color:#2c1d66;'>support@zenxservices.com</a>.</p>
                    <p>Thank you for choosing Zenxserv Technologies. We look forward to serving you!</p>
                    </div>
                    <small style='font-size:12px;color:#2c1d66;'>© " . date('Y') . " $appName. All rights reserved.</small>
                    </div>",
            ],
            
            [
                'name' => 'Leave Application Approved',
                'type' => 'leave_application_approved',
                'subject' => 'Leave Application Approved',
                'message' => "<div style='box-sizing:border-box;font-family:Arial,sans-serif;font-size:16px;text-align:center;background-color:#f4f6ff;color:#000;margin:0;padding:20px;width:100%;'>
                    <div style='background:#fff;color:#2c1d66;font-family:Arial,sans-serif;font-size:16px;text-align:left;max-width:680px;margin:0 auto 20px;border:1px solid #e5e4e6;border-radius:10px;padding:20px;'>
                    <h1 style='color:#0b4dc4;'>Leave Application Approved</h1>
                    <p>Dear <strong>{user_name}</strong>,</p>
                    <p>We are pleased to inform you that your leave application for the period from <strong>{start_date}</strong> to <strong>{end_date}</strong> has been approved.</p>
                    <p>We hope you have a relaxing time off!</p>
                    <p>If you have any questions, feel free to contact our support team at <a href='mailto:support@zenxservices.com' style='color:#2c1d66;'>support@zenxservices.com</a>.</p>
                    <p>Thank you for choosing Zenxserv Technologies. We look forward to serving you!</p>
                    </div>
                    <small style='font-size:12px;color:#2c1d66;'>© " . date('Y') . " $appName. All rights reserved.</small>
                    </div>",
            ],
            
            [
                'name' => 'Leave Application Denied',
                'type' => 'leave_application_denied',
                'subject' => 'Leave Application Denied',
                'message' => "<div style='box-sizing:border-box;font-family:Arial,sans-serif;font-size:16px;text-align:center;background-color:#f4f6ff;color:#000;margin:0;padding:20px;width:100%;'>
                    <div style='background:#fff;color:#2c1d66;font-family:Arial,sans-serif;font-size:16px;text-align:left;max-width:680px;margin:0 auto 20px;border:1px solid #e5e4e6;border-radius:10px;padding:20px;'>
                    <h1 style='color:#0b4dc4;'>Leave Application Denied</h1>
                    <p>Dear <strong>{user_name}</strong>,</p>
                    <p>We regret to inform you that your leave application for the period from <strong>{start_date}</strong> to <strong>{end_date}</strong> has been denied.</p>
                    <p>If you have any questions or concerns, please feel free to contact our support team at <a href='mailto:support@zenxservices.com' style='color:#2c1d66;'>support@zenxservices.com</a>.</p>
                    <p>Thank you for your understanding. We look forward to serving you!</p>
                    </div>
                    <small style='font-size:12px;color:#2c1d66;'>© " . date('Y') . " $appName. All rights reserved.</small>
                    </div>",
            ],
            
            [
                'name' => 'New Meeting Alert',
                'type' => 'new_meeting_alert',
                'subject' => 'New Meeting Scheduled',
                'message' => "<div style='box-sizing:border-box;font-family:Arial,sans-serif;font-size:16px;text-align:center;background-color:#f4f6ff;color:#000;margin:0;padding:20px;width:100%;'>
                    <div style='background:#fff;color:#2c1d66;font-family:Arial,sans-serif;font-size:16px;text-align:left;max-width:680px;margin:0 auto 20px;border:1px solid #e5e4e6;border-radius:10px;padding:20px;'>
                    <h1 style='color:#0b4dc4;'>New Meeting Scheduled</h1>
                    <p>Dear <strong>{user_name}</strong>,</p>
                    <p>You have a new meeting scheduled for <strong>{start_time}</strong>.</p>
                    <p><strong>Topic:</strong> {meeting_topic}</p>
                    <p>To join the meeting, please click on the following link: <a href='{join_url}'>{join_url}</a></p>
                    <p>If you have any questions, feel free to contact our support team at <a href='mailto:support@zenxservices.com' style='color:#2c1d66;'>support@zenxservices.com</a>.</p>
                    <p>Thank you for choosing Zenxserv Technologies. We look forward to serving you!</p>
                    </div>
                    <small style='font-size:12px;color:#2c1d66;'>© " . date('Y') . " $appName. All rights reserved.</small>
                    </div>",
            ],
            
        ];

        foreach ($email_templates as $email_template) {
            EmailTemplate::create($email_template);
        }
    }
}
