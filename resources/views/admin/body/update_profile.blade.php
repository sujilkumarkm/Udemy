@extends('admin.admin_master')
@section('admin')
<div class="card-default">
    <div class="card-header card-header-border-bottom">
        <h2>User Profile</h2>
    </div>
    @if(session('success'))
                      
        
    <div class="alert alert-success" role="alert">
        <strong>{{ session('success') }}</strong>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>

  @endif
    <div class="card-body">
        <form method="post" action="{{ route('update.user.profile') }}"    class="form-pill">
            @csrf
            <div class="form-group">
                <label for="exampleFormControlInput3">User Name</label>
                <input type="test" name="name" value="{{ $user->name }}" class="form-control" id="current_password">

            </div>

            <div class="form-group">
                <label for="exampleFormControlInput3">User Name</label>
                <input type="email" name="email" value="{{ $user->email }}" class="form-control" id="current_password">

            </div>

            <button type="submit" class="btn btn-primary btn-default">Update</button>
        </form>
    </div>
</div>
@endsection