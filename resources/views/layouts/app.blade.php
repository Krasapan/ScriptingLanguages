<!DOCTYPE html>
<html lang="uk">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>@yield('title', 'Лабораторний практикум')</title>

    <style>
        /* Загальні налаштування сторінки */
        html, body {
            margin: 0;
            padding: 0;
            min-height: 100%;
        }

        body {
            font-family: Arial, sans-serif;
            background-color: #ffffff;
            color: #222222;

            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }


        /* =========================
           ГОЛОВНЕ МЕНЮ
           ========================= */

        nav {
            background-color: #2d3a4d;
            height: 45px;

            display: flex;
            align-items: center;

            padding-left: 27px;
        }

        nav a {
            color: #eeeeee;
            text-decoration: none;

            font-size: 14px;
            font-weight: 300;

            margin-right: 28px;
        }

        nav a:hover {
            color: #ffffff;
        }


        /* =========================
           ОСНОВНИЙ ВМІСТ
           ========================= */

        main {
            width: 100%;
            max-width: 1200px;

            margin: 0 auto;
            padding: 40px 30px;

            box-sizing: border-box;

            flex: 1;
        }

        main h1 {
            margin: 0 0 18px 0;

            font-size: 28px;
            font-weight: 300;
        }

        main p {
            margin: 0 0 8px 0;

            font-size: 16px;
            line-height: 1.4;
        }


        /* =========================
           FOOTER
           ========================= */

        footer {
            background-color: #2d3a4d;
            color: #eeeeee;

            text-align: center;

            padding: 18px 20px;

            font-size: 14px;

            margin-top: auto;
        }
    </style>
</head>

<body>

<nav>
    <a href="{{ route('home') }}">Головна</a>
    <a href="{{ route('landing') }}">Бета-тест</a>
    <a href="{{ route('site.about') }}">Про компанію</a>
    <a href="{{ route('site.contact') }}">Контакти</a>
    <a href="{{ route('entry.form') }}">Форма</a>
    <a href="{{ route('site.say') }}">Привіт</a>
</nav>

<main>
    @yield('content')
</main>

<footer>
    &copy; {{ date('Y') }} Krasapan's Games
</footer>

</body>
</html>
