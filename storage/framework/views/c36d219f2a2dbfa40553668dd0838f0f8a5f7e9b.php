<?php if(Auth::guest() || Auth::user()->user_type == 1): ?>
<?php echo $__env->make('notfound', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php else: ?>


<?php $__env->startSection('header'); ?>

<div class="container" style="">
    <div class="jumbotron">
        <h1 style="text-align:center; color:cornflowerblue"><b>Edit Employee <?php echo e($employee->name); ?> </b></h1>
        <hr style="width:50%">
    <form action="<?php echo e(route('employees.update',[$employee->id])); ?>" method="POST" enctype="multipart/form-data">
        <?php echo e(csrf_field()); ?>

        <!-- Laravel used method put/patch in update function, so it'll ignore post method above -->
        <input type="hidden" name="_method" value="put">
        <div class="form-group">
                <label>Name</label>
        <input type="text" class="form-control" value="<?php echo e($employee->name); ?>" name="name" placeholder="Enter New Name"  required> 
        </div>
        <div class="form-group">
                <label>Email</label>
        <input type="text" class="form-control" name="email" value="<?php echo e($employee->email); ?>" placeholder="Enter New Email" required> 
        </div>
        <label >User Type</label>
        <select class="form-control" name="user_type" >
            <?php if($employee->user_type == 1): ?>
                <option value="<?php echo e($employee->user_type); ?>">(User)</option>
                <option value="0">(Admin)</option>
                <option value="2">(Employee)</option>
            <?php elseif($employee->user_type == 0): ?>
                <option value="<?php echo e($employee->user_type); ?>">(Admin)</option>
                <option value="1">(User)</option>
                <option value="2">(Employee)</option>
            <?php else: ?>
            <option value="<?php echo e($employee->user_type); ?>">(Employee)</option>
                <option value="0">(Admin)</option>
                <option value="1">(User)</option>
        <?php endif; ?>
        </select>
        <br>
        <button name="submit" type="submit" class="btn btn-primary btn-lg"  >Edit Employee</button>
        <button class="btn btn-danger btn-lg"  ><a href="<?php echo e(route('employeeList')); ?>" style="color:white;">Cancel</a></button>
    </form>
    </div>
</div>


<script src="<?php echo e(asset('AdminEnd')); ?>/vendors/jquery/dist/jquery.min.js"></script>
<script src="<?php echo e(asset('AdminEnd')); ?>/vendors/popper.js/dist/umd/popper.min.js"></script>
<script src="<?php echo e(asset('AdminEnd')); ?>/vendors/bootstrap/dist/js/bootstrap.min.js"></script>
<script src="<?php echo e(asset('AdminEnd')); ?>/assets/js/main.js"></script>



<script src="<?php echo e(asset('AdminEnd')); ?>/assets/js/dashboard.js"></script>
<script src="<?php echo e(asset('AdminEnd')); ?>/assets/js/widgets.js"></script>



</body>

</html>
<?php $__env->stopSection(); ?>
<?php endif; ?>
<?php echo $__env->make('Admin_Portal.inc.header', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>