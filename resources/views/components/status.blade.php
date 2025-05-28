@if ($status == 1)
    <td>Surat Rekomendasi</td>
@elseif ($status == 2)
    <td>Surat PTJM</td>
@elseif ($status == 3)
    <td>Letter of Acceptance</td>
@elseif ($status == 4)
    <td>Laporan Pertengahan</td>
@elseif ($status == 5)
    <td>Laporan Akhir</td>
@elseif ($status == 6)
    <td>Sertifikat</td>
@elseif ($status == 7)
    <td>Penilaian</td>
@else
    <td>-</td>
@endif
