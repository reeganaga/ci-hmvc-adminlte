<?php
$user = $this->ion_auth->user()->row();
// var_dump($user);
?>
<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar">
  <!-- sidebar: style can be found in sidebar.less -->
  <section class="sidebar">
    <!-- Sidebar user panel -->
    <div class="user-panel">
      <div class="pull-left image">
        <img src="<?php echo (!empty($user->foto)) ? base_url('/kpi/profile/get_foto/'.$user->id) : base_url('assets/dist/img/user2-160x160.jpg') ?>" class="img-circle img-profile" alt="User Image">

      </div>
      <div class="pull-left info">
        <p><?= $user->first_name; ?></p>
        <?php if ($user->active_admin == 0 && !$this->ion_auth->is_admin()) { ?>
          <span class="text-sm" title="Anda perlu di verifikasi Admin" data-toggle="tooltip"><i class="fa fa-circle text-warning"></i> Status Tidak Aktif</span>
          <!-- <span class="btn btn-default disabled btn-flat" data-toggle="tooltip" title="Anda tidak diijinkan mengisi KPI ini">Isi Kpi</span> -->
          <?php } elseif($user->active_admin == 1) { ?>
            <span class="text-sm" title="Anda Aktif, Silahkan isi KPI" data-toggle="tooltip"><i class="fa fa-circle text-success"></i> Status Aktif</span>

          <?php } elseif($user->active_admin == 2) { ?>
            <span class="text-sm" title="Anda Pending, Tunggu konfirmasi admin" data-toggle="tooltip"><i class="fa fa-circle text-info"></i> Status Pending</span>

        <?php } ?>
      </div>
    </div>
    <!-- search form -->
    <form action="#" method="get" class="sidebar-form">
      <div class="input-group">
        <input type="text" name="q" class="form-control" placeholder="Search...">
        <span class="input-group-btn">
          <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
          </button>
        </span>
      </div>
    </form>
    <!-- /.search form -->
    <!-- sidebar menu: : style can be found in sidebar.less -->
    <ul class="sidebar-menu">
      <li class="header">KPI NAVIGATION</li>
      <!-- <li class="active treeview">
          <a href="#">
            <i class="fa fa-dashboard"></i> <span>Dashboard</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="index.html"><i class="fa fa-circle-o"></i> Dashboard v1</a></li>
            <li class="active"><a href="index2.html"><i class="fa fa-circle-o"></i> Dashboard v2</a></li>
          </ul>
        </li> -->
      <!-- <li class="treeview">
          <a href="#">
            <i class="fa fa-files-o"></i>
            <span>Layout Options</span>
            <span class="pull-right-container">
              <span class="label label-primary pull-right">4</span>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="pages/layout/top-nav.html"><i class="fa fa-circle-o"></i> Top Navigation</a></li>
            <li><a href="pages/layout/boxed.html"><i class="fa fa-circle-o"></i> Boxed</a></li>
            <li><a href="pages/layout/fixed.html"><i class="fa fa-circle-o"></i> Fixed</a></li>
            <li><a href="pages/layout/collapsed-sidebar.html"><i class="fa fa-circle-o"></i> Collapsed Sidebar</a></li>
          </ul>
        </li> -->
      <?php
      foreach ($menus as $menu) {
        $class_active = (isset($menu_active) && $menu_active == $menu['id']) ? 'active' : '';
        $is_accessed = $this->ion_auth->in_group($menu['role']);
        if (!$is_accessed) continue;
        ?>
        <li class="<?= $class_active; ?>">
          <a href="<?= base_url() . $menu['uri']; ?>">
            <i class="<?= $menu['icon']; ?>"></i> <span><?= $menu['name'] ?></span>
            <span class="pull-right-container">
              <small class="label pull-right bg-green"><?= $menu['label'] ?></small>
            </span>
          </a>
        </li>
      <?php } ?>
      <!-- <li><a href="documentation/index.html"><i class="fa fa-book"></i> <span>Documentation</span></a></li>
        <li class="header">LABELS</li>
        <li><a href="#"><i class="fa fa-circle-o text-red"></i> <span>Important</span></a></li>
        <li><a href="#"><i class="fa fa-circle-o text-yellow"></i> <span>Warning</span></a></li>
        <li><a href="#"><i class="fa fa-circle-o text-aqua"></i> <span>Information</span></a></li> -->
    </ul>
  </section>
  <!-- /.sidebar -->
</aside>