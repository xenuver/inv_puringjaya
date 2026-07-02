<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Laporan Rekap Permintaan Barang Cabang</title>
    <style>
        /* Pengaturan Dasar Halaman Cetak */
        @page {
            margin: 1.2cm 1.2cm 1.2cm 1.2cm;
        }

        body {
            font-family: "Helvetica Neue", Helvetica, Arial, sans-serif;
            font-size: 11px;
            color: #222;
            line-height: 1.5;
        }

        /* Desain Kop Surat Resmi */
        .kop-surat {
            width: 100%;
            border-collapse: collapse;
            border-bottom: 3px double #000;
            padding-bottom: 10px;
            margin-bottom: 15px;
        }
        .kop-surat td {
            padding: 0;
            vertical-align: middle;
        }
        .kop-text {
            text-align: center;
        }
        .kop-text h1 {
            margin: 0;
            font-size: 18px;
            text-transform: uppercase;
            font-weight: bold;
            letter-spacing: 1px;
        }
        .kop-text h2 {
            margin: 2px 0 5px 0;
            font-size: 13px;
            text-transform: uppercase;
            font-weight: normal;
        }
        .kop-text p {
            margin: 0;
            font-size: 10px;
            color: #444;
            font-style: italic;
        }

        /* Judul Dokumen */
        .judul-laporan {
            text-align: center;
            margin-bottom: 20px;
        }
        .judul-laporan h3 {
            margin: 0;
            font-size: 14px;
            text-transform: uppercase;
            font-weight: bold;
            text-decoration: underline;
        }
        .judul-laporan p {
            margin: 5px 0 0 0;
            font-size: 11px;
        }

        /* Informasi Metadata Laporan */
        .meta-table {
            width: 100%;
            margin-bottom: 10px;
            font-size: 10px;
        }
        .meta-table td {
            padding: 2px 0;
        }

        /* Desain Tabel Data Standar Akuntansi/Sistem */
        .data-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 5px;
        }
        .data-table th {
            background-color: #f5f5f5;
            color: #000;
            border: 1px solid #000;
            font-weight: bold;
            text-transform: uppercase;
            padding: 8px 5px;
            font-size: 10px;
            text-align: center;
        }
        .data-table td {
            border: 1px solid #000;
            padding: 6px 6px;
            vertical-align: top;
        }

        /* Utility Class Alignment */
        .text-center { text-align: center; }
        .text-left { text-align: left; }
        .text-right { text-align: right; }

        /* Desain List Barang di Dalam Tabel */
        .barang-list {
            margin: 0;
            padding-left: 14px;
        }
        .barang-list li {
            margin-bottom: 2px;
        }

        /* Penandatanganan / TTD */
        .ttd-container {
            margin-top: 40px;
            width: 100%;
            page-break-inside: avoid;
        }
        .ttd-table {
            width: 100%;
            border-collapse: collapse;
        }
        .ttd-table td {
            padding: 0;
            text-align: center;
            width: 33%;
            vertical-align: top;
        }
        .ttd-space {
            height: 60px;
        }

        /* Nomor Halaman Otomatis (DomPDF default) */
        .page-number:before {
            content: counter(page);
        }
        .footer-page {
            position: fixed;
            bottom: -20px;
            left: 0px;
            right: 0px;
            height: 20px;
            text-align: right;
            font-size: 9px;
            color: #777;
        }
    </style>
