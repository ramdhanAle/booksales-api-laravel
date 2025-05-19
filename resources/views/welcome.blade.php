<div class="max-w-2xl mx-auto">
    <!-- Section Genre -->
    <div class="bg-white rounded-lg shadow-md p-6 mb-6">
        <h2 class="text-xl font-bold text-gray-800 mb-4 border-b pb-2">Daftar Genre</h2>
        <ul class="space-y-2">
            @forelse($genres as $genre)
                <li class="text-gray-700 hover:text-indigo-600 transition-colors">
                    {{ $genre->name }} ({{ $genre->books_count }} buku)
                </li>
            @empty
                <li class="text-gray-700">Belum ada genre</li>
            @endforelse
        </ul>
    </div>

    <!-- Section Penulis -->
    <div class="bg-white rounded-lg shadow-md p-6">
        <h2 class="text-xl font-bold text-gray-800 mb-4 border-b pb-2">Daftar Penulis</h2>
        <ul class="space-y-2">
            @forelse($authors as $author)
                <li class="text-gray-700 hover:text-indigo-600 transition-colors">
                    {{ $author->name }} ({{ $author->books_count }} buku)
                </li>
            @empty
                <li class="text-gray-700">Belum ada penulis</li>
            @endforelse
        </ul>
    </div>
</div>