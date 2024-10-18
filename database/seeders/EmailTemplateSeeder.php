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
                'subject' => 'New Plan Has Purchased',
                'message' => "<div style='box-sizing:border-box;font-family:Arial,sans-serif;font-size:16px;text-align:center;background-color:#f4f6ff;color:#000;margin:0;padding:20px;width:100%;'>
                    <div style='background:#fff;color:#2c1d66;font-family:Arial,sans-serif;font-size:16px;text-align:left;max-width:680px;margin:0 auto 20px;border:1px solid #e5e4e6;border-radius:10px;padding:20px;'>
                    <h1 style='color:#0b4dc4;'>New Plan Purchased</h1>
                    <p><strong>{user_name}</strong> has purchased the <strong>{plan_label}</strong> plan!</p>
                    <p>If you have any questions, feel free to contact our support team at <a href='mailto:support@zenxservices.com' style='color:#2c1d66;'>support@zenxservices.com</a>.</p>
                    <p>Thank you for choosing Zenxserv Technologies. We look forward to serving you!</p>
                    </div>
                    <small style='font-size:12px;color:#2c1d66;'>© ".date('Y')." $appName. All rights reserved.</small>
                    </div>",
            ],
            [
                'name' => 'Employer Invite Notification',
                'type' => 'employer_invite',
                'subject' => 'Verify Your Email Address',
                'message' => "<div style='box-sizing:border-box;font-family:Arial,sans-serif;font-size:16px;text-align:center;background-color:#f4f6ff;color:#000;margin:0;padding:20px;width:100%;'>
                    <div style='background:#fff;color:#2c1d66;font-family:Arial,sans-serif;font-size:16px;text-align:left;max-width:680px;margin:0 auto 20px;border:1px solid #e5e4e6;border-radius:10px;padding:20px;'>
                    <h1 style='color:#0b4dc4;'>Welcome to {app_name}</h1>
                    <p>Thank you for employer</p>
                    <p>To unlock access to our innovative features and services, we kindly ask you to verify your email address.</p>
                    <p><a href='{verify_link}' style='background-color:#1fa8f8;color:#fff;font-size:14px;padding:15px 20px;border-radius:5px;text-decoration:none;display:inline-block;'>Verify Now</a></p>
                    <p>Once your email address is verified, you'll be all set to explore everything Zenxserv Technologies has to offer.</p>
                    <p>If you have any questions or need assistance, feel free to reach out to our support team at <a href='mailto:support@zenxservices.com' style='color:#2c1d66;'>support@zenxservices.com</a>.</p>
                    <p>Thank you for choosing Zenxserv Technologies. We look forward to serving you!</p>
                    </div>
                    <small style='font-size:12px;color:#2c1d66;'>© {year} Zenxserv Technologies Pvt LTD. All rights reserved.</small>
                    </div>",
            ],
            [
                'name' => 'Employee Invite Notification',
                'type' => 'employee_invite',
                'subject' => 'Verify Your Email Address',
                'message' => "<div style='box-sizing:border-box;font-family:Arial,sans-serif;font-size:16px;text-align:center;background-color:#f4f6ff;color:#000;margin:0;padding:20px;width:100%;'>
                    <div style='background:#fff;color:#2c1d66;font-family:Arial,sans-serif;font-size:16px;text-align:left;max-width:680px;margin:0 auto 20px;border:1px solid #e5e4e6;border-radius:10px;padding:20px;'>
                    <h1 style='color:#0b4dc4;'>Welcome to {app_name}</h1>
                    <p>Thank you for employee</p>
                    <p>To unlock access to our innovative features and services, we kindly ask you to verify your email address.</p>
                    <p><a href='{verify_link}' style='background-color:#1fa8f8;color:#fff;font-size:14px;padding:15px 20px;border-radius:5px;text-decoration:none;display:inline-block;'>Verify Now</a></p>
                    <p>Once your email address is verified, you'll be all set to explore everything Zenxserv Technologies has to offer.</p>
                    <p>If you have any questions or need assistance, feel free to reach out to our support team at <a href='mailto:support@zenxservices.com' style='color:#2c1d66;'>support@zenxservices.com</a>.</p>
                    <p>Thank you for choosing Zenxserv Technologies. We look forward to serving you!</p>
                    </div>
                    <small style='font-size:12px;color:#2c1d66;'>© {year} Zenxserv Technologies Pvt LTD. All rights reserved.</small>
                    </div>",
            ],
            [
                'name' => 'Timesheet Update Notification',
                'type' => 'timesheet_update',
                'subject' => 'Timesheet Update Notification',
                'message' => "<div style='box-sizing:border-box;font-family:Arial,sans-serif;font-size:16px;text-align:center;background-color:#f4f6ff;color:#000;margin:0;padding:20px;width:100%;'>
                                <div style='background:#fff;color:#2c1d66;font-family:Arial,sans-serif;font-size:16px;text-align:left;max-width:680px;margin:0 auto;border:1px solid #e5e4e6;border-radius:10px;padding:20px;'>
                                    <p><strong>Hello,</strong></p>
                                    <p>Your timesheet has been updated.</p>
                                    <a style='background-color:#007bff;color:#fff;padding:10px 20px;border-radius:5px;text-decoration:none;'>View</a> <br> <br>
                                    <p>If you have any questions, please reach out to our support team.</p>
                                </div>
                                <div style='text-align:center;margin-top:20px;'>
                                    <small style='font-size:12px;color:#2c1d66;'>© {year} Zenxserv Technologies Pvt LTD. All rights reserved.</small>
                                </div>
                            </div>",
            ],

            [
                'name' => 'Timesheet Submission',
                'type' => 'timesheet_submission',
                'subject' => 'Timesheet Submitted',
                'message' => "<div style='box-sizing:border-box;font-family:Helvetica,Arial,sans-serif; font-size:16px; text-align:center; background-color:#edf2f7; color:#000; margin:0;padding:20px ;width:100%'>
                                <div style='background:#fff; color:#718096; font-family:Helvetica,Arial,sans-serif; font-size:16px; text-align:left; max-width:600px; margin: 0 auto 20px; border: 1px solid #e5e4e6; border-radius: 10px; padding: 20px;'>
                                    <p><strong>Hello,</strong><br><br>
                                    Your employee <strong>{name}</strong> has submitted a timesheet.<br><br>
                                    Please review the report and take the necessary actions.<br><br>
                                    <a id='approveBtn'  href='{link}' style='background-color:#007bff;color:#fff;padding:10px 20px;border-radius:5px;text-decoration:none;'>View</a> <br> <br>
                                    Best Regards,<br><strong>{app_name}</strong></p>
                                </div>
                                <small>© ".date('Y').'{app_name}. All rights reserved.</small>
                             </div>',
            ],
        ];

        foreach ($email_templates as $email_template) {
            EmailTemplate::create($email_template);
        }
    }
}
