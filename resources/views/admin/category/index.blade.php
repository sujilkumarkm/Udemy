<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
          <b>  All Category </b>
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
            </div>
                <div class="card-header">All Category</div>
                
                <table class="table">
                    <thead>
                      <tr>
                        <th scope="col">Sl No.</th>
                        <th scope="col">Category Name</th>
                        <th scope="col">User</th>
                        <th scope="col">Created_At</th>
                        <th scope="col-2">Action</th>
                      </tr>
                    </thead>
                    {{-- @php($i=1) --}}
                    @foreach ($categories as $category)
                        
                   
                    <tbody>   
                      <tr>
                        
                        {{-- <th scope="row">{{ $i++ }}</th> --}}
                        <th scope="row">{{ $categories->firstItem()+$loop->index }}</th>
                        <td >{{ $category->category_name }}</td>
                        <td>{{ $category->user->name }}</td>

                        {{-- for Query builder join --}}
                        {{-- <td>{{ $category->name }}</td> --}}
                      <td>
                        @if ($category->created_at == NULL) 
                            <span class  "text-danger">No Date Set </span>
                        
                        @else 
                         
                        {{ Carbon\carbon::parse($category-> created_at) -> DiffForHumans() }}</td>
                        
                        <td><a href="{{ url('category/edit/'.$category->id) }}" class="btn btn-info">Edit </a>
                        <a href="{{ url('softdelete/category/'.$category->id) }}" class="btn btn-danger">Delete </a></td>

                      </tr>

                        @endif
                     

                     
                      @endforeach
                    </tbody>
                  </table>
                  {{ $categories->links() }}
                </div>
            
                <div class="col-md-4" >
                    <div class="card-header">Add Category</div>
                    <div class="card-body">
                    <form action="{{ route('store.category') }}" method="post">
                        @csrf
                        <div class="mb-3">
                          <label for="exampleInputEmail1" class="form-label">Category Name</label>
                          <input type="text" name="category_name" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                          @error('category_name')
                              <span class="text-danger">{{ $message }}</span>
                          @enderror
                        </div>
                        
                        <button type="submit" class="btn btn-primary">Submit</button>
                      </form>
                    </div>
                </div>
            </div>


            </div>





















{{-- Trash Part --}}



            <div class="container">
              <div class="row">
              <div class="col-md-8" >
              <div class="card">
                  
  
              </div>
                  <div class="card-header">Trash List</div>
                  
                  <table class="table">
                      <thead>
                        <tr>
                          <th scope="col">Sl No.</th>
                          <th scope="col">Category Name</th>
                          <th scope="col">User</th>
                          <th scope="col">Created_At</th>
                          <th scope="col-2">Action</th>
                        </tr>
                      </thead>
                      {{-- @php($i=1) --}}
                      @foreach ($trachCat  as $category)
                          
                     
                      <tbody>   
                        <tr>
                          
                          {{-- <th scope="row">{{ $i++ }}</th> --}}
                          <th scope="row">{{ $categories->firstItem()+$loop->index }}</th>
                          <td >{{ $category->category_name }}</td>
                          <td>{{ $category->user->name }}</td>
  
                          {{-- for Query builder join --}}
                          {{-- <td>{{ $category->name }}</td> --}}
                        <td>
                          @if ($category->created_at == NULL) 
                              <span class  "text-danger">No Date Set </span>
                          
                          @else 
                           
                          {{ Carbon\carbon::parse($category-> created_at) -> DiffForHumans() }}</td>
                          
                          <td><a href="{{ url('category/restore/'.$category->id) }}" class="btn btn-info">Restore </a>
                          <a href="{{ url('category/pdelete/'.$category->id) }}" class="btn btn-danger">Permenant Delete </a></td>
  
                        </tr>
  
                          @endif
                       
  
                       
                        @endforeach
                      </tbody>
                    </table>
                    {{ $trachCat->links() }}
                  </div>
              
                  
              </div>
  
              <div class="col-md-4">
              
              </div>
              </div>


{{-- End Trash --}}



        </div>

</x-app-layout>
