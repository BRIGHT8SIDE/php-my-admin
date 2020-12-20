<?php require_once('./DB/db.php') ?>

<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
    <!-- Toastr -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.22/css/jquery.dataTables.min.css">

    <link rel="stylesheet" href="assets/plugins/sweetalert/sweetalert.css">

    <title>PHP CRUD APP FOR TEST</title>

    <style>
        .error {
            color: red;
            font-weight: 400;
            display: block;
            padding: 6px 0;
            font-size: 14px;
        }

        .form-control.error {
            border-color: red;
            padding: .375rem .75rem;
        }
    </style>
</head>

<body>

    <div class="container">
        <div class=" mt-5 mb-5" id="btn_main">
            <button type="button" onclick="show_add_form()" class="btn btn-secondary btn-sm btn-block">New User</button>
        </div>
        <div class="rounded-3 border p-2 bg-light border" id="form1">
            <h3>user management</h3>
            <form name="form_user" id="form_user" method="POST" enctype="multipart/form-data">
                <div class="mb-3">
                    <label for="exampleInputPassword1" class="form-label">Full Name</label>
                    <input type="text" class="form-control" name="txt_fullname" id="txt_fullname">
                    <input type="hidden" name="txt_for" id="txt_for">
                    <input type="hidden" name="txt_order_id" id="txt_order_id">
                </div>
                <div class="mb-3">
                    <label for="exampleInputPassword1" class="form-label">Home Address</label>
                    <input type="text" class="form-control" name="txt_address" id="txt_address">
                </div>

                <div class="mb-3">
                    <label for="exampleInputPassword1" class="form-label">Mobile</label>
                    <input type="text" class="form-control" name="txt_mobile" id="txt_mobile">
                </div>

                <div class="mb-3">
                    <label for="exampleInputPassword1" class="form-label">Email</label>
                    <input type="text" class="form-control" name="txt_email" id="txt_email">
                </div>
                <div class="mb-3" id="mypass">
                    <label for="exampleInputPassword1" class="form-label">Password</label>
                    <input type="password" class="form-control" name="txt_password" id="txt_password">
                </div>
                <div id="submit_div">
                    <button name="submit" type="submit" class="btn btn-primary">Submit</button>
                </div>

            </form>
        </div>


        <div class="rounded-3 border p-2 bg-light border" id="form1">
            <h3>user data</h3>
            <table id="usertbll23" class="display nowrap table table-hover table-striped table-bordered" cellspacing="0" width="100%">
            </table>
        </div>

    </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>
    <script src="assets/plugins/jquery/jquery.min.js"></script>

    <script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.11.1/jquery.validate.min.js"></script>
    <!-- Toastr -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <script src="https:////cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>


    <script src="assets/plugins/sweetalert/sweetalert.min.js"></script>

    <script>
        function show_add_form() {
            $('#form1').show();

            $('#txt_for').val('INSERT');

            let content = '';
            content = '<button type="button" onclick="show_hide_form()" class="btn btn-secondary btn-sm btn-block">New User</button>';
            $('#btn_main').html(content);

        }

        function show_edit_form() {
            $('#form1').show();
            $('#txt_for').val('EDIT');
            $('#mypass').hide('');

            let content = '';
            content = '<button type="button" onclick="show_hide_form()" class="btn btn-info btn-sm btn-block">Edit User</button>';
            $('#btn_main').html(content);

            let content1 = '<button class="btn btn-info" name="submit" type="submit">Edit User</button>';

            $('#submit_div').html(content1);
        }

        function show_hide_form() {
            $('#form1').hide();

            $('#txt_fullname').val('');
            $('#txt_address').val('');
            $('#txt_password').val('');
            $('#txt_email').val('');
            $('#txt_mobile').val('');

            let content = '';
            content = '<button type="button" onclick="show_add_form()" class="btn btn-info btn-sm btn-block">show Form</button>';
            $('#btn_main').html(content);

        }

        function view(id) {
            $.ajax({
                type: 'POST',
                url: 'getuser.php',
                data: {
                    id: id
                },
                dataType: 'json',
                success: function(result) {
                    console.log(result);
                    show_edit_form();

                    $('#txt_order_id').val(result.data.user_id);
                    $('#txt_fullname').val(result.data.full_name);
                    $('#txt_email').val(result.data.user_email);
                    $('#txt_mobile').val(result.data.user_mobile);
                    $('#txt_address').val(result.data.user_Address);


                    dt.ajax.reload();
                    dt.draw();

                },
                error: function(error) {
                    console.log("error : " + error);

                    dt.ajax.reload();
                    dt.draw();

                }
            });
        }

        function del(id) {
            // this is for sweet alert popup view for the 
            swal({
                title: "Are you sure?",
                text: "You will not be able to recover this item!",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#fcb03b",
                confirmButtonText: "Yes, unblock it!",
                cancelButtonText: "No, cancel it!",
                closeOnConfirm: false,
                closeOnCancel: false
            }, function(isConfirm) {
                if (isConfirm) {

                    $.ajax({
                        type: 'POST',
                        url: 'removeuser.php',
                        data: {
                            id: id
                        },
                        dataType: 'json',
                        success: function(result) {
                            dt.ajax.reload();
                            dt.draw();
                            if (result.status == 200) {
                                swal("DELETE!", "Your selected User has been Delete.", "success");
                                toastr["warning"](result.message);
                            }

                            if (result.status == 500) {
                                swal("Failed", "The operation which you perform is failed!", "error");
                                toastr["error"](result.message);
                            }


                        },
                        error: function(error) {
                            dt.ajax.reload();
                            dt.draw();
                            swal("Failed", "The operation which you perform is failed!", "error");

                        }
                    });
                } else {
                    swal("Cancelled", "Your selected record is safe :)", "error");
                }
            });


        }
    </script>

    <script>
        $(document).ready(function() {

            $('#txt_fullname').val('');
            $('#txt_address').val('');
            $('#txt_password').val('');
            $('#txt_email').val('');
            $('#txt_mobile').val('');

            $('#form1').hide();

            $("#form_user").validate({
                rules: {
                    txt_fullname: {
                        required: true,
                    },
                    txt_address: {
                        required: true,
                    },
                    txt_mobile: {
                        required: true,
                        minlength: 10,
                        maxlength: 10,
                        number: true

                    },
                    txt_email: {
                        required: true,
                        email: true
                    },
                    txt_password: {
                        required: true,
                        minlength: 5
                    }

                },
                messages: {
                    txt_fullname: "Please enter your fullname",
                    txt_address: "Please enter your address",
                    txt_mobile: {
                        required: "User contact number is required",
                        minlength: "contact number must be min 10 characters long",
                        maxlength: "contact number must not be more than 10 characters long"

                    },
                    txt_password: {
                        required: "Please provide a password",
                        minlength: "Your password must be at least 5 characters long"
                    },
                    txt_email: {
                        required: "Email Address is Required",
                        minlength: "Please enter a valid email address"
                    }

                },
                submitHandler: function(form) {
                    let formData = new FormData(form);
                    if ($('#txt_for').val() === 'INSERT') {
                        $.ajax({
                            type: 'POST',
                            url: 'add_new_user.php',
                            data: formData,
                            dataType: 'json',
                            processData: false,
                            enctype: 'multipart/form-data',
                            contentType: false,
                            cache: false,
                            success: function(result) {
                                dt.ajax.reload();
                                dt.draw();
                                if (result.status == 200) {
                                    swal("INSERTED!", "Your selected User has been Inserted.", "success");
                                    toastr["success"](result.message);
                                }
                                if (result.status == 500) {
                                    swal("Failed", "The operation which you perform is failed!", "error");
                                    toastr["error"](result.message);

                                }

                                $('#txt_fullname').val('');
                                $('#txt_address').val('');
                                $('#txt_password').val('');
                                $('#txt_email').val('');
                                $('#txt_mobile').val('');
                                show_hide_form();
                            },
                            error: function(error) {
                                console.log("error : " + error);
                                dt.ajax.reload();
                                dt.draw();
                            },

                        });
                    }

                    if ($('#txt_for').val() === 'EDIT') {
                        $.ajax({
                            type: 'POST',
                            url: 'edituser.php',
                            data: formData,
                            dataType: 'json',
                            processData: false,
                            enctype: 'multipart/form-data',
                            contentType: false,
                            cache: false,
                            success: function(result) {
                                dt.ajax.reload();
                                dt.draw();
                                if (result.status == 200) {
                                    swal("UPDATED!", "Your selected User has been Updated.", "success");
                                    toastr["info"](result.message);
                                }
                                if (result.status == 500) {
                                    swal("Failed", "The operation which you perform is failed!", "error");
                                    toastr["error"](result.message);

                                }

                                $('#txt_fullname').val('');
                                $('#txt_address').val('');
                                $('#txt_password').val('');
                                $('#txt_email').val('');
                                $('#txt_mobile').val('');
                                show_hide_form();
                            },
                            error: function(error) {
                                console.log("error : " + error);
                                dt.ajax.reload();
                                dt.draw();
                            },

                        });
                    }
                }
            });

        });
    </script>

    <!-- data table -->
    <script>
        let dt = $('#usertbll23').DataTable({
            "destroy": true,
            "processing": false,
            "serverSide": true,
            "searching": true,
            "oLanguage": {
                "sEmptyTable": "No user data available."
            },
            "order": [
                [0, "desc"]
            ],
            "columns": [{
                    "data": "user_id",
                    "name": "user_id",
                    "title": "ID"
                },
                {
                    "data": "full_name",
                    "name": "full_name",
                    "title": "Full name"
                },

                {
                    "data": "user_Address",
                    "name": "user_Address",
                    "title": "Address"
                },

                {
                    "data": "user_mobile",
                    "name": "user_mobile",
                    "title": "Mobile Number"
                },
                {
                    "data": "user_email",
                    "name": "user_email",
                    "title": "email"
                },

                {
                    "data": "active_Status",
                    "name": "active_Status",
                    "title": "Status",
                    mRender: function(data) {
                        if (data == '1') {
                            return '<span class="badge bg-primary">Active</span>'
                        }
                        if (data == 0) {
                            return '<span class="badge bg-danger">Deactive</span>'
                        }


                    }
                },

                {
                    "data": "user_id",
                    "title": "Actions",
                    mRender: function(data) {
                        return '<button type="button" " onclick="del(\'' + data + '\');" class="btn text-danger bg-dark"><i class="fa fa-trash"></i></button>' +
                            '<button id="editid" type="button" onclick="view(\'' + data + '\');" class="btn text-info bg-dark"><i class="fa fa-pencil-square-o"></i></button>'
                    }

                },
            ],
            "language": {
                "emptyTable": "No data to show.!"
            },
            "ajax": "feeduser.php"

        });
    </script>


</body>

</html>