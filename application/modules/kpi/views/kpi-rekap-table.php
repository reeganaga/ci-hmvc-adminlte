<!-- Main content -->
<section class="content">
    <!-- Main row -->
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
                            <label for="exampleInputEmail2">Periode</label>
                            <select required class="select2 form-control" data-placehoder="Pilih" name="id_periode" id="">
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

                    <?php if (!empty($tables)) {
                        // var_dump($data_user);
                        // var_dump($periode);
                        ?>
                        <!-- <button class='btn btn-primary' onclick="printJS('table-rekap', 'html',{'css':'<?= base_url('assets/bootstrap/css/bootstrap.min.css') ?>'} )">Print PDF</button> -->
                        <button class='btn btn-primary print-pdf'>Print PDF</button>
                        <div id="editor"></div>

                        <!-- <button onclick="javascript:demoFromHTML();">PDF</button> -->

                        <div class="table-responsive " id="table-rekap">
                            <h3 class="hide text-bold">Pengisian KPI - <?= ($data_user) ? $data_user->first_name : ""; ?> - Periode <?= ($data_periode) ? $data_periode->periode : ""; ?></h3>
                            <table class="table no-margin table-striped">
                                <colgroup>
                                    <col width="50%">
                                    <col width="50%">
                                </colgroup>
                                <thead>
                                    <tr>
                                        <th>Nama KPI</th>
                                        <th>Skor Akhir</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if (!empty($tables)) { $total=0;  //var_dump($tables); 
                                            ?>
                                        <?php foreach ($tables as $table) : $total += $table->total_skor; ?>
                                            <tr>
                                                <td><?= isset($table->kpi->nama_kpi) ? $table->kpi->nama_kpi : ""; ?></td>
                                                <td><?= isset($table->total_skor) ? $table->total_skor : ""; ?></td>
                                                    <?php /*if ($table->status == 1) { ?>
                                                    <a class="btn btn-success btn-flat js-confirm" data-target="<?= base_url('kpi/penilaian/verifikasi/' . $table->id); ?>" data-title="Verifikasi KPI" data-content="Apakah anda sudah yakin dengan data KPI anda ? ">Verify</a>
                                                <?php } ?>
                                                <?php if ($this->ion_auth->is_admin()) { ?>
                                                    <a class="btn btn-primary btn-flat" href="<?= base_url('kpi/isi_kpi/start/' . $table->id_periode_kpi . "/" . $table->id_kpi_rev . '?user_id=' . $table->id_users); ?>">View</a>
                                                <?php } else { ?>
                                                    <a class="btn btn-primary btn-flat" href="<?= base_url('kpi/isi_kpi/start/' . $table->id_periode_kpi . "/" . $table->id_kpi_rev); ?>">View</a>
                                                <?php }*/ ?>
                                            </tr>
                                        <?php endforeach; ?>
                                    <?php } ?>
                                    <tr>
                                        <td class="text-bold">Total</td>
                                        <td class="text-bold"><?= $total; ?></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    <?php } else { ?>
                        <p class="alert alert-warning">Silahkan pilih Nama user dan periode</p>
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