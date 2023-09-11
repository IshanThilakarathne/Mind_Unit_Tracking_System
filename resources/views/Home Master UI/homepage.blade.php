@extends('Home Master UI.Main Layouts.master')
@extends('Home Master UI.Main Layouts.navibar')
@section('constant')

<div class="header">
    <form id='track_form'>
        <h1 style="color: white;text-align: center;">WELCOME TO MUTS</h1>
        <h2 style="color: white;text-align: center;">Track your post here</h2>
        <div class="form-box">
            <input type="number" style="text-align:center;" maxlength="5" class="search-field" id="input_track_number" name="input_track_number" placeholder="Enter your tracking number">
            <br>
            <br>

            <button class="search-btn" onclick="track_now()" id="btn_track" type="button">Tracking</button>
        </div>
        <br>
        <div class="col-12">
            <div id="FornotifDiv"></div>
        </div>
    </form>
</div>

<div class="container" id="container">
    <!-- More Details Model -->
    <div class="modal fade cd-example-modal-xl" id="More_data_Model" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Details Of Post Status</h5>
                    <button type="button" class="close" data-dismiss="modal" onclick="model_close()" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                    <div class="row g-3">

                        <div class="col-md-2">
                            <label for="name" class="form-label"><b>Product Name </b></label>
                        </div>
                        <div class="col-md-4">
                            <label for="name" class="form-label" id="product_name" value=""></label>
                        </div>

                        <div class="col-md-2">
                            <label for="name" class="form-label"><b>Post ID</b></label>
                        </div>

                        <div class="col-md-4">
                            <label for="name" class="form-label" id="post_id" value=""></label>
                        </div>

                    </div>

                    <table class="table table-dark">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Proccess</th>
                                <th scope="col">Status</th>
                                <th scope="col">Completed Time</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <th scope="row">1</th>
                                <td>Package Processing Started</td>
                                <td id="Package_Processing_Started"></td>
                                <td id="dtPackage_Processing_Started"></td>
                            </tr>
                            <tr>
                                <th scope="row">2</th>
                                <td>Package Being Prepared</td>
                                <td id="Package_Being_Prepared"></td>
                                <td id="dtPackage_Being_Prepared"></td>
                            </tr>
                            <tr>
                                <th scope="row">3</th>
                                <td>Pickup In Progress</td>
                                <td id="Pickup_In_Progress"></td>
                                <td id="dtPickup_In_Progress"></td>
                            </tr>
                            <th scope="row">4</th>
                            <td>Arrived At Our Warehouse</td>
                            <td id="Arrived_at_Our_Warehouse"></td>
                            <td id="dtArrived_at_Our_Warehouse"></td>
                            </tr>
                            <th scope="row">5</th>
                            <td>Shipped</td>
                            <td id="Shipped"></td>
                            <td id="dtShipped"></td>
                            </tr>
                            <th scope="row">6</th>
                            <td>Out For Delivery</td>
                            <td id="Out_For_Delivery"></td>
                            <td id="dtOut_For_Delivery"></td>
                            </tr>
                            <th class="row7" scope="row">7</th>
                            <td>Delivered</td>
                            <td id="Delivered"></td>
                            <td id="dtDelivered"></td>
                            </tr>
                        </tbody>
                    </table>
                    <br>
                    <form id="complaint_form" class="row g-3">
                        <div class="col-12">

                            <div id="FormFornotifDiv"></div>

                        </div>
                        <div class="col-md-12 text-center">
                            <label for="name" class="form-label">If you have any questions about this Post</label>
                        </div>
                        <div class="col-md-12">
                            <label for="name" class="form-label">Write Complaint here</label>
                            <textarea type="text" class="form-control" id="input_msg" name="input_msg"> </textarea>
                        </div>

                        <input type="hidden" class="form-control" id="input_post_id" name="input_post_id">

                        <input type="hidden" class="form-control" id="input_seller_id" name="input_seller_id">



                        <div class="col-12">
                            <div class="col text-center">
                                <button class="btn btn-dark" id='btn_complaint'>Complaint Now</button>

                                <button type="button" class="btn btn-secondary" id='btn_reset' onclick="reset_all()">Reset</button>

                                <button type="button" class="btn btn-success" id='btn_reset' onclick="model_close()">Cancel</button>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">

                    <span id="btn_Buy_now_Place">

                    </span>


                </div>
            </div>
        </div>
    </div>
    <!-- More Details Model end -->


</div>
@endsection

@push('scripts')

