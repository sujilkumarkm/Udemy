@extends('admin.admin_master')
@section('admin')
<div class="row">
    <div class="col-lg-12">
        <div class="card card-default">
            <div class="card-header card-header-border-bottom">
                <h2>Edit Home About</h2>
            </div>
            <div class="card-body">
                <form action="{{ url('admin/update/'.$contacts->id) }}" method="post" enctype="multipart/form-data">
                    @csrf

                    <input type="hidden" name="old_image" value="{{ $contacts->image }}">

                    <div class="form-group">
                        <label for="exampleFormControlInput1">Contact Address</label>
                        <input type="text" value="{{ $contacts->address }}" name="address" class="form-control" id="exampleFormControlInput1" placeholder="Add Address">
                    </div>
                    <div class="form-group">
                        <label for="exampleFormControlInput1">Contact Email</label>
                        <Textarea name="email"  class="form-control" id="exampleFormControlTextarea1" rows="3" placeholder="Add Email">{{ $contacts->email }}</Textarea>
                    </div>
                    <div class="form-group">
                        <label for="exampleFormControlInput1">Contact Phone</label>
                        <Textarea name="phone"  class="form-control" id="exampleFormControlTextarea1" rows="3" placeholder="Add Phone">{{ $contacts->phone }}</Textarea>
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
