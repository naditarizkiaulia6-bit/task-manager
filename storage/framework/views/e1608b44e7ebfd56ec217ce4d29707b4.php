<div x-data="{ showMenu: false }" class="bg-white rounded-lg shadow-sm p-4 hover:shadow-md transition-all cursor-move border-l-4 border-indigo-300">
    <!-- Header -->
    <div class="flex items-start justify-between mb-3">
        <h4 class="font-semibold text-slate-900 text-sm flex-1 pr-2"><?php echo e($task->title); ?></h4>
        <div class="relative">
            <button @click="showMenu = !showMenu" class="text-slate-400 hover:text-slate-600 p-1">
                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                    <path d="M10.5 1.5H9.5V3.5H10.5V1.5ZM10.5 9.5H9.5V11.5H10.5V9.5ZM10.5 17.5H9.5V19.5H10.5V17.5Z"></path>
                </svg>
            </button>

            <!-- Dropdown Menu -->
            <div x-show="showMenu" @click.outside="showMenu = false" class="absolute right-0 mt-1 w-32 bg-white border border-slate-200 rounded-lg shadow-lg z-10">
                <?php if($status): ?>
                    <form action="<?php echo e(route('tasks.update', $task)); ?>" method="POST" class="block">
                        <?php echo csrf_field(); ?>
                        <?php echo method_field('PUT'); ?>
                        <input type="hidden" name="status" value="<?php echo e($status); ?>">
                        <button type="submit" class="w-full text-left px-3 py-2 text-sm text-slate-700 hover:bg-slate-50">
                            Lanjutkan
                        </button>
                    </form>
                <?php endif; ?>

                <a href="<?php echo e(route('tasks.edit', $task)); ?>" class="block px-3 py-2 text-sm text-slate-700 hover:bg-slate-50">Edit</a>

                <form action="<?php echo e(route('tasks.destroy', $task)); ?>" method="POST" onsubmit="return confirm('Yakin ingin menghapus?')" class="block">
                    <?php echo csrf_field(); ?>
                    <?php echo method_field('DELETE'); ?>
                    <button type="submit" class="w-full text-left px-3 py-2 text-sm text-red-600 hover:bg-red-50">Hapus</button>
                </form>
            </div>
        </div>
    </div>

    <!-- Category Badge -->
    <div class="mb-3">
        <span class="inline-block px-2 py-1 text-xs font-semibold rounded text-white"
              <?php if($task->category === 'design'): ?> class="bg-purple-500" <?php endif; ?>
              <?php if($task->category === 'dev'): ?> class="bg-blue-500" <?php endif; ?>
              <?php if($task->category === 'bug'): ?> class="bg-red-500" <?php endif; ?>
              <?php if($task->category === 'research'): ?> class="bg-green-500" <?php endif; ?>>
            <?php echo e($task->category_label); ?>

        </span>
    </div>

    <!-- Description Preview -->
    <?php if($task->description): ?>
        <p class="text-xs text-slate-600 mb-3 line-clamp-2"><?php echo e($task->description); ?></p>
    <?php endif; ?>

    <!-- Priority Badge -->
    <div class="mb-3">
        <span class="inline-block px-2 py-1 text-xs font-semibold rounded"
              <?php if($task->priority === 'high'): ?> class="bg-red-100 text-red-700" <?php endif; ?>
              <?php if($task->priority === 'medium'): ?> class="bg-yellow-100 text-yellow-700" <?php endif; ?>
              <?php if($task->priority === 'low'): ?> class="bg-green-100 text-green-700" <?php endif; ?>>
            <?php echo e($task->priority_label); ?>

        </span>
    </div>

    <!-- Progress Bar -->
    <div class="mb-3">
        <div class="flex items-center justify-between mb-1">
            <span class="text-xs text-slate-500">Progress</span>
            <span class="text-xs font-semibold text-slate-700"><?php echo e($task->progress); ?>%</span>
        </div>
        <div class="w-full bg-slate-200 rounded-full h-2">
            <div class="bg-indigo-500 h-2 rounded-full transition-all duration-300"
                 style="width: <?php echo e($task->progress); ?>%"></div>
        </div>
    </div>

    <!-- Footer -->
    <div class="flex items-center justify-between pt-3 border-t border-slate-100">
        <!-- Due Date -->
        <?php if($task->due_date): ?>
            <div class="flex items-center gap-1 text-xs text-slate-500">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                </svg>
                <span><?php echo e($task->due_date->format('d M')); ?></span>
            </div>
        <?php else: ?>
            <span></span>
        <?php endif; ?>

        <!-- Avatar -->
        <?php if($task->assignee): ?>
            <div class="flex items-center">
                <div class="w-6 h-6 bg-indigo-500 rounded-full flex items-center justify-center text-white text-xs font-bold"
                     title="<?php echo e($task->assignee->name); ?>">
                    <?php echo e(substr($task->assignee->name, 0, 1)); ?>

                </div>
            </div>
        <?php endif; ?>
    </div>
</div>
<?php /**PATH C:\laragon\www\manajemen-tugas\resources\views/tasks/card.blade.php ENDPATH**/ ?>