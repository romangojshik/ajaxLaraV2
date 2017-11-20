<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Customer</title>
        <meta charset="utf-8">
        <meta name="csrf-token" content="{!! csrf_token() !!}" />
        <meta name="viewport" content="width=device-width, initial-scale=1">

        {{--<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">--}}
        {{--<link rel="stylesheet" href="{{ asset('css/custom.css') }}">--}}

        {{--<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>--}}

        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

        <link rel="stylesheet" href="{{ asset('css/custom.css') }}">


    </head>
    <body>
        @include('nav')

        <div class="container">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <button type="button" class="btn btn-info" id="add" value="add"><i class="glyphicon glyphicon-plus"></i> New Customer</button>
                </div>
                <div class="panel-body">
                    @include('newCustomer')
                    <table class="table table-hover">
                        <caption>Customer Info</caption>
                        <thead>
                            <th>ID</th>
                            <th>First Name</th>
                            <th>Last Name</th>
                            <th>Sex</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Action</th>
                        </thead>
                        <tbody>
                            @foreach($customers as $key => $customer)
                                <tr id="customer{{ $customer->id }}">
                                    <td>{{ $customer->id }}</td>
                                    <td>{{ $customer->first_name }}</td>
                                    <td>{{ $customer->last_name }}</td>
                                    <td>
                                        @if ($customer->sex==0)
                                            Male
                                            @else
                                            Female
                                        @endif
                                    </td>
                                    <td>{{ $customer->email }}</td>
                                    <td>{{ $customer->phone }}</td>
                                    <td>
                                        <button class="btn btn-success btn-edit" data-id="{{ $customer->id }}"><i class="glyphicon glyphicon-pencil"></i> Edit</button>
                                        <button class="btn btn-danger btn-delete" data-id="{{ $customer->id }}"><i class="glyphicon glyphicon-trash"></i> Delete</button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            <script type="text/javascript">
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                })

                $('#add').on('click', function () {
                    $('#save').val('save');
                    $('#frmCustomer').trigger('reset');
                    $('#customer').modal('show');
                })

                $('#frmCustomer').on('submit', function (e) {
                    e.preventDefault();
                    var form = $('#frmCustomer');
                    var formData = form.serialize();
                    var url = form.attr('action');
                    var state = $('#save').val();
                    var type = 'post';

                    if(state === 'update') {
                        type = 'put';
                    }

                    $.ajax({
                        type     : type,
                        url      : url,
                        data     : formData,
                        success: function (data) {
                            var sex = "";

                            if(data.sex == 0) {
                                sex = "Male";
                            } else {
                                sex = "Female";
                            }

                            var row = '<tr id="customer' + data.id + '">' +
                                '<td>' + data.id + '</td>' +
                                '<td>' + data.first_name + '</td>' +
                                '<td>' + data.last_name + '</td>' +
                                '<td>' + sex + '</td>' +
                                '<td>' + data.email + '</td>' +
                                '<td>' + data.phone + '</td>' +
                                '<td><button class="btn btn-success btn-edit" data-id="' + data.id + '"><i class="glyphicon glyphicon-pencil"></i> Edit</button> ' +
                                '<button class="btn btn-danger btn-delete" data-id="' + data.id + '"><i class="glyphicon glyphicon-trash"></i> Delete</button></td>' +
                                '</tr>';

                            if(state == 'save') {
                                $('tbody').append(row);
                            } else {
                                $('#customer' + data.id).replaceWith(row);
                            }

                            $('#frmCustomer').trigger('reset');
                            $('#first_name').focus();
                        }
                    });
                })
                //-----addrow--------
                function addRow(data) {
                    var sex = "";

                    if(data.sex === 0) {
                        sex = "Male";
                    } else {
                        sex = "Female";
                    }

                    var row = '<tr id="customer' + data.id + '">' +
                              '<td>' + data.id + '</td>' +
                              '<td>' + data.first_name + '</td>' +
                              '<td>' + data.last_name + '</td>' +
                              '<td>' + sex + '</td>' +
                              '<td>' + data.email + '</td>' +
                              '<td>' + data.phone + '</td>' +
                              '<td><button class="btn btn-success btn-edit"><i class="glyphicon glyphicon-pencil"></i> Edit</button> ' +
                                   '<button class="btn btn-danger btn-delete"><i class="glyphicon glyphicon-trash"></i> Delete</button></td>' +
                              '</tr>';
                    $('tbody').append(row);
                }

                //-----get update--------
                $('tbody').delegate('.btn-edit', 'click', function () {
                    var value = $(this).data('id');
                    var url = '{{  URL::to('getUpdate') }}';
                    $.ajax({
                        type : 'get',
                        url  : url,
                        data : {'id' : value},
                        success: function (data) {
                            $('#id').val(data.id);
                            $('#first_name').val(data.first_name);
                            $('#last_name').val(data.last_name);
                            $('#sex').val(data.sex);
                            $('#email').val(data.email);
                            $('#phone').val(data.phone);
                            $('#save').val('update');
                            $('#customer').modal('show');
                        }
                    });
                });

                //--------------delete customer
                $('tbody').delegate('.btn-delete', 'click', function () {
                    var value = $(this).data('id');
                    var url = '{{ URL::to('deleteCustomer') }}';
                    if(confirm('Are you sure to delete?') == true) {
                        $.ajax({
                            type : 'post',
                            url  : url,
                            data : {'id' : value },
                            success: function (data) {
                                $('#customer' + value).remove();
                            }
                        });
                    }
                });

            </script>
        </div>
        <!-- Bootstrap core JavaScript
    ================================================== -->
        <!-- Placed at the end of the document so the pages load faster -->

        {{--<script src="https://code.jquery.com/jquery-3.2.1.js" integrity="sha256-DZAnKJ/6XZ9si04Hgrsxu/8s717jcIzLy3oi35EouyE=" crossorigin="anonymous"></script>--}}
    </body>

</html>
