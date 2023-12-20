{{--TODO ADD STYLING--}}
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Parcel Status Update</title>
</head>
<body style="font-family: sans-serif; line-height: 1.6; color: #333; background-color: #f4f4f4; padding: 20px;">

<p style="margin-bottom: 15px;">Dear Customer,</p>

<p style="margin-bottom: 15px;">Your parcel status has been updated:</p>

<ul style="list-style-type: none; padding: 0; margin-bottom: 15px;">
    <li style="margin-bottom: 8px;">Parcel Tracking Code: {{ $parcel->tracking_code }}</li>
    <li>Status: {{ mapParcelStatusToValue($parcel->status) }}</li>
</ul>

<p>Thank you for choosing our service.</p>

</body>
</html>
