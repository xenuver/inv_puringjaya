@extends('layouts.panel')

@section('content')
    <div class="container">
        <div class="page-inner">

            {{-- HEADER --}}
            <div class="page-header d-flex flex-wrap justify-content-between align-items-center gap-2">
                <div class="grow">
                    <h3 class="fw-bold mb-2 mb-md-0 text-center text-md-start">
                        Cabang
                    </h3>
                </div>

                <div class="d-flex flex-wrap justify-content-center justify-content-md-end gap-2">
                    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalTambahData">
                        <i class="fa fa-plus me-1"></i> Tambah Data
                    </button>
                </div>
            </div>

            {{-- TABLE --}}
            <div class="card mt-4">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped align-middle w-100" id="datatable">
                            <thead class="table-primary text-center">
                                <tr>
                                    <th>No</th>
                                    <th>Nama</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>

                            <tbody>
                                @foreach ($cabang as $key => $value)
                                    <tr>
                                        <td class="text-center">{{ $key + 1 }}</td>
                                        <td>{{ $value->nama }}</td>
                                        <td class="text-center">

                                            <a href="{{ url('panel/cabangedit/' . $value->id) }}"
                                                class="btn btn-sm btn-warning">
                                                <i class="fa fa-edit"></i>
                                            </a>

                                            <form action="{{ url('panel/cabanghapus/' . $value->id) }}" method="POST"
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

    {{-- MODAL TAMBAH CABANG --}}
    <div class="modal fade" id="modalTambahData" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">

                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title">Tambah Cabang</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <form action="{{ url('panel/cabangsimpan') }}" method="POST">
                    @csrf
                    <div class="modal-body">

                        <div class="row">

                            <div class="col-md-12 mb-3">
                                <label class="fw-bold">Nama</label>
                                <input type="text" name="nama" class="form-control" required>
                            </div>

                        </div>

                    </div>

                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">
                            Simpan
                        </button>
                    </div>

                </form>

            </div>
        </div>
    </div>
@endsection
