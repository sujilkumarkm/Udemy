@extends('admin.admin_master')
@section('admin')
<div class="row">
    <div class="col-lg-12">
        <div class="card card-default">
            <div class="card-header card-header-border-bottom">
                <h2>Edit New Slider</h2>
            </div>
            <div class="card-body">
                <form action="{{ url('slider/update/'.$sliders->id) }}" method="post" enctype="multipart/form-data">
                    @csrf

                    <input type="hidden" name="old_image" value="{{ $sliders->image }}">

                    <div class="form-group">
                        <label for="exampleFormControlInput1">Title</label>
                        <input type="text" value="{{ $sliders->title }}" name="title" class="form-control" id="exampleFormControlInput1" placeholder="Add Title">
                    </div>
                    <div class="form-group">
                        <label for="exampleFormControlInput1">Slide Description</label>
                        <Textarea name="description" class="form-control" id="exampleFormControlTextarea1" rows="3" placeholder="Add Description">{{ $sliders->description }}</Textarea>
                    </div>
                   
                    <div class="form-group">
                        <label for="exampleFormControlFile1">Image</label>
                        <input type="file" name="image" class="form-control-file" id="exampleFormControlFile1">
                    </div>
                    <div class="form-group">
                        <img src="{{ asset( $sliders->image) }}" class="img-fluid">
                      </div>
                    <div class="form-footer pt-4 mt-4 border-top">
                        <button type="submit" class="btn btn-primary btn-default">Submit</button>
                        <button type="submit" class="btn btn-secondary btn-default">Cancel</button>
                    </div>
                </form>
            </div>
        </div>

    </div>
</div>

@endsection
