@extends('user.layouts.app')
@section('content')
 <div class="container">
    <div class="col-lg-6 mt-4" style="padding-left:20px">
         <a href="/">Home</a>
    </div>
    <div class="col-lg-8 mx-auto">
        <div class="cards p-3">
            <div class="card-body border">
                <h3 class='text-center pb-3 pt-3'>Welcome to Blizexchange</h3>
                <hr>
                <p class="alert alert-success">Your Account has been verified, You can now login to have a seemless trading experience.</p>
                <p>Login  <a href="/login">Here</a></p>
                <br>
            </div>
        </div>
    </div>
</div>

@endsection