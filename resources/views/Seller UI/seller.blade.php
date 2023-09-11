@extends('Seller UI.masterSeller')
@section('constant')
<div class="wrapper">

  <!-- Preloader -->
  <div class="preloader flex-column justify-content-center align-items-center">
    <img class="animation__shake" src="dist/img/AdminLTELogo.png" alt="AdminLTELogo" height="60" width="60">
  </div>

  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-dark bg-dark">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="index3.html" class="nav-link"></a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="#" class="nav-link"><?php echo "Today is " . date("Y/m/d") ?></a>
      </li>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">

      <!-- Notifications Dropdown Menu -->
      <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#">
          <i class="far fa-bell"></i>
          <span class="badge badge-warning navbar-badge" id="no_of_notifications"></span>
        </a>

        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
          <span class="dropdown-item dropdown-header" id="no_of_notificationsView">No Unread Notifications</span>

          <div id="msg_place">
          </div>
          <div class="dropdown-divider"></div>
          <a href="http://127.0.0.1:8000/allNotification" target="iframe_content" class="dropdown-item dropdown-footer">See All Notifications</a>
        </div>

      </li>
      <li class="nav-item">
        @if(Auth::check())
        <a class="nav-link" href="{{route('logout')}}" role="button">
          <i class="fa fa-power-off fa-1x"></i>
        </a>
        @endif
      </li>
      <li class="nav-item">
        <a class="nav-link" data-widget="fullscreen" href="#" role="button">
          <i class="fas fa-expand-arrows-alt"></i>
        </a>
      </li>
    </ul>
  </nav>
  <!-- /.navbar -->


  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="#" class="brand-link">
      <img src="dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">System Seller Panel</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="/dist/img/Seller.png" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          @if(Auth::check())
          <a href="#" class="d-block">{{Auth::user()->fname}}</a>
          @else

          @endif

        </div>
      </div>
      @if(Auth::check())
      <input type="hidden" id="user_id" value='{{Auth::user()->id}}'>
      @endif
      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">

          <li class="nav-item">
            <a href="http://127.0.0.1:8000/allNotification" target="iframe_content" class="nav-link">
              <i class="nav-icon far fa-envelope"></i>
              <p>
                All Notifications

                <span class="badge badge-info right"></span>
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="http://127.0.0.1:8000/viewStatus" target="iframe_content" class="nav-link">
              <i class="nav-icon fas fa-chart-pie"></i>
              <p>
                View Post Status
              </p>
            </a>

          </li>
          <li class="nav-item">
            <a href="http://127.0.0.1:8000/viewMyProfileSeller" target="iframe_content" class="nav-link">
              <i class="nav-icon fas fa-tree"></i>
              <p>
                My Profile
              </p>
            </a>
          </li>

          </li>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>


  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">

    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <main class="page-content" id="Main_con">
          <iframe id="iframe_content" name="iframe_content" class="iframe_content" src="http://127.0.0.1:8000/allNotification"></iframe>
        </main>

      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">



    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <footer class="main-footer">
    <strong>Copyright &copy; 2021-2021 <a href="#"></a>Mind Units Group (E1941019,E1941022,E1941013)</strong>
    All rights reserved.
    <div class="float-right d-none d-sm-inline-block">
      <b></b>
    </div>
  </footer>
</div>
<!-- ./wrapper -->


<div class="container" id="container2">

  <!-- More Notification datq Model -->
  <div class="modal fade cd-example-modal-xl" id="More_data_Model" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-xl">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLongTitle">View Notification</h5>
          <button type="button" class="close" data-dismiss="modal" onclick="model_close()" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">

          <div class="row g-3">


            <div class="col-md-2">
              <label for="name" class="form-label"><b>Seller ID</b></label>
            </div>
            <div class="col-md-4">
              <label for="name" class="form-label" id="seller_id" value=""></label>
            </div>

            <div class="col-md-2">
              <label for="name" class="form-label"><b>Post ID</b></label>
            </div>

            <div class="col-md-4">
              <label for="name" class="form-label" id="post_id" value=""></label>
            </div>

            <div class="col-md-2">
              <label for="name" class="form-label"><b>Date / Time</b></label>
            </div>

            <div class="col-md-4">
              <label for="name" class="form-label" id="date_time" value=""></label>
            </div>
            <input type="hidden" id="post_id_for">
          </div>


          <br>
          <form id="complaint_form" class="row g-3">
            <div class="col-12">

              <div id="FornotifDiv"></div>

            </div>
            <div class="col-md-12 text-center">

            </div>
            <div class="col-md-12">
              <label for="name" class="form-label">Notification</label>
              <textarea type="text" class="form-control" id="input_msg" name="input_msg" disabled> </textarea>
            </div>
            <div class="col-md-12 text-center">
              <label for="name" class="form-label"></label>
            </div>

            <div class="col-12">
              <div class="col text-center">
                <button type="button" class="btn btn-dark" id='btn_complaint' onclick="ViewStatus()">View Post Status</button>

                <button type="button" class="btn btn-success" id='btn_reset' onclick="model_close()">Close</button>

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
  <!-- More Notification datq Model end -->
