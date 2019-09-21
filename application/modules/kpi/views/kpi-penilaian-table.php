<!-- Main content -->
<section class="content">
    <!-- Main row -->
    <div class="row">
        <!-- Left col -->
        <div class="col-md-12">
            <!-- TABLE: LATEST ORDERS -->
            <div class="box box-info">
                <div class="box-header with-border">
                    <h3 class="box-title">KPI Penilaian<a href="<?= base_url();  ?>kpi/isi_kpi" class="btn btn-default ml-1">Add</a></h3>
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
                                    <th>Periode</th>
                                    <th>Users</th>
                                    <th>KPI</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (!empty($tables)) { //var_dump($tables); 
                                    ?>
                                    <?php foreach ($tables as $table) : ?>
                                        <tr>
                                            <td><?= isset($table->periode->periode) ? $table->periode->periode : ""; ?></td>
                                            <td><?= isset($table->user->first_name) ? $table->user->first_name : ""; ?></td>
                                            <td><?= isset($table->kpi->nama_kpi) ? $table->kpi->nama_kpi : ""; ?></td>
                                            <td><?= ($table->status) == 1 ? "<span class='label label-warning'>Pending</span>" : "<span class='label label-success'>Verified</span>"; ?></td>
                                            <td>
                                                <?php if ($table->status == 1) { ?>
                                                    <a class="btn btn-success btn-flat js-confirm" data-target="<?= base_url('kpi/penilaian/verifikasi/' . $table->id); ?>" data-title="Verifikasi KPI" data-content="Apakah anda sudah yakin dengan data KPI anda ? ">Verify</a>
                                                <?php } ?>
                                                <a class="btn btn-primary btn-flat" href="<?= base_url('kpi/isi_kpi/start/' . $table->id_periode_kpi."/".$table->id_kpi_rev); ?>">View</a>
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