<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <meta name="x-apple-disable-message-reformatting">
    <style>
        table,
        td,
        div,
        h1,
        p {
            font-family: Arial, sans-serif;
        }

        .text-right {
            text-align: center;
            margin-top: 10%;
            margin-bottom: 10%;
        }

        #resetPassword {
            background-color: #d8ebff;
            color: #007bff;
            border: none;
            border-radius: 4px;
            padding: 10px 20px;
            font-size: 16px;
            font-weight: bold;
            cursor: pointer;
            text-decoration: none;
            font-family: Arial;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
    </style>
</head>

<body style="margin:0;padding:0;">
    <table role="presentation"
        style="width:100%;border-collapse:collapse;border:0;border-spacing:0;background:#ffffff;">
        <tr>
            <td align="center" style="padding:0;">
                <table role="presentation"
                    style="width:602px;border-collapse:collapse;border-spacing:0;text-align:left;">
                    <tr>
                        <td align="center" style="padding:60px 0 60px 0;background-color: #d8ebff">
                            <img src="cid:RuralConnectLogo" alt="Rural Connect" width="400"
                                style="height:auto;display:block;" />
                        </td>
                    </tr>
                    <tr>
                        <td style="padding:36px 30px 10px 30px;">
                            <table role="presentation"
                                style="width:100%;border-collapse:collapse;border:0;border-spacing:0;">
                                <tr>
                                    <td style="padding:0 0 36px 0;color:#111111;">
                                        <h1 style="font-size:24px;margin:0 0 20px 0;font-family:Arial,sans-serif;">Hello
                                            <?php echo $username ?>,
                                        </h1>
                                        <p
                                            style="margin:0 0 12px 0;font-size:16px;line-height:24px;font-family:Arial,sans-serif;">
                                            Here's your authentication code.</p>
                                        <div class="text-right">
                                            <span
                                                style="background-color: #d8ebff; font-size: 50px; color: #007bff; padding: 10px; border-radius: 10px; font-weight: bold; letter-spacing: 10px;"><?php echo $token ?>
                                            </span>
                                        </div>
                                        <p style="font-size:16px;margin:40px 0 20px 0;font-family:Arial,sans-serif;">
                                            Best Regards,</p>
                                        <p style="font-size:16px;margin:20px 0 20px 0;font-family:Arial,sans-serif;">
                                            Rural Connect Team</p>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                    <tr>
                        <td style="padding:40px;background-color: #d8ebff">
                            <table role="presentation"
                                style="width:100%;border-collapse:collapse;border:0;border-spacing:0;font-size:9px;font-family:Arial,sans-serif;">
                                <tr>
                                    <td style="padding:0;width:50%;" align="left">
                                        <p
                                            style="margin:0;font-size:14px;line-height:16px;font-family:Arial,sans-serif;color:#007bff;">
                                            &copy; Rural Connect
                                            <?php echo date("Y") ?><br />
                                        </p>
                                    </td>
                                    <td style="padding:0;width:50%;" align="right">
                                        <table role="presentation"
                                            style="border-collapse:collapse;border:0;border-spacing:0;">
                                            <tr>
                                                <td style="padding:0 0 0 10px;width:38px;">
                                                    <a href="mailto:rural.connect2025@gmail.com"><img
                                                            src="cid:RuralConnectLogo" alt="Rural Connect" width="200"
                                                            style="height:auto;display:block;border:0;" /></a>
                                                </td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</body>

</html>