</head>
<body>

    {{-- Penomoran Halaman Otomatis di Kanan Bawah Dokumen --}}
    <div class="footer-page">
        Halaman <span class="page-number"></span>
    </div>

    {{-- 1. KOP SURAT RESMI --}}
    <table class="kop-surat">
        <tr>
            <td class="kop-text">
                <h1>Rumah Makan Puring Jaya Pontianak</h1>
                <h2>Distribusi & Logistik Gudang Pusat</h2>
                <p>Jalan Khatulistiwa No.8, Siantan Hilir, Pontianak Utara, Pontianak, Kalimantan Barat</p>
                <p>Telp: (0561) 123456 | Email: info@rmpuringjaya.com | Web: www.rmpuringjayapontianak.com</p>
            </td>
        </tr>
    </table>

    {{-- 2. JUDUL LAPORAN --}}
    <div class="judul-laporan">
        <h3>Laporan Rekap Permintaan Barang Cabang</h3>
        <p>Periode Dokumen: s.d {{ now()->format('d F Y') }}</p>
    </div>

    {{-- 3. METADATA CETAK --}}
    <table class="meta-table">
        <tr>
            <td width="15%">Tanggal Cetak</td>
            <td width="2%">:</td>
            <td width="43%">{{ now()->format('d-m-Y H:i') }} WIB</td>
            <td width="15%">Dicetak Oleh</td>
            <td width="2%">:</td>
            <td width="23%">{{ auth()->user()->name }}</td>
        </tr>
        <tr>
            <td>Sumber Data</td>
            <td>:</td>
            <td>Sistem Inventory Logistik Pusat</td>
            <td>Status Filter</td>
            <td>:</td>
            <td>{{ request('status') ? request('status') : 'Semua Status' }}</td>
        </tr>
        <tr>
            <td>Cabang Filter</td>
            <td>:</td>
            <td>{{ $namaCabang ?? 'Semua Cabang' }}</td>
            <td></td>
            <td></td>
            <td></td>
        </tr>
    </table>

    {{-- 4. TABEL UTAMA LAPORAN --}}
    <table class="data-table">
        <thead>
            <tr>
                <th width="4%">No</th>
                <th width="13%">Tanggal Input</th>
                <th width="15%">Cabang Peminta</th>
                <th width="13%">Nama User</th>
                <th width="28%">Rincian Detail Barang & Qty</th>
                <th width="17%">Catatan Instansi</th>
                <th width="10%">Status</th>
            </tr>
        </thead>
        <tbody>
            @forelse($permintaan as $key => $row)
            <tr>
                <td class="text-center">{{ $key + 1 }}</td>
                <td class="text-center">{{ $row->created_at->format('d-m-Y H:i') }}</td>
                <td>{{ $row->cabang->nama ?? '-' }}</td>
                <td>{{ $row->user->name ?? '-' }}</td>
                <td>
                    <ul class="barang-list">
                        @foreach ($row->permintaandetail as $detail)
                            <li>
                                {{ $detail->barang->nama ?? '-' }}
                                <strong>({{ $detail->jumlah }} {{ $detail->barang->satuan ?? 'Pcs' }})</strong>
                            </li>
                        @endforeach
                    </ul>
                </td>
                <td>{{ $row->catatan ?? '-' }}</td>
                <td class="text-center" style="font-weight: bold; text-transform: uppercase;">
                    {{ $row->status }}
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="7" class="text-center" style="padding: 20px;">Tidak ditemukan rekap data permintaan cabang pada sistem.</td>
            </tr>
            @endforelse
        </tbody>
    </table>

    {{-- 5. BAGIAN TANDA TANGAN VALIDASI (TTD) --}}
    <div class="ttd-container">
        <table class="ttd-table">
            <tr>
                <td>
                    <p>Pontianak, {{ now()->format('d F Y') }}</p>
                    <p>Dibuat Oleh, <br><strong>Petugas Gudang</strong></p>
                    <div class="ttd-space"></div>
                    <p><u>{{ auth()->user()->name }}</u></p>
                </td>
                <td>
                    </td>
                <td>
                    <p>&nbsp;</p>
                    <p>Mengetahui, <br><strong>Kepala Gudang Pusat</strong></p>
                    <div class="ttd-space"></div>
                    <p><u>_______________________</u></p>
                </td>
            </tr>
        </table>
    </div>

</body>
</html>
