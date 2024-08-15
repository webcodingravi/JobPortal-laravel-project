@extends('front.layouts.app')

@section('content')
<section class="section-5 bg-2">
  <div class="container py-5">
      <div class="row">
          <div class="col">
              <nav aria-label="breadcrumb" class=" rounded-3 p-3 mb-4">
                  <ol class="breadcrumb mb-0">
                      <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Home</a></li>
                      <li class="breadcrumb-item active">Users</li>
                  </ol>
              </nav>
          </div>
      </div>
      <div class="row">
      
          <div class="col-lg-3">
              <div class="card border-0 shadow mb-4 p-3">
                @include('admin.sidebar')
              </div>
          </div>
          <div class="col-lg-9">
            @include('front.alertMessage.alertMessages')
            <div class="card border-0 shadow mb-4 p-3">
              <div class="card-body card-form">
                  <div class="d-flex justify-content-between">
                      <div>
                          <h3 class="fs-4 mb-1">Users</h3>
                      </div>
                    
                      
                  </div>
                  <div class="table-responsive">
                      <table class="table table-striped">
                          <thead class="bg-light bg-dark text-white">
                              <tr>
                                  <th scope="col">Id</th>
                                  <th scope="col">Name</th>
                                  <th scope="col">Email</th>
                                  <th scope="col">Mobile</th>
                                  <th scope="col">Action</th>
                              </tr>
                          </thead>
                          <tbody class="border-0">
                            @if($users->isNotEmpty())
                            @foreach ($users as $user)
                                
                              <tr class="active">
                                <td>{{$user->id}}</td>
                                  <td>
                                      {{$user->name}}
                                  
                                  </td>

                                  <td>
                                 {{$user->email}}

                                </td>
                                <td>
                                 {{$user->mobile}}

                              </td>

                                  <td>
                                      <div class="action-dots">
                                          <button class="btn" data-bs-toggle="dropdown" aria-expanded="false">
                                              <i class="fa fa-ellipsis-v" aria-hidden="true"></i>
                                          </button>
                                          <ul class="dropdown-menu dropdown-menu-end">
                                              <li><a class="dropdown-item" href="{{route('admin.users.edit',$user->id)}}"><i class="fa fa-edit" aria-hidden="true"></i> Edit</a></li>
                                              <li><a class="dropdown-item" href="javascript:void(0);" onclick="deleteUser({{$user->id}})"><i class="fa fa-trash" aria-hidden="true"></i> Delete</a></li>
                                          </ul>
                                      </div>
                                  </td>
                              </tr>
                  
                              @endforeach
                                
                              @endif
                          </tbody>
                          
                      </table>
                  </div>
                  <div class="paginate">
                    {{$users->links('pagination::bootstrap-5')}}
                  </div>
              </div>
          </div>  

                      
          </div>
      </div>
  </div>
</section>
@endsection

@section('customJs')
<script>
  function deleteUser(id) {
    if(confirm('Are You sure you want to delete?')) {
      $.ajax({
         url : '{{route("admin.users.destroy")}}',
         type: 'delete',
         data: {
          "_token" : "{{csrf_token()}}",
          id:id},
         dataType:'json',
         success: function(response) {
             window.location.href="{{route('admin.users')}}";
         }
        });

    }
 
  }
</script>
  
@endsection






