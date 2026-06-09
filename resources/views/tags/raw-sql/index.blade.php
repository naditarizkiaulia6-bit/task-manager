@extends('layouts.app')

@section('page_title', 'Tags - Raw SQL CRUD')

@section('content')
    <div class="mb-6 flex items-center justify-between">
        <div>
            <h3 class="text-lg font-bold text-slate-900">Tag Management</h3>
            <p class="text-sm text-slate-600 mt-1">Menggunakan <span class="font-mono bg-slate-100 px-2 py-1 rounded">Raw SQL</span></p>
        </div>
        <a href="{{ route('tags.raw-sql.create') }}" class="bg-indigo-500 hover:bg-indigo-600 text-white px-4 py-2 rounded-lg transition-colors flex items-center gap-2">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
            </svg>
            Tambah Tag
        </a>
    </div>

    @if (session('success'))
        <div class="mb-4 p-4 bg-green-50 border border-green-200 text-green-700 rounded-lg flex items-center gap-2">
            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
            </svg>
            {{ session('success') }}
        </div>
    @endif

    @if (session('error'))
        <div class="mb-4 p-4 bg-red-50 border border-red-200 text-red-700 rounded-lg flex items-center gap-2">
            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"></path>
            </svg>
            {{ session('error') }}
        </div>
    @endif

    <div class="bg-white rounded-xl shadow-sm overflow-hidden">
        <div class="px-6 py-4 border-b border-slate-200 bg-slate-50">
            <p class="text-sm font-mono text-slate-600">
                <span class="text-indigo-600 font-bold">SQL:</span> SELECT * FROM tags ORDER BY created_at DESC
            </p>
        </div>

        @if ($tags->count() > 0)
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead>
                        <tr class="border-b border-slate-200 bg-slate-50">
                            <th class="px-6 py-3 text-left text-sm font-semibold text-slate-900">Name</th>
                            <th class="px-6 py-3 text-left text-sm font-semibold text-slate-900">Color</th>
                            <th class="px-6 py-3 text-left text-sm font-semibold text-slate-900">Description</th>
                            <th class="px-6 py-3 text-left text-sm font-semibold text-slate-900">Created</th>
                            <th class="px-6 py-3 text-center text-sm font-semibold text-slate-900">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-200">
                        @foreach ($tags as $tag)
                            <tr class="hover:bg-slate-50 transition-colors">
                                <td class="px-6 py-4">
                                    <span class="font-medium text-slate-900">{{ $tag->name }}</span>
                                </td>
                                <td class="px-6 py-4">
                                    <span class="inline-block px-3 py-1 rounded-full text-white text-sm font-semibold"
                                          @if($tag->color === 'red') class="bg-red-500" @endif
                                          @if($tag->color === 'blue') class="bg-blue-500" @endif
                                          @if($tag->color === 'green') class="bg-green-500" @endif
                                          @if($tag->color === 'yellow') class="bg-yellow-500" @endif
                                          @if($tag->color === 'purple') class="bg-purple-500" @endif
                                          @if($tag->color === 'pink') class="bg-pink-500" @endif
                                          @if($tag->color === 'indigo') class="bg-indigo-500" @endif
                                          @if($tag->color === 'gray') class="bg-gray-500" @endif>
                                        {{ ucfirst($tag->color) }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 text-slate-600">
                                    {{ $tag->description ?? '-' }}
                                </td>
                                <td class="px-6 py-4 text-sm text-slate-600">
                                    {{ $tag->created_at ? $tag->created_at->format('d M Y') : '-' }}
                                </td>
                                <td class="px-6 py-4 text-center">
                                    <div class="flex items-center justify-center gap-2">
                                        <a href="{{ route('tags.raw-sql.show', $tag->id) }}" class="text-indigo-600 hover:text-indigo-700 font-medium text-sm">
                                            View
                                        </a>
                                        <a href="{{ route('tags.raw-sql.edit', $tag->id) }}" class="text-blue-600 hover:text-blue-700 font-medium text-sm">
                                            Edit
                                        </a>
                                        <form action="{{ route('tags.raw-sql.destroy', $tag->id) }}" method="POST" class="inline" onsubmit="return confirm('Yakin ingin menghapus?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-600 hover:text-red-700 font-medium text-sm">
                                                Delete
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @else
            <div class="px-6 py-12 text-center">
                <p class="text-slate-600 mb-4">Belum ada tag</p>
                <a href="{{ route('tags.raw-sql.create') }}" class="text-indigo-600 hover:text-indigo-700 font-medium">
                    Buat tag pertama
                </a>
            </div>
        @endif
    </div>

    <!-- Code Comparison -->
    <div class="mt-8 bg-white rounded-xl shadow-sm p-6">
        <h4 class="font-bold text-slate-900 mb-4">Raw SQL - Penjelasan</h4>
        
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <h5 class="font-semibold text-slate-900 mb-2 text-red-600">Kelebihan Raw SQL:</h5>
                <ul class="space-y-2 text-sm text-slate-600">
                    <li>✅ Kontrol penuh atas query</li>
                    <li>✅ Lebih fleksibel untuk complex queries</li>
                    <li>✅ Performa optimal untuk operasi specific</li>
                    <li>✅ Berguna untuk query yang kompleks</li>
                </ul>
            </div>
            <div>
                <h5 class="font-semibold text-slate-900 mb-2 text-red-600">Kekurangan Raw SQL:</h5>
                <ul class="space-y-2 text-sm text-slate-600">
                    <li>❌ Rentan terhadap SQL injection (jika tidak hati-hati)</li>
                    <li>❌ Lebih verbose & harder to read</li>
                    <li>❌ Less portable across databases</li>
                    <li>❌ Sulit di-maintain</li>
                </ul>
            </div>
        </div>

        <div class="mt-4 p-4 bg-yellow-50 border border-yellow-200 rounded-lg text-sm text-yellow-800">
            <strong>⚠️ Catatan:</strong> Contoh kode di halaman ini menggunakan parameterized queries (?) untuk mencegah SQL injection.
        </div>
    </div>
@endsection
