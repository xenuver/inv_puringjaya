@extends('layouts.panel')

@section('content')
    <div class="container">
        <div class="page-inner">
            <div class="page-header">
                <h3 class="fw-bold mb-3">Edit Pengguna</h3>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <form action="{{ url('panel/penggunaupdate/' . $pengguna->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Nama</label>
                                            <input type="text" name="name" class="form-control"
                                                value="{{ old('name', $pengguna->name) }}" required>
                                        </div>
                                        <div class="form-group">
                                            <label>Email</label>
                                            <input type="email" name="email" class="form-control"
                                                value="{{ old('email', $pengguna->email) }}" required>
                                        </div>
                                        <div class="form-group">
                                            <label>Password (Kosongkan jika tidak mengganti)</label>
                                            <input type="password" name="password" class="form-control">
                                            @error('password')
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label>Konfirmasi Password</label>
                                            <input type="password" name="password_confirmation" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Role</label>
                                            <select name="role" id="role" class="form-control" required>
                                                <option value="">-- Pilih Role --</option>
                                                <option value="Kasir"
                                                    {{ old('role', $pengguna->role) == 'Kasir' ? 'selected' : '' }}>Kasir
                                                </option>
                                                <option value="Gudang"
                                                    {{ old('role', $pengguna->role) == 'Gudang' ? 'selected' : '' }}>Gudang
                                                </option>
                                            </select>
                                        </div>
                                        <div class="form-group" id="div_cabang"
                                            style="{{ old('role', $pengguna->role) == 'Kasir' ? '' : 'display: none;' }}">
                                            <label>Cabang</label>
                                            <select name="cabang_id" class="form-control">
                                                <option value="">-- Pilih Cabang --</option>
                                                @foreach ($cabang as $c)
                                                    <option value="{{ $c->id }}"
                                                        {{ old('cabang_id', $pengguna->cabang_id) == $c->id ? 'selected' : '' }}>
                                                        {{ $c->nama }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-action">
                                <button type="submit" class="btn btn-success">Update</button>
                                <a href="{{ url('panel/pengguna') }}" class="btn btn-danger">Batal</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.getElementById('role').addEventListener('change', function() {
            var role = this.value;
            var divCabang = document.getElementById('div_cabang');
            if (role == 'Kasir') {
                divCabang.style.display = 'block';
            } else {
                divCabang.style.display = 'none';
            }
        });
    </script>
@endsection
