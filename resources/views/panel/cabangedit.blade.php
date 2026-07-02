@extends('layouts.panel')

@section('content')
    <div class="container">
        <div class="page-inner">

            <div class="page-header">
                <h3 class="fw-bold">Edit Cabang</h3>
            </div>

            <div class="card mt-4">
                <div class="card-body">

                    <form action="{{ url('panel/cabangupdate/' . $cabang->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="mb-3">
                            <label class="fw-bold">Nama</label>
                            <input type="text" name="nama" class="form-control" value="{{ $cabang->nama }}" required>
                        </div>

                        <div class="d-flex justify-content-between">
                            <a href="{{ url('panel/cabang') }}" class="btn btn-secondary">
                                Kembali
                            </a>

                            <button type="submit" class="btn btn-primary">
                                Update
                            </button>
                        </div>

                    </form>

                </div>
            </div>

        </div>
    </div>
@endsection
