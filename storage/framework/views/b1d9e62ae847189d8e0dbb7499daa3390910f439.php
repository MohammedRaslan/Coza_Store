<?php if(Auth::user()->user_type == 0 || Auth::user()->user_type==2): ?>

<!doctype html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang=""> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8" lang=""> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9" lang=""> <![endif]-->
<!--[if gt IE 8]><!-->
<html class="no-js" lang="en">
<!--<![endif]-->

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Admin Portal</title>
    <meta name="description" content="Sufee Admin - HTML5 Admin Template">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="apple-touch-icon" href="apple-icon.png">
    <link rel="shortcut icon" href="favicon.ico">

    <link rel="stylesheet" href="<?php echo e(asset('AdminEnd')); ?>/vendors/bootstrap/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?php echo e(asset('AdminEnd')); ?>/vendors/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="<?php echo e(asset('AdminEnd')); ?>/vendors/themify-icons/css/themify-icons.css">
    <link rel="stylesheet" href="<?php echo e(asset('AdminEnd')); ?>/vendors/flag-icon-css/css/flag-icon.min.css">
    <link rel="stylesheet" href="<?php echo e(asset('AdminEnd')); ?>/vendors/selectFX/css/cs-skin-elastic.css">
    <link rel="stylesheet" href="<?php echo e(asset('AdminEnd')); ?>/vendors/jqvmap/dist/jqvmap.min.css">


    <link rel="stylesheet" href="<?php echo e(asset('AdminEnd')); ?>/assets/css/style.css">

    <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,600,700,800' rel='stylesheet' type='text/css'>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="<?php echo e(asset('js')); ?>/hartala.js"></script>

    
</head>

<body>


    <!-- Left Panel -->

    <aside id="left-panel" class="left-panel">
        <nav class="navbar navbar-expand-sm navbar-default">

            <div class="navbar-header">
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#main-menu" aria-controls="main-menu" aria-expanded="false" aria-label="Toggle navigation">
                    <i class="fa fa-bars"></i>
                </button>
                <a class="navbar-brand" href="admin"><img src="<?php echo e(asset('AdminEnd')); ?>/images/logo.png" alt="Logo"></a>
                <a class="navbar-brand hidden" href=admin><img src="<?php echo e(asset('AdminEnd')); ?>/images/logo2.png" alt="Logo"></a>
            </div>

            <div id="main-menu" class="main-menu collapse navbar-collapse">
                <ul class="nav navbar-nav">
                    <li class="active">
                       
                        <a href="<?php echo e(route('admin')); ?>"> <i class="menu-icon fa fa-dashboard"></i>Dashboard </a>
                    
                    </li>
                    <?php if(Auth::User()->user_type == 0): ?>
                    <h3 class="menu-title">Users Section</h3><!-- /.menu-title -->  
                    <li class="">     
                        <a href="<?php echo e(route('userlist')); ?>" class=""    ><i class="menu-icon fa fa-users"></i> List Users</a>
                     </li>

                    <h3 class="menu-title">Employees Section</h3><!-- /.menu-title -->

                    <li class="">   
                            <a href="<?php echo e(route('employeeList')); ?>"> <i class="menu-icon menu-icon fa fa-users"></i>Manage Employees</a>
                    </li>
                    <?php endif; ?>
                    <h3 class="menu-title">Product Section</h3><!-- /.menu-title -->

                    <li class="">
                    <a href="<?php echo e(route('productlist')); ?>" > <i class="menu-icon fa fa-table"></i>Manage Prouducts</a>
          
                        </li>
                     
                   

                   
                </ul>
            </div><!-- /.navbar-collapse -->
        </nav>
    </aside><!-- /#left-panel -->

    <!-- Left Panel -->

    <!-- Right Panel -->

    <div id="right-panel" class="right-panel" >

        <!-- Header-->
        <header id="header" class="header">

            <div class="header-menu">

                <div class="col-sm-7">
                    <a id="menuToggle" class="menutoggle pull-left"><i class="fa fa fa-tasks"></i></a>
                    <div class="header-left">
                   

                        <div class="dropdown for-notification">
                            <button class="btn btn-secondary dropdown-toggle" type="button" id="notification" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fa fa-bell"></i>
                                <?php if($count > 0): ?>
                                    <span class="count bg-danger bell"><?php echo e($count); ?></span>
                                <?php endif; ?>  
                            </button>
                            <div class="dropdown-menu" aria-labelledby="notification" style="width:400px">
                                <p class="red">You have <?php echo e($count); ?> Notification</p>
                                <?php $__currentLoopData = $notification->take(4); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <a class="dropdown-item media bg-flat-color-1" style="border-radius:25px;display:block">
                                    <i class="fa fa-info"></i>
                                <p style="color:black" class="row"><?php echo e($item->email); ?></p>
                               
                                <i class="fa fa-check"></i>
                                <p style="color:black" class="row"><?php echo e($item->message); ?></p>
                                </a>
                                <hr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                             
                          
                            </div>
                        </div>

                        
                    </div>
                </div>

                <div class="col-sm-5">
                    <div class="user-area dropdown float-right">
                        
                        <a class="nav-link" href=""
                        	onclick="event.preventDefault();
                        document.getElementById('logout-form').submit();"><i class="fa fa-power-off"></i> Logout</a>
                        <form id="logout-form" action="<?php echo e(route('logout')); ?>" method="POST" style="display: none;">
                                <?php echo e(csrf_field()); ?>

                            </form>
                      
                    </div>

                    <div id="language-select">
                    <a class="dropdown-toggle active" href="<?php echo e(route('index')); ?>" >
                           Website
                        </a>
                      
                    </div>

                </div>
            </div>

        </header><!-- /header -->

        <!-- Header-->
      
        <?php else: ?>
        <?php echo $__env->make('notfound', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
        <?php endif; ?>
        <?php echo $__env->yieldContent('header'); ?>
