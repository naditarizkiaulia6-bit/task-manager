

<?php $__env->startSection('page_title', 'Notifikasi'); ?>

<?php $__env->startSection('content'); ?>
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Notifications List -->
        <div class="lg:col-span-2">
            <!-- Filter Tabs -->
            <div class="bg-white rounded-xl shadow-sm p-4 mb-6">
                <div class="flex gap-2 overflow-x-auto">
                    <button class="px-4 py-2 bg-indigo-500 text-white rounded-lg font-medium whitespace-nowrap">
                        Semua (24)
                    </button>
                    <button class="px-4 py-2 bg-slate-100 text-slate-700 rounded-lg font-medium hover:bg-slate-200 transition-colors whitespace-nowrap">
                        Belum Dibaca (8)
                    </button>
                    <button class="px-4 py-2 bg-slate-100 text-slate-700 rounded-lg font-medium hover:bg-slate-200 transition-colors whitespace-nowrap">
                        Tugas (12)
                    </button>
                    <button class="px-4 py-2 bg-slate-100 text-slate-700 rounded-lg font-medium hover:bg-slate-200 transition-colors whitespace-nowrap">
                        Proyek (6)
                    </button>
                    <button class="px-4 py-2 bg-slate-100 text-slate-700 rounded-lg font-medium hover:bg-slate-200 transition-colors whitespace-nowrap">
                        Sistem (6)
                    </button>
                </div>
            </div>

            <!-- Notification Items -->
            <div class="space-y-3">
                <!-- Unread Notifications -->
                <div class="bg-indigo-50 border-l-4 border-indigo-500 rounded-lg p-4 hover:bg-indigo-100 transition-colors cursor-pointer">
                    <div class="flex items-start justify-between">
                        <div class="flex items-start gap-4 flex-1">
                            <div class="w-10 h-10 bg-indigo-500 rounded-full flex items-center justify-center text-white flex-shrink-0 mt-1">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                                </svg>
                            </div>
                            <div>
                                <h4 class="font-semibold text-slate-900">Tugas Baru Ditugaskan</h4>
                                <p class="text-sm text-slate-700 mt-1">Admin User telah menugaskan tugas "Setup Database untuk Project" kepada Anda</p>
                                <p class="text-xs text-slate-600 mt-2">5 menit yang lalu</p>
                            </div>
                        </div>
                        <button class="text-slate-400 hover:text-slate-600">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                            </svg>
                        </button>
                    </div>
                </div>

                <div class="bg-blue-50 border-l-4 border-blue-500 rounded-lg p-4 hover:bg-blue-100 transition-colors cursor-pointer">
                    <div class="flex items-start justify-between">
                        <div class="flex items-start gap-4 flex-1">
                            <div class="w-10 h-10 bg-blue-500 rounded-full flex items-center justify-center text-white flex-shrink-0 mt-1">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 8h10M7 12h4m1 8l-4-4H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-3l-4 4z"></path>
                                </svg>
                            </div>
                            <div>
                                <h4 class="font-semibold text-slate-900">Komentar Baru pada Tugas</h4>
                                <p class="text-sm text-slate-700 mt-1">User 1 menambahkan komentar pada "Code Review untuk Frontend"</p>
                                <p class="text-xs text-slate-600 mt-2">15 menit yang lalu</p>
                            </div>
                        </div>
                        <button class="text-slate-400 hover:text-slate-600">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                            </svg>
                        </button>
                    </div>
                </div>

                <div class="bg-green-50 border-l-4 border-green-500 rounded-lg p-4 hover:bg-green-100 transition-colors cursor-pointer">
                    <div class="flex items-start justify-between">
                        <div class="flex items-start gap-4 flex-1">
                            <div class="w-10 h-10 bg-green-500 rounded-full flex items-center justify-center text-white flex-shrink-0 mt-1">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                            </div>
                            <div>
                                <h4 class="font-semibold text-slate-900">Tugas Selesai</h4>
                                <p class="text-sm text-slate-700 mt-1">User 2 telah menyelesaikan tugas "API Integration"</p>
                                <p class="text-xs text-slate-600 mt-2">1 jam yang lalu</p>
                            </div>
                        </div>
                        <button class="text-slate-400 hover:text-slate-600">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                            </svg>
                        </button>
                    </div>
                </div>

                <!-- Read Notifications -->
                <div class="bg-white border border-slate-200 rounded-lg p-4 hover:bg-slate-50 transition-colors cursor-pointer opacity-75">
                    <div class="flex items-start justify-between">
                        <div class="flex items-start gap-4 flex-1">
                            <div class="w-10 h-10 bg-slate-300 rounded-full flex items-center justify-center text-white flex-shrink-0 mt-1">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                                </svg>
                            </div>
                            <div>
                                <h4 class="font-semibold text-slate-900">Tugas Status Berubah</h4>
                                <p class="text-sm text-slate-700 mt-1">User 3 mengubah status "Design Mockup UI" ke "Review"</p>
                                <p class="text-xs text-slate-600 mt-2">2 jam yang lalu</p>
                            </div>
                        </div>
                        <button class="text-slate-400 hover:text-slate-600">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                            </svg>
                        </button>
                    </div>
                </div>

                <div class="bg-white border border-slate-200 rounded-lg p-4 hover:bg-slate-50 transition-colors cursor-pointer opacity-75">
                    <div class="flex items-start justify-between">
                        <div class="flex items-start gap-4 flex-1">
                            <div class="w-10 h-10 bg-slate-300 rounded-full flex items-center justify-center text-white flex-shrink-0 mt-1">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                                </svg>
                            </div>
                            <div>
                                <h4 class="font-semibold text-slate-900">Proyek Baru Dibuat</h4>
                                <p class="text-sm text-slate-700 mt-1">Admin User membuat proyek baru "Project Marketing"</p>
                                <p class="text-xs text-slate-600 mt-2">5 jam yang lalu</p>
                            </div>
                        </div>
                        <button class="text-slate-400 hover:text-slate-600">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                            </svg>
                        </button>
                    </div>
                </div>

                <div class="bg-white border border-slate-200 rounded-lg p-4 hover:bg-slate-50 transition-colors cursor-pointer opacity-75">
                    <div class="flex items-start justify-between">
                        <div class="flex items-start gap-4 flex-1">
                            <div class="w-10 h-10 bg-slate-300 rounded-full flex items-center justify-center text-white flex-shrink-0 mt-1">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0018 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"></path>
                                </svg>
                            </div>
                            <div>
                                <h4 class="font-semibold text-slate-900">Reminder Deadline</h4>
                                <p class="text-sm text-slate-700 mt-1">Tugas "Testing Phase" akan berakhir dalam 3 hari</p>
                                <p class="text-xs text-slate-600 mt-2">1 hari yang lalu</p>
                            </div>
                        </div>
                        <button class="text-slate-400 hover:text-slate-600">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                            </svg>
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Sidebar -->
        <div class="space-y-6">
            <!-- Notification Settings -->
            <div class="bg-white rounded-xl shadow-sm p-6">
                <h4 class="font-bold text-slate-900 mb-4 flex items-center gap-2">
                    <svg class="w-5 h-5 text-indigo-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                    </svg>
                    Pengaturan Notifikasi
                </h4>

                <div class="space-y-4">
                    <div class="flex items-center justify-between">
                        <label class="text-sm font-medium text-slate-700">Tugas Baru</label>
                        <input type="checkbox" checked class="w-4 h-4 accent-indigo-500 rounded">
                    </div>

                    <div class="flex items-center justify-between">
                        <label class="text-sm font-medium text-slate-700">Status Berubah</label>
                        <input type="checkbox" checked class="w-4 h-4 accent-indigo-500 rounded">
                    </div>

                    <div class="flex items-center justify-between">
                        <label class="text-sm font-medium text-slate-700">Komentar Baru</label>
                        <input type="checkbox" checked class="w-4 h-4 accent-indigo-500 rounded">
                    </div>

                    <div class="flex items-center justify-between">
                        <label class="text-sm font-medium text-slate-700">Reminder Deadline</label>
                        <input type="checkbox" checked class="w-4 h-4 accent-indigo-500 rounded">
                    </div>

                    <div class="flex items-center justify-between">
                        <label class="text-sm font-medium text-slate-700">Proyek Baru</label>
                        <input type="checkbox" class="w-4 h-4 accent-indigo-500 rounded">
                    </div>
                </div>
            </div>

            <!-- Statistics -->
            <div class="bg-white rounded-xl shadow-sm p-6">
                <h4 class="font-bold text-slate-900 mb-4">Statistik Notifikasi</h4>

                <div class="space-y-3">
                    <div class="flex items-center justify-between p-3 bg-indigo-50 rounded-lg">
                        <span class="text-sm font-medium text-slate-700">Belum Dibaca</span>
                        <span class="text-lg font-bold text-indigo-600">8</span>
                    </div>

                    <div class="flex items-center justify-between p-3 bg-blue-50 rounded-lg">
                        <span class="text-sm font-medium text-slate-700">Hari Ini</span>
                        <span class="text-lg font-bold text-blue-600">12</span>
                    </div>

                    <div class="flex items-center justify-between p-3 bg-slate-50 rounded-lg">
                        <span class="text-sm font-medium text-slate-700">Total</span>
                        <span class="text-lg font-bold text-slate-600">24</span>
                    </div>
                </div>

                <button class="w-full mt-4 bg-slate-200 hover:bg-slate-300 text-slate-700 px-4 py-2 rounded-lg transition-colors font-medium text-sm">
                    Tandai Semua Dibaca
                </button>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\manajemen-tugas\resources\views/notifications/index.blade.php ENDPATH**/ ?>