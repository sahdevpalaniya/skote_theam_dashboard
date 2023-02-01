@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-7">
            <div class="text-primary p-4">
                <h5 class="text-primary"> Reset Password</h5>
                <p>Re-Password with Skote.</p>
            </div>
        </div>
        <div class="col-5 align-self-end">
            <img src="{{ asset('assets/images/profile-img.png') }}" alt="" class="img-fluid">
        </div>
    </div>
    </div>
    <div class="card-body pt-0">
        <div>
            <a href="">
                <div class="avatar-md profile-user-wid mb-4">
                    <span class="avatar-title rounded-circle bg-light">
                        <img src="{{ asset('assets/images/logo.svg') }}" alt="" class="rounded-circle" height="34">
                    </span>
                </div>
            </a>
        </div>

        <div class="p-2">
            @if (session('status'))
                <div class="alert alert-success" role="alert">
                    {{ session('status') }}
                </div>
            @endif

            <form method="POST" action="{{ route('password.email') }}">
                @csrf

                <div class="mb-3">
                    <label for="useremail" class="form-label">Email</label>
                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                        name="email" value="{{ old('email') }}" required autocomplete="email" autofocus placeholder="Enter Email Address">

                    @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="text-end">
                    <button class="btn btn-primary w-md waves-effect waves-light" type="submit">Reset</button>
                </div>

            </form>
        </div>

    </div>
    </div>
    <div class="mt-5 text-center">
        <p>Remember It ? <a href="{{ route('login') }}" class="fw-medium text-primary"> Sign In here</a> </p>
        <p>©
            <script>
                document.write(new Date().getFullYear())
            </script> Skote. Crafted with <i class="mdi mdi-heart text-danger"></i> by Themesbrand
        </p>
    </div>
@endsection
