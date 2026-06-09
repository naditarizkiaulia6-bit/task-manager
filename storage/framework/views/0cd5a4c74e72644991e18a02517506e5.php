

<?php $__env->startSection('page_title', 'Proyek-Proyek Saya'); ?>

<?php $__env->startSection('content'); ?>
    <div class="mb-6 flex items-center justify-between">
        <h3 class="text-lg font-semibold text-slate-900">Daftar Proyek</h3>
        <a href="<?php echo e(route('projects.create')); ?>" class="bg-indigo-500 hover:bg-indigo-600 text-white px-4 py-2 rounded-lg transition-colors flex items-center gap-2">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
            </svg>
            Proyek Baru
        </a>
    </div>

    <?php if($projects->count() > 0): ?>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            <?php $__currentLoopData = $projects; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $project): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="bg-white rounded-xl shadow-sm p-6 hover:shadow-md transition-shadow">
                    <div class="flex items-start justify-between mb-4">
                        <div>
                            <h4 class="text-lg font-semibold text-slate-900"><?php echo e($project->name); ?></h4>
                            <?php if($project->description): ?>
                                <p class="text-sm text-slate-600 mt-1"><?php echo e(Str::limit($project->description, 60)); ?></p>
                            <?php endif; ?>
                        </div>
                    </div>

                    <div class="bg-slate-50 rounded-lg p-3 mb-4">
                        <p class="text-sm text-slate-600">
                            <span class="font-semibold text-slate-900"><?php echo e($project->tasks->count()); ?></span> tugas
                        </p>
                        <p class="text-sm text-slate-600 mt-1">
                            <span class="font-semibold text-slate-900"><?php echo e($project->tasks->where('status', 'done')->count()); ?></span> selesai
                        </p>
                    </div>

                    <div class="flex items-center gap-2">
                        <a href="<?php echo e(route('projects.show', $project)); ?>" class="flex-1 bg-indigo-50 hover:bg-indigo-100 text-indigo-600 px-3 py-2 rounded-lg transition-colors text-sm font-medium text-center">
                            Lihat
                        </a>
                        <a href="<?php echo e(route('projects.edit', $project)); ?>" class="bg-slate-100 hover:bg-slate-200 text-slate-700 px-3 py-2 rounded-lg transition-colors">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                            </svg>
                        </a>
                        <form action="<?php echo e(route('projects.destroy', $project)); ?>" method="POST" onsubmit="return confirm('Yakin ingin menghapus proyek ini?')" class="inline">
                            <?php echo csrf_field(); ?>
                            <?php echo method_field('DELETE'); ?>
                            <button type="submit" class="bg-red-50 hover:bg-red-100 text-red-600 px-3 py-2 rounded-lg transition-colors">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                </svg>
                            </button>
                        </form>
                    </div>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    <?php else: ?>
        <div class="flex flex-col items-center justify-center min-h-[400px] text-center bg-white rounded-xl">
            <svg class="w-16 h-16 text-slate-300 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
            </svg>
            <h3 class="text-xl font-semibold text-slate-900 mb-2">Belum ada proyek</h3>
            <p class="text-slate-600 mb-6">Mulai dengan membuat proyek baru</p>
            <a href="<?php echo e(route('projects.create')); ?>" class="bg-indigo-500 hover:bg-indigo-600 text-white px-6 py-2 rounded-lg transition-colors">
                Buat Proyek Pertama
            </a>
        </div>
    <?php endif; ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\manajemen-tugas\resources\views/projects/index.blade.php ENDPATH**/ ?>