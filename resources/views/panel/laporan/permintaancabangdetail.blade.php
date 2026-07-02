@extends('layouts.panel')

@section('content')
<div class="container-fluid mt-4">
    <div class="row page-titles px-3 mb-3">
        <div class="col-sm-6">
            <h3 class="fw-bold m-0">Detail Permintaan Barang Cabang</h3>
        </div>
        <div class="col-sm-6 text-end">
            <a href="{{ route('permintaancabang.index') }}" class="btn btn-secondary btn-sm">
                <i class="fas fa-arrow-left"></i> Kembali ke Daftar
            </a>
        </div>
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show mb-3" role="alert">
            {{ session('success') }}
        </div>
    @endif
    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show mb-3" role="alert">
            {{ session('error') }}
        </div>
    @endif

    <div class="row">
        <div class="col-md-4">
            <div class="card shadow-sm">
                <div class="card-header bg-primary text-white py-3">
                    <h5 class="card-title m-0 text-white fw-bold">Informasi Transaksi</h5>
                </div>
                <div class="card-body p-0">
                    <table class="table table-striped m-0">
                        <tr>
                            <th width="40%" class="ps-3">Nama Cabang</th>
                            <td>: {{ $permintaan->cabang->nama ?? '-' }}</td>
                        </tr>
                        <tr>
                            <th class="ps-3">Peminta (User)</th>
                            <td>: {{ $permintaan->user->name ?? '-' }}</td>
                        </tr>
                        <tr>
                            <th class="ps-3">Tanggal Input</th>
                            <td>: {{ $permintaan->created_at->format('d-m-Y H:i') }} WIB</td>
                        </tr>
                        <tr>
                            <th class="ps-3">Catatan Cabang</th>
                            <td>: {{ $permintaan->catatan ?? '-' }}</td>
                        </tr>
                        <tr>
                            <th class="ps-3">Status Saat Ini</th>
                            <td>:
                                @if($permintaan->status == 'Menunggu Konfirmasi')
                                    <span class="badge bg-warning text-dark fw-bold">Menunggu Konfirmasi</span>
                                @elseif($permintaan->status == 'Diterima')
                                    <span class="badge bg-success fw-bold">Diterima</span>
                                @else
                                    <span class="badge bg-danger fw-bold">Ditolak</span>
                                @endif
                            </td>
                        </tr>
                    </table>
                </div>

                {{-- Aksi Validasi Admin (Hanya muncul jika status masih Menunggu Konfirmasi) --}}
                @if($permintaan->status == 'Menunggu Konfirmasi')
                    <div class="card-footer bg-light d-flex justify-content-end gap-2 py-3">
                        <form action="{{ route('permintaancabang.updatestatus', $permintaan->id) }}" method="POST">
                            @csrf
                            <input type="hidden" name="status" value="Ditolak">
                            <button type="submit" class="btn btn-danger" onclick="return confirm('Apakah Anda yakin ingin MENOLAK permintaan ini?')">
                                <i class="fas fa-times"></i> Tolak Permintaan
                            </button>
                        </form>

                        <form action="{{ route('permintaancabang.updatestatus', $permintaan->id) }}" method="POST">
                            @csrf
                            <input type="hidden" name="status" value="Diterima">
                            <button type="submit" class="btn btn-success" onclick="return confirm('Apakah Anda yakin ingin MENERIMA permintaan ini dan memotong stok gudang?')">
                                <i class="fas fa-check"></i> Terima & Proses
                            </button>
                        </form>
                    </div>
                @endif
            </div>
        </div>

        <div class="col-md-8">
            <div class="card shadow-sm">
                <div class="card-header bg-dark text-white py-3">
                    <h5 class="card-title m-0 text-white fw-bold">Daftar Item Barang</h5>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped align-middle m-0">
                            <thead class="table-secondary text-center">
                                <tr>
                                    <th width="8%">No</th>
                                    <th>Nama Barang</th>
                                    <th width="20%">Kode Barang</th>
                                    <th width="20%">Jumlah (Qty)</th>
                                    <th width="15%">Satuan</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($permintaan->permintaandetail as $key => $detail)
                                    <tr>
                                        <td class="text-center">{{ $key + 1 }}</td>
                                        <td><strong>{{ $detail->barang->nama ?? '-' }}</strong></td>
                                        <td class="text-center">{{ $detail->barang->kodebarang ?? '-' }}</td>
                                        <td class="text-center fw-bold text-primary">{{ $detail->jumlah }}</td>
                                        <td class="text-center"><span class="badge bg-secondary">{{ $detail->barang->satuan ?? '-' }}</span></td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="text-center text-muted">Tidak ada item barang dalam permintaan ini.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
