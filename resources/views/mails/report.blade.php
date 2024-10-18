<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        *{
            margin: 0;
            padding: 0;
        }
        body{
            font-family: 'Arial', sans-serif;
        }
        .mail-wrap{
            background: #f4f6ff;
            width: 100%;
        }
        .logo-wrap{
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        h2{
            color: #0b4dc4;
        }
        .inner-wrap{
            width: 680px;
            margin: 0 auto;
            padding: 20px;
            background: #fff;

        }
        .inner-wrap img{
            width: 40%;
        }
        h1{
            color: #0b4dc4;
            font-size: 18px;
            margin: 20px 0;
        }
        p{
            font-size: 14px;
            color: #2c1d66;
            margin: 20px 0;
        }
        .btn{
            background: #1fa8f8;
            color:#fff;
            font-size: 12px;
            cursor: pointer;
            padding: 15px 20px;
            border-radius: 5px;
            text-decoration: none;
            display: block;
            text-align: center;
            font-size: 14px;
        }
        .link{
            color: #2c1d66;

        }
        .inner-footer{
            width: 680px;
            margin: 0 auto;
            padding: 20px;

        }
        .inner-footer p{
            font-size: 12px;
            color: #2c1d66;
            line-height: 16px;
        }
        .btn {
            display: inline-block;
            padding: 10px 20px;
            font-size: 16px;
            font-weight: bold;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .btn-primary {
            background-color: #007bff;
            color: #fff;
        }

        .btn-primary:hover {
            background-color: #0056b3;
        }

        .btn-danger {
            background-color: #dc3545;
            color: #fff;
        }

        .btn-danger:hover {
            background-color: #c82333;
        }

    </style>
</head>
<body>
<table cellpadding="0" cellspacing="0" border="0" width="100%" style="font-family: Arial, sans-serif;">
        <tr>
            <td align="center" bgcolor="#f4f6ff">
                <table cellpadding="0" cellspacing="0" border="0" width="680" class="inner-wrap">
                    <tr>
                        <td>
                        <table cellpadding="0" cellspacing="0" border="0" width="100%">
                    <tr lass="logo-wrap">
                        <td>
                        <img src="https://timesheet.engagingdot.com/images/logo.png" alt="Zenxserv Technologies" style="max-width: 200px;">

                        </td>
                        <td align="right">
                        <h2>Timesheet</h2>
                        </td>

    </tr>
                    </tr>
                    <tr>
                        <td>
                            <h1>{{ config('app.name') }}</h1>
                        </td>
                    </tr>
                    <tr>
                        <td>
                        <p><strong>Your employee {{$name}} has submitted the timesheet.</strong></p>
                        <p>Please review the report and take necessary actions.</p>
                        <div class="action-buttons">
                        <button id="approveBtn" class="btn btn-primary">Approve</button>
                        <button id="rejectBtn" class="btn btn-danger">Reject</button>
                        </div>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
        <tr>
            <td align="center">
                <table cellpadding="0" cellspacing="0" border="0" width="680" class="inner-footer">
                    <tr>
                        <td>
                            <p>You have received this email because you are registered at Zenxserv Technologies, to ensure the implementation of our Terms of Service and (or) for other legitimate matters.</p>
                            <p>&copy; {{date('Y')}} Zenxserv Technologies Pvt LTD.</p>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>

</body>
</html>
