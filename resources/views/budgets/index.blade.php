<x-app-layout>
    <x-slot name="header">
        <h2 class="text-2xl font-bold text-gray-800 dark:text-white">Budget Bulanan</h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center mb-8">
                <a href="{{ route('budgets.create') }}" 
                   class="px-4 py-2 bg-indigo-500 hover:bg-indigo-600 text-white text-sm font-medium rounded-md transition-colors duration-300 ease-in-out shadow-md hover:shadow-lg focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
                    + Tambah Budget
                </a>
            </div>
    
            <!-- Grid Layout -->
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-2 lg:grid-cols-2 gap-6">
                @foreach ($budgets as $budget)
                    @php
                        $percentUsed = ($budget->spent / $budget->amount) * 100;
                        $progressColor = $percentUsed >= 100 ? 'bg-red-500' : 'bg-indigo-500';
                    @endphp
                    <div class="bg-white dark:bg-gray-800 border border-gray-100 dark:border-gray-700 rounded-xl p-6 shadow-sm hover:shadow-md transition-all duration-300 group">
                        <div class="flex justify-between items-start mb-4">
                            <h4 class="text-lg font-bold text-gray-800 dark:text-gray-100 transition-colors group-hover:text-indigo-600">
                                {{ $budget->category->name }}
                            </h4>
                            <div class="text-sm text-gray-500 dark:text-gray-400 font-medium">
                                {{ number_format($percentUsed, 1) }}%
                            </div>
                        </div>
                        
                        <div class="mb-4">
                            <div class="w-full bg-gray-200 dark:bg-gray-700 rounded-full h-2.5 mb-2">
                                <div class="{{ $progressColor }} h-2.5 rounded-full transition-all duration-300" style="width: {{ min($percentUsed, 100) }}%;"></div>
                            </div>
                            <p class="text-xs text-gray-500 dark:text-gray-400">
                                Rp {{ number_format($budget->spent, 0, ',', '.') }} / Rp {{ number_format($budget->amount, 0, ',', '.') }}
                            </p>
                        </div>
    
                        <!-- Actions -->
                        <div class="flex justify-between items-center border-t border-gray-100 dark:border-gray-700 pt-4 mt-4">
                            <a href="{{ route('budgets.edit', $budget->id) }}" 
                               class="text-sm text-indigo-600 dark:text-indigo-400 hover:text-indigo-800 transition-colors flex items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                </svg>
                                Edit
                            </a>
                            <button onclick="confirmDelete({{ $budget->id }})" 
                                    class="text-sm text-red-500 dark:text-red-400 hover:text-red-700 transition-colors flex items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                </svg>
                                Hapus
                            </button>
                            <form id="delete-form-{{ $budget->id }}" action="{{ route('budgets.destroy', $budget->id) }}" method="POST" class="hidden">
                                @csrf
                                @method('DELETE')
                            </form>
                        </div>
                    </div>
                @endforeach
            </div>
    
            <!-- Pagination -->
            <div class="mt-8">
                {{ $budgets->links() }}
            </div>
        </div>
    </div>

    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        function confirmDelete(budgetId) {
            Swal.fire({
                title: "Yakin mau hapus?",
                text: "Budget ini akan dihapus permanen!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#d33",
                cancelButtonColor: "#3085d6",
                confirmButtonText: "Ya, hapus!",
                cancelButtonText: "Batal"
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById(`delete-form-${budgetId}`).submit();
                }
            });
        }
    </script>
</x-app-layout>
