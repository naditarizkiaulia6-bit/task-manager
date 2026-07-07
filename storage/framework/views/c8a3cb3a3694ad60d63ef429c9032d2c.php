

<?php $__env->startSection('page_title', 'Dashboard - Kanban Board'); ?>

<?php $__env->startSection('content'); ?>
    <div class="flex flex-col items-center justify-center min-h-[400px] text-center">
        <svg class="w-16 h-16 text-slate-300 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
        </svg>
        <h3 class="text-xl font-semibold text-slate-900 mb-2">Belum ada proyek</h3>
        <p class="text-slate-600 mb-6">Buat proyek baru untuk mulai mengelola tugas-tugas Anda</p>
        <a href="<?php echo e(route('projects.create')); ?>" class="bg-indigo-500 hover:bg-indigo-600 text-white px-6 py-2 rounded-lg transition-colors">
            Buat Proyek Baru
        </a>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\manajemen-tugas\resources\views/tasks/empty.blade.php ENDPATH**/ ?>