@extends('layouts.app')

@section('page_title', 'Kalender - Jadwal Tugas')

@section('content')
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Calendar Main -->
        <div class="lg:col-span-2">
            <div class="bg-white rounded-xl shadow-sm p-6">
                <div class="flex items-center justify-between mb-6">
                    <h3 class="text-lg font-bold text-slate-900">{{ now()->format('F Y') }}</h3>
                    <div class="flex gap-2">
                        <button class="bg-slate-100 hover:bg-slate-200 text-slate-700 px-4 py-2 rounded-lg transition-colors text-sm font-medium">
                            ← Sebelumnya
                        </button>
                        <button class="bg-indigo-500 hover:bg-indigo-600 text-white px-4 py-2 rounded-lg transition-colors text-sm font-medium">
                            Hari Ini
                        </button>
                        <button class="bg-slate-100 hover:bg-slate-200 text-slate-700 px-4 py-2 rounded-lg transition-colors text-sm font-medium">
                            Selanjutnya →
                        </button>
                    </div>
                </div>

                <!-- Calendar Grid -->
                <div class="mb-6">
                    <div class="grid grid-cols-7 gap-2 mb-2">
                        @foreach(['Min', 'Sen', 'Sel', 'Rab', 'Kam', 'Jum', 'Sab'] as $day)
                            <div class="text-center font-semibold text-slate-700 text-sm py-2">{{ $day }}</div>
                        @endforeach
                    </div>

                    <div class="grid grid-cols-7 gap-2">
                        @for ($i = 1; $i <= 35; $i++)
                            @if ($i <= 5 || $i > 31)
                                <div class="p-2 text-center text-slate-300 bg-slate-50 rounded-lg text-sm h-20"></div>
                            @else
                                <div class="p-2 border border-slate-200 rounded-lg hover:bg-indigo-50 cursor-pointer transition-colors h-20 flex flex-col">
                                    <div class="font-semibold text-slate-900 text-sm">{{ $i - 4 }}</div>
                                    <div class="flex-1 text-xs text-slate-600 overflow-hidden">
                                        @if (in_array($i - 4, [5, 12, 18, 25]))
                                            <div class="bg-indigo-100 text-indigo-700 px-1 py-0.5 rounded text-xs mb-1 truncate">Tugas</div>
                                        @endif
                                    </div>
                                </div>
                            @endif
                        @endfor
                    </div>
                </div>

                <!-- Task List -->
                <div class="border-t border-slate-200 pt-6">
                    <h4 class="font-semibold text-slate-900 mb-4">Tugas Hari Ini</h4>
                    <div class="space-y-3">
                        <div class="flex items-start gap-3 p-3 bg-slate-50 rounded-lg hover:bg-slate-100 transition-colors">
                            <input type="checkbox" class="w-5 h-5 mt-0.5 accent-indigo-500 rounded cursor-pointer">
                            <div class="flex-1">
                                <h5 class="font-medium text-slate-900">Setup Database untuk Project</h5>
                                <p class="text-xs text-slate-600 mt-1">Development • High Priority</p>
                            </div>
                            <span class="text-xs font-semibold text-indigo-600 bg-indigo-100 px-2 py-1 rounded">09:00</span>
                        </div>

                        <div class="flex items-start gap-3 p-3 bg-slate-50 rounded-lg hover:bg-slate-100 transition-colors">
                            <input type="checkbox" class="w-5 h-5 mt-0.5 accent-indigo-500 rounded cursor-pointer">
                            <div class="flex-1">
                                <h5 class="font-medium text-slate-900">Code Review untuk Frontend</h5>
                                <p class="text-xs text-slate-600 mt-1">Development • Medium Priority</p>
                            </div>
                            <span class="text-xs font-semibold text-blue-600 bg-blue-100 px-2 py-1 rounded">14:00</span>
                        </div>

                        <div class="flex items-start gap-3 p-3 bg-slate-50 rounded-lg hover:bg-slate-100 transition-colors">
                            <input type="checkbox" class="w-5 h-5 mt-0.5 accent-indigo-500 rounded cursor-pointer">
                            <div class="flex-1">
                                <h5 class="font-medium text-slate-900">Design Mockup UI Baru</h5>
                                <p class="text-xs text-slate-600 mt-1">Design • Medium Priority</p>
                            </div>
                            <span class="text-xs font-semibold text-purple-600 bg-purple-100 px-2 py-1 rounded">16:00</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Sidebar - Upcoming Tasks -->
        <div>
            <!-- Upcoming Tasks -->
            <div class="bg-white rounded-xl shadow-sm p-6 mb-6">
                <h4 class="font-bold text-slate-900 mb-4 flex items-center gap-2">
                    <svg class="w-5 h-5 text-indigo-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                    </svg>
                    Tugas Mendatang
                </h4>

                <div class="space-y-3">
                    <div class="border-l-4 border-indigo-500 pl-4 py-2">
                        <p class="text-sm font-semibold text-slate-900">Besok</p>
                        <p class="text-xs text-slate-600 mt-1">3 tugas terjadwal</p>
                    </div>

                    <div class="border-l-4 border-blue-500 pl-4 py-2">
                        <p class="text-sm font-semibold text-slate-900">Minggu Depan</p>
                        <p class="text-xs text-slate-600 mt-1">8 tugas terjadwal</p>
                    </div>

                    <div class="border-l-4 border-green-500 pl-4 py-2">
                        <p class="text-sm font-semibold text-slate-900">Bulan Depan</p>
                        <p class="text-xs text-slate-600 mt-1">5 tugas terjadwal</p>
                    </div>
                </div>
            </div>

            <!-- Deadline Warnings -->
            <div class="bg-white rounded-xl shadow-sm p-6">
                <h4 class="font-bold text-slate-900 mb-4 flex items-center gap-2">
                    <svg class="w-5 h-5 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4v.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    Segera Berakhir
                </h4>

                <div class="space-y-3">
                    <div class="p-3 bg-red-50 border border-red-200 rounded-lg">
                        <p class="text-xs font-semibold text-red-700">Hari Ini</p>
                        <p class="text-sm text-red-600 mt-1">2 tugas harus selesai</p>
                    </div>

                    <div class="p-3 bg-yellow-50 border border-yellow-200 rounded-lg">
                        <p class="text-xs font-semibold text-yellow-700">Besok</p>
                        <p class="text-sm text-yellow-600 mt-1">5 tugas harus selesai</p>
                    </div>

                    <div class="p-3 bg-orange-50 border border-orange-200 rounded-lg">
                        <p class="text-xs font-semibold text-orange-700">2-3 Hari</p>
                        <p class="text-sm text-orange-600 mt-1">3 tugas harus selesai</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
