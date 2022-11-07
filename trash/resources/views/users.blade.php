@extends('layout')
  
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header"><h5>{{ __('Users') }}</h5></div>
  
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
      <tr>
        <th colspan="7"> 
            
        <form method="POST" action="{{ url('users') }}">
        @csrf
        <div><strong>  User Status</strong> <select name="ustatus" >
    <option value="">All</option>
    <option value="1">Active</option>
    <option value="0">Pending</option>
  </select>  <button id="button" type="submit" class="btn btn-success" >Filter</i>
                            </button> </div>
    
</form>
    
    </th>
        </tr>
    </thead>
    <tbody style="font-size:14px">
						  
<tr>
  <td width="5%"><span class="fieldarea"><strong>S/N</strong></span></td>
  <td width="30%"><span class="fieldarea"><strong>Fullnames</strong></span> </td>
  <td width="10%"><span class="fieldarea"><strong>PhoneNo</strong></span></td>
  <td width="25%"><span class="fieldarea"><strong>Email</strong></span></td>
  <td width="10%"><span class="fieldarea"><strong>Status</strong></span></td>
  <td width="25%"><span class="fieldarea"><strong>Action</strong></span></td>
 
  </tr>
  @foreach ($users as $user)
<tr>
  <td> {{$loop->iteration}}</td>
  <td> {{ $user->fullnames  }}</td>
  <td>{{ $user->phoneno  }}</td>
  <td>{{ $user->email  }}</td>
  <td> 
  @if ($user->isActive == 0)
   Pending
@else
  Active
@endif
 

  </td>
  <td><a href="{{URL::to('/viewuser/'.$user->id) }}">
                                                   View
                                                </a> | 
                                                <a href="{{URL::to('/updateuser/'.$user->id.'/'.$user->isActive) }}"> 
                                                @if ($user->isActive == 0)
   Enable
@else
  Disable
@endif  </a> </td>
  
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