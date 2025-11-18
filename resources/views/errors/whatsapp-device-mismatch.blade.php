<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dispositivo Não Autorizado - SecretárIA do Corretor</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body {
            background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        .error-card {
            background: white;
            border-radius: 20px;
            box-shadow: 0 10px 40px rgba(0,0,0,0.2);
            max-width: 500px;
            width: 90%;
            padding: 2.5rem;
            text-align: center;
        }
        .error-icon {
            width: 100px;
            height: 100px;
            background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 1.5rem;
        }
        .error-icon i {
            font-size: 3rem;
            color: white;
        }
        .error-title {
            font-size: 1.75rem;
            font-weight: bold;
            color: #333;
            margin-bottom: 1rem;
        }
        .error-message {
            color: #666;
            font-size: 1rem;
            line-height: 1.6;
            margin-bottom: 2rem;
        }
        .info-box {
            background: #fff3cd;
            border-left: 4px solid #ffc107;
            border-radius: 10px;
            padding: 1rem;
            margin-bottom: 1.5rem;
            text-align: left;
        }
        .info-box h6 {
            font-weight: 600;
            margin-bottom: 0.5rem;
            color: #856404;
        }
        .info-box ul {
            margin: 0;
            padding-left: 1.5rem;
            color: #856404;
        }
        .info-box ul li {
            margin-bottom: 0.25rem;
        }
        .btn-primary {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border: none;
            border-radius: 10px;
            padding: 0.75rem 2rem;
            font-size: 1rem;
            font-weight: 600;
            color: white;
            text-decoration: none;
            display: inline-block;
            transition: transform 0.2s;
        }
        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(102, 126, 234, 0.4);
        }
    </style>
</head>
<body>
    <div class="error-card">
        <div class="error-icon">
            <i class="fas fa-mobile-alt"></i>
        </div>
        <h1 class="error-title">Dispositivo Não Autorizado</h1>
        <p class="error-message">
            {{ $message ?? 'Este dispositivo não corresponde ao registrado no sistema. Por motivos de segurança, não é possível acessar com este aparelho.' }}
        </p>

        <div class="info-box">
            <h6><i class="fas fa-info-circle me-2"></i>Para acessar novamente:</h6>
            <ul>
                <li>Use o mesmo dispositivo móvel que você utilizou anteriormente</li>
                <li>Ou solicite um novo link de acesso através do WhatsApp</li>
                <li>Certifique-se de estar usando um dispositivo móvel (celular ou tablet)</li>
            </ul>
        </div>

        <a href="https://wa.me/" class="btn btn-primary">
            <i class="fab fa-whatsapp me-2"></i>Solicitar Novo Link
        </a>

        <div class="text-center mt-3">
            <small class="text-muted">
                <i class="fas fa-shield-alt me-1"></i>
                Proteção de segurança ativada
            </small>
        </div>
    </div>
</body>
</html>


