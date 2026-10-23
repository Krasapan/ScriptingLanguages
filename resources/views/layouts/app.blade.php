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

        /* Головний контейнер пагінації: вирівнюємо все по одній лінії */
        nav[role="navigation"] {
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            gap: 15px;
            margin-top: 20px;
            font-size: 14px;
        }

        /* Вирівнювання внутрішніх блоків (текст «Showing...» та кнопки) */
        nav[role="navigation"] > div {
            display: flex;
            align-items: center;
            gap: 8px;
            flex-wrap: wrap;
        }

        /* Стиль для всіх кнопок, посилань та неактивних елементів пагінації */
        nav[role="navigation"] a,
        nav[role="navigation"] span {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            height: 34px;
            padding: 0 12px;
            border-radius: 4px;
            text-decoration: none;
            box-sizing: border-box;
            transition: background 0.2s, color 0.2s;
        }

        /* 1. КОЛІР НЕАКТИВНОГО ТЕКСТУ ТА ПОСИЛАНЬ (звичайні цифри, Previous, Next) */
        nav[role="navigation"] a {
            color: #ffffff !important; /* Білий текст, щоб було видно на темному фоні */
            background-color: rgba(255, 255, 255, 0.1); /* Легкий фон для клікабельних елементів */
        }

        /* Ефект наведення миші на неактивне посилання */
        nav[role="navigation"] a:hover {
            background-color: rgba(255, 255, 255, 0.2);
        }

        /* Текст інформації (наприклад, "Showing 1 to 5 of 6 results") */
        nav[role="navigation"] p.text-sm {
            color: #cccccc !important; /* Світло-сірий колір для загального тексту */
            margin: 0;
        }

        /* 2. КОЛІР АКТИВНОГО ЕЛЕМЕНТА (поточна сторінка, наприклад, "2") */
        nav[role="navigation"] span[aria-current="page"] span,
        nav[role="navigation"] span.active {
            background-color: #6c63ff !important; /* Фіолетовий колір активної сторінки */
            color: #ffffff !important;            /* Білий текст активної сторінки */
            font-weight: bold;
        }

        /* 3. НЕАКТИВНІ КНОПКИ (коли перелистувати далі неможливо) */
        nav[role="navigation"] span[aria-disabled="true"] {
            color: #777777 !important;            /* Приглушений сірий колір */
            background-color: rgba(255, 255, 255, 0.05);
            opacity: 0.6;
            cursor: not-allowed;
        }

        /* Обмеження розміру стрілок SVG всередині пагінації */
        nav[role="navigation"] svg {
            width: 32px !important;
            height: 32px !important;
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
    <a href="{{ route('beta-testers.index') }}">Бета-тестувальники</a>
    <a href="{{ route('site.about') }}">Про компанію</a>
    <a href="{{ route('site.contact') }}">Контакти</a>
    <a href="{{ route('entry.form') }}">Форма</a>
    <a href="{{ route('site.say') }}">Привіт</a>
    <a href="{{ route('country.index') }}">Країни</a>
</nav>

<main>
    @yield('content')
</main>

<footer>
    &copy; {{ date('Y') }} Krasapan's Games
</footer>

</body>
</html>
