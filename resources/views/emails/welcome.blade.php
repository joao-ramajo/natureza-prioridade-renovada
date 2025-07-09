<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Bem-vindo à NPR</title>
</head>
<body style="font-family: Arial, sans-serif; background-color: #f4f4f4; padding: 20px; color: #333;">
    <table width="100%" cellpadding="0" cellspacing="0" style="max-width: 600px; margin: 0 auto; background-color: #ffffff; border-radius: 8px; box-shadow: 0 2px 4px rgba(0,0,0,0.1);">
        <tr>
            <td style="background-color: #4CAF50; padding: 20px 30px; border-top-left-radius: 8px; border-top-right-radius: 8px;">
                <h1 style="color: #ffffff; margin: 0;">🌱 Bem-vindo à NPR!</h1>
            </td>
        </tr>
        <tr>
            <td style="padding: 30px;">
                <p style="font-size: 16px;">Olá <strong>{{ $name }}</strong>,</p>

                <p style="font-size: 16px; line-height: 1.6;">
                    Seja muito bem-vindo(a) à <strong>Natureza Prioridade Renovada (NPR)</strong>! 🌿<br><br>
                    Estamos muito felizes em ter você conosco nesta jornada por um mundo mais consciente e sustentável. Nosso objetivo é conectar pessoas e iniciativas que compartilham o mesmo propósito: <strong>transformar atitudes em prol do meio ambiente</strong>.
                </p>

                <p style="font-size: 16px; line-height: 1.6;">
                    Através da nossa plataforma, você poderá cadastrar, visualizar e encontrar pontos de coleta, contribuindo diretamente para o reaproveitamento e descarte correto de resíduos.
                </p>

                <blockquote style="font-style: italic; color: #555; margin: 20px 0; padding-left: 20px; border-left: 4px solid #4CAF50;">
                    "Juntos, acreditamos que pequenas ações geram grandes mudanças. E é com a sua participação que essa transformação começa."
                </blockquote>

                <p style="font-size: 16px;">
                    Caso tenha dúvidas ou sugestões, estamos sempre à disposição!
                </p>

                <p style="margin-top: 30px; font-size: 16px;">
                    Com carinho,<br>
                    <strong>Equipe NPR – Natureza Prioridade Renovada</strong><br>
                    🌎 Por um futuro mais verde, hoje.
                </p>
            </td>
        </tr>
        <tr>
            <td style="background-color: #f0f0f0; text-align: center; padding: 20px; border-bottom-left-radius: 8px; border-bottom-right-radius: 8px; font-size: 12px; color: #888;">
                © {{ date('Y') }} Natureza Prioridade Renovada. Todos os direitos reservados.
            </td>
        </tr>
    </table>
</body>
</html>
