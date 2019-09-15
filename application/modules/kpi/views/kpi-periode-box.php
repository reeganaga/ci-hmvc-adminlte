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
                                    <th>Tanggal Buka </th>
                                    <th>Tanggal Tutup </th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($data as $row) {
                                    $closed_date = new DateTime($row->tgl_tutup);
                                    $opened_date = new DateTime($row->tgl_buka);
                                    // var_dump($date);
                                    $now = new DateTime("midnight");
                                    // var_dump($now);
                                    $class_opened_date = ($opened_date <= $now && $row->k_aktif) ? 'text-bold text-green' : "text-bold text-gray";
                                    $is_open = ($opened_date <= $now) ? true : false;

                                    $class_closed_date = ($closed_date >= $now && $is_open && $row->k_aktif) ? 'text-bold text-green' : "text-bold text-gray";

                                    ?>
                                    <tr>
                                        <td><?= $row->periode; ?></td>
                                        <td class="<?= $class_opened_date ?>"><?= kpi_format_date($row->tgl_buka); ?></td>
                                        <td class="<?= $class_closed_date ?>"><?= kpi_format_date($row->tgl_tutup); ?></td>
                                        <td><?= ($row->k_aktif == 1) ? "<span class='label bg-green'>Active</span>" : "<span class='label bg-gray'>Inactive</span>"; ?></td>
                                        <td>
                                            <?php
                                                if ($row->k_aktif) { ?>
                                                <button class="btn btn-primary btn-flat" data-toggle="modal" data-target=".modal-ajax" data-body_class="no-padding" data-title="Pilih Jenis KPI" data-url="<?= base_url('/kpi/isi_kpi/ajax_kpi_list/' . $row->id_periode_kpi); ?>">Isi Kpi</button>
                                            <?php } else { ?>
                                                <button class="btn btn-primary btn-flat disabled" >Isi Kpi</button>
                                            <?php } ?>
                                        </td>
                                    </tr>
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