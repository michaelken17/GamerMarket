<?php $__env->startSection('content'); ?>
<div class="container h-100">

    <div class="d-flex h-100 text-center align-items-center">
        <div class="w-100 text-black">
            <h1 class="display-1 text-uppercase">Gamer Market</h1>
            <h3 class="display-7 text-uppercase" style="color:#f14b2c" >Where Gamers Shop.</h3>
        </div>
        
    </div>
    
</div>

</div>
<main class="py-4">
<div class="container">
    <div class="row featurette">
        <div class="col-md-7">
            <h2 class="featurette-heading" style="color:#f14b2c">Why YOU should use Gamer Market!</h2>
            <br>
            <p class="lead">Gamer Market brings you the solution to all your gaming needs. 
                We provide a secondhand marketplace for gaming gears. We offer products such as 
                KEYBOARD, MOUSE, HEADSET, MOUSE PADS, PC PARTS, and more!
                We have an assortment that suits everyone.</p>
        </div>
        <div class="col-md-5">
            <img class="bd-placeholder-img bd-placeholder-img-lg featurette-image img-fluid mx-auto" width="500" height="500" src="<?php echo e(asset('images/gaming-setup2.jpg')); ?>">
        </div>
    </div>
    <hr class="featurette-divider">
    <div class="row featurette">
      <div class="col-md-7 order-md-2">
        <h2 class="featurette-heading" style="color:#f14b2c">Get the CHEAPEST price here!</h2>
        <br>
        <p class="lead">Gamer Market guarantees you the cheapest and most affordable prices from around the market!</p>
      </div>
      <div class="col-md-5 order-md-1">
            <img class="bd-placeholder-img bd-placeholder-img-lg featurette-image img-fluid mx-auto" width="500" height="500" src="<?php echo e(asset('images/gaming-setup5.png')); ?>">
      </div>
    </div>
</div>
</main>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\Documents\Ken Univ\Sem5\Web Programming\Kelas\Gamer Market\resources\views/home.blade.php ENDPATH**/ ?>