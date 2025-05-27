<nav x-data="{ open: false }" class="bg-white dark:bg-gray-800 border-b border-gray-100 dark:border-gray-700">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between">
            <div class="flex items-center gap-3">
                <!-- Logo -->
                <div class="shrink-0 flex items-center p-2">
                    <a href="{{ UrlHelper::localizedRoute('home') }}">
                        <x-application-logo class="block h-9 w-auto fill-current text-gray-800 dark:text-gray-200" />
                    </a>
                </div>

                {{-- Navigation Links --}}
                <div class="hidden space-x-8 sm:-my-px sm:flex">
                    <x-nav-link :href="UrlHelper::localizedRoute('about')" :active="request()->routeIs('about')">
                        {{ __('Про нас') }}
                    </x-nav-link>
                </div>
                <div class="hidden space-x-8 sm:-my-px sm:flex">
                    <x-nav-link :href="UrlHelper::localizedRoute('contact')" :active="request()->routeIs('contact')">
                        {{ __('Контакти') }}
                    </x-nav-link>
                </div>

                <div class='relative z-50'>
                    <x-search-input />

                    {{-- Search Results --}}
                    <div id='search-results'
                        class="hidden overflow-hidden absolute top-full left-0 w-full bg-white border rounded-md border-gray-200 dark:border-gray-700 shadow-lg z-100 dark:bg-gray-800">
                    </div>
                </div>

            </div>

            <div class="hidden sm:flex sm:items-center sm:ms-6 gap-3">
                <header class=" items-center gap-2 lg:grid-cols-3 mr-3">
                    @if (Route::has('login'))
                        <nav class="-mx-3 flex flex-1 justify-end gap-3">
                            @auth
                                <x-secondary-button>
                                    <a href="{{ UrlHelper::localizedRoute('admin.dashboard') }}">
                                        Адмін
                                    </a>
                                </x-secondary-button>
                            @else
                                <x-primary-button>
                                    <a href="{{ UrlHelper::localizedRoute('login') }}">
                                        Увійти
                                    </a>
                                </x-primary-button>

                                @if (Route::has('register'))
                                    <x-secondary-button>
                                        <a href="{{ UrlHelper::localizedRoute('register') }}">
                                            Зареєструватися
                                        </a>
                                    </x-secondary-button>
                                @endif
                            @endauth
                        </nav>
                    @endif
                </header>
                <x-dropdown-select />
                @if (Auth::user()?->name !== null)
                    <a href="{{ UrlHelper::localizedRoute('location.create') }}"
                        class="relative inline-flex items-center justify-center p-0.5 overflow-hidden text-sm font-medium text-gray-900 rounded-lg group bg-gradient-to-br from-cyan-500 to-blue-500 group-hover:from-cyan-500 group-hover:to-blue-500 hover:text-white dark:text-white focus:ring-4 focus:outline-none focus:ring-cyan-200 dark:focus:ring-cyan-800">
                        <span
                            class="relative px-5 py-2.5 transition-all ease-in duration-75 bg-white dark:bg-gray-900 rounded-md group-hover:bg-transparent group-hover:dark:bg-transparent">
                            Додати нове місце
                        </span>
                    </a>
                    <!-- Settings Dropdown -->
                    <div class="hidden sm:flex sm:items-center ">
                        <x-dropdown align="right" width="48">
                            <x-slot name="trigger">
                                <button
                                    class="inline-flex items-center  py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 dark:text-gray-400 bg-white dark:bg-gray-800 hover:text-gray-700 dark:hover:text-gray-300 focus:outline-none transition ease-in-out duration-150">
                                    <div>{{ Auth::user()?->name ?? 'Login' }}</div>

                                    <div class="ms-1">
                                        <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg"
                                            viewBox="0 0 20 20">
                                            <path fill-rule="evenodd"
                                                d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                                clip-rule="evenodd" />
                                        </svg>
                                    </div>
                                </button>
                            </x-slot>

                            <x-slot name="content">
                                <x-dropdown-link :href="UrlHelper::localizedRoute('profile.edit')">
                                    {{ __('Профіль') }}
                                </x-dropdown-link>



                                <!-- Authentication -->

                                <form method="POST" action="{{ UrlHelper::localizedRoute('logout') }}">
                                    @csrf

                                    <x-dropdown-link :href="route('logout')"
                                        onclick="event.preventDefault();
                                                    this.closest('form').submit();">
                                        {{ __('Log Out') }}
                                    </x-dropdown-link>
                                </form>
                            </x-slot>
                        </x-dropdown>
                    </div>
                @endif
                <x-theme-toggle />
            </div>


            <!-- Hamburger -->
            <div class="-me-2 flex items-center sm:hidden">
                <button @click="open = ! open"
                    class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 dark:text-gray-500 hover:text-gray-500 dark:hover:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-900 focus:outline-none focus:bg-gray-100 dark:focus:bg-gray-900 focus:text-gray-500 dark:focus:text-gray-400 transition duration-150 ease-in-out">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{ 'hidden': open, 'inline-flex': !open }" class="inline-flex"
                            stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{ 'hidden': !open, 'inline-flex': open }" class="hidden" stroke-linecap="round"
                            stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{ 'block': open, 'hidden': !open }" class="hidden sm:hidden">
        <div class="pt-2 pb-3 space-y-1">
            <!-- <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                {{ __('Dashboard') }}
            </x-responsive-nav-link> -->
        </div>

        <!-- Responsive Settings Options -->
        <div class="pt-4 pb-1 border-t border-gray-200 dark:border-gray-600">
            <div class="px-4">
                <div class="font-medium text-base text-gray-800 dark:text-gray-200">
                    {{ Auth::user()?->name }}
                </div>
                <div class="font-medium text-sm text-gray-500">
                    {{ Auth::user()?->email }}
                </div>
            </div>

            <div class="mt-3 space-y-1">
                <x-responsive-nav-link :href="route('profile.edit')">
                    {{ __('Profile') }}
                </x-responsive-nav-link>

                <!-- Authentication -->
                <form method="POST" action="{{ UrlHelper::localizedRoute('logout') }}">
                    @csrf

                    <x-responsive-nav-link :href="UrlHelper::localizedRoute('logout')"
                        onclick="event.preventDefault();
                                        this.closest('form').submit();">
                        {{ __('Log Out') }}
                    </x-responsive-nav-link>
                </form>
            </div>
        </div>
    </div>
