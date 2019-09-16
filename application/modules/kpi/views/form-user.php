<!-- Main content -->
<section class="content">
    <!-- Main row -->
    <div class="row">
        <!-- Left col -->
        <div class="col-md-12">
            <!-- Form: Input Indicator -->
            <div class="box box-info">
                <div class="box-header with-border">
                    <h3 class="box-title">User Form</h3>

                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                        </button>
                        <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                    </div>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <?php
                    alert('error', form_error('id'));
                    alert('error', form_error('email'));
                    alert('error', form_error('first_name'));
                    alert('error', form_error('tempat'));
                    ?>
                    <form class="form-horizontal" action="/kpi/user/save" method="post">
                        <input type="hidden" name="id" value="<?= $id; ?>">
                        <div class="form-group">
                            <div class="col-md-3">
                                <label for="" class="control-label">Email</label>
                            </div>
                            <div class="col-md-9">
                                <input type="email" class="form-control" value="<?php form_value('email', $form); ?>" name="email" placeholder="email@example.com">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-3">
                                <label for="" class="control-label">Nama</label>
                            </div>
                            <div class="col-md-9">
                                <input type="text" class="form-control" value="<?php form_value('first_name', $form); ?>" name="first_name" placeholder="Nama">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-3">
                                <label for="" class="control-label">Alamat</label>
                            </div>
                            <div class="col-md-9">
                                <input type="text" class="form-control" value="<?php form_value('tempat', $form); ?>" name="tempat" placeholder="Alamat">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-3">
                                <label for="" class="control-label">Aktif</label>
                            </div>
                            <div class="col-md-9">
                                <input type="checkbox" class="iCheck" value="1" <?php form_checked('active', $form); ?> name="active">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-3">
                                <label for="" class="control-label">Kota</label>
                            </div>
                            <div class="col-md-9">
                                <select class="form-control select2" name="id_kota" data-placeholder="Pilih Kota">
                                    <option></option>
                                    <?php foreach ($regencies as $regency) {
                                        echo "<option value='{$regency->id}'>{$regency->name}</option>";
                                    }
                                    ?>
                                </select>
                                <input type="checkbox" class="iCheck" value="1" <?php form_checked('active', $form); ?> name="active">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-3">
                                <label for="" class="control-label">Password</label>
                            </div>
                            <div class="col-md-9">
                                <input type="password" class="form-control" value="" name="password">
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