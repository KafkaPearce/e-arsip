
<!-- Tampil Data PENGIRIM-->
<div class="container-sm">
    <div class="card m-5 bg-body-secondary">
    <h5 class="card-header bg-secondary text-white">DATA PENGIRIM SURAT</h5>
    <form>
    <div class="m-3">
            <a href="?halaman=arsip_surat&hal=tambahdata" class="btn btn-info text-white mb-3">Tambah Data</a>
        <div class="table">
            <table class="table table-striped table-bordered text-center">
                    <tr class="table-dark">
                        <th scope="col">No Surat</th>
                        <th scope="col">Tanggal Penyerahan</th>
                        <th scope="col">Tanggal Terima</th>
                        <th scope="col">Perihal</th>
                        <th scope="col">Nama Instansi</th>
                        <th scope="col">Nama Pengirim</th>
                        <th scope="col">Lampiran</th>
                        <th scope="col">Aksi</th>
                    </tr>
                    <?php
                        $tampil = mysqli_query($conn, "SELECT
                        tbl_arsip.*,
                        tbl_instansi.nama_instansi,
                        tbl_pengirim.nama_pengirim, tbl_pengirim.no_hp
                        FROM
                        tbl_arsip, tbl_instansi, tbl_pengirim
                        WHERE
                        tbl_arsip.id_instansi = tbl_instansi.id_instansi
                        and tbl_arsip.id_pengirim = tbl_pengirim.id_pengirim") or die (mysqli_error($conn)); 
                        $no = 1;
                        while ($data = mysqli_fetch_array($tampil)) :
                        
                    ?>
                        <tr>
                            <td><?= $data['no_surat'] ?></td>
                            <td><?= $data['tanggal_surat'] ?></td>
                            <td><?= $data['tanggal_terima'] ?></td>
                            <td><?= $data['perihal'] ?></td>
                            <td><?= $data['nama_instansi'] ?></td>
                            <td><?= $data['nama_pengirim'] ?> / <?= $data['no_hp'] ?></td>
                            <td>
                        <?php
                        if(empty($data['file'])) {
                            echo "-";
                        } else {
                        ?>
                        <a href="file/<?=$data['file']?>" target="_blank">Lihat File</a>
                        <?php
                        }
                        ?>
                            </td>
                            <td><a href="?halaman=arsip_surat&hal=edit&id=<?= $data['id_arsip']; ?>" class="btn btn-success">Edit</a>
                            <a href="?halaman=arsip_surat&hal=hapus&id=<?= $data['id_arsip']; ?>" class="btn btn-danger" onclick="return confirm('Apakah anda yakin ingin menghapus data ini?')">Hapus</a>
                            </td>
                        </tr>
                    <?php endwhile; ?>
            </table>
        </div>
    </div>
    </form>
    </div>
                        </div>