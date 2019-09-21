<table class="table">
    <tbody>
        <tr>
            <th>Nama KPI</th>
            <th>Action</th>
        </tr>
        <?php
        foreach ($jenis_kpi as $value) { ?>
            <tr>
                <td>
                    <span><?= $value['nama_kpi']; ?></span>
                    <?php if ($value['is_filled']) {
                            echo "<div class='label bg-primary'>Terisi</div>";
                        } ?>
                    <?php if ($value['penilaian']) {
                            echo ($value['penilaian']['status'] == 1) ? "<div class='label label-warning'>Pending</div>" : "<div class='label label-success'>Verified</div>";
                        } ?>
                </td>
                <td>
                    <a href="<?= base_url();  ?>kpi/isi_kpi/start/<?= $id_periode_kpi; ?>/<?= $value['id_kpi']; ?>" class="btn btn-primary btn-flat">Isi Kpi</a>
                    <?php /* if ($value['is_allowed_to_fill']) { ?>
                    <?php } else { ?>
                        <span class="btn btn-default disabled btn-flat" data-toggle="tooltip" title="Anda tidak diijinkan mengisi KPI ini">Isi Kpi</span>
                    <?php } */ ?>
                </td>
            </tr>
        <?php } ?>
    </tbody>
</table>