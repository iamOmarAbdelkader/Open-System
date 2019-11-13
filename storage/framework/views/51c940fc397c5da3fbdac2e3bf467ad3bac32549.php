<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">

  <title><?php echo e(config('app.name')); ?></title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <?php echo $__env->make('partials.styles', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    <?php echo $__env->yieldPushContent('styles'); ?>
    <style>
    .overlay-loader {
    background: #fff;
    display: block;
    margin: auto;
    width: 90px;
    height: 100%;
    z-index: 99999;
    width: 100%;
    position: fixed;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
}
    .loader {
      position: absolute;
      top: 0;
      left: 0;
      right: 0;
      bottom: 0;
      margin: auto;
      width: 90px;
      height: 90px;
      animation-name: rotateAnim;
        -o-animation-name: rotateAnim;
        -ms-animation-name: rotateAnim;
        -webkit-animation-name: rotateAnim;
        -moz-animation-name: rotateAnim;
      animation-duration: 0.3175s;
        -o-animation-duration: 0.3175s;
        -ms-animation-duration: 0.3175s;
        -webkit-animation-duration: 0.3175s;
        -moz-animation-duration: 0.3175s;
      animation-iteration-count: infinite;
        -o-animation-iteration-count: infinite;
        -ms-animation-iteration-count: infinite;
        -webkit-animation-iteration-count: infinite;
        -moz-animation-iteration-count: infinite;
      animation-timing-function: linear;
        -o-animation-timing-function: linear;
        -ms-animation-timing-function: linear;
        -webkit-animation-timing-function: linear;
        -moz-animation-timing-function: linear;
    }
    .loader div {
      width: 7px;
      height: 7px;
      border-radius: 50%;
      border: 1px solid #3c8dbc;
      position: absolute;
      top: 2px;
      left: 0;
      right: 0;
      bottom: 0;
      margin: auto;
    }
    .loader div:nth-child(odd) {
      border-top: none;
      border-left: none;
    }
    .loader div:nth-child(even) {
      border-bottom: none;
      border-right: none;
    }
    .loader div:nth-child(2) {
      border-width: 2px;
      left: 0px;
      top: -4px;
      width: 11px;
      height: 11px;
    }
    .loader div:nth-child(3) {
      border-width: 2px;
      left: -1px;
      top: 3px;
      width: 16px;
      height: 16px;
    }
    .loader div:nth-child(4) {
      border-width: 3px;
      left: -1px;
      top: -4px;
      width: 22px;
      height: 22px;
    }
    .loader div:nth-child(5) {
      border-width: 3px;
      left: -1px;
      top: 4px;
      width: 29px;
      height: 29px;
    }
    .loader div:nth-child(6) {
      border-width: 4px;
      left: 0px;
      top: -4px;
      width: 36px;
      height: 36px;
    }
    .loader div:nth-child(7) {
      border-width: 4px;
      left: 0px;
      top: 5px;
      width: 45px;
      height: 45px;
    }


    @keyframes  rotateAnim {
      from {
        transform: rotate(360deg);
      }
      to {
        transform: rotate(0deg);
      }
    }

    @-o-keyframes rotateAnim {
      from {
        -o-transform: rotate(360deg);
      }
      to {
        -o-transform: rotate(0deg);
      }
    }

    @-ms-keyframes rotateAnim {
      from {
        -ms-transform: rotate(360deg);
      }
      to {
        -ms-transform: rotate(0deg);
      }
    }

    @-webkit-keyframes rotateAnim {
      from {
        -webkit-transform: rotate(360deg);
      }
      to {
        -webkit-transform: rotate(0deg);
      }
    }

    @-moz-keyframes rotateAnim {
      from {
        -moz-transform: rotate(360deg);
      }
      to {
        -moz-transform: rotate(0deg);
      }
    }
    </style>
</head>
<!-- ADD THE CLASS fixed TO GET A FIXED HEADER AND SIDEBAR LAYOUT -->
<!-- the fixed layout is not compatible with sidebar-mini -->
<body id="body" class="hold-transition skin-blue fixed  sidebar-mini sidebar-mini-expand-feature ">

 
<div class="overlay-loader">
	<div class="loader">
		<div></div>
		<div></div>
		<div></div>
		<div></div>
		<div></div>
		<div></div>
		<div></div>
	</div>
</div>



  <!-- Site wrapper -->
<span class="wrapper">

  <header class="main-header">
    <!-- Logo -->
    <a href="<?php echo e(route('home')); ?>" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
    <span class="logo-mini"><?php echo e(config('app.name')); ?></span>
      <!-- logo for regular state and mobile devices -->
    <span class="logo-lg"><b><?php echo e(config('app.min-name')); ?></b></span>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </a>

      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
         
          <!-- User Account: style can be found in dropdown.less -->
          <li class="dropdown user user-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <img src="<?php echo e(asset('images/avatar.png')); ?>" class="user-image" alt="User Image">
              <span class="hidden-xs"><?php echo e(auth()->user()->name); ?></span>
            </a>
            <ul class="dropdown-menu">
              <!-- User image -->
              <li class="user-header">
                <img src="<?php echo e(asset('images/avatar.png')); ?>" class="img-circle" alt="User Image">

                <p>
                  <?php echo e(auth()->user()->name); ?> - <?php echo e(auth()->user()->roles()->first()->name); ?>

                  
                </p>
              </li>
              <!-- Menu Body -->
             
              <!-- Menu Footer-->
              <li class="user-footer">
                
                <div class="pull-right">
                    <form action="<?php echo e(route('logout')); ?>" method="post">
                            <?php echo e(csrf_field()); ?>

                    <button type="submit"class="btn btn-default btn-flat">تسجيل الخروج
                    </button>
                    </form>

                </div>
              </li>
            </ul>
          </li>
        </ul>
      </div>
    </nav>
  </header>

  <!-- =============================================== -->

  <!-- Left side column. contains the sidebar -->
  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="pull-right image">
          <img src="<?php echo e(asset('images/avatar.png')); ?>" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p><?php echo e(auth()->user()->name); ?></p>
          <a href="#"><i class="fa fa-circle text-success"></i>  <?php echo e(auth()->user()->roles()->first()->name); ?></a>
        </div>
      </div>

      <!-- sidebar menu: : style can be found in sidebar.less -->
    <?php echo $__env->make('partials.side-bar', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    </section>
    <!-- /.sidebar -->
  </aside>

  <!-- =============================================== -->

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        <?php echo $__env->yieldContent('title'); ?>
        <small><?php echo $__env->yieldContent('sub-title'); ?></small>
      </h1>

    </section>

    <!-- Main content -->
    <section class="content">
        <?php echo $__env->make('flash::message', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
        <?php echo $__env->yieldContent('content'); ?>
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <footer class="main-footer">
      <span>
        <img class="img-circle sphinxat" src="<?php echo e(asset('images/boxed-bg.png')); ?>">
      </span>
      <span>
          جميع الحقوق محفوظة لشركة <strong>البومبو</strong> للتكنولوجيا المتقدمة 
      </span>
    </footer>

  <!-- Control Sidebar -->
  
  <div class="control-sidebar-bg"></div>
</div>
<?php echo $__env->make('partials.scripts', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

<?php echo $__env->yieldPushContent('scripts'); ?>
<script>
  $(document).ready(function(){
    $.ajaxSetup({
      headers: {
          'X-CSRF-TOKEN': '<?php echo e(csrf_token()); ?>' 
      }
    });
   
     $('.loader').fadeOut(1000,function(){
          $('.overlay-loader').fadeOut(function(){
            $(this).remove();
          })
        });
   
   
  
  })
</script>
</body>
</html>
