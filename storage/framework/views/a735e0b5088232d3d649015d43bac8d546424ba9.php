<?php $__env->startSection('content'); ?>
<main class="py-4">
    <div class="container">
    <h2 class="text-center">Products</h2>
    <?php if($message = Session::get('success')): ?>
        <div class="alert alert-success alert-block">
            <strong><?php echo e($message); ?></strong>
        </div>
    <?php endif; ?>
    <div class="row">
        <div class="col-lg-6 mb-4 col-md-6">
            <form class="row g-2" method="GET">
                <div class="col-auto">
                    <label for="search" class="visually-hidden">Search</label>
                    <input type="text" class="form-control" id="search" name="search" value="<?php echo e(request()->has('search') ? request()->get('search') : ''); ?>" placeholder="Search">
                </div>
                <div class="col-auto">
                    <button type="submit" class="btn btn-primary me-2">Search</button>
                    <a href="<?php echo e(route('product.add')); ?>" class="btn btn-outline-dark">Add Product</a>
                </div>
            </form>
        </div>
    </div>
    <?php if(request()->has('search')): ?>
     <h4 class="text-center">Search Result For: <?php echo e(request()->get('search')); ?></h4>
    <?php endif; ?>
    <div class="row">
        <?php $__empty_1 = true; $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
        <div class="col-lg-4 mb-4 col-md-6">
            <div class="card h-auto">
                <a href="<?php echo e(route('product.show', $product->id)); ?>">
                    <img class="card-img-top" src="<?php echo e(url("images/{$product->image}")); ?>" alt="<?php echo e($product->name); ?>" draggable="false">
                </a>
                <div class="card-body text-center">
                    <h5 class="card-title">
                        <a href="#" class="text-decoration-none"><?php echo e($product->name); ?></a>
                    </h5>
                    <h5><?php echo e($product->price); ?></h5>
                    <div class="mb-2">
                        <span class="text-warning"><?php echo e($product->category->name); ?></span>
                    </div>
                    <?php if(auth()->guard()->check()): ?>
                        <?php if(Auth::user()->role == 'admin'): ?>
                            <?php if($product->stock <= 0): ?>
                                <span class="text-danger">Product is Unavailable</span>
                            <?php endif; ?>
                            <button class="btn btn-outline-danger btn-delete mx-2" onclick="deleteProduct(this,<?php echo e($product->id); ?>)">Remove</button>
                            <a class="btn btn-outline-primary mx-2" href="<?php echo e(route('product.edit', $product->id)); ?>">Edit</a>
                        <?php else: ?>
                            <?php if($product->stock > 0): ?>
                                <button type="button" class="btn btn-outline-primary btn-cart" onclick="addToCart(<?php echo e($product->id); ?>,1)">Add To Cart</button>
                            <?php else: ?>
                                <span class="text-danger">Product is Unavailable</span>
                            <?php endif; ?>
                        <?php endif; ?>
                    <?php endif; ?>
                    <?php if(auth()->guard()->guest()): ?>
                        <?php if($product->stock > 0): ?>
                            <button class="btn btn-outline-primary" onclick="addToCart(<?php echo e($product->id); ?>,1)">Add To Cart</button>
                        <?php else: ?>
                            <span class="text-danger">Product is Unavailable</span>
                        <?php endif; ?>
                    <?php endif; ?>
                </div>
            </div>
        </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
            <h3 class="text-center">No Products Found!</h3>
        <?php endif; ?>
    </div>
    <?php echo e($products->links()); ?>

</div>
</main>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\Documents\Ken Univ\Sem5\Web Programming\Project\tokem-nadya\resources\views/product.blade.php ENDPATH**/ ?>