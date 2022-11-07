@extends('layout')

@section('content')


    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header"><h5>


                           My Payment

                        </h5></div>

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


                        <div class="navbar-collapse" id="navbarSupportedContent">
                            <div class="dataTable_wrapper">
                                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                    <thead>

                                    <tr>
                                        <th colspan="7">
                                            <div class="float-right">  <button class="btn btn-outline-primary btn-sm" data-toggle="modal" data-target="#addModal" ><i class="fa fa-plus"> Make Payment </i></button> </th>
                                    </tr>

                                    </thead>
                                    <tbody style="font-size:14px">

                                    <tr>
                                        <td width="5%"><span class="fieldarea"><strong>S/N</strong></span></td>
                                        <td width="15%"><span class="fieldarea"><strong>Date</strong></span></td>
                                        <td width="5%"><span class="fieldarea"><strong>TransID</strong></span></td>
                                        <td width="15%"><span class="fieldarea"><strong>Description</strong></span></td>
                                        <td width="5%"><span class="fieldarea"><strong>Amount</strong></span></td>
                                        <td width="5%"><span class="fieldarea"><strong>Status</strong></span> </td>
                                        <td width="5%"><span class="fieldarea"><strong>Action</strong></span> </td>

                                    </tr>
                                    @foreach ($alltransactions as $alltransaction)
                                        <tr>
                                            <td> {{$loop->iteration}}</td>

                                            <td> {{ $alltransaction->transdate  }} </td>
                                            <td> {{ $alltransaction->transid  }} </td>
                                            <td>  {{ $alltransaction->transname  }} </td>
                                            <td> {{ $alltransaction->amount  }} </td>
                                            <td>  {{ $alltransaction->status  }} </td>
                                            <td>
                                                @php if ( $alltransaction->status != 'Paid') { @endphp
                                                <form  method="POST" action="{{ url('makepayment') }}">
                                                    @csrf
                                                    <input name="transid" type="hidden" value="{{$alltransaction->id}}">

                                                <button class="btn btn-outline-success btn-sm" type="submit"><i class="fa fa-money"> Pay Now</i>
                                                </button>
                                                </form>
    @php }else{ echo $alltransaction->status; }



    @endphp


                                            </td>

                                           </tr> @endforeach


                                       </tbody>
                                   </table>
                               </div>

                           </div>

                           <!-- Add Modal -->
                           <form method="POST"  action="{{ url('mypayment') }}">
                               <div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                   <div class="modal-dialog" role="document">
                                       <div class="modal-content">
                                           <div class="modal-header">
                                               <h5 class="modal-title" id="exampleModalLabel">{{ __('Make Payment') }}</h5>
                                               <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                   <span aria-hidden="true">&times;</span>
                                               </button>
                                           </div>
                                           <div class="modal-body">

                                               @csrf
                                               <div class="form-group">
                                                   <label for="pgname-name" class="col-form-label">Description:</label>
                                                   <input type="text" class="form-control"   name="transname" required>

                                               </div>

                                               <div class="form-group">
                                                   <label for="pgdescription-name" class="col-form-label">Amount:</label>
                                                   <input type="text"  class="form-control" name="amount" required>

                                               </div>


                                           </div>
                                           <div class="modal-footer">
                                               <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                               <button type="submit" class="btn btn-primary">Add Payment Gateway</button>
                                           </div>
                                       </div>
                                   </div>
                               </div>
                           </form>


                       </div>
                   </div>
               </div>
           </div>
       </div>

   @endsection
