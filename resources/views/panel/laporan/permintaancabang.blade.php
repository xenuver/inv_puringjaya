@extends('layouts.panel')

@section('content')
<div class="container-fluid mt-4">
    <div class="row page-titles text-mute capitalize-text px-3">
        <div class="col-sm-6 font-weight-bold">
            <h3 class="fw-bold m-0">Permintaan Barang Cabang</h3>
        </div>
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show mt-3" role="alert">
            {{ session('success') }}
        </div>
    @endif
    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show mt-3" role="alert">
            {{ session('error') }}
        </div>
    @endif

    <div class="card shadow-sm mt-4">
        <div class="card-header py-3">
            <div class="d-flex align-items-center justify-content-between mb-3">
                <h6 class="m-0 font-weight-bold text-primary">Daftar Permintaan Masuk</h6>
            </div>

            <form action="{{ route('permintaancabang.index') }}" method="GET">

                {{-- BARIS 1: Filter Cabang, Status, Tanggal --}}
                <div class="row g-2 align-items-end mb-2">

                    {{-- Filter Cabang --}}
                    <div class="col-md-3 col-sm-6">
                        <label class="form-label small text-muted mb-1">Cabang</label>
                        <select name="cabang_id" class="form-control form-control-sm">
                            <option value="">-- Semua Cabang --</option>
                            @foreach($cabang as $cbg)
                                <option value="{{ $cbg->id }}" {{ request('cabang_id') == $cbg->id ? 'selected' : '' }}>
                                    {{ $cbg->nama }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    {{-- Filter Status --}}
                    <div class="col-md-2 col-sm-6">
                        <label class="form-label small text-muted mb-1">Status</label>
                        <select name="status" class="form-control form-control-sm">
                            <option value="">-- Semua Status --</option>
                            <option value="Menunggu Konfirmasi" {{ request('status') == 'Menunggu Konfirmasi' ? 'selected' : '' }}>Menunggu Konfirmasi</option>
                            <option value="Diterima" {{ request('status') == 'Diterima' ? 'selected' : '' }}>Diterima</option>
                            <option value="Ditolak" {{ request('status') == 'Ditolak' ? 'selected' : '' }}>Ditolak</option>
                        </select>
                    </div>

                    {{-- Filter Tanggal Mulai --}}
                    <div class="col-md-2 col-sm-6">
                        <label class="form-label small text-muted mb-1">Dari Tanggal</label>
                        <input type="date" name="tanggal_mulai" class="form-control form-control-sm"
                            value="{{ request('tanggal_mulai') }}">
                    </div>

                    {{-- Filter Tanggal Akhir --}}
                    <div class="col-md-2 col-sm-6">
                        <label class="form-label small text-muted mb-1">Sampai Tanggal</label>
                        <input type="date" name="tanggal_akhir" class="form-control form-control-sm"
                            value="{{ request('tanggal_akhir') }}">
                    </div>

                    {{-- Tombol Aksi --}}
                    <div class="col-md-3 col-sm-12 d-flex gap-2 align-items-end">
                        <button type="submit" class="btn btn-primary btn-sm px-3">
                            <i class="fas fa-filter"></i> Filter
                        </button>
                        <a href="{{ route('permintaancabang.index') }}" class="btn btn-secondary btn-sm px-3">
                            <i class="fas fa-undo"></i> Reset
                        </a>
                        <a href="{{ route('laporan.permintaancabang.pdf', request()->query()) }}" class="btn btn-danger btn-sm px-3" target="_blank">
                            <i class="fas fa-file-pdf"></i> Cetak PDF
                        </a>
                    </div>

                </div>
            </form>
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-striped align-middle" id="datatable" width="100%" cellspacing="0">
                    <thead style="background-color: #2c3e50; color: #ffffff;" class="text-center">
                        <tr>
                            <th width="5%">No</th>
                            <th width="15%">Tanggal</th>
                            <th width="15%">Cabang</th>
                            <th width="15%">Peminta</th>
                            <th width="25%">Detail Barang</th>
                            <th width="10%">Catatan</th>
                            <th width="10%">Status</th>
                            <th width="10%">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($permintaan as $key => $row)
                        <tr>
                            <td class="text-center">{{ $key + 1 }}</td>
                            <td class="text-center">{{ $row->created_at->format('d-m-Y H:i') }} WIB</td>
                            <td>{{ $row->cabang->nama ?? '-' }}</td>
                            <td>{{ $row->user->name ?? '-' }}</td>
                            <td>
                                <ul class="mb-0 ps-3">
                                    @foreach ($row->permintaandetail as $detail)
                                        <li>
                                            <strong>{{ $detail->barang->nama ?? '-' }}</strong>
                                            <span class="text-muted">({{ $detail->jumlah }} {{ $detail->barang->satuan ?? '' }})</span>
                                        </li>
                                    @endforeach
                                </ul>
                            </td>
                            <td>{{ $row->catatan ?? '-' }}</td>
                            <td class="text-center">
                                @if($row->status == 'Menunggu Konfirmasi')
                                    <span class="badge bg-warning text-dark px-2 py-1">Menunggu Konfirmasi</span>
                                @elseif($row->status == 'Diterima')
                                    <span class="badge bg-success px-2 py-1">Diterima</span>
                                @else
                                    <span class="badge bg-danger px-2 py-1">Ditolak</span>
                                @endif
                            </td>
                            <td class="text-center">
                                <a href="{{ route('permintaancabang.detail', $row->id) }}" class="btn btn-info btn-sm text-white text-nowrap">
                                    <i class="fas fa-eye"></i> Detail / Proses
                                </a>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="8" class="text-center">Belum ada data permintaan dari cabang.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
