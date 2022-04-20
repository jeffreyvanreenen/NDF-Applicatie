<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <script src="https://kit.fontawesome.com/af0df7a416.js" crossorigin="anonymous"></script>
</head>
<body>
<div class="flex flex-row h-screen">
    <div class="flex flex-col w-16 justify-between items-center pt-8 pb-8 bg-gray-100 flex-none">
        <div class="flex flex-col space-y-2 justify-center">
        <a href="#"><div class="w-8 h-8 text-center hover:bg-amber-300 hover:rounded-full"><i class="fa-solid fa-house"></i></div></a>
        <a href="#"><div class="w-8 h-8 text-center hover:bg-amber-300 hover:rounded-full"><i class="fa-solid fa-newspaper"></i></div></a>
        <a href="#"><div class="rounded-full bg-gray-300 w-8 h-8"></div></a>
        <a href="#"><div class="rounded-full bg-gray-300 w-8 h-8"></div></a>
        <a href="#"><div class="rounded-full bg-gray-300 w-8 h-8"></div></a>
        <a href="#"><div class="rounded-full bg-gray-300 w-8 h-8"></div></a>
        <a href="#"><div class="rounded-full bg-gray-300 w-8 h-8"></div></a>
        </div>
        <div class="flex flex-col space-y-2">
        <a href="#"><div class="rounded-full bg-gray-300 w-8 h-8"></div></a>
        <a href="#"><div class="rounded-full bg-gray-300 w-8 h-8"></div></a>
        <a href="#"><div class="rounded-full bg-gray-300 w-8 h-8"></div></a>
        </div>
    </div>


    <div class="flex flex-col w-64 flex-none">
        <div class="p-4"><img src="{{ asset('img/logo.png') }}"> </div>
        <div class=""><hr></div>

        <div class="p-4">
            <div class=""><a href="{{ route('nieuws') }}">Nieuwsberichten</a></div>
            <div class=""><a href="{{ route('rssfeeds') }}">RSS Feeds</a></div>
            <div class=""><a href="{{ route('search-terms-index') }}">Zoektermen</a></div>
        </div>

    </div>
    <div class="flex-auto p-4 border-2 rounded-l-lg overflow-y-auto" style="background-image: url(https://static.intercomassets.com/ember/assets/images/messenger-backgrounds/background-1-99a36524645be823aabcd0e673cb47f8.png)">@yield('content')</div>
</div>


</body>
</html>
