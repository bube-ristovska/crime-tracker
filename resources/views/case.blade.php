<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet"/>

    <!-- Styles -->
    <style>
        @import url('https://fonts.googleapis.com/css?family=Karla:400,700&display=swap');

        .font-family-karla {
            font-family: karla;
        }

        .bg-sidebar {
            background: #3d68ff;
        }

        .cta-btn {
            color: #3d68ff;
        }

        .upgrade-btn {
            background: #1947ee;
        }

        .upgrade-btn:hover {
            background: #0038fd;
        }

        .active-nav-link {
            background: #1947ee;
        }

        .nav-item:hover {
            background: #1947ee;
        }

        .account-link:hover {
            background: #3d68ff;
        }

        .card {
            /* Add shadows to create the "card" effect */
            box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2);
            transition: 0.3s;
        }

        /* On mouse-over, add a deeper shadow */
        .card:hover {
            box-shadow: 0 8px 16px 0 rgba(0, 0, 0, 0.2);
        }

        /* Add some padding inside the card container */
        .kontainer {
            padding: 2px 16px;
        }
    </style>
    <script src="https://cdn.tailwindcss.com"></script>

</head>
<body class="bg-gray-100 font-family-karla flex">
<aside class="relative bg-sidebar h-screen w-64 hidden sm:block shadow-xl">
    <div class="p-6">
        @if (Session::get('is_policeman'))
            <a href="#" class="text-white text-3xl font-semibold uppercase hover:text-gray-300">Полицаец</a>
        @else
            <a href="#" class="text-white text-3xl font-semibold uppercase hover:text-gray-300">Началник</a>
            <button
                class="w-full bg-white cta-btn font-semibold py-2 mt-5 rounded-br-lg rounded-bl-lg rounded-tr-lg shadow-lg hover:shadow-xl hover:bg-gray-300 flex items-center justify-center">
                <i class="fas fa-plus mr-3"></i> <a href="/register-policeman">Додади полицаец</a>
            </button>
        @endif
    </div>
    <nav class="text-white text-base font-semibold pt-3">
        <a href="/" class="flex items-center text-white opacity-75 hover:opacity-100 py-4 pl-6 nav-item">
            <i class="fas fa-tachometer-alt mr-3"></i>
            Контролна табла
        </a>
        <a href="/employees" class="flex items-center text-white opacity-75 hover:opacity-100 py-4 pl-6 nav-item">
            <i class="fas fa-sticky-note mr-3"></i>
            Вработени
        </a>
        <a href="/filter" class="flex items-center text-white opacity-75 hover:opacity-100 py-4 pl-6 nav-item">
            <i class="fas fa-table mr-3"></i>
            Филтрирај граѓани
        </a>
        <a href="/cases" class="flex items-center active-nav-link text-white py-4 pl-6 nav-item">
            <i class="fas fa-align-left mr-3"></i>
            Случаи
        </a>
        <a href="/finished_cases" class="flex items-center text-white opacity-75 hover:opacity-100 py-4 pl-6 nav-item">
            <i class="fas fa-calendar mr-3"></i>
            Архива
        </a>
    </nav>
    <a href="#"
       class="absolute w-full upgrade-btn bottom-0 active-nav-link text-white flex items-center justify-center py-4">
        <i class="fas fa-arrow-circle-up mr-3"></i>
        Поставки за профил
    </a>
</aside>

