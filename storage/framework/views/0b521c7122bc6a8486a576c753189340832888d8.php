<?php if(Auth::guest() || Auth::user()->user_type != 0): ?>
<?php echo $__env->make('notfound', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php else: ?>


<?php $__env->startSection('header'); ?>
<div class="container">

    <br>
    <div class="row justify-content-md-center">
        <button type="button" class="btn btn-secondary adduser"><i class="fa fa-user-plus"></i>&nbsp; Add User</button>
        &nbsp;
        <button type="button" class="btn btn-secondary search"><i class="fa fa-search"></i>&nbsp; Search User</button>
        
    </div>
     
    <div class="form-inline row justify-content-center searchform"  style="display:none; ">
            <form class="search-form">
                    <br>
                <input class="form-control searchinput" id="searchinput" type="text" placeholder="Search by id ..." aria-label="Search" style="width:300px;" required>
                <button type="button" id="searchbutton" class="btn btn-primary btn-md searchbutton"><i class="fa fa-dot-circle-o"></i> Search</button>
                <button style="display:none;" type="button" class="btn btn-success btn-md listemp" id="listemp" name="listemp" style="text-align:center"><i class="fa fa-dot-circle-o"></i> List Employees</button>

            </form>
        </div>

        <div class="form-inline row justify-content-md-center adduserform " style="display:none; ">
                <form class="search-form">
                        <br><?php echo e(csrf_field()); ?>

                    <input class="form-control" type="text" id="username" placeholder="Username..."  style="width:150px;" required>
                    <input class="form-control" type="text" id="email" placeholder="Email..."  style="width:150px;" required>
                    <input class="form-control" type="password" id="password" placeholder="Password..."  style="width:150px;" required>
                   
                    
                

                        <button type="button" class="btn btn-success btn-md submitadduser" id="submitadduser" name="submitadduser" style="text-align:center"><i class="fa fa-dot-circle-o"></i> Submit</button>
                        
                </form>
            </div>

        <br>
        <div class="card row justify-content-md-center" id="table">
            <div class="card-header col-md-12 after" style="text-align:center;">
                <strong class="card-title" >Users List</strong>
            </div>
            
            <div class="table-responsive tb" style="border-radius:10px;">
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
                       
                            <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            
                            <tr id="<?php echo e($user->id); ?>">
                            <th scope="row" id="userid"><?php echo e($user->id); ?></th><input type="text" class="form-control userid" value="<?php echo e($user->id); ?>" style="display:none;">
                            <td><?php echo e($user->name); ?></td><input type="text" class="form-control editname" value="<?php echo e($user->name); ?>" style="display:none;">
                            <td><?php echo e($user->email); ?></td><input type="text" class="form-control editemail" value="<?php echo e($user->email); ?>" style="display:none;">
                        <?php if($user->user_type==0): ?>
                            <td>Admin</td>
                        <?php elseif($user->user_type==1): ?>
                            <td>User</td>
                        <?php else: ?>
                        <td>Employee</td>
                        <select id="usertypeedit" class="form-control usertypeedit" style="display:none;">
                            <option value="0">Admin</option>
                            <option value="1">User</option>
                            <option value="2">Employee</option>
                        </select>
                        <?php endif; ?>
                            <td><?php echo e($user->created_at); ?></td>
                            
                            <td>
                                <!--<input name="id" value="<?php echo e($user->id); ?>" hidden/>-->
                                <button type="submit" class="btn btn-primary edit" value="<?php echo e($user->id); ?>" id="edit">
                                    <a href="/users/<?php echo e($user->id); ?>/edit" style="color: white;">Edit</a>
                                </button>
                            </td>
                            <td><button type="button" class="btn btn-danger delete" value="<?php echo e($user->id); ?>">Delete</button></td>
                         
                            
                        </tr>  
                     
            
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                       
                    </tbody>
                  
                </table>

            </div>
            
        </div>
    
</div>
    <script>
        $(document).ready(function($){
            $("body").on('click', '.delete',(function(){
              
                if(confirm("Are you sure you want to delete this user:?")){
                     $tr = $(this).closest("tr");
                     $id = ($tr).attr("id");
                     
                     $.ajax({
                        url: 'destroyuser/'+$id,
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

        $(".search").click(function(){
            $(".searchform").toggle(1000);
        });

        $(".adduser").click(function(){
            $(".adduserform").toggle(1000);
        });

       

        $(document).on('click','.submitadduser',(function(){
            $table = $(".table");
            $username = $("#username").val();
            $email    = $("#email").val();
            $password = $("#password").val();
           
            $user =Array();
            $user.push($username);
            $user.push($email);
            $user.push($password);
            
            $.ajax({
                        url: 'adduser',
                        type: 'get',
                        dataType: 'json',
                        data:{arr:JSON.stringify($user)},
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

        $(".searchbutton").click(function(){
                $table = $(".table");
                $id = $(".searchinput").val();
                if(isNaN($id)){
                    alert("Please Insert a Number");
                }else{
                    $.ajax({
                        url:  'searchuser/'+$id,
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
<style> 
        #editpanel{
          padding: 5px;
          text-align: center;
          background-color: white;
          border: solid 1px #c3c3c3;
        }
        
        #editpanel {
          padding: 50px;
          display: none;
        }

        a.login:hover{
			text-decoration-line: none;
            
		}
        #table {
            border-radius: 5px;
            width: 100%;
            margin: 0px auto;
            float: none;
}
.table {
    border-radius: 5px;
    width: 100%;
    margin: 0px auto;
    float: none;
}
        </style>
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