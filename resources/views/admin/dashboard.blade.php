@extends('front.layouts.app')

@section('content')
<section class="section-5 bg-2">
  <div class="container py-5">
      <div class="row">
          <div class="col">
              <nav aria-label="breadcrumb" class=" rounded-3 p-3 mb-4">
                  <ol class="breadcrumb mb-0">
                      <li class="breadcrumb-item"><a href="#">Home</a></li>
                      <li class="breadcrumb-item active">Dashboard</li>
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
              <div class="card border-0 shadow mb-4">
                @include('front.alertMessage.alertMessages')
                 <div class="card-body dashboard">
                 <p class="h2"> Welcome Administrator!</p>
                 </div>

              </div>

                      
          </div>
      </div>
  </div>
</section>
@endsection






