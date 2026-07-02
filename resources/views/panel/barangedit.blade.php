@extends('layouts.panel')

@section('content')
    <div class="container">
        <div class="page-inner">
            <div class="page-header text-center text-md-start">
                <h3 class="fw-bold mb-3">Edit Barang</h3>
            </div>

            <div class="card mt-4">
                <div class="card-body">
                    <form action="{{ url('panel/barangupdate/' . $barang->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="mb-3">
                            <label class="fw-bold">Kode Barang</label>
                            <input type="text" name="kodebarang" class="form-control"
                                value="{{ old('kodebarang', $barang->kodebarang) }}" required>
                        </div>

                        <div class="mb-3">
                            <label class="fw-bold">Nama Barang</label>
                            <input type="text" name="nama" class="form-control"
                                value="{{ old('nama', $barang->nama) }}" required>
                        </div>

                        <div class="mb-3">
                            <label class="fw-bold">Kategori</label>
                            <select name="kategori" class="form-select" required>
                                <option value="">Pilih Kategori</option>
                                <option value="Bahan Pokok"
                                    {{ old('kategori', $barang->kategori) == 'Bahan Pokok' ? 'selected' : '' }}>Bahan Pokok
                                </option>
                                <option value="Daging"
                                    {{ old('kategori', $barang->kategori) == 'Daging' ? 'selected' : '' }}>Daging</option>
                                <option value="Sayuran"
                                    {{ old('kategori', $barang->kategori) == 'Sayuran' ? 'selected' : '' }}>Sayuran</option>
                                <option value="Bumbu"
                                    {{ old('kategori', $barang->kategori) == 'Bumbu' ? 'selected' : '' }}>Bumbu</option>
                                <option value="Minuman"
                                    {{ old('kategori', $barang->kategori) == 'Minuman' ? 'selected' : '' }}>Minuman</option>
                                <option value="Peralatan"
                                    {{ old('kategori', $barang->kategori) == 'Peralatan' ? 'selected' : '' }}>Peralatan
                                </option>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label class="fw-bold">Satuan</label>
                            <select name="satuan" class="form-select" required>
                                <option value="">Pilih Satuan</option>
                                <option value="Kg" {{ old('satuan', $barang->satuan) == 'Kg' ? 'selected' : '' }}>Kg
                                </option>
                                <option value="Gram" {{ old('satuan', $barang->satuan) == 'Gram' ? 'selected' : '' }}>
                                    Gram
                                </option>
                                <option value="Liter" {{ old('satuan', $barang->satuan) == 'Liter' ? 'selected' : '' }}>
                                    Liter</option>
                                <option value="Ml" {{ old('satuan', $barang->satuan) == 'Ml' ? 'selected' : '' }}>Ml
                                </option>
                                <option value="Pcs" {{ old('satuan', $barang->satuan) == 'Pcs' ? 'selected' : '' }}>Pcs
                                </option>
                                <option value="Pack" {{ old('satuan', $barang->satuan) == 'Pack' ? 'selected' : '' }}>
                                    Pack
                                </option>
                                <option value="Box" {{ old('satuan', $barang->satuan) == 'Box' ? 'selected' : '' }}>Box
                                </option>
                                <option value="Karung" {{ old('satuan', $barang->satuan) == 'Karung' ? 'selected' : '' }}>
                                    Karung</option>
                            </select>
                        </div>

                        <div class="d-flex justify-content-between mt-4">
                            <a href="{{ url('panel/barang') }}" class="btn btn-danger">Kembali</a>
                            <button type="submit" class="btn btn-primary">Update</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
