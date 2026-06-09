@extends('layouts.app')

@section('page_title', 'Tags - Query Builder CRUD')

@section('content')
    <div class="mb-6 flex items-center justify-between">
        <div>
            <h3 class="text-lg font-bold text-slate-900">Tag Management</h3>
            <p class="text-sm text-slate-600 mt-1">Menggunakan <span class="font-mono bg-slate-100 px-2 py-1 rounded">Query Builder</span></p>
        </div>
        <a href="{{ route('tags.query-builder.create') }}" class="bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded-lg transition-colors flex items-center gap-2">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
            </svg>
            Tambah Tag
        </a>
    </div>

    @if (session('success'))
        <div class="mb-4 p-4 bg-green-50 border border-green-200 text-green-700 rounded-lg">
            {{ session('success') }}
        </div>
    @endif

    <div class="bg-white rounded-xl shadow-sm overflow-hidden">
        <div class="px-6 py-4 border-b border-slate-200 bg-green-50">
            <p class="text-sm font-mono text-slate-600">
                <span class="text-green-600 font-bold">Query Builder:</span> DB::table('tags')->orderBy('created_at', 'desc')->get()
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
                                <td class="px-6 py-4 font-medium text-slate-900">{{ $tag->name }}</td>
                                <td class="px-6 py-4">
                                    <span class="inline-block px-3 py-1 rounded-full text-white text-sm font-semibold"
                                          @if($tag->color === 'red') class="bg-red-500" @elseif($tag->color === 'blue') class="bg-blue-500" @elseif($tag->color === 'green') class="bg-green-500" @elseif($tag->color === 'yellow') class="bg-yellow-500" @elseif($tag->color === 'purple') class="bg-purple-500" @elseif($tag->color === 'pink') class="bg-pink-500" @elseif($tag->color === 'indigo') class="bg-indigo-500" @else class="bg-gray-500" @endif>
                                        {{ ucfirst($tag->color) }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 text-slate-600">{{ $tag->description ?? '-' }}</td>
                                <td class="px-6 py-4 text-sm text-slate-600">{{ $tag->created_at->format('d M Y') }}</td>
                                <td class="px-6 py-4 text-center">
                                    <div class="flex items-center justify-center gap-2">
                                        <a href="{{ route('tags.query-builder.show', $tag->id) }}" class="text-green-600 hover:text-green-700 font-medium text-sm">View</a>
                                        <a href="{{ route('tags.query-builder.edit', $tag->id) }}" class="text-blue-600 hover:text-blue-700 font-medium text-sm">Edit</a>
                                        <form action="{{ route('tags.query-builder.destroy', $tag->id) }}" method="POST" class="inline" onsubmit="return confirm('Yakin?')">
                                            @csrf @method('DELETE')
                                            <button type="submit" class="text-red-600 hover:text-red-700 font-medium text-sm">Delete</button>
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
                <a href="{{ route('tags.query-builder.create') }}" class="text-green-600 hover:text-green-700 font-medium">Buat tag pertama</a>
            </div>
        @endif
    </div>

    <!-- Comparison Card -->
    <div class="mt-8 bg-white rounded-xl shadow-sm p-6">
        <h4 class="font-bold text-slate-900 mb-4">Query Builder - Keunggulan</h4>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <h5 class="font-semibold text-slate-900 mb-2 text-green-600">✅ Kelebihan:</h5>
                <ul class="space-y-2 text-sm text-slate-600">
                    <li>✅ Clean & readable code</li>
                    <li>✅ Automatic SQL injection prevention</li>
                    <li>✅ Database agnostic</li>
                    <li>✅ Easy to maintain & modify</li>
                    <li>✅ Built-in helper methods</li>
                </ul>
            </div>
            <div>
                <h5 class="font-semibold text-slate-900 mb-2 text-red-600">⚠️ Kekurangan:</h5>
                <ul class="space-y-2 text-sm text-slate-600">
                    <li>❌ Slightly slower than raw SQL</li>
                    <li>❌ Limited untuk very complex queries</li>
                    <li>❌ Sometimes generate suboptimal queries</li>
                </ul>
            </div>
        </div>
    </div>
@endsection
