<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>رسالة جديدة من نموذج الاتصال</title>
</head>
<body style="margin: 0; padding: 0; font-family: Arial, Helvetica, sans-serif; background-color: #f4f4f4; color: #333; direction: rtl;">
    <table role="presentation" width="100%" cellpadding="0" cellspacing="0" style="max-width: 600px; margin: 20px auto; background-color: #ffffff; border: 1px solid #e0e0e0; border-radius: 8px;">
        <!-- Header -->
        <tr>
            <td style="background-color: #2c3e50; padding: 20px; text-align: center; border-top-left-radius: 8px; border-top-right-radius: 8px;">
                <h1 style="color: #ffffff; margin: 0; font-size: 24px;">نموذج التواصل - العقارات</h1>
                <p style="color: #dcdcdc; margin: 5px 0 0; font-size: 14px;">تم استلام رسالة جديدة</p>
            </td>
        </tr>
        <!-- Body -->
        <tr>
            <td style="padding: 30px;">
                <h2 style="font-size: 20px; color: #2c3e50; margin-top: 0;">مرحبًا،</h2>
                <p style="font-size: 16px; line-height: 1.5; color: #555;">
                    لقد تلقيت رسالة جديدة من نموذج التواصل على موقع العقارات. فيما يلي التفاصيل:
                </p>
                <table role="presentation" width="100%" cellpadding="0" cellspacing="0" style="margin: 20px 0;">
                    <tr>
                        <td style="padding: 10px 0; font-size: 16px; font-weight: bold; color: #2c3e50; width: 100px;">الاسم:</td>
                        <td style="padding: 10px 0; font-size: 16px; color: #333;">{{ $name }}</td>
                    </tr>
                    <tr>
                        <td style="padding: 10px 0; font-size: 16px; font-weight: bold; color: #2c3e50; width: 100px;">البريد الإلكتروني:</td>
                        <td style="padding: 10px 0; font-size: 16px; color: #333;">
                            <a href="mailto:{{ $email }}" style="color: #3498db; text-decoration: none;">{{ $email }}</a>
                        </td>
                    </tr>
                    <tr>
                        <td style="padding: 10px 0; font-size: 16px; font-weight: bold; color: #2c3e50; width: 100px;">الرسالة:</td>
                        <td style="padding: 10px 0; font-size: 16px; color: #333; line-height: 1.6;">{{ $contactMessage }}</td> <!-- Updated to contactMessage -->
                    </tr>
                </table>
                <p style="font-size: 16px; line-height: 1.5; color: #555;">
                    يرجى الرد على هذا الاستفسار في أقرب وقت ممكن.
                </p>
                <a href="mailto:{{ $email }}" style="display: inline-block; padding: 12px 24px; background-color: #3498db; color: #ffffff; text-decoration: none; border-radius: 4px; font-size: 16px; margin-top: 20px;">الرد على المرسل</a>
            </td>
        </tr>
        <!-- Footer -->
        <tr>
            <td style="background-color: #f8f8f8; padding: 20px; text-align: center; border-bottom-left-radius: 8px; border-bottom-right-radius: 8px;">
                <p style="margin: 0; font-size: 14px; color: #777;">
                    © {{ date('Y') }} العقارات. جميع الحقوق محفوظة.
                </p>
                <p style="margin: 5px 0 0; font-size: 12px; color: #999;">
                    تم إرسال هذا البريد الإلكتروني من نموذج التواصل على موقع العقارات.
                </p>
            </td>
        </tr>
    </table>
</body>
</html>