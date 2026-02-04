<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>طلب حجز جديد</title>
</head>
<body style="margin: 0; padding: 0; font-family: Arial, Helvetica, sans-serif; background-color: #f4f4f4; color: #333; direction: rtl;">
    <table role="presentation" width="100%" cellpadding="0" cellspacing="0" style="max-width: 600px; margin: 20px auto; background-color: #ffffff; border: 1px solid #e0e0e0; border-radius: 8px;">
        <!-- Header -->
        <tr>
            <td style="background-color: #2c3e50; padding: 20px; text-align: center; border-top-left-radius: 8px; border-top-right-radius: 8px;">
                <h1 style="color: #ffffff; margin: 0; font-size: 24px;">طلب حجز جديد - العقارات</h1>
                <p style="color: #dcdcdc; margin: 5px 0 0; font-size: 14px;">تم استلام طلب حجز جديد</p>
            </td>
        </tr>
        <!-- Body -->
        <tr>
            <td style="padding: 30px;">
                <h2 style="font-size: 20px; color: #2c3e50; margin-top: 0;">مرحبًا،</h2>
                <p style="font-size: 16px; line-height: 1.5; color: #555;">
                    لقد تلقيت طلب حجز جديد على موقع العقارات. فيما يلي التفاصيل:
                </p>
                <table role="presentation" width="100%" cellpadding="0" cellspacing="0" style="margin: 20px 0;">
                    <tr>
                        <td style="padding: 10px 0; font-size: 16px; font-weight: bold; color: #2c3e50; width: 100px;">الاسم:</td>
                        <td style="padding: 10px 0; font-size: 16px; color: #333;">{{ $name }}</td>
                    </tr>
                    <tr>
                        <td style="padding: 10px 0; font-size: 16px; font-weight: bold; color: #2c3e50; width: 100px;">الهاتف:</td>
                        <td style="padding: 10px 0; font-size: 16px; color: #333;">{{ $phone }}</td>
                    </tr>
                    <tr>
                        <td style="padding: 10px 0; font-size: 16px; font-weight: bold; color: #2c3e50; width: 100px;">العقار:</td>
                        <td style="padding: 10px 0; font-size: 16px; color: #333;">{{ $property }}</td>
                    </tr>
                    <tr>
                        <td style="padding: 10px 0; font-size: 16px; font-weight: bold; color: #2c3e50; width: 100px;">العنوان:</td>
                        <td style="padding: 10px 0; font-size: 16px; color: #333;">{{ $address }}</td>
                    </tr>
                        <tr>
                            <td style="padding: 10px 0; font-size: 16px; font-weight: bold; color: #2c3e50; width: 100px;">الوصف:</td>
                            <td style="padding: 10px 0; font-size: 16px; color: #333;">{{ $description }}</td>
                        </tr>
                    <tr>
                        <td style="padding: 10px 0; font-size: 16px; font-weight: bold; color: #2c3e50; width: 100px;">التاريخ:</td>
                        <td style="padding: 10px 0; font-size: 16px; color: #333;">{{ $date }}</td>
                    </tr>
                    <tr>
                        <td style="padding: 10px 0; font-size: 16px; font-weight: bold; color: #2c3e50; width: 100px;">الوقت:</td>
                        <td style="padding: 10px 0; font-size: 16px; color: #333;">{{ $time }}</td>
                    </tr>
                    <tr>
                        <td style="padding: 10px 0; font-size: 16px; font-weight: bold; color: #2c3e50; width: 100px;">الشريك:</td>
                        <td style="padding: 10px 0; font-size: 16px; color: #333;">{{ $partner }}</td>
                    </tr>
                </table>
                <p style="font-size: 16px; line-height: 1.5; color: #555;">
                    يرجى التحقق من هذا الطلب في أقرب وقت ممكن.
                </p>
            </td>
        </tr>
        <!-- Footer -->
        <tr>
            <td style="background-color: #f8f8f8; padding: 20px; text-align: center; border-bottom-left-radius: 8px; border-bottom-right-radius: 8px;">
                <p style="margin: 0; font-size: 14px; color: #777;">
                    © {{ date('Y') }} العقارات. جميع الحقوق محفوظة.
                </p>
                <p style="margin: 5px 0 0; font-size: 12px; color: #999;">
                    تم إرسال هذا البريد الإلكتروني من نموذج الحجز على موقع العقارات.
                </p>
            </td>
        </tr>
    </table>
</body>
</html>