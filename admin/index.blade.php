@php
    $componentStore = new \Confetti\Helpers\ComponentStore([]);
    $currentContentId = str_replace('/admin', '', request()->uri());
    $contentStore = new \Confetti\Helpers\ContentStore();
@endphp<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, user-scalable=no">

    <title>Admin</title>

    <link rel="stylesheet" href="/resources/admin-tailwind/tailwind.output.css"/>
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght@100" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@formkit/themes@next/dist/genesis/theme.css"/>
    <link rel="stylesheet" href="/admin/assets/css/feather-icons.css"/>
    <script type="importmap">
        {
            "imports": {
                "pinia": "https://cdn.jsdelivr.net/npm/pinia/dist/pinia.esm-browser.js",
                "vue-demi": "https://cdn.jsdelivr.net/npm/vue-demi/lib/v3/index.mjs",
                "@vue/devtools-api": "https://cdn.jsdelivr.net/npm/@vue/devtools-api/lib/esm/index.js",
                "vue": "https://cdn.jsdelivr.net/npm/vue@3/dist/vue.esm-browser.js",
                "@formkit/core": "https://cdn.jsdelivr.net/npm/@formkit/core@1.0.0-beta.8/dist/index.mjs",
                "@formkit/dev": "https://cdn.jsdelivr.net/npm/@formkit/dev@1.0.0-beta.8/dist/index.mjs",
                "@formkit/i18n": "https://cdn.jsdelivr.net/npm/@formkit/i18n@1.0.0-beta.8/dist/index.mjs",
                "@formkit/inputs": "https://cdn.jsdelivr.net/npm/@formkit/inputs@1.0.0-beta.8/dist/index.mjs",
                "@formkit/observer": "https://cdn.jsdelivr.net/npm/@formkit/observer@1.0.0-beta.8/dist/index.mjs",
                "@formkit/rules": "https://cdn.jsdelivr.net/npm/@formkit/rules@1.0.0-beta.8/dist/index.mjs",
                "@formkit/themes": "https://cdn.jsdelivr.net/npm/@formkit/themes@1.0.0-beta.8/dist/index.mjs",
                "@formkit/utils": "https://cdn.jsdelivr.net/npm/@formkit/utils@1.0.0-beta.8/dist/index.mjs",
                "@formkit/validation": "https://cdn.jsdelivr.net/npm/@formkit/validation@1.0.0-beta.8/dist/index.mjs",
                "@formkit/vue": "https://cdn.jsdelivr.net/npm/@formkit/vue@1.0.0-beta.8/dist/index.mjs",
                "@formkit/auto-animate": "https://cdnjs.cloudflare.com/ajax/libs/auto-animate/0.8.1/vue/index.mjs"
            }
        }
      </script>
      <script src="/admin/assets/js/app.js" type="module"></script>
</head>

<body class="text-gray-700 dark:text-gray-400 overflow-hidden">
    <div id="app">
        <div :class="{dark: isDarkMode}">
            @guest()
                @include('auth.redirect_to_login')
            @else
                @can('admin')
                    <div class="flex h-screen bg-gray-50 dark:bg-gray-900" :class="{ 'overflow-hidden': isSideMenuOpen}">
                        <!-- Desktop sidebar -->
                        <aside class="z-20 flex-shrink-0 hidden w-64 overflow-y-auto bg-white dark:bg-gray-800 md:block">
                            @include('admin.left_menu', ['componentStore' => $componentStore, 'contentStore' => $contentStore, 'currentContentId' => $currentContentId])
                        </aside>

                        <!-- Mobile sidebar -->
                        {{-- <div x-show="isSideMenuOpen" x-transition:enter="transition ease-in-out duration-150" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100" x-transition:leave="transition ease-in-out duration-150" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0" class="fixed inset-0 z-10 flex items-end bg-gray bg-opacity-50 sm:items-center sm:justify-center"></div>
                        <aside class="fixed inset-y-0 z-20 flex-shrink-0 w-64 mt-16 overflow-y-auto bg-white dark:bg-gray-800 md:hidden" x-show="isSideMenuOpen" x-transition:enter="transition ease-in-out duration-150" x-transition:enter-start="opacity-0 transform -translate-x-20" x-transition:enter-end="opacity-100" x-transition:leave="transition ease-in-out duration-150" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0 transform -translate-x-20" @click.away="closeSideMenu" @keydown.escape="closeSideMenu">
                            @include('admin.left_menu', ['componentStore' => $componentStore, 'contentStore' => $contentStore, 'currentContentId' => $currentContentId])
                        </aside> --}}

                        <div class="flex flex-col flex-1">
                            @include('admin.header', ['componentStore' => $componentStore])

                            <main class="h-full pb-16 overflow-y-auto">
                                @include('admin.middle', ['componentStore' => $componentStore, 'contentStore' => $contentStore, 'currentContentId' => $currentContentId])
                            </main>
                            <div @click="openModal()">Modaaal</div>

                            <div v-if="modal">
                                @include('admin.structure.components.modal')
                            </div>
                        </div>
                    </div>
                @else
                    <div class="flex items-center justify-center w-full h-screen bg-gray-50 dark:bg-gray-900">
                        You are not allowed to access this page. Go back to&nbsp;<a href="/" class="underline">the home page</a>
                        <span>&nbsp;or <a onclick="document.cookie = 'access_token=; Max-Age=0;';location.reload()" class="underline cursor-pointer">retry to login</a>.</span>
                    </div>
                @endcan
            @endguest

            @stack('script_*')
        </div>
    </div>
</body>

</html>
















