<x-app-layout>
    <x-slot name="header">
        <h2 class="text-2xl font-bold text-gray-800 dark:text-white">Edit Transaksi</h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 shadow-md rounded-lg p-6">

                <!-- Tombol Back -->
                <div class="mb-6">
                    <a href="{{ route('transactions.index') }}"
                        class="inline-flex items-center px-4 py-2 text-sm font-medium text-blue-700 bg-blue-100 hover:bg-blue-200 rounded-lg border border-blue-300">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 mr-2" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24" stroke-width="2" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M19 12H5"></path>
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 5l-7 7 7 7"></path>
                        </svg>
                        Kembali ke Transaksi
                    </a>
                </div>

                <!-- Ganti Gambar Header jadi Background Gradasi dengan font Copperplate -->
                <div class="mb-6 bg-cover bg-center rounded-lg h-36 flex items-center justify-center"
                    style="background-image: url('https://i.gifer.com/76YS.gif');">
                </div>

                <form action="{{ route('transactions.update', $transaction->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="space-y-6">
                        <div>
                            <label for="transaction_date"
                                class="block text-sm font-medium text-gray-700 dark:text-gray-200">Tanggal
                                Transaksi</label>
                            <input type="date" id="transaction_date" name="transaction_date"
                                value="{{ old('transaction_date', \Carbon\Carbon::parse($transaction->transaction_date)->toDateString()) }}"
                                class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-200 focus:border-blue-500"
                                required>
                            @error('transaction_date')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="description"
                                class="block text-sm font-medium text-gray-700 dark:text-gray-200">Deskripsi</label>
                            <textarea id="description" name="description" rows="3"
                                class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:text-gray-200"
                                required>{{ old('description', $transaction->description) }}</textarea>
                            @error('description')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>


                        <div>
                            <label for="amount"
                                class="block text-sm font-medium text-gray-700 dark:text-gray-200">Jumlah</label>
                            <input type="text" name="amount" id="amount"
                                value="{{ old('amount', number_format($transaction->amount, 0, ',', '.')) }}"
                                class="mt-1 block w-full dark:bg-gray-700 dark:border-gray-600 dark:text-gray-200 border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500"
                                required>
                            @error('amount')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="type"
                                class="block text-sm font-medium text-gray-700 dark:text-gray-200">Tipe
                                Transaksi</label>
                            <select id="type" name="type"
                                class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:text-gray-200 focus:border-blue-500"
                                required>
                                <option value="income"
                                    {{ old('type', $transaction->type) === 'income' ? 'selected' : '' }}>Pemasukan
                                </option>
                                <option value="expense"
                                    {{ old('type', $transaction->type) === 'expense' ? 'selected' : '' }}>Pengeluaran
                                </option>
                            </select>
                            @error('type')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Kategori -->
                        <div>
                            <label for="category_id"
                                class="block text-sm font-medium text-gray-700 dark:text-gray-200">Kategori</label>
                            <select id="category_id" name="category_id"
                                class="mt-1 block w-full border-gray-300 rounded-md shadow-sm dark:bg-gray-700 dark:border-gray-600 dark:text-gray-200 focus:ring-blue-500 focus:border-blue-500"
                                required>
                                @if ($categories->isEmpty())
                                    <option value="" disabled selected>👀 Hmm... belum ada kategori nih!</option>
                                @else
                                    <option value="" disabled>🔍 Pilih kategori transaksi...</option>
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}"
                                            {{ old('category_id', $transaction->category_id) == $category->id ? 'selected' : '' }}>
                                            {{ $category->name }}
                                        </option>
                                    @endforeach
                                @endif
                            </select>
                            @error('category_id')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror

                            <div class="mt-2">
                                <button type="button" id="manageCategories"
                                    class="text-blue-600 dark:text-blue-400 font-medium hover:underline">
                                    Kelola atau Tambah Kategori
                                </button>
                            </div>
                        </div>


                        <div>
                            <label for="account_id"
                                class="block text-sm font-medium text-gray-700 dark:text-gray-200">Akun</label>
                            <select id="account_id" name="account_id"
                                class="mt-1 block w-full border-gray-300 rounded-md shadow-sm dark:bg-gray-700 dark:border-gray-600  dark:text-gray-200 focus:ring-blue-500 focus:border-blue-500"
                                required>

                                @if ($accounts->isEmpty())
                                    <option value="" disabled selected>👀 Hmm... belum ada akun nih!</option>
                                @else
                                    <option value="" disabled>🔍 Pilih akun keuangan...</option>
                                    @foreach ($accounts as $account)
                                        <option value="{{ $account->id }}"
                                            {{ old('account_id', $transaction->account_id) == $account->id ? 'selected' : '' }}>
                                            {{ $account->name }}</option>
                                    @endforeach
                                @endif

                            </select>
                            @error('account_id')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror

                            <div class="mt-2">
                                <a href="{{ route('accounts.index') }}"
                                    class="text-blue-600 dark:text-blue-400 font-medium hover:underline">
                                    Kelola atau Tambah Akun
                                </a>
                            </div>
                        </div>

                        <div class="flex justify-end">
                            <button type="submit"
                                class="px-4 py-2 bg-yellow-500 text-white rounded-lg hover:bg-yellow-600 transition">
                                Simpan Transaksi
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    @if (session('error'))
        <script>
            Swal.fire({
                icon: 'error',
                title: 'Oops!',
                text: "{{ session('error') }}",
            });
        </script>
    @endif

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const amountInput = document.querySelector('input[name="amount"]');

            amountInput.addEventListener('input', function(e) {
                let value = e.target.value.replace(/\./g, ''); // Hapus titik yang sudah ada
                let formattedValue = new Intl.NumberFormat('id-ID').format(value); // Format ulang
                e.target.value = formattedValue;
            });

            // Sebelum form disubmit, pastikan kita menghapus titik di amount
            const form = document.querySelector('form');
            form.addEventListener('submit', function(e) {
                let amountValue = amountInput.value.replace(/\./g, ''); // Hapus titik
                amountInput.value = amountValue; // Update value tanpa titik
            });
        });

        document.getElementById('manageCategories').addEventListener('click', function() {
            Swal.fire({
                title: 'Select Categories',
                html: `<div id="category-container" class="text-left p-4">
                <div class="text-center text-gray-500 animate-pulse">Loading categories...</div>
               </div>`,
                width: 550,
                padding: '1.5rem',
                color: '#1F2937',
                background: 'white',
                backdrop: `rgba(0,0,0,0.1) backdrop-blur-sm`,
                showCancelButton: true,
                confirmButtonText: 'Save',
                cancelButtonText: 'Cancel',
                confirmButtonColor: '#3B82F6',
                cancelButtonColor: '#6B7280',
                showLoaderOnConfirm: true,
                grow: 'down',
                animation: true,
                customClass: {
                    popup: 'rounded-2xl shadow-2xl border-2 border-gray-100 transition-all duration-300 ease-in-out',
                    title: 'text-2xl font-semibold text-gray-800 mb-4',
                    confirmButton: 'px-4 py-2 text-sm rounded-xl text-white font-semibold bg-blue-500 hover:bg-blue-600 focus:ring-2 focus:ring-blue-300 transition-all duration-200 ease-in-out transform hover:scale-105',
                    cancelButton: 'px-4 py-2 text-sm rounded-xl font-semibold text-gray-700 bg-gray-200 hover:bg-gray-300 focus:ring-2 focus:ring-gray-300 transition-all duration-200 ease-in-out transform hover:scale-105'
                },
                preConfirm: () => {
                    let selectedCategories = [];
                    document.querySelectorAll('input[name="categories[]"]:checked').forEach((el) => {
                        selectedCategories.push(el.value);
                    });

                    return fetch("{{ route('user.categories.store') }}", {
                            method: "POST",
                            body: JSON.stringify({
                                categories: selectedCategories
                            }),
                            headers: {
                                "X-CSRF-TOKEN": "{{ csrf_token() }}",
                                "Content-Type": "application/json",
                            },
                        })
                        .then(response => response.json())
                        .then(data => {
                            let timerInterval;
                            let countdown = 3;
                            Swal.fire({
                                icon: 'success',
                                title: 'Success!',
                                html: `Page will refresh in <b>${countdown}</b> seconds...`,
                                timer: countdown * 1000,
                                timerProgressBar: true,
                                didOpen: () => {
                                    Swal.showLoading();
                                    const timer = Swal.getPopup().querySelector("b");
                                    timerInterval = setInterval(() => {
                                        countdown--;
                                        timer.textContent = countdown;
                                    }, 1000);
                                },
                                willClose: () => {
                                    clearInterval(timerInterval);
                                    location.reload();
                                },
                                customClass: {
                                    popup: 'rounded-2xl shadow-2xl',
                                    title: 'text-xl font-semibold text-green-600',
                                    timerProgressBar: 'bg-green-400'
                                }
                            });
                        })
                        .catch(() => {
                            let timerInterval;
                            Swal.fire({
                                icon: 'error',
                                title: 'Oops!',
                                html: 'Something went wrong, please try again!<br>Closing in <b></b> seconds...',
                                timer: 2500,
                                timerProgressBar: true,
                                didOpen: () => {
                                    Swal.showLoading();
                                    const timer = Swal.getPopup().querySelector("b");
                                    timerInterval = setInterval(() => {
                                        timer.textContent = Math.ceil(Swal
                                            .getTimerLeft() / 1000);
                                    }, 100);
                                },
                                willClose: () => {
                                    clearInterval(timerInterval);
                                },
                                customClass: {
                                    popup: 'rounded-2xl shadow-2xl',
                                    title: 'text-xl font-semibold text-red-600',
                                    timerProgressBar: 'bg-red-400'
                                }
                            });
                        });
                },
                didOpen: () => {
                    fetch("{{ route('user.categories.index') }}")
                        .then(response => response.json())
                        .then(data => {
                            let categoryHTML = `<div class="grid grid-cols-2 gap-3">`;
                            data.categories.forEach(category => {
                                let checked = data.selectedCategories.includes(category
                                    .id) ? "checked" : "";
                                categoryHTML += `
                        <label class="flex items-center space-x-3 p-3 rounded-xl hover:bg-blue-50 transition-all duration-200 cursor-pointer group">
                            <input type="checkbox" name="categories[]" value="${category.id}" ${checked}
                                class="w-5 h-5 rounded-md border-gray-300 text-blue-500 focus:ring-blue-400 transition-all duration-200 transform hover:scale-110 checked:scale-100">
                            <span class="text-gray-700 text-sm font-medium group-hover:text-blue-600 transition-colors duration-200">${category.name}</span>
                        </label>
                    `;
                            });
                            categoryHTML += `</div>`;
                            document.getElementById('category-container').innerHTML = categoryHTML;
                        });

                    document.querySelector('.swal2-confirm').classList.add('shadow-md');
                    document.querySelector('.swal2-cancel').classList.add('shadow-md');
                }
            });
        });
    </script>


</x-app-layout>
