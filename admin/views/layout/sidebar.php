  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="<?php echo BASE_URL_ADMIN . '?act=danh-muc'; ?> " class="brand-link">
      <img src="assets/dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">ADMIN</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="assets/dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block">Duy</a>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <!-- <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Dashboard
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="../../index.html" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Dashboard v1</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="../../index2.html" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Dashboard v2</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="../../index3.html" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Dashboard v3</p>
                </a>
              </li>
            </ul>
          </li> -->
          <li class="nav-item">
            <a href="<?php echo BASE_URL_ADMIN . '?act=/'; ?> " class="nav-link">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Thống kê
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="<?php echo BASE_URL_ADMIN . '?act=danh-muc'; ?> " class="nav-link">
              <i class="nav-icon fas fa-th"></i>
              <p>
                Danh mục
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="<?php echo BASE_URL_ADMIN . '?act=san-pham'; ?> " class="nav-link">
              <i class="nav-icon fas fa-mobile"></i>
              <p>
                Sản phẩm
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="<?php echo BASE_URL_ADMIN . '?act=don-hang'; ?> " class="nav-link">
              <i class="nav-icon fas fa-shopping-bag"></i>
              <p>
                Đơn hàng

              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-user"></i>
              <p>
                Quản lý tài khoản
              </p>
              <i class="fas fa-angle-left right"></i>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="<?php echo BASE_URL_ADMIN . '?act=quan-ly-admin'; ?>" class="nav-link">
                  <i class="nav-icon fas fa-user"></i>
                  Quản lý admin
                </a>
              </li>
            </ul>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="<?php echo BASE_URL_ADMIN . '?act=quan-ly-user'; ?>" class="nav-link">
                  <i class="nav-icon fas fa-user"></i>
                  Quản lý người dùng
                </a>
              </li>
            </ul>

            
          </li>

        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>