@extends('Admin UI.Admin Pages.masteradminpage')
@section('constant')
<section>

    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">All Users</a>
        </div>
    </nav>

    <div class="container" id="container1">

    </div>

    <div class="container" id="container">
        <form id="user_form" class="row g-3">
            <div class="col-12">

                <div id="FormotifDiv"></div>

            </div>
            <div class="col-md-4">
                <label for="name" class="form-label">NIC Number</label>
                <input type="text" class="form-control" id="input_nicno" name="input_nicno">
            </div>
            <div class="col-md-6">
                <label class="form-label">E - Mail Address</label>
                <input type="email" class="form-control" id="input_email" name="input_email">
            </div>
            <div class="col-md-2">
                <label class="form-label">Roll</label>
                <select id="input_roll" name="input_roll" class="form-control" name="input_roll">
                    <option value="Admin">Admin</option>
                    <option value="Clark">Clark</option>
                    <option value="Seller">Seller</option>
                </select>
            </div>
            <div class="col-md-6">
                <label class="form-label">First Name</label>
                <input type="text" class="form-control" id="input_fname" name="input_fname">
            </div>
            <div class="col-md-6">
                <label class="form-label">Last Name</label>
                <input type="text" class="form-control" id="input_lname" name="input_lname">
            </div>
            <div class="col-12">
                <label class="form-label">Address</label>
                <input type="text" class="form-control" id="input_addree" name="input_addree">
            </div>
            <div class="col-md-3">
                <label class="form-label">Phone Number</label>
                <input type="number" class="form-control" id="input_phone_no" name="input_phone_no">
            </div>
            <div class="col-md-7">
                <label class="form-label">Password</label>
                <input type="password" class="form-control" id="input_password" style="text-align:center;" placeholder="Password Auto Default - system@12345">
            </div>
            <div class="col-md-2">
                <label class="form-label">Status</label>
                <select id="input_stasus" name="input_stasus" class="form-control" name="input_stasus">
                    <option value="Active">Active</option>
                    <option value="Deactive">Deactive</option>
                </select>
                <input type="hidden" class="form-control" id="input_user_id" name="input_user_id">
            </div>

            <div class="col-12">
                <div class="col text-center">
                    <button class="btn btn-primary" id='btn_new_user_reg'>Add New</button>
                    <button class="btn btn-labeled btn-success" id='btn_update'>Update</button>
                    <button type="button" class="btn btn-secondary" id='btn_reset' onclick="reset_all()">Reset</button>
                    <button type="button" class="btn btn-danger" id='btn_delete' onclick="Dlete_comform()">Delete</button>
                    <button type="button" class="btn btn-warning" id='btn_more_user_deta'>For More Details</button>
                </div>
            </div>
        </form>
    </div>

    <div class="container" id="container3">

        <!-- More Details Model -->
        <div class="modal fade cd-example-modal-xl" id="More_data_Model" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-xl">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle">More Details</h5>
                        <button type="button" class="close" data-dismiss="modal" onclick="model_close()" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row g-3">

                            <div class="col-md-2">
                                <label for="name" class="form-label"><b>Last Name </b></label>
                            </div>
                            <div class="col-md-4">
                                <label for="name" class="form-label" id="moredata_lname" value=""></label>
                            </div>

                            <div class="col-md-2">
                                <label for="name" class="form-label"><b>Home Address </b></label>
                            </div>
                            <div class="col-md-4">
                                <label for="name" class="form-label" id="moredata_address" value=""></label>
                            </div>

                            <div class="col-md-2">
                                <label for="name" class="form-label"><b>E Mail Address </b></label>
                            </div>
                            <div class="col-md-4">
                                <label for="name" class="form-label" id="moredata_email" value=""></label>
                            </div>

                            <div class="col-md-2">
                                <label for="name" class="form-label"><b>Password </b></label>
                            </div>
                            <div class="col-md-4">
                                <label for="name" class="form-label" id="moredata_password">*************</label>
                            </div>

                            <div class="col-md-2">
                                <label for="name" class="form-label"><b>Reg Date </b></label>
                            </div>
                            <div class="col-md-4">
                                <label for="name" class="form-label" id="moredata_create" value=""></label>
                            </div>

                            <div class="col-md-2">
                                <label for="name" class="form-label"><b>Last Update </b></label>
                            </div>
                            <div class="col-md-4">
                                <label for="name" class="form-label" id="moredata_update" value=""></label>
                            </div>

                        </div>
                    </div>
                    <div class="modal-footer">

                        <span id="btn_Buy_now_Place">

                        </span>

                        <button type="button" class="btn btn-primary" onclick="model_close()">Close</button>

                    </div>
                </div>
            </div>
        </div>
        <!-- More Details Model end -->


    </div>

    <div class="container" id="container4">

        <!-- Modal -->
        <div class="modal fade" id="Delete_Comform_Model" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle">Comform User Delete</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close" onclick="Delete_model_close()">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <p id="delete_com_id" value=""></p>
                        <p>Are You Sure Delete This User?</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal" onclick="Delete_model_close()">Cancel</button>
                        <button type="button" class="btn btn-primary" onclick="User_Delete()">Delete Now</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@push('scripts')

