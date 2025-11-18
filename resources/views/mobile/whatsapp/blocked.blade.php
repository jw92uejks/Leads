<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Acesso Bloqueado - SecretárIA do Corretor</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body {
            background: linear-gradient(135deg, #dc3545 0%, #c82333 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        .blocked-card {
            background: white;
            border-radius: 20px;
            box-shadow: 0 10px 40px rgba(0,0,0,0.3);
            max-width: 500px;
            width: 90%;
            padding: 2rem;
        }
        .blocked-icon {
            width: 100px;
            height: 100px;
            background: linear-gradient(135deg, #dc3545 0%, #c82333 100%);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 1.5rem;
        }
        .blocked-icon i {
            font-size: 3rem;
            color: white;
        }
        .blocked-title {
            font-size: 1.75rem;
            font-weight: bold;
            color: #333;
            margin-bottom: 1rem;
            text-align: center;
        }
        .blocked-text {
            color: #666;
            line-height: 1.6;
            margin-bottom: 1.5rem;
        }
        .info-box {
            background: #f8f9fa;
            border-left: 4px solid #dc3545;
            padding: 1rem;
            margin-bottom: 1.5rem;
            border-radius: 5px;
        }
        .steps {
            counter-reset: step-counter;
            list-style: none;
            padding-left: 0;
        }
        .steps li {
            counter-increment: step-counter;
            margin-bottom: 1rem;
            padding-left: 2.5rem;
            position: relative;
        }
        .steps li::before {
            content: counter(step-counter);
            position: absolute;
            left: 0;
            top: 0;
            width: 30px;
            height: 30px;
            background: linear-gradient(135deg, #dc3545 0%, #c82333 100%);
            border-radius: 50%;
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
        }
        .btn-primary {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border: none;
            padding: 0.75rem 2rem;
            font-weight: 500;
            transition: transform 0.2s;
        }
        .btn-primary:hover {
            transform: translateY(-2px);
            background: linear-gradient(135deg, #764ba2 0%, #667eea 100%);
        }
        .security-footer {
            text-align: center;
            margin-top: 2rem;
            padding-top: 1.5rem;
            border-top: 1px solid #dee2e6;
        }
    </style>
</head>
<body>
    <div class="blocked-card">
        <div class="blocked-icon">
            <i class="fas fa-shield-alt"></i>
        </div>

        <h1 class="blocked-title">Acesso Bloqueado</h1>

        <p class="blocked-text text-center">
            Detectamos uma tentativa de acesso de um dispositivo não autorizado.
            Por questões de segurança, seu acesso via WhatsApp foi temporariamente bloqueado.
        </p>

        <div class="info-box">
            <h6 class="fw-bold mb-2">
                <i class="fas fa-info-circle me-2"></i>Por que isso aconteceu?
            </h6>
            <p class="mb-0 small">
                O sistema detectou que o dispositivo ou número de telefone utilizado não corresponde ao registrado anteriormente.
                Isso pode acontecer se você trocou de celular ou está tentando acessar de outro aparelho.
            </p>
        </div>

        <h6 class="fw-bold mb-3">
            <i class="fas fa-unlock-alt me-2"></i>Como Desbloquear:
        </h6>

        <ol class="steps">
            <li>Acesse o sistema pelo computador ou navegador</li>
            <li>Vá em <strong>Perfil → Segurança WhatsApp</strong></li>
            <li>Autorize o novo dispositivo com sua senha</li>
        </ol>

        <div class="d-grid gap-2 mt-4">
            <a href="{{ route('login') }}" class="btn btn-primary btn-lg">
                <i class="fas fa-sign-in-alt me-2"></i>Acessar Sistema Web
            </a>
        </div>

        <div class="security-footer">
            <small class="text-muted">
                <i class="fas fa-lock me-1"></i>
                Sua segurança é nossa prioridade
            </small>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

