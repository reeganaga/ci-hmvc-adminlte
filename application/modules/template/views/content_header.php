<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
    <?php
    if (isset($title)) {
      echo $title;
    } else {
      echo "Dashboard HMVC";
    }
    ?>
    <small><?= isset($subtitle) ? $subtitle : "Version 2.0"; ?></small>
  </h1>
  <!-- <ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
    <li class="active">Dashboard</li>
  </ol> -->
  <?php
  // output breadcrumbs
  echo $this->breadcrumbs->show('<i class="fa fa-dashboard"></i>');
  ?>
</section>