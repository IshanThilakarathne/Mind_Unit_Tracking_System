@extends('Clark UI.Clark Pages.masterClarkPge')
@section('constant')
<section>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">Proccess Start / Barcode Print</a>
        </div>
    </nav>

    <div class="container" id="container1"></div>

    <div class="container" id="container2">

        <button id="printInvoice" onclick="pdf('printbody')" class="btn btn-info"><i class="fa fa-print"></i> Print</button>
        <input type="hidden" id="post_id">
        <div id="invoice">
            <div class="invoice overflow-auto" id='printbody'>
                <div style="min-width: 600px">
                    <header>
                        <div class="row">
                            <div class="col">
                                <a target="_blank" href="">
                                    <img src="/Pdf/MUTS logo3.png" data-holder-rendered="true" />
                                </a>
                            </div>
                            <div class="col company-details">
                                <h2 class="name">
                                    <a target="_blank">
                                        M.U.Tracking System
                                    </a>
                                </h2>
                                <div>Carmel Mawatha, Street: 50/2 Reclamation Road, Sri Lanka</div>
                                <div>City: Colombo.</div>
                                <div>contactus@mutracking.lk</div>
                            </div>
                        </div>
                    </header>
                    <main>
                        <div class="row contacts">
                            <div class="col invoice-to">
                                <div class="text-gray-light">TO:</div>
                                <h2 class="to" id="r_name">Ishan Kumara</h2>
                                <div class="address" id="r_address">Carmel Mawatha, Street: 50/2 Reclamation Road.</div>
                                <div class="email"><a id="r_email"></a></div>
                            </div>
                            <div class="col invoice-details">
                                <div class="text-gray-light">FROM :</div>
                                <h2 class="to" id="s_name">Nimesh Priyankara</h2>
                                <div class="address" id="s_address">No 20, Rathgalla Waththa, Boyagene, Kurunegala.</div>
                                <div class="email"><a id="s_email">ishan@example.com</a></div>
                            </div>
                        </div>
                        <table border="0" cellspacing="0" cellpadding="0">
                            <thead>
                                <tr>
                                    <td>
                                        <svg id="barcode"></svg>
                                    </td>
                                </tr>
                            </thead>
                            <tbody>
                                <tr></tr>
                                <tr></tr>
                                <tr></tr>
                                <tr></tr>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <td></td>
                                    <td></td>
                                    <td>

                                    </td>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td>Customer contact number</td>
                                    <td id="cus_contract_no">0711534385</td>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td></td>
                                    <td></td>

                                </tr>
                            </tfoot>
                        </table>
                        <div class="thanks">Thank you!</div>
                        <div class="notices">
                            <div>NOTICE:</div>
                            <div class="notice">Delivery Instructions : Call before the delivery.</div>
                        </div>
                    </main>
                    <footer>
                        Invoice was created on a our computer system and is valid without the signature and seal.
                    </footer>
                </div>
                <div></div>
            </div>
        </div>
    </div>

</section>
@endsection

@push('scripts')
<script>
    $(document).ready(function() {
        document.getElementById("printInvoice").disabled = true;
        $("#invoice").hide();
        Load_All_Print_Pending_Data();
        DataTable();
    });

    function DataTable() {
        $("#PendingPost_tbl").DataTable({
            "scrollY"       : "500px",
            "scrollCollapse": true,
            "paging"        : false,
            "info"          : false
        });
    };

    function Load_All_Print_Pending_Data() {

        var token = $('input[name="csrfToken"]').attr('value');

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        var getData = {
            "action": 'All Print Pending'
        };
        // console.log(getData);
        $.ajax({
            type: 'POST',
            headers: {
                'X-CSRFToken': token
            },
            url: 'load_All_Print_pending',
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

    function pdf() {
        document.getElementById("printInvoice").disabled = true;

        const element = document.getElementById("invoice");

        html2pdf()
            .from(element)
            .save();
        var tbl_wrapper = document.getElementById("PendingPost_tbl");
        tbl_wrapper.remove();
        print_status_update();
    };

    function barcode($text) {

        JsBarcode("#barcode", $text, {
            width: 4,
            height: 40
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
            url: 'Get_Currunt_Print_data',
            data: Data,
            dataType: 'JSON',

            success: function(data) {
                console.log(data);

                data.forEach(val => {

                    $('#post_id').val(val.id);
                    $('#r_name').text(val.receiver_f_name + " " + val.receiver_l_name);
                    $('#r_address').text(val.receiver_address);
                    $('#cus_contract_no').text(val.receiver_phone_no);

                    $('#s_name').text(val.fname + " " + val.lname);
                    $('#s_address').text(val.address);
                    $('#s_email').text(val.email);

                    barcode(val.id);
                    document.getElementById("printInvoice").disabled = false;
                    $("#invoice").show();
                });
            }
        });
    };

    function print_status_update() {

        $id = $('#post_id').val();

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
            url: 'print_satatusUpdate',
            data: Data,
            dataType: 'JSON',

            success: function(data) {
                setTimeout(location.reload.bind(location), 3000);
            }
        });
    };
</script>
@endpush