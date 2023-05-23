<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>{{ config('app.name') }}</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
        {{-- font --}}
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Cairo&display=swap" rel="stylesheet">
        <style>
            body {
                font-family: 'Cairo', sans-serif;
                background-color: #f0f0f0;
            }
        </style>
        @yield('style')
        {{-- script --}}
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body dir="rtl" style="text-align: right">

        <div>
            @include('partials.navbar')

            <main class="py-4 mb-5">
                <div class="container">
                    <div class="row">


                        @yield('content')
                    </div>
                </div>
            </main>
            @include('partials.footer')
        </div>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
        {{-- font awesome --}}
        <script src="https://kit.fontawesome.com/160daa7df6.js" crossorigin="anonymous"></script>
        @yield('script')
    </body>
</html>