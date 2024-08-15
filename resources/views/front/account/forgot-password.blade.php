@extends('front.layouts.app')

@section('content')
<section class="section-5">
  <div class="container my-5">
      <div class="py-lg-2">&nbsp;</div>
      <div class="row d-flex justify-content-center">
        <div class="col-md-12">
          @include('front.alertMessage.alertMessages')
        </div>
          <div class="col-md-5">
              <div class="card shadow border-0 p-5">
                  <h1 class="h3">Forgot Password</h1>
                  <form action="{{ route('account.processForgotPassword') }}"  method="post">
                    @csrf
                      <div class="mb-3">
                          <label for="" class="mb-2">Email*</label>
                          <input type="text" value="{{old('email')}}" name="email" id="email" class="form-control @error('email') is-invalid @enderror" placeholder="example@example.com">
                          @error('email')
                            <span class="invalid-feedback">
                              {{$message}}
                            </span>
                          @enderror
                      </div> 
                     
                      <div class="justify-content-between d-flex">
                      <button class="btn btn-primary mt-2">Send</button>
                          {{-- <a href="" class="mt-3">Forgot Password?</a> --}}
                      </div>
                  </form>                    
              </div>
              <div class="mt-4 text-center">
                  <p>Do not have an account? <a  href="{{route('account.login')}}">Back to Login</a></p>
              </div>
          </div>
      </div>
      <div class="py-lg-5">&nbsp;</div>
  </div>
</section>
  
@endsection

