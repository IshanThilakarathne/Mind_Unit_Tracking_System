@extends('Login UI.LoginPagmaster')
@section('constant')


<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container-fluid">
        <a class="navbar-brand" href="#">Mind Units Tracking System</a>
    </div>
</nav>

<div class="header">
    <section>
        <div class="imgBx">
            <img src="Login Page Resources/loginPage.jpg">
        </div>
        <div class="contentBx">
            <div class="formBx">
                <h2>Login</h2>
                <form id="Loginform">
                    <div class="inputBx">
                        <span>Username</span>
                        <input type="text" class="form-control" placeholder="Enter Your ID Card Number" name="l_id_card_no" id="l_id_card_no" name="">
                    </div>
                    <div class="inputBx">
                        <span>Password</span>
                        <input type="password" class="form-control" placeholder="Enter Your password" name="l_password" id="l_password" name="">
                    </div>
                    <div class="inputBx">
                        <input id='loginbtn' type="submit" value="Sign in" name="">
                    </div>
                    <div class="inputB">
                        <div id="notifDiv"></div>
                    </div>
                </form>
            </div>
        </div>
</div>
</section>
</div>

@endsection

@push('scripts')

<script>
    $(document).ready(function() {
        $('#loginbtn').on('click', function(e) {

            $('#Loginform').validate({
                rules: {
                    l_id_card_no: {
                        required: true,
                        minlength: 10,
                        maxlength: 12
                    },
                    l_password: {
                        required: true,
                        minlength: 8,
                    },
                },
                messages: {
                    l_id_card_no: {
                        required: "<p style='color:red;'>* ID card number Require</p>",
                        minlength: "<p style='color:red;'>* Please Enter Valied NIC Number</p>",
                        maxlength: "<p style='color:red;'>* Please Enter Valied NIC Number</p>"
                    },
                    l_password: {
                        required: "<p style='color:red;'>* Password Require</p>",
                        minlength: "<p style='color:red;'>* Minimum password length 8 characters </p>"
                    },
                },
                highlight: function(element) {
                    $(element).addClass("error");
                },
                submitHandler: function() {
                    var token = $('input[name="csrfToken"]').attr('value');
                    var l_id_card_no = $('#l_id_card_no').val();
                    var l_password = $('#l_password').val();

                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });

                    $.ajax({
                        url: 'user_login',
                        type: 'POST',
                        data: {
                            l_id_card_no: l_id_card_no,
                            l_password: l_password
                        },
                        success: function(data) {
                            if ($.isEmptyObject(data.error)) {
                                if (data.activetion != "Deactiveted") {
                                    if (data[0]['roll'] == "Admin") {
                                        $('#notifDiv').fadeIn();
                                        $('#notifDiv').html("<p class='alert alert-success text-center' role=alert>" + "you are successful login" + "</p>");
                                        setTimeout(() => {
                                            $('#notifDiv').fadeOut();
                                        }, 3000);

                                        setTimeout(window.location = "{{route('admin')}}", 4000);

                                    } else if (data[0]['roll'] == "Clark") {
                                        $('#notifDiv').fadeIn();
                                        $('#notifDiv').html("<p class='alert alert-success text-center' role=alert>" + "you are successful login" + "</p>");
                                        setTimeout(() => {
                                            $('#notifDiv').fadeOut();
                                        }, 3000);
                                        setTimeout(window.location = "{{route('clarkpg')}}", 4000);

                                    } else if (data[0]['roll'] == "Seller") {
                                        $('#notifDiv').fadeIn();
                                        $('#notifDiv').html("<p class='alert alert-success text-center' role=alert>" + "you are successful login" + "</p>");
                                        setTimeout(() => {
                                            $('#notifDiv').fadeOut();
                                        }, 3000);
                                        setTimeout(window.location = "{{route('Sellerpg')}}", 4000);

                                    }
                                } else {
                                    $('#notifDiv').fadeIn();

                                    $('#notifDiv').html("<p class='alert alert-danger text-center' role=alert>" + "User Account is Inectiveted. Please Contrac System Admin" + "</p>");
                                    setTimeout(() => {
                                        $('#notifDiv').fadeOut();
                                    }, 3000);
                                }
                            } else {
                                $('#notifDiv').fadeIn();
                                $('#notifDiv').html("<p class='alert alert-danger text-center' role=alert>" + "Username or Password is invalid. please try again" + "</p>");
                                setTimeout(() => {
                                    $('#notifDiv').fadeOut();
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