<!DOCTYPE html>
<html lang="pt_BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <title>Cadastro de Produtos</title>
    <meta name="csrf" content="{{ csrf_token() }}">
    <style>
        body {
            padding: 20px;
        }

        .navbar {
            margin-bottom: 20px;
        }

    </style>
</head>

<body>
    <div class="container">
        @component('componente-navbar', ['current' => $current])

        @endcomponent
        <main role="main">
            @hasSection ('body')

                @yield('body')

            @endif
        </main>
    </div>

    <script src="{{ asset('js/app.js') }}" type="text/javascript"></script>

    @hasSection ('javascript')
        @yield('javascript')
    @else

    @endif
</body>

</html>
