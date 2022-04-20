<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ config('app.name') }} - Login</title>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <script src="https://kit.fontawesome.com/af0df7a416.js" crossorigin="anonymous"></script>
</head>
<body>

<div class="flex flex-row w-full">
    <div class="w-4/5"><section class="w-full h-screen">
            <img src="{{ asset('img/journalists.jpeg') }}" class="object-cover w-full h-full" alt="Image alt text" />
        </section></div>
    <div class="w-1/5 text-center justify-center items-center">
        <div class="p-5"><img src="{{ asset('img/logo.png') }}"></div>
        <div class="pt-28 ">
            <a href="{{ route('login.azure') }}"> <button
                class="w-3/5 bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline"
                type="submit">

                Aanmelden
            </button></a>
        </div>
    </div>
</div>

</body>
</html>