</nav>

<script>
    function debounce(callback, wait) {
        let timerId;
        return (...args) => {
            clearTimeout(timerId);
            timerId = setTimeout(() => {
                callback(...args);
            }, wait);
        };
    }

    function showSearchResults(data) {
        const searchResults = document.getElementById('search-results');
        if (data) {
            searchResults.style.display = 'block';
            searchResults.innerHTML = '';
            if (data.length > 0) {
                for (let i = 0; i < data.length; i++) {
                    const location = data[i];
                    const locationLink = document.createElement('a');
                    locationLink.href = '/location/' + location.id;
                    locationLink.textContent = location.name;
                    locationLink.classList.add('block', 'px-4', 'py-2', 'text-lg', 'text-gray-700', 'hover:bg-gray-100',
                        'dark:text-gray-200', 'dark:hover:bg-gray-600');
                    searchResults.appendChild(locationLink);
                }

            } else {
                const searchResult = document.createElement('span');
                searchResult.textContent = 'Нічого не знайдено';
                searchResult.classList.add('block', 'px-4', 'py-2', 'text-lg', 'text-gray-700', 'dark:text-gray-200');
                searchResults.appendChild(searchResult);
            }
        } else {
            searchResults.style.display = 'none';
        }

    }

    async function fetchSearchResults(query) {
        const result = await axios.post("/location/find-by-name", {
            query: query,
        });

        return result.data;
    }

    const handleFetchSearchResults = debounce(async (query) => {
        try {
            const data = await fetchSearchResults(query);

            if (data) {
                showSearchResults(data);
            }
        } catch (error) {
            console.error('error ' + error);
        }
    }, 500)

    function handleSearch(event) {
        event.preventDefault();

        const query = event.currentTarget.value;
        if (query !== '') {
            handleFetchSearchResults(query);
        } else {
            showSearchResults(null);
        }
    }
</script>
