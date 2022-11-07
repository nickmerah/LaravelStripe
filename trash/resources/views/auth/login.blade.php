@extends('layout')
  
@section('content')
<main class="login-form">
  <div class="cotainer">
      <div class="row justify-content-center">
          <div class="col-md-8">
              <div class="card">
                  <div class="card-header">User Login</div>
                  <div class="card-body">

                  @if (session('success'))
                        <div class="alert alert-success" role="alert">
                            {{ session('success') }}
                        </div>
                    @endif
                    
                  @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
        
            @foreach ($errors->all() as $error)
                {{ $error }}  <br>
            @endforeach
            
        </ul>
    </div>
@endif
                      <form action="{{ route('login.post') }}" method="POST" autocomplete="off">
                          @csrf
                          <div class="form-group row">
                              <label for="email_address" class="col-md-4 col-form-label text-md-right">Email</label>
                              <div class="col-md-6">
                                  <input type="text" value="{{ old('email')}}"  class="form-control" name="email" required autofocus>
                                  @if ($errors->has('email'))
                                      <span class="text-danger">{{ $errors->first('email') }}</span>
                                  @endif
                              </div>
                          </div>
  
                          <div class="form-group row">
                              <label for="password" class="col-md-4 col-form-label text-md-right">PassKey</label>
                              <div class="col-md-6">
                                  <input type="password" id="password" class="form-control" name="password" required>
                                  @if ($errors->has('password'))
                                      <span class="text-danger">{{ $errors->first('password') }}</span>
                                  @endif
                              </div>
                          </div>
  
                          <div class="float-right">
                        <a href="{{ route('register') }}"> <strong> Not a User? Register</strong> </a>
                      </div>
  
                          <div class="col-md-6 offset-md-4">
                              <button type="submit" class="btn btn-primary">
                                  Login
                              </button>
                          </div>
                          
                      </form>
                        
                  </div>
              </div>
          </div>
      </div>
  </div>
</main>
@endsection