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
                        <table class="table table-bordered">
                            <thead class="">
                                <tr class="bg-purple text-center">
                                    <th class="text-center" >No</th>
                                    <th class="text-center" >Sasaran Kunci</th>
                                    <th class="text-center" >Indikator Pengukuran</th>
                                    <th class="text-center" >Bobot</th>
                                    <th class="text-center"  colspan="2">Target</th>
                                    <th class="text-center"  colspan="2">Realisasi</th>
                                    <th class="text-center" >Skor</th>
                                    <th class="text-center" >Skor Akhir</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr class="text-bold text-center">
                                    <td colspan="3">&nbsp;</td>
                                    <td>%</td>
                                    <td>Nilai</td>
                                    <td>Satuan</td>
                                    <td>Nilai</td>
                                    <td>Satuan</td>
                                    <td>(Realisasi/Target)*100</td>
                                    <td>(Skor x Bobot)/100</td>
                                </tr>
                                <tr class="bg-orange text-center">
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
                                $total_bobot=0;
                                $skor_akhir=0;
                                // loop indikator start
                                if ($indikator) {
                                    $i=1;
                                    foreach ($indikator as $value) {
                                        $total_bobot = $total_bobot + $value->bobot;
                                        $skor_akhir = $skor_akhir + $data_penilaian[$value->id_kpi_detail_rev]['skor_akhir'];
                                    ?>
                                        <tr>
                                            <td><?= $i; $i++; ?></td>
                                            <td><?= $value->sasaran; ?></td>
                                            <td><?= $value->nama_indikator; ?></td>
                                            <td class="text-right"><?= $value->bobot; ?></td>
                                            <td>
                                                <div class="form-group">
                                                    <div class="col-md-12">
                                                        <input class="form-control input-kpi" value="<?= $data_penilaian[$value->id_kpi_detail_rev]['nilai_target']; ?>" name="nilai[<?= $value->id_kpi_detail_rev ?>][target]">
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="text-center">%</td>
                                            <td>
                                                <div class="form-group">
                                                    <div class="col-md-12">
                                                        <input class="form-control input-kpi" value="<?= $data_penilaian[$value->id_kpi_detail_rev]['nilai_realisasi']; ?>" name="nilai[<?= $value->id_kpi_detail_rev ?>][realisasi]">
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="text-center">%</td>
                                            <td class="skor text-right"><?= $data_penilaian[$value->id_kpi_detail_rev]['skor']; ?></td>
                                            <td class="skor-akhir text-right"><?= $data_penilaian[$value->id_kpi_detail_rev]['skor_akhir']; ?></td>
                                        </tr>
                                <?php }
                                }else{
                                    alert('info','Indikator belum ada, silahkan kontak admin terlebih dahulu');
                                }
                                // loop indikator end
                                ?>
                                <tr>
                                    <td colspan="3">&nbsp;</td>
                                    <td class="text-bold text-right"><?= $total_bobot; ?></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td class="text-right text-bold"><?= $skor_akhir; ?></td>
                                </tr>
                            </tbody>
                        </table>
                        <input type="hidden" name="id_periode_kpi" value="<?= $id_periode_kpi; ?>">
                        <input type="hidden" name="id_kpi_rev" value="<?= $kpi->id_kpi; ?>">
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