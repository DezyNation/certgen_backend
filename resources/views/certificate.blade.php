<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Cerificate</title>
</head>

<body>
    <div class="certificate">
        <img src={{ asset($image) }}>
        <div class="qr">
            <p style="text-align: center; font-size: 12px; margin-bottom: 4px;">Scan QR Code to verify certificate</p>
            <img src="data:image/png;base64, {{ $qrcode}}" alt="QR Code">
        </div>
        <h1 class="user_name">{{$user_name}}</h1>
        <h5 class="event_name">{{$event_name}}</h5>
    </div>
</body>

</html>

<style>
    @page { size: 1500px 1040px; }

    *{
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }
    .certificate {
        position: relative;
    }
    .qr {
        position: absolute;
        top: {{$qr_y}}px;
        left: {{$qr_x}}px;
        width: {{$qr_size}}px;
        background-color: #FFF;
        color: #000;
    }

    .user_name {
        position: absolute;
        top: {{$name_y}}px;
        left: {{$name_x}}px;
        font-size: {{$name_size}}px;
    }

    .event_name {
        position: absolute;
        top: {{$event_y}}px;
        left: {{$event_x}}px;
        font-size: {{$event_size}}px;
    }
</style>