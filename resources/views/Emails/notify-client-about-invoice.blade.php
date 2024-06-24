<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Repair notification</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            padding: 20px;
        }

        .notification {
            background-color: #fff;
            border-radius: 5px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            padding: 20px;
            margin-bottom: 20px;
        }

        .notification h2 {
            color: #333;
            margin-top: 0;
        }

        .notification p {
            color: #666;
            line-height: 1.5;
        }

        .notification a {
            color: #3498db;
            text-decoration: none;
        }

        .notification a:hover {
            text-decoration: underline;
        }
    </style>

</head>

<body>
    <div class="notification">
        <h2>{{ $mailData['title'] }}</h2>
        <p>Your Invoice#{{ $mailData['invoice_id'] }} is ready to be payed please pay it as soon as possible , check out
            your dahsboard.</p>
        <p>If you have any questions or concerns, please contact us at <a
                href="mailto:support@example.com">support@example.com</a>.</p>
    </div>
</body>

</html>
