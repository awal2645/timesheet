<?php

use App\Http\Controllers\AccountController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\EmailTemplateController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\EmployerController;
use App\Http\Controllers\InvitationController;
use App\Http\Controllers\LocationController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\Payment\PayPalController;
use App\Http\Controllers\Payment\StripeController;
use App\Http\Controllers\PricePlanController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\SMTPController;
use App\Http\Controllers\TimeReportController;
use App\Http\Controllers\TimesheetController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Redirect the root URL to the login page
Route::redirect('/', 'login');

// Email verification routes
Route::get('verify/{token}', [AuthController::class, 'verify'])->name('email.verify');
Route::get('user/info/{token}', [AuthController::class, 'usernamePassword'])->name('username.password');
Route::put('update/info', [AuthController::class, 'updateUserInfo'])->name('update.info');

// Protected routes that require authentication and email verification
Route::middleware(['auth:sanctum', 'verified'])->group(function () {

    // Dashboard route
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Employer-related routes
    Route::middleware('check.employer.status')->group(function () {
        Route::get('employer/list', [EmployerController::class, 'index'])->name('employer.index');
        Route::get('/employer/create', [EmployerController::class, 'create'])->name('employer.create');
        Route::post('/employer/store', [EmployerController::class, 'store'])->name('employer.store');
        Route::get('employer/destroy/{id}', [EmployerController::class, 'destroy'])->name('employer.destroy');
        Route::post('employer/update-status/{id}', [EmployerController::class, 'updateStatus'])->name('employer.updateStatus');

        // Employer edit routes
        Route::get('employer/{id}/edit', [EmployerController::class, 'edit'])->name('employer.edit');
        Route::put('employer/{id}/update', [EmployerController::class, 'update'])->name('employer.update');

        // Employee-related routes
        Route::get('employee/list', [EmployeeController::class, 'index'])->name('employee.index');
        Route::get('employee/list/{employer}', [EmployeeController::class, 'employerClient'])->name('employee.employer');
        Route::get('/employee/create', [EmployeeController::class, 'create'])->name('employee.create')->middleware('check.plan.limits:employee');
        Route::post('/employee/store', [EmployeeController::class, 'store'])->name('employee.store');
        Route::get('employee/destroy/{id}', [EmployeeController::class, 'destroy'])->name('employee.destroy');
        Route::post('employee/update-status/{id}', [EmployeeController::class, 'updateStatus'])->name('employee.updateStatus');

        // Employee edit routes
        Route::get('employee/{id}/edit', [EmployeeController::class, 'edit'])->name('employee.edit');
        Route::put('employee/{id}/update', [EmployeeController::class, 'update'])->name('employee.update');
        Route::put('account/info/update', [AccountController::class, 'employeeInfoUpdate'])->name('employee.info.update');

        // Timesheet routes for specific roles
        Route::group(['middleware' => 'role:employee,superadmin'], function () {
            Route::get('/timesheet/{startDate?}', [TimesheetController::class, 'index'])->name('timesheet.index')->middleware('check.employee.status');
            Route::post('/timesheet/save', [TimesheetController::class, 'saveTimesheet'])->name('timesheet.save');
            Route::post('/timesheet/submit', [TimesheetController::class, 'submitTimesheet'])->name('timesheet.submit');
        });

        // Client-related routes
        Route::get('client/list', [ClientController::class, 'index'])->name('client.index');
        Route::get('client/list/{employer}', [ClientController::class, 'employerClient'])->name('client.employer');
        Route::get('/client/create', [ClientController::class, 'create'])->name('client.create')->middleware('check.plan.limits:client');
        Route::post('/client/store', [ClientController::class, 'store'])->name('client.store');
        Route::get('client/{id}/edit', [ClientController::class, 'edit'])->name('client.edit');
        Route::put('client/{id}/update', [ClientController::class, 'update'])->name('client.update');
        Route::get('client/destroy/{id}', [ClientController::class, 'destroy'])->name('client.destroy');
        Route::post('client/update-status/{id}', [ClientController::class, 'updateStatus'])->name('client.updateStatus');

        // Project-related routes
        Route::get('project/list', [ProjectController::class, 'index'])->name('project.index');
        Route::get('/project/create', [ProjectController::class, 'create'])->name('project.create')->middleware('check.plan.limits:project');
        Route::post('/project/store', [ProjectController::class, 'store'])->name('project.store');
        Route::get('project/{id}/edit', [ProjectController::class, 'edit'])->name('project.edit');
        Route::put('project/{id}/update', [ProjectController::class, 'update'])->name('project.update');
        Route::get('project/{id}/destroy', [ProjectController::class, 'destroy'])->name('project.destroy');
        Route::post('project/update-status/{id}', [ProjectController::class, 'updateStatus'])->name('project.updateStatus');

        // Timesheet report routes
        Route::post('/timesheet/update-status/{id}', [TimeReportController::class, 'updateStatus'])->name('timesheet.updateStatus');
        Route::post('/timesheet/feedback/{id}', [TimeReportController::class, 'feedback'])->name('timesheet.feedback');
        Route::resource('reports', TimeReportController::class);
        Route::get('report/list/employer/{employer}', [TimeReportController::class, 'employerReport'])->name('report.employer');
        Route::get('report/list/employee/{employee}', [TimeReportController::class, 'employeeReport'])->name('report.employee');
        Route::get('report/list/date', [TimeReportController::class, 'dateReport'])->name('report.date');

        // Invitation routes
        Route::controller(InvitationController::class)->group(function () {
            Route::get('invitation/send', 'employerInvitePageData')->name('invite.send.employer.page');
            Route::post('employer/invitation/send', 'employerInviteSend')->name('invite.send.employer');
            Route::post('employee/invitation/send', 'employeeInviteSend')->name('invite.send.employee');
        });

        // Account routes
        Route::controller(AccountController::class)->group(function () {
            Route::get('my/account', 'myAccount')->name('my.account');
        });

        // Notification routes
        Route::get('notifications', [NotificationController::class, 'notifications'])->name('notifications');
        Route::get('notification/mark', [NotificationController::class, 'notificationDel'])->name('notification.del');

        // Role management routes
        Route::get('role/list', [RoleController::class, 'index'])->name('role.page');
        Route::get('role/create', [RoleController::class, 'create'])->name('role.create');
        Route::post('role/store', [RoleController::class, 'store'])->name('role.store');
        Route::get('role/edit/{id}', [RoleController::class, 'edit'])->name('role.edit');
        Route::put('role/update/{id}', [RoleController::class, 'update'])->name('role.update');
        Route::get('role/destroy/{id}', [RoleController::class, 'destroy'])->name('role.destroy');

        // Location routes for dynamic state and city fetching
        Route::get('/get-states-by-country', [LocationController::class, 'getStatesByCountry']);
        Route::get('/get-cities-by-state', [LocationController::class, 'getCitiesByState']);

        // SMTP configuration routes
        Route::controller(SMTPController::class)->group(function () {
            Route::get('smtp/config', 'email')->name('smtp');
            Route::put('email', 'emailUpdate')->name('email.update');
        });

        // Settings routes
        Route::controller(SettingController::class)->group(function () {
            Route::get('setting', 'setting')->name('setting');
            Route::put('setting/update', 'update')->name('settings.update');
            Route::get('payment/gateway', 'paymentGateway')->name('payment');
            Route::put('payment/update', 'paymentupdate')->name('payment.update');
            Route::get('upgrade', 'upgrade')->name('upgrade');
            Route::post('upgrade/apply', 'upgradeApply')->name('upgrade.apply');
        });

        // Email template routes
        Route::controller(EmailTemplateController::class)->group(function () {
            Route::get('email-templates', [EmailTemplateController::class, 'index'])->name('email_templates');
            Route::post('email-templates/save', [EmailTemplateController::class, 'save'])->name('email_templates.save');
        });
    });

    // Price plan routes
    Route::resource('plans', PricePlanController::class);
    Route::post('plans/recommended', [PricePlanController::class, 'markRecommended'])->name('plans.recommended');

    // Stripe payment routes
    Route::controller(StripeController::class)
        ->prefix('stripe')
        ->name('stripe.')
        ->group(function () {
            Route::post('/plan/purchase', 'paymentPurchase')->name('payment.purchase');
            Route::get('/plan/success', 'paymentSuccess')->name('payment.success');
            Route::get('/plan/cancel', 'paymentCancel')->name('payment.cancel');
        });

    // PayPal payment routes
    Route::controller(PayPalController::class)->group(function () {
        Route::post('paypal/payment', 'processTransaction')->name('paypal.post');
        Route::get('success-transaction', 'successTransaction')->name('paypal.successTransaction');
        Route::get('cancel-transaction', 'cancelTransaction')->name('paypal.cancelTransaction');
    });


    // Employer plan route
    Route::get('employer/plan', [EmployerController::class, 'plan'])->name('employer.plan');

    // Order management routes
    Route::controller(OrderController::class)->group(function () {
        Route::get('order', 'order')->name('order.index');
        Route::get('order/create', 'orderCreate')->name('order.create');
        Route::post('order/store', 'orderStore')->name('order.store');
    });
});
