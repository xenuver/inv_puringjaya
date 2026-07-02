@extends('layouts.panel')

@section('content')
    <div class="container">
        <div class="page-inner">
            <div class="page-header d-flex flex-wrap justify-content-between align-items-center gap-2">
                <div class="flex-grow-1">
                    <h3 class="fw-bold mb-2 mb-md-0">Barang</h3>
                </div>
                <div class="d-flex flex-wrap justify-content-center justify-content-md-end gap-2">
                    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalTambah">
                        <i class="fa fa-plus me-1"></i> Tambah Data
                    </button>
                </div>
            </div>

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
                                    <th style="text-align: center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($barang as $key => $value)
                                    <tr>
                                        <td class="text-center">{{ $key + 1 }}</td>
                                        <td class="text-center">{{ $value->kodebarang }}</td>
                                        <td>{{ $value->nama }}</td>
                                        <td>{{ $value->kategori }}</td>
                                        <td class="text-center">{{ $value->satuan }}</td>
                                        <td class="text-center">
                                            <a href="{{ url('panel/barangedit/' . $value->id) }}"
                                                class="btn btn-sm btn-warning">
                                                <i class="fa fa-edit"></i>
                                            </a>
                                            <form action="{{ url('panel/baranghapus/' . $value->id) }}" method="POST"
                                                class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button class="btn btn-sm btn-danger"
                                                    onclick="return confirm('Hapus data ini?')">
                                                    <i class="fa fa-trash"></i>
                                                </button>
                                            </form>
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

    {{-- Modal Tambah --}}
    <div class="modal fade" id="modalTambah" tabindex="-1" aria-labelledby="modalTambahLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title" id="modalTambahLabel">Tambah Barang</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ url('panel/barangsimpan') }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="fw-bold">Nama Barang</label>
                            <input type="text" name="nama" class="form-control" required placeholder="Nama Barang">
                        </div>
                        <div class="mb-3">
                            <label class="fw-bold">Kategori</label>
                            <select name="kategori" class="form-select" required>
                                <option value="">Pilih Kategori</option>
                                <option value="Bahan Pokok">Bahan Pokok</option>
                                <option value="Daging">Daging</option>
                                <option value="Sayuran">Sayuran</option>
                                <option value="Bumbu">Bumbu</option>
                                <option value="Minuman">Minuman</option>
                                <option value="Peralatan">Peralatan</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="fw-bold">Satuan</label>
                            <select name="satuan" class="form-select" required>
                                <option value="">Pilih Satuan</option>
                                <option value="Kg">Kg</option>
                                <option value="Gram">Gram</option>
                                <option value="Liter">Liter</option>
                                <option value="Ml">Ml</option>
                                <option value="Pcs">Pcs</option>
                                <option value="Pack">Pack</option>
                                <option value="Box">Box</option>
                                <option value="Karung">Karung</option>
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
