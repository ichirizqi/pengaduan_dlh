
<table>
    <thead>
    <tr>
        <th colspan="4"><strong>Laporan Pengaduan Verifikasi</strong></th>
    </tr>
    <tr>
        <th colspan="4"></th>
    </tr>
    <tr>
        <th><strong>Nama</strong></th>
        <th><strong>Email</strong></th>
        <th><strong>Pihak Terduga</strong></th>
        <th><strong>Masalah</strong></th>
    </tr>
    </thead>
    <tbody>
    @foreach($transaction as $v)
        <tr>
            <td>{{ $v->nama }}</td>
            <td>{{ $v->email }}</td>
            <td>{{ $v->get_isu->pihak_terduga }}</td>
            <td>{{ $v->masalah }}</td>
        </tr>
    @endforeach
    </tbody>
</table>