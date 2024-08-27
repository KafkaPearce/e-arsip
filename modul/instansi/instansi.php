<!-- Input nama Instansi -->
    <?php
        if (isset($_POST['bsubmit'])) {
            //pengujian data edit atau disimpan baru
            if($_GET['hal'] == "edit"){
                //perintah edit data
                //edit data
                $edit = mysqli_query($conn, "UPDATE tbl_instansi SET nama_instansi = '$_POST[nama_instansi]' WHERE id_instansi = '$_GET[id]'") or die (mysqli_error($conn));
            if ($edit) {
                echo "<script>alert('Perubahan Tersimpan'); document.location='?halaman=instansi';</script>";
            }else{
                echo "<script>alert('Gagal mengubah data'); document.location='?halaman=instansi';</script>";
            }
            }else{
                $instansi = $_POST['nama_instansi'];
            $tambah = mysqli_query($conn, "INSERT INTO tbl_instansi VALUES('','$instansi')") or die (mysqli_error($conn));
            if ($tambah) {
                echo "<script>alert('Data Tersimpan'); document.location='?halaman=instansi';</script>";
            }else{
                echo "<script>alert('Data Tidak Tersimpan'); document.location='?halaman=instansi';</script>";
            }
            }
        }
        if (isset($_GET['hal'])) {
            if($_GET['hal'] == "edit"){
                 $tampil = mysqli_query($conn, "SELECT * FROM tbl_instansi WHERE id_instansi = '$_GET[id]'");
            $data = mysqli_fetch_array($tampil);
            if($data){
                $vnama_instansi = $data['nama_instansi'];
            }
        }else if($_GET['hal'] == "hapus"){
            $hapus = mysqli_query($conn, "DELETE FROM tbl_instansi WHERE id_instansi = '$_GET[id]'") or die (mysqli_error($conn));
            if ($hapus) {
                echo "<script>alert('Data Terhapus'); document.location='?halaman=instansi';</script>";
            }
        }
    }
    ?>
<div class="container-sm">
    <div class="card m-5 bg-body-secondary">
    <h5 class="card-header bg-info text-white">FORM INSTANSI</h5>
    <form method="POST" action="">
    <div class="m-3">
        <label for="nama-instansi" class="form-label">Nama Instansi</label>
        <input type="text" class="form-control" id="nama_instansi" name="nama_instansi" value="<?= @$vnama_instansi; ?>" aria-describedby="instansiHelp">
        <div id="instansiHelp" class="form-text">Masukkan nama Instansi</div>
        <button type="submit" name="bsubmit" class="btn btn-primary mt-3">Tambah</button>
        <button type="reset" name="breset" class="btn btn-danger mt-3">Kosongkan</button>
    </div>
    </form>
    </div>
</div>
<!-- Tampil Data Instansi -->
<div class="container-sm">
    <div class="card m-5 bg-body-secondary">
    <h5 class="card-header bg-info text-white">DATA INSTANSI</h5>
    <form>
    <div class="m-3">
        <div class="table">
            <table class="table table-striped table-bordered text-center">
                    <tr class="table-dark">
                        <th scope="col">No</th>
                        <th scope="col">Nama Instansi</th>
                        <th scope="col">Aksi</th>
                    </tr>
                    <?php
                        $tampil = mysqli_query($conn, "SELECT * FROM tbl_instansi order by id_instansi desc") or die (mysqli_error($conn));
                        $no = 1;
                        while ($data = mysqli_fetch_array($tampil)) :
                    ?>
                        <tr>
                            <td><?= $no++ ?></td>
                            <td><?= $data['nama_instansi'] ?></td>
                            <td><a href="?halaman=instansi&hal=edit&id=<?= $data['id_instansi']; ?>" class="btn btn-success">Edit</a>
                            <a href="?halaman=instansi&hal=hapus&id=<?= $data['id_instansi']; ?>" class="btn btn-danger" onclick="return confirm('Apakah anda yakin ingin menghapus data ini?')">Hapus</a>
                            </td>
                        </tr>
                    <?php endwhile; ?>
            </table>
        </div>
    </div>
    </form>
    </div>
                        </div>