@extends('layouts.app')

@section('page_title', 'Laporan - Analytics & Statistik')

@section('content')
    <!-- Filter Section -->
    <div class="bg-white rounded-xl shadow-sm p-6 mb-6">
        <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
            <div>
                <label class="block text-sm font-medium text-slate-700 mb-2">Proyek</label>
                <select class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500">
                    <option>Semua Proyek</option>
                    <option>Project Pertama</option>
                    <option>Project Kedua</option>
                    <option>Project Ketiga</option>
                </select>
            </div>

            <div>
                <label class="block text-sm font-medium text-slate-700 mb-2">Periode</label>
                <select class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500">
                    <option>Bulan Ini</option>
                    <option>Minggu Ini</option>
                    <option>Hari Ini</option>
                    <option>Bulan Lalu</option>
                </select>
            </div>

            <div>
                <label class="block text-sm font-medium text-slate-700 mb-2">Kategori</label>
                <select class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500">
                    <option>Semua Kategori</option>
                    <option>Development</option>
                    <option>Design</option>
                    <option>Bug</option>
                    <option>Research</option>
                </select>
            </div>

            <div class="flex items-end">
                <button class="w-full bg-indigo-500 hover:bg-indigo-600 text-white px-4 py-2 rounded-lg transition-colors font-medium">
                    Terapkan Filter
                </button>
            </div>
        </div>
    </div>

    <!-- Main Stats -->
    <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-6">
        <div class="bg-white rounded-xl shadow-sm p-6 border-l-4 border-indigo-500">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-slate-600 text-sm font-medium">Total Tugas</p>
                    <p class="text-3xl font-bold text-slate-900 mt-2">58</p>
                    <p class="text-xs text-green-600 mt-2">↑ 12% dari bulan lalu</p>
                </div>
                <div class="w-12 h-12 bg-indigo-100 rounded-lg flex items-center justify-center">
                    <svg class="w-6 h-6 text-indigo-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                    </svg>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-xl shadow-sm p-6 border-l-4 border-green-500">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-slate-600 text-sm font-medium">Tugas Selesai</p>
                    <p class="text-3xl font-bold text-slate-900 mt-2">42</p>
                    <p class="text-xs text-green-600 mt-2">72% completion rate</p>
                </div>
                <div class="w-12 h-12 bg-green-100 rounded-lg flex items-center justify-center">
                    <svg class="w-6 h-6 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-xl shadow-sm p-6 border-l-4 border-blue-500">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-slate-600 text-sm font-medium">Sedang Berjalan</p>
                    <p class="text-3xl font-bold text-slate-900 mt-2">12</p>
                    <p class="text-xs text-blue-600 mt-2">Dalam proses</p>
                </div>
                <div class="w-12 h-12 bg-blue-100 rounded-lg flex items-center justify-center">
                    <svg class="w-6 h-6 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                    </svg>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-xl shadow-sm p-6 border-l-4 border-red-500">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-slate-600 text-sm font-medium">Overdue</p>
                    <p class="text-3xl font-bold text-slate-900 mt-2">4</p>
                    <p class="text-xs text-red-600 mt-2">Perlu prioritas</p>
                </div>
                <div class="w-12 h-12 bg-red-100 rounded-lg flex items-center justify-center">
                    <svg class="w-6 h-6 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4v.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
            </div>
        </div>
    </div>

    <!-- Charts & Graphs -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-6">
        <!-- Task Status Distribution -->
        <div class="bg-white rounded-xl shadow-sm p-6">
            <h4 class="font-bold text-slate-900 mb-4">Distribusi Status Tugas</h4>

            <div class="space-y-4">
                <div>
                    <div class="flex items-center justify-between mb-2">
                        <span class="text-sm font-medium text-slate-700">Belum Mulai</span>
                        <span class="text-sm font-bold text-slate-900">16 tugas</span>
                    </div>
                    <div class="w-full bg-slate-200 rounded-full h-3">
                        <div class="bg-slate-500 h-3 rounded-full" style="width: 28%"></div>
                    </div>
                </div>

                <div>
                    <div class="flex items-center justify-between mb-2">
                        <span class="text-sm font-medium text-slate-700">Sedang Dikerjakan</span>
                        <span class="text-sm font-bold text-slate-900">12 tugas</span>
                    </div>
                    <div class="w-full bg-slate-200 rounded-full h-3">
                        <div class="bg-blue-500 h-3 rounded-full" style="width: 21%"></div>
                    </div>
                </div>

                <div>
                    <div class="flex items-center justify-between mb-2">
                        <span class="text-sm font-medium text-slate-700">Review</span>
                        <span class="text-sm font-bold text-slate-900">8 tugas</span>
                    </div>
                    <div class="w-full bg-slate-200 rounded-full h-3">
                        <div class="bg-yellow-500 h-3 rounded-full" style="width: 14%"></div>
                    </div>
                </div>

                <div>
                    <div class="flex items-center justify-between mb-2">
                        <span class="text-sm font-medium text-slate-700">Selesai</span>
                        <span class="text-sm font-bold text-slate-900">42 tugas</span>
                    </div>
                    <div class="w-full bg-slate-200 rounded-full h-3">
                        <div class="bg-green-500 h-3 rounded-full" style="width: 72%"></div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Priority Distribution -->
        <div class="bg-white rounded-xl shadow-sm p-6">
            <h4 class="font-bold text-slate-900 mb-4">Distribusi Prioritas</h4>

            <div class="flex items-center justify-around py-8">
                <div class="text-center">
                    <div class="w-24 h-24 rounded-full bg-gradient-to-br from-red-100 to-red-200 flex items-center justify-center mx-auto mb-2">
                        <span class="text-2xl font-bold text-red-600">18</span>
                    </div>
                    <p class="text-sm font-medium text-slate-700">High</p>
                    <p class="text-xs text-slate-600">31%</p>
                </div>

                <div class="text-center">
                    <div class="w-24 h-24 rounded-full bg-gradient-to-br from-yellow-100 to-yellow-200 flex items-center justify-center mx-auto mb-2">
                        <span class="text-2xl font-bold text-yellow-600">28</span>
                    </div>
                    <p class="text-sm font-medium text-slate-700">Medium</p>
                    <p class="text-xs text-slate-600">48%</p>
                </div>

                <div class="text-center">
                    <div class="w-24 h-24 rounded-full bg-gradient-to-br from-green-100 to-green-200 flex items-center justify-center mx-auto mb-2">
                        <span class="text-2xl font-bold text-green-600">12</span>
                    </div>
                    <p class="text-sm font-medium text-slate-700">Low</p>
                    <p class="text-xs text-slate-600">21%</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Category & Performance -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        <!-- Tasks by Category -->
        <div class="bg-white rounded-xl shadow-sm p-6">
            <h4 class="font-bold text-slate-900 mb-4">Tugas Berdasarkan Kategori</h4>

            <div class="space-y-4">
                <div class="flex items-center justify-between p-3 bg-slate-50 rounded-lg">
                    <div class="flex items-center gap-3">
                        <div class="w-3 h-3 rounded-full bg-blue-500"></div>
                        <span class="font-medium text-slate-900">Development</span>
                    </div>
                    <div class="text-right">
                        <p class="font-bold text-slate-900">24</p>
                        <p class="text-xs text-slate-600">41%</p>
                    </div>
                </div>

                <div class="flex items-center justify-between p-3 bg-slate-50 rounded-lg">
                    <div class="flex items-center gap-3">
                        <div class="w-3 h-3 rounded-full bg-purple-500"></div>
                        <span class="font-medium text-slate-900">Design</span>
                    </div>
                    <div class="text-right">
                        <p class="font-bold text-slate-900">18</p>
                        <p class="text-xs text-slate-600">31%</p>
                    </div>
                </div>

                <div class="flex items-center justify-between p-3 bg-slate-50 rounded-lg">
                    <div class="flex items-center gap-3">
                        <div class="w-3 h-3 rounded-full bg-red-500"></div>
                        <span class="font-medium text-slate-900">Bug</span>
                    </div>
                    <div class="text-right">
                        <p class="font-bold text-slate-900">10</p>
                        <p class="text-xs text-slate-600">17%</p>
                    </div>
                </div>

                <div class="flex items-center justify-between p-3 bg-slate-50 rounded-lg">
                    <div class="flex items-center gap-3">
                        <div class="w-3 h-3 rounded-full bg-green-500"></div>
                        <span class="font-medium text-slate-900">Research</span>
                    </div>
                    <div class="text-right">
                        <p class="font-bold text-slate-900">6</p>
                        <p class="text-xs text-slate-600">11%</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Team Performance -->
        <div class="bg-white rounded-xl shadow-sm p-6">
            <h4 class="font-bold text-slate-900 mb-4">Performa Tim</h4>

            <div class="space-y-4">
                <div class="flex items-center justify-between">
                    <div class="flex items-center gap-3 flex-1">
                        <div class="w-10 h-10 bg-indigo-500 rounded-full flex items-center justify-center text-white font-bold text-sm">
                            A
                        </div>
                        <div>
                            <p class="font-medium text-slate-900">Admin User</p>
                            <p class="text-xs text-slate-600">15 tugas selesai</p>
                        </div>
                    </div>
                    <div class="text-right">
                        <p class="font-bold text-slate-900">15/20</p>
                        <p class="text-xs text-green-600">75%</p>
                    </div>
                </div>

                <div class="flex items-center justify-between">
                    <div class="flex items-center gap-3 flex-1">
                        <div class="w-10 h-10 bg-blue-500 rounded-full flex items-center justify-center text-white font-bold text-sm">
                            U
                        </div>
                        <div>
                            <p class="font-medium text-slate-900">User 1</p>
                            <p class="text-xs text-slate-600">12 tugas selesai</p>
                        </div>
                    </div>
                    <div class="text-right">
                        <p class="font-bold text-slate-900">12/18</p>
                        <p class="text-xs text-green-600">67%</p>
                    </div>
                </div>

                <div class="flex items-center justify-between">
                    <div class="flex items-center gap-3 flex-1">
                        <div class="w-10 h-10 bg-green-500 rounded-full flex items-center justify-center text-white font-bold text-sm">
                            U
                        </div>
                        <div>
                            <p class="font-medium text-slate-900">User 2</p>
                            <p class="text-xs text-slate-600">10 tugas selesai</p>
                        </div>
                    </div>
                    <div class="text-right">
                        <p class="font-bold text-slate-900">10/15</p>
                        <p class="text-xs text-green-600">67%</p>
                    </div>
                </div>

                <div class="flex items-center justify-between">
                    <div class="flex items-center gap-3 flex-1">
                        <div class="w-10 h-10 bg-yellow-500 rounded-full flex items-center justify-center text-white font-bold text-sm">
                            U
                        </div>
                        <div>
                            <p class="font-medium text-slate-900">User 3</p>
                            <p class="text-xs text-slate-600">5 tugas selesai</p>
                        </div>
                    </div>
                    <div class="text-right">
                        <p class="font-bold text-slate-900">5/10</p>
                        <p class="text-xs text-yellow-600">50%</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
