<?php

require_once __DIR__ . '/vendor/autoload.php';

require 'function2.php';
$mahasiswa = query("SELECT * FROM tblmahasiswa");

$mpdf = new \Mpdf\Mpdf();

$html = '<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Mahasiswa</title>
</head>
<body>
    <h1 align="center">Daftar Mahasiswa</h1>
    <table border="1" cellpadding="10" cellspacing="0">
        <thead>
            <tr>
                <td>No</td>
                <td>nim</td>
                <td>nama</td>
                <td>email</td>
                <td>jurusan</td>
                <td>fakultas</td>
                <td>gambar</td>
            </tr>';

$i = 1;
foreach ($mahasiswa as $row) {
    $html .= '<tr class="cetak">
                    <td>'. $i++ .' </td>
                    <td>'. $row["nim"] .' </td>
                    <td>'. $row["nama"] .' </td>
                    <td>'. $row["email"] .' </td>
                    <td>'. $row["jurusan"] .' </td>
                    <td>'. $row["fakultas"] .' </td>
                    <td> <img src="gambar/'.$row["gambar"].'" width="60"></td>
                </tr>';
}

$html .= '</table>
</body>
</html>';

$mpdf->WriteHTML($html);
$mpdf->Output('Daftar_Mahasiswa.pdf', \Mpdf\Output\Destination::INLINE);
