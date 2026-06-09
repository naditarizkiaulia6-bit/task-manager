@extends('layouts.app')

@section('page_title', 'Tambah Tag - Raw SQL')

@section('content')
    <div class="max-w-2xl">
        <div class="bg-white rounded-xl shadow-sm p-8">
            <div class="mb-6 pb-6 border-b border-slate-200">
                <h3 class="text-lg font-bold text-slate-900">Tambah Tag Baru</h3>
                <p class="text-sm text-slate-600 mt-1">Menggunakan <span class="font-mono bg-slate-100 px-2 py-1 rounded">Raw SQL - INSERT</span></p>
            </div>

            <form action="{{ route('tags.raw-sql.store') }}" method="POST" class="space-y-6">
                @csrf

                <div>
                    <label for="name" class="block text-sm font-medium text-slate-700 mb-2">Nama Tag</label>
                    <input 
                        type="text" 
                        name="name" 
                        id="name"
                        value="{{ old('name') }}"
                        required
                        maxlength="50"
                        class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500"
                        placeholder="e.g., Frontend, Backend, Testing">
                    @error('name')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="color" class="block text-sm font-medium text-slate-700 mb-2">Warna</label>
                    <div class="grid grid-cols-4 gap-3">
                        @foreach ($colors as $value => $label)
                            <label class="flex items-center cursor-pointer">
                                <input 
                                    type="radio" 
                                    name="color" 
                                    value="{{ $value }}"
                                    {{ old('color') == $value ? 'checked' : '' }}
                                    required
                                    class="w-4 h-4 accent-indigo-500">
                                <span class="ml-2 text-sm text-slate-700">{{ $label }}</span>
                            </label>
                        @endforeach
                    </div>
                    @error('color')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="description" class="block text-sm font-medium text-slate-700 mb-2">Deskripsi (Opsional)</label>
                    <textarea 
                        name="description" 
                        id="description"
                        rows="3"
                        maxlength="255"
                        class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500"
                        placeholder="Deskripsi tag..."></textarea>
                    @error('description')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="flex gap-3 pt-4">
                    <button 
                        type="submit" 
                        class="bg-indigo-500 hover:bg-indigo-600 text-white px-6 py-2 rounded-lg transition-colors font-medium">
                        Simpan Tag
                    </button>
                    <a 
                        href="{{ route('tags.raw-sql.index') }}" 
                        class="bg-slate-200 hover:bg-slate-300 text-slate-700 px-6 py-2 rounded-lg transition-colors font-medium">
                        Batal
                    </a>
                </div>
            </form>

            <!-- SQL Code Example -->
            <div class="mt-8 p-4 bg-slate-100 rounded-lg">
                <p class="text-sm font-mono text-slate-800">
                    <span class="text-indigo-600 font-bold">SQL INSERT:</span><br>
                    INSERT INTO tags (name, color, description, created_at, updated_at)<br>
                    VALUES (?, ?, ?, NOW(), NOW())
                </p>
            </div>
        </div>
    </div>
@endsection
