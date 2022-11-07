@extends('layout')

@section('content')

    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header"><h5>


                            Payment Methods

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

                                    <tr>
                                        <th colspan="6">
                                            <div class="float-right">  <button class="btn btn-outline-primary btn-sm" data-toggle="modal" data-target="#addModal" ><i class="fa fa-plus"> Add New </i></button> </th>
                                    </tr>

                                    </thead>
                                    <tbody style="font-size:14px">

                                    <tr>
                                        <td width="5%"><span class="fieldarea"><strong>S/N</strong></span></td>
                                        <td width="15%"><span class="fieldarea"><strong>Name</strong></span></td>
                                        <td width="30%"><span class="fieldarea"><strong>Description</strong></span></td>
                                        <td width="8%"><span class="fieldarea"><strong>Charges</strong></span> </td>
                                        <td width="15%"><span class="fieldarea"><strong>Status</strong></span> </td>
                                        <td width="20%"><span class="fieldarea"><strong>Action</strong></span> </td>

                                    </tr>
                                    @foreach ($paymentmethods as $paymentmethod)
                                        <tr>
                                            <td> {{$loop->iteration}}</td>
                                            <input id="id{{$paymentmethod->id}}" type="hidden" value="{{ $paymentmethod->id}}" />


                                            <td> {{ $paymentmethod->pname  }} </td>
                                            <td>  {{ $paymentmethod->pdescription  }} </td>
                                            <td>  {{ $paymentmethod->pcharges  }} </td>
                                            <td> @php if (  $paymentmethod->setdefault == 0 ) { @endphp
                                                <form method="POST" action="{{ route('paymentdefaultupdate', $paymentmethod->id ) }}" >
                                                    @method('PATCH')  @csrf
                                                    <button class='btn btn-outline-danger btn-sm' onclick='return confirm("Are you sure, you want to set as Default?")'><i class='fa fa-key'> Set As Default</i></button>
                                                </form> @php } else { echo  "<b style='color:green'>Default</b>"   ; }   @endphp </td>
                                            <td> <button class="btn btn-outline-primary btn-sm" data-id="{{ $paymentmethod->id }}" data-toggle="modal"   id="paymentEdit" ><i class="fa fa-edit"> Edit</i></button>



                                                </a>

                                            </td>

                                        </tr> @endforeach


                                    </tbody>
                                </table>
                            </div>

                        </div>

                        <!-- Add Modal -->
                        <form method="POST"  action="{{ url('paymentmethod') }}">
                            <div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">{{ __('Add New Payment Method') }}</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">

                                            @csrf
                                            <div class="form-group">
                                                <label for="category-name" class="col-form-label">Name:</label>
                                                <input type="text" class="form-control"   name="pname" required>

                                            </div>

                                            <div class="form-group">
                                                <label for="category-name" class="col-form-label">Description:</label>
                                                <input type="text"  class="form-control" name="pdescription" required>

                                            </div>

                                            <div class="form-group">
                                                <label for="category-name" class="col-form-label">Charges:</label>
                                                <input type="text" class="form-control" name="pcharges" required>

                                            </div>



                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                            <button type="submit" class="btn btn-primary">Add Payment Method</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                        <!-- End Add Modal -->


                        <!-- Edit Modal -->


                        <div class="modal fade" id="editModal" tabindex="-1" role="dialog"
                             aria-labelledby="formModal" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">{{ __('Update Payment Method') }}</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">

                                        <div class="form-group">
                                            <label for="category-name" class="col-form-label">Name:</label>
                                            <input type="text" class="form-control" id="pname"   name="pname" required>

                                        </div>

                                        <div class="form-group">
                                            <label for="category-name" class="col-form-label">Description:</label>
                                            <input type="text"  class="form-control" id="pdescription" name="pdescription" required>

                                        </div>

                                        <div class="form-group">
                                            <label for="category-name" class="col-form-label">Charges:</label>
                                            <input type="text" class="form-control" id="pcharges" name="pcharges" required>

                                        </div>
                                        <input name="pid" type="hidden" id="pid">



                                    </div>
                                    <div class="modal-footer">

                                         <button type="button" id="paymth-delete" class="btn btn-danger" data-dismiss="modal" onclick='return confirm("Are you sure, you want to delete this Payment Method?")'> <i class="fa fa-trash"> Delete</i></button>
                                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                        <button type="button" class="btn btn-warning" data-dismiss="modal">Close</button>
                                        <button type="button" class="btn btn-primary"  id="paymth-update">Update Payment Method</button>


                                    </div>

                                </div>
                            </div>
                        </div>

                        <!-- End Edit Modal -->
                        <script type="text/javascript">
                            $(document).on('click', '#paymentEdit', function (e) {
                                e.preventDefault();
                                var pid = $(this).data('id');
                                // console.log(pid);
                                let _token   = $('meta[name="csrf-token"]').attr('content');
                                //console.log(_token);
                                $.ajax({
                                    url:"{{url('paymentmethod')}}/"+pid,
                                    type:"GET",
                                    data:{
                                        id:pid,
                                        _token: _token
                                    },

                                    success: function (response) {
                                        //  console.log(response);
                                        $('#editModal').modal('show');
                                        if (response.done == true) {
                                            $('#pname').val(response.pname);
                                            $('#pdescription').val(response.pdescription);
                                            $('#setdefault').val(response.setdefault);
                                            $('#pcharges').val(response.pcharges);
                                            $('#pid').val(pid);
                                            $('#delid').val(pid);
                                        } else {
                                            $('.edit_response').html('<div class="alert bg-danger alert-dismissable" role="alert"><em class="fa fa-lg fa-warning">&nbsp;</em>' + response.data + '</div>');
                                        }
                                    }
                                });
                            });

                            //update
                            $('body').on('click', '#paymth-update', function () {
                                let _token   = $('meta[name="csrf-token"]').attr('content');
                                var pid = $('#pid').val();
                                var pname = $('#pname').val();
                                var pdescription = $('#pdescription').val();
                                var pcharges = $('#pcharges').val();

                                $.ajax({
                                    url:"{{url('paymentmethod')}}/"+pid,
                                    type: 'PUT',
                                    dataType: 'json',
                                    data: { id: pid, pname: pname,pdescription:pdescription, pcharges:pcharges,_token: _token},
                                    success: function(response) {
                                        // console.log(response);
                                        if (response.success == true) {
                                            $('#editModal').modal('hide');
                                            location.reload();
                                        } else {
                                            $('.edit_response').html('<div class="alert bg-danger alert-dismissable" role="alert"><em class="fa fa-lg fa-warning">&nbsp;</em>' + response.data + '</div>');
                                        }

                                    }
                                });


                            });

                            //delete
                            $('body').on('click', '#paymth-delete', function () {
                                let _token   = $('meta[name="csrf-token"]').attr('content');
                                var pid = $('#pid').val();

                                $.ajax({
                                    url:"{{url('paymentmethod')}}/"+pid,
                                    type: 'DELETE',
                                    dataType: 'json',
                                    data: { id: pid, _token: _token},
                                    success: function(response) {
                                        // console.log(response);
                                        if (response.success == true) {
                                            $('#editModal').modal('hide');
                                            location.reload();
                                        } else {
                                            $('.edit_response').html('<div class="alert bg-danger alert-dismissable" role="alert"><em class="fa fa-lg fa-warning">&nbsp;</em>' + response.data + '</div>');
                                        }

                                    }
                                });


                            });

                        </script>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
