<?php $__env->startSection('header'); ?>
    

<div class="breadcrumbs">
    <div class="col-sm-4">
        <div class="page-header float-left">
            <div class="page-title">
                <h1>Dashboard</h1>
            </div>
        </div>
    </div>
    <div class="col-sm-8">
        <div class="page-header float-right">
            <div class="page-title">
                <ol class="breadcrumb text-right">
                    <li class="active">Dashboard</li>
                </ol>
            </div>
        </div>
    </div>
</div>
<div class="alert alert-danger" role="alert" style="width:50%; position:relative; left:25%; text-align:center;">
        Hey Admin..Wish You Great ^_^
        This is the dashboard which control every thing in website..
        Here You can do alot of things.. You can give admin privilage 
        to employees you want. Be careful..And this is your card preview your account to local employees.   
      </div>
<div class="content mt-3 row" >

   

        
    <div class="col-xl-3 col-lg-8" >
        <div class="card" style="width:120%">
            <div class="card-body">
                <div class="stat-widget-one">
                    <div class="stat-icon dib"><i class="ti-user text-primary border-primary"></i></div>
                    <div class="stat-content dib">
                        <div class="stat-text">Total Customers</div>
                    <div class="stat-digit"><?php echo e($users); ?></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    <div class="col-xl-3 col-lg-8" >
        <div class="card" style="width:120%">
            <div class="card-body">
                <div class="stat-widget-one">
                    <div class="stat-icon dib"><i class="ti-user text-muted"></i></div>
                    <div class="stat-content dib">
                        <div class="stat-text">Total Employees</div>
                        <div class="stat-digit"><?php echo e($employees); ?></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    <div class="col-xl-3 col-lg-6">
        <div class="card" style="width:120%">
            <div class="card-body">
                <div class="stat-widget-one">
                    <div class="stat-icon dib"><i class="ti-layout-grid2 text-warning border-warning"></i></div>
                    <div class="stat-content dib">
                        <div class="stat-text">Products Number</div>
                        <div class="stat-digit"><?php echo e($products); ?></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    <div class="col-xl-3 col-lg-8" >
        <div class="card" style="width:120%">
            <div class="card-body">
                <div class="stat-widget-one">
                    <div class="stat-icon dib"> <i class="fa fa-cart-plus"></i></div>
                    <div class="stat-content dib">
                        <div class="stat-text">Products Sold</div>
                        <div class="stat-digit"><?php echo e($sold); ?></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
               
     
    <!--/.col-->

    
    <!--/.col-->

    
    <!--/.col-->


    <!--/.col-->

    <!--/.col-->


   
    <!--/.col-->



    <!--/.col-->


  
    <!--/.col-->

    

    

    

    

  


</div> <!-- .content -->


<!-- Right Panel -->

<script src="<?php echo e(asset('AdminEnd')); ?>/vendors/jquery/dist/jquery.min.js"></script>
<script src="<?php echo e(asset('AdminEnd')); ?>/vendors/popper.js/dist/umd/popper.min.js"></script>
<script src="<?php echo e(asset('AdminEnd')); ?>/vendors/bootstrap/dist/js/bootstrap.min.js"></script>
<script src="<?php echo e(asset('AdminEnd')); ?>/assets/js/main.js"></script>



<script src="<?php echo e(asset('AdminEnd')); ?>/assets/js/dashboard.js"></script>
<script src="<?php echo e(asset('AdminEnd')); ?>/assets/js/widgets.js"></script>



</body>

</html>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('Admin_Portal.inc.header', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>