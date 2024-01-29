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
    </style>
    <script src="https://cdn.tailwindcss.com"></script>

</head>
<body class="bg-gray-100 font-family-karla flex">
<aside class="relative bg-sidebar h-screen w-64 hidden sm:block shadow-xl">
    <div class="p-6">
        <a href="#" class="text-white text-3xl font-semibold uppercase hover:text-gray-300">Началник</a>
        <button class="w-full bg-white cta-btn font-semibold py-2 mt-5 rounded-br-lg rounded-bl-lg rounded-tr-lg shadow-lg hover:shadow-xl hover:bg-gray-300 flex items-center justify-center">
            <i class="fas fa-plus mr-3"></i> Додади полицаец
        </button>
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
        <a href="/cases"  class="flex items-center active-nav-link text-white py-4 pl-6 nav-item">
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
                <a href="#" class="block px-4 py-2 account-link hover:text-white">Одјави се</a>
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
            <a href="/"  class="flex items-center text-white opacity-75 hover:opacity-100 py-2 pl-4 nav-item">
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

    <div class="w-full overflow-x-hidden border-t flex flex-col">
        <main class="w-full flex-grow p-6">
            <h1 class="text-3xl text-black pb-6">Контролна табла</h1>



            <div class="w-full mt-12">
                <p class="text-xl pb-3 flex items-center">
                    <i class="fas fa-list mr-3"></i> Случаj Подморница
                </p>
                <div class="bg-white overflow-auto">
                    <div class="md:flex items-start justify-center py-12 2xl:px-20 md:px-6 px-4">
                        <div class="xl:w-2/6 lg:w-2/5 w-80 md:block hidden">
                            <img class="w-full" alt="image of a girl posing" src="data:image/jpeg;base64,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" />
                            <img class="mt-6 w-full" alt="image of a girl posing" src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQaSnnhWXrRlhi9Md9mu8L5BvAPFBo_lI8Pyw&usqp=CAU" />
                        </div>
                        <div class="md:hidden">
                            <img class="w-full" alt="image of a girl posing" src="https://i.ibb.co/QMdWfzX/component-image-one.png" />
                            <div class="flex items-center justify-between mt-3 space-x-4 md:space-x-0">
                                <img alt="image-tag-one" class="md:w-48 md:h-48 w-full" src="https://i.ibb.co/cYDrVGh/Rectangle-245.png" />
                                <img alt="image-tag-one" class="md:w-48 md:h-48 w-full" src="https://i.ibb.co/f17NXrW/Rectangle-244.png" />
                                <img alt="image-tag-one" class="md:w-48 md:h-48 w-full" src="https://i.ibb.co/cYDrVGh/Rectangle-245.png" />
                                <img alt="image-tag-one" class="md:w-48 md:h-48 w-full" src="https://i.ibb.co/f17NXrW/Rectangle-244.png" />
                            </div>
                        </div>
                        <div class="xl:w-2/5 md:w-1/2 lg:ml-8 md:ml-6 md:mt-0 mt-6">
                            <div class="border-b border-black-200 pb-6">
                                <p class="text-sm leading-none text-black-600 dark:text-black-300 ">Полицаец на случајот: Петко Митрев</p>
                            </div>
                            <div class="py-4 border-b border-black-200 flex items-center justify-between">
                                <p class="text-base leading-4 text-black-800 dark:text-black-300"><button  class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Изјави</button></p>

                                <p class="text-base leading-4 text-black-800 dark:text-black-300"><button  class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Докази</button></p>

                            </div>
                            <div class="py-4 border-b border-black-200 flex items-center justify-between">
                                <p class="text-base leading-4 text-black-800 dark:text-black-300">Активен случај</p>
                                <div class="flex items-center justify-center">
                                    <p class="text-sm leading-none text-gray-600 dark:text-gray-300 mr-3">38.2</p>

                                    <img class="dark:hidden" src="https://tuk-cdn.s3.amazonaws.com/can-uploader/productDetail3-svg2.svg" alt="next">
                                    <img class="hidden dark:block" src="https://tuk-cdn.s3.amazonaws.com/can-uploader/productDetail3-svg2dark.svg" alt="next">
                                </div>
                            </div>
                            <button class="dark:bg-white dark:text-black-900 dark:hover:bg-black-100 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-800 text-base flex items-center justify-center leading-none text-white bg-gray-800 w-full py-4 hover:bg-gray-700 focus:outline-none">
                                <img class="mr-3 dark:hidden" src="https://tuk-cdn.s3.amazonaws.com/can-uploader/svg1.svg" alt="location">
                                <img class="mr-3 hidden dark:block" src="https://tuk-cdn.s3.amazonaws.com/can-uploader/svg1dark.svg" alt="location">
                               ул.Рузвелтова бр.23 Скопје
                            </button>
                            <div>
                                <p class="xl:pr-55 text-base lg:leading-tight leading-normal text-black-600 dark:text-black-300 mt-7">Додека автобусот се движеше по својата маршрута, мистериозниот патник, со лице заматено од сенки, се движеше кон задниот дел. Меѓу патниците беа разменети неколку љубопитни погледи, но повеќето беа изгубени во сопствените мисли, исцрпени по долг ден.

                                    Одеднаш, атмосферата се промени. Мистериозната фигура, која сега стои на патеката, откри блескав нож. Меѓу патниците настанала паника кога ја сфатиле тежината на ситуацијата. Возачот на автобусот, внимателен, удрил на сопирачките, со што автобусот запрел.

                                    Напаѓачот со злобно блесок во очите барал внимание од сите. Со ладен, пресметан глас, ја објавија намерата да извлечат пакет скриен меѓу патниците. Страв и збунетост се проширија низ автобусот додека патниците си разменија уплашени погледи.

                                    Меѓу патниците беше и една млада жена по име Марија, која се враќаше дома од својата работа доцна во ноќта. Без да знае, предметниот пакет бил сокриен во нејзиниот ранец. Напаѓачот, управуван од непознат мотив, тргнал кон Марија, а сјајот на ножот фрлал морничав сјај во слабо осветлениот автобус.

                                    Како што ескалираа тензиите, на бродот се нашол пензиониран детектив по име Роберт. Имајќи инстинкт за неволја, тој ја процени ситуацијата и дискретно ја набљудуваше драмата што се одвиваше. Чувствувајќи ја опасноста, тој суптилно им сигнализирал на другите патници, охрабрувајќи ги да останат смирени додека тој формулирал план.

                                    Марија, исплашена, но издржлива, реши да ги земе работите во свои раце. Со брз, дискретен потег, таа го активирала копчето за паника на телефонот, испраќајќи предупредување до локалните власти. Без знаење на напаѓачот, помошта била на пат.

                                    Автобусот стана тензично бојно поле на умови, бидејќи Роберт, Марија и другите патници работеа заедно за да го одвлечат вниманието на напаѓачот додека не дојде полицијата. Напаѓачот, кој стануваше сè пофрустриран, направи критична грешка, дозволувајќи им на патниците да ги совладаат и разоружаат токму кога полицијата упадна во автобусот.

                                    Бидејќи ситуацијата била под контрола, мотивот зад злосторството останал обвиен со мистерија. Полицијата го уапсила напаѓачот, а ранецот на Марија, во кој имало вреден, но загадочен пакет, станал фокусна точка на истрагата. Детективот Роберт, сега официјално вклучен, тргна на патување за да ги разоткрие слоевите на ова полноќно злосторство, решен да ја разоткрие вистината скриена во сенките на ноќта.</p>
                                <p class="text-base leading-4 mt-7 text-black-600 dark:text-black-300">Product Code: 8BN321AF2IF0NYA</p>
                                <p class="text-base leading-4 mt-4 text-black-600 dark:text-black-300">Length: 13.2 inches</p>
                                <p class="text-base leading-4 mt-4 text-black-600 dark:text-black-300">Height: 10 inches</p>
                                <p class="text-base leading-4 mt-4 text-black-600 dark:text-black-300">Depth: 5.1 inches</p>
                                <p class="md:w-96 text-base leading-normal text-black-600 dark:text-black-300 mt-4">Composition: 100% calf leather, inside: 100% lamb leather</p>
                            </div>
                            <div>
                                <div class="border-t border-b py-4 mt-7 border-gray-200">
                                    <div data-menu class="flex justify-between items-center cursor-pointer">
                                        <p class="text-base leading-4 text-gray-800 dark:text-gray-300">Shipping and returns</p>
                                        <button class="cursor-pointer focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-400 rounded" role="button" aria-label="show or hide">
                                            <img class="transform dark:hidden" src="https://tuk-cdn.s3.amazonaws.com/can-uploader/productDetail3-svg4.svg" alt="dropdown">
                                            <img class="transform hidden dark:block" src="https://tuk-cdn.s3.amazonaws.com/can-uploader/productDetail3-svg4dark.svg" alt="dropdown">
                                        </button>
                                    </div>
                                    <div class="hidden pt-4 text-base leading-normal pr-12 mt-4 text-black-600 dark:text-gray-300" id="sect">You will be responsible for paying for your own shipping costs for returning your item. Shipping costs are nonrefundable</div>
                                </div>
                            </div>
                            <div>
                                <div class="border-b py-4 border-gray-200">
                                    <div data-menu class="flex justify-between items-center cursor-pointer">
                                        <p class="text-base leading-4 text-gray-800 dark:text-gray-300">Contact us</p>
                                        <button class="cursor-pointer focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-400 rounded" role="button" aria-label="show or hide">
                                            <img class="transform dark:hidden" src="https://tuk-cdn.s3.amazonaws.com/can-uploader/productDetail3-svg4.svg" alt="dropdown">
                                            <img class="transform hidden dark:block" src="https://tuk-cdn.s3.amazonaws.com/can-uploader/productDetail3-svg4dark.svg" alt="dropdown">
                                        </button>
                                    </div>
                                    <div class="hidden pt-4 text-base leading-normal pr-12 mt-4 text-gray-600 dark:text-gray-300" id="sect">If you have any questions on how to return your item to us, contact us.</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>


    </div>

</div>

<!-- AlpineJS -->
<script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js" defer></script>
<!-- Font Awesome -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/js/all.min.js" integrity="sha256-KzZiKy0DWYsnwMF+X1DvQngQ2/FxF7MF3Ff72XcpuPs=" crossorigin="anonymous"></script>
<!-- ChartJS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.js" integrity="sha256-R4pqcOYV8lt7snxMQO/HSbVCFRPMdrhAFMH+vr9giYI=" crossorigin="anonymous"></script>

</body>
</html>
