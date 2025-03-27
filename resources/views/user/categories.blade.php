<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Pilih Kategori
        </h2>
    </x-slot>

    <div class="max-w-3xl mx-auto mt-6 bg-white dark:bg-gray-800 p-6 shadow-md rounded-lg">
        
        @if(session('show_category_info') !== 'hidden')
<div id="category-info" class="bg-blue-100 dark:bg-blue-900 text-blue-800 dark:text-blue-200 p-4 rounded-lg flex justify-between items-start mb-6">
    <div class="flex-1">
        <p class="text-sm mb-2">{{ $categoryInfo }}</p>
        <p class="text-sm font-semibold text-blue-600 dark:text-blue-300">
            (Klik <button id="understand-btn" class="underline">Mengerti</button> untuk menyembunyikan)
        </p>
    </div>
    <button id="close-info" class="text-gray-600 dark:text-gray-400 text-lg">&times;</button>
</div>
@endif

<form id="categoryForm">
    @csrf

    <div class="mb-4">
        <label class="block font-medium text-gray-700 dark:text-gray-300">Pilih Kategori Default:</label>
        <div class="mt-2 space-y-2">
            @foreach ($categories as $category)
                <label class="flex items-center space-x-2">
                    <input type="checkbox" name="categories[]" value="{{ $category->id }}"
                        class="rounded text-blue-500 focus:ring-blue-400"
                        {{ in_array($category->id, $selectedCategories) ? 'checked' : '' }}>
                    <span class="text-gray-800 dark:text-gray-300">{{ $category->name }}</span>
                </label>
            @endforeach
        </div>
    </div>

    <button type="submit"
        class="bg-blue-500 hover:bg-blue-600 text-white font-semibold py-2 px-4 rounded-lg shadow-md">
        Simpan Kategori
    </button>
</form>


    {{-- SweetAlert2 --}}
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        document.getElementById('categoryForm').addEventListener('submit', function(event) {
            event.preventDefault(); // Mencegah reload halaman

            Swal.fire({
                title: "Konfirmasi",
                text: "Simpan perubahan kategori?",
                icon: "warning",
                showCancelButton: true,
                confirmButtonText: "Simpan",
                confirmButtonColor: "green",
                cancelButtonText: "Batal",
            }).then((result) => {
                if (result.isConfirmed) {
                    let formData = new FormData(event.target);
                    fetch("{{ route('user.categories.store') }}", {
                        method: "POST",
                        body: formData,
                        headers: {
                            "X-CSRF-TOKEN": document.querySelector('input[name=_token]').value
                        }
                    })
                    .then(response => response.json())
                    .then(data => {
                        Swal.fire({
                            icon: "success",
                            title: "Berhasil!",
                            text: data.message,
                            confirmButtonColor: "green",
                            confirmButtonText: "Oke"
                        });
                    })
                    .catch(error => {
                        Swal.fire({
                            icon: "error",
                            title: "Oops!",
                            text: "Terjadi kesalahan, coba lagi!",
                            confirmButtonColor: "red",
                            confirmButtonText: "Oke"
                        });
                    });
                }
            });
        });

        document.addEventListener("DOMContentLoaded", function () {
    const categoryInfo = document.getElementById("category-info");
    const understandBtn = document.getElementById("understand-btn");
    const closeInfo = document.getElementById("close-info");

    // Cek localStorage untuk menyembunyikan info kategori
    if (localStorage.getItem("show_category_info") === "hidden" && categoryInfo) {
        categoryInfo.style.display = "none";
    }

    // Tombol "Mengerti" untuk menyimpan ke localStorage
    understandBtn?.addEventListener("click", function () {
        categoryInfo.style.display = "none";
        localStorage.setItem("show_category_info", "hidden");
    });

    // Tombol "X" untuk menyembunyikan sementara (tanpa localStorage)
    closeInfo?.addEventListener("click", function () {
        categoryInfo.style.display = "none";
    });
});

    </script>

</x-app-layout>