<div class="w-full flex flex-col h-screen overflow-y-hidden">
    <!-- Desktop Header -->
    <header class="w-full items-center bg-white py-2 px-6 hidden sm:flex">
        <div class="w-1/2"></div>
        <div x-data="{ isOpen: false }" class="relative w-1/2 flex justify-end">
            <button @click="isOpen = !isOpen"
                    class="realtive z-10 w-12 h-12 rounded-full overflow-hidden border-4 border-gray-400 hover:border-gray-300 focus:border-gray-300 focus:outline-none">
                <img src="https://source.unsplash.com/uJ8LNVCBjFQ/400x400">
            </button>
            <button x-show="isOpen" @click="isOpen = false" class="h-full w-full fixed inset-0 cursor-default"></button>
            <div x-show="isOpen" class="absolute w-32 bg-white rounded-lg shadow-lg py-2 mt-16">
                <a href="#" class="block px-4 py-2 account-link hover:text-white">Профил</a>
                <a href="#" class="block px-4 py-2 account-link hover:text-white">Помош</a>
                <a href="/logout" class="block px-4 py-2 account-link hover:text-white">Одјави се</a>
            </div>
        </div>
    </header>

    <!-- Mobile Header & Nav -->
    <header x-data="{ isOpen: false }" class="w-full bg-sidebar py-5 px-6 sm:hidden">
        <div class="flex items-center justify-between">
            <a href="/" class="text-white text-3xl font-semibold uppercase hover:text-gray-300">Началник</a>
            <button @click="isOpen = !isOpen" class="text-white text-3xl focus:outline-none">
                <i x-show="!isOpen" class="fas fa-bars"></i>
                <i x-show="isOpen" class="fas fa-times"></i>
            </button>
        </div>

        <!-- Dropdown Nav -->
        <nav :class="isOpen ? 'flex': 'hidden'" class="flex flex-col pt-4">
            <a href="/" class="flex items-center text-white opacity-75 hover:opacity-100 py-2 pl-4 nav-item">
                <i class="fas fa-tachometer-alt mr-3"></i>
                Контролна табла
            </a>
            <a href="/employees" class="flex items-center text-white opacity-75 hover:opacity-100 py-2 pl-4 nav-item">
                <i class="fas fa-sticky-note mr-3"></i>
                Вработени
            </a>
            <a href="/filter" class="flex items-center text-white opacity-75 hover:opacity-100 py-2 pl-4 nav-item">
                <i class="fas fa-table mr-3"></i>
                Филтрирај граѓани
            </a>
            <a href="/cases" class="flex items-center active-nav-link text-white py-2 pl-4 nav-item">
                <i class="fas fa-align-left mr-3"></i>
                Случаи
            </a>


            <a href="/finished_cases"
               class="flex items-center text-white opacity-75 hover:opacity-100 py-2 pl-4 nav-item">
                <i class="fas fa-calendar mr-3"></i>
                Архива
            </a>
            <a href="/help" class="flex items-center text-white opacity-75 hover:opacity-100 py-2 pl-4 nav-item">
                <i class="fas fa-cogs mr-3"></i>
                Помош
            </a>
            <a href="/myprofile" class="flex items-center text-white opacity-75 hover:opacity-100 py-2 pl-4 nav-item">
                <i class="fas fa-user mr-3"></i>
                Мој профил
            </a>
            <a href="/logout" class="flex items-center text-white opacity-75 hover:opacity-100 py-2 pl-4 nav-item">
                <i class="fas fa-sign-out-alt mr-3"></i>
                Одјави се
            </a>

        </nav>
        <button
            class="w-full bg-white cta-btn font-semibold py-2 mt-5 rounded-br-lg rounded-bl-lg rounded-tr-lg shadow-lg hover:shadow-xl hover:bg-gray-300 flex items-center justify-center">
            <i class="fas fa-plus mr-3"></i> Нов извештај
        </button>
    </header>

    <div class="w-full overflow-x-hidden border-t flex flex-col">
        <main class="w-full flex-grow p-6">
            <h1 class="text-3xl text-black pb-6">Контролна табла</h1>

            <div class="flex flex-wrap mt-6">
                <div class="w-full lg:w-1/3 pr-0 lg:pr-2">
                    <p class="text-xl pb-3 flex items-center">
                        <i class="fas fa-plus mr-3"></i> Слики
                    </p>
                    <div class="p-6 bg-white">
                        <div>
                                @foreach($evidence as $ev)
                                        <img class=" w-full" alt="image" src="{{$ev->e_picture}}"/>
                                @endforeach
                        </div>
                    </div>
                </div>
                <div class="w-full lg:w-1/3 pl-0 lg:pl-2 mt-12 lg:mt-0">
                    <p class="text-xl pb-3 flex items-center">
                        <i class="fas fa-check mr-3"></i> Извештаи
                    </p>
                    <div class="p-6 bg-white">
                        <div class="border-b border-black-200 pb-6">
                            <p class="text-sm leading-none text-black-600 dark:text-black-300 ">
                                Датум: {{$case->opening_date}}</p>
                        </div>

                        <div class="py-4 border-b border-black-200 flex items-center justify-between">
                            <p class="text-base leading-4 text-black-800 dark:text-black-300">
                                {{ $case->c_status === 'A' ? 'Активен случај' : ($case->c_status === 'Z' ? 'Затворен случај' : 'Unknown Status') }}
                            </p>
                            <div class="flex items-center justify-center">
                                <p class="text-sm leading-none text-gray-600 dark:text-gray-300 mr-3">Контролен
                                    број:{{$case->c_id}}</p>

                            </div>
                        </div>
                        <p class="">
                            <img class="mr-3 dark:hidden"
                                 src="https://tuk-cdn.s3.amazonaws.com/can-uploader/svg1.svg" alt="location">
                            <img class="mr-3 hidden dark:block"
                                 src="https://tuk-cdn.s3.amazonaws.com/can-uploader/svg1dark.svg" alt="location">
                            {{$p_address}}
                        </p>
                        <div class="">
                            <button
                                class="bg-blue-500  focus:outline-none  focus:ring-blue-500 text-base flex items-center justify-center leading-none text-white bg-blue-500 w-full py-4 hover:bg-blue-700 focus:outline-none">
                                Изјави
                            </button>
                            <div>
                                @foreach($statements as $statement)
                                    <div class="container">

                                        <div class="card">
                                            <p class=" text-left py-3 px-4">{{$statement->statement_date}}</p>
                                            <p class=" text-left py-3 px-4">{{$statement->description}}</p>
                                            <p class=" text-left py-3 px-4">{{$statement->incident_place}}</p>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
                <div class="w-full lg:w-1/3 pl-0 lg:pl-2 mt-12 lg:mt-0">
                    <p class="text-xl pb-3 flex items-center">
                        <i class="fas fa-check mr-3"></i> Луѓе
                    </p>
                    <div class="p-6 bg-white">
                        <div x-data="{ isOpen: false }" class="relative flex justify-end">
                            <button @click="isOpen = !isOpen"
                                    class="bg-blue-500  focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 text-base flex items-center justify-center leading-none text-white bg-blue-500 w-full py-4 hover:bg-blue-700 focus:outline-none">
                                Инволвирани граѓани
                            </button>
                            <button x-show="isOpen" @click="isOpen = false"
                                    class="h-full w-full fixed inset-0 cursor-default"></button>
                            <div x-show="isOpen"
                                 class="absolute w-full bg-white rounded-lg shadow-lg py-2 mt-16 r bg-white border border-white-200 rounded-lg shadow text-black-900 md:flex-row md:max-w-xl hover:bg-white-100 dark:border-white-700 dark:bg-white-800 dark:hover:bg-white-700">
                                @foreach($victims as $victim)
                                    <a href="#"
                                       class="flex flex-col items-center bg-white border border-white-200 rounded-lg shadow text-black-900 md:flex-row md:max-w-xl hover:bg-white-100 dark:border-white-700 dark:bg-white-800 dark:hover:bg-white-700">
                                        <img
                                            class="object-cover w-full rounded-t-lg h-96 md:h-auto md:w-48 md:rounded-none md:rounded-s-lg"
                                            src="{{$victim->picture}}" alt="">
                                        <div class="flex flex-col justify-between text-dark-100 p-4 leading-normal">
                                            <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-black-100">{{$victim->first_name}} {{$victim->last_name}}</h5>
                                            <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">{{$victim->embg}}</p>
                                            <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">Жртва</p>
                                        </div>
                                    </a>
                                @endforeach
                                @foreach($witness as $w)
                                    <a href="#"
                                       class="flex flex-col items-center bg-white border border-white-200 rounded-lg shadow text-black-900 md:flex-row md:max-w-xl hover:bg-white-100 dark:border-white-700 dark:bg-white-800 dark:hover:bg-white-700">
                                        <img
                                            class="object-cover w-full rounded-t-lg h-96 md:h-auto md:w-48 md:rounded-none md:rounded-s-lg"
                                            src="{{$w->picture}}" alt="">
                                        <div class="flex flex-col justify-between text-dark-100 p-4 leading-normal">
                                            <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-black-100">{{$w->first_name}} {{$w->last_name}}</h5>
                                            <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">{{$w->embg}}</p>
                                            <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">Сведок</p>
                                        </div>
                                    </a>
                                @endforeach
                                <br>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


        </main>
{{--        <main class="w-full flex-grow p-6">--}}
{{--            <h1 class="text-3xl text-black pb-6">Контролна табла</h1>--}}
{{--            <div class="flex flex-wrap mt-6">--}}

