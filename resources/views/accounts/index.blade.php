<x-app-layout>
    <x-slot name="header">
        <h2 class="text-2xl font-bold text-gray-800 dark:text-white">Daftar Akun</h2>
    </x-slot>

    <div class="py-8">

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">           
            <div class="mb-6 bg-blue-50 dark:bg-gray-800 border-l-4 border-blue-500 dark:border-blue-400 p-4 rounded-lg shadow-sm">
                <div class="flex items-start">
                    <div class="flex-shrink-0">
                        <svg class="h-6 w-6 text-blue-500 dark:text-blue-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m0-4h.01M12 2a10 10 0 11-10 10A10 10 0 0112 2z" />
                        </svg>
                    </div>
                    <div class="ml-3">
                        <h3 class="text-sm font-semibold text-gray-800 dark:text-gray-200">
                            Kelola Akun Keuanganmu dengan Mudah 💳
                        </h3>
                        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                            Akun Keuangan membantumu mengatur saldo di berbagai tempat seperti bank, dompet digital, atau uang tunai.
                            Tambahkan akun dan pantau perubahan saldonya dengan lebih praktis!
                        </p>
                        <button onclick="openAccountModal()" class="mt-2 text-sm font-medium text-indigo-600 dark:text-indigo-400 hover:text-indigo-800 transition-colors">
                            Informasi Selengkapnya →
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <div id="accountModal" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 hidden px-4">
            <div class="bg-white dark:bg-gray-900 rounded-lg p-6 sm:p-8 max-w-lg w-full shadow-lg relative 
                        sm:max-w-sm md:max-w-md lg:max-w-lg transition-all">
                
                <!-- Ilustrasi -->
                <div class="flex justify-center">
                    <img src="https://cdn-icons-png.flaticon.com/512/1086/1086741.png" 
                         alt="Accounts Illustration" 
                         class="w-10 h-10 sm:w-12 sm:h-12 md:w-14 md:h-14 lg:w-16 lg:h-16 transition-all">
                </div>
        
                <!-- Judul -->
                <h3 class="text-xl md:text-2xl font-bold text-center text-gray-900 dark:text-gray-100 mt-4 md:mt-6">
                    Kelola Akun Keuanganmu dengan Mudah 💳
                </h3>
        
                <!-- Isi Modal -->
                <p class="mt-3 md:mt-5 text-gray-700 dark:text-gray-300 text-sm md:text-base leading-relaxed">
                    Dengan fitur <strong>Akun Keuangan</strong>, kamu bisa <strong>menambahkan akun secara manual</strong> seperti 
                    rekening bank, dompet digital, atau uang tunai. 
                </p>
        
                <p class="mt-3 md:mt-4 text-gray-700 dark:text-gray-300 text-sm md:text-base leading-relaxed">
                    Setiap akun memiliki <strong>nama, saldo, dan tipe akun</strong> (misalnya "DANA", "BCA", atau "Tunai"), 
                    sehingga kamu bisa mengelola keuangan dengan lebih jelas.
                </p>
        
                <!-- Highlight Info -->
                <div class="mt-4 md:mt-6 p-3 md:p-4 bg-indigo-100 dark:bg-indigo-900 text-indigo-800 dark:text-indigo-200 rounded-md 
                            text-sm md:text-base leading-relaxed">
                    Demi <strong>keamanan dan privasi</strong>, aplikasi ini <strong>tidak terhubung langsung ke rekening bank atau dompet digital</strong>.  
                    Semua saldo <strong>diinput manual oleh pengguna</strong> untuk memberikan kendali penuh atas pencatatan keuanganmu.
                </div>
        
                <!-- CTA -->
                <div class="mt-6 md:mt-8 text-center">
                    <button onclick="closeAccountModal()" 
                            class="px-4 py-2 md:px-6 md:py-3 bg-indigo-500 hover:bg-indigo-600 text-white 
                            text-sm md:text-base font-medium rounded-md shadow-md transition-all">
                        Saya Mengerti
                    </button>
                </div>
            </div>
        </div>            

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 shadow-sm rounded-lg overflow-hidden">
    
                <div class="px-6 py-5 border-b border-gray-100 dark:border-gray-700">
                    <div class="flex flex-col md:flex-row md:justify-between md:items-center gap-4">
                        <h3 class="text-lg font-medium text-gray-800 dark:text-gray-200">Akun Keuangan</h3>
                        
                        <a href="{{ route('accounts.create') }}"
                            class="shrink-0 px-4 py-2 bg-blue-500 hover:bg-blue-600 text-white text-sm font-medium justify-center md:justify-end rounded-lg shadow-sm transition">
                            + Tambah Akun
                        </a>
                    </div>
                </div>
    
                <!-- Improved Desktop Table Design -->
                <div class="hidden md:block overflow-x-auto">
                    <table class="w-full">
                        <thead>
                            <tr class="text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                                <th class="px-6 py-3 border-b border-gray-100 dark:border-gray-700">Nama Akun</th>
                                <th class="px-6 py-3 border-b border-gray-100 dark:border-gray-700">Saldo</th>
                                <th class="px-6 py-3 border-b border-gray-100 dark:border-gray-700">Tipe</th>
                                <th class="px-6 py-3 border-b border-gray-100 dark:border-gray-700 text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100 dark:divide-gray-700">
                            @foreach ($accounts as $account)
                                <tr class="hover:bg-gray-50 dark:hover:bg-gray-700 transition">
                                    <td class="px-6 py-4 text-sm font-medium text-gray-800 dark:text-gray-200">
                                        {{ $account->name }}
                                    </td>
                                    <td class="px-6 py-4 text-sm text-gray-700 dark:text-gray-300 font-medium">
                                        Rp {{ number_format($account->balance, 0, ',', '.') }}
                                    </td>
                                    <td class="px-6 py-4">
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium
                                            {{ $account->type == 'savings' ? 'bg-green-100 text-green-800 dark:bg-green-900/40 dark:text-green-400' : 'bg-purple-100 text-purple-800 dark:bg-purple-900/40 dark:text-purple-400' }}">
                                            {{ ucfirst($account->type) }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 text-center text-sm font-medium">
                                        <div class="flex justify-center gap-4">
                                            <a href="{{ route('accounts.edit', $account->id) }}" 
                                                class="text-yellow-600 hover:text-yellow-800 dark:text-yellow-500 dark:hover:text-yellow-400 transition hover:underline">
                                                Edit
                                            </a>
                                            <button onclick="confirmDelete({{ $account->id }})" 
                                                class="text-red-600 hover:text-red-800 dark:text-red-500 dark:hover:text-red-400 transition hover:underline">
                                                Hapus
                                            </button>
                                            <form id="delete-form-{{ $account->id }}" action="{{ route('accounts.destroy', $account->id) }}" method="POST" class="hidden">
                                                @csrf
                                                @method('DELETE')
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
    
                <!-- Improved Mobile Card Design -->
                <div class="md:hidden px-4 pt-2 pb-4">
                    @foreach ($accounts as $account)
                        <div class="bg-white dark:bg-gray-800 border border-gray-100 dark:border-gray-700 rounded-lg p-4 mb-4 shadow-sm">
                            
                            <div class="flex justify-between mb-3">
                                <!-- Account Type Badge -->
                                <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-medium
                                    {{ $account->type == 'savings' ? 'bg-green-100 text-green-800 dark:bg-green-900/40 dark:text-green-400' : 'bg-purple-100 text-purple-800 dark:bg-purple-900/40 dark:text-purple-400' }}">
                                    {{ ucfirst($account->type) }}
                                </span>
    
                                <!-- Saldo -->
                                <p class="text-sm font-medium text-gray-900 dark:text-gray-100">
                                    Rp {{ number_format($account->balance, 0, ',', '.') }}
                                </p>
                            </div>
    
                            <!-- Nama Akun -->
                            <p class="text-sm font-medium text-gray-800 dark:text-gray-200 mb-2">
                                {{ $account->name }}
                            </p>
    
                            <!-- Actions -->
                            <div class="mt-4 pt-3 border-t border-gray-100 dark:border-gray-700 flex justify-end gap-6">
                                <a href="{{ route('accounts.edit', $account->id) }}" 
                                    class="text-sm text-yellow-600 dark:text-yellow-500 font-medium hover:underline">Edit</a>
                                <button onclick="confirmDelete({{ $account->id }})" 
                                    class="text-sm text-red-600 dark:text-red-500 font-medium hover:underline">
                                    Hapus
                                </button>
                                <form id="delete-form-{{ $account->id }}" action="{{ route('accounts.destroy', $account->id) }}" method="POST" class="hidden">
                                    @csrf
                                    @method('DELETE')
                                </form>
                            </div>
                        </div>
                    @endforeach
                </div>
    
                <!-- Pagination -->
                <div class="px-6 py-4">
                    {{ $accounts->links() }}
                </div>
            </div>
        </div>
    </div>
    
    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
        @if(session('success'))
            Swal.fire({
                icon: "success",
                title: "Berhasil!",
                text: "{{ session('success') }}",
                confirmButtonColor: "#3085d6",
            });
        @endif

        @if(session('error'))
            Swal.fire({
                icon: "error",
                title: "Gagal!",
                text: "{{ session('error') }}",
                confirmButtonColor: "#d33",
            });
        @endif
    });

        function confirmDelete(accountId) {
            Swal.fire({
                title: "Yakin mau hapus?",
                text: "Akun ini akan dihapus permanen!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#d33",
                cancelButtonColor: "#3085d6",
                confirmButtonText: "Ya, hapus!",
                cancelButtonText: "Batal"
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById(`delete-form-${accountId}`).submit();
                }
            });
        }

        function openAccountModal() {
        document.getElementById("accountModal").classList.remove("hidden");
    }

    function closeAccountModal() {
        document.getElementById("accountModal").classList.add("hidden");
    }
    </script>
</x-app-layout>
