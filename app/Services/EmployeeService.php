<?php

namespace App\Services;

use App\Mail\EmployeeInviteMail;
use App\Models\Client;
use App\Models\Employee;
use App\Models\Employer;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class EmployeeService
{
    public function create(array $data)
    {
        // Create new user
        $input['role'] = 'employee';
        $input['email'] = $data['email'];
        $user = User::create($input);
        $user->assignRole(['employee']);

        $token = Str::random(64);
        DB::table('password_reset_tokens')->insert([
            'email' => $data['email'],
            'token' => $token,
            'created_at' => now(),
        ]);

        if ($input['email']) {
            $emailTemplate = DB::table('email_templates')
                ->where('type', 'employee_invite')
                ->first();

            if ($emailTemplate && isset($emailTemplate->subject) && isset($emailTemplate->message)) {
                $formattedBody = getFormattedTextByType('employee_invite', [
                    'app_name' => config('app.name'),
                    'verify_link' => route('email.verify', $token),
                    'year' => date('Y'),
                ]);
                if (checkMailConfig()) {
                    Mail::to($input['email'])->send(new EmployeeInviteMail($emailTemplate->subject, $formattedBody));
                }
            } else {
                throw new \Exception('Email template not found or is missing required fields.');
            }
        }

        return Employee::create([
            'user_id' => $user->id,
            'employer_id' => $data['employer_id'],
            'employee_name' => $data['employee_name'],
            'phone' => $data['phone'],
            'client_id' => $data['client_id'],
            'gender' => $data['gender'],
            'employee_share' => $data['employee_share'],
            'billing_rate' => $data['billing_rate'],
        ]);
    }

    public function update(Employee $employee, array $data)
    {
        $user = User::findOrFail($employee->user_id);
        $user->email = $data['email'];
        $user->save();
        $data = collect($data)->except(['image', 'email'])->toArray();
        return $employee->update($data); 
    }

    public function delete(Employee $employee)
    {
        $user = User::findOrFail($employee->user_id);
        $user->delete();
        $employee->delete();
    }
}
