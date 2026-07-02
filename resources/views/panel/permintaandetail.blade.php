@extends('layouts.panel')

@section('content')
    <div class="container">
        <div class="page-inner">

            <div class="page-header">
                <h3 class="fw-bold">Detail Permintaan</h3>
            </div>

            <div class="card">
                <div class="card-body">

                    <table class="table table-bordered">
                        <tr>
                            <th width="200">Cabang</th>
                            <td>{{ $permintaan->cabang->nama }}</td>
                        </tr>

                        <tr>
                            <th>Pemohon</th>
                            <td>{{ $permintaan->user->name }}</td>
                        </tr>

                        <tr>
                            <th>Status</th>
                            <td>
                                @if ($permintaan->status == 'Menunggu Konfirmasi')
                                    <span class="badge bg-warning">
                                        Menunggu Konfirmasi
                                    </span>
                                @elseif($permintaan->status == 'Diterima')
                                    <span class="badge bg-success">
                                        Diterima
                                    </span>
                                @else
                                    <span class="badge bg-danger">
                                        Ditolak
                                    </span>
                                @endif
                            </td>
                        </tr>

                        <tr>
                            <th>Catatan</th>
                            <td>{{ $permintaan->catatan ?: '-' }}</td>
                        </tr>
                    </table>

                    <div class="table-responsive mt-3">
                        <table class="table table-bordered">
                            <thead class="table-primary text-center">
                                <tr>
                                    <th>No</th>
                                    <th>Barang</th>
                                    <th>Jumlah</th>
                                    <th>Satuan</th>
                                </tr>
                            </thead>

                            <tbody>
                                @foreach ($permintaan->permintaandetail as $key => $detail)
                                    <tr>
                                        <td class="text-center">{{ $key + 1 }}</td>
                                        <td>{{ $detail->barang->nama }}</td>
                                        <td class="text-center">{{ $detail->jumlah }}</td>
                                        <td class="text-center">{{ $detail->barang->satuan }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    @if (auth()->user()->role == 'Gudang' && $permintaan->status == 'Menunggu Konfirmasi')
                        <form action="{{ url('panel/permintaanupdatestatus/' . $permintaan->id) }}" method="POST">
                            @csrf
                            @method('PUT')

                            <div class="mt-3">
                                <label>Status</label>

                                <select name="status" class="form-select" required>
                                    <option value="">Pilih Status</option>
                                    <option value="Diterima">Diterima</option>
                                    <option value="Ditolak">Ditolak</option>
                                </select>
                            </div>

                            <div class="mt-3 text-end">
                                <button class="btn btn-primary">
                                    Simpan
                                </button>
                            </div>
                        </form>
                    @endif

                </div>
            </div>

        </div>
    </div>
@endsection
