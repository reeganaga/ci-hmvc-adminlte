<!-- Main content -->
<section class="content">
    <!-- Main row -->
    <div class="row">
        <!-- Left col -->
        <div class="col-md-12">
            <!-- Form: Input Indicator -->
            <div class="box box-info">
                <div class="box-header with-border">
                    <h3 class="box-title">KPI Form</h3>

                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                        </button>
                        <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                    </div>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <?php
                    alert('error', form_error('id_periode_kpi'));
                    alert('error', form_error('periode'));
                    alert('error', form_error('tgl_buka'));
                    alert('error', form_error('tgl_tutup'));
                    ?>
                    <form class="form-horizontal" action="/kpi/periode/save" method="post">
                        <input type="hidden" name="id_periode_kpi" value="<?= $id_periode_kpi; ?>">
                        <div class="form-group">
                            <div class="col-md-3">
                                <label for="" class="control-label">Periode</label>
                            </div>
                            <div class="col-md-9">
                                <input type="text" class="form-control" value="<?php form_value('periode',$form); ?>" name="periode" placeholder="Input angka">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-3">
                                <label for="" class="control-label">Tanggal Buka</label>
                            </div>
                            <div class="col-md-9">
                                <input type="text" class="form-control input-datepicker" readonly value="<?php form_value('tgl_buka',$form); ?>" name="tgl_buka" placeholder="Tanggal buka">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-3">
                                <label for="" class="control-label">Tanggal Tutup</label>
                            </div>
                            <div class="col-md-9">
                                <input type="text" class="form-control input-datepicker" readonly value="<?php form_value('tgl_tutup',$form); ?>" name="tgl_tutup" placeholder="Tanggal tutup">
                            </div>
                        </div>
                        <div class="form-group">

                            <div class="col-md-3">
                                <label for="" class="control-label">Aktif</label>
                            </div>
                            <div class="col-md-9">
                                <input type="checkbox" class="iCheck" value="1" <?php form_checked('k_aktif',$form); ?> name="k_aktif"> 
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-9 col-md-offset-3">
                                <button class="btn btn-default" type="submit">Submit</button>
                            </div>
                        </div>
                    </form>
                </div>
                <!-- /.table-responsive -->
            </div>
            <!-- /.box-body -->
            <!-- /.box-footer -->
        </div>
        <!-- /.box -->
    </div>
    <!-- /.col -->
    </div>
    <!-- /.row -->
</section>
<!-- /.content -->