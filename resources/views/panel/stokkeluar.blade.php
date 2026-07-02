@extends('layouts.panel')

@section('content')
    <div class="container">
        <div class="page-inner">

            <div class="page-header d-flex flex-wrap justify-content-between align-items-center gap-2">
                <div>
                    <h3 class="fw-bold">Stok Keluar</h3>
                </div>

                <div>
                    <a href="{{ url('panel/stokkeluartambah') }}" class="btn btn-primary">
                        <i class="fa fa-plus"></i> Tambah Stok Keluar
                    </a>
                </div>
            </div>

            <div class="card mt-4">
                <div class="card-body">

                    <div class="table-responsive">
                        <table class="table table-bordered table-striped" id="datatable">
                            <thead class="table-primary text-center">
                                <tr>
                                    <th>No</th>
                                    <th>Kode Keluar</th>
                                    <th>Tanggal</th>
                                    <th>Detail Barang</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>

                            <tbody>
                                @foreach ($stokkeluar as $key => $value)
                                    <tr>
                                        <td class="text-center">{{ $key + 1 }}</td>

                                        <td class="text-center">
                                            {{ $value->kodekeluar }}
                                        </td>

                                        <td class="text-center">
                                            {{ $value->created_at->format('d-m-Y H:i') }}
                                        </td>

                                        <td>
                                            <ul class="mb-0 ps-3">
                                                @foreach ($value->stokkeluardetail as $detail)
                                                    <li>
                                                        <strong>{{ $detail->stokcabang->barang->nama ?? '-' }}</strong>
                                                        ({{ $detail->jumlah }}
                                                        {{ $detail->stokcabang->barang->satuan ?? '' }})
                                                    </li>
                                                @endforeach
                                            </ul>
                                        </td>

                                        <td class="text-center">
                                            {{-- pakai form method delete --}}
                                            <form action="{{ url('panel/stokkeluarhapus/' . $value->id) }}" method="POST"
                                                style="display:inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger"
                                                    onclick="return confirm('Hapus data ini?')">
                                                    <i class="fa fa-trash"></i> Hapus
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
@endsection
