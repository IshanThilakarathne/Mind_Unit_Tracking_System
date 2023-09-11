@extends('Clark UI.Clark Pages.masterClarkPge')
@section('constant')
<section>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">Post Status Update</a>
        </div>
    </nav>

    <div class="container" id="container1"></div>

    <div class="container" id="container2">
        <div class="col-md-12 text-center">
            <div class="col-12">
                <div id="FornotifDiv"></div>
            </div>
        </div>
        <form id="status_form" class="row g-3">

            <div class="col-md-12 text-center">
                <label for="name" class="form-label">--------------------- Status Update---------------------</label>
            </div>
            <div class="col-md-4 text-center">
                <label for="name" class="form-label">Package Processing Started</label>
                <input id="process1" name="process1" style="text-align:center;" placeholder="Pending" class="form-control">
            </div>

            <div class="col-md-4 text-center">
                <label for="name" class="form-label">Package Being Prepared</label>
                <input id="process2" name="process2" style="text-align:center;" placeholder="Pending" class="form-control">
            </div>

            <div class="col-md-4 text-center">
                <label for="name" class="form-label">Pickup In Progress</label>
                <input id="process3" name="process3" style="text-align:center;" placeholder="Pending" class="form-control">
            </div>

            <div class="col-md-4 text-center">
                <label for="name" class="form-label">Arrived At Our Warehouse</label>
                <input id="process4" name="process4" style="text-align:center;" placeholder="Pending" class="form-control">
            </div>

            <div class="col-md-4 text-center">
                <label for="name" class="form-label">Shipped</label>
                <input id="process5" name="process5" style="text-align:center;" placeholder="Pending" class="form-control">
            </div>

            <div class="col-md-4 text-center">
                <label for="name" class="form-label">Out For Delivery</label>
                <input id="process6" name="process6" style="text-align:center;" placeholder="Pending" class="form-control">
            </div>

            <div class="col-md-4 text-center">
                <label for="name" class="form-label">Delivered</label>
                <input id="process7" name="process7" style="text-align:center;" placeholder="Pending" class="form-control">
            </div>
            <input type="hidden" class="form-control" id="stage" name="stage">
            <input type="hidden" class="form-control" id="id" name="id">
            <input type="hidden" class="form-control" id="seller_id" name="seller_id">
            @if(Auth::check())
            <input type="hidden" class="form-control" id="user_id" name="user_id" value='{{Auth::user()->id}}'>
            @endif

            <div class="col-12">
                <div class="col text-center">
                    <button class="btn btn-primary" id='btn_update'>Complete Current Process</button>
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
        Load_All_Pending_Data();
        disabledfunction();
        $("#status_form").hide();
    });

    function DataTable() {
        $("#PendingPost_tbl").DataTable({
            "scrollY"       : "500px",
            "scrollCollapse": true,
            "paging"        : false,
            "info"          : false
        });
    };

    function Load_All_Pending_Data() {

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
            url: 'load_All_pending_delivery',
            data: getData,
            dataType: 'JSON',

            success: function(data) {
                // console.log(data);

                $htmltable1 = '<table id="PendingPost_tbl" style="cursor:pointer" class="display"><thead><tr><th>Product Name</th><th>Seller ID</th><th>Clark ID</th><th>Receiver First Name</th><th>Receiver Last Name</th></tr></thead><tbody>';

                data.forEach(val => {

                    $htmltable = '<tr onclick="tbl_row_cick(' + val.id + ')"><td>' + val.product_name +
                        '</td><td>' + val.seller_id +
                        '</td><td>' + val.clark_id +
                        '</td><td>' + val.receiver_f_name +
                        '</td><td>' + val.receiver_l_name +
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
            url: 'Get_Currunt_Status',
            data: Data,
            dataType: 'JSON',

            success: function(data) {
                // console.log(data);

                data.forEach(val => {

                    $('#process1').val(val.Package_Processing_Started);
                    $('#process2').val(val.Package_Being_Prepared);
                    $('#process3').val(val.Pickup_In_Progress);
                    $('#process4').val(val.Arrived_at_Our_Warehouse);
                    $('#process5').val(val.Shipped);
                    $('#process6').val(val.Out_For_Delivery);
                    $('#process7').val(val.Delivered);
                    $('#id').val(val.id);
                    $('#seller_id').val(val.seller_id);
                    $("#status_form").show();
                });
                CheckStatus();
            }
        });
    };

    function CheckStatus() {

        $pro1 = $('#process1').val();
        $pro2 = $('#process2').val();
        $pro3 = $('#process3').val();
        $pro4 = $('#process4').val();
        $pro5 = $('#process5').val();
        $pro6 = $('#process6').val();
        $pro7 = $('#process7').val();

        if ($pro1 == "Pending") {
            $('#stage').val('stage1');
            $('#process1').val('In Progress');
            inputtextColorChange(1, 0, 0, 0, 0, 0, 0);

        } else if ($pro2 == "Pending") {
            $('#stage').val('stage2');
            $('#process2').val('In Progress');
            inputtextColorChange(2, 1, 0, 0, 0, 0, 0);
        } else if ($pro3 == "Pending") {
            $('#stage').val('stage3');
            $('#process3').val('In Progress');
            inputtextColorChange(2, 2, 1, 0, 0, 0, 0);
        } else if ($pro4 == "Pending") {
            $('#stage').val('stage4');
            $('#process4').val('In Progress');
            inputtextColorChange(2, 2, 2, 1, 0, 0, 0);
        } else if ($pro5 == "Pending") {
            $('#stage').val('stage5');
            $('#process5').val('In Progress');
            inputtextColorChange(2, 2, 2, 2, 1, 0, 0);
        } else if ($pro6 == "Pending") {
            $('#stage').val('stage6');
            $('#process6').val('In Progress');
            inputtextColorChange(2, 2, 2, 2, 2, 1, 0);
        } else if ($pro7 == "Pending") {
            $('#stage').val('stage7');
            $('#process7').val('In Progress');
            inputtextColorChange(2, 2, 2, 2, 2, 2, 1);
        }
    };

    function disabledfunction() {

        document.getElementById("process1").disabled = true;
        document.getElementById("process2").disabled = true;
        document.getElementById("process3").disabled = true;
        document.getElementById("process4").disabled = true;
        document.getElementById("process5").disabled = true;
        document.getElementById("process6").disabled = true;
        document.getElementById("process7").disabled = true;
    };

    $(document).ready(function() {

        $('#btn_update').on('click', function(e) {

            var form = $(this).parents('#status_form');
            $(form).validate({
                rules: {
                    process1: {
                        required: true
                    },
                    process2: {
                        required: true
                    },
                    process3: {
                        required: true
                    },
                    process4: {
                        required: true
                    },
                    process5: {
                        required: true
                    },
                    process6: {
                        required: true
                    },
                    process7: {
                        required: true
                    },
                    stage: {
                        required: true
                    },
                    user_id: {
                        required: true
                    },
                    seller_id: {
                        required: true
                    },
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
                        url: 'statusaUpdateNow',
                        data: formData,
                        dataType: 'JSON',
                        processData: false,
                        contentType: false,
                        success: function(data) {
                            console.log(data);
                            if (data.exists) {
                                $('#FornotifDiv').fadeIn();
                                $('#FornotifDiv').html("<p class='alert alert-danger text-center' role=alert>" + "User Update Fail" + "</p>");
                                setTimeout(() => {
                                    $('#FornotifDiv').fadeOut();
                                }, 3000);
                            } else if (data.success) {

                                $('#FornotifDiv').fadeIn();
                                $('#FornotifDiv').html("<p class='alert alert-success text-center' role=alert>" + "Update successfully" + "</p>");
                                setTimeout(() => {
                                    $('#FornotifDiv').fadeOut();
                                }, 2000);
                                $('[name="process1"]').val('');
                                $('[name="process2"]').val('');
                                $('[name="process3"]').val('');
                                $('[name="process4"]').val('');
                                $('[name="process5"]').val('');
                                $('[name="process6"]').val('');
                                $('[name="process7"]').val('');


                                $("#status_form").hide();
                                setTimeout(location.reload.bind(location), 3000);
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

    function inputtextColorChange($pro1Col, $pro2Col, $pro3Col, $pro4Col, $pro5Col, $pro6Col, $pro7Col) {

        if ($pro1Col == 0) {

            $('#process1').css("color", "#ffffff");
            $('#process1').css('background', '#ff0000');
        }
        if ($pro1Col == 1) {

            $('#process1').css("color", "#ffffff");
            $('#process1').css('background', '#000000');
        }
        if ($pro1Col == 2) {

            $('#process1').css("color", "#ffffff");
            $('#process1').css('background', '#07ed0f');
        }

        if ($pro2Col == 0) {

            $('#process2').css("color", "#ffffff");
            $('#process2').css('background', '#ff0000');
        }
        if ($pro2Col == 1) {

            $('#process2').css("color", "#ffffff");
            $('#process2').css('background', '#000000');
        }
        if ($pro2Col == 2) {

            $('#process2').css("color", "#ffffff");
            $('#process2').css('background', '#07ed0f');
        }

        if ($pro3Col == 0) {

            $('#process3').css("color", "#ffffff");
            $('#process3').css('background', '#ff0000');
        }
        if ($pro3Col == 1) {

            $('#process3').css("color", "#ffffff");
            $('#process3').css('background', '#000000');
        }
        if ($pro3Col == 2) {

            $('#process3').css("color", "#ffffff");
            $('#process3').css('background', '#07ed0f');
        }

        if ($pro4Col == 0) {

            $('#process4').css("color", "#ffffff");
            $('#process4').css('background', '#ff0000');
        }
        if ($pro4Col == 1) {

            $('#process4').css("color", "#ffffff");
            $('#process4').css('background', '#000000');
        }
        if ($pro4Col == 2) {

            $('#process4').css("color", "#ffffff");
            $('#process4').css('background', '#07ed0f');
        }

        if ($pro5Col == 0) {

            $('#process5').css("color", "#ffffff");
            $('#process5').css('background', '#ff0000');
        }
        if ($pro5Col == 1) {

            $('#process5').css("color", "#ffffff");
            $('#process5').css('background', '#000000');
        }
        if ($pro5Col == 2) {

            $('#process5').css("color", "#ffffff");
            $('#process5').css('background', '#07ed0f');
        }

        if ($pro6Col == 0) {

            $('#process6').css("color", "#ffffff");
            $('#process6').css('background', '#ff0000');
        }
        if ($pro6Col == 1) {

            $('#process6').css("color", "#ffffff");
            $('#process6').css('background', '#000000');
        }
        if ($pro6Col == 2) {

            $('#process6').css("color", "#ffffff");
            $('#process6').css('background', '#07ed0f');
        }

        if ($pro7Col == 0) {

            $('#process7').css("color", "#ffffff");
            $('#process7').css('background', '#ff0000');
        }
        if ($pro7Col == 1) {

            $('#process7').css("color", "#ffffff");
            $('#process7').css('background', '#000000');
        }
        if ($pro7Col == 2) {

            $('#process7').css("color", "#ffffff");
            $('#process7').css('background', '#07ed0f');
        }
    };
</script>


@endpush