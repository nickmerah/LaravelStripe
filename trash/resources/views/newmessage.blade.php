@extends('layout')
  
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header"><h5>{{ __('New Message') }}</h5></div>
  
                <div class="card-body">
                <form method="POST"  enctype="multipart/form-data" action="{{ url('sendmessage') }}">
    @csrf
                    @if (session('success'))
                        <div class="alert alert-success" role="alert">
                            {{ session('success') }}
                        </div>
                    @endif
  
                    
                    
                    <div class="navbar-collapse" id="navbarSupportedContent">
                    <div class="dataTable_wrapper">
                      <table class="table table-bordered table-hover" id="dataTables-example">
                        <thead>
      <tr>
        <th><div class="float-right"><a href="{{ route('mymessages') }}"> <strong> All Messages</strong> </a></div> </th>
        </tr>
    </thead>
    <tbody style="font-size:13px">
						  
<tr>
  <td> 
    <textarea name="message" cols="4" rows="4" placeholder="Enter Message" class="form-control" required></textarea>  </td>
  </tr>
 
 

  
  

 
<tr>
        <td> <div align="center">  <button id="button" type="submit" class="btn btn-success" >Send Message  
        </button> </div> </td>
        </tr>
    </tbody>
</table>
                      </div>
  
        </div></form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection