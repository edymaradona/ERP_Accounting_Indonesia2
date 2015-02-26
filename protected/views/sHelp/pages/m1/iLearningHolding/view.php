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
        Training Schedule
    </h1>
</div>

<p>
    Halaman ini terdiri dari 2 bagian yaitu
<ul>
    <li>Kolom kiri terdapat 3 tab yaitu, yaitu
        <ul>
            <li>Tab Upcoming Events, berisi daftar jadwal training yang akan diadakan untuk topik tersebut. Tabel ini
                memiliki kolom
                <ul>
                    <li>Schedule Date: tanggal diadakannya training, berupa link ke detil informasi jadwal training</li>
                    <li>Trainer Name: nama trainer</li>
                    <li>Location: lokasi tempat diadakannya training</li>
                    <li>Additional Info: keterangan tambahan</li>
                    <li>Status: status ketersediaan jadwal training</li>
                    <li>Registrant: jumlah pendaftar</li>
                </ul>
                <img src="/images/man/m1_iLearningHolding_view_upcoming_event.jpg">
            </li>
            <li>Tab Past Events, berisi daftar jadwal training yang sudah diadakan untuk topik tersebut. Tabel ini
                memiliki kolom
                <ul>
                    <li>Schedule Date: tanggal diadakannya training, berupa link ke detil informasi jadwal training</li>
                    <li>Trainer Name: nama trainer</li>
                    <li>Location: lokasi tempat diadakannya training</li>
                    <li>Additional Info: keterangan tambahan</li>
                    <li>Status: status ketersediaan jadwal training</li>
                    <li>Actual Mandays: lama training, dengan satuan man day.
                        Untuk mengubah mandays, klik mandays yang ingin diubah maka APHRIS akan menampilkan form untuk
                        mengubah mandays seperti berikut
                        <img src="/images/man/m1_iLearningHolding_view_actual_mandays.jpg">
                        Misal lama training adalah 4 jam (dari 8 jam kerja), maka mandays yang diisikan adalah 0.5
                    </li>
                </ul>
                <img src="/images/man/m1_iLearningHolding_view_past_event.jpg">
            </li>
            <li>Tab Detail, berisi data detil topik training, data detil tersebut adalah
                <ul>
                    <li>Objective: targat yang ingin dicapai dengan diadakannya training topik tersebut</li>
                    <li>Outline: materi yang disampaikan</li>
                    <li>Target Participant: jenis peserta yang disarankan mengikuti training topik tersebut</li>
                    <li>Duration: lama training (dalam satuan jam)</li>
                    <li>Type: jenis training</li>
                </ul>
                <img src="/images/man/m1_iLearningHolding_view_detail.jpg">
            </li>
        </ul>
        <p>Untuk menambah data jadwal training baru,
            isi form tambah jadwal training, yang berada pada bagian bawah tab lalu klik Create. Form tambah jadwal
            training terdiri dari</p>
        <ul>
            <li>Schedule Date: tanggal diadakannya training, berupa link ke detil informasi jadwal training</li>
            <li>Trainer Name: nama trainer</li>
            <li>Location: lokasi tempat diadakannya training</li>
            <li>Additional Info: keterangan tambahan</li>
            <li>Status: status ketersediaan jadwal training</li>
            <li>Cost: biaya training per orang</li>
            <li>Total Participant: jumlah kursi yang disediakan</li>
        </ul>

        <p>Untuk mengubah jadwal training (hanya dapat dilakukan untuk jadwal yang ada di tab Upcoming Events), lakukan
            langkah berikut:</p>
        <ul>
            <li>Klik <img src="/images/man/pencil.jpg"> maka APHRIS akan menampilkan form seperti berikut <img
                    src="/images/man/m1_iLearningHolding_view_edit.jpg"></li>
            <li>Ubah data di form tersebut, lalu klik Save</li>
        </ul>

        <p>Untuk menghapus jadwal training, lakukan langkah berikut</p>
        <ul>
            <li>klik icon <img src="/images/man/bin.jpg"> pada baris yang ingin dihapus. APHRIS akan meminta konfirmasi
                penghapusan data <img src="/images/man/konfirmasi_delete.jpg"></li>
            <li>klik button OK untuk menghapus data jadwal training, atau button Cancel jika batal menghapus data jadwal
                training
            </li>
        </ul>

    </li>
    <li>Kolom kanan berisi
        <ul>
            <li>Create New Sylabus, link ke form tambah topik training</li>
            <li>Home, link ke daftar jadwal training bulan berjalan</li>
            <li>Update, link ke form edit topik training</li>
            <li>Delete, link untuk menghapus topik training. Untuk menghapus topik training, lakukan langkah berikut
            </li>
            <ul>
                <li>klik link Delete. APHRIS akan meminta konfirmasi penghapusan data <img
                        src="/images/man/konfirmasi_delete.jpg">
                </li>
                <li>klik button OK untuk menghapus data topik training yang sedang dilihat, atau button Cancel jika
                    batal menghapus
                    data topik training
                </li>
            </ul>
    </li>
    <li>Recently Updated, daftar topik training yang diubah</li>
    <li>Recently Added, daftar topik training yang ditambahkan</li>
</ul>
</li>
</ul>
