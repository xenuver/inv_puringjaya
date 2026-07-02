<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Laporan_Stok_Masuk_{{ date('Ymd') }}</title>
    <style>
        /* Pengaturan Dasar Halaman Cetak */
        @page {
            size: A4 portrait;
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
            page-break-inside: auto;
        }
        .data-table tr {
            page-break-inside: avoid;
            page-break-after: auto;
        }
        .data-table th {
            background-color: #2c3e50;
            color: #ffffff;
            border: 1px solid #2c3e50;
            font-weight: bold;
            text-transform: uppercase;
            padding: 8px 6px;
            font-size: 10px;
            text-align: center;
        }
        .data-table td {
            border: 1px solid #cbd5e1;
            padding: 7px 6px;
            vertical-align: top;
        }

        /* Zebra Striping */
        .data-table tbody tr:nth-child(even) {
            background-color: #f8fafc;
        }

        /* Utility Class Alignment */
        .text-center { text-align: center; }
        .text-left { text-align: left; }
        .text-right { text-align: right; }

        /* Badge Kode Masuk */
        .kode-badge {
            display: inline-block;
            background-color: #27ae60;
            color: #fff;
            padding: 2px 6px;
            border-radius: 3px;
            font-size: 10px;
            font-weight: bold;
        }

        /* Desain List Barang di Dalam Tabel */
        .barang-list {
            margin: 0;
            padding-left: 14px;
        }
        .barang-list li {
            margin-bottom: 2px;
        }
        .text-muted {
            color: #64748b;
            font-size: 9.5px;
        }

        /* Baris Total Ringkasan */
        .summary-table {
            width: 100%;
            margin-top: 10px;
            border-collapse: collapse;
            font-size: 10px;
        }
        .summary-table td {
            padding: 4px 6px;
            border: 1px solid #000;
        }
        .summary-label {
            background-color: #f5f5f5;
            font-weight: bold;
            text-align: right;
            width: 85%;
        }
        .summary-value {
            text-align: center;
            font-weight: bold;
            width: 15%;
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
        <h3>Laporan Rekapitulasi Stok Masuk Gudang</h3>
        <p>Periode: <strong>{{ $periode }}</strong></p>
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
            <td>Total Transaksi</td>
            <td>:</td>
            <td>{{ count($stokmasuk) }} Transaksi</td>
        </tr>
    </table>

    {{-- 4. TABEL UTAMA LAPORAN --}}
    <table class="data-table">
        <thead>
            <tr>
                <th width="5%">No</th>
                <th width="20%">Kode Masuk</th>
                <th width="20%">Tanggal Masuk</th>
                <th width="55%">Detail Barang & Jumlah</th>
            </tr>
        </thead>
        <tbody>
            @forelse($stokmasuk as $index => $sm)
            <tr>
                <td class="text-center">{{ $index + 1 }}</td>
                <td class="text-center"><span class="kode-badge">{{ $sm->kodemasuk }}</span></td>
                <td class="text-center">{{ \Carbon\Carbon::parse($sm->created_at)->format('d-m-Y H:i') }} WIB</td>
                <td>
                    <ul class="barang-list">
                        @foreach($sm->stokmasukdetail as $detail)
                        <li>
                            <strong>{{ $detail->stokgudang?->barang?->nama ?? 'Barang Tidak Ditemukan' }}</strong>
                            <span class="text-muted">
                                ({{ $detail->jumlah }} {{ $detail->stokgudang?->barang?->satuan ?? 'pcs' }})
                            </span>
                        </li>
                        @endforeach
                    </ul>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="4" class="text-center" style="padding: 20px; color: #64748b;">
                    Tidak ada data transaksi stok masuk pada periode ini.
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>

    {{-- 5. RINGKASAN TOTAL --}}
    @if(count($stokmasuk) > 0)
    <table class="summary-table">
        <tr>
            <td class="summary-label">Total Transaksi Stok Masuk</td>
            <td class="summary-value">{{ count($stokmasuk) }}</td>
        </tr>
    </table>
    @endif

    {{-- 6. BAGIAN TANDA TANGAN VALIDASI (TTD) --}}
    <div class="ttd-container">
        <table class="ttd-table">
            <tr>
                <td>
                    <p>Pontianak, {{ now()->format('d F Y') }}</p>
                    <p>Dibuat Oleh, <br><strong>Petugas Gudang</strong></p>
                    <div class="ttd-space"></div>
                    <p><u>{{ auth()->user()->name }}</u></p>
                </td>
                <td></td>
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
