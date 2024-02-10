<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />

    <!-- Styles -->
    <style>
        @import url('https://fonts.googleapis.com/css?family=Karla:400,700&display=swap');
        .font-family-karla { font-family: karla; }
        .bg-sidebar { background: #3d68ff; }
        .cta-btn { color: #3d68ff; }
        .upgrade-btn { background: #1947ee; }
        .upgrade-btn:hover { background: #0038fd; }
        .active-nav-link { background: #1947ee; }
        .nav-item:hover { background: #1947ee; }
        .account-link:hover { background: #3d68ff; }
        .flex-parent-element {
            display: flex;
            width: 50%;
        }

        .flex-child-element {
            flex: 1;
            margin: 10px;
        }

        .flex-child-element:first-child {
            margin-right: 20px;
        }
        .container {
            display: block;
            position: relative;
            padding-left: 35px;
            margin-bottom: 12px;
            cursor: pointer;
            font-size: 22px;
            -webkit-user-select: none;
            -moz-user-select: none;
            -ms-user-select: none;
            user-select: none;
        }

        /* Hide the browser's default checkbox */
        .container input {
            position: absolute;
            opacity: 0;
            cursor: pointer;
            height: 0;
            width: 0;
        }

        /* Create a custom checkbox */
        .checkmark {
            position: absolute;
            top: 0;
            left: 0;
            height: 25px;
            width: 25px;
            background-color: #eee;
        }

        /* On mouse-over, add a grey background color */
        .container:hover input ~ .checkmark {
            background-color: #ccc;
        }

        /* When the checkbox is checked, add a blue background */
        .container input:checked ~ .checkmark {
            background-color: #2196F3;
        }

        /* Create the checkmark/indicator (hidden when not checked) */
        .checkmark:after {
            content: "";
            position: absolute;
            display: none;
        }

        /* Show the checkmark when checked */
        .container input:checked ~ .checkmark:after {
            display: block;
        }

        /* Style the checkmark/indicator */
        .container .checkmark:after {
            left: 9px;
            top: 5px;
            width: 5px;
            height: 10px;
            border: solid white;
            border-width: 0 3px 3px 0;
            -webkit-transform: rotate(45deg);
            -ms-transform: rotate(45deg);
            transform: rotate(45deg);
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
            <button class="w-full bg-white cta-btn font-semibold py-2 mt-5 rounded-br-lg rounded-bl-lg rounded-tr-lg shadow-lg hover:shadow-xl hover:bg-gray-300 flex items-center justify-center">
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
        <a href="/filter" class="flex items-center active-nav-link text-white py-4 pl-6 nav-item">
            <i class="fas fa-table mr-3"></i>
            Филтрирај граѓани
        </a>
        <a href="/cases" class="flex items-center text-white opacity-75 hover:opacity-100 py-4 pl-6 nav-item">
            <i class="fas fa-align-left mr-3"></i>
            Случаи
        </a>
        <a href="/finished_cases" class="flex items-center text-white opacity-75 hover:opacity-100 py-4 pl-6 nav-item">
            <i class="fas fa-calendar mr-3"></i>
            Архива
        </a>
    </nav>
    <a href="#" class="absolute w-full upgrade-btn bottom-0 active-nav-link text-white flex items-center justify-center py-4">
        <i class="fas fa-arrow-circle-up mr-3"></i>
        Поставки за профил
    </a>
</aside>

<div class="w-full flex flex-col h-screen overflow-y-hidden">
    <!-- Desktop Header -->
    <header class="w-full items-center bg-white py-2 px-6 hidden sm:flex">
        <div class="w-1/2"></div>
        <div x-data="{ isOpen: false }" class="relative w-1/2 flex justify-end">
            <button @click="isOpen = !isOpen" class="realtive z-10 w-12 h-12 rounded-full overflow-hidden border-4 border-gray-400 hover:border-gray-300 focus:border-gray-300 focus:outline-none">
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
            <a href="/filter"  class="flex items-center active-nav-link text-white py-2 pl-4 nav-item">
                <i class="fas fa-table mr-3"></i>
                Филтрирај граѓани
            </a>
            <a href="/cases" class="flex items-center text-white opacity-75 hover:opacity-100 py-2 pl-4 nav-item">
                <i class="fas fa-align-left mr-3"></i>
                Случаи
            </a>

            <a href="/finished_cases" class="flex items-center text-white opacity-75 hover:opacity-100 py-2 pl-4 nav-item">
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
        <button class="w-full bg-white cta-btn font-semibold py-2 mt-5 rounded-br-lg rounded-bl-lg rounded-tr-lg shadow-lg hover:shadow-xl hover:bg-gray-300 flex items-center justify-center">
            <i class="fas fa-plus mr-3"></i> Нов извештај
        </button>
    </header>


    <main class="w-full flex-grow p-6">

        <h1 class="text-3xl text-black pb-6">Контролна табла</h1>
        <div style="width: 600px">
            <form action="/filter" method="post">
                @csrf
                <div class="relative">
                    <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                        <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                        </svg>
                    </div>

                    <label for="embg" class="mb-2 text-sm font-medium text-gray-900 sr-only dark:text-white">Search</label>
                    <input type="text" id="embg" name="embg" class="block w-full p-4 ps-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Пребарај матичен број..." required>
                    <button type="submit" class="text-white absolute end-2.5 bottom-2.5 bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Search</button>
                </div>
            </form>
        </div>

        <div class="flex-parent-element">
            <h3>Возраст</h3>

            <div class="flex-child-element"> <label class="container">&lt;18 год
                    <input type="checkbox" checked="checked">
                    <span class="checkmark"></span>
                </label>

                <label class="container"> 19-25
                    <input type="checkbox">
                    <span class="checkmark"></span>
                </label>

                <label class="container">26-60
                    <input type="checkbox">
                    <span class="checkmark"></span>
                </label>

                <label class="container">60+
                    <input type="checkbox">
                    <span class="checkmark"></span>
                </label>
            </div>
            <h3>Пол</h3>
            <div class="flex-child-element">
                <label class="container">М
                    <input type="checkbox" checked="checked">
                    <span class="checkmark"></span>
                </label>

                <label class="container">Ж
                    <input type="checkbox">
                    <span class="checkmark"></span>
                </label>
            </div>
        </div>



            <div class="bg-white overflow-auto max-h-96">
                <table class="min-w-full bg-white">
                    <thead class="bg-gray-800 text-white">
                    <tr>
                        <th class="text-left py-3 px-4 uppercase font-semibold text-sm">ЕМБГ</th>
                        <th class="w-1/3 text-left py-3 px-4 uppercase font-semibold text-sm">Име</th>
                        <th class="w-1/3 text-left py-3 px-4 uppercase font-semibold text-sm">Презиме</th>
                        <th class="w-1/3 text-left py-3 px-4 uppercase font-semibold text-sm">Пол</th>
                        <th class="w-1/3 text-left py-3 px-4 uppercase font-semibold text-sm">Адреса</th>
                        <th class="w-1/3 text-left py-3 px-4 uppercase font-semibold text-sm">Држава</th>
                        <th class="w-1/3 text-left py-3 px-4 uppercase font-semibold text-sm">Националност</th>
                        <th class="text-left py-3 px-4 uppercase font-semibold text-sm">Телефон</th>
                    </tr>
                    </thead>
                    <tbody class="text-gray-700">

                    @foreach($peoples as $people)
                        <tr>
                            <td class="w-1/3 text-left py-3 px-4">{{$people->embg}}</td>
                            <td class="w-1/3 text-left py-3 px-4">{{$people->first_name}}</td>
                            <td class="w-1/3 text-left py-3 px-4">{{$people->last_name}}</td>
                            <td class="w-1/3 text-left py-3 px-4">{{$people->gender}}</td>
                            <td class="w-1/3 text-left py-3 px-4">{{$people->address}}</td>
                            <td class="w-1/3 text-left py-3 px-4">{{$people->country}}</td>
                            <td class="w-1/3 text-left py-3 px-4">{{$people->nationality}}</td>
                            <td class="text-left py-3 px-4"><a class="hover:text-blue-500" href="tel:622322662">{{$people->contact}}</a></td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </main>
</div>


<!-- AlpineJS -->
<script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js" defer></script>
<!-- Font Awesome -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/js/all.min.js" integrity="sha256-KzZiKy0DWYsnwMF+X1DvQngQ2/FxF7MF3Ff72XcpuPs=" crossorigin="anonymous"></script>
<!-- ChartJS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.js" integrity="sha256-R4pqcOYV8lt7snxMQO/HSbVCFRPMdrhAFMH+vr9giYI=" crossorigin="anonymous"></script>

</body>
</html>
