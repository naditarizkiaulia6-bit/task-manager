@extends('layouts.app')

@section('page_title', isset($project) ? 'Edit Proyek' : 'Buat Proyek Baru')

@section('content')
    <div class="max-w-2xl">
        <div class="bg-white rounded-xl shadow-sm p-8">
            <form action="{{ isset($project) ? route('projects.update', $project) : route('projects.store') }}" method="POST">
                @csrf
                @if (isset($project))
                    @method('PUT')
                @endif

                <div class="mb-6">
                    <label for="name" class="block text-sm font-medium text-slate-700 mb-2">Nama Proyek</label>
                    <input
                        type="text"
                        name="name"
                        id="name"
                        value="{{ old('name', isset($project) ? $project->name : '') }}"
                        required
                        class="w-full px-4 py-3 border border-slate-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent"
                        placeholder="Masukkan nama proyek"
                    >
                    @error('name')<p class="text-red-500 text-sm mt-1">{{ $message }}</p>@enderror
                </div>

                <div class="mb-6">
                    <label for="description" class="block text-sm font-medium text-slate-700 mb-2">Deskripsi Proyek</label>
                    <textarea
                        name="description"
                        id="description"
                        rows="5"
                        class="w-full px-4 py-3 border border-slate-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent"
                        placeholder="Masukkan deskripsi proyek"
                    >{{ old('description', isset($project) ? $project->description : '') }}</textarea>
                    @error('description')<p class="text-red-500 text-sm mt-1">{{ $message }}</p>@enderror
                </div>

                <div class="flex gap-3">
                    <button
                        type="submit"
                        class="bg-indigo-500 hover:bg-indigo-600 text-white px-6 py-3 rounded-lg transition-colors font-medium"
                    >
                        {{ isset($project) ? 'Perbarui Proyek' : 'Buat Proyek' }}
                    </button>
                    <a
                        href="{{ route('projects.index') }}"
                        class="bg-slate-200 hover:bg-slate-300 text-slate-700 px-6 py-3 rounded-lg transition-colors font-medium"
                    >
                        Batal
                    </a>
                </div>
            </form>
        </div>
    </div>
@endsection
