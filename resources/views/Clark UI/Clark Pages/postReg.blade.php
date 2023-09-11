@extends('Clark UI.Clark Pages.masterClarkPge')
@section('constant')
<section>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">New Post Registation</a>
        </div>
    </nav>

    <div class="container" id="container1"></div>

    <div class="container" id="container2">

        <form id="user_form" class="row g-3">
            <div class="col-12">

                <div id="FornotifDiv"></div>

            </div>
            <div class="col-md-12 text-center">
                <label for="name" class="form-label">--------------------- Seller Details ---------------------</label>
            </div>
            <div class="col-md-4">
                <label for="name" class="form-label">NIC Number</label>
                <input type="text" class="form-control" id="dis_input_nicno" disabled name="dis_input_nicno">
            </div>
            <div class="col-md-6">
                <label class="form-label">E - Mail Address</label>
                <input type="email" class="form-control" id="dis_input_email" disabled name="dis_input_email">
                <!-- <span class="error"><p style="color:DeepPink;" id="iuser_group_code_error"></p></span> -->
            </div>
            <div class="col-md-2">
                <label class="form-label">Phone Number</label>
                <input type="number" class="form-control" id="dis_input_phone_no" disabled name="dis_input_phone_no">
            </div>
            <div class="col-md-6">
                <label class="form-label">First Name</label>
                <input type="text" class="form-control" id="dis_input_fname" disabled name="dis_input_fname">
            </div>
            <div class="col-md-6">
                <label class="form-label">Last Name</label>
                <input type="text" class="form-control" id="dis_input_lname" disabled name="dis_input_lname">
            </div>

        </form>

        <form id="post_form" class="row g-3">
            <div class="col-md-12 text-center">
                <label for="name" class="form-label">--------------------- Receiver Details ---------------------</label>
            </div>
            <div class="col-md-4">
                <label for="name" class="form-label">Product Name</label>
                <input type="text" class="form-control" id="input_product_name" name="input_product_name">
            </div>
            <div class="col-md-4">
                <label class="form-label">Receiver First Name</label>
                <input type="text" class="form-control" id="input_rece_f_name" name="input_rece_f_name">
            </div>
            <div class="col-md-4">
                <label class="form-label">Receiver Last Name</label>
                <input type="text" class="form-control" id="input_rece_l_name" name="input_rece_l_name">
            </div>
            <div class="col-md-6">
                <label class="form-label">Receiver Address</label>
                <input type="text" class="form-control" id="input_rece_address" name="input_rece_address">
            </div>
            <div class="col-md-4">
                <label class="form-label">Receiver Phone Number</label>
                <input type="number" class="form-control" id="input_rece_phone_no" name="input_rece_phone_no">
            </div>
            <input type="hidden" class="form-control" id="input_seller_id" name="input_seller_id">

            @if(Auth::check())

            <input type="hidden" class="form-control" id="input_clark_id" name="input_clark_id" value='{{Auth::user()->id}}'>

            @endif

            <div class="col-12">
                <div class="col text-center">
                    <button class="btn btn-primary" id='btn_new_seller_reg'>Register Post</button>

                    <button type="button" class="btn btn-secondary" id='btn_reset' onclick="reset_all()">Reset</button>

                </div>
            </div>
        </form>
    </div>

</section>
@endsection

