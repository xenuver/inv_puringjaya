@extends('layouts.panel')

@section('content')
    <div class="container">
        <div class="page-inner">

            <div class="page-header d-flex flex-wrap justify-content-between align-items-center gap-2">
                <div class="flex-grow-1">
                    <h3 class="fw-bold mb-2 mb-md-0">Stok Cabang</h3>
                </div>
            </div>

            <div class="card mt-4">
                <div class="card-body">

                    {{-- Form Filter untuk Admin --}}
                    @if (auth()->user()->role == 'Admin')
                        <form action="{{ url('panel/stokcabang') }}" method="GET" class="mb-4">
                            <div class="row">
                                <div class="col-md-4">
                                    <label class="form-label">Pilih Cabang</label>
                                    <select name="cabang_id" class="form-select" required>
                                        <option value="">-- Pilih Cabang --</option>
                                        @foreach ($cabang as $item)
                                            <option value="{{ $item->id }}"
                                                {{ request('cabang_id') == $item->id ? 'selected' : '' }}>
                                                {{ $item->nama }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="col-md-2 d-flex align-items-end">
                                    <button type="submit" class="btn btn-primary">
                                        <i class="fa fa-search"></i> Tampilkan
                                    </button>
                                </div>
                            </div>
                        </form>
                    @endif

                    {{-- Tampilan Tabel Data Stok --}}
                    @if (auth()->user()->role != 'Admin' || request()->filled('cabang_id'))
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped align-middle w-100" id="datatable" style="color: #000;">
                                <thead class="table-primary text-center">
                                    <tr>
                                        <th style="width: 50px;">No</th>
                                        @if (auth()->user()->role == 'Admin')
                                            <th>Cabang</th>
                                        @endif
                                        <th>Kode Barang</th>
                                        <th>Nama Barang</th>
                                        <th>Kategori</th>
                                        <th>Satuan</th>
                                        <th>Jumlah</th>
                                        @if (auth()->user()->role == 'Kasir')
                                            <th style="width: 150px;">Aksi</th>
                                        @endif
                                    </tr>
                                </thead>

                                <tbody>
                                    @foreach ($stokcabang as $key => $value)
                                        <tr>
                                            <td class="text-center">{{ $key + 1 }}</td>

                                            @if (auth()->user()->role == 'Admin')
                                                <td>{{ $value->cabang->nama ?? '-' }}</td>
                                            @endif

                                            <td class="text-center">{{ $value->barang->kodebarang ?? '-' }}</td>
                                            <td>{{ $value->barang->nama ?? '-' }}</td>
                                            <td>{{ $value->barang->kategori ?? '-' }}</td>
                                            <td class="text-center">
                                                <span class="badge bg-secondary text-white">{{ $value->barang->satuan ?? '-' }}</span>
                                            </td>
                                            <td class="text-center fw-bold">{{ $value->jumlah }}</td>

                                            {{-- Tombol Aksi khusus Kasir --}}
                                            @if (auth()->user()->role == 'Kasir')
                                                <td class="text-center">
                                                    @if ($value->jumlah > 0)
                                                        <button type="button" class="btn btn-danger btn-sm shadow-sm"
                                                            data-bs-toggle="modal"
                                                            data-bs-target="#modalKeluar{{ $value->id }}">
                                                            <i class="fas fa-minus-circle me-1"></i> Kurangi Stok
                                                        </button>
                                                    @else
                                                        <button type="button" class="btn btn-secondary btn-sm" disabled>
                                                            <i class="fas fa-ban me-1"></i> Habis
                                                        </button>
                                                    @endif
                                                </td>
                                            @endif
                                        </tr>

                                        {{-- Modal Kurangi Stok (Hanya dimuat jika pengguna adalah Kasir dan stok ada) --}}
                                        @if (auth()->user()->role == 'Kasir' && $value->jumlah > 0)
                                            <div class="modal fade" id="modalKeluar{{ $value->id }}" tabindex="-1" aria-labelledby="modalKeluarLabel{{ $value->id }}" aria-hidden="true" style="color: #000;">
                                                <div class="modal-dialog modal-dialog-centered">
                                                    <div class="modal-content">
                                                        <div class="modal-header bg-danger text-white">
                                                            <h5 class="modal-title" id="modalKeluarLabel{{ $value->id }}">
                                                                <i class="fas fa-minus-circle me-2"></i>Pengeluaran Barang
                                                            </h5>
                                                            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <form action="{{ route('stokcabang.keluar') }}" method="POST">
                                                            @csrf
                                                            <input type="hidden" name="stokcabang_id" value="{{ $value->id }}">

                                                            <div class="modal-body text-start">
                                                                <div class="form-group mb-3">
                                                                    <label class="form-label text-dark fw-bold mb-1">Nama Barang</label>
                                                                    <input type="text" class="form-control" value="{{ $value->barang->nama }}" readonly style="background-color: #e9ecef;">
                                                                </div>

                                                                <div class="form-group mb-3">
                                                                    <label class="form-label text-dark fw-bold mb-1">Stok Saat Ini</label>
                                                                    <div class="input-group">
                                                                        <input type="text" class="form-control fw-bold" value="{{ $value->jumlah }}" readonly style="background-color: #e9ecef;">
                                                                        <span class="input-group-text fw-bold">{{ $value->barang->satuan }}</span>
                                                                    </div>
                                                                </div>

                                                                <div class="form-group mb-3">
                                                                    <label class="form-label text-dark fw-bold mb-1">Jumlah Keluar <span class="text-danger">*</span></label>
                                                                    <div class="input-group">
                                                                        <input type="number" name="jumlah" class="form-control" min="1" max="{{ $value->jumlah }}" required placeholder="Masukkan jumlah barang...">
                                                                        <span class="input-group-text fw-bold">{{ $value->barang->satuan }}</span>
                                                                    </div>
                                                                    <small class="text-muted d-block mt-1">Maksimal jumlah pengeluaran adalah {{ $value->jumlah }}.</small>
                                                                </div>

                                                                <div class="form-group mb-0">
                                                                    <label class="form-label text-dark fw-bold mb-1">Keterangan / Alasan <span class="text-danger">*</span></label>
                                                                    <textarea name="catatan" class="form-control" rows="3" required placeholder="Contoh: Terjual eceran, barang rusak/cacat, expired..."></textarea>
                                                                </div>
                                                            </div>

                                                            <div class="modal-footer" style="background-color: #f8f9fa;">
                                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                                                <button type="submit" class="btn btn-danger">Simpan Pengeluaran</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        @endif

                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @elseif(auth()->user()->role == 'Admin')
                        <div class="alert alert-info mb-0">
                            Silakan pilih cabang terlebih dahulu untuk melihat data stok cabang.
                        </div>
                    @endif

                </div>
            </div>

        </div>
    </div>
@endsection
