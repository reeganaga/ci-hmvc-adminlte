<!-- Main content -->
<section class="content">
    <!-- Main row -->
    <div class="row">
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
                        <table class="datatable table">
                            <thead>
                                <tr>
                                    <th>Periode</th>
                                    <th>tanggal Buka </th>
                                    <th>tanggal Tutup </th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($data as $row) { ?>
                                    <tr>
                                        <td><?= $row->periode; ?></td>
                                        <td><?= $row->tgl_buka; ?></td>
                                        <td><?= $row->tgl_tutup; ?></td>
                                        <td><?= $row->k_aktif; ?></td>
                                        <td><button class="btn btn-primary" data-toggle="modal" data-target=".modal-ajax" data-title="Pilih Jenis KPI" data-url="<?= base_url('/kpi/isi_kpi/ajax_kpi_list'); ?>">Isi Kpi</button></td>
                                    </tr>
                                    <!-- <div class="col-md-3 col-sm-6 col-xs-12">
                                        <a href="" class="link-black" data-toggle="modal" data-target=".modal-ajax" data-title="Pilih Jenis KPI" data-url="<?= base_url('/kpi/isi_kpi/ajax_kpi_list'); ?>">
                                            <div class="info-box">
                                                <span class="info-box-icon bg-yellow"><?= $row->periode; ?></span>
                                                <div class="info-box-content">
                                                    <span class="info-box-text"><?= $row->tgl_buka; ?></span>
                                                    <span class="info-box-number"><?= $row->tgl_tutup ?></span>
                                                </div>
                                            </div>
                                        </a>
                                    </div> -->
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

    </div>
    <!-- /.row -->
</section>
<!-- /.content -->

<?php $this->load->view('kpi/modal'); ?>