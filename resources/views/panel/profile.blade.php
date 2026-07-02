@extends('layouts.panel')

@section('content')
    <div class="container">
        <div class="page-inner">

            {{-- HEADER --}}
            <div class="page-header d-flex justify-content-between align-items-center">
                <h3 class="fw-bold">Edit Profile</h3>

                <a href="{{ url('panel') }}" class="btn btn-secondary">
                    <i class="fa fa-arrow-left me-1"></i> Kembali
                </a>
            </div>

            {{-- FORM EDIT PROFILE --}}
            <div class="card mt-3">
                <div class="card-body">

                    <form action="{{ url('panel/profileupdate') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="row g-3">

                            {{-- NAMA --}}
                            <div class="col-md-6">
                                <label class="form-label">Nama Lengkap</label>
                                <input type="text" name="name" class="form-control" value="{{ $profile->name }}"
                                    required>
                            </div>

                            {{-- EMAIL --}}
                            <div class="col-md-6">
                                <label class="form-label">Email</label>
                                <input type="email" name="email" class="form-control" value="{{ $profile->email }}"
                                    required>
                            </div>

                            {{-- PASSWORD --}}
                            <div class="col-md-6">
                                <label class="form-label">Password Baru (Opsional)</label>
                                <input type="password" name="password" class="form-control"
                                    placeholder="Kosongkan jika tidak ingin mengubah password">
                            </div>

                        </div>

                        <div class="mt-4">
                            <button type="submit" class="btn btn-primary">
                                <i class="fa fa-save me-1"></i> Simpan Perubahan
                            </button>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>
@endsection
