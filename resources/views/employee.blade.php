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
        /* styles.css */
        #clickableTable tr {
            cursor: pointer;
            transition: background-color 0.2s ease;
        }

        #clickableTable tr:hover {
            background-color: #d7d4d4;
        }
        /* styles.css */
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .employee-details {
            background: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            max-width: 800px;
            width: 100%;
            text-align: left;
        }

        .employee-card {
            display: flex;
            align-items: center;
            gap: 20px;
        }

        .employee-photo img {
            border-radius: 50%;
            width: 150px;
            height: 150px;
            object-fit: cover;
        }

        .employee-info p {
            margin: 8px 0;
        }

        .employee-info p strong {
            display: inline-block;
            width: 150px;
        }

        .back-button {
            display: inline-block;
            margin-top: 20px;
            padding: 10px 15px;
            background-color: #007bff;
            color: white;
            text-decoration: none;
            border-radius: 5px;
        }

        .back-button:hover {
            background-color: #0056b3;
        }
        .cases-card {
            margin-top: 20px;
        }

        .case-card {
            background-color: #f9f9f9;
            border: 1px solid #ddd;
            border-radius: 5px;
            margin-bottom: 10px;
            padding: 10px;
            cursor: pointer;
            transition: all 0.3s;
        }

        .case-card:hover {
            background-color: #f1f1f1;
        }

        .case-details {
            display: none;
            padding: 10px;
        }

        .case-card.active .case-details {
            display: block;
        }

        .case-card .case-title {
            font-weight: bold;
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
        <a href="/employees" class="flex items-center active-nav-link text-white py-4 pl-6 nav-item">
            <i class="fas fa-sticky-note mr-3"></i>
            Вработени
        </a>
        <a href="/filter" class="flex items-center text-white opacity-75 hover:opacity-100 py-4 pl-6 nav-item">
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
    <a href="#"
       class="absolute w-full upgrade-btn bottom-0 active-nav-link text-white flex items-center justify-center py-4">
        <i class="fas fa-arrow-circle-up mr-3"></i>


    </a>
</aside>

<div class="w-full flex flex-col h-screen overflow-y-hidden">
    <!-- Desktop Header -->
    <header class="w-full items-center bg-white py-2 px-6 hidden sm:flex">
        <div class="w-1/2"></div>
        <div x-data="{ isOpen: false }" class="relative w-1/2 flex justify-end">
            <button @click="isOpen = !isOpen"
                    class="realtive z-10 w-12 h-12 rounded-full overflow-hidden border-4 border-gray-400 hover:border-gray-300 focus:border-gray-300 focus:outline-none">
                @php
                    $person = DB::select('select * from people where pe_id=:pe_id;', ['pe_id' => Session::get('pe_id')]);

                    if (!empty($person)) {
                        $image = $person[0]->picture;
                    } else {
                        $image = null;
                    }
                @endphp

                <img src="{{ $image }}">

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
            <a href="/employees" class="flex items-center active-nav-link text-white py-2 pl-4 nav-item">
                <i class="fas fa-sticky-note mr-3"></i>
                Вработени
            </a>
            <a href="/filter" class="flex items-center text-white opacity-75 hover:opacity-100 py-2 pl-4 nav-item">
                <i class="fas fa-table mr-3"></i>
                Филтрирај граѓани
            </a>
            <a href="/cases" class="flex items-center text-white opacity-75 hover:opacity-100 py-2 pl-4 nav-item">
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
            <h1 class="text-3xl text-black pb-6">Вработен: {{$employee->first_name}}</h1>





            <div class="w-full flex flex-col sm:flex-row h-screen overflow-y-hidden">
                <main class="w-full sm:w-2/4 flex-grow p-6">
                    <div class="employee-details">
                        <h1>Детали за вработениот</h1>
                        <div class="employee-card">
                            <div class="employee-photo">
                                <img src="{{ $employee->picture }}" alt="Фотографија на вработениот">
                            </div>
                            <div class="employee-info">
                                <p><strong>Име:</strong> {{ $employee->first_name }}</p>
                                <p><strong>Презиме:</strong> {{ $employee->last_name }}</p>
                                <p><strong>Пол:</strong> {{ $employee->gender }}</p>
                                <p><strong>Адреса:</strong> {{ $employee->address }}</p>
                                <p><strong>Контакт:</strong> {{ $employee->contact }}</p>
                                <p><strong>ЕМБГ:</strong> {{ $employee->embg }}</p>
                                <p><strong>Дата на раѓање:</strong> {{ $employee->date_of_birth }}</p>
                                <p><strong>Држава:</strong> {{ $employee->country }}</p>
                                <p><strong>Националност:</strong> {{ $employee->nationality }}</p>
                                <p><strong>Број на значка:</strong> {{ $employee->badge_no }}</p>
                                <p><strong>Дата на вработување:</strong> {{ $employee->p_date_of_employment }}</p>
                                <p><strong>Ранг:</strong> {{ $employee->rank }}</p>
                                <p><strong>Адреса на полициска станица:</strong> {{ $p_address }}</p>
                            </div>
                        </div>
                        <a href="{{ url()->previous() }}" class="back-button">Назад</a>

                    </div>
                </main>

                <aside class="sm:w-2/4">
                    <h2>Случаи на вработениот</h2>
                    <div class="cases-card p-6">
                        @foreach($cases as $case)
                            <div class="case-card" onclick="toggleDetails(this)">
                                <div class="case-title">{{ $case->description }}</div>
                                <div class="case-details">
                                    <p><strong>Идентификација на изјава:</strong> {{ $case->s_id }}</p>
                                    <p><strong>Дата на изјава:</strong> {{ $case->statement_date }}</p>
                                    <p><strong>Време на инцидент:</strong> {{ $case->incident_timestamp }}</p>
                                    <p><strong>Место на инцидент:</strong> {{ $case->incident_place }}</p>
                                    <p><strong>Идентификација на случај:</strong> {{ $case->c_id }}</p>
                                    <p><strong>Жртва ИД:</strong> {{ $case->victim_pe_id }}</p>
                                    <p><strong>Сведок ИД:</strong> {{ $case->witness_pe_id }}</p>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </aside>
            </div>

        </main>


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
<script>
    function toggleDetails(element) {
        element.classList.toggle('active');
    }
</script>
</body>
</html>
