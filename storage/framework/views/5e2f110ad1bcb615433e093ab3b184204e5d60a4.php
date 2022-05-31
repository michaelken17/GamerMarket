<?php $__env->startSection('content'); ?>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-9">
            <?php if($message = Session::get('success')): ?>
            <div class="alert alert-success alert-block">
                <strong><?php echo e($message); ?></strong>
            </div>
            <?php endif; ?>
            <?php if($message = Session::get('error')): ?>
            <div class="alert alert-danger alert-block">
                <strong><?php echo e($message); ?></strong>
            </div>
            <?php endif; ?>
            <div class="card mt-4">
                <div class="text-center">
                    <img class="img-responsive center-block card-img-top img-fluid w-50 mt-4" draggable="false"
                        src="<?php echo e(url("images/{$product->image}")); ?>" alt="<?php echo e($product->name); ?>">
                </div>
                <div class="card-body">
                    <h3 class="card-title"><?php echo e($product->name); ?></h3>
                    <h4 class="font-weight-bold">Rp.<?php echo e($product->price); ?></h4>
                    <div class="mt-3">
                        <p class="card-text"><?php echo nl2br($product->description); ?></p>
                    </div>
                    <div class="mt-3">
                        <p>Stock: <?php echo e($product->stock); ?></p>
                        <p>Category: <span class="badge bg-primary"><?php echo e($product->category->name); ?></span></p>
                    </div>
                    <?php if(Auth::check() && Auth::user()->role == 'admin'): ?>
                    <?php else: ?>
                    <div class="my-3">
                        <form class="row" id="form-atc">
                            <?php echo csrf_field(); ?>
                            <input type="hidden" name="product_id" value="<?php echo e($product->id); ?>">
                            <div class="row">
                                <div class="col-auto">
                                    <label class="visually-hidden" for="quantity">Quantity</label>
                                    <input type="number" min="1" value="1" class="form-control" id="quantity"
                                        name="qty" placeholder="Quantity" required>
                                </div>
                                <div class="col-auto">
                                    <button type="submit" class="btn btn-outline-primary">Add To Cart</button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\Documents\Ken Univ\Sem5\Web Programming\Kelas\Gamer Market\resources\views/product-detail.blade.php ENDPATH**/ ?>