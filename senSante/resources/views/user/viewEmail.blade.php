<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Votre Sujet d'E-mail</title>
    <style>
        /* Styles généraux */
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            background-color: #f5f5f5;
            margin: 0;
            padding: 0;
            -webkit-text-size-adjust: none;
            -ms-text-size-adjust: none;
            width: 100% !important;
        }
        table {
            width: 100%;
            margin: 20px auto;
            background-color: #ffffff;
            border-collapse: collapse;
            border-spacing: 0;
            max-width: 600px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
        }
        th, td {
            padding: 20px;
            text-align: left;
            border-bottom: 1px solid #dddddd;
            text-align: center;

        }
        th {
            background-color: #f2f2f2;
            font-weight: bold;
            text-align: center;
        }
        /* En-tête */
        .header {
            background-color: #007bff;
            color: #ffffff;
            text-align: center;
            padding: 15px 0;
        }
        .header h1 {
            margin: 0;
            font-size: 24px;
        }
        /* Corps du message */
        .content {
            padding: 20px;
        }
        .content p {
            margin: 0 0 15px 0;
        }
        /* Pied de page */
        .footer {
            text-align: center;
            padding: 10px;
            font-size: 12px;
            color: #666666;
        }
    </style>
</head>
<body>
    <!-- En-tête de l'e-mail -->
    <div class="header">
        <h1>{{$subject}}</h1>
    </div>

    <div class="content">
        <p>Bonjour,</p>
        <table>
            <thead>
                <tr>
                    <th>{{$titre}}</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($messages as $message)
                <tr>
                    <td>{{$message}}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- Pied de page de l'e-mail -->
    <div class="footer">
        <p>Ceci est un e-mail généré automatiquement. Merci de ne pas répondre.</p>
    </div>
</body>
</html>