@push('scripts')
<script>
    $(document).ready(function() {

        DataTable();
        Load_All_Data();
        disable_enable(1, 1, 1);
    });

    function DataTable() {
        $("#Seller_tbl").DataTable({
            "scrollY"       : "500px",
            "scrollCollapse": true,
            "paging"        : false,
            "info"          : false
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
            "action": 'AllSellers'
        };
        // console.log(getData);
        $.ajax({
            type: 'POST',
            headers: {
                'X-CSRFToken': token
            },
            url: 'load_All_Sellers',
            data: getData,
            dataType: 'JSON',

            success: function(data) {
                // console.log(data);

                $htmltable1 = '<table id="Seller_tbl" style="cursor:pointer" class="display"><thead><tr><th>NIC NO</th><th>First Name</th><th>Last Name</th><th>Mobile Nomber</th><th>E-Mail</th></tr></thead><tbody>';

                data.forEach(val => {

                    $htmltable = '<tr onclick="tbl_row_cick(' + val.id + ')"><td>' + val.nicno +
                        '</td><td>' + val.fname +
                        '</td><td>' + val.lname +
                        '</td><td>' + val.MobileNo +
                        '</td><td>' + val.email +
                        '</td></tr>';

                    $htmltable1 = $htmltable1 + $htmltable;
                });
                $htmltable1 = $htmltable1 + '</tbody></table>';
                $('#container1').append($htmltable1);
                DataTable();
            }
        });
    };

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
        // console.log(getData);
        $.ajax({
            type: 'POST',
            headers: {
                'X-CSRFToken': token
            },
            url: 'tbl_click_to_seller_data',
            data: Data,
            dataType: 'JSON',

            success: function(data) {
                // console.log(data);

                data.forEach(val => {

                    $('#dis_input_nicno').val(val.nicno);
                    $('#dis_input_email').val(val.email);
                    $('#dis_input_phone_no').val(val.MobileNo);
                    $('#dis_input_fname').val(val.fname);
                    $('#dis_input_lname').val(val.lname);
                    $('#input_seller_id').val(val.id);
                });

                disable_enable(0, 0, 0);
                // pra -> btn_new_seller_reg, btn_reset
            }
        });
    };

    $(document).ready(function() {

        $('#btn_new_seller_reg').on('click', function(e) {
            var form = $(this).parents('#post_form');
            $(form).validate({
                rules: {
                    input_product_name: {
                        required: true
                    },
                    input_rece_f_name: {
                        required: true
                    },
                    input_rece_l_name: {
                        required: true
                    },
                    input_rece_address: {
                        required: true
                    },
                    input_rece_phone_no: {
                        required: true,
                        minlength: 10,
                        maxlength: 10
                    },
                    input_seller_id: {
                        required: true
                    },
                    input_clark_id: {
                        required: true
                    },
                },
                messages: {

                    input_product_name: "<p style='color:red;'>* Product Name Required</p>",
                    input_rece_f_name: "<p style='color:red;'>* Receiver First Name Required</p>",
                    input_rece_l_name: "<p style='color:red;'>* Receiver Last Name Required</p>",
                    input_rece_address: "<p style='color:red;'>* Receiver Address Required</p>",
                    input_rece_phone_no: {
                        required: "<p style='color:red;'>* Receiver Phone Number Required</p>",
                        minlength: "<p style='color:red;'>* Please Enter Valid Phone Number</p>",
                        maxlength: "<p style='color:red;'>* Please Enter Valid Phone Number</p>"
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
                        url: 'AddNewPost',
                        data: formData,
                        dataType: 'JSON',
                        processData: false,
                        contentType: false,
                        success: function(data) {
                            console.log(data);
                            if (data.exists) {
                                $('#FornotifDiv').fadeIn();
                                $('#FornotifDiv').html("<p class='alert alert-danger text-center' role=alert>" + "Post Registation Fail...!" + "</p>");
                                setTimeout(() => {
                                    $('#FornotifDiv').fadeOut();
                                }, 3000);
                            } else if (data.success) {

                                $('#FornotifDiv').fadeIn();
                                $('#FornotifDiv').html("<p class='alert alert-success text-center' role=alert>" + "Post Registation successfully" + "</p>");
                                setTimeout(() => {
                                    $('#FornotifDiv').fadeOut();
                                }, 3000);
                                $('[name="input_product_name"]').val('');
                                $('[name="input_rece_f_name"]').val('');
                                $('[name="input_rece_l_name"]').val('');
                                $('[name="input_rece_address"]').val('');
                                $('[name="input_rece_phone_no"]').val('');
                                $('[name="input_seller_id"]').val('');

                                disable_enable(1, 1, 1);
                                // pra -> btn_new_seller_reg, btn_reset

                            } else {
                                $('#FornotifDiv').fadeIn();
                                $('#FornotifDiv').css('background', 'red');
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

        $('[name="input_product_name"]').val('');
        $('[name="input_rece_f_name"]').val('');
        $('[name="input_rece_l_name"]').val('');
        $('[name="input_rece_address"]').val('');
        $('[name="input_rece_phone_no"]').val('');
        $('[name="input_seller_id"]').val('');
        $('[name="input_clark_id"]').val('');

        $('#dis_input_nicno').val('');
        $('#dis_input_email').val('');
        $('#dis_input_phone_no').val('');
        $('#dis_input_fname').val('');
        $('#dis_input_lname').val('');
        $('#input_seller_id').val('');

        disable_enable(1, 1, 1);
        // pra -> btn_new_seller_reg, btn_reset

    };

    function disable_enable($btn_new_seller_reg, $btn_reset, $receiverForm) {

        if ($btn_new_seller_reg == 1) {
            document.getElementById("btn_new_seller_reg").disabled = true;
        } else if ($btn_new_seller_reg == 0) {
            document.getElementById("btn_new_seller_reg").disabled = false;
        }


        if ($btn_reset == 1) {
            document.getElementById("btn_reset").disabled = true;
        } else if ($btn_reset == 0) {
            document.getElementById("btn_reset").disabled = false;
        }

        if ($receiverForm == 1) {
            document.getElementById("input_product_name").disabled = true;
            document.getElementById("input_rece_f_name").disabled = true;
            document.getElementById("input_rece_l_name").disabled = true;
            document.getElementById("input_rece_address").disabled = true;
            document.getElementById("input_rece_phone_no").disabled = true;
        } else if ($receiverForm == 0) {
            document.getElementById("input_product_name").disabled = false;
            document.getElementById("input_rece_f_name").disabled = false;
            document.getElementById("input_rece_l_name").disabled = false;
            document.getElementById("input_rece_address").disabled = false;
            document.getElementById("input_rece_phone_no").disabled = false;
        }

    };
</script>
@endpush