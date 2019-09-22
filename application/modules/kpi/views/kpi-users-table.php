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
                  <th>Aktif</th>
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
                      <td>
                        <!-- <a href="<?=  base_url();  ?>kpi/users/edit/<?= $table->id; ?>" class="btn btn-default">Edit User</a> -->
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