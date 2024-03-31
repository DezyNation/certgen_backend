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
        <img src="https://api.itasinc.in/template/eOWbVUrE6cNZD90I38AtVk6K75zs1zK3T7Fq6eee.png">
        <div class="qr">
            <p style="text-align: center; font-size: 12px; margin-bottom: 4px;">Scan QR Code to verify certificate</p>
            {{QrCode::size(100)->generate('https://certificate.itasinc.in/verify?cert_id=cert_id')}}
        </div>
        <h1 class="user_name">User Name</h1>
        <h5 class="event_name">Event Name</h5>
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
        top: 700px;
        left: 800px;
        width: 100px;
        background-color: #FFF;
        color: #000;
    }

    .user_name {
        position: absolute;
        top: 0px;
        left: 0px;
        font-size: 48px;
    }

    .event_name {
        position: absolute;
        top: 0px;
        left: 0px;
        font-size: 24px;
    }
</style>