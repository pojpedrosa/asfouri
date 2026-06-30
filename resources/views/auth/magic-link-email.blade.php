<!DOCTYPE html>
<html lang="pt">
<head><meta charset="utf-8"><meta name="viewport" content="width=device-width,initial-scale=1"></head>
<body style="margin:0;background:#f7f3eb;font-family:-apple-system,Segoe UI,Roboto,Helvetica,Arial,sans-serif;color:#14141d;">
    <div style="max-width:520px;margin:0 auto;padding:40px 24px;">
        <p style="font-size:22px;font-weight:600;color:#0000f3;margin:0 0 4px;">asfouri</p>
        <div style="background:#ffffff;border:1px solid #b6c7e5;border-radius:16px;padding:32px;">
            <h1 style="font-size:20px;margin:0 0 12px;color:#0000f3;">O seu link de acesso</h1>
            <p style="font-size:15px;line-height:1.6;color:#14141d;margin:0 0 8px;">
                Olá{{ $user->name ? ' '.$user->name : '' }}, clique no botão abaixo para entrar no back office da asfouri. Não precisa de palavra-passe.
            </p>
            <p style="text-align:center;margin:28px 0;">
                <a href="{{ $url }}" style="display:inline-block;background:#0000f3;color:#f7f3eb;text-decoration:none;font-weight:600;font-size:15px;padding:14px 28px;border-radius:9999px;">Entrar no back office</a>
            </p>
            <p style="font-size:13px;line-height:1.6;color:#5b5b6b;margin:0;">
                Este link é válido durante <strong>30 minutos</strong> e só pode ser usado uma vez. Se não pediu este acesso, ignore este email.
            </p>
            <p style="font-size:12px;line-height:1.5;color:#8a8a98;margin:16px 0 0;word-break:break-all;">
                Ou copie este endereço: {{ $url }}
            </p>
        </div>
        <p style="font-size:12px;color:#8a8a98;text-align:center;margin:20px 0 0;">asfouri · comunicação regenerativa</p>
    </div>
</body>
</html>
