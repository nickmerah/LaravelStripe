@extends('layout')
  
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header"><h5>@if ($isAdmin)
                User Messages
@else
My Message
@endif
 </h5></div>
  
                <div class="card-body">
                    @if (session('success'))
                        <div class="alert alert-success" role="alert">
                            {{ session('success') }}
                        </div>
                    @endif
  
                    
                    
                    <div class="navbar-collapse" id="navbarSupportedContent">
                    <div class="dataTable_wrapper">
                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
    <thead>
    @if (!$isAdmin)
      <tr>
        <th colspan="4"> 
    <div class="float-right"><a href="{{ route('new.message') }}"> <strong> Send New Message</strong> </a></div> </th>
        </tr>
        @endif
    </thead>
    <tbody style="font-size:14px">
						  
<tr>
  <td width="5%"><span class="fieldarea"><strong>S/N</strong></span></td>
  @if ($isAdmin)
  <td width="30%"><span class="fieldarea"><strong>Fullname </strong></span></td>
  @endif
  <td width="25%"><span class="fieldarea"><strong>Date/Time </strong></span></td>
  <td width="60%"><span class="fieldarea"><strong>Messages</strong></span> </td>

  </tr>
  @foreach ($messages as $message)
<tr>
  <td> {{$loop->iteration}}</td>
  @if ($isAdmin)
  <td> {{ $message->fullname  }}</td>
  @endif
  <td>{{ date('d-M-Y H:i:s', strtotime($message->date_sent))  }}</td>
  <td> {{ $message->message  }}</td>
  
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