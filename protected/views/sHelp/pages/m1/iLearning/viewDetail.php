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

<p>Halaman ini terdiri dari beberapa bagian yaitu
<ul>
    <li>Kolom kiri berisi
        <ul>
            <li>Detil Jadwal Training, detilnya terdiri dari
                <ul>
                    <li>Objective: targat yang ingin dicapai dengan diadakannya training topik tersebut</li>
                    <li>Outline: materi yang disampaikan</li>
                    <li>Target Participant: jenis peserta yang disarankan mengikuti training topik tersebut</li>
                    <li>Duration: lama training (dalam satuan jam)</li>
                    <li>Type: jenis training</li>
                    <li>Schedule Date: tanggal diadakannya training, berupa link ke detil informasi jadwal training</li>
                    <li>Trainer Name: nama trainer</li>
                    <li>Location: lokasi tempat diadakannya training</li>
                    <li>Additional Info: keterangan tambahan</li>
                    <li>Status: status ketersediaan jadwal training</li>
                </ul>
            </li>
            <li>Jumlah peserta, nilai feedback, dan hasil akhir</li>
            <li>Form tambah peserta baru. Untuk menambah peserta training, lakukan hal berikut
                <ul>
                    <li>Ketikkkan sebagian nama peserta yang ingin ditambahkan, maka APHRIS akan menampilkan daftar
                        pegawai yang memiliki nama mirip dengan yang diketikkan
                    </li>
                    <li>Pilih nama pegawai yang menjadi peserta training, dan klik Create. Nama pegawai akan tampil pada
                        daftar peserta di bagian bawah form tambah
                    </li>
                </ul>
                <img src="/images/man/m1_iLearning_viewDetail_new_participant.jpg">
            </li>
            <li>Daftar peserta internal perusahaan
                <img src="/images/man/m1_iLearning_viewDetail_participant_list.jpg">
            </li>
        </ul>
    </li>
    <li>Kolom kanan berisi</li>
    <ul>
        <li>Home, link ke halaman utama training</li>
        <li>Topik training, link ke detil topik training</li>
    </ul>
</ul>
<img src="/images/man/m1_iLearning_viewDetail.jpg">