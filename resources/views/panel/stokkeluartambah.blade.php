@extends('layouts.panel')

@section('content')
    <div class="container">
        <div class="page-inner">

            <div class="page-header">
                <h3 class="fw-bold">Tambah Stok Keluar</h3>
            </div>

            <div class="card">
                <div class="card-body">

                    <form action="{{ url('panel/stokkeluarsimpan') }}" method="POST">
                        @csrf

                        <div class="table-responsive">
                            <table class="table table-bordered" id="tableBarang">
                                <thead class="table-primary text-center">
                                    <tr>
                                        <th>Nama Barang</th>
                                        <th width="150">Stok</th>
                                        <th width="150">Jumlah</th>
                                        <th width="100">Aksi</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    <tr>
                                        <td>
                                            <select name="stokcabang_id[]" class="form-select" required>
                                                <option value="">-- Pilih Barang --</option>
                                                @foreach ($stokcabang as $item)
                                                    <option value="{{ $item->id }}" data-stok="{{ $item->jumlah }}">
                                                        {{ $item->barang->nama }}
                                                        ({{ $item->barang->satuan }})
                                                    </option>
                                                @endforeach
                                            </select>
                                        </td>

                                        <td>
                                            <input type="text" class="form-control stok" readonly>
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
                            <a href="{{ url('panel/stokkeluar') }}" class="btn btn-secondary">
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
        $(function() {

            $(document).on('change', 'select[name="stokcabang_id[]"]', function() {
                let stok = $(this).find(':selected').data('stok') || 0;
                $(this).closest('tr').find('.stok').val(stok);
            });

            $('.btnTambah').click(function() {

                let html = `
        <tr>
            <td>
                <select name="stokcabang_id[]" class="form-select" required>
                    <option value="">-- Pilih Barang --</option>

                    @foreach ($stokcabang as $item)
                        <option value="{{ $item->id }}"
                            data-stok="{{ $item->jumlah }}">
                            {{ $item->barang->nama }}
                            ({{ $item->barang->satuan }})
                        </option>
                    @endforeach
                </select>
            </td>

            <td>
                <input type="text" class="form-control stok" readonly>
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
