<x-layout/>
<div class="register-box">
<div class="card">
  <div class="card-body register-card-body">
    <p class="login-box-msg">Login</p>

    <form action="/auth" method="POST">
      @csrf
      <div class="input-group mb-3">
      <div class="input-group mb-3">
        <input type="email" name="email" value="{{old('email')}}" class="form-control" placeholder="Email">
        <div class="input-group-append">
          <div class="input-group-text">
            <span class="fas fa-envelope"></span>
          </div>
        </div>
      </div>
      @error('email')
      <p style="color: red" class="text-red-500 text-xs mt-1">{{$message}}</p>
      @enderror
      <div class="input-group mb-3">
        <input type="password" name="password" class="form-control" placeholder="Password">
        <div class="input-group-append">
          <div class="input-group-text">
            <span class="fas fa-lock"></span>
          </div>
        </div>
      </div>
      @error('password')
      <p style="color: red" class="text-red-500 text-xs mt-1">{{$message}}</p>
      @enderror
      {{-- <div class="input-group mb-3">
        <input type="password" class="form-control" placeholder="Retype password">
        <div class="input-group-append">
          <div class="input-group-text">
            <span class="fas fa-lock"></span>
          </div>
        </div>
      </div> --}}
      {{-- <div class="row"> --}}
        <!-- /.col -->
        <div class="col-4">
          <button type="submit"  class="inline-block px-6 py-2.5 bg-blue-600 text-white font-medium text-xs leading-tight uppercase rounded shadow-md hover:bg-blue-700 hover:shadow-lg focus:bg-blue-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-blue-800 active:shadow-lg transition duration-150 ease-in-out">Login</button>
        {{-- </div> --}}
        <!-- /.col -->
      </div>
    </form>

    <a href="/" class="text-center">I am new here!!</a>
  </div>
  <!-- /.form-box -->
</div><!-- /.card -->
</div>