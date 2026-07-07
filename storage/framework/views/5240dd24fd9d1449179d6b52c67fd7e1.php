

<?php $__env->startSection('page_title', isset($project) ? 'Edit Proyek' : 'Buat Proyek Baru'); ?>

<?php $__env->startSection('content'); ?>
    <div class="max-w-2xl">
        <div class="bg-white rounded-xl shadow-sm p-8">
            <form action="<?php echo e(isset($project) ? route('projects.update', $project) : route('projects.store')); ?>" method="POST">
                <?php echo csrf_field(); ?>
                <?php if(isset($project)): ?>
                    <?php echo method_field('PUT'); ?>
                <?php endif; ?>

                <div class="mb-6">
                    <label for="name" class="block text-sm font-medium text-slate-700 mb-2">Nama Proyek</label>
                    <input
                        type="text"
                        name="name"
                        id="name"
                        value="<?php echo e(old('name', isset($project) ? $project->name : '')); ?>"
                        required
                        class="w-full px-4 py-3 border border-slate-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent"
                        placeholder="Masukkan nama proyek"
                    >
                    <?php $__errorArgs = ['name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><p class="text-red-500 text-sm mt-1"><?php echo e($message); ?></p><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>

                <div class="mb-6">
                    <label for="description" class="block text-sm font-medium text-slate-700 mb-2">Deskripsi Proyek</label>
                    <textarea
                        name="description"
                        id="description"
                        rows="5"
                        class="w-full px-4 py-3 border border-slate-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent"
                        placeholder="Masukkan deskripsi proyek"
                    ><?php echo e(old('description', isset($project) ? $project->description : '')); ?></textarea>
                    <?php $__errorArgs = ['description'];
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
                        <?php echo e(isset($project) ? 'Perbarui Proyek' : 'Buat Proyek'); ?>

                    </button>
                    <a
                        href="<?php echo e(route('projects.index')); ?>"
                        class="bg-slate-200 hover:bg-slate-300 text-slate-700 px-6 py-3 rounded-lg transition-colors font-medium"
                    >
                        Batal
                    </a>
                </div>
            </form>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\manajemen-tugas\resources\views/projects/form.blade.php ENDPATH**/ ?>