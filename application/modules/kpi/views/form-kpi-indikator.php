<!-- Main content -->
<section class="content">
    <!-- Main row -->
    <div class="row">
        <!-- Left col -->
        <div class="col-md-12">
            <!-- Form: Input Indicator -->
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
                    <?php
                    alert('error', form_error('id_kpi'));
                    alert('error', form_error('sasaran'));
                    alert('error', form_error('nama_indikator'));
                    alert('error', form_error('bobot'));
                    ?>
                    <form class="form-horizontal" action="<?=  base_url();  ?>kpi/save_indikator/" method="post">
                        <input type="hidden" name="id_kpi" value="<?= $id_kpi; ?>">
                        <div class="form-group">
                            <div class="col-md-3">
                                <label for="" class="control-label">Sasaran</label>
                            </div>
                            <div class="col-md-9">
                                <input type="text" class="form-control" value="<?php form_value('sasaran',$form); ?>" name="sasaran" placeholder="Judul Sasaran">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-3">
                                <label for="" class="control-label">Nama Indikator</label>
                            </div>
                            <div class="col-md-9">
                                <input type="text" class="form-control" value="<?php form_value('nama_indikator',$form); ?>" name="nama_indikator" placeholder="Nama Indikator">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-3">
                                <label for="" class="control-label">Bobot</label>
                            </div>
                            <div class="col-md-9">
                                <input type="text" class="form-control" value="<?php form_value('bobot',$form); ?>" name="bobot" placeholder="Nilai Bobot">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-9 col-md-offset-3">
                                <button class="btn btn-default" type="submit">Add</button>
                            </div>
                        </div>
                    </form>
                </div>
                <!-- /.table-responsive -->
            </div>
            <!-- /.box-body -->
            <div class="box-footer clearfix">
                <table class="table table-responsive">
                    <thead>
                        <th>Sasaran</th>
                        <th>Indikator</th>
                        <th>Bobot</th>
                        <th>Action</th>
                    </thead>
                    <tbody>
                        <?php
                        if (!empty($table_indikators)) {
                            foreach ($table_indikators as $indikator) { ?>
                                <tr>
                                    <td><?= $indikator->sasaran; ?></td>
                                    <td><?= $indikator->nama_indikator; ?></td>
                                    <td><?= $indikator->bobot; ?></td>
                                    <td>
                                        <a href="<?= base_url('kpi/edit_indikator/' . $indikator->id_kpi . "/" . $indikator->id_kpi_detail_rev); ?>" class="btn btn-default">Edit</a>
                                        <button data-target="<?= base_url('kpi/delete_indikator/' . $indikator->id_kpi_detail_rev); ?>" class="btn btn-danger delete-button">Delete</button>
                                    </td>
                                </tr>
                        <?php }
                        }
                        ?>
                    </tbody>
                </table>
                <script>
                    $(document).ready(function() {
                        $('.delete-button').confirm({
                            'content': "Apakah anda ingin menghapus data ini ?",
                            'title': "Konfirmasi Hapus",
                            'icon': 'fa fa-warning',
                            "theme": 'supervan',
                            "buttons": {
                                ok: function() {
                                    console.log('yes pressed')
                                    location.href = this.$target.data('target');
                                },
                                close: function() {
                                    console.log('cancel')
                                }
                            }
                        })
                    })
                </script>
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