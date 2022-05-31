<?php $__env->startSection('content'); ?>
<div class="header-video">
<div class="overlay"></div>
<video playsinline="playsinline" autoplay="autoplay" muted="muted" loop="loop">
    <source src="<?php echo e(asset('images/video-header.mp4')); ?>" type="video/mp4">
</video>
<div class="container h-100">
    <div class="d-flex h-100 text-center align-items-center">
    <div class="w-100 text-white">
        <h1 class="display-1 text-uppercase">Level Up</h1>
        <p class="lead mb-0">Your Planting Game</p>
    </div>
    </div>
</div>
</div>
<main class="py-4">
<div class="container">
    <div class="row featurette">
        <div class="col-md-7">
            <h2 class="featurette-heading">Be a Plant Parent Now!</h2>
            <p class="lead">Plants are not just giving you fresh and healthy air,they Improve the ambiance, Spread the positivity,
                Connect you with the nature,
                can sense you,
                can understand you,
                make you responsible,
                never discriminate,
                are always loyal.</p>
        </div>
        <div class="col-md-5">
            <img class="bd-placeholder-img bd-placeholder-img-lg featurette-image img-fluid mx-auto" width="500" height="500" src="<?php echo e(asset('images/severin-candrian-7d7OR-RvufU-unsplash.jpg')); ?>">
        </div>
    </div>
    <hr class="featurette-divider">
    <div class="row featurette">
      <div class="col-md-7 order-md-2">
        <h2 class="featurette-heading">Professional Plant Care</h2>
        <p class="lead">Make you Home,
            Work place
            and garden more lively and full of positive energy with PLANTS.
            Best price in market guaranteed</p>
      </div>
      <div class="col-md-5 order-md-1">
            <img class="bd-placeholder-img bd-placeholder-img-lg featurette-image img-fluid mx-auto" width="500" height="500" src="<?php echo e(asset('images/annie-spratt-ncQ2sguVlgo-unsplash.jpg')); ?>">
      </div>
    </div>
</div>
</main>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\Documents\Ken Univ\Sem5\Web Programming\Project\tokem-nadya\resources\views/home.blade.php ENDPATH**/ ?>