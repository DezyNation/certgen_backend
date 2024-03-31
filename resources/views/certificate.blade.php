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
            {{QrCode::size($data['qr_size'])->generate(`https://certificate.itasinc.in/verify?cert_id={$data['cerificate_id']}`)}}
        </div>
        <h1 class="user_name">{{$data['user_name']}}</h1>
        <h5 class="event_name">{{$data['event_name']}}</h5>
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
        top: {{$data['qr_y']}};
        left: {{$data['qr_x']}};
        width: {{$data['qr_size']}}px;
        background-color: #FFF;
        color: #000;
    }

    .user_name {
        position: absolute;
        top: {{$data['name_y']}};
        left: {{$data['name_x']}};
        font-size: {{$data['name_size']}};
    }

    .event_name {
        position: absolute;
        top: {{$data['event_y']}};
        left: {{$data['event_x']}};
        font-size: {{$data['event_size']}};
    }
</style>