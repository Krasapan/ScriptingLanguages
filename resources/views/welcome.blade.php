@extends('layouts.app')

@section('title', 'Krasapan\'s Games — Game Development Studio')

@section('content')

    <style>
        /* ===== HERO ===== */

        .hero {
            padding: 70px 0 80px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 60px;
        }

        .hero-text {
            max-width: 650px;
        }

        .hero-label {
            display: inline-block;
            margin-bottom: 18px;

            font-size: 13px;
            font-weight: 600;
            letter-spacing: 2px;
            text-transform: uppercase;

            color: #6c63ff;
        }

        .hero h1 {
            margin: 0 0 20px;

            font-size: 52px;
            line-height: 1.08;
            font-weight: 400;
            letter-spacing: -1px;
        }

        .hero h1 span {
            color: #6c63ff;
        }

        .hero p {
            margin: 0 0 30px;

            max-width: 560px;

            color: #666;
            font-size: 18px;
            line-height: 1.6;
        }

        .hero-button {
            display: inline-block;

            padding: 13px 25px;

            background: #6c63ff;
            color: white;

            text-decoration: none;

            border-radius: 6px;

            font-size: 14px;
            font-weight: 500;

            transition: 0.2s;
        }

        .hero-button:hover {
            background: #574fd6;
        }


        /* ===== DECORATIVE GAME AREA ===== */

        .game-preview {
            width: 360px;
            height: 240px;

            flex-shrink: 0;

            border-radius: 12px;

            background:
                linear-gradient(135deg, #171725, #29294a);

            position: relative;

            overflow: hidden;

            box-shadow: 0 15px 40px rgba(0, 0, 0, 0.15);
        }

        .game-preview::before {
            content: "";

            position: absolute;

            width: 180px;
            height: 180px;

            border-radius: 50%;

            background: #6c63ff;

            opacity: 0.25;

            top: -50px;
            right: -30px;
        }

        .game-preview::after {
            content: "";

            position: absolute;

            width: 120px;
            height: 120px;

            border-radius: 50%;

            background: #ff6584;

            opacity: 0.2;

            bottom: -50px;
            left: -30px;
        }

        .game-screen {
            position: absolute;

            left: 35px;
            right: 35px;
            top: 35px;
            bottom: 35px;

            border: 1px solid rgba(255,255,255,0.15);
            border-radius: 8px;

            display: flex;
            align-items: center;
            justify-content: center;

            color: white;

            font-size: 15px;
            letter-spacing: 1px;
        }


        /* ===== SECTION ===== */

        .section {
            padding: 60px 0;
        }

        .section-title {
            margin: 0 0 10px;

            font-size: 30px;
            font-weight: 400;
        }

        .section-description {
            margin: 0 0 35px;

            color: #777;
            font-size: 15px;
        }


        /* ===== FEATURES ===== */

        .features {
            display: grid;

            grid-template-columns:
            repeat(3, 1fr);

            gap: 20px;
        }

        .feature {
            padding: 28px;

            border: 1px solid #e8e8e8;
            border-radius: 8px;

            background: #fff;
        }

        .feature-icon {
            width: 42px;
            height: 42px;

            margin-bottom: 20px;

            border-radius: 8px;

            background: #f0efff;

            display: flex;
            align-items: center;
            justify-content: center;

            color: #6c63ff;

            font-size: 20px;
        }

        .feature h3 {
            margin: 0 0 10px;

            font-size: 18px;
            font-weight: 500;
        }

        .feature p {
            margin: 0;

            color: #777;

            font-size: 14px;
            line-height: 1.6;
        }


        /* ===== PROJECTS ===== */

        .projects {
            display: grid;

            grid-template-columns:
            repeat(3, 1fr);

            gap: 20px;
        }

        .project {
            overflow: hidden;

            border-radius: 8px;

            border: 1px solid #e8e8e8;

            background: white;
        }

        .project-image {
            height: 150px;

            background: linear-gradient(
                135deg,
                #20202e,
                #48486a
            );

            display: flex;
            align-items: center;
            justify-content: center;

            color: white;

            font-size: 16px;
            font-weight: 500;
        }

        .project:nth-child(2) .project-image {
            background: linear-gradient(
                135deg,
                #25384a,
                #496b7e
            );
        }

        .project:nth-child(3) .project-image {
            background: linear-gradient(
                135deg,
                #402b3d,
                #754d68
            );
        }

        .project-info {
            padding: 20px;
        }

        .project-info h3 {
            margin: 0 0 8px;

            font-size: 17px;
            font-weight: 500;
        }

        .project-info p {
            margin: 0;

            color: #777;

            font-size: 13px;
            line-height: 1.5;
        }


        /* ===== TECHNOLOGIES ===== */

        .technologies {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
        }

        .technology {
            padding: 9px 15px;

            border: 1px solid #ddd;
            border-radius: 20px;

            color: #555;

            font-size: 13px;
        }


        /* ===== CTA ===== */

        .cta {
            margin: 40px 0 20px;

            padding: 45px;

            border-radius: 10px;

            background: #171725;

            color: white;

            text-align: center;
        }

        .cta h2 {
            margin: 0 0 12px;

            font-size: 28px;
            font-weight: 400;
        }

        .cta p {
            margin: 0 0 25px;

            color: #bdbdcc;

            font-size: 14px;
        }


        /* ===== MOBILE ===== */

        @media (max-width: 800px) {

            .hero {
                flex-direction: column;
                align-items: flex-start;
            }

            .game-preview {
                width: 100%;
            }

            .features,
            .projects {
                grid-template-columns: 1fr;
            }

            .hero h1 {
                font-size: 40px;
            }
        }
    </style>


    <!-- HERO -->

    <section class="hero">

        <div class="hero-text">

            <div class="hero-label">
                Independent Game Studio
            </div>

            <h1>
                We create worlds<br>
                <span>worth playing.</span>
            </h1>

            <p>
                Krasapan's Games — невелика команда розробників,
                яка створює атмосферні відеоігри, експериментує
                з новими механіками та перетворює ідеї на ігрові світи.
            </p>

            <a href="#projects" class="hero-button">
                Наші проєкти
            </a>

        </div>


        <div class="game-preview">

            <div class="game-screen">
                Krasapan's Games
            </div>

        </div>

    </section>


    <!-- ABOUT -->

    <section class="section">

        <h2 class="section-title">
            Що ми робимо
        </h2>

        <p class="section-description">
            Повний цикл розробки сучасних відеоігор.
        </p>


        <div class="features">

            <div class="feature">

                <div class="feature-icon">
                    ◈
                </div>

                <h3>
                    Game Design
                </h3>

                <p>
                    Розробляємо концепції, ігрові механіки,
                    рівні та системи прогресії.
                </p>

            </div>


            <div class="feature">

                <div class="feature-icon">
                    ◆
                </div>

                <h3>
                    Development
                </h3>

                <p>
                    Створюємо ігри від першого прототипу
                    до готового продукту.
                </p>

            </div>


            <div class="feature">

                <div class="feature-icon">
                    ✦
                </div>

                <h3>
                    Art & Audio
                </h3>

                <p>
                    Формуємо візуальний стиль, атмосферу
                    та звукове оформлення ігор.
                </p>

            </div>

        </div>

    </section>


    <!-- PROJECTS -->

    <section class="section" id="projects">

        <h2 class="section-title">
            Наші проєкти
        </h2>

        <p class="section-description">
            Кілька вигаданих прикладів проєктів студії.
        </p>


        <div class="projects">

            <div class="project">

                <div class="project-image">
                    PLACEHOLDER GAME 1
                </div>

                <div class="project-info">

                    <h3>
                        Placeholder Game 1
                    </h3>

                    <p>
                        Placeholder Game 1 Description
                    </p>

                </div>

            </div>


            <div class="project">

                <div class="project-image">
                    PLACEHOLDER GAME 2
                </div>

                <div class="project-info">

                    <h3>
                        Placeholder Game 2
                    </h3>

                    <p>
                        Placeholder Game 2 Description
                    </p>

                </div>

            </div>


            <div class="project">

                <div class="project-image">
                    PLACEHOLDER GAME 3
                </div>

                <div class="project-info">

                    <h3>
                        Placeholder Game 3
                    </h3>

                    <p>
                        Placeholder Game 3 Description
                    </p>

                </div>

            </div>

        </div>

    </section>


    <!-- TECHNOLOGIES -->

    <section class="section">

        <h2 class="section-title">
            Технології
        </h2>

        <p class="section-description">
            Інструменти, які використовуються в процесі розробки.
        </p>

        <div class="technologies">

            <div class="technology">Unity</div>
            <div class="technology">Unreal Engine</div>
            <div class="technology">C#</div>
            <div class="technology">C++</div>
            <div class="technology">Blender</div>
            <div class="technology">Git</div>
            <div class="technology">Laravel</div>

        </div>

    </section>


    <!-- CTA -->

    <section class="cta">

        <h2>
            Маєте ідею для гри?
        </h2>

        <p>
            Розкажіть нам про свій проєкт — можливо,
            саме він стане нашою наступною грою.
        </p>

        <a href="{{ url('/contact') }}" class="hero-button">
            Зв'язатися з нами
        </a>

    </section>

@endsection
