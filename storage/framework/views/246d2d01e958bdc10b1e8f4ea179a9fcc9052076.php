<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <!-- CSRF Token -->
        <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
        <title><?php echo e(config('app.name', 'Laravel')); ?></title>
        <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
        <link href="<?php echo e(asset('css/app.css')); ?>" rel="stylesheet" />
        <link href="<?php echo e(asset('css/custom.css')); ?>" rel="stylesheet" />
        <script src="<?php echo e(asset('js/jquery.min.js')); ?>"></script>
        <script src="<?php echo e(asset('js/app.js')); ?>" defer></script>
    </head>
    <body>
        <!-- Navigation -->
        <nav class="navbar navbar-expand-lg navbar-light bg-light shadow-sm static-top ">
        <div class="container">
            <a class="navbar-brand d-flex w-50 mr-auto" href="<?php echo e(url('/')); ?>">
            <img src="<?php echo e(asset('images/tokem-logo3.png')); ?>" alt="Logo" height="50">
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse w-100" id="navbarSupportedContent">
            <ul class="navbar-nav w-100 justify-content-center">
                <li class="nav-item mx-2">
                    <a class="nav-link" href="<?php echo e(route('product')); ?>">Products</a>
                </li>
                <li class="nav-item mx-2">
                    <a class="nav-link" href="<?php echo e(route('about')); ?>">About Us</a>
                </li>
                <?php if(auth()->guard()->check()): ?>
                    <?php if(auth()->user()->role == 'admin'): ?>
                        <li class="nav-item">
                            <a class="nav-link" href="<?php echo e(route('product')); ?>">Manage Products</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="<?php echo e(route('category')); ?>">Add Category</a>
                        </li>
                    <?php else: ?>
                        <li class="nav-item">
                            <a class="nav-link" href="<?php echo e(route('transactions')); ?>">My Transactions</a>
                        </li>
                    <?php endif; ?>
                <?php endif; ?>
            </ul>
            <ul class="nav navbar-nav ms-auto w-100 justify-content-end">
                <?php if(auth()->guard()->guest()): ?>
                    <li class="nav-item mx-2">
                        <a class="nav-link" href="<?php echo e(route('login')); ?>">Sign In</a>
                    </li>
                    <li class="nav-item mx-2">
                        <a class="btn btn-primary" href="<?php echo e(route('register')); ?>">Sign Up</a>
                    </li>
                <?php endif; ?>
                <?php if(auth()->guard()->check()): ?>
                <?php if(Auth::user()->role == 'member'): ?>
                    <li class="nav-item">
                            <a class="nav-link" href="<?php echo e(route('cart')); ?>">Cart</a>
                    </li>
                <?php endif; ?>
                    <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <?php echo e(Auth::user()->name); ?>

                    </a>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                        <li><a class="dropdown-item" href="<?php echo e(route('profile')); ?>">Profile</a></li>
                        <li>
                        <hr class="dropdown-divider">
                        </li>
                        <li>
                            <a class="dropdown-item" href="<?php echo e(route('logout')); ?>" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a>
                            <form id="logout-form" action="<?php echo e(route('logout')); ?>" method="POST" class="d-none">
                            <?php echo csrf_field(); ?>
                            </form>
                        </li>
                    </ul>
                    </li>
                <?php endif; ?>

            </ul>
            </div>
        </div>
        </nav>
        <!-- Page content-->
        <?php echo $__env->yieldContent('content'); ?>
        <footer class="py-5 bg-light">
            <div class="container">
                <p class="m-0 text-center">Copyright © <?php echo e(config('app.name', 'Laravel')); ?> 2021</p>
            </div>
            <!-- /.container -->
        </footer>
        <script>
            $.ajaxSetup({headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}});
            $(function () {
                $('#form-atc').on('submit', function(e){
                    e.preventDefault();
                    var id = $("input[name='product_id']",this).val();
                    var qty = $("input[name='qty']",this).val();
                    addToCart(id,qty);
                });
            });
            function addToCart(id, qty=1){
                $.ajax({
                    async: true,
                    url: '<?php echo e(route('cart.add')); ?>',
                    method: 'POST',
                    data: {product_id: id, qty:qty},
                    beforeSend: function (xhr) {
                        $(this).prop('disabled', true);
                    },
                    success: function(data){
                        alert(data.message);
                        $(this).prop('disabled', false);
                    }
                }).fail(function (xhr,response) {
                    if(xhr.status === 401){
                        alert("Please Sign to add to cart!");
                        window.location.replace("<?php echo e(route('login')); ?>");
                        return;
                    }
                    var data = JSON.parse(xhr.responseText);
                    alert(data.message);
                    $(this).prop('disabled', false);
                });
            }

            function deleteProduct(self, id){
                if (confirm("Delete Product?") == false) {
                    return false;
                }
                $.ajax({
                    async: true,
                    url: "<?php echo e(route('product.destroy')); ?>",
                    method: 'POST',
                    data: {id: id},
                    beforeSend: function (xhr) {
                        $(self).prop('disabled', true);
                    },
                    success: function(data){
                        alert(data.message);
                        location.reload();
                    }
                }).fail(function (xhr,response) {
                    if(xhr.status === 401){
                        alert("Please Sign!");
                        window.location.replace("<?php echo e(route('login')); ?>");
                        return;
                    }
                    var data = JSON.parse(xhr.responseText);
                    alert(data.message);
                    $(self).prop('disabled', false);
                });
            }
            function updateCart(self, id){
                if(self.value <= 0){
                    if (confirm("Delete Product from cart?") == false) {
                        return false;
                    }
                }
                $.ajax({
                    async: true,
                    url: "<?php echo e(route('cart.update')); ?>",
                    method: 'POST',
                    data: {id: id, qty:self.value},
                    beforeSend: function (xhr) {
                        $(self).prop('disabled', true);
                    },
                    success: function(data){
                        // alert(data.message);
                        $(self).prop('disabled', false);
                    }
                }).fail(function (xhr,response) {
                    if(xhr.status === 401){
                        alert("Please Sign to add to cart!");
                        window.location.replace("<?php echo e(route('login')); ?>");
                        return;
                    }
                    var data = JSON.parse(xhr.responseText);
                    alert(data.message);
                    $(self).prop('disabled', false);
                });
            }
    </script>
    </body>
</html>
<?php /**PATH D:\Documents\Ken Univ\Sem5\Web Programming\Project\tokem-nadya\resources\views/layouts/app.blade.php ENDPATH**/ ?>