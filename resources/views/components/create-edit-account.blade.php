<x-app-layout>
    <x-slot name="header">
        <h2 class="text-2xl font-bold text-gray-800 dark:text-white">Kelola Akun Keuangan</h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 shadow-md rounded-lg p-6">

                <!-- Tombol Back -->
                <div class="mb-6">
                    <a href="{{ route('accounts.index') }}" class="inline-flex items-center px-4 py-2 text-sm font-medium text-blue-700 bg-blue-100 hover:bg-blue-200 rounded-lg border border-blue-300">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M19 12H5"></path>
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 5l-7 7 7 7"></path>
                        </svg>
                        Kembali ke Accounts
                    </a>
                </div>

                <h3 class="text-lg font-semibold dark:text-gray-200 mb-4">{{ isset($account) ? 'Edit Akun' : 'Tambah Akun' }}</h3>
                
                <form action="{{ isset($account) ? route('accounts.update', $account->id) : route('accounts.store') }}" method="POST">
                    @csrf
                    @if(isset($account))
                        @method('PUT')
                    @endif

                    <div class="mb-4">
                        <label for="name" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Nama Akun</label>
                        <input type="text" name="name" id="name" required
                               value="{{ old('name', $account->name ?? '') }}"
                               class="mt-1 block w-full px-4 py-2 border rounded-md dark:bg-gray-700 dark:text-gray-200">
                    </div>

                    <div class="mb-4">
                        <label for="balance" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Saldo Awal</label>
                        <input type="number" name="balance" id="balance" required step="0.01"
                               value="{{ old('balance', $account->balance ?? 0) }}"
                               class="mt-1 block w-full px-4 py-2 border rounded-md dark:bg-gray-700 dark:text-gray-200">
                    </div>

                    <div class="mb-4">
                        <label for="type" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Tipe Akun</label>
                        <select name="type" id="type" required
                                class="mt-1 block w-full px-4 py-2 border rounded-md dark:bg-gray-700 dark:text-gray-200">
                            <option value="bank" {{ old('type', $account->type ?? '') == 'bank' ? 'selected' : '' }}>Bank</option>
                            <option value="e-wallet" {{ old('type', $account->type ?? '') == 'e-wallet' ? 'selected' : '' }}>E-Wallet</option>
                            <option value="cash" {{ old('type', $account->type ?? '') == 'cash' ? 'selected' : '' }}>Cash</option>
                        </select>
                    </div>

                    <div class="flex justify-end gap-2">
                        <a href="{{ route('accounts.index') }}" 
                           class="px-4 py-2 bg-gray-500 hover:bg-gray-600 text-white rounded-lg shadow-md transition">
                            Batal
                        </a>
                        <button type="submit" 
                                class="px-4 py-2 bg-blue-500 hover:bg-blue-600 text-white rounded-lg shadow-md transition">
                            {{ isset($account) ? 'Perbarui' : 'Simpan' }}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
