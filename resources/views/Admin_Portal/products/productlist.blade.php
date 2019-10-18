@if(Auth::guest() || Auth::user()->user_type == 1)
@include('notfound')
@else
@extends('Admin_Portal.inc.header')

@section('header')
<div class="container">

    <br>
    <div class="row justify-content-md-center">
        <button type="button" class="btn btn-secondary addcateg"><i class="fa fa-plus-square"></i>&nbsp; Add Category</button>
        &nbsp;
        <button type="button" class="btn btn-secondary addproduct"><i class="fa fa-plus-square"></i>&nbsp; Add Product</button>
        &nbsp;
    
        <button type="button" class="btn btn-secondary search"><i class="fa fa-search"></i>&nbsp; Search product</button>
        
    </div>
     
    <div class="form-inline row justify-content-center searchform"  style="display:none; ">
            <form class="search-form">
                    <br>{{ csrf_field() }}
                <input class="form-control searchinput" id="searchinput" type="text" placeholder="Search by id ..." aria-label="Search" style="width:300px;" required>
                <button type="button" id="searchbutton" class="btn btn-primary btn-md searchbtn"><i class="fa fa-dot-circle-o"></i> Search</button>
                <button style="display:none;" type="button" class="btn btn-success btn-md listproduct" id="listproduct" name="listproduct" style="text-align:center"><i class="fa fa-dot-circle-o"></i> List Products</button>

            </form>
    </div>

        <div class="form-inline row justify-content-center categform"  style="display:none; ">
                <form class="search-form">
                        <br>{{ csrf_field() }}
                    <input class="form-control categinput" id="categinput" type="text" placeholder="Enter New Category..." aria-label="Search" style="width:300px;" required>
                    <button type="button" id="addcategbutton" class="btn btn-primary btn-md addcategbutton"><i class="fa fa-dot-circle-o"></i> Add</button>
     
                </form>
        </div>

        <div class="form-inline row justify-content-md-center addprouductform " style="display:none; ">
            <div class="alert  alert-danger alert-dismissible fade show alert" role="alert" style="display:none">
										 
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
                <form class="search-form">
                        <br>{{ csrf_field() }}
                        <select id="categ" class="form-control categ" style="width:180px;">
                            <option>Choose Category</option>
                            @foreach ($categories as $categ)
                        <option value="{{ $categ->id }}">{{ $categ->categ_name }}</option>
                            @endforeach
                            
                        </select>
                    <input class="form-control" type="text" id="productname" placeholder="Product Name..."  style="width:150px;" required>
                    <input class="form-control" type="text" id="price" placeholder="Price..."  style="width:150px;" required>
                    <input class="form-control" type="text" id="model" placeholder="Model..."  style="width:150px;" required>
                    <input class="form-control" type="text" id="brand" placeholder="Brand..."  style="width:150px;" required>
                    <input class="form-control" type="text" id="color" placeholder="Color..."  style="width:150px;" required>
                        <br><br>
                    <input class="form-control" type="text" id="dimensions" placeholder="Dimensions..."  style="width:180px;" required>
                    <input class="form-control" type="text" id="display_size" placeholder="Display_size..."  style="width:150px;" required>
                    <input class="form-control" type="text" id="quantity" placeholder="Quantity..."  style="width:150px;" required>
                   <!--<div class="custom-file" style="width:30%;">
                     <input type="file" name="image" class="custom-file-input img" id="img" aria-describedby="inputGroupFileAddon01">
                     <label class="custom-file-label" for="inputGroupFile01">Choose file</label> 
                    </div>-->
                    <div class="btn btn-primary">
                    <a  style="text-decoration: none; color:floralwhite;" class="changeProfile">
                        <i class="glyphicon glyphicon-edit "></i> Choose Photo
                    </a>
                    <input type="file" id="file" style="display: none"/>
                    <input type="hidden" id="file_name"/>
                    </div>
                    <i id="loading" class="fa fa-spinner fa-spin fa-3x fa-fw" style="position: absolute;left: 40%;top:45%; display:none;"></i>
               
                    <input class="form-control" type="date" id="released" placeholder="Released..."  style="width:170px;" required>
                        <br><br>
                        <button type="button" class="btn btn-success btn-md submitaddproduct" id="submitaddproduct" name="submitaddproduct" style="text-align:center; position:relative;left:38%; width:25%;" >
                            <i class="fa fa-dot-circle-o"></i> Submit
                        </button>
                        
                </form>
        </div>

        <br>
        <div class="card row justify-content-md-center" id="table">
            <div class="card-header col-md-12 after" style="text-align:center;">
               
                <strong class="card-title" >Products List</strong>
            </div>
            
            <div class="table-responsive tb" style="border-radius:10px;">
                <table class="table">
                    <thead class="thead-dark">
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col">Category</th>
                            <th scope="col">Name</th>
                            <th scope="col">Price</th>
                            <th scope="col">Model</th>
                            <th scope="col">Brand</th>
                            <th scope="col">Edit</th>
                            <th scope="col">Delete</th>

                        </tr>
                    </thead>
                    <tbody>
                       
                        @foreach ($products as $product)
                       
                            
                        
                        <tr id="{{$product->id}}">
                           
                            
                        <th scope="row" id="userid">{{$product->id}}</th>
                        @foreach ($categories as $categ)
                            @if($product->categ == $categ->id)
                        <td>{{ $categ->categ_name }}</td>
                            @endif
                        @endforeach
                           
                                <td>{{$product->name}}</td>
                           
                            <td>{{$product->price}}</td>
                            
                                <td>{{$product->model}}</td>
                                <td>{{$product->brand}}</td>
                                <td>
                                    <!--<input name="id" value="{{ $product->id }}" hidden/>-->
                                    <button type="submit" class="btn btn-primary edit" value="{{$product->id}}" id="edit">
                                        <a href="/products/{{ $product->id }}/edit" style="color: white;">Edit</a>
                                    </button>
                                </td>
                                <td><button type="button" class="btn btn-danger deletepro" value="{{ $product->id }}">Delete</button></td>
                             
                                
                            </tr>  
                         
                
                            
                            @endforeach
                       
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
                        url: 'destroy/'+$id,
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

        $(".addcateg").click(function(){
            $(".categform").toggle(1000);
        });

        $(".addproduct").click(function(){
            $(".addprouductform").toggle(1000);
        });

        $(".search").click(function(){
            $(".searchform").toggle(1000);
        });

        $("body").on('click','.addcategbutton',function(){
            $categ = $("#categinput").val();
            $.ajax({
                    url: 'addcateg',
                    type: 'get',
                    dataType: 'json', 
                    data:{arr:JSON.stringify($categ)},
                    success :function(response){
                        if(response["state"] == "true"){
                            $option = " <option value='"+response["categ_id"]+"'>"+$categ+"</option>"
                            $(".categ").append($option);
                            alert("Category has saved successfully");
                        }else{
                            alert("Somthing went wrong");
                        }
                    }
            });
        });

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
            form_data.append('_token', '{{csrf_token()}}');
            $('#loading').css('display', 'block');
            $.ajax({
                url: "{{url('ajax-image-upload')}}",
                data: form_data,
                type: 'POST',
                contentType: false,
                processData: false,
                success: function (data) {
                    if (data.fail) {
                        $(".alert").text(data.errors['file']);
                        $(".alert").css("display","block");
                    }
                    else {
                        $(".alert").css("display","none");
                        $('#file_name').val(data);
                        $input = "<input type='hidden' id='img_name' value='"+data.img+"'>";
                        $(".addprouductform").append($input);
                        //$('#preview_image').attr('src', '{{asset('uploads')}}/' + data);
                    }
                    $('#loading').css('display', 'none');
                },
                error: function (xhr, status, error) {
                    alert(xhr.responseText);
                    //$('#preview_image').attr('src', '{{asset('images/noimage.jpg')}}');
                }
            });
        }

        $(document).on('click','.submitaddproduct',(function(){
            $table = $(".table");
            $categ = $("#categ").val();
            $name  = $("#productname").val();
            $price = $("#price").val();
            $model = $("#model").val();
            $brand = $("#brand").val();
            $color = $("#color").val();
            $img   = $("#img_name").val();
            $dimensions = $("#dimensions").val();
            $display_size = $("#display_size").val();
  
            $quantity = $("#quantity").val();
            $released = $("#released").val();


            $product =Array();
                $product.push($categ);
                $product.push($name);
                $product.push($price);
                $product.push($model);
                $product.push($brand);
                $product.push($color);
                $product.push($dimensions);
                $product.push($display_size);
                $product.push($img);
                $product.push($released);
                $product.push($quantity);
    
            
            $.ajax({
                        url: 'addproduct',
                        type: 'get',
                        dataType: 'json',
                        data:{arr:JSON.stringify($product)},
                        success: function(response){
                            if(response["state"] == "false"){
                                alert("Something Wrong");
                            }else if(response["state"] == "true"){
                                 
                                $tr =" <tr id='"+response["product_id"]+"'><th scope='row'>"+response['product_id']+"</th><td>"+response['categ_name']+"</td><td>"+$name+"</td><td>"+$price+"</td><td>"+$model+"</td><td>"+$brand+"</td><td><button type='submit' class='btn btn-primary edit' value='"+response['userid']+"' id='edit'><a href='/users/"+response['userid']+"/edit' style='color: white;'>Edit</a></button></td><td><button type='button' class='btn btn-danger deletepro' value='"+response['userid']+"'>Delete</button></td></tr>"
                                $table.append($tr);
                                
                     }
                    }});
        }));

  
        
            $(".searchbtn").click(function(){
                $table = $(".table");
                $id = $(".searchinput").val();
                if(isNaN($id)){
                    alert("Please Insert a Number");
                }else{
                    $.ajax({
                        url:  'searchproduct/'+$id,
                        type: 'get',
                        dataType: 'json',
                        success: function(response){
                            if(response["state"]=="true"){
                             
                               $tb = $(".tb").slideUp("slow");
                               $tr = "<div class='table-responsive tb1' ><table class='table'> <thead class='thead-dark'><tr><th scope='col'>ID</th><th scope='col'>Category</th><th scope='col'>Name</th><th scope='col'>Price</th><th scope='col'>Model</th><th scope='col'>Brand</th><th scope='col'>Edit</th><th scope='col'>Delete</th></tr></thead><tbody><tr id='"+response['result'].id+"'> <th scope='row' >"+response['result'].id+"</th><td>"+response['categ']+"</td><td>"+response['result'].name+"</td><td>"+response['result'].price+"</td><td>"+response['result'].model+"</td><td>"+response['result'].brand+"</td><td><button type='submit' class='btn btn-primary edit' value='"+response['result'].id+"' id='edit'><a href='/products/"+response['result'].id+"/edit' style='color: white;'>Edit</a></button></td><td><button type='button' class='btn btn-danger deletepro' value='"+response['result'].id+"'>Delete</button></td></tr></tbody></table> </div>";      
                              $(".after").append($tr).hide().slideDown("slow");
                              $(".listproduct").slideDown("slow");
                            }else{
                                alert("Sorry,There Is No Recrod");
                            }

                        }
                    });
                }
            });

            $("body").on('click','.listproduct',function(){
                     $(".tb1").slideUp("slow");
                     $(".tb").slideDown("slow");
            });
 
            
            $("body").on('click', '.deletepro',(function(){
              
              if(confirm("Are you sure you want to delete this product?")){
                   $tr = $(this).closest("tr");
                   $id = ($tr).attr("id");
                   
                   $.ajax({
                      url: 'destroy/'+$id,
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
    <script src="{{ asset('AdminEnd') }}/vendors/jquery/dist/jquery.min.js"></script>
    <script src="{{ asset('AdminEnd') }}/vendors/popper.js/dist/umd/popper.min.js"></script>
    <script src="{{ asset('AdminEnd') }}/vendors/bootstrap/dist/js/bootstrap.min.js"></script>
    <script src="{{ asset('AdminEnd') }}/assets/js/main.js"></script>
    
    
    
    <script src="{{ asset('AdminEnd') }}/assets/js/dashboard.js"></script>
    <script src="{{ asset('AdminEnd') }}/assets/js/widgets.js"></script>
    
    
    
    </body>
    
    </html>
@endsection
@endif