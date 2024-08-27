<!-- Input nama Instansi -->
    <?php
    include "config/function.php";

            if (isset($_GET['hal'])) {
            if($_GET['hal'] == "edit"){
                 $tampil = mysqli_query($conn, "SELECT * FROM tbl_arsip WHERE id_arsip = '$_GET[id]'");
            $data = mysqli_fetch_array($tampil);
            if($data){
                $vno_surat = $data['no_surat'];
                $vtanggal_surat = $data['tanggal_surat'];
                $vtanggal_terima = $data['tanggal_terima'];
                $vperihal = $data['perihal'];
                $vid_instansi = $data['id_instansi'];
                $vid_pengirim = $data['id_pengirim'];
                $vfile = $data['file'];
            }
        }else if($_GET['hal'] == "hapus"){
            $hapus = mysqli_query($conn, "DELETE FROM tbl_arsip WHERE id_arsip = '$_GET[id]'") or die (mysqli_error($conn));
            if ($hapus) {
                echo "<script>alert('Data Terhapus'); document.location='?halaman=arsip_surat';</script>";
            }
        }
    }

        if (isset($_POST['bsubmit'])) {
            //pengujian data edit atau disimpan baru
            if($_GET['hal'] == "edit"){
                //perintah edit data
                //edit data
                if($_FILES['file']['error'] == 4){
                    $file = $vfile;
                }else{
                    $file = upload();
                }
                $edit = mysqli_query($conn, "UPDATE tbl_arsip SET no_surat = '$_POST[no_surat]', tanggal_surat = '$_POST[tanggal_surat]', tanggal_terima = '$_POST[tanggal_terima]', perihal = '$_POST[perihal]', id_instansi = '$_POST[id_instansi]', id_pengirim = '$_POST[id_pengirim]', file = '$file' WHERE id_arsip = '$_GET[id]'") or die (mysqli_error($conn));
            if ($edit) {
                echo "<script>alert('Perubahan Tersimpan'); document.location='?halaman=arsip_surat';</script>";
            }else{
                echo "<script>alert('Gagal mengubah data'); document.location='?halaman=arsip_surat';</script>";
            }
            //tambah data
            }else{
                $file = upload();
            $tambah = mysqli_query($conn, "INSERT INTO tbl_arsip VALUES('','$_POST[no_surat]','$_POST[tanggal_surat]','$_POST[tanggal_terima]','$_POST[perihal]','$_POST[id_instansi]','$_POST[id_pengirim]','$file')") or die (mysqli_error($conn));
            if ($tambah) {
                echo "<script>alert('Data Tersimpan'); document.location='?halaman=arsip_surat';</script>";
            }else{
                echo "<script>alert('Data Tidak Tersimpan'); document.location='?halaman=arsip_surat';</script>";
            }
            }
        }

    ?>
    <!-- FORM DATA PENGIRIM -->
<div class="container-sm">
    <div class="card m-5 bg-body-secondary">
    <h5 class="card-header bg-info text-white">FORM DATA ARSIP</h5>
    <form method="POST" action="" enctype="multipart/form-data">
    <div class="m-3">

    <label for="no_surat" class="form-label">Nomor Surat</label>
        <input type="text" class="form-control" id="no_surat" name="no_surat" value="<?= @$vno_surat; ?>">

        <label for="tanggal_surat" class="form-label">Tanggal Surat</label>
        <input type="date" class="form-control" id="tanggal_surat" name="tanggal_surat" value="<?= @$vtanggal_surat; ?>">

        <label for="tanggal_terima" class="form-label"> Tanggal Terima </label>
        <input type="date" class="form-control" id="tanggal_terima" name="tanggal_terima" value="<?= @$vtanggal_terima; ?>">

        <label for="perihal" class="form-label">Perihal</label>
        <input type="text" class="form-control" id="perihal" name="perihal" value="<?= @$vperihal; ?>">

        <label for="instansi" class="form-label">Instansi/Tujuan</label>
        <select class="form-control" name="id_instansi">
            <option value="">Pilih Instansi</option>
            <?php
                $tampil = mysqli_query($conn, "SELECT * FROM tbl_instansi") or die (mysqli_error($conn));
                while ($data = mysqli_fetch_array($tampil)) :
            ?>
            <option value="<?= $data['id_instansi']; ?>"><?= $data['nama_instansi']; ?></option>
            <?php endwhile; ?>
        </select>

        <label for="pengirim" class="form-label">Pengirim</label>
        <select class="form-control" name="id_pengirim">
            <option value="">Pilih Pengirim</option>
            <?php
                $tampil = mysqli_query($conn, "SELECT * FROM tbl_pengirim") or die (mysqli_error($conn));
                while ($data = mysqli_fetch_array($tampil)) :
            ?>
            <option value="<?= $data['id_pengirim']; ?>"><?= $data['nama_pengirim']; ?></option>
            <?php endwhile; ?>
        </select>

        <label for="file" class="form-label">File/Lampiran</label>
        <input type="file" class="form-control" id="file" name="file" value="<?= @$vfile; ?>">

        <button type="submit" name="bsubmit" class="btn btn-primary mt-3">Tambah</button>
        <button type="reset" name="breset" class="btn btn-danger mt-3">Kosongkan</button>
    </div>
    </form>
    </div>
</div>