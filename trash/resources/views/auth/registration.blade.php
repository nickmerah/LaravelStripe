@extends('layout')
  
@section('content')
<main class="login-form">
  <div class="cotainer">
      <div class="row justify-content-center">
          <div class="col-md-8">
              <div class="card">
                  <div class="card-header">User Registration</div>
                  <div class="card-body">
  
                      <form action="{{ route('user.create') }}" method="POST">
                          @csrf
                          <div class="form-group row">
                              <label for="fullnames" class="col-md-4 col-form-label text-md-right">Fullnames</label>
                              <div class="col-md-6">
                                  <input type="text"   class="form-control" value="{{ old('fullnames')}}" name="fullnames" required autofocus>
                                  @if ($errors->has('fullnames'))
                                      <span class="text-danger">{{ $errors->first('fullnames') }}</span>
                                  @endif
                              </div>
                          </div>

                          <div class="form-group row">
                              <label for="phoneno" class="col-md-4 col-form-label text-md-right">Phone Number</label>
                              <div class="col-md-6">
                                  <input type="text"   class="form-control" value="{{ old('phoneno')}}" name="phoneno" required>
                                  @if ($errors->has('phoneno'))
                                      <span class="text-danger">{{ $errors->first('phoneno') }}</span>
                                  @endif
                              </div>
                          </div>

    

                          <div class="form-group row">
                              <label for="email_address" class="col-md-4 col-form-label text-md-right">Email</label>
                              <div class="col-md-6">
                                  <input type="email"   class="form-control" value="{{ old('email')}}" name="email" required>
                                  @if ($errors->has('email'))
                                      <span class="text-danger">{{ $errors->first('email') }}</span>
                                  @endif
                              </div>
                          </div>
  
                          <div class="form-group row">
                              <label for="password" class="col-md-4 col-form-label text-md-right">Password</label>
                              <div class="col-md-6">
                                  <input type="password"   class="form-control" name="password" required>
                                  @if ($errors->has('password'))
                                      <span class="text-danger">{{ $errors->first('password') }}</span>
                                  @endif
                              </div>
                          </div>

                          <div class="form-group row">
                              <label for="password_confirm" class="col-md-4 col-form-label text-md-right">Confirm Password</label>
                              <div class="col-md-6">
                                  <input type="password"  class="form-control" name="password_confirm" required>
                                  @if ($errors->has('password_confirm'))
                                      <span class="text-danger">{{ $errors->first('password_confirm') }}</span>
                                  @endif
                              </div>
                          </div>
  
                         
                          <div class="col-md-6 offset-md-4">
                              <button type="submit" class="btn btn-primary">
                                  Register
                              </button>
                          </div>
                          <div class="float-right">
                        <a href="{{ route('home') }}"> <strong> Already Registered? Login</strong> </a>
                      </div>
                      </form>
                        
                  </div>
              </div>
          </div>
      </div>
  </div>
</main>
@endsection