

<?php $__env->startSection('page_title', $project->name); ?>

<?php $__env->startSection('content'); ?>
    <div class="mb-6 flex items-center justify-between">
        <div>
            <h3 class="text-2xl font-bold text-slate-900"><?php echo e($project->name); ?></h3>
            <?php if($project->description): ?>
                <p class="text-slate-600 mt-2"><?php echo e($project->description); ?></p>
            <?php endif; ?>
        </div>
        <div class="flex gap-2">
            <a href="<?php echo e(route('projects.edit', $project)); ?>" class="bg-indigo-500 hover:bg-indigo-600 text-white px-4 py-2 rounded-lg transition-colors flex items-center gap-2">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                </svg>
                Edit
            </a>
            <a href="<?php echo e(route('projects.index')); ?>" class="bg-slate-200 hover:bg-slate-300 text-slate-700 px-4 py-2 rounded-lg transition-colors">
                Kembali
            </a>
        </div>
    </div>

    <!-- Statistics -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-8">
        <div class="bg-white rounded-lg shadow-sm p-4">
            <p class="text-sm text-slate-600 font-medium">Total Tugas</p>
            <p class="text-2xl font-bold text-slate-900 mt-2"><?php echo e($project->tasks->count()); ?></p>
        </div>
        <div class="bg-white rounded-lg shadow-sm p-4">
            <p class="text-sm text-slate-600 font-medium">Sedang Berjalan</p>
            <p class="text-2xl font-bold text-blue-600 mt-2"><?php echo e($project->tasks->where('status', 'progress')->count()); ?></p>
        </div>
        <div class="bg-white rounded-lg shadow-sm p-4">
            <p class="text-sm text-slate-600 font-medium">Selesai</p>
            <p class="text-2xl font-bold text-green-600 mt-2"><?php echo e($project->tasks->where('status', 'done')->count()); ?></p>
        </div>
    </div>

    <!-- Tasks List -->
    <div class="bg-white rounded-xl shadow-sm overflow-hidden">
        <div class="px-6 py-4 border-b border-slate-200">
            <h4 class="text-lg font-semibold text-slate-900">Daftar Tugas</h4>
        </div>

        <?php if($project->tasks->count() > 0): ?>
            <div class="divide-y divide-slate-200">
                <?php $__currentLoopData = $project->tasks; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $task): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="px-6 py-4 hover:bg-slate-50 transition-colors">
                        <div class="flex items-start justify-between">
                            <div class="flex-1">
                                <h5 class="font-semibold text-slate-900"><?php echo e($task->title); ?></h5>
                                <p class="text-sm text-slate-600 mt-1"><?php echo e($task->description); ?></p>
                                <div class="flex items-center gap-4 mt-3">
                                    <span class="inline-block px-2 py-1 text-xs font-semibold rounded text-white
                                        <?php if($task->category === 'design'): ?> bg-purple-500
                                        <?php elseif($task->category === 'dev'): ?> bg-blue-500
                                        <?php elseif($task->category === 'bug'): ?> bg-red-500
                                        <?php elseif($task->category === 'research'): ?> bg-green-500
                                        <?php endif; ?>">
                                        <?php echo e($task->category_label); ?>

                                    </span>
                                    <span class="inline-block px-2 py-1 text-xs font-semibold rounded
                                        <?php if($task->priority === 'high'): ?> bg-red-100 text-red-700
                                        <?php elseif($task->priority === 'medium'): ?> bg-yellow-100 text-yellow-700
                                        <?php elseif($task->priority === 'low'): ?> bg-green-100 text-green-700
                                        <?php endif; ?>">
                                        <?php echo e($task->priority_label); ?>

                                    </span>
                                    <span class="text-xs text-slate-500 bg-slate-100 px-2 py-1 rounded">
                                        <?php echo e($task->status_label); ?>

                                    </span>
                                </div>
                            </div>
                            <a href="<?php echo e(route('tasks.edit', $task)); ?>" class="text-indigo-600 hover:text-indigo-700 font-medium text-sm ml-4">
                                Lihat
                            </a>
                        </div>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        <?php else: ?>
            <div class="px-6 py-8 text-center">
                <p class="text-slate-600">Belum ada tugas dalam proyek ini</p>
            </div>
        <?php endif; ?>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\manajemen-tugas\resources\views/projects/show.blade.php ENDPATH**/ ?>