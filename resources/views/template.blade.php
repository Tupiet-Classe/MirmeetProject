<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title')</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css"
        integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css" integrity="sha512-SzlrxWUlpfuzQ+pcUCosxcglQRNAq/DZjVsC0lE40xsADsfeQoEypE+enwcOiGjk/bSuGGKHEyjSoQ1zVisanQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link
        href="https://fonts.googleapis.com/css2?family=Comfortaa:wght@400;500;600&family=Familjen+Grotesk&display=swap"
        rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.3.min.js"
        integrity="sha256-pvPw+upLPUjgMXY0G+8O0xUf+/Im1MZjXxxgOcBQBXU=" crossorigin="anonymous"></script>


    @vite('resources/css/app.css')

</head>

<body class="flex flex-col h-screen max-h-screen bg-slate-200 overflow-x-hidden">
    @include('components.header')

    <main
        class="main-heigth h-full w-full px-3 flex flex-col items-center gap-3 overflow-y-scroll overflow-x-hidden font-body">
        <div id="app">
            @yield('content')
        </div>
    </main>

    @include('components.footer')
    @vite('resources/js/app.js')

    <script>
        $('body').css("max-height", $(window).outerHeight());
        $('body').css("min-height", $(window).outerHeight());
        $( window ).resize(function(e) {
            $('body').css("max-height", $(window).outerHeight());
            $('body').css("min-height", $(window).outerHeight());
        });
    </script>
</body>

</html>
