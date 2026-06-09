

<?php $__env->startSection('page_title', 'Edit Tugas'); ?>

<?php $__env->startSection('content'); ?>
    <div class="max-w-2xl">
        <div class="bg-white rounded-xl shadow-sm p-8">
            <form action="<?php echo e(route('tasks.update', $task)); ?>" method="POST">
                <?php echo csrf_field(); ?>
                <?php echo method_field('PUT'); ?>

                <div class="mb-6">
                    <label for="title" class="block text-sm font-medium text-slate-700 mb-2">Judul Tugas</label>
                    <input
                        type="text"
                        name="title"
                        id="title"
                        value="<?php echo e(old('title', $task->title)); ?>"
                        required
                        class="w-full px-4 py-3 border border-slate-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent"
                        placeholder="Masukkan judul tugas"
                    >
                    <?php $__errorArgs = ['title'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><p class="text-red-500 text-sm mt-1"><?php echo e($message); ?></p><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>

                <div class="mb-6">
                    <label for="description" class="block text-sm font-medium text-slate-700 mb-2">Deskripsi</label>
                    <textarea
                        name="description"
                        id="description"
                        rows="4"
                        class="w-full px-4 py-3 border border-slate-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent"
                        placeholder="Masukkan deskripsi tugas"
                    ><?php echo e(old('description', $task->description)); ?></textarea>
                    <?php $__errorArgs = ['description'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><p class="text-red-500 text-sm mt-1"><?php echo e($message); ?></p><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>

                <div class="grid grid-cols-2 gap-4 mb-6">
                    <div>
                        <label for="category" class="block text-sm font-medium text-slate-700 mb-2">Kategori</label>
                        <select name="category" id="category" required class="w-full px-4 py-3 border border-slate-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent">
                            <option value="dev" <?php echo e($task->category === 'dev' ? 'selected' : ''); ?>>Pengembangan</option>
                            <option value="design" <?php echo e($task->category === 'design' ? 'selected' : ''); ?>>Desain</option>
                            <option value="bug" <?php echo e($task->category === 'bug' ? 'selected' : ''); ?>>Bug</option>
                            <option value="research" <?php echo e($task->category === 'research' ? 'selected' : ''); ?>>Riset</option>
                        </select>
                        <?php $__errorArgs = ['category'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><p class="text-red-500 text-sm mt-1"><?php echo e($message); ?></p><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>

                    <div>
                        <label for="priority" class="block text-sm font-medium text-slate-700 mb-2">Prioritas</label>
                        <select name="priority" id="priority" required class="w-full px-4 py-3 border border-slate-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent">
                            <option value="low" <?php echo e($task->priority === 'low' ? 'selected' : ''); ?>>Rendah</option>
                            <option value="medium" <?php echo e($task->priority === 'medium' ? 'selected' : ''); ?>>Sedang</option>
                            <option value="high" <?php echo e($task->priority === 'high' ? 'selected' : ''); ?>>Tinggi</option>
                        </select>
                        <?php $__errorArgs = ['priority'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><p class="text-red-500 text-sm mt-1"><?php echo e($message); ?></p><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>
                </div>

                <div class="grid grid-cols-2 gap-4 mb-6">
                    <div>
                        <label for="status" class="block text-sm font-medium text-slate-700 mb-2">Status</label>
                        <select name="status" id="status" required class="w-full px-4 py-3 border border-slate-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent">
                            <option value="todo" <?php echo e($task->status === 'todo' ? 'selected' : ''); ?>>Belum Mulai</option>
                            <option value="progress" <?php echo e($task->status === 'progress' ? 'selected' : ''); ?>>Sedang Dikerjakan</option>
                            <option value="review" <?php echo e($task->status === 'review' ? 'selected' : ''); ?>>Review</option>
                            <option value="done" <?php echo e($task->status === 'done' ? 'selected' : ''); ?>>Selesai</option>
                        </select>
                        <?php $__errorArgs = ['status'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><p class="text-red-500 text-sm mt-1"><?php echo e($message); ?></p><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>

                    <div>
                        <label for="progress" class="block text-sm font-medium text-slate-700 mb-2">Progress (%)</label>
                        <input
                            type="number"
                            name="progress"
                            id="progress"
                            value="<?php echo e(old('progress', $task->progress)); ?>"
                            min="0"
                            max="100"
                            class="w-full px-4 py-3 border border-slate-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent"
                        >
                        <?php $__errorArgs = ['progress'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><p class="text-red-500 text-sm mt-1"><?php echo e($message); ?></p><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>
                </div>

                <div class="mb-6">
                    <label for="due_date" class="block text-sm font-medium text-slate-700 mb-2">Tanggal Tenggat</label>
                    <input
                        type="date"
                        name="due_date"
                        id="due_date"
                        value="<?php echo e(old('due_date', $task->due_date?->format('Y-m-d'))); ?>"
                        class="w-full px-4 py-3 border border-slate-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent"
                    >
                    <?php $__errorArgs = ['due_date'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><p class="text-red-500 text-sm mt-1"><?php echo e($message); ?></p><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>

                <div class="flex gap-3">
                    <button
                        type="submit"
                        class="bg-indigo-500 hover:bg-indigo-600 text-white px-6 py-3 rounded-lg transition-colors font-medium"
                    >
                        Perbarui Tugas
                    </button>
                    <a
                        href="<?php echo e(route('tasks.show', $task)); ?>"
                        class="bg-slate-200 hover:bg-slate-300 text-slate-700 px-6 py-3 rounded-lg transition-colors font-medium"
                    >
                        Batal
                    </a>
                </div>
            </form>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\manajemen-tugas\resources\views/tasks/edit.blade.php ENDPATH**/ ?>