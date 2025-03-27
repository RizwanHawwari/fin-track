<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-medium text-gray-800 dark:text-white">Daftar Transaksi</h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 shadow-sm rounded-lg overflow-hidden">
                <!-- Informasi Transaksi -->
                @if(session('show_transaction_info') !== 'hidden')
                <div id="transaction-info" class="bg-blue-50 dark:bg-blue-900/40 border-l-4 border-blue-500 p-4 flex justify-between items-start mb-4">
                    <div class="flex-1">
                        <p class="text-sm text-blue-700 dark:text-blue-300 mb-1.5">
                            {{ $transactionInfo }}
                        </p>
                        <p class="text-xs font-medium text-blue-600 dark:text-blue-300">
                            (Klik <button id="understand-btn" class="underline text-blue-600 dark:text-blue-300 hover:text-blue-800 dark:hover:text-blue-200 transition">Mengerti</button> untuk menyembunyikan)
                        </p>
                    </div>
                    <button id="close-info" class="text-blue-500 dark:text-blue-300 hover:text-blue-700 dark:hover:text-blue-100 transition">&times;</button>
                </div>
                @endif

                <div class="px-6 py-5 border-b border-gray-100 dark:border-gray-700">
                    <div class="flex flex-col md:flex-row md:justify-between md:items-center gap-4">
                        <h3 class="text-lg font-medium text-gray-800 dark:text-gray-200">Transaksi</h3>
                        
                        <!-- Fixed: Mobile search input spacing -->
                        <div class="flex flex-col sm:flex-row w-full md:w-auto gap-3">
                            <div class="relative flex-1 min-w-[200px]">
                                <span class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none text-gray-400">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z" />
                                    </svg>
                                </span>
                                <input type="text" id="search" placeholder="Cari transaksi..."
                                    class="w-full pl-10 pr-3 py-2 border border-gray-200 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-200 rounded-lg text-sm shadow-sm focus:ring-1 focus:ring-blue-400 focus:border-blue-400 dark:focus:ring-blue-500 dark:focus:border-blue-500 transition"
                                    oninput="filterTransactions()">
                            </div>
                            
                            <div class="flex flex-row gap-2.5">
                                <select id="filter"
                                    class="px-3 py-2 border border-gray-200 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-200 rounded-lg text-sm shadow-sm focus:ring-1 focus:ring-blue-400 focus:border-blue-400 dark:focus:ring-blue-500 dark:focus:border-blue-500 transition"
                                    onchange="filterTransactions()">
                                    <option value="all">Semua</option>
                                    <option value="income">Pemasukan</option>
                                    <option value="expense">Pengeluaran</option>
                                </select>
                                <select id="sort"
                                    class="px-3 py-2 border border-gray-200 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-200 rounded-lg text-sm shadow-sm focus:ring-1 focus:ring-blue-400 focus:border-blue-400 dark:focus:ring-blue-500 dark:focus:border-blue-500 transition"
                                    onchange="applySorting()">
                                    <option value="newest">Terbaru</option>
                                    <option value="oldest">Terlama</option>
                                    <option value="cheapest">Termurah</option>
                                    <option value="expensive">Termahal</option>
                                </select>
                                <a href="{{ route('transactions.create') }}"
                                    class="shrink-0 px-4 py-2 bg-blue-500 hover:bg-blue-600 text-white text-sm font-medium justify-center md:justify-end rounded-lg shadow-sm transition">
                                    + Tambah Transaksi
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Improved Desktop Table Design -->
                <div class="hidden md:block overflow-x-auto">
                    <table class="w-full" id="transactionsTable">
                        <thead>
                            <tr class="text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                                <th class="px-6 py-3 border-b border-gray-100 dark:border-gray-700">Tanggal</th>
                                <th class="px-6 py-3 border-b border-gray-100 dark:border-gray-700">Keterangan</th>
                                <th class="px-6 py-3 border-b border-gray-100 dark:border-gray-700">Jumlah</th>
                                <th class="px-6 py-3 border-b border-gray-100 dark:border-gray-700">Tipe</th>
                                <!-- Fixed: Balanced alignment for "Aksi" column -->
                                <th class="px-6 py-3 border-b border-gray-100 dark:border-gray-700 text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100 dark:divide-gray-700">
                            @foreach ($transactions as $transaction)
                                <tr class="transaction-row hover:bg-gray-50 dark:hover:bg-gray-700 transition" data-desc="{{ strtolower($transaction->description) }}"
                                    data-type="{{ $transaction->type }}">
                                    <td class="px-6 py-4 text-sm text-gray-600 dark:text-gray-300">{{ \Carbon\Carbon::parse($transaction->transaction_date)->translatedFormat('d F Y') }}</td>
                                    <td class="px-6 py-4 text-sm font-medium text-gray-800 dark:text-gray-200">{{ $transaction->description }}</td>
                                    <td class="px-6 py-4 text-sm text-gray-700 dark:text-gray-300 font-medium {{ $transaction->type == 'income' ? 'text-green-600 dark:text-green-400' : 'text-red-600 dark:text-red-400' }}">
                                        Rp {{ number_format($transaction->amount, 0, ',', '.') }}
                                    </td>
                                    <td class="px-6 py-4">
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium 
                                            {{ $transaction->type == 'income' ? 'bg-green-100 text-green-800 dark:bg-green-900/40 dark:text-green-400' : 'bg-red-100 text-red-800 dark:bg-red-900/40 dark:text-red-400' }}">
                                            {{ $transaction->type == 'income' ? 'Pemasukan' : 'Pengeluaran' }}
                                        </span>
                                    </td>
                                    <!-- Fixed: Center-aligned actions with even spacing -->
                                    <td class="px-6 py-4 text-center text-sm font-medium">
                                        <div class="flex justify-center gap-4">
                                            <a href="{{ route('transactions.edit', $transaction->id) }}" 
                                                class="text-yellow-600 hover:text-yellow-800 dark:text-yellow-500 dark:hover:text-yellow-400 transition hover:underline">
                                                Edit
                                            </a>
                                            <button onclick="confirmDelete({{ $transaction->id }})" 
                                                class="text-red-600 hover:text-red-800 dark:text-red-500 dark:hover:text-red-400 transition hover:underline">
                                                Hapus
                                            </button>
                                            <form id="delete-form-{{ $transaction->id }}" action="{{ route('transactions.destroy', $transaction->id) }}" method="POST" class="hidden">
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
                    @foreach ($transactions as $transaction)
                        <div class="transaction-card bg-white dark:bg-gray-800 border border-gray-100 dark:border-gray-700 rounded-lg p-4 mb-4 shadow-sm"
                            data-desc="{{ strtolower($transaction->description) }}"
                            data-type="{{ $transaction->type }}">
                            
                            <div class="flex justify-between mb-3">
                                <!-- Transaction Type Badge - Positioned for immediate recognition -->
                                <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-medium 
                                    {{ $transaction->type == 'income' ? 'bg-green-100 text-green-800 dark:bg-green-900/40 dark:text-green-400' : 'bg-red-100 text-red-800 dark:bg-red-900/40 dark:text-red-400' }}">
                                    {{ $transaction->type == 'income' ? 'Pemasukan' : 'Pengeluaran' }}
                                </span>
                                
                                <!-- Date - Secondary importance -->
                                <p class="text-xs text-gray-500 dark:text-gray-400">
                                    {{ \Carbon\Carbon::parse($transaction->transaction_date)->translatedFormat('d F Y') }}
                                </p>
                            </div>
                            
                            <!-- Description - Primary importance -->
                            <p class="text-sm font-medium text-gray-800 dark:text-gray-200 mb-2">
                                {{ $transaction->description }}
                            </p>
                            
                            <!-- Amount - High visual emphasis -->
                            <p class="text-lg font-medium text-gray-900 dark:text-gray-100 {{ $transaction->type == 'income' ? 'text-green-600 dark:text-green-400' : 'text-red-600 dark:text-red-400' }}">
                                Rp {{ number_format($transaction->amount, 0, ',', '.') }}
                            </p>
                            
                            <!-- Actions with improved spacing and visual separation -->
                            <div class="mt-4 pt-3 border-t border-gray-100 dark:border-gray-700 flex justify-end gap-6">
                                <a href="{{ route('transactions.edit', $transaction->id) }}" 
                                    class="text-sm text-yellow-600 dark:text-yellow-500 font-medium hover:underline">Edit</a>
                                <button onclick="confirmDelete({{ $transaction->id }})" 
                                    class="text-sm text-red-600 dark:text-red-500 font-medium hover:underline">
                                    Hapus
                                </button>
                                <form id="delete-form-{{ $transaction->id }}" action="{{ route('transactions.destroy', $transaction->id) }}" method="POST" class="hidden">
                                    @csrf
                                    @method('DELETE')
                                </form>
                            </div>
                        </div>
                    @endforeach
                </div>

                <!-- Pagination -->
                <div class="px-6 py-4">
                    {{ $transactions->links() }}
                </div>
            </div>
        </div>
    </div>

    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        document.addEventListener("DOMContentLoaded", function () {
            // Cek localStorage, kalau hidden, sembunyikan elemen
            if (localStorage.getItem('hideTransactionInfo') === 'true') {
                document.getElementById('transaction-info')?.remove();
            }

            document.getElementById('close-info')?.addEventListener('click', function () {
                document.getElementById('transaction-info').remove();
            });

            document.getElementById('understand-btn')?.addEventListener('click', function () {
                localStorage.setItem('hideTransactionInfo', 'true');
                document.getElementById('transaction-info').remove();

                // Kirim ke backend supaya session juga di-update
                fetch("{{ route('hide.transaction.info') }}", { 
                    method: "POST", 
                    headers: {
                        "X-CSRF-TOKEN": "{{ csrf_token() }}",
                        "Content-Type": "application/json"
                    },
                    body: JSON.stringify({ hide: true })
                });
            });
        });

        function filterTransactions() {
            let search = document.getElementById("search").value.toLowerCase();
            let filter = document.getElementById("filter").value;

            // Cek tabel
            let rows = document.querySelectorAll(".transaction-row");
            rows.forEach(row => {
                let desc = row.getAttribute("data-desc");
                let type = row.getAttribute("data-type");
                let matchesSearch = desc.includes(search);
                let matchesFilter = filter === "all" || type === filter;

                row.style.display = matchesSearch && matchesFilter ? "" : "none";
            });

            // Cek mobile card
            let cards = document.querySelectorAll(".transaction-card");
            cards.forEach(card => {
                let desc = card.getAttribute("data-desc");
                let type = card.getAttribute("data-type");
                let matchesSearch = desc.includes(search);
                let matchesFilter = filter === "all" || type === filter;

                card.style.display = matchesSearch && matchesFilter ? "" : "none";
            });
        }

        function applySorting() {
            let sortValue = document.getElementById("sort").value;
            let table = document.getElementById("transactionsTable");
            let tbody = table.querySelector("tbody");
            let rows = Array.from(tbody.querySelectorAll("tr"));

            let sortedRows = rows.sort((a, b) => {
                let aDate = new Date(a.cells[0].innerText.trim()).getTime() || 0;
                let bDate = new Date(b.cells[0].innerText.trim()).getTime() || 0;

                let aAmount = parseInt(a.cells[2].innerText.replace(/Rp\s?|\.|,/g, "")) || 0;
                let bAmount = parseInt(b.cells[2].innerText.replace(/Rp\s?|\.|,/g, "")) || 0;

                if (sortValue === "newest") return bDate - aDate; // Terbaru
                if (sortValue === "oldest") return aDate - bDate; // Terlama
                if (sortValue === "cheapest") return aAmount - bAmount; // Termurah
                if (sortValue === "expensive") return bAmount - aAmount; // Termahal
            });

            console.log("Sorting berdasarkan:", sortValue, sortedRows.map(row => row.cells[0]?.innerText.trim()));

            let newTbody = document.createElement("tbody");
            sortedRows.forEach(row => newTbody.appendChild(row));

            table.replaceChild(newTbody, tbody);

            console.log("Sorting selesai & tbody diperbarui!");
        }

        function confirmDelete(transactionId) {
            Swal.fire({
                title: "Yakin mau hapus?",
                text: "Data transaksi ini akan dihapus permanen!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#d33",
                cancelButtonColor: "#3085d6",
                confirmButtonText: "Ya, hapus!",
                cancelButtonText: "Batal"
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById(`delete-form-${transactionId}`).submit();
                }
            });
        }
    </script>
</x-app-layout>