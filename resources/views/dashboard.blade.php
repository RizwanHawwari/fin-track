<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="text-2xl font-bold text-gray-800 dark:text-white">Dashboard</h2>
            <button id="toggleVisibility"
                class="p-2 rounded-full bg-gray-200 dark:bg-gray-700 hover:bg-gray-300 dark:hover:bg-gray-600">
                <svg id="eyeIcon" xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-gray-800 dark:text-white"
                    viewBox="0 0 20 20" fill="currentColor">
                    <path id="eyeOpen"
                        d="M10 3C5 3 1 8 1 10s4 7 9 7 9-5 9-7-4-7-9-7zm0 12a5 5 0 110-10 5 5 0 010 10z" />
                    <path id="eyeSlash" class="hidden"
                        d="M2.454 2.454a1 1 0 00-1.415 1.414l14.142 14.142a1 1 0 001.414-1.414L2.454 2.454zM10 14c-2.5 0-4.5-2-4.5-4.5S7.5 5 10 5s4.5 2 4.5 4.5S12.5 14 10 14z" />
                </svg>
            </button>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-3 md:gap-6">
                <!-- Income Card - Compact design for mobile -->
                <div
                    class="bg-white dark:bg-gray-800 rounded-xl shadow-sm overflow-hidden transition-all duration-300 hover:shadow-md transform hover:translate-y-px">
                    <div class="p-4 md:p-6">
                        <div class="flex items-center">
                            <div class="p-2 mr-3 rounded-full bg-green-100 dark:bg-green-900/40">
                                <svg xmlns="http://www.w3.org/2000/svg"
                                    class="h-5 w-5 md:h-6 md:w-6 text-green-500 dark:text-green-300" viewBox="0 0 20 20"
                                    fill="currentColor">
                                    <path fill-rule="evenodd"
                                        d="M5.293 9.707a1 1 0 010-1.414l4-4a1 1 0 011.414 0l4 4a1 1 0 01-1.414 1.414L11 7.414V15a1 1 0 11-2 0V7.414L6.707 9.707a1 1 0 01-1.414 0z"
                                        clip-rule="evenodd" />
                                </svg>
                            </div>
                            <div>
                                <p class="text-xs text-gray-500 dark:text-gray-400 font-medium">Total Pemasukan</p>
                                <p class="text-lg md:text-2xl font-bold text-gray-900 dark:text-white hidden-amount">Rp
                                    <span class="amount">{{ number_format($totalIncome, 0, ',', '.') }}</span>
                                </p>
                            </div>
                        </div>
                        <div class="mt-3 h-1 w-full bg-gray-100 dark:bg-gray-700 rounded-full overflow-hidden">
                            <div class="h-full bg-green-500 rounded-full" style="width: 75%"></div>
                        </div>
                    </div>
                </div>

                <!-- Expense Card - Compact design for mobile -->
                <div
                    class="bg-white dark:bg-gray-800 rounded-xl shadow-sm overflow-hidden transition-all duration-300 hover:shadow-md transform hover:translate-y-px">
                    <div class="p-4 md:p-6">
                        <div class="flex items-center">
                            <div class="p-2 mr-3 rounded-full bg-red-100 dark:bg-red-900/40">
                                <svg xmlns="http://www.w3.org/2000/svg"
                                    class="h-5 w-5 md:h-6 md:w-6 text-red-500 dark:text-red-300" viewBox="0 0 20 20"
                                    fill="currentColor">
                                    <path fill-rule="evenodd"
                                        d="M14.707 10.293a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 111.414-1.414L9 12.586V5a1 1 0 012 0v7.586l2.293-2.293a1 1 0 011.414 0z"
                                        clip-rule="evenodd" />
                                </svg>
                            </div>
                            <div>
                                <p class="text-xs text-gray-500 dark:text-gray-400 font-medium">Total Pengeluaran</p>
                                <p class="text-lg md:text-2xl font-bold text-gray-900 dark:text-white hidden-amount">Rp
                                    <span class="amount">{{ number_format($totalExpense, 0, ',', '.') }}</span>
                                </p>
                            </div>
                        </div>
                        <div class="mt-3 h-1 w-full bg-gray-100 dark:bg-gray-700 rounded-full overflow-hidden">
                            <div class="h-full bg-red-500 rounded-full" style="width: 60%"></div>
                        </div>
                    </div>
                </div>

                <!-- Balance Card - Compact design for mobile -->
                <div
                    class="bg-white dark:bg-gray-800 rounded-xl shadow-sm overflow-hidden transition-all duration-300 hover:shadow-md transform hover:translate-y-px">
                    <div class="p-4 md:p-6">
                        <div class="flex items-center">
                            <div class="p-2 mr-3 rounded-full bg-blue-100 dark:bg-blue-900/40">
                                <svg xmlns="http://www.w3.org/2000/svg"
                                    class="h-5 w-5 md:h-6 md:w-6 text-blue-500 dark:text-blue-300" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </div>
                            <div>
                                <p class="text-xs text-gray-500 dark:text-gray-400 font-medium">Total Saldo</p>
                                <p class="text-lg md:text-2xl font-bold text-gray-900 dark:text-white hidden-amount">Rp
                                    <span class="amount">{{ number_format($totalSaldo, 0, ',', '.') }}</span>
                                </p>
                            </div>
                        </div>
                        <div class="mt-3 h-1 w-full bg-gray-100 dark:bg-gray-700 rounded-full overflow-hidden">
                            <div class="h-full bg-blue-500 rounded-full" style="width: 85%"></div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Quick Stat Comparison (Responsive) -->
            <div class="mt-6 grid grid-cols-3 gap-2 md:gap-6">
                <div class="bg-white/80 dark:bg-gray-800/50 rounded-lg p-2 text-center">
                    <p class="text-xs text-gray-500 dark:text-gray-400">Income/Expense</p>
                    <p class="text-sm font-bold text-green-500 dark:text-green-400">Cooming Soon</p>
                </div>
                <div class="bg-white/80 dark:bg-gray-800/50 rounded-lg p-2 text-center">
                    <p class="text-xs text-gray-500 dark:text-gray-400">Monthly Growth</p>
                    <p class="text-sm font-bold text-blue-500 dark:text-blue-400">Cooming Soon</p>
                </div>
                <div class="bg-white/80 dark:bg-gray-800/50 rounded-lg p-2 text-center">
                    <p class="text-xs text-gray-500 dark:text-gray-400">Budget Status</p>
                    <p class="text-sm font-bold text-yellow-500 dark:text-yellow-400">Cooming Soon</p>
                </div>
            </div>


            <!-- Quick Actions - Mobile Only -->
            <div class="mb-6 mt-6 md:mt-10 lg:hidden">
                <div class="flex overflow-x-auto justify-center pb-2 px-4 space-x-3 md:space-x-8 scrollbar-hide">
                    <a href="{{ route('transactions.create') }}"
                        class="flex-shrink-0 flex flex-col items-center justify-center bg-gradient-to-r from-blue-500 to-indigo-600 text-white rounded-xl p-3 w-20 h-20">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mb-1" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                        </svg>
                        <span class="text-xs text-center font-medium">Tambah Transaksi</span>
                    </a>

                    <a href="{{ route('transactions.index') }}"
                        class="flex-shrink-0 flex flex-col items-center justify-center bg-gradient-to-r from-green-500 to-emerald-600 text-white rounded-xl p-3 w-20 h-20">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mb-1" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6" />
                        </svg>
                        <span class="text-xs text-center font-medium">Kelola Transaksi</span>
                    </a>

                    <a href="{{ route('accounts.index') }}"
                        class="flex-shrink-0 flex flex-col items-center justify-center bg-gradient-to-r from-amber-500 to-orange-600 text-white rounded-xl p-3 w-20 h-20">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mb-1" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M3 6l3 1m0 0l-3 9a5.002 5.002 0 006.001 0M6 7l3 9M6 7l6-2m6 2l3-1m-3 1l-3 9a5.002 5.002 0 006.001 0M18 7l3 9m-3-9l-6-2m0-2v2m0 16V5m0 16H9m3 0h3" />
                        </svg>
                        <span class="text-xs text-center font-medium">Akun Keuangan</span>
                    </a>

                    <a href="{{ route('budgets.index') }}"
                        class="flex-shrink-0 flex flex-col items-center justify-center bg-gradient-to-r from-purple-500 to-fuchsia-600 text-white rounded-xl p-3 w-20 h-20">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mb-1" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 7h6m0 10v-3m-3 3h.01M9 17h.01M9 14h.01M12 14h.01M15 11h.01M12 11h.01M9 11h.01M7 21h10a2 2 0 002-2V5a2 2 0 00-2-2H7a2 2 0 00-2 2v14a2 2 0 002 2z" />
                        </svg>
                        <span class="text-xs font-medium">Budgeting</span>
                    </a>
                </div>
            </div>

            <!-- Reordered content for mobile -->
            <div class="mt-6 md:mt-10 grid grid-cols-1 lg:grid-cols-3 gap-6 md:gap-8">
                <!-- Right column (moved to top on mobile) -->
                <div class="space-y-6 md:space-y-8 order-1 lg:order-2">
                    <!-- Akun Keuangan -->
                    <div class="bg-white dark:bg-gray-800 rounded-xl shadow-md overflow-hidden">
                        <div class="p-4 lg:p-6">
                            <h3 class="text-lg lg:text-xl font-semibold text-gray-800 dark:text-white mb-4">Akun
                                Keuangan</h3>
                            <div class="space-y-3 lg:space-y-4">
                                @foreach ($accounts as $account)
                                    <div
                                        class="bg-gray-50 dark:bg-gray-700 rounded-lg p-3 lg:p-4 flex items-center transition-all duration-300 hover:shadow-sm">
                                        <!-- Account Type Icon -->
                                        <div class="flex-shrink-0 mr-3 lg:mr-4">
                                            @if ($account->type == 'bank')
                                                <div
                                                    class="w-8 h-8 lg:w-10 lg:h-10 flex items-center justify-center bg-blue-100 dark:bg-blue-900 rounded-full">
                                                    <svg xmlns="http://www.w3.org/2000/svg"
                                                        class="h-5 w-5 lg:h-6 lg:w-6 text-blue-600 dark:text-blue-300"
                                                        fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2"
                                                            d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                                                    </svg>
                                                </div>
                                            @elseif($account->type == 'e-wallet')
                                                <div
                                                    class="w-8 h-8 lg:w-10 lg:h-10 flex items-center justify-center bg-purple-100 dark:bg-purple-900 rounded-full">
                                                    <svg xmlns="http://www.w3.org/2000/svg"
                                                        class="h-5 w-5 lg:h-6 lg:w-6 text-purple-600 dark:text-purple-300"
                                                        fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2"
                                                            d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z" />
                                                    </svg>
                                                </div>
                                            @else
                                                <div
                                                    class="w-8 h-8 lg:w-10 lg:h-10 flex items-center justify-center bg-gray-100 dark:bg-gray-600 rounded-full">
                                                    <svg xmlns="http://www.w3.org/2000/svg"
                                                        class="h-5 w-5 lg:h-6 lg:w-6 text-gray-600 dark:text-gray-300"
                                                        fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2"
                                                            d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                                    </svg>
                                                </div>
                                            @endif
                                        </div>
                                        <!-- Account Details -->
                                        <div class="flex-grow">
                                            <p class="text-sm lg:text-base font-medium text-gray-900 dark:text-white">
                                                {{ $account->name }}</p>
                                            <p
                                                class="text-base lg:text-lg font-bold text-gray-700 dark:text-gray-300 hidden-amount">
                                                Rp <span
                                                    class="amount">{{ number_format($account->balance, 0, ',', '.') }}</span>
                                            </p>
                                        </div>
                                        <!-- Account Type Badge -->
                                        <div class="flex-shrink-0 ml-2">
                                            <span
                                                class="px-2 py-1 rounded-lg text-xs font-medium {{ $account->type == 'bank' ? 'bg-blue-100 text-blue-800 dark:bg-blue-900 dark:text-blue-200' : ($account->type == 'e-wallet' ? 'bg-purple-100 text-purple-800 dark:bg-purple-900 dark:text-purple-200' : 'bg-gray-100 text-gray-800 dark:bg-gray-900 dark:text-gray-200') }}">
                                                {{ ucfirst($account->type) }}
                                            </span>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>

                    <!-- Promo & Event -->
                    <div class="bg-white dark:bg-gray-800 rounded-xl shadow-md overflow-hidden">
                        <div class="p-3 sm:p-4 lg:p-6">
                            <h3
                                class="text-base sm:text-lg lg:text-xl font-semibold text-gray-800 dark:text-white mb-2 sm:mb-3 lg:mb-4">
                                Promo &
                                Event</h3>
                            <div class="relative rounded-lg overflow-hidden">
                                <div id="slider" class="flex transition-transform duration-500 ease-in-out">
                                    <div class="w-full flex-shrink-0">
                                        <img src="https://i.imgur.com/LMKCLaH.jpeg"
                                            class="w-full h-32 sm:h-36 lg:h-48 object-cover rounded-lg"
                                            alt="Promo 1">
                                    </div>
                                    <div class="w-full flex-shrink-0">
                                        <img src="https://via.placeholder.com/1200x400/FF5733"
                                            class="w-full h-32 sm:h-36 lg:h-48 object-cover rounded-lg"
                                            alt="Promo 2">
                                    </div>
                                    <div class="w-full flex-shrink-0">
                                        <img src="https://via.placeholder.com/1200x400/33FF57"
                                            class="w-full h-32 sm:h-36 lg:h-48 object-cover rounded-lg"
                                            alt="Promo 3">
                                    </div>
                                </div>
                                <!-- Slider Navigation -->
                                <button id="prev"
                                    class="absolute top-1/2 left-1 -translate-y-1/2 bg-white/80 dark:bg-gray-800/80 backdrop-blur-sm text-gray-800 dark:text-white p-2 sm:p-2.5 lg:p-3 rounded-full shadow-lg hover:bg-white dark:hover:bg-gray-800 transition-colors">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 lg:h-5 lg:w-5"
                                        fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M15 19l-7-7 7-7" />
                                    </svg>
                                </button>
                                <button id="next"
                                    class="absolute top-1/2 right-1 -translate-y-1/2 bg-white/80 dark:bg-gray-800/80 backdrop-blur-sm text-gray-800 dark:text-white p-2 sm:p-2.5 lg:p-3 rounded-full shadow-lg hover:bg-white dark:hover:bg-gray-800 transition-colors">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 lg:h-5 lg:w-5"
                                        fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M9 5l7 7-7 7" />
                                    </svg>
                                </button>
                                <!-- Slider Indicators -->
                                <div class="absolute bottom-2 left-0 right-0 flex justify-center space-x-2">
                                    <button
                                        class="w-1.5 h-1.5 sm:w-2 sm:h-2 rounded-full bg-white/60 dark:bg-gray-300/60 slider-indicator active transition-all duration-300 hover:scale-125"></button>
                                    <button
                                        class="w-1.5 h-1.5 sm:w-2 sm:h-2 rounded-full bg-white/60 dark:bg-gray-300/60 slider-indicator transition-all duration-300 hover:scale-125"></button>
                                    <button
                                        class="w-1.5 h-1.5 sm:w-2 sm:h-2 rounded-full bg-white/60 dark:bg-gray-300/60 slider-indicator transition-all duration-300 hover:scale-125"></button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Transaksi Terbaru -->
                    <div class="bg-white dark:bg-gray-800 rounded-xl shadow-lg overflow-hidden">
                        <div class="p-4 sm:p-5 lg:p-6">
                            <div class="flex justify-between items-center mb-4 sm:mb-5 lg:mb-6">
                                <h3 class="text-lg sm:text-xl lg:text-xl font-semibold text-gray-800 dark:text-white">
                                    Transaksi Terbaru</h3>
                                <a href="{{ route('transactions.index') }}"
                                    class="text-blue-500 hover:text-blue-700 dark:text-blue-400 dark:hover:text-blue-300 text-xs sm:text-sm lg:text-sm font-medium flex items-center group">
                                    Lihat Selengkapnya
                                    <svg xmlns="http://www.w3.org/2000/svg"
                                        class="h-3.5 w-3.5 sm:h-4 sm:w-4 ml-1 transition-transform duration-300 group-hover:translate-x-1"
                                        fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M9 5l7 7-7 7" />
                                    </svg>
                                </a>
                            </div>

                            <div class="space-y-3 sm:space-y-4">
                                @foreach ($transactions->take(5) as $transaction)
                                    <div
                                        class="p-3 sm:p-3.5 lg:p-4 bg-white dark:bg-gray-800 rounded-lg shadow-lg border border-gray-200 dark:border-gray-700">
                                        <div class="flex justify-between items-center">
                                            <span
                                                class="text-xs sm:text-sm lg:text-sm text-gray-500 dark:text-gray-400">
                                                {{ \Carbon\Carbon::parse($transaction->transaction_date)->translatedFormat('d F Y') }}
                                            </span>
                                            <span
                                                class="px-2 py-0.5 sm:px-2.5 sm:py-1 lg:px-2.5 lg:py-1 rounded-full text-xs font-medium 
                            {{ $transaction->type == 'income' ? 'bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-200' : 'bg-red-100 text-red-800 dark:bg-red-900 dark:text-red-200' }}">
                                                {{ ucfirst($transaction->type) }}
                                            </span>
                                        </div>
                                        <p
                                            class="mt-1.5 sm:mt-2 lg:mt-2 text-xs sm:text-sm lg:text-sm font-medium text-gray-900 dark:text-white">
                                            {{ $transaction->description }}
                                        </p>
                                        <p
                                            class="mt-1 text-base sm:text-lg lg:text-lg font-semibold hidden-amount
                        {{ $transaction->type == 'income' ? 'text-green-600 dark:text-green-400' : 'text-red-600 dark:text-red-400' }}">
                                            Rp <span
                                                class="amount">{{ number_format($transaction->amount, 0, ',', '.') }}</span>
                                        </p>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Left column (2/3 width) - Moved down for mobile -->
                <div class="lg:col-span-2 space-y-4 sm:space-y-6 order-2 lg:order-1">
                    <!-- Financial Statistics -->
                    <div class="bg-white dark:bg-gray-800 rounded-lg shadow overflow-hidden">
                        <div class="p-4 sm:p-5">
                            <h3 class="text-lg sm:text-xl font-medium text-gray-800 dark:text-white mb-4">
                                Statistik Keuangan
                            </h3>

                            <div class="grid grid-cols-2 sm:grid-cols-2 gap-3 sm:gap-4">
                                <!-- Pemasukan vs Pengeluaran -->
                                <div class="bg-gray-50 dark:bg-gray-700/70 p-3 rounded-md transition hover:shadow-md">
                                    <h4 class="text-xs sm:text-sm font-medium text-gray-600 dark:text-gray-300 mb-2">
                                        Pemasukan vs Pengeluaran
                                    </h4>
                                    <div class="h-40 sm:h-48 md:h-56">
                                        <canvas id="incomeExpenseChart"></canvas>
                                    </div>
                                </div>

                                <!-- Saldo Perbulan -->
                                <div class="bg-gray-50 dark:bg-gray-700/70 p-3 rounded-md transition hover:shadow-md">
                                    <h4 class="text-xs sm:text-sm font-medium text-gray-600 dark:text-gray-300 mb-2">
                                        Saldo Perbulan
                                    </h4>
                                    <div class="h-40 sm:h-48 md:h-56">
                                        <canvas id="balanceHistoryChart"></canvas>
                                    </div>
                                </div>

                                <!-- Penggunaan Budget per Kategori -->
                                <div class="bg-gray-50 dark:bg-gray-700/70 p-3 rounded-md transition hover:shadow-md">
                                    <h4 class="text-xs sm:text-sm font-medium text-gray-600 dark:text-gray-300 mb-2">
                                        Penggunaan Budget per Kategori
                                    </h4>
                                    <div class="h-40 sm:h-48 md:h-56 flex justify-center items-center">
                                        <canvas id="budgetUsageChart"></canvas>
                                    </div>
                                </div>

                                <!-- Sisa Budget Bulanan -->
                                <div class="bg-gray-50 dark:bg-gray-700/70 p-3 rounded-md transition hover:shadow-md">
                                    <h4
                                        class="text-xs sm:text-sm font-medium text-gray-600 dark:text-gray-300 mb-2 text-center">
                                        Sisa Budget Bulanan
                                    </h4>
                                    <div class="h-40 sm:h-48 md:h-56 flex justify-center items-center">
                                        <canvas id="remainingBudgetChart" class="max-w-full"></canvas>
                                    </div>
                                </div>

                                <!-- Rata-rata Pengeluaran Harian -->
                                <div class="bg-gray-50 dark:bg-gray-700/70 p-3 rounded-md transition hover:shadow-md">
                                    <h4 class="text-xs sm:text-sm font-medium text-gray-600 dark:text-gray-300 mb-2">
                                        Rata-rata Pengeluaran Harian
                                    </h4>
                                    <div class="flex items-center justify-center h-40 sm:h-48 md:h-56">
                                        <p id="avgDailyExpense"
                                            class="text-xl sm:text-2xl font-medium text-gray-800 dark:text-white"></p>
                                    </div>
                                </div>

                                <!-- Prediksi Sisa Saldo Akhir Bulan -->
                                <div class="bg-gray-50 dark:bg-gray-700/70 p-3 rounded-md transition hover:shadow-md">
                                    <h4 class="text-xs sm:text-sm font-medium text-gray-600 dark:text-gray-300 mb-2">
                                        Prediksi Sisa Saldo di Akhir Bulan
                                    </h4>
                                    <div class="h-40 sm:h-48 md:h-56 flex justify-center items-center">
                                        <canvas id="predictedBalanceChart"></canvas>
                                    </div>
                                </div>

                                <!-- Persentase Kategori Pengeluaran Terbesar -->
                                <div class="bg-gray-50 dark:bg-gray-700/70 p-3 rounded-md transition hover:shadow-md">
                                    <h4
                                        class="text-xs sm:text-sm font-medium text-gray-600 dark:text-gray-300 mb-2 text-center">
                                        Kategori Pengeluaran Terbesar
                                    </h4>
                                    <div class="h-40 sm:h-48 md:h-56 flex justify-center items-center">
                                        <canvas id="topSpendingCategoriesChart" class="max-w-full"></canvas>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Include Chart.js Library -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://unpkg.com/@popperjs/core@2"></script>
    <script src="https://unpkg.com/tippy.js@6"></script>

    <script>
        document.addEventListener("DOMContentLoaded", async function() {
            try {
                const response = await fetch("/dashboard-data");
                const data = await response.json();

                // 🔹 Update rata-rata pengeluaran harian
                document.getElementById("avgDailyExpense").innerText =
                    `Rp ${data.dailyExpenseAvg.toLocaleString()}`;

                // 🔹 Chart Pemasukan vs Pengeluaran (Doughnut Chart)
                new Chart(document.getElementById("incomeExpenseChart").getContext("2d"), {
                    type: "doughnut",
                    data: {
                        labels: ["Pemasukan", "Pengeluaran"],
                        datasets: [{
                            data: [data.income, data.expense],
                            backgroundColor: ["rgba(52, 211, 153, 0.8)",
                                "rgba(248, 113, 113, 0.8)"
                            ],
                            borderColor: ["rgb(16, 185, 129)", "rgb(239, 68, 68)"],
                            borderWidth: 1,
                            borderRadius: 4,
                            hoverOffset: 6
                        }]
                    },
                    options: {
                        cutout: "65%",
                        responsive: true,
                        maintainAspectRatio: false,
                        plugins: {
                            legend: {
                                position: "bottom"
                            },
                            tooltip: {
                                backgroundColor: "rgba(17, 24, 39, 0.8)",
                                callbacks: {
                                    label: (tooltipItem) => `Rp ${tooltipItem.raw.toLocaleString()}`
                                }
                            }
                        }
                    }
                });

                // 🔹 Chart Saldo Perbulan (Line Chart)
                const balanceHistoryCtx = document.getElementById("balanceHistoryChart").getContext("2d");
                const gradient = balanceHistoryCtx.createLinearGradient(0, 0, 0, 400);
                gradient.addColorStop(0, "rgba(59, 130, 246, 0.5)");
                gradient.addColorStop(1, "rgba(59, 130, 246, 0.0)");

                new Chart(balanceHistoryCtx, {
                    type: "line",
                    data: {
                        labels: data.balanceHistory.map(item => item.date),
                        datasets: [{
                            label: "Saldo",
                            data: data.balanceHistory.map(item => item.balance),
                            borderColor: "rgb(59, 130, 246)",
                            backgroundColor: gradient,
                            fill: true,
                            tension: 0.3
                        }]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false, // Supaya lebih fleksibel di mobile
                        plugins: {
                            legend: {
                                position: "bottom" // Agar legend tidak memakan banyak tempat
                            }
                        }
                    }
                });

                // 🔹 Chart Penggunaan Budget per Kategori (Bar Chart)
                new Chart(document.getElementById("budgetUsageChart"), {
                    type: "bar",
                    data: {
                        labels: data.budgetUsage.map(b => b.category),
                        datasets: [{
                                label: "Budget",
                                data: data.budgetUsage.map(b => b.budget),
                                backgroundColor: "rgba(54, 162, 235, 0.6)"
                            },
                            {
                                label: "Terpakai",
                                data: data.budgetUsage.map(b => b.spent),
                                backgroundColor: "rgba(255, 99, 132, 0.6)"
                            }
                        ]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false, // Supaya lebih fleksibel di mobile
                        plugins: {
                            legend: {
                                position: "bottom" // Agar legend tidak memakan banyak tempat
                            }
                        }
                    }
                });

                // 🔹 Chart Sisa Budget (Doughnut Chart)
                new Chart(document.getElementById("remainingBudgetChart"), {
                    type: "doughnut",
                    data: {
                        labels: ["Terpakai", "Tersisa"],
                        datasets: [{
                            data: [data.totalSpent, data.remainingBudget],
                            backgroundColor: ["#FF6384", "#36A2EB"]
                        }]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false, // Supaya lebih fleksibel di mobile
                        plugins: {
                            legend: {
                                position: "bottom" // Agar legend tidak memakan banyak tempat
                            }
                        }
                    }
                });

                // 🔹 Chart Prediksi Saldo Akhir Bulan (Line Chart)
                new Chart(document.getElementById("predictedBalanceChart"), {
                    type: "line",
                    data: {
                        labels: ["Hari Ini", "Minggu Depan", "Akhir Bulan"],
                        datasets: [{
                            label: "Prediksi Saldo",
                            data: [data.totalBudget, data.remainingBudget, data.predictedBalance
                            ],
                            borderColor: "#4CAF50",
                            fill: false
                        }]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false, // Supaya lebih fleksibel di mobile
                        plugins: {
                            legend: {
                                position: "bottom" // Agar legend tidak memakan banyak tempat
                            }
                        }
                    }
                });

                // 🔹 Chart Kategori Pengeluaran Terbesar (Pie Chart)
                new Chart(document.getElementById("topSpendingCategoriesChart"), {
                    type: "pie",
                    data: {
                        labels: data.topCategories.map(c => c.name),
                        datasets: [{
                            data: data.topCategories.map(c => c.total_spent),
                            backgroundColor: ["#FF6384", "#36A2EB", "#FFCE56", "#4BC0C0",
                                "#9966FF"
                            ]
                        }]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false, // Supaya lebih fleksibel di mobile
                        plugins: {
                            legend: {
                                position: "bottom" // Agar legend tidak memakan banyak tempat
                            }
                        }
                    }
                });

            } catch (error) {
                console.error("Gagal mengambil data dashboard:", error);
            }
        });


        // Tippy.js for tooltips with improved animation
        document.addEventListener('DOMContentLoaded', function() {
            tippy('#infoSaldo', {
                content: "Total saldo = Total penjumlahan dari saldo semua akun keuangan",
                placement: 'top',
                animation: 'scale',
                theme: 'light',
                trigger: 'click',
                maxWidth: 250,
                duration: [200, 150],
                arrow: true,
                inertia: true
            });
        });

        // Enhanced slider functionality
        const slider = document.getElementById('slider');
        const slides = slider.children;
        const totalSlides = slides.length;
        const indicators = document.querySelectorAll('.slider-indicator');
        let index = 0;
        let autoSlideInterval;

        function updateSlide() {
            // Add transition effect
            slider.style.transition = 'transform 0.5s ease-in-out';
            slider.style.transform = `translateX(-${index * 100}%)`;

            // Update indicators
            indicators.forEach((indicator, i) => {
                if (i === index) {
                    indicator.classList.add('bg-white', 'dark:bg-gray-300', 'scale-125');
                    indicator.classList.remove('bg-white/60', 'dark:bg-gray-300/60');
                } else {
                    indicator.classList.remove('bg-white', 'dark:bg-gray-300', 'scale-125');
                    indicator.classList.add('bg-white/60', 'dark:bg-gray-300/60');
                }
            });
        }

        function nextSlide() {
            index = (index + 1) % totalSlides;
            updateSlide();
        }

        function prevSlide() {
            index = (index - 1 + totalSlides) % totalSlides;
            updateSlide();
        }

        function startAutoSlide() {
            autoSlideInterval = setInterval(nextSlide, 5000);
        }

        function resetAutoSlide() {
            clearInterval(autoSlideInterval);
            startAutoSlide();
        }

        document.getElementById('next').addEventListener('click', () => {
            nextSlide();
            resetAutoSlide();
        });

        document.getElementById('prev').addEventListener('click', () => {
            prevSlide();
            resetAutoSlide();
        });

        // Allow clicking on indicators to jump to slides
        indicators.forEach((indicator, i) => {
            indicator.addEventListener('click', () => {
                index = i;
                updateSlide();
                resetAutoSlide();
            });
        });

        // Added touch swipe support for slider
        let touchStartX = 0;
        let touchEndX = 0;

        slider.addEventListener('touchstart', e => {
            touchStartX = e.changedTouches[0].screenX;
        }, false);

        slider.addEventListener('touchend', e => {
            touchEndX = e.changedTouches[0].screenX;
            handleSwipe();
        }, false);

        function handleSwipe() {
            if (touchEndX < touchStartX - 50) {
                nextSlide(); // Swipe left
                resetAutoSlide();
            } else if (touchEndX > touchStartX + 50) {
                prevSlide(); // Swipe right
                resetAutoSlide();
            }
        }

        startAutoSlide();

        document.addEventListener("DOMContentLoaded", function() {
            const toggleButton = document.getElementById("toggleVisibility");
            const amounts = document.querySelectorAll(".hidden-amount .amount");
            const eyeOpen = document.getElementById("eyeOpen");
            const eyeSlash = document.getElementById("eyeSlash");

            // Simpan angka asli ke dalam data attribute (hanya jika belum ada)
            amounts.forEach(amount => {
                if (!amount.dataset.original) {
                    amount.dataset.original = amount.textContent.trim(); // Simpan angka asli
                }
            });

            // Cek status dari LocalStorage
            let isHidden = localStorage.getItem("hideAmount") === "true";
            updateVisibility();

            toggleButton.addEventListener("click", function() {
                isHidden = !isHidden;
                localStorage.setItem("hideAmount", isHidden);
                updateVisibility();
            });

            function updateVisibility() {
                amounts.forEach(amount => {
                    amount.textContent = isHidden ? "•••••" : amount.dataset.original;
                });
                eyeOpen.classList.toggle("hidden", isHidden);
                eyeSlash.classList.toggle("hidden", !isHidden);
            }
        });
    </script>

</x-app-layout>