<script>
    function track_now() {

        $track_no = $('#input_track_number').val();

        if ($track_no) {

            var token = $('input[name="csrfToken"]').attr('value');

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            var Data = {
                "id": $track_no
            };
            // console.log(getData);
            $.ajax({
                type: 'POST',
                headers: {
                    'X-CSRFToken': token
                },
                url: 'check_status',
                data: Data,
                dataType: 'JSON',

                success: function(data) {
                    console.log(data);

                    if (data.error == "No Data") {
                        $('#FornotifDiv').fadeIn();
                        $('#FornotifDiv').html("<p class='alert alert-danger text-center' role=alert>" + "Please Enter Valid Tracking Number" + "</p>");
                        setTimeout(() => {
                            $('#FornotifDiv').fadeOut();
                        }, 3000);
                    } else {
                        data.forEach(val => {

                            $('#product_name').text(val.product_name);
                            $('#post_id').text(val.id);

                            $('#Package_Processing_Started').text(val.Package_Processing_Started);
                            $('#Package_Being_Prepared').text(val.Package_Being_Prepared);
                            $('#Pickup_In_Progress').text(val.Pickup_In_Progress);
                            $('#Arrived_at_Our_Warehouse').text(val.Arrived_at_Our_Warehouse);
                            $('#Shipped').text(val.Shipped);
                            $('#Out_For_Delivery').text(val.Out_For_Delivery);
                            $('#Delivered').text(val.Delivered);

                            $('#dtPackage_Processing_Started').text(val.Package_Processing_Started_d_t);
                            $('#dtPackage_Being_Prepared').text(val.Package_Being_Prepared_d_t);
                            $('#dtPickup_In_Progress').text(val.Pickup_In_Progress_d_t);
                            $('#dtArrived_at_Our_Warehouse').text(val.Arrived_at_Our_Warehouse_d_t);
                            $('#dtShipped').text(val.Shipped_d_t);
                            $('#dtOut_For_Delivery').text(val.Out_For_Delivery_d_t);
                            $('#dtDelivered').text(val.Delivered_d_t);

                            $('#input_post_id').val(val.id);
                            $('#input_seller_id').val(val.seller_id);

                        });

                        $('#More_data_Model').modal('show');
                    }
                }
            });

        } else {

            $('#FornotifDiv').fadeIn();
            $('#FornotifDiv').html("<p class='alert alert-danger text-center' role=alert>" + "Please Enter Tracking Number" + "</p>");
            setTimeout(() => {
                $('#FornotifDiv').fadeOut();
            }, 3000);
        }
    };

    function model_close() {
        $('#More_data_Model').modal('hide');

    };

    function reset_all() {

        $('[name="input_msg"]').val('');

    };

    $(document).ready(function() {

        $('#btn_complaint').on('click', function(e) {


            var form = $(this).parents('#complaint_form');
            $(form).validate({
                rules: {
                    input_post_id: {
                        required: true
                    },
                    input_seller_id: {
                        required: true
                    },
                    input_msg: {
                        required: true,
                        minlength: 20
                    },
                    messages: {
                        input_msg: {
                            required: "<p style='color:red;'>* Please enter your complaint here</p>",
                            minlength: "<p style='color:red;'>* Your complaint must be at least 20 characters.</p>"
                        },

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
                        url: 'complaintNow_to_seller',
                        data: formData,
                        dataType: 'JSON',
                        processData: false,
                        contentType: false,
                        success: function(data) {
                            console.log(data);
                            if (data.exists) {
                                $('#FormFornotifDiv').fadeIn();
                                $('#FormFornotifDiv').html("<p class='alert alert-danger text-center' role=alert>" + "User Complaint send Fail Please Try Again Later" + "</p>");
                                setTimeout(() => {
                                    $('#FormFornotifDiv').fadeOut();
                                }, 3000);
                            } else if (data.success) {

                                $('#FormFornotifDiv').fadeIn();
                                $('#FormFornotifDiv').html("<p class='alert alert-success text-center' role=alert>" + "Your Complaint send Successfully" + "</p>");
                                setTimeout(() => {
                                    $('#FormFornotifDiv').fadeOut();
                                }, 3000);
                                $('[name="input_msg"]').val('');

                            } else {
                                $('#FormFornotifDiv').fadeIn();
                                $('#FormFornotifDiv').css('background', 'red');
                                $('#FormFornotifDiv').html("<p class='alert alert-danger text-center' role=alert>" + "An error occured. Please try later" + "</p>");
                                setTimeout(() => {
                                    $('#FormFornotifDiv').fadeOut();
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