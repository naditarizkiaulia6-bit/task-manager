@extends('layouts.app')

@section('page_title', 'Edit Tugas')

@section('content')
    <div class="max-w-2xl">
        <div class="bg-white rounded-xl shadow-sm p-8">
            <form action="{{ route('tasks.update', $task) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-6">
                    <label for="title" class="block text-sm font-medium text-slate-700 mb-2">Judul Tugas</label>
                    <input
                        type="text"
                        name="title"
                        id="title"
                        value="{{ old('title', $task->title) }}"
                        required
                        class="w-full px-4 py-3 border border-slate-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent"
                        placeholder="Masukkan judul tugas"
                    >
                    @error('title')<p class="text-red-500 text-sm mt-1">{{ $message }}</p>@enderror
                </div>

                <div class="mb-6">
                    <label for="description" class="block text-sm font-medium text-slate-700 mb-2">Deskripsi</label>
                    <textarea
                        name="description"
                        id="description"
                        rows="4"
                        class="w-full px-4 py-3 border border-slate-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent"
                        placeholder="Masukkan deskripsi tugas"
                    >{{ old('description', $task->description) }}</textarea>
                    @error('description')<p class="text-red-500 text-sm mt-1">{{ $message }}</p>@enderror
                </div>

                <div class="grid grid-cols-2 gap-4 mb-6">
                    <div>
                        <label for="category" class="block text-sm font-medium text-slate-700 mb-2">Kategori</label>
                        <select name="category" id="category" required class="w-full px-4 py-3 border border-slate-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent">
                            <option value="dev" {{ $task->category === 'dev' ? 'selected' : '' }}>Pengembangan</option>
                            <option value="design" {{ $task->category === 'design' ? 'selected' : '' }}>Desain</option>
                            <option value="bug" {{ $task->category === 'bug' ? 'selected' : '' }}>Bug</option>
                            <option value="research" {{ $task->category === 'research' ? 'selected' : '' }}>Riset</option>
                        </select>
                        @error('category')<p class="text-red-500 text-sm mt-1">{{ $message }}</p>@enderror
                    </div>

                    <div>
                        <label for="priority" class="block text-sm font-medium text-slate-700 mb-2">Prioritas</label>
                        <select name="priority" id="priority" required class="w-full px-4 py-3 border border-slate-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent">
                            <option value="low" {{ $task->priority === 'low' ? 'selected' : '' }}>Rendah</option>
                            <option value="medium" {{ $task->priority === 'medium' ? 'selected' : '' }}>Sedang</option>
                            <option value="high" {{ $task->priority === 'high' ? 'selected' : '' }}>Tinggi</option>
                        </select>
                        @error('priority')<p class="text-red-500 text-sm mt-1">{{ $message }}</p>@enderror
                    </div>
                </div>

                <div class="grid grid-cols-2 gap-4 mb-6">
                    <div>
                        <label for="status" class="block text-sm font-medium text-slate-700 mb-2">Status</label>
                        <select name="status" id="status" required class="w-full px-4 py-3 border border-slate-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent">
                            <option value="todo" {{ $task->status === 'todo' ? 'selected' : '' }}>Belum Mulai</option>
                            <option value="progress" {{ $task->status === 'progress' ? 'selected' : '' }}>Sedang Dikerjakan</option>
                            <option value="review" {{ $task->status === 'review' ? 'selected' : '' }}>Review</option>
                            <option value="done" {{ $task->status === 'done' ? 'selected' : '' }}>Selesai</option>
                        </select>
                        @error('status')<p class="text-red-500 text-sm mt-1">{{ $message }}</p>@enderror
                    </div>

                    <div>
                        <label for="progress" class="block text-sm font-medium text-slate-700 mb-2">Progress (%)</label>
                        <input
                            type="number"
                            name="progress"
                            id="progress"
                            value="{{ old('progress', $task->progress) }}"
                            min="0"
                            max="100"
                            class="w-full px-4 py-3 border border-slate-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent"
                        >
                        @error('progress')<p class="text-red-500 text-sm mt-1">{{ $message }}</p>@enderror
                    </div>
                </div>

                <div class="mb-6">
                    <label for="due_date" class="block text-sm font-medium text-slate-700 mb-2">Tanggal Tenggat</label>
                    <input
                        type="date"
                        name="due_date"
                        id="due_date"
                        value="{{ old('due_date', $task->due_date?->format('Y-m-d')) }}"
                        class="w-full px-4 py-3 border border-slate-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent"
                    >
                    @error('due_date')<p class="text-red-500 text-sm mt-1">{{ $message }}</p>@enderror
                </div>

                <div class="flex gap-3">
                    <button
                        type="submit"
                        class="bg-indigo-500 hover:bg-indigo-600 text-white px-6 py-3 rounded-lg transition-colors font-medium"
                    >
                        Perbarui Tugas
                    </button>
                    <a
                        href="{{ route('tasks.show', $task) }}"
                        class="bg-slate-200 hover:bg-slate-300 text-slate-700 px-6 py-3 rounded-lg transition-colors font-medium"
                    >
                        Batal
                    </a>
                </div>
            </form>
        </div>
    </div>
@endsection
