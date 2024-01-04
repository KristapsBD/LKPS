<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Parcel Creation Notification</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
            color: #333;
        }

        .container {
            max-width: 600px;
            margin: 20px auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h1 {
            color: #3490dc;
        }

        p {
            margin-bottom: 15px;
        }

        a {
            color: #3490dc;
            text-decoration: none;
        }

        a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
<div class="container">
    <h1>Parcel Creation Notification</h1>

    <p>Hey {{ $parcel->sender->name }},</p>

    <p>Your parcel has been created!</p>

    <p>You can use this tracking code {{ $parcel->tracking_code }}, to track your parcel on <a href="https://logisticsandcourier.com/track">the tracking page</a>.</p>

    <p>Thank you and have a nice day!</p>
</div>
</body>
</html>
