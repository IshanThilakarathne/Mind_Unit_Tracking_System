@extends('Admin UI.Admin Pages.masteradminpage')
@section('constant')
<section>

    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">All Post</a>
        </div>
    </nav>

    <div class="container" id="container1"></div>

    <div class="container" id="container">
        <form id="post_form" class="row g-3">
            <div class="col-12">

                <div id="FormotifDiv"></div>

            </div>
            <div class="col-md-4">
                <label for="name" class="form-label">Product Name</label>
                <input type="text" class="form-control" id="product_name" name="product_name">
            </div>

            <div class="col-md-4">
                <label class="form-label">Customer Phone Number</label>
                <input type="number" class="form-control" id="receiver_phone_no" name="receiver_phone_no">
            </div>

            <div class="col-md-4">
                <label class="form-label">Barcode Print Status</label>
                <select id="bar_code_print" name="bar_code_print" class="form-control">
                    <option value="1">Printed</option>
                    <option value="0">Print Pending</option>
                </select>
            </div>

            <div class="col-md-6">
                <label class="form-label">Customer First Name</label>
                <input type="text" class="form-control" id="receiver_f_name" name="receiver_f_name">
            </div>
            <div class="col-md-6">
                <label class="form-label">Customer Last Name</label>
                <input type="text" class="form-control" id="receiver_l_name" name="receiver_l_name">
            </div>

            <div class="col-12">
                <label class="form-label">Customer Address</label>
                <input type="text" class="form-control" id="receiver_address" name="receiver_address">
            </div>

            <div class="col-md-4">
                <label class="form-label">Package_Processing_Started</label>
                <select id="Package_Processing_Started" name="Package_Processing_Started" class="form-control">
                    <option value="Completed">Completed</option>
                    <option value="Pending">Pending</option>
                </select>
            </div>

            <div class="col-md-4">
                <label class="form-label">Package_Being_Prepared</label>
                <select id="Package_Being_Prepared" name="Package_Being_Prepared" class="form-control">
                    <option value="Pending">Pending</option>
                    <option value="Completed">Completed</option>
                </select>
            </div>

            <div class="col-md-4">
                <label class="form-label">Pickup_In_Progress</label>
                <select id="Pickup_In_Progress" name="Pickup_In_Progress" class="form-control">
                    <option value="Pending">Pending</option>
                    <option value="Completed">Completed</option>
                </select>
            </div>

            <div class="col-md-4">
                <label class="form-label">Arrived_at_Our_Warehouse</label>
                <select id="Arrived_at_Our_Warehouse" name="Arrived_at_Our_Warehouse" class="form-control">
                    <option value="Pending">Pending</option>
                    <option value="Completed">Completed</option>
                </select>
            </div>

            <div class="col-md-4">
                <label class="form-label">Shipped</label>
                <select id="Shipped" name="Shipped" class="form-control">
                    <option value="Pending">Pending</option>
                    <option value="Completed">Completed</option>
                </select>
            </div>

            <div class="col-md-4">
                <label class="form-label">Out_For_Delivery</label>
                <select id="Out_For_Delivery" name="Out_For_Delivery" class="form-control">
                    <option value="Pending">Pending</option>
                    <option value="Completed">Completed</option>
                </select>
            </div>

            <div class="col-md-4">
                <label class="form-label">Delivered</label>
                <select id="Delivered" name="Delivered" class="form-control">
                    <option value="Pending">Pending</option>
                    <option value="Completed">Completed</option>
                </select>
            </div>
            <div class="col-md-4">
                <input type="hidden" class="form-control" id="post_id" name="post_id">
                <input type="hidden" class="form-control" id="del_id" name="del_id">
            </div>
            <div class="col-12">
                <div class="col text-center">
                    <button class="btn btn-labeled btn-success" id='btn_update'>Update</button>
                    <button type="button" class="btn btn-secondary" id='btn_reset' onclick="reset_all()">Reset</button>
                    <button type="button" class="btn btn-danger" id='btn_delete' onclick="Dlete_comform()">Delete</button>
                </div>
            </div>
        </form>
    </div>


    <div class="container" id="container4">

        <!-- Modal -->
        <div class="modal fade" id="Delete_Comform_Model" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle">Comform Post Delete</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close" onclick="Delete_model_close()">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <p id="delete_com_id" value=""></p>
                        <p>Are You Sure Delete This Post?</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal" onclick="Delete_model_close()">Cancel</button>
                        <button type="button" class="btn btn-primary" onclick="Post_Delete()">Delete Now</button>
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
        btn_disable_enable(1, 1, 1);
        reset_all();
    });

    function DataTable() {
        $("#table_id").DataTable({
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
            "action": 'AllPost'
        };
        // console.log(getData);
        $.ajax({
            type: 'POST',
            headers: {
                'X-CSRFToken': token
            },
            url: 'load_All_Post',
            data: getData,
            dataType: 'JSON',

            success: function(data) {
                // console.log(data);

                $htmltable1 = '<table id="table_id" style="cursor:pointer" class="display"><thead><tr><th>Post ID</th><th>Product Name</th><th>Seller ID</th><th>Customer First Name</th><th>Customer Last Name</th><th>Status</th></tr></thead><tbody>';

                data.forEach(val => {

                    $htmltable = '<tr onclick="tbl_row_cick(' + val.id + ')"><td>' + val.id +
                        '</td><td>' + val.product_name +
                        '</td><td>' + val.seller_id +
                        '</td><td>' + val.receiver_f_name +
                        '</td><td>' + val.receiver_l_name +
                        '</td><td>' + val.Delivered +
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
            url: 'tbl_click_to_post',
            data: Data,
            dataType: 'JSON',

            success: function(data) {
                // console.log(data);

                data.forEach(val => {

                    $('#post_id').val(val.id);
                    $('#del_id').val(val.id);
                    $('#product_name').val(val.product_name);
                    $('#receiver_f_name').val(val.receiver_f_name);
                    $('#receiver_l_name').val(val.receiver_l_name);
                    $('#receiver_phone_no').val(val.receiver_phone_no);
                    $('#receiver_address').val(val.receiver_address);
                    $('#bar_code_print').val(val.bar_code_print);
                    $('#Package_Processing_Started').val(val.Package_Processing_Started);
                    $('#Package_Being_Prepared').val(val.Package_Being_Prepared);
                    $('#Pickup_In_Progress').val(val.Pickup_In_Progress);
                    $('#Arrived_at_Our_Warehouse').val(val.Arrived_at_Our_Warehouse);
                    $('#Shipped').val(val.Shipped);
                    $('#Out_For_Delivery').val(val.Out_For_Delivery);
                    $('#Delivered').val(val.Delivered);
                });

                btn_disable_enable(0, 0, 0);
            }
        });
    };

    $(document).ready(function() {

        $('#btn_update').on('click', function(e) {

            var form = $(this).parents('#post_form');
            $(form).validate({
                rules: {
                    post_id: {
                        required: true
                    },
                    product_name: {
                        required: true
                    },
                    receiver_f_name: {
                        required: true
                    },
                    receiver_l_name: {
                        required: true
                    },
                    receiver_phone_no: {
                        required: true
                    },
                    receiver_address: {
                        required: true
                    },
                    bar_code_print: {
                        required: true
                    },
                    Package_Processing_Started: {
                        required: true
                    },
                    Package_Being_Prepared: {
                        required: true
                    },
                    Pickup_In_Progress: {
                        required: true
                    },
                    Arrived_at_Our_Warehouse: {
                        required: true
                    },
                    Shipped: {
                        required: true
                    },
                    Out_For_Delivery: {
                        required: true
                    },
                    Delivered: {
                        required: true
                    },
                },
                messages: {
                    product_name: {
                        required: "<p style='color:red;'>* Product Name Required</p>"
                    },
                    receiver_f_name: "<p style='color:red;'>* Customer First Name Required</p>",
                    receiver_l_name: "<p style='color:red;'>* Customer Last Name Required</p>",
                    receiver_phone_no: "<p style='color:red;'>* Customer Phone Number Required</p>",
                    receiver_address: "<p style='color:red;'>* Customer Address Required</p>",
                    bar_code_print: {
                        required: "<p style='color:red;'>* Barcode Status Required</p>"
                    },
                    Package_Processing_Started: "<p style='color:red;'>* Package Processing Started Required</p>",
                    Package_Being_Prepared: "<p style='color:red;'>* Package Being Prepared Required</p>",
                    Pickup_In_Progress: "<p style='color:red;'>* Pickup In Progress Required</p>",
                    Arrived_at_Our_Warehouse: "<p style='color:red;'>* Arrived At Our Warehouse Required</p>",
                    Shipped: "<p style='color:red;'>* Shipped Required</p>",
                    Out_For_Delivery: "<p style='color:red;'>* Out For Delivery Required</p>",
                    Delivered: "<p style='color:red;'>* Delivered Required</p>"
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
                        url: 'Post_update',
                        data: formData,
                        dataType: 'JSON',
                        processData: false,
                        contentType: false,
                        success: function(data) {
                            if (data.exists) {
                                $('#FormotifDiv').fadeIn();
                                $('#FormotifDiv').html("<p class='alert alert-danger text-center' role=alert>" + "Post Update Fail" + "</p>");
                                setTimeout(() => {
                                    $('#FormotifDiv').fadeOut();
                                }, 3000);
                            } else if (data.success) {

                                $('#FormotifDiv').fadeIn();
                                $('#FormotifDiv').html("<p class='alert alert-success text-center' role=alert>" + "Update successfully" + "</p>");
                                setTimeout(() => {
                                    $('#FormotifDiv').fadeOut();
                                }, 2000);
                                reset_all();
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

        var Postid = $('#del_id').val();

        $('#delete_com_id').text("Post ID - " + Postid);
        $('#Delete_Comform_Model').modal('show');
    };

    function Delete_model_close() {
        $('#Delete_Comform_Model').modal('hide');
    };

    function Post_Delete() {

        Delete_model_close();
        $postid = $('#del_id').val();
        var token = $('input[name="csrfToken"]').attr('value');
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        var Data = {
            "id": $postid
        };

        $.ajax({
            type: 'POST',
            headers: {
                'X-CSRFToken': token
            },
            url: 'Post_delete',
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
                    reset_all();

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

    function btn_disable_enable($btn_update, $btn_reset, $btn_delete) {

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
    };

    function reset_all() {

        $('[name="product_name"]').val('');
        $('[name="receiver_f_name"]').val('');
        $('[name="receiver_l_name"]').val('');
        $('[name="receiver_phone_no"]').val('');
        $('[name="receiver_address"]').val('');
        $('[name="bar_code_print"]').val('');
        $('[name="Package_Processing_Started"]').val('');
        $('[name="Package_Being_Prepared"]').val('');
        $('[name="Pickup_In_Progress"]').val('');
        $('[name="Arrived_at_Our_Warehouse"]').val('');
        $('[name="Shipped"]').val('');
        $('[name="Out_For_Delivery"]').val('');
        $('[name="Delivered"]').val('');

        btn_disable_enable(1, 1, 1);
    };
</script>

@endpush