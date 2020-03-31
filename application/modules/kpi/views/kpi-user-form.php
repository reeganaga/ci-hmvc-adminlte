<?php
$arr_user = (array) $user;
?>
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
                    alert('error', form_error('no_ktp'));
                    alert('error', form_error('tempat'));
                    alert('error', form_error('tgl_lahir'));
                    alert('error', form_error('pendidikan'));
                    alert('error', form_error('jenis_usaha'));
                    alert('error', form_error('deskripsi_usaha'));
                    alert('error', form_error('omset'));
                    alert('error', form_error('tempat'));
                    alert('error', form_error('id_provinsi'));
                    alert('error', form_error('id_kota'));
                    ?>
                    <form class="form-horizontal" action="<?= base_url();  ?>kpi/profile/save" method="post" enctype="multipart/form-data">
                        <div class="form-group">
                            <div class="col-md-3">
                                <label for="" class="control-label">Foto</label>
                            </div>
                            <div class="col-md-9">
                                <?php
                                // var_dump($arr_user);
                                if (!empty($arr_user['foto'])) {
                                    //displaying photo
                                    echo "<img class='max-100 img-responsive img-thumb' src='".base_url('/kpi/profile/get_foto/'.$arr_user['id'])."' alt=''>";
                                }else{
                                    //displaying default photo
                                    echo "<img class='max-100 img-responsive img-thumb' src='".base_url('/assets/images/user-default.png')."' alt=''>";
                                }
                                ?>

                                <input type="file" name="foto" class="form-control">
                                <!-- <input required type="foto" class="form-control" value="<?php form_value('foto', $arr_user); ?>" name="email" placeholder="email@example.com"> -->
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-3">
                                <label for="" class="control-label">Email</label>
                            </div>
                            <div class="col-md-9">
                                <input required type="email" class="form-control" value="<?php form_value('email', $arr_user); ?>" name="email" placeholder="email@example.com">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-3">
                                <label for="" class="control-label">Nama</label>
                            </div>
                            <div class="col-md-9">
                                <input required type="text" class="form-control" value="<?php form_value('first_name', $arr_user); ?>" name="first_name" placeholder="Nama">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-3">
                                <label for="" class="control-label">No KTP</label>
                            </div>
                            <div class="col-md-9">
                                <input required type="text" class="form-control" value="<?php form_value('no_ktp', $arr_user); ?>" name="no_ktp" placeholder="No Ktp">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-3">
                                <label for="" class="control-label">Tanggal Lahir</label>
                            </div>
                            <div class="col-md-9">

                                <input required type="text" class="form-control mask mask-date" placeholder="DD/MM/YYYY" value="<?php echo convert_date_format(form_value('tgl_lahir', $arr_user,true) , 'd-m-Y') ; ?>" name="tgl_lahir">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-3">
                                <label for="" class="control-label">Pendidikan</label>
                            </div>
                            <div class="col-md-9">
                                <?php foreach ($list_pendidikan as $value) { ?>
                                    <label for="pendidikan">
                                        <input required type="radio" name="pendidikan" value="<?= $value; ?>" <?= form_checked('pendidikan', $arr_user, false, $value); ?>> <?= $value; ?>
                                    </label>
                                <?php } ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-3">
                                <label for="" class="control-label">Kelompok usaha</label>
                            </div>
                            <div class="col-md-9">
                                <?php foreach ($list_kelompok_usaha as $value) { ?>
                                    <label for="kelompok_usaha">
                                        <input required type="radio" name="kelompok_usaha" value="<?= $value; ?>" <?php form_checked('kelompok_usaha', $arr_user, false, $value); ?>> <?= $value; ?>
                                    </label>
                                <?php } ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-3">
                                <label for="" class="control-label">Jenis usaha</label>
                            </div>
                            <div class="col-md-9">
                                <?php foreach ($list_usaha as $value) { ?>
                                    <label for="jenis_usaha">
                                        <input required type="radio" name="jenis_usaha" value="<?= $value; ?>" <?php form_checked('jenis_usaha', $arr_user, false, $value); ?>> <?= $value; ?>
                                    </label>
                                <?php } ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-3">
                                <label for="" class="control-label">Deskripsi Usaha</label>
                            </div>
                            <div class="col-md-9">
                                <textarea required class="form-control" name="deskripsi_usaha" cols="30" rows="4"><?php form_value('deskripsi_usaha', $arr_user); ?></textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-3">
                                <label for="" class="control-label">Omset</label>
                            </div>
                            <div class="col-md-9">
                                <input required type="text" class="form-control mask mask-money" value="<?php form_value('omset', $arr_user); ?>" name="omset" placeholder="Omset">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-3">
                                <label for="" class="control-label">Alamat</label>
                            </div>
                            <div class="col-md-9">
                                <input required type="text" class="form-control" value="<?php form_value('tempat', $arr_user); ?>" name="tempat" placeholder="Alamat">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-3">
                                <label for="" class="control-label">Provinsi</label>
                            </div>
                            <div class="col-md-9">
                                <select class="form-control select-province" name="id_provinsi" data-placeholder="Pilih Kota">
                                    <option></option>
                                    <?php foreach ($provinces as $province) {
                                        ?>
                                        <option <?php form_selected('id_provinsi', $arr_user, false, $province->id); ?> value='<?= $province->id ?>'><?= $province->name ?></option>
                                    <?php
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-3">
                                <label for="" class="control-label">Kota</label>
                            </div>
                            <div class="col-md-9">
                                <select class="form-control select2 select-regencies" name="id_kota" data-placeholder="Pilih Kota">
                                    <option></option>
                                    <?php foreach ($regencies as $regency) {
                                        ?>
                                        <option <?php form_selected('id_kota', $arr_user, false, $regency->id); ?> value='<?= $regency->id ?>'><?= $regency->name ?></option>
                                    <?php

                                    }
                                    ?>
                                </select>
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

    <div class="row">
        <!-- Left col -->
        <div class="col-md-12">
            <!-- Form: Input Indicator -->
            <div class="box box-info">
                <div class="box-header with-border">
                    <h3 class="box-title">Password Form</h3>

                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                        </button>
                        <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                    </div>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <?php
                    echo validation_errors();
                    alert('error', form_error('password'));
                    alert('error', form_error('current_password'));
                    ?>
                    <form class="form-horizontal" action="<?= base_url();  ?>kpi/profile/save_password" method="post">
                        <div class="form-group">
                            <div class="col-md-3">
                                <label for="" class="control-label">Password sekarang</label>
                            </div>
                            <div class="col-md-9">
                                <input required type="password" class="form-control" value="" name="current_password">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-3">
                                <label for="" class="control-label">Password baru</label>
                            </div>
                            <div class="col-md-9">
                                <input required type="password" class="form-control" value="" name="password">
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
    <!-- /.row -->



</section>
<!-- /.content -->