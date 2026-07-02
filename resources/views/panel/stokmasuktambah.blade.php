@extends('layouts.panel')

@section('content')
    <div class="container">
        <div class="page-inner">

            <div class="page-header">
                <h3 class="fw-bold">Tambah Stok Masuk</h3>
            </div>

            <div class="card">
                <div class="card-body">

                    <form action="{{ url('panel/stokmasuksimpan') }}" method="POST">
                        @csrf

                        <div class="table-responsive">
                            <table class="table table-bordered" id="tableBarang">
                                <thead class="table-primary text-center">
                                    <tr>
                                        <th width="60%">Nama Barang</th>
                                        <th width="25%">Jumlah</th>
                                        <th width="15%">Aksi</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    <tr>
                                        <td>
                                            <select name="stokgudang_id[]" class="form-select" required>
                                                <option value="">-- Pilih Barang --</option>
                                                @foreach ($stokgudang as $item)
                                                    <option value="{{ $item->id }}">
                                                        {{ $item->barang->nama }}
                                                        ({{ $item->barang->satuan }})
                                                    </option>
                                                @endforeach
                                            </select>
                                        </td>

                                        <td>
                                            <input type="number" name="jumlah[]" class="form-control" min="1"
                                                required>
                                        </td>

                                        <td class="text-center">
                                            <button type="button" class="btn btn-success btnTambah">
                                                <i class="fa fa-plus"></i>
                                            </button>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                        <div class="text-end">
                            <a href="{{ url('panel/stokmasuk') }}" class="btn btn-secondary">
                                Kembali
                            </a>

                            <button type="submit" class="btn btn-primary">
                                Simpan
                            </button>
                        </div>

                    </form>

                </div>
            </div>

        </div>
    </div>
@endsection
@section('script')
    <script>
        $(document).ready(function() {

            $('.btnTambah').click(function() {

                let html = `
        <tr>
            <td>
                <select name="stokgudang_id[]" class="form-select" required>
                    <option value="">-- Pilih Barang --</option>

                    @foreach ($stokgudang as $item)
                        <option value="{{ $item->id }}">
                            {{ $item->barang->nama }}
                            ({{ $item->barang->satuan }})
                        </option>
                    @endforeach

                </select>
            </td>

            <td>
                <input type="number"
                    name="jumlah[]"
                    class="form-control"
                    min="1"
                    required>
            </td>

            <td class="text-center">
                <button type="button" class="btn btn-danger btnHapus">
                    <i class="fa fa-minus"></i>
                </button>
            </td>
        </tr>
        `;

                $('#tableBarang tbody').append(html);
            });

            $(document).on('click', '.btnHapus', function() {
                $(this).closest('tr').remove();
            });

        });
    </script>
@endsection
