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
                            <select name="id_user" id="" data-placehoder="Pilih" class="select2 form-control">
                                <option value="">Pilih nama user</option>
                                <?php
                                if($users){
                                    foreach ($users as $user ) {
                                        $checked = ($id_user == $user->id) ?'selected':"";
                                        echo "<option  {$checked} value='{$user->id}'>{$user->first_name}</option>";
                                    }
                                }
                                ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail2">Periode</label>
                            <select class="select2 form-control" data-placehoder="Pilih" name="id_periode" id="">
                                <option value="">Pilih Periode</option>
                                <?php
                                if($periodes){
                                    foreach ($periodes as $periode ) {
                                        $checked = ($id_periode == $periode->id_periode_kpi) ?'selected':"";
                                        echo "<option {$checked} value='{$periode->id_periode_kpi}'>{$periode->periode}</option>";
                                    }
                                }
                                ?>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-default">Filter</button>
                    </form>

                    <?php if(!empty($tables)){
                        echo "<button class='btn btn-primary'>Print PDF</button>";
                    }?>
                    <div class="table-responsive">
                        <table class="table no-margin table-striped">
                            <thead>
                                <tr>
                                    <th>Nama KPI</th>
                                    <th>Skor Akhir</th>
                                    <!-- <th>Action</th> -->
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (!empty($tables)) { //var_dump($tables); 
                                    ?>
                                    <?php foreach ($tables as $table) : ?>
                                        <tr>
                                            <td><?= isset($table->kpi->nama_kpi) ? $table->kpi->nama_kpi : ""; ?></td>
                                            <td><?= isset($table->total_skor) ? $table->total_skor : ""; ?></td>
                                            <td>
                                                <?php /*if ($table->status == 1) { ?>
                                                    <a class="btn btn-success btn-flat js-confirm" data-target="<?= base_url('kpi/penilaian/verifikasi/' . $table->id); ?>" data-title="Verifikasi KPI" data-content="Apakah anda sudah yakin dengan data KPI anda ? ">Verify</a>
                                                <?php } ?>
                                                <?php if ($this->ion_auth->is_admin()) { ?>
                                                    <a class="btn btn-primary btn-flat" href="<?= base_url('kpi/isi_kpi/start/' . $table->id_periode_kpi . "/" . $table->id_kpi_rev . '?user_id=' . $table->id_users); ?>">View</a>
                                                <?php } else { ?>
                                                    <a class="btn btn-primary btn-flat" href="<?= base_url('kpi/isi_kpi/start/' . $table->id_periode_kpi . "/" . $table->id_kpi_rev); ?>">View</a>
                                                <?php }*/ ?>
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