<script>
    $(document).ready(function() {

        DataTable();
        Load_All_Data();
        btn_disable_enable(0, 1, 1, 1, 1);
        input_read_only_enable(1, 1, 0)
    });

    function DataTable() {
        $("#table_id").DataTable({
            "scrollY": "300px",
            "scrollCollapse": true,
            "paging": false,
            "info": false
        });
    };

    function Load_All_Data() {

        var token = $('input[name="csrfToken"]').attr('value');

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        var getData = {
            "action": 'AllUsers'
        };
        // console.log(getData);
        $.ajax({
            type: 'POST',
            headers: {
                'X-CSRFToken': token
            },
            url: 'load_All_Users',
            data: getData,
            dataType: 'JSON',

            success: function(data) {
                // console.log(data);

                $htmltable1 = '<table id="table_id" style="cursor:pointer" class="display"><thead><tr><th>NIC NO</th><th>First Name</th><th>Mobile Nomber</th><th>Status</th><th>Roll</th></tr></thead><tbody>';

                data.forEach(val => {

                    $htmltable = '<tr onclick="tbl_row_cick(' + val.id + ')"><td>' + val.nicno +
                        '</td><td>' + val.fname +
                        '</td><td>' + val.MobileNo +
                        '</td><td>' + val.status +
                        '</td><td>' + val.roll +
                        '</td></tr>';

                    $htmltable1 = $htmltable1 + $htmltable;
                });
                $htmltable1 = $htmltable1 + '</tbody></table>';
                $('#container1').append($htmltable1);
                DataTable();
            }
        });
    };

    $(document).ready(function() {

        $('#btn_new_user_reg').on('click', function(e) {


            var form = $(this).parents('#user_form');
            //console.log();
            $(form).validate({
                rules: {
                    input_nicno: {
                        required: true,
                        minlength: 10,
                        maxlength: 12
                    },
                    input_email: {
                        required: true
                    },
                    input_fname: {
                        required: true
                    },
                    input_lname: {
                        required: true
                    },
                    input_addree: {
                        required: true
                    },
                    input_phone_no: {
                        required: true,
                        minlength: 10,
                        maxlength: 10
                    },
                    input_stasus: {
                        required: true
                    },
                    input_roll: {
                        required: true
                    },
                },
                messages: {
                    input_nicno: {
                        required: "<p style='color:red;'>* NIC Number Require</p>",
                        minlength: "<p style='color:red;'>* Please Enter Valied NIC Number</p>",
                        maxlength: "<p style='color:red;'>* Please Enter Valied NIC Number</p>"
                    },
                    input_email: "<p style='color:red;'>* E-mail Require</p>",
                    input_fname: "<p style='color:red;'>* First Name Require</p>",
                    input_lname: "<p style='color:red;'>* Last Name Require</p>",
                    input_addree: "<p style='color:red;'>* Address Line 1 Require</p>",
                    input_phone_no: {
                        required: "<p style='color:red;'>* Phone Number Require</p>",
                        minlength: "<p style='color:red;'>* Please Enter Valied Phone Number</p>",
                        maxlength: "<p style='color:red;'>* Please Enter Valied Phone Number</p>"
                    },
                    input_stasus: "<p style='color:red;'>* Password Require</p>",
                    input_roll: "<p style='color:red;'>* User Roll Require</p>"
                },
                highlight: function(element) {
                    $(element).addClass("error");
                },
                submitHandler: function() {
                    var token = $('input[name="csrfToken"]').attr('value');
                    var formData = new FormData(form[0]);
                    console.log(formData);
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });
                    $.ajax({
                        type: 'POST',
                        headers: {
                            'X-CSRFToken': token
                        },
                        url: 'New_user_reg',
                        data: formData,
                        dataType: 'JSON',
                        processData: false,
                        contentType: false,
                        success: function(data) {
                            console.log(data);
                            if (data.exists) {
                                $('#FormotifDiv').fadeIn();
                                $('#FormotifDiv').html("<p class='alert alert-danger text-center' role=alert>" + "NIC Number already exists" + "</p>");
                                setTimeout(() => {
                                    $('#FormotifDiv').fadeOut();
                                }, 3000);
                            } else if (data.success) {

                                $('#FormotifDiv').fadeIn();
                                $('#FormotifDiv').html("<p class='alert alert-success text-center' role=alert>" + "Reg successfully" + "</p>");
                                setTimeout(() => {
                                    $('#FormotifDiv').fadeOut();
                                }, 2000);
                                $('[name="input_nicno"]').val('');
                                $('[name="input_email"]').val('');
                                $('[name="input_fname"]').val('');
                                $('[name="input_lname"]').val('');
                                $('[name="input_addree"]').val('');
                                $('[name="input_phone_no"]').val('');
                                $('[name="input_stasus"]').val('');
                                $('[name="input_roll"]').val('');

                                setTimeout(location.reload.bind(location), 3000);
                            } else {
                                $('#FormotifDiv').fadeIn();
                                $('#FormotifDiv').css('background', 'red');
                                $('#FormotifDiv').html("<p class='alert alert-danger text-center' role=alert>" + "An error occured. Please try later" + "</p>");
                                setTimeout(() => {
                                    $('#FormotifDiv').fadeOut();
                                }, 3000);
                            }
                        }
                    });
                }
            });
        });
    });

    function model_close() {
        $('#More_data_Model').modal('hide');
    };

    $(document).ready(function() {

        $('#btn_more_user_deta').on('click', function(e) {

            var id = $('#input_user_id').val();

            console.log(id);
            $('#More_data_Model').modal('show');
            var token = $('input[name="csrfToken"]').attr('value');

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            var Data = {
                "id": id
            };
            $.ajax({
                type: 'POST',
                headers: {
                    'X-CSRFToken': token
                },
                url: 'View_more',
                data: Data,
                dataType: 'JSON',

                success: function(data) {
                    // console.log(data);
                    data.forEach(val => {
                        $('#moredata_lname').text(val.lname);
                        $('#moredata_address').text(val.address);
                        $('#moredata_email').text(val.email);
                        $('#moredata_create').text(val.created_at);
                        $('#moredata_update').text(val.updated_at);
                    });

                }
            });
        });
    });

    function tbl_row_cick($id) {

        var token = $('input[name="csrfToken"]').attr('value');

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        var Data = {
            "id": $id
        };
        $.ajax({
            type: 'POST',
            headers: {
                'X-CSRFToken': token
            },
            url: 'tbl_click_to_data',
            data: Data,
            dataType: 'JSON',

            success: function(data) {
                // console.log(data);
                data.forEach(val => {

                    $('#input_user_id').val(val.id);
                    $('#input_nicno').val(val.nicno);
                    $('#input_fname').val(val.fname);
                    $('#input_lname').val(val.lname);
                    $('#input_phone_no').val(val.MobileNo);
                    $('#input_email').val(val.email);
                    $('#input_addree').val(val.address);
                    $('#input_stasus').val(val.status);
                    $('#input_roll').val(val.roll);
                });

                btn_disable_enable(1, 0, 0, 0, 0);
                // pra -> btn_addnew, btn_update, btn_reset, btn_delete, btn_More_deta

                input_read_only_enable(1, 1, 1)
                // pra -> input_id, input_password, input_nicNo
            }
        });
    };

    $(document).ready(function() {

        $('#btn_update').on('click', function(e) {
            var nicno = $('#input_nicno').val();
            var email = $('#input_email').val();
            var f_name = $('#input_fname').val();
            var l_name = $('#input_lname').val();
            var address = $('#input_addree').val();
            var phone_no = $('#input_phone_no').val();
            var status = $('#input_stasus').val();
            var roll = $('#input_roll').val();
            var form = $(this).parents('#user_form');
            $(form).validate({
                rules: {
                    input_user_id: {
                        required: true
                    },
                    input_nicno: {
                        required: true,
                        minlength: 10,
                        maxlength: 12
                    },
                    input_email: {
                        required: true
                    },
                    input_fname: {
                        required: true
                    },
                    input_lname: {
                        required: true
                    },
                    input_addree: {
                        required: true
                    },
                    input_phone_no: {
                        required: true,
                        minlength: 10,
                        maxlength: 10
                    },
                    input_stasus: {
                        required: true
                    },
                    input_roll: {
                        required: true
                    },
                },
                messages: {
                    input_nicno: {
                        required: "<p style='color:red;'>* NIC Number Require</p>",
                        minlength: "<p style='color:red;'>* Please Enter Valied NIC Number</p>",
                        maxlength: "<p style='color:red;'>* Please Enter Valied NIC Number</p>"
                    },
                    input_email: "<p style='color:red;'>* E-mail Require</p>",
                    input_fname: "<p style='color:red;'>* First Name Require</p>",
                    input_lname: "<p style='color:red;'>* Last Name Require</p>",
                    input_addree: "<p style='color:red;'>* Address Line Require</p>",
                    input_phone_no: {
                        required: "<p style='color:red;'>* Phone Number Require</p>",
                        minlength: "<p style='color:red;'>* Please Enter Valied Phone Number</p>",
                        maxlength: "<p style='color:red;'>* Please Enter Valied Phone Number</p>"
                    },
                    input_stasus: "<p style='color:red;'>* Password Require</p>",
                    input_roll: "<p style='color:red;'>* User Roll Require</p>"
                },
                highlight: function(element) {
                    $(element).addClass("error");
                },
                submitHandler: function() {
                    var token = $('input[name="csrfToken"]').attr('value');
                    var formData = new FormData(form[0]);
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });
                    $.ajax({
                        type: 'POST',
                        headers: {
                            'X-CSRFToken': token
                        },
                        url: 'User_update',
                        data: formData,
                        dataType: 'JSON',
                        processData: false,
                        contentType: false,
                        success: function(data) {
                            if (data.exists) {
                                $('#FormotifDiv').fadeIn();
                                $('#FormotifDiv').html("<p class='alert alert-danger text-center' role=alert>" + "User Update Fail" + "</p>");
                                setTimeout(() => {
                                    $('#FormotifDiv').fadeOut();
                                }, 3000);
                            } else if (data.success) {

                                $('#FormotifDiv').fadeIn();
                                $('#FormotifDiv').html("<p class='alert alert-success text-center' role=alert>" + "Update successfully" + "</p>");
                                setTimeout(() => {
                                    $('#FormotifDiv').fadeOut();
                                }, 2000);
                                $('[name="input_nicno"]').val('');
                                $('[name="input_email"]').val('');
                                $('[name="input_fname"]').val('');
                                $('[name="input_lname"]').val('');
                                $('[name="input_addree"]').val('');
                                $('[name="input_phone_no"]').val('');
                                $('[name="input_password"]').val('');
                                $('[name="input_stasus"]').val('');
                                $('[name="input_roll"]').val('');

                                btn_disable_enable(1, 0, 0, 0, 0);
                                // pra -> btn_addnew, btn_update, btn_reset, btn_delete, btn_More_deta

                                input_read_only_enable(1, 1, 0)
                                // pra -> input_id, input_password, input_nicNo

                                setTimeout(location.reload.bind(location), 3000);
                            } else {
                                $('#FormotifDiv').fadeIn();
                                $('#FormotifDiv').css('background', 'red');
                                $('#FormotifDiv').html("<p class='alert alert-danger text-center' role=alert>" + "An error occured. Please try later" + "</p>");
                                setTimeout(() => {
                                    $('#FormotifDiv').fadeOut();
                                }, 3000);
                            }
                        }
                    });
                }
            });
        });
    });

    function Dlete_comform() {

        var nicno = $('#input_nicno').val();
        $('#delete_com_id').text("ID Number - " + nicno);
        $('#Delete_Comform_Model').modal('show');
    };

    function Delete_model_close() {
        $('#Delete_Comform_Model').modal('hide');
    };

    function User_Delete() {

        Delete_model_close();

        $id = $('#input_user_id').val();
        var token = $('input[name="csrfToken"]').attr('value');
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        var Data = {
            "id": $id
        };

        $.ajax({
            type: 'POST',
            headers: {
                'X-CSRFToken': token
            },
            url: 'User_delete',
            data: Data,
            dataType: 'JSON',
            success: function(data) {
                if (data.exists) {
                    $('#FormotifDiv').fadeIn();
                    $('#FormotifDiv').html("<p class='alert alert-danger text-center' role=alert>" + "User Delete Fail" + "</p>");
                    setTimeout(() => {
                        $('#FormotifDiv').fadeOut();
                    }, 3000);
                } else if (data.success) {

                    $('#FormotifDiv').fadeIn();
                    $('#FormotifDiv').html("<p class='alert alert-success text-center' role=alert>" + "User Delete successfully" + "</p>");
                    setTimeout(() => {
                        $('#FormotifDiv').fadeOut();
                    }, 2000);
                    $('[name="input_nicno"]').val('');
                    $('[name="input_email"]').val('');
                    $('[name="input_fname"]').val('');
                    $('[name="input_lname"]').val('');
                    $('[name="input_addree"]').val('');
                    $('[name="input_phone_no"]').val('');
                    $('[name="input_password"]').val('');
                    $('[name="input_stasus"]').val('');
                    $('[name="input_roll"]').val('');

                    btn_disable_enable(0, 1, 1, 1, 1);

                    input_read_only_enable(1, 0, 0)

                    setTimeout(location.reload.bind(location), 3000);
                } else {
                    $('#FormotifDiv').fadeIn();
                    $('#FormotifDiv').css('background', 'red');
                    $('#FormotifDiv').html("<p class='alert alert-danger text-center' role=alert>" + "An error occured. Please try later" + "</p>");
                    setTimeout(() => {
                        $('#FormotifDiv').fadeOut();
                    }, 3000);
                }
            }
        });
    };

    function btn_disable_enable($btn_addnew, $btn_update, $btn_reset, $btn_delete, $btn_More_deta) {

        if ($btn_addnew == 1) {
            document.getElementById("btn_new_user_reg").disabled = true;
        } else if ($btn_addnew == 0) {
            document.getElementById("btn_new_user_reg").disabled = false;
        }


        if ($btn_update == 1) {
            document.getElementById("btn_update").disabled = true;
        } else if ($btn_update == 0) {
            document.getElementById("btn_update").disabled = false;
        }

        if ($btn_reset == 1) {
            document.getElementById("btn_reset").disabled = true;
        } else if ($btn_reset == 0) {
            document.getElementById("btn_reset").disabled = false;
        }

        if ($btn_delete == 1) {
            document.getElementById("btn_delete").disabled = true;
        } else if ($btn_delete == 0) {
            document.getElementById("btn_delete").disabled = false;
        }

        if ($btn_More_deta == 1) {
            document.getElementById("btn_more_user_deta").disabled = true;
        } else if ($btn_More_deta == 0) {
            document.getElementById("btn_more_user_deta").disabled = false;
        }
    };

    function input_read_only_enable($input_id, $input_password, $input_nicNo) {

        if ($input_id == 1) {
            document.getElementById("input_user_id").readOnly = true;
        } else if ($input_id == 0) {
            document.getElementById("input_user_id").readOnly = false;
        }

        if ($input_password == 1) {
            document.getElementById("input_password").readOnly = true;
        } else if ($input_password == 0) {
            document.getElementById("input_password").readOnly = false;
        }

        if ($input_nicNo == 1) {
            document.getElementById("input_nicno").readOnly = true;
        } else if ($input_nicNo == 0) {
            document.getElementById("input_nicno").readOnly = false;
        }
    };

    function reset_all() {

        $('[name="input_nicno"]').val('');
        $('[name="input_email"]').val('');
        $('[name="input_fname"]').val('');
        $('[name="input_lname"]').val('');
        $('[name="input_addree"]').val('');
        $('[name="input_phone_no"]').val('');
        $('[name="input_password"]').val('');
        $('[name="input_stasus"]').val('');
        $('[name="input_roll"]').val('');

        btn_disable_enable(0, 1, 1, 1, 1);
        // pra -> btn_addnew, btn_update, btn_reset, btn_delete, btn_More_deta

        input_read_only_enable(1, 1, 0)
        // pra -> input_id, input_password, input_nicNo
    };
</script>

@endpush