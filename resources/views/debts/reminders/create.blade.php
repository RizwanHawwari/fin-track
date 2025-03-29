<x-app-layout>
    <x-slot name="header">
        <h2 class="text-2xl font-bold text-gray-800 dark:text-white">Tambah Reminder Hutang</h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 shadow-md rounded-lg p-6">

                <!-- Tombol Back -->
                <div class="mb-6">
                    <a href="{{ route('debt-reminders.index') }}"
                        class="inline-flex items-center px-4 py-2 text-sm font-medium text-blue-700 bg-blue-100 hover:bg-blue-200 rounded-lg border border-blue-300">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 mr-2" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24" stroke-width="2" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M19 12H5"></path>
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 5l-7 7 7 7"></path>
                        </svg>
                        Kembali ke Reminder Hutang
                    </a>
                </div>

                <form action="{{ route('debt-reminders.store') }}" method="POST" class="space-y-6">
                    @csrf

                    <!-- Nama Penerima -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Nama Penerima</label>
                        <input type="text" name="counterparty" required
                            class="w-full mt-1 p-2 border rounded-lg dark:bg-gray-700 dark:border-gray-600 dark:text-white"
                            placeholder="Masukkan nama penerima hutang">
                    </div>

                    <!-- Deskripsi Hutang -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Deskripsi</label>
                        <textarea name="description" class="w-full mt-1 p-2 border rounded-lg dark:bg-gray-700 dark:border-gray-600 dark:text-white" placeholder="Opsional"></textarea>
                    </div>

                    <!-- Jumlah Hutang -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Jumlah Hutang</label>
                        <input type="number" name="amount" required min="1"
                            class="w-full mt-1 p-2 border rounded-lg dark:bg-gray-700 dark:border-gray-600 dark:text-white"
                            placeholder="Masukkan jumlah hutang">
                    </div>

                    <!-- Tanggal Jatuh Tempo -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Jatuh Tempo</label>
                        <input type="date" name="due_date" required
                            class="w-full mt-1 p-2 border rounded-lg dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                    </div>

                    <!-- Tombol Simpan -->
                    <div class="flex justify-end">
                        <button type="submit"
                            class="px-4 py-2 bg-blue-500 text-white rounded-lg hover:bg-blue-600 transition">
                            Simpan Reminder
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
