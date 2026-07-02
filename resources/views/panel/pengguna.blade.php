@extends('layouts.panel')

@section('content')
    <div class="container">
        <div class="page-inner">
            <div class="page-header d-flex flex-wrap justify-content-between align-items-center gap-2">
                <div class="flex-grow-1">
                    <h3 class="fw-bold mb-2 mb-md-0">Pengguna</h3>
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
                                    <th>Nama</th>
                                    <th>Email</th>
                                    <th>Role</th>
                                    <th>Cabang</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($pengguna as $key => $value)
                                    <tr>
                                        <td class="text-center">{{ $key + 1 }}</td>
                                        <td>{{ $value->name }}</td>
                                        <td>{{ $value->email }}</td>
                                        <td class="text-center">{{ $value->role }}</td>
                                        <td class="text-center">{{ $value->cabang->nama ?? '-' }}</td>
                                        <td class="text-center">
                                            <a href="{{ url('panel/penggunaedit/' . $value->id) }}"
                                                class="btn btn-sm btn-warning">
                                                <i class="fa fa-edit"></i>
                                            </a>
                                            <form action="{{ url('panel/penggunahapus/' . $value->id) }}" method="POST"
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
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title" id="modalTambahLabel">Tambah Pengguna</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ url('panel/penggunasimpan') }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="fw-bold">Nama</label>
                                    <input type="text" name="name" class="form-control" required
                                        placeholder="Nama Lengkap">
                                </div>
                                <div class="mb-3">
                                    <label class="fw-bold">Email</label>
                                    <input type="email" name="email" class="form-control" required placeholder="Email">
                                </div>
                                <div class="mb-3">
                                    <label class="fw-bold">Password</label>
                                    <input type="password" name="password" class="form-control" required
                                        placeholder="Password">
                                </div>
                                <div class="mb-3">
                                    <label class="fw-bold">Konfirmasi Password</label>
                                    <input type="password" name="password_confirmation" class="form-control" required
                                        placeholder="Konfirmasi Password">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="fw-bold">Role</label>
                                    <select name="role" id="role_tambah" class="form-control" required>
                                        <option value="">-- Pilih Role --</option>
                                        <option value="Kasir">Kasir</option>
                                        <option value="Gudang">Gudang</option>
                                    </select>
                                </div>
                                <div class="mb-3" id="div_cabang_tambah" style="display: none;">
                                    <label class="fw-bold">Cabang</label>
                                    <select name="cabang_id" class="form-control">
                                        <option value="">-- Pilih Cabang --</option>
                                        @foreach ($cabang as $c)
                                            <option value="{{ $c->id }}">{{ $c->nama }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
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

    <script>
        document.getElementById('role_tambah').addEventListener('change', function() {
            var role = this.value;
            var divCabang = document.getElementById('div_cabang_tambah');
            if (role == 'Kasir') {
                divCabang.style.display = 'block';
            } else {
                divCabang.style.display = 'none';
            }
        });
    </script>
@endsection
