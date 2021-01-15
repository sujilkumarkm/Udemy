@extends('admin.admin_master')
@section('admin')

    <div class="py-12">
       
        <div class="container">
            <div class="row">
              <div class="col-md-4"><h4>Admin Message</h4></div>
              {{-- <div class="mb-4"><a href="{{ route('add.contact') }}"><button class="btn btn-info">Admin Message</button></a></div> --}}
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
                <div class="card-header">All Message Data</div>
            </div>  
                <table class="table">
                    <thead>
                      <tr>
                        <th scope="col" width="5%">Sl No.</th>
                        <th scope="col" width="5%">Name</th>
                        <th scope="col" width="10%">Email</th>
                        <th scope="col" width="10%">Subject</th>
                        <th scope="col" width="25%">Message</th>
                        <th scope="col" width="10%">Received</th>
                        <th s   cope="col" width="  5%">Action</th>
                      </tr>
                    </thead>
                    {{-- @php($i=1) --}}
                    @foreach ($messages as $mes)
                        
                    <tbody>   
                      <tr>
                        {{-- <th scope="row">{{ $i++ }}</th> --}}
                        <th scope="row">{{ $messages->firstItem()+$loop->index }}</th>
                        <td >{{ $mes->name }}</td>
                        <td >{{ $mes->email }}</td>
                        <td>{{ $mes->subject }}</td>
                        <td>{{ $mes->message }}</td>
                       {{-- {{  dd($brand->brand_image) }} --}}
                        {{-- for Query builder join --}}
                        {{-- <td>{{ $category->name }}</td> --}}
                      <td>
                        
                         
                        {{ Carbon\carbon::parse($mes->created_at) -> DiffForHumans() }}</td>
                        
                        <td><a href="{{ url('admin/delete/'.$mes->id) }}" onclick="return confirm('Are you sure to delete ?');" class="btn btn-danger">Delete </a></td>

                      </tr>

                         

                     
                      @endforeach
                    </tbody>
                  </table>
                 <div class="border-yellow-100 right-0 box-content flex"> {{ $messages->links() }} </div>
                </div>
                </div>
            </div>


            </div>

@endsection
