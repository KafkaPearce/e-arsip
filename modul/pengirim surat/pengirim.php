<!-- Input nama Instansi -->
    <?php
        if (isset($_POST['bsubmit'])) {
            //pengujian data edit atau disimpan baru
            if($_GET['hal'] == "edit"){
                //perintah edit data
                //edit data
                $edit = mysqli_query($conn, "UPDATE tbl_pengirim SET nama_pengirim = '$_POST[nama_pengirim]', alamat = '$_POST[alamat]', no_hp = '$_POST[no_hp]', email = '$_POST[email]' WHERE id_pengirim = '$_GET[id]'") or die (mysqli_error($conn));
            if ($edit) {
                echo "<script>alert('Perubahan Tersimpan'); document.location='?halaman=pengirim_surat';</script>";
            }else{
                echo "<script>alert('Gagal mengubah data'); document.location='?halaman=pengirim_surat';</script>";
            }
            //tambah data
            }else{
            $tambah = mysqli_query($conn, "INSERT INTO tbl_pengirim VALUES('','$_POST[nama_pengirim]','$_POST[alamat]','$_POST[no_hp]','$_POST[email]')") or die (mysqli_error($conn));
            if ($tambah) {
                echo "<script>alert('Data Tersimpan'); document.location='?halaman=pengirim_surat';</script>";
            }else{
                echo "<script>alert('Data Tidak Tersimpan'); document.location='?halaman=pengirim_surat';</script>";
            }
            }
        }
        if (isset($_GET['hal'])) {
            if($_GET['hal'] == "edit"){
                 $tampil = mysqli_query($conn, "SELECT * FROM tbl_pengirim WHERE id_pengirim = '$_GET[id]'");
            $data = mysqli_fetch_array($tampil);
            if($data){
                $vnama_pengirim = $data['nama_pengirim'];
                $valamat = $data['alamat'];
                $vno_hp = $data['no_hp'];
                $vemail = $data['email'];
            }
        }else if($_GET['hal'] == "hapus"){
            $hapus = mysqli_query($conn, "DELETE FROM tbl_pengirim WHERE id_pengirim = '$_GET[id]'") or die (mysqli_error($conn));
            if ($hapus) {
                echo "<script>alert('Data Terhapus'); document.location='?halaman=pengirim_surat';</script>";
            }
        }
    }
    ?>
    <!-- FORM DATA PENGIRIM -->
<div class="container-sm">
    <div class="card m-5 bg-body-secondary">
    <h5 class="card-header bg-info text-white">FORM DATA PENGIRIM</h5>
    <form method="POST" action="">
    <div class="m-3">
        <!-- Input nama Pengirim -->
        <label for="nama-pengirim" class="form-label">Nama Pengirim</label>
        <input type="text" class="form-control" id="nama_pengirim" name="nama_pengirim" value="<?= @$vnama_pengirim; ?>">
        <!-- Input Alamat -->
        <label for="alamat" class="form-label">Alamat</label>
        <input type="text" class="form-control" id="alamat" name="alamat" value="<?= @$valamat; ?>">
        <!-- Input Nomor Telepon -->
        <label for="no_hp" class="form-label">Nomor Telepon</label>
        <input type="text" class="form-control" id="no_hp" name="no_hp" value="<?= @$vno_hp; ?>">
        <!-- Input Email -->
        <label for="email" class="form-label">Email</label>
        <input type="text" class="form-control" id="email" name="email" value="<?= @$vemail; ?>">

        <button type="submit" name="bsubmit" class="btn btn-primary mt-3">Tambah</button>
        <button type="reset" name="breset" class="btn btn-danger mt-3">Kosongkan</button>
    </div>
    </form>
    </div>
</div>
<!-- Tampil Data PENGIRIM-->
<div class="container-sm">
    <div class="card m-5 bg-body-secondary">
    <h5 class="card-header bg-info text-white">DATA PENGIRIM SURAT</h5>
    <form>
    <div class="m-3">
        <div class="table">
            <table class="table table-striped table-bordered text-center">
                    <tr class="table-dark">
                        <th scope="col">No</th>
                        <th scope="col">Nama Pengirim</th>
                        <th scope="col">Alamat</th>
                        <th scope="col">No Hp</th>
                        <th scope="col">Email</th>
                        <th scope="col">Aksi</th>
                    </tr>
                    <?php
                        $tampil = mysqli_query($conn, "SELECT * FROM tbl_pengirim order by id_pengirim desc") or die (mysqli_error($conn));
                        $no = 1;
                        while ($data = mysqli_fetch_array($tampil)) :
                    ?>
                        <tr>
                            <td><?= $no++ ?></td>
                            <td><?= $data['nama_pengirim'] ?></td>
                            <td><?= $data['alamat'] ?></td>
                            <td><?= $data['no_hp'] ?></td>
                            <td><?= $data['email'] ?></td>
                            <td><a href="?halaman=pengirim_surat&hal=edit&id=<?= $data['id_pengirim']; ?>" class="btn btn-success">Edit</a>
                            <a href="?halaman=pengirim_surat&hal=hapus&id=<?= $data['id_pengirim']; ?>" class="btn btn-danger" onclick="return confirm('Apakah anda yakin ingin menghapus data ini?')">Hapus</a>
                            </td>
                        </tr>
                    <?php endwhile; ?>
            </table>
        </div>
    </div>
    </form>
    </div>
                        </div>