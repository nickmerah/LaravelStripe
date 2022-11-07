@extends('layout')
  
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header"><h5>{{ __('User Details') }}</h5></div>
  
                <div class="card-body">
                    @if (session('success'))
                        <div class="alert alert-success" role="alert">
                            {{ session('success') }}
                        </div>
                    @endif
                    <div class="navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ml-auto">
            <li class="nav-item"> <strong>Fullnames:</strong> {{ ($user->fullnames) }}</li>
            <br>
            <li class="nav-item"> <strong>Phone No:</strong> {{ ($user->phoneno) }}</li>
            <br>
            <li class="nav-item"> <strong>Email:</strong> {{ ($user->email) }}</li>
            <br>
            <li class="nav-item"> <strong>Status:</strong> @if ($user->isActive == 0)
   Pending
@else
  Active
@endif</li>
                
            </ul>
  
        </div>
<br> 
 
                    
                    <div class="navbar-collapse" id="navbarSupportedContent">
                    <div class="dataTable_wrapper">
                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
    <thead>
      <tr>
        <th colspan="3"> <div class="float-left"><h6>{{ ($user->fullnames) }}'s {{ __('Messages') }}</h6></div> </th>
        </tr>
    </thead>
    <tbody style="font-size:14px">
						  
<tr>
  <td width="10%"><span class="fieldarea"><strong>S/N</strong></span></td>
  <td width="60%"><span class="fieldarea"><strong>Messages</strong></span> </td>
  <td width="30%"><span class="fieldarea"><strong>Date/Time </strong></span></td>
  </tr>
  @foreach ($messages as $message)
<tr>
  <td> {{$loop->iteration}}</td>
  <td> {{ $message->message  }}</td>
  <td>{{ date('d-M-Y H:i:s', strtotime($message->date_sent))  }}</td>
  </tr> @endforeach  
    </tbody>
  </table>
                        </div>
  
        </div>  
                </div>
            </div>
        </div>
    </div>
</div>
@endsection