{{--            <div class="w-full mt-12">--}}
{{--                <p class="text-xl pb-3 flex items-center">--}}
{{--                    <i class="fas fa-list mr-3"></i> {{$case->c_name}}--}}
{{--                </p>--}}
{{--            </div>--}}
{{--            <div class="flex mb-4">--}}
{{--                <div class="w-1/3 bg-gray-400 h-12">--}}
{{--                    <div>--}}
{{--                        @foreach($evidence as $ev)--}}
{{--                            <div class=" w-full md:block hidden">--}}
{{--                                <img class="mt-3 w-1/3" alt="image" src="{{$ev->e_picture}}"/>--}}
{{--                            </div>--}}
{{--                        @endforeach--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--                <div class="w-1/3 bg-gray-500 h-12">--}}
{{--                    <div class="border-b border-black-200 pb-6">--}}
{{--                        <p class="text-sm leading-none text-black-600 dark:text-black-300 ">--}}
{{--                            Датум: {{$case->opening_date}}</p>--}}
{{--                    </div>--}}

{{--                    <div class="py-4 border-b border-black-200 flex items-center justify-between">--}}
{{--                        <p class="text-base leading-4 text-black-800 dark:text-black-300">--}}
{{--                            {{ $case->c_status === 'A' ? 'Активен случај' : ($case->c_status === 'Z' ? 'Затворен случај' : 'Unknown Status') }}--}}
{{--                        </p>--}}
{{--                        <div class="flex items-center justify-center">--}}
{{--                            <p class="text-sm leading-none text-gray-600 dark:text-gray-300 mr-3">Контролен--}}
{{--                                број:{{$case->c_id}}</p>--}}

