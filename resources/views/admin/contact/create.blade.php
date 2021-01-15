@extends('admin.admin_master')
@section('admin')
<div class="row">
    <div class="col-lg-12">
        <div class="card card-default">
            <div class="card-header card-header-border-bottom">
                <h2>Create Home Contact</h2>
            </div>
            <div class="card-body">
                <form action="{{ route('store.contact') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="exampleFormControlInput1">Address</label>
                        <input type="text" name="address" class="form-control" id="exampleFormControlInput1" placeholder="Add Title">
                    </div>
                    <div class="form-group">
                        <label for="exampleFormControlInput1">Email</label>
                        <Textarea name="email" class="form-control" id="exampleFormControlTextarea1" rows="3" placeholder="Add Description"></Textarea>
                    </div>
                   
                    <div class="form-group">
                        <label for="exampleFormControlInput1">Phone</label>
                        <Textarea name="phone" class="form-control" id="exampleFormControlTextarea1" rows="3" placeholder="Add Description"></Textarea>
                    </div>
                    <div class="form-footer pt-4 mt-4 border-top">
                        <button type="submit" class="btn btn-primary btn-default">Add</button>
                        <button type="submit" class="btn btn-secondary btn-default">Cancel</button>
                    </div>
                </form>
            </div>
        </div>

    </div>
</div>

@endsection
