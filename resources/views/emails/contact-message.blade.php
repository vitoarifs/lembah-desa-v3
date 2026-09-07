<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pesan Baru - Lembah Desa</title>
</head>
<body style="margin: 0; padding: 0; background-color: #f5f5f4; font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Helvetica, Arial, sans-serif; color: #1c1917;">
    <table role="presentation" width="100%" cellspacing="0" cellpadding="0" style="background-color: #f5f5f4; padding: 32px 16px;">
        <tr>
            <td align="center">
                <table role="presentation" width="100%" cellspacing="0" cellpadding="0" style="max-width: 600px; background-color: #ffffff; border-radius: 12px; overflow: hidden; border: 1px solid #e7e5e4; box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05);">
                    
                    <!-- Header -->
                    <tr>
                        <td style="background-color: #1c1917; padding: 24px; text-align: left; border-bottom: 3px solid #d97706;">
                            <span style="color: #f59e0b; font-size: 11px; font-weight: bold; letter-spacing: 2px; text-transform: uppercase; display: block; margin-bottom: 4px;">Website Lembah Desa</span>
                            <h1 style="color: #ffffff; font-size: 20px; font-weight: bold; margin: 0; font-family: Georgia, serif;">Pesan Masuk Baru</h1>
                        </td>
                    </tr>

                    <!-- Isi Data Kontak -->
                    <tr>
                        <td style="padding: 24px;">
                            <table role="presentation" width="100%" cellspacing="0" cellpadding="0">
                                
                                <!-- Nama -->
                                <tr>
                                    <td style="padding-bottom: 16px;">
                                        <span style="font-size: 11px; font-weight: 700; color: #78716c; text-transform: uppercase; letter-spacing: 0.5px; display: block; margin-bottom: 4px;">Nama Pengirim</span>
                                        <div style="font-size: 15px; color: #1c1917; font-weight: 600;">{{ $contactMessage->nama }}</div>
                                    </td>
                                </tr>

                                <!-- Email -->
                                <tr>
                                    <td style="padding-bottom: 16px;">
                                        <span style="font-size: 11px; font-weight: 700; color: #78716c; text-transform: uppercase; letter-spacing: 0.5px; display: block; margin-bottom: 4px;">Alamat Email</span>
                                        <div style="font-size: 15px;">
                                            <a href="mailto:{{ $contactMessage->email }}" style="color: #d97706; text-decoration: none; font-weight: 600;">{{ $contactMessage->email }}</a>
                                        </div>
                                    </td>
                                </tr>

                                <!-- Pesan -->
                                <tr>
                                    <td style="padding-top: 8px;">
                                        <span style="font-size: 11px; font-weight: 700; color: #78716c; text-transform: uppercase; letter-spacing: 0.5px; display: block; margin-bottom: 8px;">Isi Pesan</span>
                                        <div style="background-color: #fafaf9; border: 1px solid #e7e5e4; border-left: 4px solid #d97706; border-radius: 6px; padding: 16px; font-size: 14px; line-height: 1.6; color: #292524; white-space: pre-line;">{!! nl2br(e($contactMessage->pesan)) !!}</div>
                                    </td>
                                </tr>

                            </table>
                        </td>
                    </tr>

                    <!-- Footer -->
                    <tr>
                        <td style="background-color: #fafaf9; padding: 16px 24px; text-align: center; border-top: 1px solid #e7e5e4;">
                            <p style="font-size: 12px; color: #a8a29e; margin: 0; line-height: 1.5;">
                                Email ini dikirim otomatis dari Form Kontak Website <strong>Lembah Desa</strong>.<br>
                                Tekan tombol <em>Reply / Balas</em> pada aplikasi email Anda untuk merespons pesan ini secara langsung.
                            </p>
                        </td>
                    </tr>

                </table>
            </td>
        </tr>
    </table>
</body>
</html>