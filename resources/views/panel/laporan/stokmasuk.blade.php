@extends('layouts.panel')

@section('content')
<div class="container-fluid mt-4">
    <div class="card mb-4 shadow-sm">

        <div class="card-header bg-white py-3">
            <h5 class="m-0 font-weight-bold text-dark">
                <i class="fa fa-boxes me-2 text-primary"></i>Laporan Stok Masuk (Gudang)
            </h5>
        </div>

        <div class="card-body">

            <div class="d-flex justify-content-start gap-2 mb-4 d-print-none">
                <a href="{{ route('laporan.stokmasuk.pdf', ['tgl_mulai' => request('tgl_mulai'), 'tgl_selesai' => request('tgl_selesai')]) }}"
                   class="btn btn-danger px-3 shadow-sm"
                   target="_blank">
                    <i class="fa fa-file-pdf me-2"></i>Cetak PDF
                </a>
            </div>
            <hr class="d-print-none mb-4">

            <form method="GET" action="{{ route('laporan.stokmasuk') }}" class="row g-3 mb-4 d-print-none">
                <div class="col-md-4">
                    <label class="form-label fw-semibold">Tanggal Mulai</label>
                    <input type="date" name="tgl_mulai" class="form-control" value="{{ request('tgl_mulai') }}" required>
                </div>
                <div class="col-md-4">
                    <label class="form-label fw-semibold">Tanggal Selesai</label>
                    <input type="date" name="tgl_selesai" class="form-control" value="{{ request('tgl_selesai') }}" required>
                </div>
                <div class="col-md-4 d-flex align-items-end">
                    <button type="submit" class="btn btn-success me-2 px-4">Filter Data</button>
                    <a href="{{ route('laporan.stokmasuk') }}" class="btn btn-secondary px-4">Reset</a>
                </div>
            </form>

            <div class="table-responsive">
                <table class="table table-bordered table-striped align-middle">
                    <thead class="table-success">
                        <tr>
                            <th width="5%" class="text-center">No</th>
                            <th width="20%">Kode Masuk</th>
                            <th width="25%">Tanggal</th>
                            <th width="50%">Detail Barang & Jumlah</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($stokmasuk as $sm)
                        <tr>
                            <td class="text-center">{{ $loop->iteration }}</td>
                            <td><span class="badge bg-secondary px-2 py-1 fs-6">{{ $sm->kodemasuk }}</span></td>
                            <td>{{ \Carbon\Carbon::parse($sm->created_at)->format('d-m-Y H:i') }} WIB</td>
                            <td>
                                <ul class="mb-0 ps-3">
                                    @foreach($sm->stokmasukdetail as $detail)
                                    <li>
                                        {{-- Perbaikan di sini menggunakan ?-> untuk menghindari error null --}}
                                        <strong>{{ $detail->stokgudang?->barang?->nama ?? 'Barang Terhapus' }}</strong>
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
                            <td colspan="4" class="text-center py-4 text-muted">
                                <i class="fa fa-folder-open me-2 fs-5"></i>Data tidak ditemukan.
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<style>
    @media print {
        body * { visibility: hidden; }
        .card, .card * { visibility: visible; }
        .card { position: absolute; left: 0; top: 0; width: 100%; border: none; }
        .d-print-none { display: none !important; }
        .table th { background-color: #212529 !important; color: white !important; -webkit-print-color-adjust: exact; }
    }
</style>
@endsection
