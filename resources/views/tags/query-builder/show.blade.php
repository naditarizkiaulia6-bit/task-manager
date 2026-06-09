@extends('layouts.app')

@section('page_title', 'Tag Detail - ' . $tag->name)

@section('content')
    <div class="max-w-2xl">
        <div class="bg-white rounded-xl shadow-sm p-8">
            <div class="flex items-center justify-between mb-6 pb-6 border-b border-slate-200">
                <div>
                    <h3 class="text-lg font-bold text-slate-900">{{ $tag->name }}</h3>
                    <p class="text-sm text-slate-600 mt-1">Menggunakan <span class="font-mono bg-slate-100 px-2 py-1 rounded">Query Builder - first()</span></p>
                </div>
                <span class="inline-block px-4 py-2 rounded-full text-white font-semibold"
                      @if($tag->color === 'red') class="bg-red-500" @elseif($tag->color === 'blue') class="bg-blue-500" @elseif($tag->color === 'green') class="bg-green-500" @elseif($tag->color === 'yellow') class="bg-yellow-500" @elseif($tag->color === 'purple') class="bg-purple-500" @elseif($tag->color === 'pink') class="bg-pink-500" @elseif($tag->color === 'indigo') class="bg-indigo-500" @else class="bg-gray-500" @endif>
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
                    <p class="text-lg font-semibold text-slate-900">{{ $tag->created_at->format('d M Y H:i') }}</p>
                </div>

                <div>
                    <p class="text-sm font-medium text-slate-600 mb-1">Deskripsi</p>
                    <p class="text-lg font-semibold text-slate-900">{{ $tag->description ?? '-' }}</p>
                </div>
            </div>

            <div class="flex gap-3 pt-4 border-t border-slate-200">
                <a 
                    href="{{ route('tags.query-builder.edit', $tag->id) }}" 
                    class="bg-blue-500 hover:bg-blue-600 text-white px-6 py-2 rounded-lg transition-colors font-medium">
                    Edit
                </a>
                <form action="{{ route('tags.query-builder.destroy', $tag->id) }}" method="POST" class="inline" onsubmit="return confirm('Yakin?')">
                    @csrf @method('DELETE')
                    <button type="submit" class="bg-red-500 hover:bg-red-600 text-white px-6 py-2 rounded-lg transition-colors font-medium">
                        Hapus
                    </button>
                </form>
                <a 
                    href="{{ route('tags.query-builder.index') }}" 
                    class="bg-slate-200 hover:bg-slate-300 text-slate-700 px-6 py-2 rounded-lg transition-colors font-medium">
                    Kembali
                </a>
            </div>

            <!-- Query Builder Code Example -->
            <div class="mt-8 p-4 bg-green-100 rounded-lg">
                <p class="text-sm font-mono text-green-900">
                    <span class="font-bold">Query Builder:</span><br>
                    DB::table('tags')->where('id', {{ $tag->id }})->first();<br>
                    <br>
                    DB::table('task_tags')->where('tag_id', {{ $tag->id }})->count();
                </p>
            </div>
        </div>
    </div>
@endsection
