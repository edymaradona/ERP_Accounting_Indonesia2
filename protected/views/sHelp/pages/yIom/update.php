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
        Create Inter Office Memo
    </h1>
</div>

<p>Halaman ini terdiri dari
    beberapa bagian yaitu</p>
<ul>
    <li>Bagian kiri berisi form tambah memo, yang terdiri dari
        <ul>
            <li>Number, nomor memo tidak dapat diubah</li>
            <li>To, nama penerima memo</li>
            <li>Cc, tembusan memo</li>
            <li>From, nama pengirim memo</li>
            <li>Subject, isi memo</li>
            <li>Attachment, ??</li>
            <li>Date, tanggal memo. Untuk menginput, klik kotak isian, maka APHRIS akan menampiilkan datepicker untuk
                memilih tanggal <img src="/images/man/select_date.jpg"></li>
            <li>Content, isi memo.Pada input content terdapat tool sederhana untuk mem format isi memo. Formatting yang
                disediakan adalah
                <ul>
                    <li>Jenis teks: normal, heading 1, heading 2, heading 3</li>
                    <li>Warna teks</li>
                    <li>Style: bold, italic, underline</li>
                    <li>List: ordered (dengan angka), not ordered (dengan bullet)</li>
                    <li>Indentation</li>
                    <li>Insert link dan image</li>
                </ul>
            </li>
            <li>Sender by</li>
            <li>Sender Title</li>
            <li>Approved by</li>
            <li>Approved Title</li>
            <br>Untuk mengubah memo baru, masukkan data memo di form tersebut,
            lalu klik Save
        </ul>
    </li>
    <li><p>Kolom kanan berisi
        <ul>
            <li>Home, link ke daftar memo</li>
            <li>View, link ke halaman view memo</li>
            <li>Recently Updated, memo yang baru di-update</li>
            <li>Recently Added, memo yang baru ditambahkan</li>
        </ul>
    </li>
</ul>
<BR>

<img src="/images/man/yIom_create.jpg">