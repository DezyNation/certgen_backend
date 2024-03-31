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
            {{QrCode::size($qr_size)->generate(`https://certificate.itasinc.in/verify?cert_id={$cerificate_id}`)}}
        </div>
        <h1 class="user_name">{{$user_name}}</h1>
        <h5 class="event_name">{{$event_name}}</h5>
    </div>
</body>

</html>

<style>

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
        top: {{$qr_y}};
        left: {{$qr_x}};
        width: {{$qr_size}}px;
        background-color: #FFF;
        color: #000;
    }

    .user_name {
        position: absolute;
        top: {{$name_y}};
        left: {{$name_x}};
        font-size: {{$name_size}};
    }

    .event_name {
        position: absolute;
        top: {{$event_y}};
        left: {{$event_x}};
        font-size: {{$event_size}};
    }
</style>