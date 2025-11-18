<!DOCTYPE html>
<html lang="pt-BR">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>{{ config("app.name", "Ondeal") }} | Registro apagado</title>
  <style>
    body,
    html {
      height: 100%;
      margin: 0;
      font-family: Arial, sans-serif;
    }

    .background {
      background-image: url("{{ asset('assets/images/bb.jpg') }}");
      height: 100%;
      background-position: center;
      background-repeat: no-repeat;
      background-size: cover;
      display: flex;
      align-items: center;
      justify-content: center;
      text-align: center;
    }

    .message {
      background-color: rgba(0, 0, 0, 0.5);
      color: white;
      padding: 20px;
      border-radius: 10px;
    }

    @media (max-width: 768px) {
      .message {
        font-size: 1rem;
        padding: 15px;
      }
    }
  </style>
</head>

<body>
  <div class="background">
    <div class="message">
      <h1 class="text-danger">Dados permanentemente </br> excluídos com sucesso!</h1>
      <p>Obrigado pelo tempo que trabalhamos juntos...</p>
      <p>A {{ config("app.name", "Ondeal") }} estará sempre de portas abertas para você. Desejamos muito sucesso em sua nova caminhada.</p>
    </div>
  </div>
</body>

</html>