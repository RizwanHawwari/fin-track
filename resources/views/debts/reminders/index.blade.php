<x-app-layout>
    <x-slot name="header">
        <h2 class="text-2xl font-bold text-gray-800 dark:text-white">Reminder Hutang</h2>
    </x-slot>

    <div class="py-8">
        <!-- Modal Informasi -->
        <div id="reminderModal" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 hidden px-4">
            <div class="bg-white dark:bg-gray-900 rounded-lg p-6 sm:p-8 max-w-lg w-full shadow-lg relative 
                        sm:max-w-sm md:max-w-md lg:max-w-lg transition-all">
                <!-- Ilustrasi -->
                <div class="flex justify-center">
                    <img src="https://cdn-icons-png.flaticon.com/512/3616/3616763.png" alt="Reminder Illustration"
                        class="w-12 h-12 md:w-14 md:h-14 lg:w-16 lg:h-16">
                </div>

                <!-- Judul -->
                <h3 class="text-xl md:text-2xl font-bold text-center text-gray-900 dark:text-gray-100 mt-4 md:mt-6">
                    Jangan Sampai Lupa Bayar Hutang! 💰
                </h3>

                <!-- Isi Modal -->
                <p class="mt-3 text-gray-700 dark:text-gray-300 text-sm md:text-base leading-relaxed">
                    Dengan fitur Reminder Hutang, kamu bisa <strong>menjadwalkan pengingat</strong> agar tidak melewatkan pembayaran hutangmu.
                </p>

                <p class="mt-3 text-gray-700 dark:text-gray-300 text-sm md:text-base leading-relaxed">
                    Reminder ini akan memberitahu kamu sebelum jatuh tempo, sehingga kamu bisa mengatur keuangan dengan lebih baik.
                </p>

                <!-- Highlight Info -->
                <div class="mt-4 p-3 bg-indigo-100 dark:bg-indigo-900 text-indigo-800 dark:text-indigo-200 rounded-md 
                            text-sm md:text-base leading-relaxed">
                    Kamu akan menerima <strong class="text-indigo-700 dark:text-indigo-300">notifikasi pengingat</strong> beberapa hari sebelum jatuh tempo.
                </div>

                <!-- CTA -->
                <div class="mt-6 text-center">
                    <button onclick="closeModal()"
                        class="px-4 py-2 bg-indigo-500 hover:bg-indigo-600 text-white 
                            text-sm md:text-base font-medium rounded-md shadow-md transition-all">
                        Saya Mengerti
                    </button>
                </div>
            </div>
        </div>

        <!-- Info Box -->
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="mb-6 bg-blue-50 dark:bg-gray-800 border-l-4 border-blue-500 dark:border-blue-400 p-4 rounded-lg shadow-sm">
                <div class="flex items-start">
                    <div class="flex-shrink-0">
                        <svg class="h-6 w-6 text-blue-500 dark:text-blue-400" xmlns="http://www.w3.org/2000/svg"
                            fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M13 16h-1v-4h-1m0-4h.01M12 2a10 10 0 11-10 10A10 10 0 0112 2z" />
                        </svg>
                    </div>
                    <div class="ml-3">
                        <h3 class="text-sm font-semibold text-gray-800 dark:text-gray-200">
                            Ingatkan Diri Sendiri! ⏳
                        </h3>
                        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                            Tambahkan reminder hutang agar tidak lupa membayar sebelum jatuh tempo!
                        </p>
                        <button onclick="openModal()"
                            class="mt-2 text-sm font-medium text-indigo-600 dark:text-indigo-400 hover:text-indigo-800 transition-colors">
                            Informasi Selengkapnya →
                        </button>
                    </div>
                </div>
            </div>

            <!-- Tombol Tambah -->
            <div class="flex justify-between items-center mb-8">
                <a href="{{ route('debt-reminders.create') }}"
                    class="px-4 py-2 bg-indigo-500 hover:bg-indigo-600 text-white text-sm font-medium rounded-md shadow-md transition-colors">
                    + Tambah Reminder
                </a>
            </div>

            <!-- Grid Layout -->
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-2 lg:grid-cols-2 gap-6">
                @foreach ($reminders as $reminder)
                    <div class="bg-white dark:bg-gray-800 border border-gray-100 dark:border-gray-700 rounded-xl p-6 shadow-sm hover:shadow-md transition-all duration-300 group">
                        <div class="flex justify-between items-start mb-4">
                            <h4 class="text-lg font-bold text-gray-800 dark:text-gray-100 group-hover:text-indigo-600">
                                {{ $reminder->title }}
                            </h4>
                            <span class="text-sm font-medium {{ $reminder->status == 'paid' ? 'text-green-500' : 'text-red-500' }}">
                                {{ ucfirst($reminder->status) }}
                            </span>
                        </div>

                        <p class="text-sm text-gray-600 dark:text-gray-400">
                            {{ $reminder->description ?? 'Tidak ada keterangan.' }}
                        </p>

                        <p class="text-sm text-gray-600 dark:text-gray-400 mt-2">
                            <strong>Jatuh Tempo:</strong> {{ \Carbon\Carbon::parse($reminder->due_date)->format('d M Y') }}
                        </p>

                        <div class="flex justify-between items-center border-t border-gray-100 dark:border-gray-700 pt-4 mt-4">
                            <a href="{{ route('debt-reminders.edit', $reminder->id) }}"
                                class="text-sm text-indigo-600 dark:text-indigo-400 hover:text-indigo-800 flex items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                </svg>
                                Edit
                            </a>
                            <button onclick="confirmDelete({{ $reminder->id }})"
                                class="text-sm text-red-500 dark:text-red-400 hover:text-red-700 flex items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                </svg>
                                Hapus
                            </button>
                            <form id="delete-form-{{ $reminder->id }}"
                                action="{{ route('debt-reminders.destroy', $reminder->id) }}" method="POST" class="hidden">
                                @csrf
                                @method('DELETE')
                            </form>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        function confirmDelete(reminderId) {
            Swal.fire({
                title: "Yakin mau hapus?",
                text: "Reminder Hutang ini akan dihapus permanen!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#d33",
                cancelButtonColor: "#3085d6",
                confirmButtonText: "Ya, hapus!",
                cancelButtonText: "Batal"
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById(`delete-form-${reminderId}`).submit();
                }
            });
        }

        function openModal() {
            document.getElementById("reminderModal").classList.remove("hidden");
        }

        function closeModal() {
            document.getElementById("reminderModal").classList.add("hidden");
        }
    </script>
</x-app-layout>
