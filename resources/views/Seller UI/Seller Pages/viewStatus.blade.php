@extends('Seller UI.Seller Pages.masterSellerPge')
@section('constant')
<section>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">All Post Satatus</a>
        </div>
    </nav>

    @if(Auth::check())

    <input type="hidden" class="form-control" id="input_seller_id" name="input_seller_id" value='{{Auth::user()->id}}'>

    @endif


    <div class="container" id="container1"></div>


    <div class="container" id="container2">

        <!-- More Details Model -->
        <div class="modal fade cd-example-modal-xl" id="More_data_Model" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-xl">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle">More Details Of Status</h5>
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
                                <label for="name" class="form-label"><b>Clark ID</b></label>
                            </div>
                            <div class="col-md-4">
                                <label for="name" class="form-label" id="clark_id" value=""></label>
                            </div>

                            <div class="col-md-2">
                                <label for="name" class="form-label"><b>Customer Address</b></label>
                            </div>
                            <div class="col-md-4">
                                <label for="name" class="form-label" id="cus_address" value=""></label>
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
                                <th scope="row">7</th>
                                <td>Delivered</td>
                                <td id="Delivered"></td>
                                <td id="dtDelivered"></td>
                                </tr>
                            </tbody>
                        </table>
                        <br>
                        <form id="complaint_form" class="row g-3">
                            <div class="col-12">

                                <div id="FornotifDiv"></div>

                            </div>
                            <div class="col-md-12 text-center">
                                <label for="name" class="form-label">If you have any questions about this Post</label>
                            </div>
                            <div class="col-md-12">
                                <label for="name" class="form-label">Wtite Complaint here</label>
                                <textarea type="text" class="form-control" id="input_msg" name="input_msg"> </textarea>
                            </div>

                            <input type="hidden" class="form-control" id="input_post_id" name="input_post_id">

                            @if(Auth::check())

                            <input type="hidden" class="form-control" id="input_seller_id" name="input_seller_id" value='{{Auth::user()->id}}'>

                            @endif

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

</section>
@endsection

@push('scripts')
<script>
    $(document).ready(function() {

        DataTable();
        Load_All_Data();
    });

    function DataTable() {
        $("#Post_status_tbl").DataTable({
            "scrollY": "500px",
            "scrollCollapse": true,
            "paging": false,
            "info": false
        });
    };

    function Load_All_Data() {

        $id = $('#input_seller_id').val();

        var token = $('input[name="csrfToken"]').attr('value');

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        var getData = {
            "id": $id
        };

        $.ajax({
            type: 'POST',
            headers: {
                'X-CSRFToken': token
            },
            url: 'load_All_Post_Status',
            data: getData,
            dataType: 'JSON',

            success: function(data) {
                // console.log(data);

                $htmltable1 = '<table id="Post_status_tbl" style="cursor:pointer" class="display"><thead><tr><th>Product Name</th><th>Customer First Name</th><th>Customer Last Name</th><th>Mobile Nomber</th><th>Status</th></tr></thead><tbody>';

                data.forEach(val => {

                    $htmltable = '<tr onclick="tbl_row_cick(' + val.id + ')"><td>' + val.product_name +
                        '</td><td>' + val.receiver_f_name +
                        '</td><td>' + val.receiver_l_name +
                        '</td><td>' + val.receiver_phone_no +
                        '</td><td style="color: #fff; background: black;">' + val.Delivered +
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
        $.ajax({
            type: 'POST',
            headers: {
                'X-CSRFToken': token
            },
            url: 'tbl_click_to_Get_More',
            data: Data,
            dataType: 'JSON',

            success: function(data) {
                console.log(data);

                data.forEach(val => {

                    $('#product_name').text(val.product_name);
                    $('#clark_id').text(val.clark_id);
                    $('#cus_address').text(val.receiver_address);
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
                });
                $('#More_data_Model').modal('show');
            }
        });
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
                        url: 'complaintNow',
                        data: formData,
                        dataType: 'JSON',
                        processData: false,
                        contentType: false,
                        success: function(data) {
                            console.log(data);
                            if (data.exists) {
                                $('#FornotifDiv').fadeIn();
                                $('#FornotifDiv').html("<p class='alert alert-danger text-center' role=alert>" + "User Complaint send Fail Please Try Again Later" + "</p>");
                                setTimeout(() => {
                                    $('#FornotifDiv').fadeOut();
                                }, 3000);
                            } else if (data.success) {

                                $('#FornotifDiv').fadeIn();
                                $('#FornotifDiv').html("<p class='alert alert-success text-center' role=alert>" + "Your Complaint send Successfully" + "</p>");
                                setTimeout(() => {
                                    $('#FornotifDiv').fadeOut();
                                }, 3000);
                                $('[name="input_msg"]').val('');

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

        $('[name="input_msg"]').val('');
    };

    function model_close() {
        $('#More_data_Model').modal('hide');
    };
</script>
@endpush