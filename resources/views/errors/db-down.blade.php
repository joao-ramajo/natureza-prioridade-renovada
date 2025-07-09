{{-- resources/views/errors/db-down.blade.php --}}

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>NPR - Banco de Dados Indisponível</title>
    <!-- Bootstrap CSS (v5) -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet" />
    <style>
        body {
            background-color: #e6f4ea; /* Verde bem claro */
            color: #2e7d32; /* Verde escuro */
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        .error-container {
            text-align: center;
            max-width: 400px;
            padding: 30px 25px;
            border-radius: 12px;
            background-color: #ffffff; /* branco */
            box-shadow: 0 0 20px rgba(46, 125, 50, 0.2);
        }
        .project-name {
            font-weight: 700;
            font-size: 1.5rem;
            margin-bottom: 15px;
            color: #1b5e20; /* verde ainda mais escuro */
            letter-spacing: 2px;
        }
        .error-icon {
            font-size: 5rem;
            margin-bottom: 25px;
            color: #388e3c; /* verde médio */
        }
        h1 {
            font-weight: 600;
            margin-bottom: 20px;
        }
        p {
            font-size: 1.1rem;
            line-height: 1.4;
        }
    </style>
</head>
<body>
    <div class="error-container shadow-sm">
        <div class="project-name">Natureza Prioridade Renovada (NPR)</div>
        <i class="bi bi-database-fill-exclamation error-icon"></i>
        <h1>Banco de Dados Indisponível</h1>
        <p>
            O sistema não conseguiu se conectar ao banco de dados.<br />
            Por favor, tente novamente mais tarde.
        </p>
    </div>
</body>
</html>
