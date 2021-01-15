@extends('admin.admin_master')
@section('admin')

    <div class="py-12">
       
        <div class="container">
            <div class="row">
              <div class="col-md-4"><h4>Home About</h4></div>
              <div class="mb-4"><a href="{{ route('add.about') }}"><button class="btn btn-info">Add About</button></a></div>
            <div class="col-md-12">
            <div class="card">
               
              @if(session('success'))
                      
        
                  <div class="alert alert-success" role="alert">
                      <strong>{{ session('success') }}</strong>
                      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
  
                @endif  

                @if(session('error'))
                <div class="alert alert-danger" role="alert">
                    <strong>{{ session('error') }}</strong>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                  </div>
              @endif  
              
            </div>
            <div class="row">
                <div class="card-header">All About Data</div>
            </div>  
                <table class="table">
                    <thead>
                      <tr>
                        <th scope="col" width="5%">Sl No.</th>
                        <th scope="col" width="15%">About Title</th>
                        <th scope="col" width="15%">Short Description</th>
                        <th scope="col" width="25%">Long Description</th>
                        <th scope="col" width="15%">Updated</th>
                        <th scope="col" width="15%">Action</th>
                      </tr>
                    </thead>
                    @php($i=1)
                    @foreach ($homeabout as $about)
                        
                    <tbody>   
                      <tr>
                        {{-- <th scope="row">{{ $i++ }}</th> --}}
                        <th scope="row">{{ $i++ }}</th>
                        <td >{{ $about->title }}</td>
                        <td >{{ $about->short_des }}</td>
                        <td>{{ $about->long_des }}</td>
                       {{-- {{  dd($brand->brand_image) }} --}}
                        {{-- for Query builder join --}}
                        {{-- <td>{{ $category->name }}</td> --}}
                      <td>
                        
                         
                        {{ Carbon\carbon::parse($about->updated_at) -> DiffForHumans() }}</td>
                        
                        <td><a href="{{ url('about/edit/'.$about->id) }}" class="btn btn-info">Edit </a>
                        <a href="{{ url('about/delete/'.$about->id) }}" onclick="return confirm('Are you sure to delete ?');" class="btn btn-danger">Delete </a></td>

                      </tr>

                         

                     
                      @endforeach
                    </tbody>
                  </table>
              
                </div>
                </div>
            </div>


            </div>

@endsection
