<?php $__env->startSection('content'); ?>
<main class="py-4">
    <div class="container">
    <div class="row">
    <div class="col-6 mx-auto">
        <div class="card border-0 shadow rounded-3 my-4">
            <ul class="list-group list-group-horizontal-md">
            <?php $__empty_1 = true; $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <li class="list-group-item">
                    <?php echo e($category->name); ?>

                </li>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <h4>No Category</h4>
            <?php endif; ?>
            </ul>
        </div>
    </div>
    </div>
      <div class="col-sm-9 col-md-7 col-lg-5 mx-auto">
        <div class="card border-0 shadow rounded-3 my-4">
          <div class="card-body">
            <h5 class="card-title text-center mb-5 fw-light fs-5">Add new Category</h5>
            <?php if($message = Session::get('success')): ?>
                <div class="alert alert-success alert-block">
                    <strong><?php echo e($message); ?></strong>
                </div>
            <?php endif; ?>
            <form method="POST" action="<?php echo e(route('category.add')); ?>">
                <?php echo csrf_field(); ?>
                <div class="mb-3">
                    <label for="nameInput">Name</label>
                    <input type="text" class="form-control <?php $__errorArgs = ['name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" id="nameInput" name="name" value="<?php echo e(old('name')); ?>" required autofocus placeholder="Name">
                    <?php $__errorArgs = ['name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <span class="invalid-feedback" role="alert">
                            <strong><?php echo e($message); ?></strong>
                        </span>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>
                <div class="my-2 float-end">
                    <button class="btn btn-primary fw-bold" type="submit">Add</button>
                </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</main>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\Documents\Ken Univ\Sem5\Web Programming\Kelas\Gamer Market\resources\views/category.blade.php ENDPATH**/ ?>