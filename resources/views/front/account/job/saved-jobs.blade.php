@extends('front.layouts.app')

@section('content')
<section class="section-5 bg-2">
  <div class="container py-5">
      <div class="row">
          <div class="col">
              <nav aria-label="breadcrumb" class=" rounded-3 p-3 mb-4">
                  <ol class="breadcrumb mb-0">
                      <li class="breadcrumb-item"><a href="#">Home</a></li>
                      <li class="breadcrumb-item active">Account Settings</li>
                  </ol>
              </nav>
          </div>
      </div>
      <div class="row">
            @include('front.alertMessage.alertMessages')
         @include('front.account.sidebar')
          <div class="col-lg-9">
            <div class="card border-0 shadow mb-4 p-3">
              <div class="card-body card-form">
                  <div class="d-flex justify-content-between">
                      <div>
                          <h3 class="fs-4 mb-1">Saved Jobs</h3>
                      </div>
                      <div style="margin-top: -10px;">
                          <a href="{{route('account.createJob')}}" class="btn btn-primary">Post a Job</a>
                      </div>
                      
                  </div>
                  <div class="table-responsive">
                      <table class="table table-striped">
                          <thead class="bg-light bg-dark text-white">
                              <tr>
                                  <th scope="col">Title</th>
                                  <th scope="col">Applicants</th>
                                  <th scope="col">Status</th>
                                  <th scope="col">Action</th>
                              </tr>
                          </thead>
                          <tbody class="border-0">
                            @if ($saveJobs->isNotEmpty())
                            @foreach ($saveJobs as $saveJob)
                                
                              <tr class="active">
                                  <td>
                                      <div class="job-name fw-500">{{$saveJob->job->title}}</div>
                                      <div class="info1">{{$saveJob->job->jobType->name}} . {{$saveJob->job->location}}</div>
                                  </td>
                                  <td>{{$saveJob->job->applications->count()}} Applications</td>
                                  <td>
                                    @if ($saveJob->job->status == 1)
                                    <div class="job-status text-capitalize">active</div>

                                    @else
                                    <div class="job-status text-capitalize">Deactive</div>

                                    @endif
                                  </td>
                                  <td>
                                      <div class="action-dots">
                                          <button class="btn" data-bs-toggle="dropdown" aria-expanded="false">
                                              <i class="fa fa-ellipsis-v" aria-hidden="true"></i>
                                          </button>
                                          <ul class="dropdown-menu dropdown-menu-end">
                                              <li><a class="dropdown-item" href="{{route('front.jobDetail',$saveJob->job_id)}}"> <i class="fa fa-eye" aria-hidden="true"></i> View</a></li>
                                              <li><a class="dropdown-item" href="javascript:void(0)" onclick="removeJob({{$saveJob->id}})"><i class="fa fa-trash" aria-hidden="true"></i> Delete</a></li>
                                          </ul>
                                      </div>
                                  </td>
                              </tr>
                  
                              @endforeach

                              @else
                              <tr><td colspan="5">Job Not Found</td></tr>
                                
                              @endif
                          </tbody>
                          
                      </table>
                  </div>
                  <div class="paginate">
                    {{$saveJobs->links('pagination::bootstrap-5')}}
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

    function removeJob(id) {
        if(confirm("Are you sure you want to delete?")) {
         $.ajax({
            url : '{{route("account.removeSaveJob")}}',
            type: 'post',
            data: {
                "_token" : "{{csrf_token()}}",
                id: id},
            dataType: 'json',
            success: function(response) {
              window.location.href='{{route("account.savedJobs")}}';
            }
         });

        }
    }
</script>

<script>


</script>
    
@endsection