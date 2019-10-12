<?php
$base_url = base_url();
?>
<!-- Main content -->
<section class="content">
  <!-- Main row -->
  <div class="row">
    <!-- Left col -->
    <div class="col-md-12">
      <!-- TABLE: LATEST ORDERS -->
      <div class="box box-info">
        <div class="box-header with-border">
          <h3 class="box-title">KPI Periode
            <!-- <a href="<?=  base_url();  ?>kpi/periode/add" class="btn btn-default ml-1">Add</a> -->
          </h3>
          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
            </button>
            <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
          </div>
        </div>
        <!-- /.box-header -->
        <div class="box-body">

          <div class="table-responsive">
            <table class="table no-margin datatable">
              <thead>
                <tr>
                  <th>id</th>
                  <th>Email</th>
                  <th>Nama</th>
                  <th>Tempat</th>
                  <th>Kota</th>
                  <th>Aktif Email</th>
                  <th>Aktif Admin</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                <?php if (!empty($tables)) { ?>
                  <?php foreach ($tables as $table) : ?>
                    <tr>
                      <td><?= $table->id; ?></td>
                      <td><?= $table->email; ?></td>
                      <td><?= $table->first_name; ?></td>
                      <td><?= $table->tempat; ?></td>
                      <td><?= $table->id_kota; ?></td>
                      <td><?= ($table->active) == 1 ? "<span class='label label-success'>Active</span>" : "<span class='label label-default'>Not Active</span>"; ?></td>
                      <td><?php 
                      
                      if ($table->active_admin==1) {
                        $link = "{$base_url}kpi/users/active_deactive_user/{$table->id}/deactive";
                        $title = "Konfirmasi Nonaktifan user";
                        $content = "Apakah anda yakin ingin menonaktifkan user {$table->first_name} ini ?";
                        $label = "Active";
                        $class = "label-success";
                      }elseif ($table->active_admin==0) {
                        $link = "{$base_url}kpi/users/active_deactive_user/{$table->id}/active";
                        $title = "Konfirmasi Aktifan user";
                        $content = "Apakah anda yakin ingin mengaktifkan user {$table->first_name} ini ?";
                        $label = "Not active";
                        $class = "label-default";
                      }elseif ($table->active_admin==2) {
                        $link = "{$base_url}kpi/users/active_deactive_user/{$table->id}/active";
                        $title = "Konfirmasi Aktifan user";
                        $content = "Apakah anda yakin ingin mengaktifkan user {$table->first_name} ini ?";
                        $label = "Need actived";
                        $class = "label-info";
                      }

                      echo "<a class='label {$class} js-confirm' data-target='{$link}' data-title='{$title}' data-content='{$content}' >{$label}</a>"; ?>
                      </td>
                      <td>
                        <a href="<?=  base_url();  ?>kpi/users/view/<?= $table->id; ?>" class="btn btn-default">View</a>
                      </td>
                    </tr>
                  <?php endforeach; ?>
                <?php } ?>
              </tbody>
            </table>
          </div>
          <!-- /.table-responsive -->
        </div>
        <!-- /.box-body -->
        <div class="box-footer clearfix">
          <!-- <a href="javascript:void(0)" class="btn btn-sm btn-info btn-flat pull-left">Place New Order</a> -->
          <!-- <a href="javascript:void(0)" class="btn btn-sm btn-default btn-flat pull-right">View All Orders</a> -->
        </div>
        <!-- /.box-footer -->
      </div>
      <!-- /.box -->
    </div>
    <!-- /.col -->
  </div>
  <!-- /.row -->
</section>
<!-- /.content -->