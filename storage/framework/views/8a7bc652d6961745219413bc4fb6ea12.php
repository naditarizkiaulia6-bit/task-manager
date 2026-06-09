

<?php $__env->startSection('page_title', 'Pengaturan'); ?>

<?php $__env->startSection('content'); ?>
    <div class="grid grid-cols-1 lg:grid-cols-4 gap-6">
        <!-- Sidebar Menu -->
        <div class="lg:col-span-1">
            <div class="bg-white rounded-xl shadow-sm overflow-hidden sticky top-24">
                <nav class="p-4 space-y-2">
                    <a href="#profile" class="block px-4 py-3 bg-indigo-50 text-indigo-600 rounded-lg font-medium border-l-4 border-indigo-500">
                        Profil Saya
                    </a>
                    <a href="#account" class="block px-4 py-3 text-slate-700 hover:bg-slate-50 rounded-lg font-medium transition-colors">
                        Akun
                    </a>
                    <a href="#notifications" class="block px-4 py-3 text-slate-700 hover:bg-slate-50 rounded-lg font-medium transition-colors">
                        Notifikasi
                    </a>
                    <a href="#privacy" class="block px-4 py-3 text-slate-700 hover:bg-slate-50 rounded-lg font-medium transition-colors">
                        Privasi & Keamanan
                    </a>
                    <a href="#appearance" class="block px-4 py-3 text-slate-700 hover:bg-slate-50 rounded-lg font-medium transition-colors">
                        Tampilan
                    </a>
                    <a href="#integrations" class="block px-4 py-3 text-slate-700 hover:bg-slate-50 rounded-lg font-medium transition-colors">
                        Integrasi
                    </a>
                </nav>
            </div>
        </div>

        <!-- Settings Content -->
        <div class="lg:col-span-3 space-y-6">
            <!-- Profile Section -->
            <div id="profile" class="bg-white rounded-xl shadow-sm p-8">
                <h3 class="text-lg font-bold text-slate-900 mb-6 flex items-center gap-2">
                    <svg class="w-6 h-6 text-indigo-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                    </svg>
                    Profil Saya
                </h3>

                <div class="flex flex-col md:flex-row gap-8 mb-8 pb-8 border-b border-slate-200">
                    <div class="flex flex-col items-center">
                        <div class="w-24 h-24 bg-indigo-500 rounded-full flex items-center justify-center text-white text-3xl font-bold mb-4">
                            <?php echo e(substr(auth()->user()->name, 0, 1)); ?>

                        </div>
                        <button class="text-indigo-600 hover:text-indigo-700 font-medium text-sm">
                            Ubah Foto
                        </button>
                    </div>

                    <div class="flex-1">
                        <div class="mb-4">
                            <label class="block text-sm font-medium text-slate-700 mb-2">Nama Lengkap</label>
                            <input type="text" value="<?php echo e(auth()->user()->name); ?>" class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500">
                        </div>

                        <div class="mb-4">
                            <label class="block text-sm font-medium text-slate-700 mb-2">Email</label>
                            <input type="email" value="<?php echo e(auth()->user()->email); ?>" class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500">
                        </div>

                        <div class="mb-4">
                            <label class="block text-sm font-medium text-slate-700 mb-2">Role</label>
                            <div class="px-4 py-2 bg-slate-50 border border-slate-300 rounded-lg text-slate-600">
                                <?php if(auth()->user()->role === 'admin'): ?>
                                    <span class="inline-block px-3 py-1 bg-indigo-100 text-indigo-700 rounded-full text-sm font-semibold">Administrator</span>
                                <?php else: ?>
                                    <span class="inline-block px-3 py-1 bg-slate-100 text-slate-700 rounded-full text-sm font-semibold">Member</span>
                                <?php endif; ?>
                            </div>
                        </div>

                        <div class="mb-4">
                            <label class="block text-sm font-medium text-slate-700 mb-2">Bio</label>
                            <textarea rows="3" class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500" placeholder="Ceritakan tentang diri Anda..."></textarea>
                        </div>

                        <button class="bg-indigo-500 hover:bg-indigo-600 text-white px-6 py-2 rounded-lg transition-colors font-medium">
                            Simpan Perubahan
                        </button>
                    </div>
                </div>
            </div>

            <!-- Account Section -->
            <div id="account" class="bg-white rounded-xl shadow-sm p-8">
                <h3 class="text-lg font-bold text-slate-900 mb-6 flex items-center gap-2">
                    <svg class="w-6 h-6 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                    </svg>
                    Akun
                </h3>

                <div class="space-y-6">
                    <div>
                        <h4 class="font-semibold text-slate-900 mb-3">Ubah Password</h4>
                        <div class="mb-4">
                            <label class="block text-sm font-medium text-slate-700 mb-2">Password Lama</label>
                            <input type="password" class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500">
                        </div>

                        <div class="mb-4">
                            <label class="block text-sm font-medium text-slate-700 mb-2">Password Baru</label>
                            <input type="password" class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500">
                        </div>

                        <div class="mb-4">
                            <label class="block text-sm font-medium text-slate-700 mb-2">Konfirmasi Password Baru</label>
                            <input type="password" class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500">
                        </div>

                        <button class="bg-indigo-500 hover:bg-indigo-600 text-white px-6 py-2 rounded-lg transition-colors font-medium">
                            Ubah Password
                        </button>
                    </div>

                    <div class="pt-6 border-t border-slate-200">
                        <h4 class="font-semibold text-slate-900 mb-3">Session Aktif</h4>
                        <div class="space-y-3">
                            <div class="flex items-center justify-between p-4 bg-slate-50 rounded-lg">
                                <div>
                                    <p class="font-medium text-slate-900">Chrome pada Windows</p>
                                    <p class="text-sm text-slate-600">Aktif sekarang</p>
                                </div>
                                <button class="text-slate-400 hover:text-slate-600">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                    </svg>
                                </button>
                            </div>

                            <div class="flex items-center justify-between p-4 bg-slate-50 rounded-lg">
                                <div>
                                    <p class="font-medium text-slate-900">Firefox pada MacOS</p>
                                    <p class="text-sm text-slate-600">2 jam yang lalu</p>
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
            </div>

            <!-- Notifications Section -->
            <div id="notifications" class="bg-white rounded-xl shadow-sm p-8">
                <h3 class="text-lg font-bold text-slate-900 mb-6 flex items-center gap-2">
                    <svg class="w-6 h-6 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0018 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"></path>
                    </svg>
                    Pengaturan Notifikasi
                </h3>

                <div class="space-y-4">
                    <div class="flex items-center justify-between p-4 bg-slate-50 rounded-lg">
                        <div>
                            <h4 class="font-semibold text-slate-900">Notifikasi Email</h4>
                            <p class="text-sm text-slate-600">Terima email untuk aktivitas penting</p>
                        </div>
                        <input type="checkbox" checked class="w-5 h-5 accent-indigo-500 rounded">
                    </div>

                    <div class="flex items-center justify-between p-4 bg-slate-50 rounded-lg">
                        <div>
                            <h4 class="font-semibold text-slate-900">Notifikasi Desktop</h4>
                            <p class="text-sm text-slate-600">Tampilkan notifikasi browser</p>
                        </div>
                        <input type="checkbox" checked class="w-5 h-5 accent-indigo-500 rounded">
                    </div>

                    <div class="flex items-center justify-between p-4 bg-slate-50 rounded-lg">
                        <div>
                            <h4 class="font-semibold text-slate-900">Reminder Deadline</h4>
                            <p class="text-sm text-slate-600">Notifikasi untuk deadline yang akan datang</p>
                        </div>
                        <input type="checkbox" checked class="w-5 h-5 accent-indigo-500 rounded">
                    </div>

                    <div class="flex items-center justify-between p-4 bg-slate-50 rounded-lg">
                        <div>
                            <h4 class="font-semibold text-slate-900">Update Tim</h4>
                            <p class="text-sm text-slate-600">Notifikasi aktivitas tim</p>
                        </div>
                        <input type="checkbox" class="w-5 h-5 accent-indigo-500 rounded">
                    </div>
                </div>
            </div>

            <!-- Privacy & Security Section -->
            <div id="privacy" class="bg-white rounded-xl shadow-sm p-8">
                <h3 class="text-lg font-bold text-slate-900 mb-6 flex items-center gap-2">
                    <svg class="w-6 h-6 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                    </svg>
                    Privasi & Keamanan
                </h3>

                <div class="space-y-6">
                    <div>
                        <h4 class="font-semibold text-slate-900 mb-3">Siapa yang Bisa Melihat Profil Anda?</h4>
                        <select class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500">
                            <option selected>Semua Orang</option>
                            <option>Hanya Anggota Tim</option>
                            <option>Pribadi (Hanya Anda)</option>
                        </select>
                    </div>

                    <div>
                        <h4 class="font-semibold text-slate-900 mb-3">Verifikasi Dua Faktor</h4>
                        <div class="p-4 bg-slate-50 rounded-lg flex items-center justify-between">
                            <div>
                                <p class="font-medium text-slate-900">Aktifkan 2FA</p>
                                <p class="text-sm text-slate-600">Tingkatkan keamanan akun Anda</p>
                            </div>
                            <button class="bg-indigo-500 hover:bg-indigo-600 text-white px-4 py-2 rounded-lg transition-colors font-medium text-sm">
                                Aktifkan
                            </button>
                        </div>
                    </div>

                    <div>
                        <h4 class="font-semibold text-slate-900 mb-3 text-red-600">Zona Bahaya</h4>
                        <div class="p-4 bg-red-50 border border-red-200 rounded-lg">
                            <p class="text-sm text-red-700 mb-3">Hapus akun Anda secara permanen. Aksi ini tidak dapat dibatalkan.</p>
                            <button class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded-lg transition-colors font-medium text-sm">
                                Hapus Akun
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Appearance Section -->
            <div id="appearance" class="bg-white rounded-xl shadow-sm p-8">
                <h3 class="text-lg font-bold text-slate-900 mb-6 flex items-center gap-2">
                    <svg class="w-6 h-6 text-purple-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21a4 4 0 01-4-4V5a2 2 0 012-2h4a2 2 0 012 2v12a4 4 0 01-4 4zm0 0h12a2 2 0 002-2v-4a2 2 0 00-2-2h-2.343M11 7.343l1.657-1.657a2 2 0 012.828 0l2.829 2.829a2 2 0 010 2.828l-8.486 8.485M7 17h.01"></path>
                    </svg>
                    Tampilan
                </h3>

                <div>
                    <h4 class="font-semibold text-slate-900 mb-3">Tema</h4>
                    <div class="grid grid-cols-3 gap-4">
                        <div class="p-4 border-2 border-indigo-500 rounded-lg cursor-pointer bg-slate-50">
                            <p class="font-medium text-slate-900 text-center">Light</p>
                        </div>
                        <div class="p-4 border-2 border-slate-300 rounded-lg cursor-pointer bg-slate-800">
                            <p class="font-medium text-white text-center">Dark</p>
                        </div>
                        <div class="p-4 border-2 border-slate-300 rounded-lg cursor-pointer">
                            <p class="font-medium text-slate-900 text-center">Otomatis</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Integrations Section -->
            <div id="integrations" class="bg-white rounded-xl shadow-sm p-8">
                <h3 class="text-lg font-bold text-slate-900 mb-6 flex items-center gap-2">
                    <svg class="w-6 h-6 text-orange-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 00 14.5 15h-5l-.5 2.5"></path>
                    </svg>
                    Integrasi
                </h3>

                <div class="space-y-3">
                    <div class="flex items-center justify-between p-4 bg-slate-50 rounded-lg">
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 bg-blue-100 rounded-lg flex items-center justify-center">
                                <span class="font-bold text-blue-600">G</span>
                            </div>
                            <div>
                                <p class="font-medium text-slate-900">Google</p>
                                <p class="text-sm text-slate-600">Sinkronkan kalender</p>
                            </div>
                        </div>
                        <button class="bg-indigo-500 hover:bg-indigo-600 text-white px-4 py-2 rounded-lg transition-colors font-medium text-sm">
                            Hubungkan
                        </button>
                    </div>

                    <div class="flex items-center justify-between p-4 bg-slate-50 rounded-lg">
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 bg-slate-200 rounded-lg flex items-center justify-center">
                                <span class="font-bold text-slate-600">S</span>
                            </div>
                            <div>
                                <p class="font-medium text-slate-900">Slack</p>
                                <p class="text-sm text-slate-600">Dapatkan notifikasi di Slack</p>
                            </div>
                        </div>
                        <button class="bg-indigo-500 hover:bg-indigo-600 text-white px-4 py-2 rounded-lg transition-colors font-medium text-sm">
                            Hubungkan
                        </button>
                    </div>

                    <div class="flex items-center justify-between p-4 bg-slate-50 rounded-lg">
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 bg-red-100 rounded-lg flex items-center justify-center">
                                <span class="font-bold text-red-600">T</span>
                            </div>
                            <div>
                                <p class="font-medium text-slate-900">Trello</p>
                                <p class="text-sm text-slate-600">Pindahkan data dari Trello</p>
                            </div>
                        </div>
                        <button class="bg-indigo-500 hover:bg-indigo-600 text-white px-4 py-2 rounded-lg transition-colors font-medium text-sm">
                            Hubungkan
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\manajemen-tugas\resources\views/settings/index.blade.php ENDPATH**/ ?>