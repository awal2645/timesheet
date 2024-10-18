<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Email Template</title>
    <style>
        * {
            margin: 0;
            padding: 0;
        }

        body {
            font-family: 'Arial', sans-serif;
        }

        .mail-wrap {
            background: #f4f6ff;
            width: 100%;
        }

        .logo-wrap {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        h2 {
            color: #0b4dc4;
        }

        .inner-wrap {
            width: 680px;
            margin: 0 auto;
            padding: 20px;
            background: #fff;

        }

        .inner-wrap img {
            width: 40%;
        }

        h1 {
            color: #0b4dc4;
            font-size: 18px;
            margin: 20px 0;
        }

        p {
            font-size: 14px;
            color: #2c1d66;
            margin: 20px 0;
        }

        .btn {
            background: #1fa8f8;
            color: #fff;
            font-size: 12px;
            cursor: pointer;
            padding: 15px 20px;
            border-radius: 5px;
            text-decoration: none;
            display: block;
            text-align: center;
            font-size: 14px;
        }

        .link {
            color: #2c1d66;

        }

        .inner-footer {
            width: 680px;
            margin: 0 auto;
            padding: 20px;

        }

        .inner-footer p {
            font-size: 12px;
            color: #2c1d66;
            line-height: 16px;
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
                                        <img src="https://timesheet.engagingdot.com/images/logo.png"
                                            alt="Zenxserv Technologies" style="max-width: 200px;">

                                    </td>
                                    <td align="right">
                                        <h2>Timesheet</h2>
                                    </td>

                                </tr>
                    </tr>
                    <tr>
                        <td>
                            <h1>Welcome to {{ config('app.name') }}</h1>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <p>Thank you for expressing interest in Zenxserv Technologies!</p>
                            <p>To unlock access to our innovative features and services, we kindly ask you to verify
                                your email address.</p>
                            <p><a href="{{route('email.verify',$token)}}" class="btn"
                                    style="background-color: #007bff; color: #ffffff; padding: 10px 20px; text-decoration: none; border-radius: 5px;">Verify</a>
                            </p>
                            <p>Once your email address is verified, you'll be all set to explore everything Zenxserv
                                Technologies has to offer.</p>
                            <p>If you have any questions or need assistance, feel free to reach out to our support team
                                at <a href="mailto:support@engagingdot.com" class="link">support@engagingdot.com</a>.
                            </p>
                            <p>Thank you for choosing Zenxserv Technologies. We look forward to serving you!</p>
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
                            <p>You have received this email because you are registered at Zenxserv Technologies, to
                                ensure the implementation of our Terms of Service and (or) for other legitimate matters.
                            </p>
                            <p>&copy; {{date('Y')}} Zenxserv Technologies Pvt LTD.</p>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</body>

</html>