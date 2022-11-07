@extends('layout')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header"><h5>{{ __('Dashboard') }} </h5></div>

                <div class="card-body">
                    @if (session('success'))
                        <div class="alert alert-success" role="alert">
                            {{ session('success') }}
                        </div>
                    @endif

                    @if (session('error'))
                        <div class="alert alert-danger" role="alert">
                            {{ session('error') }}
                        </div>
                    @endif

                     <h6> Welcome! {{ ($user->fullnames) }} </h6>

                    <div class="navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ml-auto">
            <br>
            <li class="nav-item"> <b>Phone No: </b> {{ ($user->phoneno) }}</li>
            <br>
            <li class="nav-item"> <b>Email:</b>  {{ ($user->email) }}</li>

            </ul>

        </div>


                </div>
            </div>
        </div>
    </div>
</div>
@endsection
