@extends('Clark UI.Clark Pages.masterClarkPge')
@section('constant')
<section>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">New Seller Registation</a>
        </div>
    </nav>

    <div class="container" id="container1">
        <form id="user_form" class="row g-3">

            <div class="col-md-4">
                <label for="name" class="form-label">NIC Number</label>
                <input type="text" class="form-control" id="input_nicno" name="input_nicno">
            </div>
            <div class="col-md-8">
                <label class="form-label">E - Mail Address</label>
                <input type="email" class="form-control" id="input_email" name="input_email">
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
            <div class="col-md-5">
                <label class="form-label">Password</label>
                <input type="password" class="form-control" style="text-align:center;" id="input_password" placeholder="PW Auto Default - system@12345" readOnly name="input_password">
            </div>
            <div class="col-md-3">
                <label class="form-label">Phone Number</label>
                <input type="number" class="form-control" id="input_phone_no" name="input_phone_no">
            </div>

            <div class="col-4">
                <label class="form-label"></label>
                <div class="col text-center">
                    <button class="btn btn-primary" id='btn_new_user_reg'>Add New</button>
                    <button type="button" class="btn btn-secondary" id='btn_reset' onclick="reset_all()">Reset</button>
                </div>
            </div>
            <div class="col-12">

                <div id="FornotifDiv"></div>

            </div>
        </form>
    </div>

</section>

@endsection

@push('scripts')
<script>

    $(document).ready(function() {

        $('#btn_new_user_reg').on('click', function(e) {

            var form = $(this).parents('#user_form');

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
                    }
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
                        url: 'New_seller_reg',
                        data: formData,
                        dataType: 'JSON',
                        processData: false,
                        contentType: false,
                        success: function(data) {
                            console.log(data);
                            if (data.exists) {
                                $('#FornotifDiv').fadeIn();
                                $('#FornotifDiv').html("<p class='alert alert-danger text-center' role=alert>" + "NIC Number already exists" + "</p>");
                                setTimeout(() => {
                                    $('#FornotifDiv').fadeOut();
                                }, 3000);
                            } else if (data.success) {

                                $('#FornotifDiv').fadeIn();
                                $('#FornotifDiv').html("<p class='alert alert-success text-center' role=alert>" + "Reg successfully" + "</p>");
                                setTimeout(() => {
                                    $('#FornotifDiv').fadeOut();
                                }, 2000);
                                $('[name="input_nicno"]').val('');
                                $('[name="input_email"]').val('');
                                $('[name="input_fname"]').val('');
                                $('[name="input_lname"]').val('');
                                $('[name="input_addree"]').val('');
                                $('[name="input_phone_no"]').val('');

                            } else {
                                $('#FornotifDiv').fadeIn();
                                $('#FornotifDiv').html("<p class='alert alert-danger text-center' role=alert>" + "An error occured. Please try later" + "</p>");
                                setTimeout(() => {
                                    $('#FornotifDiv').fadeOut();
                                }, 3000);
                            }
                        }
                    });
                }
            });
        });
    });
    
    function reset_all() {

        $('[name="input_nicno"]').val('');
        $('[name="input_email"]').val('');
        $('[name="input_fname"]').val('');
        $('[name="input_lname"]').val('');
        $('[name="input_addree"]').val('');
        $('[name="input_phone_no"]').val('');
    };

</script>
@endpush