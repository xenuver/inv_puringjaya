@extends('layouts.panel')

@section('content')
    <div class="container">
        <div class="page-inner">
            <div class="page-header d-flex flex-wrap justify-content-between align-items-center gap-2">
                <div class="flex-grow-1">
                    <h3 class="fw-bold mb-2 mb-md-0">Stok Gudang</h3>
                </div>
            </div>

            {{-- Alert Notifikasi Sukses / Gagal --}}
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show mt-3" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            @if(session('error'))
                <div class="alert alert-danger alert-dismissible fade show mt-3" role="alert">
                    {{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <div class="card mt-4">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped align-middle w-100" id="datatable">
                            <thead class="table-primary text-center">
                                <tr>
                                    <th>No</th>
                                    <th>Kode Barang</th>
                                    <th>Nama Barang</th>
                                    <th>Kategori</th>
                                    <th>Satuan</th>
                                    <th>Jumlah</th>
                                    <th style="text-align: center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($stokgudang as $key => $value)
                                    <tr>
                                        <td class="text-center">{{ $key + 1 }}</td>
                                        <td class="text-center">{{ $value->barang->kodebarang }}</td>
                                        <td>{{ $value->barang->nama }}</td>
                                        <td>{{ $value->barang->kategori }}</td>
                                        <td class="text-center">{{ $value->barang->satuan }}</td>
                                        <td class="text-center fw-bold">{{ $value->jumlah }}</td>
                                        <td class="text-center">
                                            <button type="button"
                                                    class="btn btn-danger btn-sm px-3 btn-keluar-stok"
                                                    data-bs-toggle="modal"
                                                    data-bs-target="#modalStokKeluar"
                                                    data-id="{{ $value->id }}"
                                                    data-nama="{{ $value->barang->nama }}"
                                                    data-maksimal="{{ $value->jumlah }}"
                                                    data-catatan="{{ $value->catatan }}">
                                                <i class="fa fa-sign-out-alt me-1"></i> Keluar
                                            </button>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- MODAL INPUT STOK KELUAR --}}
    <div class="modal fade" id="modalStokKeluar" tabindex="-1" aria-labelledby="modalStokKeluarLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <form action="{{ route('stokgudang.keluar') }}" method="POST">
                    @csrf
                    <div class="modal-header bg-danger text-white">
                        <h5 class="modal-title" id="modalStokKeluarLabel">
                            <i class="fa fa-box-open me-2"></i> Form Pengeluaran Stok Gudang
                        </h5>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" name="stokgudang_id" id="modal_stokgudang_id">

                        <div class="mb-3">
                            <label class="form-label fw-bold">Nama Barang</label>
                            <input type="text" id="modal_nama_barang" class="form-control bg-light" readonly>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-bold">Jumlah Keluar</label>
                            <div class="input-group">
                                <input type="number" name="jumlah" id="modal_jumlah" class="form-control" min="1" placeholder="Masukkan Qty" required>
                                <span class="input-group-text bg-light text-muted" id="label_maksimal"></span>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-bold">Catatan / Keperluan Keluar</label>
                            <textarea name="catatan" id="modal_catatan" class="form-control" rows="3" placeholder="Contoh: Barang Rusak, Pemakaian Internal Gudang, dll." required></textarea>
                        </div>

                        <div class="alert alert-warning border-start border-warning border-3 mb-0" role="alert">
                            <i class="fa fa-exclamation-triangle me-2"></i> Apakah Anda yakin ingin mengeluarkan stok barang ini? Data akan langsung mengurangi stok gudang pusat dan tercatat di laporan.
                        </div>
                    </div>
                    <div class="modal-footer bg-light">
                        <button type="button" class="btn btn-secondary px-4" data-bs-dismiss="modal">Tidak</button>
                        <button type="submit" class="btn btn-danger px-4">Ya, Keluarkan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    {{-- SCRIPT PENGHUBUNG DATA KE MODAL --}}
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const tombolKeluar = document.querySelectorAll('.btn-keluar-stok');

            tombolKeluar.forEach(button => {
                button.addEventListener('click', function () {
                    const id = this.getAttribute('data-id');
                    const nama = this.getAttribute('data-nama');
                    const maksimal = this.getAttribute('data-maksimal');
                    const catatan = this.getAttribute('data-catatan');

                    // Set nilai ke dalam elemen form modal
                    document.getElementById('modal_stokgudang_id').value = id;
                    document.getElementById('modal_nama_barang').value = nama;

                    const inputJumlah = document.getElementById('modal_jumlah');
                    inputJumlah.setAttribute('max', maksimal);
                    inputJumlah.value = ''; // Reset nilai input qty sebelumnya

                    // Mengisi field catatan di modal (opsional, jika ingin mengosongkannya setiap buka modal, ganti dengan '')
                    document.getElementById('modal_catatan').value = '';

                    document.getElementById('label_maksimal').innerText = 'Maks: ' + maksimal;
                });
            });
        });
    </script>
@endsection
