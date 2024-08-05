@extends('layouts.empty')

@section('main-content')
<section class="text-center pb-5">
  <!-- Background image -->
  <div class="p-5 bg-image" style="
        background-image: url('https://images.unsplash.com/photo-1595878715977-2e8f8df18ea8?q=80&w=1587&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D');
        height: 300px;
        "></div>
  <!-- Background image -->

  <div class="card mx-4 mx-md-5 shadow-5-strong" style="
        margin-top: -100px;
        background: hsla(0, 0%, 100%, 0.7);
        backdrop-filter: blur(30px);
        ">
    <div class="card-body py-5 px-md-5">
      
      <a href="/" class="text-decoration-none text-white position-absolute top-0 start-0 m-3"><h2><i class="bi bi-arrow-left-circle text-dark"></i></h2></a>
      <div class="row d-flex justify-content-center">
        <div class="col-lg-4">
          <h2 class="fw-bold mb-5">Sign in Now</h2>

          @if(session('success'))
            <div class="alert alert-success">
              {{ session('success') }}
            </div>
          @endif

          @if ($errors->any())
            <div class="alert alert-danger">
              <ul>
                @foreach ($errors->all() as $error)
                  <li>{{ $error }}</li>
                @endforeach
              </ul>
            </div>
          @endif
          <form action='/login' method="post">
            @csrf
            <!-- Username input -->
            <div class="form-floating mb-3">
              <input type="text" class="form-control" id="floatingInputUsername" placeholder="example" name="username" value="{{ old('username') }}">
              <label for="floatingInputUsername">Username</label>
            </div>

            <!-- Password input -->
            <div class="form-floating mb-3 position-relative">
              <input type="password" class="form-control" id="floatingInputPassword" placeholder="example" name="password">
              <label for="floatingInputPassword">Password</label>
              <span class="position-absolute end-0 top-50 translate-middle-y me-3" id="togglePassword" style="cursor: pointer;">
                <i class="bi bi-eye-slash" id="eyeIcon"></i>
              </span>
            </div>

            <!-- Submit button -->
            <button type="submit" class="btn btn-primary btn-block mb-4">
              Sign in
            </button>

            <p>Not registered yet? <a href="/register">Register now!</a></p>
          </form>
        </div>
      </div>
    </div>
  </div>
</section>

<script>
document.getElementById('togglePassword').addEventListener('click', function (e) {
  const passwordInput = document.getElementById('floatingInputPassword');
  const eyeIcon = document.getElementById('eyeIcon');
  if (passwordInput.type === 'password') {
    passwordInput.type = 'text';
    eyeIcon.classList.remove('bi-eye-slash');
    eyeIcon.classList.add('bi-eye');
  } else {
    passwordInput.type = 'password';
    eyeIcon.classList.remove('bi-eye');
    eyeIcon.classList.add('bi-eye-slash');
  }
});
</script>

@endsection
