<nav x-data="{ open: false }" class="bg-white dark:bg-gray-800 border-b border-gray-100 dark:border-gray-700">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('dashboard') }}">
                        <x-application-logo class="block h-9 w-auto fill-current text-gray-800 dark:text-gray-200" />
                    </a>
                </div>

                <div class="hidden space-x-8 md:-my-px md:ms-10 md:flex">
                    <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                        {{ __('Dashboard') }}
                    </x-nav-link>
                    <x-nav-link :href="route('transactions.index')" :active="request()->routeIs('transactions.*')">
                        {{ __('Transactions') }}
                    </x-nav-link>
                    <x-nav-link :href="route('accounts.index')" :active="request()->routeIs('accounts.*')">
                        {{ __('Accounts') }}
                    </x-nav-link>
                    <x-nav-link :href="route('budgets.index')" :active="request()->routeIs('budgets.*')">
                        {{ __('Budgets') }}
                    </x-nav-link>
                </div>
            </div>

            <div class="flex items-center space-x-6">
                <button id="darkModeToggle"
                    class="px-4 py-2 hidden md:block bg-white dark:bg-gray-800 text-black dark:text-white rounded">
                    🌙 / ☀️
                </button>

                <!-- Notifikasi (hanya di desktop) -->
                <div class="relative hidden md:block">
                    <button onclick="toggleDropdown()"
                        class="relative text-gray-600 dark:text-gray-300 focus:outline-none mx-4">
                        🔔
                        @if (Auth::user()->unreadNotifications->count() > 0)
                            <span class="absolute -top-1 -right-1 bg-red-500 text-white text-xs px-1 rounded-full">
                                {{ Auth::user()->unreadNotifications->count() }}
                            </span>
                        @endif
                    </button>
                    <div id="notificationDropdown"
                        class="absolute right-0 mt-2 bg-white dark:bg-gray-800 shadow-md w-64 hidden rounded-lg border border-gray-300 dark:border-gray-700">
                        <div class="p-2 text-sm font-semibold text-gray-800 dark:text-gray-200 border-b">
                            Notifikasi
                        </div>
                        <div class="max-h-64 overflow-y-auto rounded-lg shadow-sm bg-white dark:bg-gray-800">
                            @forelse (Auth::user()->unreadNotifications as $notification)
                                <a href="{{ route('notifications.read', $notification->id) }}"
                                    class="block px-4 py-3 text-sm text-gray-800 dark:text-gray-200 hover:bg-gray-50 dark:hover:bg-gray-700">
                                    {{ $notification->data['message'] }}
                                </a>
                            @empty
                                <div class="p-4 text-center text-gray-500 dark:text-gray-400">
                                    Tidak ada notifikasi baru
                                </div>
                            @endforelse
                        </div>
                    </div>
                </div>

                <div class="hidden md:flex md:items-center">
                    <x-dropdown align="right" width="48">
                        <x-slot name="trigger">
                            <button
                                class="inline-flex items-center px-3 py-2 border border-transparent text-sm font-medium rounded-md text-gray-500 dark:text-gray-400 bg-white dark:bg-gray-800 hover:text-gray-700 dark:hover:text-gray-300 focus:outline-none transition">
                                <div>{{ Auth::user()->name }}</div>
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
                            <x-dropdown-link :href="route('profile.edit')">
                                {{ __('Profile') }}
                            </x-dropdown-link>

                            <form method="POST" action="{{ route('logout') }}">
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
            </div>

            <div class="-me-2 flex items-center md:hidden">
                <button @click="open = ! open"
                    class="p-2 rounded-md text-gray-400 dark:text-gray-500 hover:text-gray-500 dark:hover:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-900 focus:outline-none">
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
    <div :class="{ 'block': open, 'hidden': !open }" class="hidden md:hidden">
        <div class="pt-2 pb-3 space-y-1">
            <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                {{ __('Dashboard') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('transactions.index')" :active="request()->routeIs('transactions.*')">
                {{ __('Transactions') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('accounts.index')" :active="request()->routeIs('accounts.*')">
                {{ __('Accounts') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('budgets.index')" :active="request()->routeIs('budgets.*')">
                {{ __('Budgets') }}
            </x-responsive-nav-link>
        </div>

        <!-- Notifikasi di dalam menu responsif -->
        <div class="border-t border-gray-200 dark:border-gray-600 pt-3">
            <div class="px-4 text-gray-800 dark:text-gray-200 font-semibold">Notifikasi</div>
            <div class="px-4 max-h-64 overflow-y-auto">
                @forelse (Auth::user()->unreadNotifications as $notification)
                    <a href="{{ route('notifications.read', $notification->id) }}"
                        class="block py-2 text-sm text-gray-800 dark:text-gray-200 hover:bg-gray-50 dark:hover:bg-gray-700">
                        {{ $notification->data['message'] }}
                    </a>
                @empty
                    <div class="py-2 text-gray-500 dark:text-gray-400 text-sm">Tidak ada notifikasi baru</div>
                @endforelse
            </div>
        </div>

        <div class="border-t border-gray-200 dark:border-gray-600 py-3">
            <div class="px-4 text-gray-800 dark:text-gray-200 font-semibold">Theme</div>
            <button id="darkModeToggleMobile"
                class="px-3 py-2 mt-2 bg-white dark:bg-gray-800 text-black dark:text-white rounded">
                🌙 / ☀️
            </button>
        </div>

        <!-- Responsive Settings Options -->
        <div class="pt-4 pb-1 border-t border-gray-200 dark:border-gray-600">
            <div class="px-4">
                <div class="font-medium text-base text-gray-800 dark:text-gray-200">{{ Auth::user()->name }}</div>
                <div class="font-medium text-sm text-gray-500">{{ Auth::user()->email }}</div>
            </div>

            <div class="mt-3 space-y-1">
                <x-responsive-nav-link :href="route('profile.edit')">
                    {{ __('Profile') }}
                </x-responsive-nav-link>

                <!-- Authentication -->
                <form method="POST" action="{{ route('logout') }}">
                    @csrf

                    <x-responsive-nav-link :href="route('logout')"
                        onclick="event.preventDefault();
                                        this.closest('form').submit();">
                        {{ __('Log Out') }}
                    </x-responsive-nav-link>
                </form>
            </div>
        </div>
</nav>


<script>
    document.addEventListener("DOMContentLoaded", function() {
        const toggle = document.getElementById("darkModeToggle");
        const toggleMobile = document.getElementById("darkModeToggleMobile"); // Tambah tombol untuk mobile
        const html = document.documentElement;

        if (localStorage.getItem("theme") === "dark") {
            html.classList.add("dark");
        }

        function toggleDarkMode() {
            if (html.classList.contains("dark")) {
                html.classList.remove("dark");
                localStorage.setItem("theme", "light");
            } else {
                html.classList.add("dark");
                localStorage.setItem("theme", "dark");
            }
        }

        toggle.addEventListener("click", toggleDarkMode);
        toggleMobile.addEventListener("click", toggleDarkMode); // Pastikan tombol mobile juga bisa pencet
    });

    document.addEventListener("DOMContentLoaded", function() {
        let notifBtn = document.querySelector("[onclick='toggleDropdown()']");
        let dropdown = document.getElementById("notificationDropdown");
        let notifBadge = notifBtn.querySelector("span"); // Ambil elemen angka merah

        if (!notifBtn || !dropdown) {
            console.error("Tombol atau dropdown notifikasi tidak ditemukan.");
            return;
        }

        notifBtn.addEventListener("click", function(event) {
            event.stopPropagation();
            dropdown.classList.toggle("hidden");

            // 🔹 Kirim AJAX hanya jika ada notifikasi yang belum dibaca
            if (notifBadge) {
                fetch("{{ route('notifications.markAsRead') }}", {
                        method: "POST",
                        headers: {
                            "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]')
                                .content,
                            "Content-Type": "application/json",
                        },
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            notifBadge.remove(); // Hapus angka merah setelah dibaca
                        }
                    })
                    .catch(error => console.error("Error:", error));
            }
        });

        document.addEventListener("click", function(event) {
            if (!dropdown.contains(event.target) && event.target !== notifBtn) {
                dropdown.classList.add("hidden");
            }
        });
    });
</script>
