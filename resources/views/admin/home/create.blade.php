@extends('admin.admin_master')
@section('admin')
<div class="row">
    <div class="col-lg-12">
        <div class="card card-default">
            <div class="card-header card-header-border-bottom">
                <h2>Create Home About</h2>
            </div>
            <div class="card-body">
                <form action="{{ route('store.about') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="exampleFormControlInput1">About Title</label>
                        <input type="text" name="title" class="form-control" id="exampleFormControlInput1" placeholder="Add Title">
                    </div>
                    <div class="form-group">
                        <label for="exampleFormControlInput1">Shprt Description</label>
                        <Textarea name="short_des" class="form-control" id="exampleFormControlTextarea1" rows="3" placeholder="Add Description"></Textarea>
                    </div>
                   
                    <div class="form-group">
                        <label for="exampleFormControlInput1">Long Description</label>
                        <Textarea name="long_des" class="form-control" id="exampleFormControlTextarea1" rows="3" placeholder="Add Description"></Textarea>
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
