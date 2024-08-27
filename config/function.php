<?php
    //function untuk upload file

    function upload()
    {
        $namaFile = $_FILES['file']['name'];
        $ukuranFile = $_FILES['file']['size'];
        $error = $_FILES['file']['error'];
        $tmpName = $_FILES['file']['tmp_name'];

        //cek apakah tidak ada gambar yang diupload
            $exfilevalid = ['jpg', 'jpeg', 'png'];
            $exfile = explode('.', $namaFile);
            $exfile = strtolower(end($exfile));
            if(!in_array($exfile, $exfilevalid)){
                echo "<script>
                        alert('File yang diupload harus gambar!');
                        </script>";
                return false;
            }

        //cek ukuran file
        if($ukuranFile > 1000000000){
            echo "<script>
                    alert('Ukuran gambar terlalu besar!');
                    </script>";
            return false;
        }

        //lolos pengecekan, gambar siap diupload
        //generate nama gambar baru
        $namaFileBaru = uniqid();
        $namaFileBaru .= '.';
        $namaFileBaru .= $exfile;
        move_uploaded_file($tmpName, 'file/' . $namaFileBaru);
        return $namaFileBaru;
    }
?>