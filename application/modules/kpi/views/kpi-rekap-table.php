<!-- Main content -->
<section class="content">
    <!-- Main row -->
    <?php //if ($this->ion_auth->is_admin()) { 
    ?>
    <div class="row">
        <div class="col-md-12">
            <canvas id="myChart" height="0px"></canvas>

        </div>
    </div>
    <?php //} 
    ?>
    <div class="row">
        <!-- Left col -->
        <div class="col-md-12">
            <!-- TABLE: LATEST ORDERS -->
            <div class="box box-info">
                <div class="box-header with-border">
                    <h3 class="box-title">KPI Rekap</h3>
                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                        </button>
                        <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                    </div>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <form class="form-inline form-filter-rekap" method="get">
                        <?php if ($this->ion_auth->is_admin()) { ?>

                            <div class="form-group">
                                <label for="exampleInputName2">Nama user</label>
                                <select required name="id_user" id="" data-placehoder="Pilih" class="select2 form-control">
                                    <option value="">Pilih nama user</option>
                                    <?php
                                    if ($users) {
                                        foreach ($users as $user) {
                                            $checked = ($id_user == $user->id) ? 'selected' : "";
                                            echo "<option  {$checked} value='{$user->id}'>{$user->first_name}</option>";
                                        }
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputName2">Nama KPI</label>
                                <select name="id_kpi_rev" id="" data-placehoder="Pilih" class="select2 form-control">
                                    <option value="">Pilih nama KPI</option>
                                    <?php
                                    if ($kpis) {
                                        foreach ($kpis as $kpi) {
                                            $checked = ($id_kpi == $kpi->id_kpi) ? 'selected' : "";
                                            echo "<option  {$checked} value='{$kpi->id_kpi}'>{$kpi->nama_kpi}</option>";
                                        }
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputName2">Status</label>
                                <select name="status" id="" data-placehoder="Pilih" class="select2 form-control">
                                    <option value="">Pilih status</option>
                                    <?php
                                    $status_data = [1 => 'pending', 2 => 'verify'];
                                    foreach ($status_data as $number => $value) {
                                        $checked = ($get_status == $number) ? 'selected' : "";
                                        echo "<option  {$checked} value='{$number}'>{$value}</option>";
                                    }
                                    ?>
                                </select>
                            </div>
                        <?php } ?>
                        <div class="form-group">
                            <label for="exampleInputEmail2">Periode</label>
                            <select required class="select2 form-control id_periode" data-placehoder="Pilih" name="id_periode" id="">
                                <option value="">Pilih Periode</option>
                                <?php
                                if ($periodes) {
                                    foreach ($periodes as $periode) {
                                        $checked = ($id_periode == $periode->id_periode_kpi) ? 'selected' : "";
                                        echo "<option {$checked} value='{$periode->id_periode_kpi}'>{$periode->periode}</option>";
                                    }
                                }
                                ?>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-default">Filter</button>
                    </form>

                    <input type="hidden" class="qrcodelink" value="<?= $code; ?>">
                    <?php
                    // var_dump($tables);
                    if (!empty($tables)) {
                        // var_dump($data_periode);
                        // var_dump($periode);
                    ?>
                        <!-- <button class='btn btn-primary' onclick="printJS('table-rekap', 'html',{'css':'<?= base_url('assets/bootstrap/css/bootstrap.min.css') ?>'} )">Print PDF</button> -->
                        <button class='btn btn-primary print-pdf'>Print PDF</button>
                        <div id="editor"></div>

                        <!-- <button onclick="javascript:demoFromHTML();">PDF</button> -->

                        <div class="table-responsive " id="table-rekap">
                            <div class="biodata">
                                <img style="width:150px;" src="<?= base_url() . '/assets/images/logo-kpi.png'; ?>" class="mb-50 center-block" alt="">
                                <h4 class="text-center text-bold">Berdasarkan hasil pengisian evaluasi diri menggunakan</h4>
                                <h4 class="mb-50 text-center text-bold">Key Performance Indicators (KPI)</h4>
                                <table style="page-break-after: always;" class="table table-responsive">
                                    <tr>
                                        <td class="text-bold">
                                            <p>Nama</p>
                                            <p>Alamat</p>
                                            <?php if (!empty($data_user->regency)) { ?>
                                                <p>Kota</p>
                                            <?php } ?>
                                            <p>Kelompok Usaha</p>
                                            <p>Jenis Usaha</p>
                                            <p>Email</p>
                                        </td>
                                        <td>
                                            <p>: <?= $data_user->first_name; ?></p>
                                            <p>: <?= $data_user->tempat; ?></p>
                                            <?php if (!empty($data_user->regency)) { ?>
                                                <p>: <?= $data_user->regency->name; ?></p>
                                            <?php } ?>
                                            <p>: <?= $data_user->kelompok_usaha; ?></p>
                                            <p>: <?= $data_user->jenis_usaha; ?></p>
                                            <p>: <?= $data_user->email; ?></p>

                                        </td>
                                        <td>&nbsp;</td>
                                    </tr>
                                    <tr>
                                        <td colspan="3">
                                            <?php if (!empty($tables)) {

                                                // var_dump($data_periode);
                                                $start_month = date("F", strtotime($data_periode->tgl_buka));
                                                $end_month = date("F", strtotime($data_periode->tgl_tutup));
                                                $end_year = date("Y", strtotime($data_periode->tgl_tutup));
                                                // var_dump($start_month);
                                                $total = 0;
                                                foreach ($tables as $table) : $total += $table->total_skor;
                                                endforeach;
                                            ?>

                                                Dengan total skor akhir <?= $total ?>, nilai <?= calculate_nilai_total($total); ?> (UMKM <?php calculate_ket_nilai_total($total); ?>), surat keterangan ini untuk dapat digunakan sebagai evaluasi profil kinerja UMKM dengan periode <?= $data_periode->periode; ?> (<?= convert_number_to_str($data_periode->periode); ?>) bulan (periode <?= $start_month ?> – <?= $end_month; ?> <?= $end_year; ?>)
                                            <?php } ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="2">
                                            <!-- for qr code -->
                                          <!-- <img class="img-qrcode" src="<?= $qr_code; ?>" alt=""> -->
                                            <div class="qr-code-area" id="qr-code-area1"></div>
                                        </td>
                                        <td>
                                            <p>Yogyakarta, 14 April 2020</p>
                                            <p>Kabid Pengembangan Usaha Kecil Menengah</p>
                                            <div class="signer"></div>
                                            <p>Andi Setyono</p>
                                        </td>
                                    </tr>
                                </table>
                            </div>
                            <h3 class="text-center">USAHA MIKRO, KECIL, DAN MENENGAH (UMKM)</h3>
                            <hr>
                            <h3 class="hide text-bold">Pengisian KPI - <?= ($data_user) ? $data_user->first_name : ""; ?> - Periode <?= ($data_periode) ? $data_periode->periode : ""; ?></h3>
                            <table class="table no-margin table-striped">
                                <colgroup>
                                    <col width="40%">
                                    <col width="20%">
                                    <col width="10%">
                                    <col width="30%">
                                </colgroup>
                                <thead>
                                    <tr>
                                        <th>Nama KPI</th>
                                        <th>Skor Akhir</th>
                                        <th>Nilai</th>
                                        <th>Keterangan</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    if (!empty($tables)) {
                                        $total = 0;  //var_dump($tables);
                                    ?>
                                        <?php foreach ($tables as $table) : $total += $table->total_skor;
                                        ?>
                                            <tr>
                                                <td><?= isset($table->kpi->nama_kpi) ? $table->kpi->nama_kpi : ""; ?></td>
                                                <td><?= isset($table->total_skor) ? $table->total_skor : ""; ?></td>
                                                <td>
                                                    <?php
                                                    //                                                    if ($table->total_skor < 21) {
                                                    //                                                        $nilai = "E";
                                                    //                                                    } elseif ($table->total_skor < 41) {
                                                    //                                                        $nilai = "D";
                                                    //                                                    } elseif ($table->total_skor < 61) {
                                                    //                                                        $nilai = "C";
                                                    //                                                    } elseif ($table->total_skor < 81) {
                                                    //                                                        $nilai = "B";
                                                    //                                                    } else {
                                                    //                                                        $nilai = "A";
                                                    //                                                    }
                                                    ?>
                                                    <?= isset($table->total_skor) ? calculate_nilai($table->total_skor) : ""; ?></td>
                                                <?php /* if ($table->status == 1) { ?>
                                                  <a class="btn btn-success btn-flat js-confirm" data-target="<?= base_url('kpi/penilaian/verifikasi/' . $table->id); ?>" data-title="Verifikasi KPI" data-content="Apakah anda sudah yakin dengan data KPI anda ? ">Verify</a>
                                                  <?php } ?>
                                                  <?php if ($this->ion_auth->is_admin()) { ?>
                                                  <a class="btn btn-primary btn-flat" href="<?= base_url('kpi/isi_kpi/start/' . $table->id_periode_kpi . "/" . $table->id_kpi_rev . '?user_id=' . $table->id_users); ?>">View</a>
                                                  <?php } else { ?>
                                                  <a class="btn btn-primary btn-flat" href="<?= base_url('kpi/isi_kpi/start/' . $table->id_periode_kpi . "/" . $table->id_kpi_rev); ?>">View</a>
                                                  <?php } */ ?>
                                                <td>
                                                    <?php
                                                    isset($table->total_skor) ? calculate_ket_nilai($table->total_skor) : "";
                                                    ?></td>
                                            </tr>
                                        <?php endforeach; ?>
                                    <?php } ?>
                                    <tr>
                                        <td class="text-bold">Total</td>
                                        <td class="text-bold"><?= $total; ?></td>
                                        <td class="text-bold">&nbsp;</td>
                                    </tr>
                                </tbody>
                            </table>
                            <hr>
                            <table class="table table-responsive">
                                <tr>
                                    <td width="50%">
                                        <div class="qr-code-area" id="qr-code-area2"></div>
                                        <!-- <img class="img-qrcode" src="<?= $qr_code; ?>" alt=""> -->
                                    </td>
                                    <td width="50%">
                                        <b>Kategori Nilai :</b>
                                        <p>880 - 1100 A Sangat Baik</p>
                                        <p>660 - 879 B Baik</p>
                                        <p>440 - 659 C Cukup</p>
                                        <p>220 - 439 D Kurang Baik</p>
                                        <p>100 - 219 E Sangat Kurang Baik</p>
                                    </td>
                                </tr>
                            </table>
                        </div>
                    <?php } else { ?>
                        <p class="alert alert-warning">Data tidak ditemukanSilahkan pilih filter diatas</p>
                        <?php
                        /*
                        <p class="alert alert-warning">Silahkan pilih <?= $this->ion_auth->is_admin() ? "Nama userd dan" : ""; ?> periode</p>
                        */ ?>
                    <?php } ?>
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