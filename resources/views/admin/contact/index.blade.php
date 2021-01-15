@extends('admin.admin_master')
@section('admin')

    <div class="py-12">
       
        <div class="container">
            <div class="row">
              <div class="col-md-4"><h4>Contact Page</h4></div>
              <div class="mb-4"><a href="{{ route('add.contact') }}"><button class="btn btn-info">Add Contact</button></a></div>
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
                <div class="card-header">All Contact Data</div>
            </div>  
                <table class="table">
                    <thead>
                      <tr>
                        <th scope="col" width="5%">Sl No.</th>
                        <th scope="col" width="25%">Contact Address</th>
                        <th scope="col" width="10%">Contact Email</th>
                        <th scope="col" width="10%">Contact Phone</th>
                        <th scope="col" width="10%">Created</th>
                        <th scope="col" width="15%">Action</th>
                      </tr>
                    </thead>
                    @php($i=1)
                    @foreach ($contacts as $con)
                        
                    <tbody>   
                      <tr>
                        {{-- <th scope="row">{{ $i++ }}</th> --}}
                        <th scope="row">{{ $i++ }}</th>
                        <td >{{ $con->address }}</td>
                        <td >{{ $con->email }}</td>
                        <td>{{ $con->phone }}</td>
                       {{-- {{  dd($brand->brand_image) }} --}}
                        {{-- for Query builder join --}}
                        {{-- <td>{{ $category->name }}</td> --}}
                      <td>
                        
                         
                        {{ Carbon\carbon::parse($con->created_at) -> DiffForHumans() }}</td>
                        
                        <td><a href="{{ url('admin/edit/'.$con->id) }}" class="btn btn-info">Edit </a>
                        <a href="{{ url('admin/delete/'.$con->id) }}" onclick="return confirm('Are you sure to delete ?');" class="btn btn-danger">Delete </a></td>

                      </tr>

                         

                     
                      @endforeach
                    </tbody>
                  </table>
              
                </div>
                </div>
            </div>


            </div>

@endsection
