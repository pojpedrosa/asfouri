<!DOCTYPE html>
<html lang="pt">
<head><meta charset="utf-8"><meta name="viewport" content="width=device-width,initial-scale=1"></head>
<body style="margin:0;background:#f5efe1;font-family:-apple-system,Segoe UI,Roboto,Helvetica,Arial,sans-serif;color:#20160d;">
    <div style="max-width:520px;margin:0 auto;padding:40px 24px;">
        <p style="font-size:22px;font-weight:600;color:#2b1d12;margin:0 0 4px;">asfouri</p>
        <div style="background:#ffffff;border:1px solid #e9ddca;border-radius:16px;padding:32px;">
            <h1 style="font-size:20px;margin:0 0 12px;color:#20160d;">O seu link de acesso</h1>
            <p style="font-size:15px;line-height:1.6;color:#573c24;margin:0 0 8px;">
                Olá{{ $user->name ? ' '.$user->name : '' }}, clique no botão abaixo para entrar no back office da asfouri. Não precisa de palavra-passe.
            </p>
            <p style="text-align:center;margin:28px 0;">
                <a href="{{ $url }}" style="display:inline-block;background:#c05a36;color:#f5efe1;text-decoration:none;font-weight:600;font-size:15px;padding:14px 28px;border-radius:9999px;">Entrar no back office</a>
            </p>
            <p style="font-size:13px;line-height:1.6;color:#8f6c45;margin:0;">
                Este link é válido durante <strong>30 minutos</strong> e só pode ser usado uma vez. Se não pediu este acesso, ignore este email.
            </p>
            <p style="font-size:12px;line-height:1.5;color:#b3936a;margin:16px 0 0;word-break:break-all;">
                Ou copie este endereço: {{ $url }}
            </p>
        </div>
        <p style="font-size:12px;color:#b3936a;text-align:center;margin:20px 0 0;">asfouri · comunicação regenerativa</p>
    </div>
</body>
</html>
