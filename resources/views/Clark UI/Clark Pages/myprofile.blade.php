@extends('Clark UI.Clark Pages.masterClarkPge')
@section('constant')
<section>

    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">My Profile</a>
        </div>
    </nav>

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
                <label class="form-label">Phone Number</label>
                <input type="number" class="form-control" id="input_phone_no" name="input_phone_no">
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

            <div class="col-12">
                <div class="col text-center">
                    @if(Auth::check())
                    <input type="hidden" class="form-control" id="user_id" name="user_id" value='{{Auth::user()->id}}'>
                    @endif
                    <button class="btn btn-labeled btn-success" id='btn_updatepr'>Update</button>
                </div>
            </div>
        </form>
        <br>
        <form id="pwuser_form" class="row g-3">
            <div class="col-12">

                <div id="FormotifDiv1"></div>

            </div>
            <div class="col-md-4">
                <label for="name" class="form-label">NIC Number</label>
                <input type="text" class="form-control" id="input_nicno2" name="input_nicno2">
            </div>

            <div class="col-md-4">
                <label class="form-label">Password</label>
                <input type="password" class="form-control" id="input_password" name="input_password">
            </div>

            <div class="col-md-4">
                <label class="form-label">Conform Password</label>
                <input type="password" class="form-control" id="reinput_password" name="reinput_password">
            </div>

            <div class="col-12">
                <div class="col text-center">
                    @if(Auth::check())
                    <input type="hidden" class="form-control" id="user_id_forpw" name="user_id_forpw" value='{{Auth::user()->id}}'>
                    @endif

                    <button class="btn btn-labeled btn-success" id='btn_updatepw'>Update</button>
                </div>
            </div>
        </form>
    </div>

</section>
@endsection

@push('scripts')

<script>
    $(document).ready(function() {

        Load_All_Data();
        document.getElementById("input_nicno").readOnly = true;
        document.getElementById("input_nicno2").readOnly = true;
    });

    function Load_All_Data() {

        $userId = $('#user_id').val();

        var token = $('input[name="csrfToken"]').attr('value');

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        var getData = {
            "User_id": $userId
        };
        // console.log(getData);
        $.ajax({
            type: 'POST',
            headers: {
                'X-CSRFToken': token
            },
            url: 'load_ClarkProFile',
            data: getData,
            dataType: 'JSON',

            success: function(data) {
                // console.log(data);

                data.forEach(val => {
                    $('#input_user_id').val(val.id);
                    $('#input_nicno').val(val.nicno);
                    $('#input_nicno2').val(val.nicno);
                    $('#input_fname').val(val.fname);
                    $('#input_lname').val(val.lname);
                    $('#input_phone_no').val(val.MobileNo);
                    $('#input_email').val(val.email);
                    $('#input_addree').val(val.address);
                });
            }
        });
    };

    $(document).ready(function() {

        $('#btn_updatepr').on('click', function(e) {

            var form = $(this).parents('#user_form');
            $(form).validate({
                rules: {
                    user_id: {
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
                    }
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
                        url: 'updateClarkProfile',
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

    $(document).ready(function() {

        $('#btn_updatepw').on('click', function(e) {

            var form = $(this).parents('#pwuser_form');
            $(form).validate({
                rules: {
                    user_id_forpw: {
                        required: true
                    },
                    input_password: {
                        required: true,
                        minlength: 8
                    },
                    reinput_password: {
                        required: true,
                        equalTo: "#input_password"
                    },
                },
                messages: {
                    input_password: {
                        required: "<p style='color:red;'>* Password Required</p>",
                        minlength: "<p style='color:red;'>* Minimum 8 Letters Required</p>"
                    },
                    reinput_password: {
                        required: "<p style='color:red;'>* Conform Password Require</p>",
                        minlength: "<p style='color:red;'>* Minimum 8 Letters Required</p>",
                        equalTo: "<p style='color:red;'>* Please enter same passowrd</p>"
                    }
                },
                highlight: function(element) {
                    $(element).addClass("error");
                },
                submitHandler: function() {
                    var token = $('input[name="csrfToken"]').attr('value');
                    var formData = new FormData(form[0]);
                    // console.log(formData);
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
                        url: 'updateClarkPw',
                        data: formData,
                        dataType: 'JSON',
                        processData: false,
                        contentType: false,
                        success: function(data) {
                            if (data.exists) {
                                $('#FormotifDiv1').fadeIn();
                                $('#FormotifDiv1').html("<p class='alert alert-danger text-center' role=alert>" + "Password Update Fail" + "</p>");
                                setTimeout(() => {
                                    $('#FormotifDiv1').fadeOut();
                                }, 3000);
                            } else if (data.success) {

                                $('#FormotifDiv1').fadeIn();
                                $('#FormotifDiv1').html("<p class='alert alert-success text-center' role=alert>" + "Password Update successfully" + "</p>");
                                setTimeout(() => {
                                    $('#FormotifDiv1').fadeOut();
                                }, 2000);

                                $('#input_password').val("");
                                $('#reinput_password').val("");

                            } else {
                                $('#FormotifDiv1').fadeIn();
                                $('#FormotifDiv1').css('background', 'red');
                                $('#FormotifDiv1').html("<p class='alert alert-danger text-center' role=alert>" + "An error occured. Please try later" + "</p>");
                                setTimeout(() => {
                                    $('#FormotifDiv1').fadeOut();
                                }, 3000);
                            }
                        }
                    });
                }
            });
        });
    });
</script>

@endpush