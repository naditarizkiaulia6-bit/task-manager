@extends('layouts.app')

@section('page_title', $task->title)

@section('content')
    <div class="max-w-3xl">
        <div class="bg-white rounded-xl shadow-sm p-8 mb-6">
            <!-- Header -->
            <div class="flex items-start justify-between mb-6">
                <div>
                    <h2 class="text-3xl font-bold text-slate-900">{{ $task->title }}</h2>
                    <p class="text-slate-600 mt-2">{{ $task->description }}</p>
                </div>
                <a href="{{ route('tasks.index') }}" class="bg-slate-200 hover:bg-slate-300 text-slate-700 px-4 py-2 rounded-lg transition-colors">
                    Kembali
                </a>
            </div>

            <!-- Task Details -->
            <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-8 p-4 bg-slate-50 rounded-lg">
                <div>
                    <p class="text-xs text-slate-600 font-medium uppercase tracking-wider">Status</p>
                    <p class="text-lg font-semibold text-slate-900 mt-2">{{ $task->status_label }}</p>
                </div>
                <div>
                    <p class="text-xs text-slate-600 font-medium uppercase tracking-wider">Prioritas</p>
                    <span class="inline-block px-2 py-1 text-xs font-semibold rounded mt-2
                        @if($task->priority === 'high') bg-red-100 text-red-700
                        @elseif($task->priority === 'medium') bg-yellow-100 text-yellow-700
                        @elseif($task->priority === 'low') bg-green-100 text-green-700
                        @endif">
                        {{ $task->priority_label }}
                    </span>
                </div>
                <div>
                    <p class="text-xs text-slate-600 font-medium uppercase tracking-wider">Kategori</p>
                    <span class="inline-block px-2 py-1 text-xs font-semibold rounded text-white mt-2
                        @if($task->category === 'design') bg-purple-500
                        @elseif($task->category === 'dev') bg-blue-500
                        @elseif($task->category === 'bug') bg-red-500
                        @elseif($task->category === 'research') bg-green-500
                        @endif">
                        {{ $task->category_label }}
                    </span>
                </div>
                <div>
                    <p class="text-xs text-slate-600 font-medium uppercase tracking-wider">Progress</p>
                    <p class="text-lg font-semibold text-slate-900 mt-2">{{ $task->progress }}%</p>
                </div>
            </div>

            <!-- Progress Bar -->
            <div class="mb-8">
                <div class="flex items-center justify-between mb-2">
                    <span class="text-sm font-medium text-slate-700">Progress Pengerjaan</span>
                    <span class="text-sm font-semibold text-slate-900">{{ $task->progress }}%</span>
                </div>
                <div class="w-full bg-slate-200 rounded-full h-3">
                    <div class="bg-indigo-500 h-3 rounded-full transition-all duration-300"
                         style="width: {{ $task->progress }}%"></div>
                </div>
            </div>

            <!-- Dates & Assignee -->
            <div class="grid grid-cols-2 md:grid-cols-3 gap-4 mb-8 pb-8 border-b border-slate-200">
                @if($task->due_date)
                    <div>
                        <p class="text-xs text-slate-600 font-medium uppercase tracking-wider">Tanggal Tenggat</p>
                        <p class="text-lg font-semibold text-slate-900 mt-2">{{ $task->due_date->format('d M Y') }}</p>
                    </div>
                @endif

                @if($task->assignee)
                    <div>
                        <p class="text-xs text-slate-600 font-medium uppercase tracking-wider">Ditugaskan Kepada</p>
                        <p class="text-lg font-semibold text-slate-900 mt-2">{{ $task->assignee->name }}</p>
                    </div>
                @endif

                <div>
                    <p class="text-xs text-slate-600 font-medium uppercase tracking-wider">Proyek</p>
                    <p class="text-lg font-semibold text-slate-900 mt-2">{{ $task->project->name }}</p>
                </div>
            </div>

            <!-- Actions -->
            <div class="flex gap-3">
                <a href="{{ route('tasks.edit', $task) }}" class="bg-indigo-500 hover:bg-indigo-600 text-white px-4 py-2 rounded-lg transition-colors">
                    Edit Tugas
                </a>

                <form action="{{ route('tasks.destroy', $task) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus tugas ini?')" class="inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded-lg transition-colors">
                        Hapus Tugas
                    </button>
                </form>
            </div>
        </div>

        <!-- Comments Section -->
        <div class="bg-white rounded-xl shadow-sm p-8">
            <h3 class="text-lg font-bold text-slate-900 mb-6">Komentar</h3>

            @if($task->comments->count() > 0)
                <div class="space-y-4 mb-6">
                    @foreach($task->comments as $comment)
                        <div class="flex gap-4 p-4 bg-slate-50 rounded-lg">
                            <div class="w-10 h-10 bg-indigo-500 rounded-full flex items-center justify-center text-white text-sm font-bold flex-shrink-0">
                                {{ substr($comment->user->name, 0, 1) }}
                            </div>
                            <div class="flex-1">
                                <div class="flex items-center justify-between">
                                    <h4 class="font-semibold text-slate-900">{{ $comment->user->name }}</h4>
                                    <span class="text-xs text-slate-500">{{ $comment->created_at->diffForHumans() }}</span>
                                </div>
                                <p class="text-slate-700 mt-2">{{ $comment->body }}</p>
                                @if(auth()->id() === $comment->user_id)
                                    <form action="{{ route('comments.destroy', $comment) }}" method="POST" class="mt-2">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-xs text-red-600 hover:text-red-700 font-medium">
                                            Hapus
                                        </button>
                                    </form>
                                @endif
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif

            <!-- Add Comment Form -->
            <form action="{{ route('comments.store', $task) }}" method="POST" class="border-t border-slate-200 pt-6">
                @csrf
                <div>
                    <label for="body" class="block text-sm font-medium text-slate-700 mb-2">Tambah Komentar</label>
                    <textarea
                        name="body"
                        id="body"
                        rows="3"
                        required
                        class="w-full px-4 py-3 border border-slate-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent"
                        placeholder="Tulis komentar Anda..."
                    ></textarea>
                </div>
                <button type="submit" class="mt-3 bg-indigo-500 hover:bg-indigo-600 text-white px-4 py-2 rounded-lg transition-colors font-medium">
                    Kirim Komentar
                </button>
            </form>
        </div>
    </div>
@endsection
