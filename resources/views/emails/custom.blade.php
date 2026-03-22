<!DOCTYPE html>
<html lang="en" xmlns:v="urn:schemas-microsoft-com:vml">

<head>
    <meta charset="utf-8">
    <meta name="x-apple-disable-message-reformatting">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="format-detection" content="telephone=no, date=no, address=no, email=no, url=no">
    <!--[if mso]>
    <noscript>
        <xml>
            <o:OfficeDocumentSettings xmlns:o="urn:schemas-microsoft-com:office:office">
                <o:PixelsPerInch>96</o:PixelsPerInch>
            </o:OfficeDocumentSettings>
        </xml>
    </noscript>
    <style>
        td,th,div,p,a,h1,h2,h3,h4,h5,h6 {font-family: "Segoe UI", sans-serif; mso-line-height-rule: exactly;}
    </style>
    <![endif]-->
    <style>
        body,
        table,
        td,
        p,
        a,
        li,
        blockquote {
            -webkit-text-size-adjust: 100%;
            -ms-text-size-adjust: 100%;
        }

        table,
        td {
            mso-table-lspace: 0pt;
            mso-table-rspace: 0pt;
        }

        img {
            -ms-interpolation-mode: bicubic;
            border: 0;
            height: auto;
            line-height: 100%;
            outline: none;
            text-decoration: none;
        }

        body {
            margin: 0;
            padding: 0;
            width: 100% !important;
            -webkit-font-smoothing: antialiased;
        }

        @media only screen and (max-width: 600px) {
            .mobile-padding {
                padding: 0 16px !important;
            }

            .mobile-full-width {
                width: 100% !important;
                max-width: 100% !important;
            }
        }
    </style>
</head>

<body
    style="margin: 0; padding: 0; background-color: #f1f5f9; font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Helvetica, Arial, sans-serif;">
    <table role="presentation" cellspacing="0" cellpadding="0" border="0" width="100%"
        style="background-color: #f1f5f9;">
        <tr>
            <td align="center" style="padding: 40px 16px;">
                <table role="presentation" cellspacing="0" cellpadding="0" border="0" width="600"
                    style="max-width: 600px; width: 100%;">

                    {{-- ===== HEADER ===== --}}
                    <tr>
                        <td
                            style="background: linear-gradient(135deg, #1e3a5f 0%, #2563eb 100%); padding: 32px; border-radius: 16px 16px 0 0; text-align: center;">
                            <h1
                                style="margin: 0; font-size: 24px; font-weight: 700; color: #ffffff; letter-spacing: -0.5px;">
                                Novexia Logistics
                            </h1>
                        </td>
                    </tr>

                    {{-- ===== BODY ===== --}}
                    <tr>
                        <td style="background-color: #ffffff; padding: 32px;" class="mobile-padding">
                            <div style="font-size: 15px; line-height: 1.7; color: #334155;">
                                {!! nl2br(e($emailBody)) !!}
                            </div>
                        </td>
                    </tr>

                    {{-- ===== FOOTER ===== --}}
                    <tr>
                        <td
                            style="background-color: #f8fafc; padding: 24px 32px; border-radius: 0 0 16px 16px; border-top: 1px solid #e2e8f0; text-align: center;">
                            <p style="margin: 0 0 8px; font-size: 13px; color: #94a3b8;">
                                &copy; {{ date('Y') }} Novexia Logistics. All rights reserved.
                            </p>
                            <p style="margin: 0; font-size: 12px; color: #cbd5e1;">
                                This email was sent by Novexia Logistics administration.
                            </p>
                        </td>
                    </tr>

                </table>
            </td>
        </tr>
    </table>
</body>

</html>