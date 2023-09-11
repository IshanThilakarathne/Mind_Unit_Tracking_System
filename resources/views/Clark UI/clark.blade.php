@extends('Clark UI.masterClark')
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
        <!-- <a href="index3.html" class="nav-link">Home</a> -->
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="#" class="nav-link"><?php echo "Today is " . date("Y/m/d") ?></a>
      </li>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">

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
      <span class="brand-text font-weight-light">System Clark Panel</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="/dist/img/Clark.png" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          @if(Auth::check())
          <a href="#" class="d-block">{{Auth::user()->fname}}</a>
          @else

          @endif
        </div>
      </div>
      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <li class="nav-item">
            <a href="http://127.0.0.1:8000/barcodePrintPg" target="iframe_content" class="nav-link">
              <i class="nav-icon fas fa-copy"></i>
              <p>
                Barcode Print
                <span class="badge badge-info right"></span>
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="http://127.0.0.1:8000/statusUpdatePge" target="iframe_content" class="nav-link">
              <i class="nav-icon fas fa-chart-pie"></i>
              <p>
                Status Update
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="http://127.0.0.1:8000/viewMyProfileClark" target="iframe_content" class="nav-link">
              <i class="nav-icon fas fa-tree"></i>
              <p>
                My Profile
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="http://127.0.0.1:8000/regNewSeller" target="iframe_content" class="nav-link">
              <i class="nav-icon fas fa-edit"></i>
              <p>
                Register New Seller
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="http://127.0.0.1:8000/regNewPost" target="iframe_content" class="nav-link">
              <i class="nav-icon fas fa-table"></i>
              <p>
                Register New Post
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
        <main class="page-content">
          <iframe id="iframe_content" name="iframe_content" class="iframe_content" src="http://127.0.0.1:8000/barcodePrintPg"></iframe>
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

@endsection

@push('scripts')

<script>
</script>

@endpush