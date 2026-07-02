@extends('layouts.panel')

@section('content')
<div class="container-fluid mt-4">
    <div class="card mb-4 shadow-sm">

        <div class="card-header bg-white py-3">
            <h5 class="m-0 font-weight-bold text-dark">
                <i class="fa fa-box-open me-2 text-primary"></i>Laporan Stok Keluar (Penjualan/Pemakaian)
            </h5>
        </div>

        <div class="card-body">

            {{-- Tombol Cetak PDF --}}
            <div class="d-flex justify-content-start gap-2 mb-4 d-print-none">
                <a href="{{ route('laporan.stokkeluar.pdf', [
                        'tgl_mulai'  => request('tgl_mulai'),
                        'tgl_selesai' => request('tgl_selesai'),
                        'cabang_id'  => request('cabang_id'),
                    ]) }}"
                   class="btn btn-danger px-3 shadow-sm"
                   target="_blank">
                    <i class="fa fa-file-pdf me-2"></i>Cetak PDF
                </a>
            </div>
            <hr class="d-print-none mb-4">

            {{-- Form Filter --}}
            <form method="GET" action="{{ route('laporan.stokkeluar') }}" class="row g-3 mb-4 d-print-none">

                {{-- Filter Cabang --}}
                <div class="col-md-4">
                    <label class="form-label fw-semibold">Cabang</label>
                    <select name="cabang_id" class="form-control">
                        <option value="">-- Semua Cabang --</option>
                        @foreach($cabang as $cbg)
                            <option value="{{ $cbg->id }}" {{ request('cabang_id') == $cbg->id ? 'selected' : '' }}>
                                {{ $cbg->nama }}
                            </option>
                        @endforeach
                    </select>
                </div>

                {{-- Filter Tanggal Mulai --}}
                <div class="col-md-3">
                    <label class="form-label fw-semibold">Tanggal Mulai</label>
                    <input type="date" name="tgl_mulai" class="form-control" value="{{ request('tgl_mulai') }}">
                </div>

                {{-- Filter Tanggal Selesai --}}
                <div class="col-md-3">
                    <label class="form-label fw-semibold">Tanggal Selesai</label>
                    <input type="date" name="tgl_selesai" class="form-control" value="{{ request('tgl_selesai') }}">
                </div>

                {{-- Tombol --}}
                <div class="col-md-2 d-flex align-items-end gap-2">
                    <button type="submit" class="btn btn-success px-3">Filter</button>
                    <a href="{{ route('laporan.stokkeluar') }}" class="btn btn-secondary px-3">Reset</a>
                </div>

            </form>

            {{-- Tabel Laporan --}}
            <div class="table-responsive">
                <table class="table table-bordered table-striped align-middle">
                    <thead class="table-success">
                        <tr>
                            <th width="5%" class="text-center">No</th>
                            <th width="12%">Kode Keluar</th>
                            <th width="13%">Cabang</th>
                            <th width="12%">Petugas</th>
                            <th width="15%">Tanggal</th>
                            <th width="25%">Detail Barang & Jumlah</th>
                            <th width="18%">Catatan / Keperluan</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($stokkeluar as $sk)
                        <tr>
                            <td class="text-center">{{ $loop->iteration }}</td>
                            <td><span class="badge bg-secondary px-2 py-1 fs-6">{{ $sk->kodekeluar }}</span></td>
                            <td>{{ $sk->cabang->nama ?? 'Semua Cabang' }}</td>
                            <td>{{ $sk->user->name ?? '-' }}</td>
                            <td>{{ \Carbon\Carbon::parse($sk->created_at)->format('d-m-Y H:i') }} WIB</td>
                            <td>
                                <ul class="mb-0 ps-3">
                                    @foreach($sk->stokkeluardetail as $detail)
                                    <li>
                                        <strong>{{ $detail->barang->nama ?? 'Barang Tidak Ditemukan' }}</strong>
                                        <span class="text-muted">
                                            ({{ $detail->jumlah }} {{ $detail->barang->satuan ?? '' }})
                                        </span>
                                    </li>
                                    @endforeach
                                </ul>
                            </td>
                            <td>
                                @if($sk->catatan)
                                    <span class="text-dark">{{ $sk->catatan }}</span>
                                @else
                                    <span class="text-muted"><em>- Tidak ada catatan -</em></span>
                                @endif
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="7" class="text-center py-4 text-muted">
                                <i class="fa fa-folder-open me-2 fs-5"></i>Data tidak ditemukan. Silakan tentukan filter terlebih dahulu.
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
        .table th { background-color: #198754 !important; color: white !important; -webkit-print-color-adjust: exact; }
    }
</style>
@endsection
