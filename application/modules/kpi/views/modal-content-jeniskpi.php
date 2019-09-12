<table class="table">
    <tbody>
        <tr>
            <th>Nama KPI</th>
            <th>Action</th>
        </tr>
        <?php 
        foreach ($jenis_kpi as $value) { ?>
            <tr>
                <td><?= $value->nama_kpi; ?></td>
                <td><a href="/kpi/isi_kpi/start/<?= $id_periode_kpi; ?>/<?= $value->id_kpi; ?>" class="btn btn-default">Isi Kpi</a></td>
            </tr>
        <?php } ?>
    </tbody>
</table>