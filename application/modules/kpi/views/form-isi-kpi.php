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
                <div class="box-body no-padding">
                    <form class="form-horizontal form-isi-kpi" action="/kpi/isi_kpi/proses_isi_kpi" method="post">
                        <table class="table table-bordered table-striped">
                            <thead class="text-center">
                                <tr>
                                    <th>No</th>
                                    <th>Sasaran Kunci</th>
                                    <th>Indikator Pengukuran</th>
                                    <th>Bobot</th>
                                    <th colspan="2">Target</th>
                                    <th colspan="2">Realisasi</th>
                                    <th>Skor</th>
                                    <th>Skor Akhir</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td colspan="3">&nbsp;</td>
                                    <td>%</td>
                                    <td>Nilai</td>
                                    <td>Satuan</td>
                                    <td>Nilai</td>
                                    <td>Satuan</td>
                                    <td>(Realisasi/Target)*100</td>
                                    <td>(Skor x Bobot)/100</td>
                                </tr>
                                <tr>
                                    <td>1</td>
                                    <td>2</td>
                                    <td>3</td>
                                    <td>4</td>
                                    <td>5</td>
                                    <td>6</td>
                                    <td>7</td>
                                    <td>8</td>
                                    <td>9</td>
                                    <td>10</td>
                                </tr>
                                <?php
                                // loop indikator start
                                // var_dump($indikator);
                                if ($indikator) {
                                    foreach ($indikator as $value) { ?>
                                        <tr>
                                            <td><?= $value->id_kpi_detail_rev; ?></td>
                                            <td><?= $value->sasaran; ?></td>
                                            <td><?= $value->nama_indikator; ?></td>
                                            <td><?= $value->bobot; ?></td>
                                            <td>
                                                <div class="form-group">
                                                    <div class="col-md-6">
                                                        <input class="form-control" name="nilai[<?= $value->id_kpi_detail_rev ?>][target]">
                                                    </div>
                                                </div>
                                            </td>
                                            <td>%</td>
                                            <td>
                                                <div class="form-group">
                                                    <div class="col-md-6">
                                                        <input class="form-control" name="nilai[<?= $value->id_kpi_detail_rev ?>][realisasi]">
                                                    </div>
                                                </div>
                                            </td>
                                            <td>%</td>
                                            <td class="skor">&nbsp;</td>
                                            <td class="skor-akhir">&nbsp;</td>
                                        </tr>
                                <?php }
                                }
                                // loop indikator end
                                ?>
                            </tbody>
                        </table>
                        <input type="text" name="id_periode_kpi" value="<?= $id_periode_kpi; ?>">
                        <input type="text" name="id_kpi_rev" value="<?= $kpi->id_kpi; ?>">
                    </form>
                    <!-- /.table-responsive -->
                </div>
                <!-- /.box-body -->
                <div class="box-footer clearfix">
                    <button class="btn btn-primary btn-flat pull-right submit-isi-kpi" >Simpan</button>
                    <a href="/kpi/isi_kpi" class="btn btn-default btn-flat pull-right" >Batal</a>
                    <!-- <a href="javascript:void(0)" class="btn btn-sm btn-info btn-flat pull-left">Place New Order</a> -->
                    <!-- <a href="javascript:void(0)" class="btn btn-sm btn-default btn-flat pull-right">View All Orders</a> -->
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