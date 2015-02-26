<?php
$this->breadcrumbs = [
    'Help' => ['/m1/help'],
];

$this->menu = [
    ['label' => 'Home', 'icon' => 'home', 'url' => ['/help']],
];
?>

<div class="page-header">
    <h1>
        <i class="icon-fa-user"></i>
        Training Schedule Detail
    </h1>
</div>

<p>Berikut adalah tampilan halaman detil jadwal training
    <img src="/images/man/m1_iLearning_viewDetail.jpg">.
    Halaman ini terdiri dari beberapa bagian yaitu
<ul>
    <li>Kolom kiri berisi
        <ul>
            <li>Total Participant/Confirm: jumlah peserta yang mendaftar dan mengkonfirmasi</li>
            <li>Total Feedback: jumlah feedback</li>
            <li>Final Result: penilaian akhir training dari peserta</li>
            <li>Detil Jadwal Training, detilnya terdiri dari
                <ul>
                    <li>Trainer Name: nama trainer</li>
                    <li>Schedule Date: tanggal diadakannya training, berupa link ke detil informasi jadwal training</li>
                    <li>Additional Info: keterangan tambahan</li>
                    <li>Location: lokasi tempat diadakannya training</li>
                    <li>Status: status ketersediaan jadwal training</li>
                </ul>
            </li>
            <li>Form tambah peserta baru.
                <img src="/images/man/m1_iLearningHolding_viewDetail_new_participant.jpg">
                Untuk menambah peserta training, lakukan hal berikut
                <ul>
                    <li>Ketikkkan sebagian nama peserta yang ingin ditambahkan, maka APHRIS akan menampilkan daftar
                        pegawai yang memiliki nama mirip dengan yang diketikkan
                    </li>
                    <li>Pilih nama pegawai yang menjadi peserta training, dan klik Create. Nama pegawai akan tampil pada
                        daftar peserta di bagian bawah form tambah
                    </li>
                </ul>
                <img src="/images/man/m1_iLearningHolding_viewDetail_new_participant.jpg">
            </li>
            <li>Tab Detail, berisi button Confirm All untuk mengkonfirmasikan kepesertaan semua pendaftar dan daftar
                peserta dari keseluruhan anak perusahaan
                <img src="/images/man/m1_iLearningHolding_viewDetail_detail.jpg">.
                Daftar peserta memiliki beberapa kolom yaitu
                <ul>
                    <li>No: nomor urut</li>
                    <li>Employee Name: nama pegawai peserta training</li>
                    <li>Status: status kepesertaan. Status kepesertaan dapat diubah dengan klik status tersebut, maka
                        sistem akan menampilkan window untuk mengubah status seperti berikut
                        <img src="/images/man/m1_iLearningHolding_viewDetail_confirm.jpg">. Pilih status kepesertaan
                        lalu klik tanda centang. Untuk menutup window tersebut, klik tanda silang.
                    </li>
                    <li>Day1: presensi hari pertama. Status presensi dapat diubah dengan klik presensi tersebut, maka
                        sistem akan menampilkan window untuk mengubah presensi seperti berikut
                        <img src="/images/man/m1_iLearningHolding_viewDetail_presence.jpg">. Pilih presensi, lalu klik
                        tanda centang. Untuk menutup window tersebut, klik tanda silang.
                    </li>
                    <li>Day2: presensi hari kedua. Status presensi dapat diubah dengan cara seperti diatas</li>
                    <li>Feedback: link ke form input feedback peserta</li>
                    <li>Result: nilai akhir hasil perhitungan dari feedback peserta</li>
                    <li>Remark: catatan dari trainer</li>
                    <li>Inputed By: user yang menginput data peserta</li>
                </ul>
                <br>Untuk mengubah status kepesertaan
            </li>
            <li>Tab Feedback, berisi komentar dan feedback dari peserta
                <img src="/images/man/m1_iLearningHolding_viewDetail_feedback.jpg">.
                Daftar feedback memiliki beberapa kolom, yaitu
                <ul>
                    <li>No: nomor urut</li>
                    <li>Employee Name: nama pegawai peserta training, beserta nama anak perusahaan, departemen dan job
                        levelnya
                    </li>
                    <li>Comment: komentar dari dari peserta diinput dari form feedback</li>
                    <li>Feedback: feedback dari peserta diinput dari form feedback</li>
                </ul>
            </li>
            <li>Tab Photo, berisi daftar dan form upload foto kegiatan training
                <img src="/images/man/m1_iLearningHolding_viewDetail_photo.jpg">
                Untuk mengupload foto training lakukan hal berikut
                <ul>
                    <li>Klik link upload, sistem akan menampilkan window untuk memilih file yang akan diupload
                        <img src="/images/man/upload_foto.jpg">.
                    </li>
                    <li>Pilih file yang akan diupload, lalu klik Open. Sistem akan memperlihatkan persentase upload file
                        <img src="/images/man/m1_iLearningHolding_viewDetail_photo_upload.jpg">.
                    </li>
                </ul>
            </li>
        </ul>
    </li>
    <li>Kolom kanan berisi</li>
    <ul>
        <li>Home, link ke halaman utama training</li>
        <li>Topik training, link ke detil topik training</li>
        <li>Print Absence, link untuk mendownload daftar hadir. Format daftar hadir adalah sebagai berikut,
            <img src="/images/man/m1_iLearningHolding_printdetail.jpg">
        </li>
    </ul>
</ul>