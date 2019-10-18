<?php if(Auth::guest() || Auth::user()->user_type == 1): ?>
<?php echo $__env->make('notfound', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php else: ?>


<?php $__env->startSection('header'); ?>

<div class="container">

    <br>
    <div class="row justify-content-md-center">
        <button type="button" class="btn btn-secondary addemployee"><i class="fa fa-user-plus"></i>&nbsp; Add Employee</button>
        &nbsp;
        <button type="button" class="btn btn-secondary search"><i class="fa fa-search"></i>&nbsp; Search Employee</button>
       
    </div>
     
    <div class="form-inline row justify-content-center searchform"  style="display:none; ">
            <form class="search-form">
                    <br>
                <input class="form-control searchinput" id="searchinput" type="text" placeholder="Search by id ..." aria-label="Search" style="width:300px;" required>
                <button type="button" id="searchbutton" class="btn btn-primary btn-md searchbutton"><i class="fa fa-dot-circle-o"></i> Search</button>
                <button style="display:none;" type="button" class="btn btn-success btn-md listemp" id="listemp" name="listemp" style="text-align:center"><i class="fa fa-dot-circle-o"></i> List Employees</button>
            
            </form>
        </div>

        <div class="form-inline row justify-content-md-center addemployeeform " style="display:none; ">
                <form class="search-form">
                        <br><?php echo e(csrf_field()); ?>

                    <input class="form-control" type="text" id="username" placeholder="Employee Name..."  style="width:200px;" required>
                    <input class="form-control" type="text" id="email" placeholder="Email..."  style="width:200px;" required>
                    <input class="form-control" type="text" id="password" placeholder="Password..."  style="width:200px;" required>
                   

                        <button type="button" class="btn btn-success btn-md submitaddemployee" id="submitaddemployee" name="submitaddemployee" style="text-align:center"><i class="fa fa-dot-circle-o"></i> Submit</button>
                        
                </form>
        </div>

        <br>
        <div class="container">
        <div class="card row justify-content-md-center" id="table">
                <div class="card-header col-md-12 after" style="text-align:center;">
                    <strong class="card-title" >Employees List</strong>
                </div>
                <div class="table-responsive tb" style="border-radius:10px;" >
                    <table class="table">
                        <thead class="thead-dark">
                            <tr>
                                <th scope="col">ID</th>
                                <th scope="col">Name</th>
                                <th scope="col">Email</th>
                                <th scope="col">User Type</th>
                                <th scope="col">Created At</th>
                                <th scope="col">Edit</th>
                                <th scope="col">Delete</th>
    
                            </tr>
                        </thead>
                        <tbody>
                           
                            <?php $__currentLoopData = $employees; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $employee): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                   
                            <tr id="<?php echo e($employee->id); ?>">
                               
                                
                            <th scope="row" id="userid"><?php echo e($employee->id); ?></th>
                                    <td><?php echo e($employee->name); ?></td>
                                    <td><?php echo e($employee->email); ?></td>
                               
                                <td>Employee</td>
                                
                                    <td><?php echo e($employee->created_at); ?></td>
                                    
                                    <td>
                                        <!--<input name="id" value="<?php echo e($employee->id); ?>" hidden/>-->
                                        <button type="submit" class="btn btn-primary edit" value="<?php echo e($employee->id); ?>" id="edit">
                                            <a href="/employees/<?php echo e($employee->id); ?>/edit" style="color: white;">Edit</a>
                                        </button>
                                    </td>
                                    <td><button type="button" class="btn btn-danger delete" value="<?php echo e($employee->id); ?>">Delete</button></td>
                                 
                                    
                                </tr>  
                             
                    
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?> 
                           
                        </tbody>
                      
                    </table>
    
                </div>
            </div>
        </div>
    
</div>


<script>
     $(document).ready(function($){
     $(".addemployee").click(function(){
            $(".addemployeeform").toggle(1000);
        });

        $(".search").click(function(){
            $(".searchform").toggle(1000);
        });

        $(document).on('click','.submitaddemployee',(function(){
            $table = $(".table");
            $username = $("#username").val();
            $email    = $("#email").val();
            $password = $("#password").val();
           
            $employee =Array();
            $employee.push($username);
            $employee.push($email);
            $employee.push($password);
            
            $.ajax({
                        url: 'addemployee',
                        type: 'get',
                        dataType: 'json',
                        data:{arr:JSON.stringify($employee)},
                        success: function(response){
                            if(response["state"] == "false"){
                                alert("already exist");
                            }else {
                            if(response["state"] == "true"){
                              
                                
                                $tr =" <tr id='"+response['userid']+"'><th scope='row'>"+response['userid']+"</th><td>"+$username+"</td><td>"+$email+"</td><td>User</td><td>Just Now</td><td><button type='submit' class='btn btn-primary edit' value='"+response['userid']+"' id='edit'><a href='/users/"+response['userid']+"/edit' style='color: white;'>Edit</a></button></td><td><button type='button' class='btn btn-danger delete' value='"+response['userid']+"'>Delete</button></td></tr>"
                                $table.append($tr);
                                
                     }}
                    }});
                }));

                $("body").on('click', '.delete',(function(){
              
                     if(confirm("Are you sure you want to delete this Employee:?")){
                     $tr = $(this).closest("tr");
                     $id = ($tr).attr("id");
                     
                     $.ajax({
                        url: 'delete/'+$id,
                        type: 'get',
                        dataType: 'json',
                        success: function(response){
                            if(response=="true"){
                                ($tr).remove();
                            }
                        }
                     });
        
                     
                        }else{
                    false;
                }
            
                 }));

                 $("body").on('click','.searchbutton',function(){
                $table = $(".table");
                $id = $(".searchinput").val();
                if(isNaN($id)){
                    alert("Please Insert a Number");
                }else{
                    $.ajax({
                        url:  'searchemployee/'+$id,
                        type: 'get',
                        dataType: 'json',
                        success: function(response){
                            if(response["state"]=="true"){
                                if(response['result'].user_type == 0){
                                    $user_type = "Admin";
                                }else if(response['result'].user_type == 1 ){
                                    $user_type = "User";
                                }else {
                                    $user_type = "Employee";
                                }
                               $tb = $(".tb").slideUp("slow");
                               $tr = "<div class='table-responsive tb1' ><table class='table'> <thead class='thead-dark'><tr><th scope='col'>ID</th><th scope='col'>Name</th><th scope='col'>Email</th><th scope='col'>User Type</th><th scope='col'>Created At</th><th scope='col'>Edit</th><th scope='col'>Delete</th></tr></thead><tbody><tr id='"+response['result'].id+"'> <th scope='row' id='userid'>"+response['result'].id+"</th><td>"+response['result'].name+"</td><td>"+response['result'].email+"</td><td>"+$user_type+"</td><td>"+response['result'].created_at+"</td><td><button type='submit' class='btn btn-primary edit' value='"+response['result'].id+"' id='edit'><a href='/users/"+response['result'].id+"/edit' style='color: white;'>Edit</a></button></td><td><button type='button' class='btn btn-danger delete' value='"+response['result'].id+"'>Delete</button></td></tr></tbody></table> </div>";      
                              $(".after").append($tr).hide().slideDown("slow");
                                $(".listemp").slideDown("slow");
                            }else{
                                alert("Sorry,There Is No Recrod");
                            }

                        }
                    });
                }
                
            });
            $("body").on('click','.listemp',function(){
                     $(".tb1").slideUp("slow");
                     $(".tb").slideDown("slow");
                });
     });
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