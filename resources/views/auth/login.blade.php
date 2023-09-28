@extends('layout.master2')

@section('content')
<div class="page-content d-flex align-items-center justify-content-center">

  <div class="row w-100 mx-0 auth-page">
    <div class="col-md-8 col-xl-6 mx-auto">
      <div class="card">
        <div class="row">
          <div class="col-md-4 pe-md-0">
            <div class="auth-side-wrapper" style="background-image: url({{ url('https://via.placeholder.com/219x452') }})">

            </div>
          </div>
          <div class="col-md-8 ps-md-0">
            <div class="auth-form-wrapper px-4 py-5">
              <a href="#" class="noble-ui-logo d-block mb-2">CHAT<span>APP</span></a>
              @if($errors->any())
                <div class="invalid-feedback">
                  {{ $errors->first() }}
                </div>
              @endif
              <form class="forms-sample" method="POST" action="{{ route('login') }}">
                @csrf
                <div class="mb-3">
                  <label for="email" class="form-label">Email</label>
                  <input type="email" name="email" class="form-control @if($errors->has('email')) is-invalid @endif" id="email" placeholder="email" required>
                  @if($errors->has('email'))
                    <div id="email" class="invalid-feedback">
                      {{ $errors->first('email') }}
                    </div>
                  @endif
                </div>
                <div class="mb-3">
                  <label for="password" class="form-label">Password</label>
                  <input type="password" name="password" class="form-control @if($errors->has('password')) is-invalid @endif" id="password" autocomplete="current-password" placeholder="Password" required>
                  @if($errors->has('password'))
                    <div id="password" class="invalid-feedback">
                      {{ $errors->first('password') }}
                    </div>
                  @endif
                </div>
                <div>
                  <button class="btn btn-primary me-2 mb-2 mb-md-0">Login</button>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

</div>
@endsection