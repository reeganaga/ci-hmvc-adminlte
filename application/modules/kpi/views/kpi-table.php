
<!-- Main content -->
<section class="content">
    <!-- Main row -->
    <div class="row">
        <!-- Left col -->
        <div class="col-md-12">
            <!-- TABLE: LATEST ORDERS -->
            <div class="box box-info">
                <div class="box-header with-border">
                    <h3 class="box-title">KPI Table</h3>

                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                        </button>
                        <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                    </div>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    
                    <div class="table-responsive">
                <table class="table no-margin">
                  <thead>
                  <tr>
                    <th>KPI ID</th>
                    <th>KPI Name</th>
                    <th>Action</th>
                  </tr>
                  </thead>
                  <tbody>
                      <?php foreach ($kpis as $kpi) : ?>
                      <tr>
                        <td><?= $kpi->id_kpi; ?></td>
                        <td><a href="<?php echo base_url('') ?>"><?= $kpi->nama_kpi; ?></a></td>
                        <td>
                          <a href="<?=  base_url();  ?>kpi/add_indicator/<?= $kpi->id_kpi; ?>" class="btn btn-default">Configure indicator</a>
                        </td>
                      </tr>
                    <?php endforeach; ?>    
                  </tbody>
                </table>
              </div> 
                    <!-- /.table-responsive -->
                </div>
                <!-- /.box-body -->
                <div class="box-footer clearfix">
                    <a href="javascript:void(0)" class="btn btn-sm btn-info btn-flat pull-left">Place New Order</a>
                    <a href="javascript:void(0)" class="btn btn-sm btn-default btn-flat pull-right">View All Orders</a>
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