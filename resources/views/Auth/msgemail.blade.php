<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modèle de courrier électronique</title>
    <style>
        /* Définissez vos styles CSS ici */
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            padding: 20px;
        }
        .email-container {
            background-color: #ffffff;
            border-radius: 5px;
            padding: 20px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }
        .email-container p {
            font-size: 16px;
            line-height: 1.5;
            margin-bottom: 15px;
        }
        .email-container a {
            background-color: #007bff;
            color: #ffffff;
            text-decoration: none;
            padding: 10px 20px;
            border-radius: 3px;
            display: inline-block;
        }
    </style>
</head>
<body>
    <div class="email-container">
        <p>Bonjour {{ $user->name }},</p>

        <p>Nous avons reçu une demande de réinitialisation de votre mot de passe. Cliquez sur le bouton ci-dessous pour le réinitialiser :</p>

        <a href="{{ url('changepass/'. $user->remember_token) }}">Réinitialiser votre mot de passe</a>
        <br>
        <br>
        <p>Si vous n'avez pas demandé de réinitialisation de mot de passe, vous pouvez ignorer cet e-mail.</p>

        <p>Si vous avez des questions, n'hésitez pas à nous contacter.</p>

        <p>Merci,<br>Location Hakimi</p>
    </div>
</body>
</html>
