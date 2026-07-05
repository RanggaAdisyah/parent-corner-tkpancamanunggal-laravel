<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <title>Cetak Laporan - {{ $siswa->nama }} - {{ \Carbon\Carbon::createFromFormat('Y-m', $monthYear)->translatedFormat('F Y') }}</title>
    <style>
        body { font-family: 'Arial', sans-serif; margin: 0; padding: 20px; color: #333; }
        .header { text-align: center; border-bottom: 2px solid #333; padding-bottom: 10px; margin-bottom: 20px; }
        .header h1 { margin: 0; font-size: 24px; text-transform: uppercase; }
        .header p { margin: 5px 0 0; font-size: 14px; color: #666; }
        .info { margin-bottom: 20px; }
        .info table { width: 100%; max-width: 400px; font-size: 14px; }
        .info td { padding: 4px 0; }
        .info td:first-child { font-weight: bold; width: 120px; }
        
        .report-table { width: 100%; border-collapse: collapse; margin-top: 10px; table-layout: fixed; }
        .report-table th, .report-table td { border: 1px solid #333; padding: 8px; text-align: left; font-size: 14px; word-wrap: break-word; overflow-wrap: break-word; word-break: break-word; }
        .report-table th { background-color: #f5f5f5; font-weight: bold; text-align: center; }
        .text-center { text-align: center !important; }
        
        @media print {
            body { padding: 0; }
            .no-print { display: none; }
        }
        
        .btn-print {
            display: inline-block;
            padding: 10px 20px;
            background: #3b82f6;
            color: #fff;
            text-decoration: none;
            border-radius: 4px;
            margin-bottom: 20px;
            font-weight: bold;
            border: none;
            cursor: pointer;
        }
    </style>
</head>
<body>
    <div class="no-print" style="text-align: right;">
        <button class="btn-print" onclick="window.print()">Cetak Halaman Ini</button>
    </div>
    
    <div class="header">
        <h1>TK Panca Manunggal</h1>
        <p>Laporan Perkembangan Anak</p>
    </div>

    <div class="info">
        <table>
            <tr>
                <td>Nama Siswa</td>
                <td>: {{ $siswa->nama }}</td>
            </tr>
            <tr>
                <td>Bulan Laporan</td>
                <td>: {{ \Carbon\Carbon::createFromFormat('Y-m', $monthYear)->translatedFormat('F Y') }}</td>
            </tr>
        </table>
    </div>

    <table class="report-table">
        <thead>
            <tr>
                <th width="5%">No</th>
                <th width="15%">Tanggal</th>
                <th width="15%">Level</th>
                <th width="15%">Halaman</th>
                <th width="10%">Nilai</th>
                <th width="40%">Catatan Guru</th>
            </tr>
        </thead>
        <tbody>
            @forelse($nilais as $index => $nilai)
                <tr>
                    <td class="text-center">{{ $index + 1 }}</td>
                    <td class="text-center">{{ \Carbon\Carbon::parse($nilai->tanggal)->format('d/m/Y') }}</td>
                    <td class="text-center">{{ $nilai->level ?? '-' }}</td>
                    <td class="text-center">{{ $nilai->hal ?? '-' }}</td>
                    <td class="text-center"><strong>{{ $nilai->nilai ?? '-' }}</strong></td>
                    <td>{!! $nilai->keterangan ?? '-' !!}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" class="text-center" style="padding: 20px;">Tidak ada rekap nilai untuk bulan ini.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <div style="margin-top: 50px; text-align: right;">
        <p style="margin-bottom: 80px;">Mengetahui,<br>Guru Kelas</p>
        <p>____________________</p>
    </div>
</body>
</html>
