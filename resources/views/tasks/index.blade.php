 @extends('layouts.app')

@section('page_title', 'Dashboard - Kanban Board')

@section('content')
    <!-- Statistics Cards -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
        <!-- Total Tasks Card -->
        <div class="bg-white rounded-xl shadow-sm p-6 border-l-4 border-indigo-500">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-slate-600 text-sm font-medium">Total Tugas</p>
                    <p class="text-3xl font-bold text-slate-900 mt-2">{{ $stats['total'] }}</p>
                </div>
                <div class="w-12 h-12 bg-indigo-100 rounded-lg flex items-center justify-center">
                    <svg class="w-6 h-6 text-indigo-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                    </svg>
                </div>
            </div>
        </div>

        <!-- In Progress Card -->
        <div class="bg-white rounded-xl shadow-sm p-6 border-l-4 border-blue-500">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-slate-600 text-sm font-medium">Sedang Berjalan</p>
                    <p class="text-3xl font-bold text-slate-900 mt-2">{{ $stats['inProgress'] }}</p>
                </div>
                <div class="w-12 h-12 bg-blue-100 rounded-lg flex items-center justify-center">
                    <svg class="w-6 h-6 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                    </svg>
                </div>
            </div>
        </div>

        <!-- Completed Card -->
        <div class="bg-white rounded-xl shadow-sm p-6 border-l-4 border-green-500">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-slate-600 text-sm font-medium">Selesai</p>
                    <p class="text-3xl font-bold text-slate-900 mt-2">{{ $stats['completed'] }}</p>
                </div>
                <div class="w-12 h-12 bg-green-100 rounded-lg flex items-center justify-center">
                    <svg class="w-6 h-6 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
            </div>
        </div>

        <!-- High Priority Card -->
        <div class="bg-white rounded-xl shadow-sm p-6 border-l-4 border-red-500">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-slate-600 text-sm font-medium">Prioritas Tinggi</p>
                    <p class="text-3xl font-bold text-slate-900 mt-2">{{ $stats['highPriority'] }}</p>
                </div>
                <div class="w-12 h-12 bg-red-100 rounded-lg flex items-center justify-center">
                    <svg class="w-6 h-6 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4v2m0 0v2m0-6l4.243-4.243m0 8.486L7.757 7.757"></path>
                    </svg>
                </div>
            </div>
        </div>
    </div>

    <!-- Add Task Button -->
    <div class="mb-6 flex justify-end">
        <button onclick="document.getElementById('addTaskModal').classList.remove('hidden')" class="bg-indigo-500 hover:bg-indigo-600 text-white px-6 py-3 rounded-lg transition-colors font-medium flex items-center gap-2">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
            </svg>
            Tambah Tugas
        </button>
    </div>

    <!-- Kanban Board -->
    <div class="grid grid-cols-1 lg:grid-cols-4 gap-6">
        <!-- Belum Mulai Column -->
        <div class="bg-slate-50 rounded-xl p-4">
            <div class="flex items-center justify-between mb-4">
                <h3 class="font-bold text-slate-900 flex items-center gap-2">
                    <span class="w-3 h-3 bg-slate-400 rounded-full"></span>
                    Belum Mulai
                </h3>
                <span class="bg-slate-200 text-slate-700 text-xs font-bold px-2 py-1 rounded-full">
                    {{ $tasksByStatus['todo']->count() }}
                </span>
            </div>

            <div class="space-y-3 min-h-[500px]">
                @forelse($tasksByStatus['todo'] as $task)
                    @include('tasks.card', ['task' => $task, 'status' => 'progress'])
                @empty
                    <div class="text-center py-8 text-slate-500">
                        <svg class="w-12 h-12 mx-auto mb-2 opacity-50" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"></path>
                        </svg>
                        <p class="text-sm">Belum ada tugas</p>
                    </div>
                @endforelse
            </div>
        </div>

        <!-- Sedang Dikerjakan Column -->
        <div class="bg-slate-50 rounded-xl p-4">
            <div class="flex items-center justify-between mb-4">
                <h3 class="font-bold text-slate-900 flex items-center gap-2">
                    <span class="w-3 h-3 bg-blue-400 rounded-full"></span>
                    Sedang Dikerjakan
                </h3>
                <span class="bg-blue-100 text-blue-700 text-xs font-bold px-2 py-1 rounded-full">
                    {{ $tasksByStatus['progress']->count() }}
                </span>
            </div>

            <div class="space-y-3 min-h-[500px]">
                @forelse($tasksByStatus['progress'] as $task)
                    @include('tasks.card', ['task' => $task, 'status' => 'review'])
                @empty
                    <div class="text-center py-8 text-slate-500">
                        <svg class="w-12 h-12 mx-auto mb-2 opacity-50" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"></path>
                        </svg>
                        <p class="text-sm">Belum ada tugas</p>
                    </div>
                @endforelse
            </div>
        </div>

        <!-- Review Column -->
        <div class="bg-slate-50 rounded-xl p-4">
            <div class="flex items-center justify-between mb-4">
                <h3 class="font-bold text-slate-900 flex items-center gap-2">
                    <span class="w-3 h-3 bg-yellow-400 rounded-full"></span>
                    Review
                </h3>
                <span class="bg-yellow-100 text-yellow-700 text-xs font-bold px-2 py-1 rounded-full">
                    {{ $tasksByStatus['review']->count() }}
                </span>
            </div>

            <div class="space-y-3 min-h-[500px]">
                @forelse($tasksByStatus['review'] as $task)
                    @include('tasks.card', ['task' => $task, 'status' => 'done'])
                @empty
                    <div class="text-center py-8 text-slate-500">
                        <svg class="w-12 h-12 mx-auto mb-2 opacity-50" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"></path>
                        </svg>
                        <p class="text-sm">Belum ada tugas</p>
                    </div>
                @endforelse
            </div>
        </div>

        <!-- Selesai Column -->
        <div class="bg-slate-50 rounded-xl p-4">
            <div class="flex items-center justify-between mb-4">
                <h3 class="font-bold text-slate-900 flex items-center gap-2">
                    <span class="w-3 h-3 bg-green-400 rounded-full"></span>
                    Selesai
                </h3>
                <span class="bg-green-100 text-green-700 text-xs font-bold px-2 py-1 rounded-full">
                    {{ $tasksByStatus['done']->count() }}
                </span>
            </div>

            <div class="space-y-3 min-h-[500px]">
                @forelse($tasksByStatus['done'] as $task)
                    @include('tasks.card', ['task' => $task, 'status' => null])
                @empty
                    <div class="text-center py-8 text-slate-500">
                        <svg class="w-12 h-12 mx-auto mb-2 opacity-50" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"></path>
                        </svg>
                        <p class="text-sm">Belum ada tugas</p>
                    </div>
                @endforelse
            </div>
        </div>
    </div>

    <!-- Add Task Modal -->
    <div id="addTaskModal" class="hidden fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50">
        <div class="bg-white rounded-xl shadow-lg p-8 max-w-md w-full mx-4">
            <div class="flex items-center justify-between mb-6">
                <h2 class="text-2xl font-bold text-slate-900">Tambah Tugas Baru</h2>
                <button onclick="document.getElementById('addTaskModal').classList.add('hidden')" class="text-slate-400 hover:text-slate-600">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </div>

            <form action="{{ route('tasks.store') }}" method="POST">
                @csrf

                <div class="mb-4">
                    <label for="title" class="block text-sm font-medium text-slate-700 mb-2">Judul Tugas</label>
                    <input
                        type="text"
                        name="title"
                        id="title"
                        required
                        class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent"
                        placeholder="Masukkan judul tugas"
                    >
                    @error('title')<p class="text-red-500 text-sm mt-1">{{ $message }}</p>@enderror
                </div>

                <div class="mb-4">
                    <label for="description" class="block text-sm font-medium text-slate-700 mb-2">Deskripsi</label>
                    <textarea
                        name="description"
                        id="description"
                        rows="3"
                        class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent"
                        placeholder="Masukkan deskripsi tugas"
                    ></textarea>
                    @error('description')<p class="text-red-500 text-sm mt-1">{{ $message }}</p>@enderror
                </div>

                <div class="mb-4">
                    <label for="category" class="block text-sm font-medium text-slate-700 mb-2">Kategori</label>
                    <select name="category" id="category" required class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent">
                        <option value="">Pilih Kategori</option>
                        <option value="dev">Pengembangan</option>
                        <option value="design">Desain</option>
                        <option value="bug">Bug</option>
                        <option value="research">Riset</option>
                    </select>
                    @error('category')<p class="text-red-500 text-sm mt-1">{{ $message }}</p>@enderror
                </div>

                <div class="mb-4">
                    <label for="priority" class="block text-sm font-medium text-slate-700 mb-2">Prioritas</label>
                    <select name="priority" id="priority" required class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent">
                        <option value="">Pilih Prioritas</option>
                        <option value="low">Rendah</option>
                        <option value="medium" selected>Sedang</option>
                        <option value="high">Tinggi</option>
                    </select>
                    @error('priority')<p class="text-red-500 text-sm mt-1">{{ $message }}</p>@enderror
                </div>

                <div class="mb-6">
                    <label for="due_date" class="block text-sm font-medium text-slate-700 mb-2">Tanggal Tenggat</label>
                    <input
                        type="date"
                        name="due_date"
                        id="due_date"
                        class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent"
                    >
                    @error('due_date')<p class="text-red-500 text-sm mt-1">{{ $message }}</p>@enderror
                </div>

                <div class="flex gap-3">
                    <button
                        type="submit"
                        class="flex-1 bg-indigo-500 hover:bg-indigo-600 text-white px-4 py-2 rounded-lg transition-colors font-medium"
                    >
                        Buat Tugas
                    </button>
                    <button
                        type="button"
                        onclick="document.getElementById('addTaskModal').classList.add('hidden')"
                        class="flex-1 bg-slate-200 hover:bg-slate-300 text-slate-700 px-4 py-2 rounded-lg transition-colors font-medium"
                    >
                        Batal
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Close modal when clicking outside -->
    <script>
        document.getElementById('addTaskModal')?.addEventListener('click', function(e) {
            if (e.target === this) {
                this.classList.add('hidden');
            }
        });
    </script>
@endsection
