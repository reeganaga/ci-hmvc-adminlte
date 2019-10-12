<!-- Main content -->
<section class="content">
    <!-- Main row -->
    <div class="row">
        <!-- Left col -->
        <div class="col-md-12">
            <!-- Form: Input Indicator -->
            <div class="box box-info">
                <div class="box-header with-border">
                    <h3 class="box-title">User Detail </h3>

                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                        </button>
                        <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                    </div>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <?php
                    
                    ?>
                    <form class="form-horizontal">
                        <div class="form-group">
                            <div class="col-md-3">
                                <label for="" class="control-label">Email</label>
                            </div>
                            <div class="col-md-9"><?= $user->email; ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-3">
                                <label for="" class="control-label">Nama</label>
                            </div>
                            <div class="col-md-9">
                                <?= $user->first_name; ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-3">
                                <label for="" class="control-label">Alamat</label>
                            </div>
                            <div class="col-md-9">
                                <?= $user->tempat; ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-3">
                                <label for="" class="control-label">Aktif</label>
                            </div>
                            <div class="col-md-9">
                                    <?= $user->active_admin; ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-3">
                                <label for="" class="control-label">Kota</label>
                            </div>
                            <div class="col-md-9">
                                <?php
                                if ($user->regency) {
                                    echo $user->regency->name;
                                }
                                ?>
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