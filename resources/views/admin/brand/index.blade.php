<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
          <b>  All Brand </b>
                  </h2>
    </x-slot>

    <div class="py-12">
       
        <div class="container">
            <div class="row">
            <div class="col-md-8" >
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
                <div class="card-header">All Brand</div>
                
                <table class="table">
                    <thead>
                      <tr>
                        <th scope="col">Sl No.</th>
                        <th scope="col">Brand Name</th>
                        <th scope="col">Brand Image</th>
                        <th scope="col">Created_At</th>
                        <th scope="col-2">Action</th>
                      </tr>
                    </thead>
                    {{-- @php($i=1) --}}
                    @foreach ($brands as $brand)
                        
                    <tbody>   
                      <tr>
                        {{-- <th scope="row">{{ $i++ }}</th> --}}
                        <th scope="row">{{ $brands->firstItem()+$loop->index }}</th>
                        <td >{{ $brand->brand_name }}</td>
                        <td><img src={{ $brand->brand_image }} style="height:40px; width:70px;" alt=""></td>
                       {{-- {{  dd($brand->brand_image) }} --}}
                        {{-- for Query builder join --}}
                        {{-- <td>{{ $category->name }}</td> --}}
                      <td>
                        @if ( $brand->created_at == NULL) 
                            <span class  "text-danger">No Date Set </span>
                        
                        @else 
                         
                        {{ Carbon\carbon::parse($brand-> created_at) -> DiffForHumans() }}</td>
                        
                        <td><a href="{{ url('brand/edit/'.$brand->id) }}" class="btn btn-info">Edit </a>
                        <a href="{{ url('brand/delete/'.$brand->id) }}" onclick="return confirm('Are you sure to delete ?');" class="btn btn-danger">Delete </a></td>

                      </tr>

                        @endif
                     

                     
                      @endforeach
                    </tbody>
                  </table>
                  {{ $brands->links() }}
                </div>
            
                <div class="col-md-4" >
                    <div class="card-header">Add Brand</div>
                    <div class="card-body">
                    <form action="{{ route('store.brand') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                          <label for="exampleInputEmail1" class="form-label">Brand Name</label>
                          <input type="text" name="brand_name" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                          @error('brand_name')
                              <span class="text-danger">{{ $message }}</span>
                          @enderror
                        </div>
                              <label for="exampleInputEmail1" class="form-label">Brand Image</label>
                              <input type="file" name="brand_image" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                              @error('brand_image')
                                  <span class="text-danger">{{ $message }}</span>
                              @enderror
                              <button type="submit" class="btn btn-primary">Add Brand</button>
                            </form>
                            </div>
                            
                        
                        </div>



                </div>
            </div>


            </div>

        </div>

</x-app-layout>