{{--                        </div>--}}
{{--                    </div>--}}
{{--                    <p class="">--}}
{{--                        <img class="mr-3 dark:hidden"--}}
{{--                             src="https://tuk-cdn.s3.amazonaws.com/can-uploader/svg1.svg" alt="location">--}}
{{--                        <img class="mr-3 hidden dark:block"--}}
{{--                             src="https://tuk-cdn.s3.amazonaws.com/can-uploader/svg1dark.svg" alt="location">--}}
{{--                        {{$p_address}}--}}
{{--                    </p>--}}
{{--                    <div class="">--}}
{{--                        <button--}}
{{--                            class="bg-blue-500  focus:outline-none  focus:ring-blue-500 text-base flex items-center justify-center leading-none text-white bg-blue-500 w-full py-4 hover:bg-blue-700 focus:outline-none">--}}
{{--                            Изјави--}}
{{--                        </button>--}}
{{--                        <div>--}}
{{--                            @foreach($statements as $statement)--}}
{{--                                <div class="container">--}}

{{--                                    <div class="card">--}}
{{--                                        <p class=" text-left py-3 px-4">{{$statement->statement_date}}</p>--}}
{{--                                        <p class=" text-left py-3 px-4">{{$statement->description}}</p>--}}
{{--                                        <p class=" text-left py-3 px-4">{{$statement->incident_place}}</p>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                            @endforeach--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--                <div class="w-1/3 bg-gray-400">--}}
{{--                    <div x-data="{ isOpen: false }" class="relative flex justify-end">--}}
{{--                        <button @click="isOpen = !isOpen"--}}
{{--                                class="bg-blue-500  focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 text-base flex items-center justify-center leading-none text-white bg-blue-500 w-full py-4 hover:bg-blue-700 focus:outline-none">--}}
{{--                            Инволвирани граѓани--}}
{{--                        </button>--}}
{{--                        <button x-show="isOpen" @click="isOpen = false"--}}
{{--                                class="h-full w-full fixed inset-0 cursor-default"></button>--}}
{{--                        <div x-show="isOpen"--}}
{{--                             class="absolute w-full bg-white rounded-lg shadow-lg py-2 mt-16 r bg-white border border-white-200 rounded-lg shadow text-black-900 md:flex-row md:max-w-xl hover:bg-white-100 dark:border-white-700 dark:bg-white-800 dark:hover:bg-white-700">--}}
{{--                            @foreach($victims as $victim)--}}
{{--                                <a href="#"--}}
{{--                                   class="flex flex-col items-center bg-white border border-white-200 rounded-lg shadow text-black-900 md:flex-row md:max-w-xl hover:bg-white-100 dark:border-white-700 dark:bg-white-800 dark:hover:bg-white-700">--}}
{{--                                    <img--}}
{{--                                        class="object-cover w-full rounded-t-lg h-96 md:h-auto md:w-48 md:rounded-none md:rounded-s-lg"--}}
{{--                                        src="{{$victim->picture}}" alt="">--}}
{{--                                    <div class="flex flex-col justify-between text-dark-100 p-4 leading-normal">--}}
{{--                                        <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-black-100">{{$victim->first_name}} {{$victim->last_name}}</h5>--}}
{{--                                        <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">{{$victim->embg}}</p>--}}
{{--                                        <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">Жртва</p>--}}
{{--                                    </div>--}}
{{--                                </a>--}}
{{--                            @endforeach--}}
{{--                            @foreach($witness as $w)--}}
{{--                                <a href="#"--}}
{{--                                   class="flex flex-col items-center bg-white border border-white-200 rounded-lg shadow text-black-900 md:flex-row md:max-w-xl hover:bg-white-100 dark:border-white-700 dark:bg-white-800 dark:hover:bg-white-700">--}}
{{--                                    <img--}}
{{--                                        class="object-cover w-full rounded-t-lg h-96 md:h-auto md:w-48 md:rounded-none md:rounded-s-lg"--}}
{{--                                        src="{{$w->picture}}" alt="">--}}
{{--                                    <div class="flex flex-col justify-between text-dark-100 p-4 leading-normal">--}}
{{--                                        <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-black-100">{{$w->first_name}} {{$w->last_name}}</h5>--}}
{{--                                        <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">{{$w->embg}}</p>--}}
{{--                                        <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">Сведок</p>--}}
{{--                                    </div>--}}
{{--                                </a>--}}
{{--                            @endforeach--}}
{{--                            <br>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--            </div>--}}
{{--        </main>--}}
    </div>
</div>

<!-- AlpineJS -->
<script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js" defer></script>
<!-- Font Awesome -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/js/all.min.js"
        integrity="sha256-KzZiKy0DWYsnwMF+X1DvQngQ2/FxF7MF3Ff72XcpuPs=" crossorigin="anonymous"></script>
<!-- ChartJS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.js"
        integrity="sha256-R4pqcOYV8lt7snxMQO/HSbVCFRPMdrhAFMH+vr9giYI=" crossorigin="anonymous"></script>

</body>
</html>
