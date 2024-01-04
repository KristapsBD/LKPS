<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Parcel Status Update</title>
    <style>
        body {
            font-family: sans-serif;
            line-height: 1.6;
            color: #333;
            background-color: #f4f4f4;
            padding: 20px;
            margin: 0;
        }

        .email-content {
            max-width: 600px;
            margin: 20px auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        p {
            margin-bottom: 15px;
        }

        ul {
            list-style-type: none;
            padding: 0;
            margin-bottom: 15px;
        }

        li {
            margin-bottom: 8px;
        }

        h1 {
            color: #3490dc;
        }
    </style>
</head>
<body>
<div class="email-content">
    <h1>Parcel Status Update</h1>

    <p>Dear Customer,</p>

    <p>Your parcel status has been updated:</p>
    <ul>
        <li>Parcel Tracking Code: {{ $parcel->tracking_code }}</li>
        <li>Status: {{ mapParcelStatusToValue($parcel->status) }}</li>
    </ul>

    <p>Thank you for choosing our service.</p>
</div>
</body>
</html>
