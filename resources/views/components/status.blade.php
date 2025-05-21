@if ($status == 1)
    <td>Surat Rekomendasi & Surat PTJM</td>
@elseif ($status == 2)
    <td>Letter of Acceptance</td>
@elseif ($status == 3)
    <td>Laporan Pertengahan</td>
@elseif ($status == 4)
    <td>Laporan Akhir</td>
@elseif ($status == 5)
    <td>Sertifikat & Penilaian</td>
@else
    <td>-</td>
@endif
