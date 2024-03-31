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
    </div>
    <div class="">
    {{QrCode::size(100)->generate('https://google.com')}}
</div>
    {{-- <img src="" height="" alt=""> --}}
</body>
</html>

<style>
.certificate {
  width: 100vw;
  height: 100vh;
  background: url("https://i.pinimg.com/736x/11/56/79/11567993d33bc440f521f1e868f187db.jpg") no-repeat;
  background-size: 100% 100%;
     }
</style>