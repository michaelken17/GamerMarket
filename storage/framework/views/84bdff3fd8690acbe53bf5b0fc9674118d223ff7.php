<?php $__env->startSection('content'); ?>
<div class="container mt-4">
    <div class="text-center">
        <h5>Please Confirm Your Order</h5>
    </div>
    <div class="row justify-content-center">
        <div class="col-lg-9 bg-white p-2">
            <?php if($message = Session::get('success')): ?>
            <div class="alert alert-success alert-block">
                <strong><?php echo e($message); ?></strong>
            </div>
            <?php endif; ?>
                <?php if(!count($carts)): ?>
                <h5>Cart Empty!</h5>
                <?php endif; ?>
                <table class="table">
                    <tr>
                        <th>Product</th>
                        <th>Price</th>
                        <th>Qty</th>
                        <th>Subtotal</th>
                    </tr>
                    <?php $__currentLoopData = $carts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cart): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                        <td width="30%"><img class="img-responsive w-25 me-2" src="<?php echo e(asset("images/{$cart->product->image}")); ?>" alt="<?php echo e($cart->product->name); ?>"> <?php echo e($cart->product->name); ?></td>
                        <td width="25%"><div class="fw-bold"><?php echo e($cart->product->price); ?></div></td>
                        <td width="20%">
                        <div class="row">
                            <div class="col-6 mr-0">
                                <input type="number" min="0" value="<?php echo e($cart->qty); ?>" onchange="updateCart(this,<?php echo e($cart->id); ?>)" class="form-control"
                                    id="quantity" name="quantity" placeholder="qty" disabled>
                            </div>
                        </div>
                        </td>
                        <td width="20%"><?php echo e($cart->qty * $cart->product->price); ?></td>
                    </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </table>
                <div class="p-4">
                    <ul class="list-unstyled mb-4">
                        <li class="d-flex justify-content-between py-3 border-bottom">
                            <span class="fw-bolder text-muted">Total</span>
                            <h5 class="font-weight-bold"><?php echo e($grand_total); ?></h5>
                        </li>
                    </ul>
                    <p>
                        Ship To: <?php echo e(Auth::user()->address); ?>

                    </p>
                    <div class="float-end">
                        <form method="POST" action="<?php echo e(route('cart.doCheckout')); ?>">
                            <?php echo csrf_field(); ?>
                            <div class="mb-3">
                                <label for="passcode">Please Confirm Passcode: <?php echo session()->get('passcode'); ?></label>
                                <input type="text" class="form-control <?php $__errorArgs = ['passcode'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" id="passcode" name="passcode" value="<?php echo e(old('passcode')); ?>" required placeholder="Passcode">
                                <?php $__errorArgs = ['passcode'];
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
                            <button id="checkout-btn" type="submit" class="btn btn-outline-dark rounded-pill float-end py-2 <?php echo e((!count($carts) ? 'disabled' : '')); ?>">
                                Checkout
                            </button>
                        </form>
                    </div>
                </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\Documents\Ken Univ\Sem5\Web Programming\Kelas\Gamer Market\resources\views/checkout.blade.php ENDPATH**/ ?>