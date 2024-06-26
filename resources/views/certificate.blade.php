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
            <div style="width: 100%; display: grid; place-content: center;">
                <img src="data:image/png;base64, {{ $qrcode }}" alt="QR Code">
            </div>
            <p style="text-align: center; font-size: 12px; margin-top: 4px;">{{ $certificate_id }}</p>
        </div>
        <div class="user_name">
            <h1 style="text-align: center;">{{ $user_name }}</h1>
        </div>
        <h5 class="event_name">{{ $event_name }}</h5>

    </div>
</body>

</html>

<style>
    @import '/storage/fonts/Poppins-Medium.ttf';

    @page {
        size: 1500px 1061px;
    }
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }

    .certificate {
        position: relative;
    }

    .qr {
        position: absolute;

        top: {{ $qr_y }}px;

        left: {{ $qr_x }}px;
        padding: 8px;
        background-color: #FFF;
        color: #000;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
    }

    .user_name {
        position: absolute;
        width: 1500px !important;
        top: {{ $name_y }}px;
        left: 0;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        font-family: "Poppins", sans-serif;
        font-weight: 500;
        font-style: normal;
    }

    .user_name>h1 {
        font-size: {{ $name_size }}px;

        color: {{ $receiver_name_color }};
        text-align: center;
    }

    .event_name {
        font-family: "Poppins", sans-serif;
        font-weight: 500;
        font-style: normal;
        position: absolute;
        top: {{ $event_y }}px;
        left: {{ $event_x }}px;
        font-size: {{ $event_size }}px;
        color: {{ $event_name_color }};
        text-align: center;
    }
</style>
