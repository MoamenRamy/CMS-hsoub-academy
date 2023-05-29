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

        <style>
            body {
                font-family: 'Cairo', sans-serif;
                background-color: #f0f0f0;
                position: relative;
            }

            a {
                text-decoration: none !important;
                color: black;
            }

            ol, ul, menu {
                list-style: decimal !important;
                padding-right: 2rem !important;
            }

            ul, menu {
                list-style: inside !important;
                padding-right: 2rem !important;
            }

            input[type=file] {
                position: absolute !important;
                width: 100% !important;
                height: 100% !important;
                top: 0;
                left: 0;
                right: 0;
                bottom: 0;
                opacity: 0;
                cursor: pointer;
            }

            .input-title {
                width: 100%;
                padding: 30px;
                background: rgba(255,255,255,0.2);
                border: 2px dashed rgba(255,255,255,0.2);
                text-align: center;
                transition: background 0.3s ease-in-out;
            }

            .file-area:hover .input-title {
                background: rgba(255,255,255,0.1);
            }

            input[type=file] + .input-title {
                border-color: #f0f0f0;
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
                        @include('alerts.success')

                        @yield('content')
                    </div>
                </div>
            </main>
            @include('partials.footer')
        </div>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
        {{-- font awesome --}}
        <script src="https://kit.fontawesome.com/160daa7df6.js" crossorigin="anonymous"></script>
        {{-- ckeditor --}}
        <script src="https://cdn.ckeditor.com/ckeditor5/38.0.1/classic/ckeditor.js"></script>

        {{-- jquery cdn --}}
        <script src="https://code.jquery.com/jquery-3.7.0.js" integrity="sha256-JlqSTELeR4TLqP0OG9dxM7yDPqX1ox/HfgiSLBj8+kM=" crossorigin="anonymous"></script>
        @yield('script')
    </body>
</html>
