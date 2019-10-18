@if(Auth::guest() || Auth::user()->user_type == 1)
@include('notfound')
@else
@extends('Admin_Portal.inc.header')

@section('header')

<div class="container" style="">
    <div class="jumbotron">
        <h1 style="text-align:center; color:cornflowerblue"><b>Edit User {{$user->name}} </b></h1>
        <hr style="width:50%">
    <form action="{{ route('users.update',[$user->id]) }}" method="POST" enctype="multipart/form-data">
        {{ csrf_field() }}
        <!-- Laravel used method put/patch in update function, so it'll ignore post method above -->
        <input type="hidden" name="_method" value="put">
        <div class="form-group">
                <label>Name</label>
        <input type="text" class="form-control" value="{{ $user->name }}" name="name" placeholder="Enter New Name"  required> 
        </div>
        <div class="form-group">
                <label>Email</label>
        <input type="text" class="form-control" name="email" value="{{ $user->email }}" placeholder="Enter New Email" required> 
        </div>
        <label >User Type</label>
        <select class="form-control" name="user_type" >
            @if($user->user_type == 1)
                <option value="{{ $user->user_type }}">(User)</option>
                <option value="0">(Admin)</option>
                <option value="2">(Employee)</option>
            @elseif($user->user_type == 0)
                <option value="{{ $user->user_type }}">(Admin)</option>
                <option value="1">(User)</option>
                <option value="2">(Employee)</option>
            @else
            <option value="{{ $user->user_type }}">(Employee)</option>
                <option value="0">(Admin)</option>
                <option value="1">(User)</option>
        @endif
        </select>
        <br>
        <button name="submit" type="submit" class="btn btn-primary btn-lg"  >Edit User</button>
        <button class="btn btn-danger btn-lg"  ><a href="{{route('userlist')}}" style="color:white;">Cancel</a></button>
    </form>
    </div>
</div>


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