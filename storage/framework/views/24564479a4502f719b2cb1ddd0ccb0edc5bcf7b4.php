<?php $__env->startSection('content'); ?>
<div class="container mt-4">
    <div class="text-center">
        <h5>Transaction</h5>
    </div>
    <div class="row justify-content-center">
        <div class="col-lg-9 bg-white p-2">
            <?php if($message = Session::get('success')): ?>
            <div class="alert alert-success alert-block">
                <strong><?php echo e($message); ?></strong>
            </div>
            <?php endif; ?>
            <?php $__empty_1 = true; $__currentLoopData = $transactions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $transaction): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
            <h5>Transaction Date: <?php echo e($transaction->created_at); ?></h5>
            <table class="table">
                <tr>
                    <th>Product</th>
                    <th>Price</th>
                    <th>Qty</th>
                    <th>Subtotal</th>
                </tr>
                <?php $__currentLoopData = $transaction->transactionDetails; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $detail): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr>
                    <td width="30%"><img class="img-responsive w-25 me-2" src="<?php echo e(asset("images/{$detail->product->image}")); ?>" alt="<?php echo e($detail->product->name); ?>"> <?php echo e($detail->product->name); ?></td>
                    <td width="25%"><div class="fw-bold"><?php echo e($detail->product->price); ?></div></td>
                    <td width="20%">
                    <div class="row">
                        <div class="col-6 mr-0">
                            <input type="number" min="0" value="<?php echo e($detail->qty); ?>" class="form-control" disabled>
                        </div>
                    </div>
                    </td>
                    <td width="20%"><?php echo e($detail->subtotal); ?></td>
                </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </table>
            <div class="p-4">
                <ul class="list-unstyled mb-4">
                    <li class="d-flex justify-content-between py-3 border-bottom">
                        <span class="fw-bolder text-muted">Total</span>
                        <h5 class="font-weight-bold"><?php echo e($transaction->total_price); ?></h5>
                    </li>
                </ul>
            </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
            <h3>Transaction Empty!</h3>
            <?php endif; ?>

        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\Documents\Ken Univ\Sem5\Web Programming\Kelas\Gamer Market\resources\views/transaction.blade.php ENDPATH**/ ?>