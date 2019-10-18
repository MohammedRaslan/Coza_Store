<?php if(Auth::guest() || Auth::user()->user_type == 1): ?>
<?php echo $__env->make('notfound', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php else: ?>


<?php $__env->startSection('header'); ?>

<div class="container" style="">
    <div class="jumbotron">
        <h1 style="text-align:center; color:cornflowerblue">Edit products <b><?php echo e($products->name); ?> </b></h1>
        <hr style="width:50%">
    <form action="<?php echo e(route('products.update',[$products->id])); ?>" class="editform" method="POST" enctype="multipart/form-data">
        <?php echo e(csrf_field()); ?>

        <!-- Laravel used method put/patch in update function, so it'll ignore post method above -->
        <input type="hidden" name="_method" value="put">
        <div class="form-inline row justify-content-md-center">
                <label ><b>Category </b></label>&nbsp;
                <select class="form-control" name="categ" style="width:18%" >
                    <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $categ): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php if($categ->id == $products->categ): ?>
                <option value="<?php echo e($products->categ); ?>"><?php echo e($categ->categ_name); ?></option>
                    <?php endif; ?>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                
                   <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $categ): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                   <?php if($categ->id != $products->categ): ?>
                   <option value="<?php echo e($categ->id); ?>" ><?php echo e($categ->categ_name); ?></option>
                   <?php endif; ?>
                
                   <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>&nbsp;&nbsp;
                <label><b> Name </b></label>
                &nbsp;
                <input type="text" class="form-control" value="<?php echo e($products->name); ?>" name="name" placeholder="Enter New Name"  required> 
                &nbsp;
                <label> <b>Price</b> </label>
                &nbsp;
                <input type="text" class="form-control" name="price" value="<?php echo e($products->price); ?>" placeholder="Enter New Email" required> 
                &nbsp;
            </div>
            <br><hr><br>
            
            <div  class="form-inline row justify-content-md-center">
                <label> <b>Model</b> </label>
                &nbsp;
                <input type="text" class="form-control" name="model" value="<?php echo e($products->model); ?>" placeholder="Enter New Email" required> 
                &nbsp;
 
                <label> <b>Brand</b> </label>
                &nbsp;
                <input type="text" class="form-control" name="brand" value="<?php echo e($products->brand); ?>" placeholder="Enter New Email" required> 
                &nbsp;

                <label> <b>Color</b> </label>
                &nbsp;
                <input type="text" class="form-control" name="color" value="<?php echo e($products->color); ?>" placeholder="Enter New Email" required> 
                &nbsp;
            </div>
            <br><hr><br>
            
            <div class="form-inline row justify-content-md-center">
                <label> <b>Dimensions</b> </label>
                &nbsp;
                <input type="text" class="form-control" name="dimensions" value="<?php echo e($products->dimensions); ?>" placeholder="Enter New Email" required> 
                &nbsp;
      
                <label> <b>Display Size</b> </label>
                &nbsp;
                <input type="text" class="form-control" name="display_size" value="<?php echo e($products->display_size); ?>" placeholder="Enter New Email" required> 
                &nbsp;
      
                <label> <b>Released on</b> </label>
                &nbsp;
                <input type="text" class="form-control" name="released" value="<?php echo e($products->released); ?>" placeholder="Enter New Email" required> 
           
                &nbsp;
            </div>
            <br><hr><br>
            
            <div  class="form-inline row justify-content-md-left"  >
            <label> <b>Quantity</b> </label>
            &nbsp;
            <input type="text" class="form-control" name="quantity" value="<?php echo e($products->quantity); ?>" placeholder="Enter New Email" required> 
            &nbsp;
            </div>
            <br><hr><br>
            
            <div class="form-inline row justify-content-md-center" >
                   
                    <label> <b>Image</b> </label>
                    &nbsp;
                    <img type="text" class="form-control" id="img" name="" src="<?php echo e(asset('uploads')); ?>/<?php echo e($products->img); ?>" style="width:20%; height:20%;"> 
                    <input type="hidden" name="img" value="<?php echo e($products->img); ?>"> 
                    &nbsp;
          
                    <div class="btn btn-primary">
                            <a  style="text-decoration: none; color:floralwhite;" class="changeProfile">
                                <i class="glyphicon glyphicon-edit "></i> Choose Photo
                            </a>
                            <input type="file" id="file" style="display: none"/>
                            <input type="hidden" id="file_name"/>
                            </div>
                            <i id="loading" class="fa fa-spinner fa-spin fa-3x fa-fw" style="position: absolute;left: 40%;top:45%; display:none;"></i>
               
    </div>
        
        
        <br>
        <button name="submit" type="submit" class="btn btn-primary btn-lg"  >Edit products</button>
        <button class="btn btn-danger btn-lg"  ><a href="<?php echo e(route('productlist')); ?>" style="color:white;">Cancel</a></button>
    </form>
    </div>
</div>
<script>
$("body").on('click','.changeProfile',function() {
         $('#file').click();
         });


        $('#file').change(function () {
            if ($(this).val() != '') {
                upload(this);
            }
        });

        function upload(img) {
            var form_data = new FormData();
            form_data.append('file', img.files[0]);
            form_data.append('_token', '<?php echo e(csrf_token()); ?>');
            $('#loading').css('display', 'block');
            $.ajax({
                url: "<?php echo e(url('ajax-image-upload')); ?>",
                data: form_data,
                type: 'POST',
                contentType: false,
                processData: false,
                success: function (data) {
                    if (data.fail) {
                        alert("Something Wrong");
                        alert(data.errors['file']);
                        $input = "<input type='hidden' name='img_name' id='img_name' value=''>";
                        $(".editform").append($input);
                    }
                    else {
                        $('#file_name').val(data);
                        $input = "<input type='hidden' name='img_name' id='img_name' value='"+data.img+"'>";
                        $(".editform").append($input);
                        $('#img').attr('src', '<?php echo e(asset('uploads')); ?>/' + data.img);
                    }
                    $('#loading').css('display', 'none');
                },
                error: function (xhr, status, error) {
                    alert(xhr.responseText);
                    //$('#preview_image').attr('src', '<?php echo e(asset('images/noimage.jpg')); ?>');
                }
            });
        }
</script>

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