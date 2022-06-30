<div class="content">
    <div class="container">
        <div class="dashboard-info">
            <div class="row">
                <div class="col-md-4">
                    <a href="surat/keluar" style="text-decoration:none;">
                        <div class="dashboard-sk">
                            <p class="dashboard-info-judul">Surat Keluar</p>
                            <p class="dashboard-info-text"><?= $jumlah_sk; ?></p>
                            <p class="dashboard-info-bulan"><?= $bulan_sk; ?></p>
                        </div>
                    </a>
                </div>
                <div class="col-md-4">
                    <a href="surat/masuk" style="text-decoration:none;">
                        <div class="dashboard-sm">
                            <p class="dashboard-info-judul">Surat Masuk</p>
                            <p class="dashboard-info-text"><?= $jumlah_sm; ?></p>
                            <p class="dashboard-info-bulan"><?= $bulan_sm; ?></p>
                        </div>
                    </a>
                </div>
                <div class="col-md-4">
                    <a href="surat/keluar/permintaan" style="text-decoration:none;">
                        <div class="dashboard-perm-sk">
                            <p class="dashboard-info-judul">Permintaan Surat Keluar</p>
                            <p class="dashboard-info-text"><?= $jumlah_perm_sk; ?></p>
                        </div>
                    </a>
                </div>
                <div class="col-md-1"></div>
            </div>
        </div>
        <a href="agenda/surat-keluar" style="text-decoration:none;color:black">
        <div class="dashboard-agenda-sk">
            <p class="dashboard-agenda-title">Agenda Surat Keluar</p>
            <table class="table dashboard-table">
                <thead>
                    <tr>
                        <th scope="col">No</th>
                        <th scope="col">No Surat</th>
                        <th scope="col">Perihal</th>
                        <th scope="col">Tanggal Dibuat</th>
                        <th scope="col">Kategori</th>
                    </tr>
                </thead>
                <tbody>
                <?php 
                    if (is_array($agenda_sk) && count($agenda_sk) > 0) {
                        $no = 1;
                    foreach ($agenda_sk as $ag): ?>
                            <tr>
                                <td><?= $no ?></td>
                                <td><?= $ag["no_surat"] ?></td>
                                <td><?= $ag["perihal"] ?></td>
                                <td><?= $ag["tgl_keluar_surat"] ?></td>
                                <td><?= $ag["kategori"] ?></td>
                            </tr>
                            <?php $no++ ?>
                        <?php endforeach ?>
                    <?php } else { ?>
                        <td colspan="5" class="table-no-data-message">No Data</td>
                    <?php } ?>
                    
                </tbody>
            </table>
        </div>
        </a>
        <a href="agenda/surat-masuk" style="text-decoration:none;color:black">
        <div class="dashboard-agenda-sm">
            <p class="dashboard-agenda-title">Agenda Surat Masuk</p>
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">No</th>
                        <th scope="col">No Masuk Surat</th>
                        <th scope="col">Perihal</th>
                        <th scope="col">Tanggal Masuk</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <?php 
                        if (is_array($agenda_sm) && count($agenda_sm) > 0) {
                            $no = 1;
                            foreach ($agenda_sm as $ag): ?>
                            <tr>
                                <td><?= $no ?></td>
                                <td><?= $ag["no_msk_surat"] ?></td>
                                <td><?= $ag["perihal"] ?></td>
                                <td><?= $ag["tgl_msk_surat"] ?></td>
                            </tr>
                        <?php 
                        $no++;
                        endforeach ?>
                        <?php } else { ?>
                            <td colspan="5" class="table-no-data-message">No Data</td>
                        <?php } ?>
                    </tr>
                </tbody>
            </table>
        </div>
        </a>
    </div>
</div>