</div>

<div class="container" id="container3">

  <!-- Status Details Model -->
  <div class="modal fade cd-example-modal-xl" id="Status_data_Model" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-xl">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLongTitle">More Details Of Status</h5>
          <button type="button" class="close" data-dismiss="modal" onclick="SSmodel_close()" aria-label="Close">
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
              <label for="name" class="form-label" id="status_post_id" value=""></label>
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
              <div class="col text-center">

                <button type="button" class="btn btn-success" id='btn_reset' onclick="SSmodel_close()">Close</button>

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
  <!-- Status Details Model end -->


</div>

@endsection

@push('scripts')

<script>
  $(document).ready(function() {

    Load_unread_msg_counts();
    Load_unread_msg();

  });

  function Load_unread_msg_counts() {

    $user_id = $('#user_id').val();

    var token = $('input[name="csrfToken"]').attr('value');

    $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });

    var getData = {
      "user_id": $user_id
    };
    // console.log(getData);
    $.ajax({
      type: 'POST',
      headers: {
        'X-CSRFToken': token
      },
      url: 'all_unread_msg_countsSeller',
      data: getData,
      dataType: 'JSON',

      success: function(data) {
        // console.log(data);

        if (data) {
          $('#no_of_notifications').text(data);
          $('#no_of_notificationsView').text(data + " Notifications");
        }else{
          $('#no_of_notifications').text("");
          $('#no_of_notificationsView').text("No Unread Notifications");
        }
      }
    });
  };

  function Load_unread_msg() {

    $user_id = $('#user_id').val();
    var token = $('input[name="csrfToken"]').attr('value');

    $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });

    var getData = {
      "user_id": $user_id
    };
    // console.log(getData);
    $.ajax({
      type: 'POST',
      headers: {
        'X-CSRFToken': token
      },
      url: 'all_unread_msgSeller',
      data: getData,
      dataType: 'JSON',

      success: function(data) {
        // console.log(data);

        var msg_place_for_remove = document.getElementById("msg_place_for_remove");

        if (msg_place_for_remove != null) {
          msg_place_for_remove.remove();
        }

        $('#msg_place').append(' <div id="msg_place_for_remove"></div>');

        data.forEach(val => {

          $('#msg_place_for_remove').append('<div class="dropdown-divider"></div><a href="#" class="dropdown-item" onclick="ViewThisMsg(' + val.id + ')"><i class="fas fa-envelope mr-2"></i><p>' + val.notification + ' </p><span class="float-right text-muted text-sm">' + val.date_time + '</span></a>');

        });

      }
    });
  };

  function ViewThisMsg($id) {

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
      url: 'view_new_msg_by_seller',
      data: Data,
      dataType: 'JSON',

      success: function(data) {
        // console.log(data);

        data.forEach(val => {

          $('#seller_id').text(val.user_id);
          $('#post_id').text(val.post_id);
          $('#date_time').text(val.date_time);
          $('#input_msg').text(val.notification);
          $('#post_id_for').val(val.post_id);

          markAsReadmsg(val.id);
        });
        $('#More_data_Model').modal('show');

      }
    });
  };

  function markAsReadmsg($id) {
    console.log($id);
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
      url: 'markMsReadSeller',
      data: Data,
      dataType: 'JSON',

      success: function(data) {
        console.log(data);
        Load_unread_msg_counts();
        Load_unread_msg();
      }
    });
  }

  function model_close() {
    $('#More_data_Model').modal('hide');
  };

  function SSmodel_close() {
    $('#Status_data_Model').modal('hide');
  };

  function ViewStatus() {

    $id = $('#post_id_for').val();

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
      url: 'ViewStatusUsingNotifMsgSeller',
      data: Data,
      dataType: 'JSON',

      success: function(data) {
        console.log(data);

        data.forEach(val => {

          $('#product_name').text(val.product_name);
          $('#clark_id').text(val.clark_id);
          $('#cus_address').text(val.receiver_address);
          $('#status_post_id').text(val.id);

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
        
        $('#Status_data_Model').modal('show');
        // alert();
      }
    });
  };
</script>

@endpush