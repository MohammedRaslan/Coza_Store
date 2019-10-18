@if(Auth::guest() || Auth::user()->user_type == 1)
@include('notfound')
@else
@extends('Admin_Portal.inc.header')

@section('header')

<div class="container" style="">
    <div class="jumbotron">
        <h1 style="text-align:center; color:cornflowerblue">Edit products <b>{{$products->name}} </b></h1>
        <hr style="width:50%">
    <form action="{{ route('products.update',[$products->id]) }}" class="editform" method="POST" enctype="multipart/form-data">
        {{ csrf_field() }}
        <!-- Laravel used method put/patch in update function, so it'll ignore post method above -->
        <input type="hidden" name="_method" value="put">
        <div class="form-inline row justify-content-md-center">
                <label ><b>Category </b></label>&nbsp;
                <select class="form-control" name="categ" style="width:18%" >
                    @foreach($categories as $categ)
                    @if ($categ->id == $products->categ)
                <option value="{{ $products->categ }}">{{$categ->categ_name}}</option>
                    @endif
                    @endforeach
                
                   @foreach ($categories as $categ)
                   @if ($categ->id != $products->categ)
                   <option value="{{ $categ->id }}" >{{ $categ->categ_name }}</option>
                   @endif
                
                   @endforeach
                </select>&nbsp;&nbsp;
                <label><b> Name </b></label>
                &nbsp;
                <input type="text" class="form-control" value="{{ $products->name }}" name="name" placeholder="Enter New Name"  required> 
                &nbsp;
                <label> <b>Price</b> </label>
                &nbsp;
                <input type="text" class="form-control" name="price" value="{{ $products->price }}" placeholder="Enter New Email" required> 
                &nbsp;
            </div>
            <br><hr><br>
            
            <div  class="form-inline row justify-content-md-center">
                <label> <b>Model</b> </label>
                &nbsp;
                <input type="text" class="form-control" name="model" value="{{ $products->model }}" placeholder="Enter New Email" required> 
                &nbsp;
 
                <label> <b>Brand</b> </label>
                &nbsp;
                <input type="text" class="form-control" name="brand" value="{{ $products->brand }}" placeholder="Enter New Email" required> 
                &nbsp;

                <label> <b>Color</b> </label>
                &nbsp;
                <input type="text" class="form-control" name="color" value="{{ $products->color }}" placeholder="Enter New Email" required> 
                &nbsp;
            </div>
            <br><hr><br>
            
            <div class="form-inline row justify-content-md-center">
                <label> <b>Dimensions</b> </label>
                &nbsp;
                <input type="text" class="form-control" name="dimensions" value="{{ $products->dimensions }}" placeholder="Enter New Email" required> 
                &nbsp;
      
                <label> <b>Display Size</b> </label>
                &nbsp;
                <input type="text" class="form-control" name="display_size" value="{{ $products->display_size }}" placeholder="Enter New Email" required> 
                &nbsp;
      
                <label> <b>Released on</b> </label>
                &nbsp;
                <input type="text" class="form-control" name="released" value="{{ $products->released }}" placeholder="Enter New Email" required> 
           
                &nbsp;
            </div>
            <br><hr><br>
            
            <div  class="form-inline row justify-content-md-left"  >
            <label> <b>Quantity</b> </label>
            &nbsp;
            <input type="text" class="form-control" name="quantity" value="{{ $products->quantity }}" placeholder="Enter New Email" required> 
            &nbsp;
            </div>
            <br><hr><br>
            
            <div class="form-inline row justify-content-md-center" >
                   
                    <label> <b>Image</b> </label>
                    &nbsp;
                    <img type="text" class="form-control" id="img" name="" src="{{asset('uploads')}}/{{ $products->img }}" style="width:20%; height:20%;"> 
                    <input type="hidden" name="img" value="{{ $products->img }}"> 
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
        <button class="btn btn-danger btn-lg"  ><a href="{{route('productlist')}}" style="color:white;">Cancel</a></button>
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
                        alert("Something Wrong");
                        alert(data.errors['file']);
                        $input = "<input type='hidden' name='img_name' id='img_name' value=''>";
                        $(".editform").append($input);
                    }
                    else {
                        $('#file_name').val(data);
                        $input = "<input type='hidden' name='img_name' id='img_name' value='"+data.img+"'>";
                        $(".editform").append($input);
                        $('#img').attr('src', '{{asset('uploads')}}/' + data.img);
                    }
                    $('#loading').css('display', 'none');
                },
                error: function (xhr, status, error) {
                    alert(xhr.responseText);
                    //$('#preview_image').attr('src', '{{asset('images/noimage.jpg')}}');
                }
            });
        }
</script>

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