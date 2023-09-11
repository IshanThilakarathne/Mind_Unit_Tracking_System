@extends('Admin UI.Admin Pages.masteradminpage')
@section('constant')
<section>

    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">All Admin Notifications</a>
        </div>
    </nav>

    <div class="container" id="container1">
        <div class="col-12">

            <div id="FornotifDiv"></div>

        </div>
    </div>

    <div class="container" id="container2">

        <!-- Modal -->
        <div class="modal fade" id="Delete_Comform_Model" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle">Comform Message Delete</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close" onclick="model_close()">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" id="delete_com_id">
                        <p>Would you like to delete this message?</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal" onclick="model_close()">No</button>
                        <button type="button" class="btn btn-primary" onclick="Delete_Now()">Delete Now</button>
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
    });

    function DataTable() {
        $("#allMsg_tbl").DataTable({
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
            "action": 'AlladminMsg'
        };
        $.ajax({
            type: 'POST',
            headers: {
                'X-CSRFToken': token
            },
            url: 'gelAllAdminMsg',
            data: getData,
            dataType: 'JSON',

            success: function(data) {
                // console.log(data);

                $htmltable1 = '<table id="allMsg_tbl" style="cursor:pointer" class="display"><thead><tr><th>Post ID</th><th>User ID</th><th>Notification</th><th>Date / Time</th></tr></thead><tbody>';

                data.forEach(val => {

                    $htmltable = '<tr onclick="Dlete_comform(' + val.id + ')"><td>' + val.post_id +
                        '</td><td>' + val.user_id +
                        '</td><td>' + val.notification +
                        '</td><td>' + val.date_time +
                        '</td></tr>';

                    $htmltable1 = $htmltable1 + $htmltable;
                });
                $htmltable1 = $htmltable1 + '</tbody></table>';
                $('#container1').append($htmltable1);
                DataTable();
            }
        });
    };

    function Dlete_comform($id) {
        $('#delete_com_id').val($id);
        $('#Delete_Comform_Model').modal('show');
    };

    function Delete_Now() {
        $id = $('#delete_com_id').val();
       
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
            url: 'delete_admin_msg',
            data: Data,
            dataType: 'JSON',

            success: function(data) {
                // console.log(data);
                model_close();
                if (data.exists) {
                    $('#FornotifDiv').fadeIn();
                    $('#FornotifDiv').html("<p class='alert alert-danger text-center' role=alert>" + "User Delete Fail" + "</p>");
                    setTimeout(() => {
                        $('#FornotifDiv').fadeOut();
                    }, 3000);
                } else if (data.success) {

                    $('#FornotifDiv').fadeIn();
                    $('#FornotifDiv').html("<p class='alert alert-success text-center' role=alert>" + "User Delete successfully" + "</p>");
                    setTimeout(() => {
                        $('#FornotifDiv').fadeOut();
                    }, 2000);
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
    };

    function model_close() {
        $('#Delete_Comform_Model').modal('hide');
    };
</script>
@endpush