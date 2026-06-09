@extends('layouts.app')

@section('page_title', 'Tag Detail - ' . $tag->name)

@section('content')
    <div class="max-w-2xl">
        <div class="bg-white rounded-xl shadow-sm p-8">
            <div class="flex items-center justify-between mb-6 pb-6 border-b border-slate-200">
                <div>
                    <h3 class="text-lg font-bold text-slate-900">{{ $tag->name }}</h3>
                    <p class="text-sm text-slate-600 mt-1">Menggunakan <span class="font-mono bg-slate-100 px-2 py-1 rounded">Raw SQL - SELECT</span></p>
                </div>
                <span class="inline-block px-4 py-2 rounded-full text-white font-semibold"
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
            </div>

            <div class="grid grid-cols-2 gap-6 mb-8">
                <div>
                    <p class="text-sm font-medium text-slate-600 mb-1">ID</p>
                    <p class="text-lg font-semibold text-slate-900">{{ $tag->id }}</p>
                </div>

                <div>
                    <p class="text-sm font-medium text-slate-600 mb-1">Digunakan pada</p>
                    <p class="text-lg font-semibold text-slate-900">{{ $taskCount }} tugas</p>
                </div>

                <div>
                    <p class="text-sm font-medium text-slate-600 mb-1">Dibuat</p>
                    <p class="text-lg font-semibold text-slate-900">{{ $tag->created_at ? $tag->created_at->format('d M Y H:i') : '-' }}</p>
                </div>

                <div>
                    <p class="text-sm font-medium text-slate-600 mb-1">Deskripsi</p>
                    <p class="text-lg font-semibold text-slate-900">{{ $tag->description ?? '-' }}</p>
                </div>
            </div>

            <div class="flex gap-3 pt-4 border-t border-slate-200">
                <a 
                    href="{{ route('tags.raw-sql.edit', $tag->id) }}" 
                    class="bg-blue-500 hover:bg-blue-600 text-white px-6 py-2 rounded-lg transition-colors font-medium">
                    Edit
                </a>
                <form action="{{ route('tags.raw-sql.destroy', $tag->id) }}" method="POST" class="inline" onsubmit="return confirm('Yakin ingin menghapus?')">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="bg-red-500 hover:bg-red-600 text-white px-6 py-2 rounded-lg transition-colors font-medium">
                        Hapus
                    </button>
                </form>
                <a 
                    href="{{ route('tags.raw-sql.index') }}" 
                    class="bg-slate-200 hover:bg-slate-300 text-slate-700 px-6 py-2 rounded-lg transition-colors font-medium">
                    Kembali
                </a>
            </div>

            <!-- SQL Code Example -->
            <div class="mt-8 p-4 bg-slate-100 rounded-lg">
                <p class="text-sm font-mono text-slate-800">
                    <span class="text-indigo-600 font-bold">SQL SELECT:</span><br>
                    SELECT * FROM tags WHERE id = {{ $tag->id }}<br>
                    <br>
                    <span class="text-indigo-600 font-bold">SQL COUNT:</span><br>
                    SELECT COUNT(*) FROM task_tags WHERE tag_id = {{ $tag->id }}
                </p>
            </div>
        </div>
    </div>
@endsection
