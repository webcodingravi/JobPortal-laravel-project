@extends('front.layouts.app')

@section('content')
<section class="section-5 bg-2">
  <div class="container py-5">
      <div class="row">
          <div class="col">
              <nav aria-label="breadcrumb" class=" rounded-3 p-3 mb-4">
                  <ol class="breadcrumb mb-0">
                      <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Home</a></li>
                      <li class="breadcrumb-item active">Jobs</li>
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
                          <h3 class="fs-4 mb-1">Jobs</h3>
                      </div>
                    
                      
                  </div>
                  <div class="table-responsive">
                      <table class="table table-striped">
                          <thead class="bg-light bg-dark text-white">
                              <tr>
                                  <th scope="col">Id</th>
                                  <th scope="col">Title</th>
                                  <th scope="col">Create By</th>
                                  <th scope="col">status</th>
                                  <th scope="col">Date</th>
                                  <th scope="col">Action</th>
                              </tr>
                          </thead>
                          <tbody class="border-0">
                            @if($jobs->isNotEmpty())
                            @foreach ($jobs as $job)
                            
                                
                              <tr class="active">
                                <td>{{$job->id}}</td>
                                  <td>
                                    <p>{{$job->title}}</p>
                                    <p>Applicants: {{$job->applications->count()}}</p>
                                  </td>
                                  <td>{{$job->user->name}}</td>
                                  <td>
                                    @if($job->status == 1)
                                      <span class="badge bg-success">Active</span>
                                      @else
                                      <span class="badge bg-danger">Deactive</span>
                                    @endif
                                  </td>
                                <td>{{\Carbon\Carbon::parse($job->created_at)->format('d M,Y')}}</td>
                                  <td>
                                      <div class="action-dots">
                                          <button class="btn" data-bs-toggle="dropdown" aria-expanded="false">
                                              <i class="fa fa-ellipsis-v" aria-hidden="true"></i>
                                          </button>
                                          <ul class="dropdown-menu dropdown-menu-end">
                                              <li><a class="dropdown-item" href="{{route('admin.jobs.edit',$job->id)}}"><i class="fa fa-edit" aria-hidden="true"></i> Edit</a></li>
                                              <li><a class="dropdown-item" href="javascript:void(0);" onclick="deleteJob({{$job->id}})"><i class="fa fa-trash" aria-hidden="true"></i> Delete</a></li>
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
                    {{$jobs->withQueryString()->links('pagination::bootstrap-5')}}
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
  function deleteJob(id) {
    if(confirm('Are You sure you want to delete?')) {
      $.ajax({
         url : '{{route("admin.jobs.destroy")}}',
         type: 'delete',
         data: {
          "_token" : "{{csrf_token()}}",
          id:id},
         dataType:'json',
         success: function(response) {
             window.location.href="{{route('admin.jobs')}}";
         }
        });

    }
 
  }
</script>
  
@endsection






