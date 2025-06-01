<?php

namespace Modules\EmailTemplate\Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\EmailTemplate\App\Models\EmailTemplate;

class EmailTemplateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
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
            // Add more email templates as needed
        ];

        foreach ($email_templates as $email_template) {
            EmailTemplate::create($email_template);
        }
    }
} 