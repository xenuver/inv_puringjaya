@extends('layouts.panel')

@section('content')
<br>
<br>
    <div class="container mt-4">
        <div class="page-inner">

            <div class="page-header d-flex flex-wrap justify-content-between align-items-center gap-2">
                <div>
                    <h3 class="fw-bold m-0">Permintaan</h3>
                </div>
                <div>
                    @if (auth()->user()->role != 'Admin')
                        <a href="{{ url('panel/permintaantambah') }}" class="btn btn-primary">
                            <i class="fa fa-plus"></i> Tambah Permintaan
                        </a>
                    @endif
                </div>
            </div>

            <div class="card mt-4 shadow-sm">
                <div class="card-body">

                    <div class="table-responsive">
                        <table class="table table-bordered table-striped align-middle" id="datatable">
                            <thead style="background-color: #2c3e50; color: #ffffff;" class="text-center">
                                <tr>
                                    <th width="5%">No</th>
                                    <th width="15%">Cabang</th>
                                    <th width="20%">Tanggal</th>
                                    <th width="30%">Detail Barang</th>
                                    <th width="15%">Status</th>
                                    <th width="15%">Aksi</th>
                                </tr>
                            </thead>

                            <tbody>
                                @foreach ($permintaan as $key => $value)
                                    <tr>
                                        <td class="text-center">{{ $key + 1 }}</td>

                                        <td>
                                            {{ $value->cabang->nama ?? '-' }}
                                        </td>

                                        <td class="text-center">
                                            {{ $value->created_at->format('d-m-Y H:i') }} WIB
                                        </td>

                                        <td>
                                            <ul class="mb-0 ps-3">
                                                @foreach ($value->permintaandetail as $detail)
                                                    <li>
                                                        <strong>{{ $detail->barang->nama ?? '-' }}</strong>
                                                        <span class="text-muted">({{ $detail->jumlah }} {{ $detail->barang->satuan ?? '' }})</span>
                                                    </li>
                                                @endforeach
                                            </ul>
                                        </td>

                                        <td class="text-center">
                                            @if ($value->status == 'Menunggu Konfirmasi')
                                                <span class="badge bg-warning px-2 py-1 fs-7">Menunggu Konfirmasi</span>
                                            @elseif($value->status == 'Diterima')
                                                <span class="badge bg-success px-2 py-1 fs-7">Diterima</span>
                                            @elseif($value->status == 'Ditolak')
                                                <span class="badge bg-danger px-2 py-1 fs-7">Ditolak</span>
                                            @endif
                                        </td>

                                        <td class="text-center">
                                            <a href="{{ url('panel/permintaandetail/' . $value->id) }}"
                                                class="btn btn-sm btn-info mb-1 text-white">
                                                <i class="fa fa-eye"></i> Detail
                                            </a>

                                            @if (auth()->user()->role == 'Admin' && $value->status == 'Menunggu Konfirmasi')
                                                <form action="{{ url('panel/permintaanstatus/' . $value->id) }}" method="POST" style="display:inline;">
                                                    @csrf
                                                    @method('PATCH')
                                                    <input type="hidden" name="status" value="Diterima">
                                                    <button type="submit" class="btn btn-sm btn-success mb-1" onclick="return confirm('Terima permintaan barang ini?')">
                                                        <i class="fa fa-check"></i> Terima
                                                    </button>
                                                </form>

                                                <form action="{{ url('panel/permintaanstatus/' . $value->id) }}" method="POST" style="display:inline;">
                                                    @csrf
                                                    @method('PATCH')
                                                    <input type="hidden" name="status" value="Ditolak">
                                                    <button type="submit" class="btn btn-sm btn-secondary mb-1" onclick="return confirm('Tolak permintaan barang ini?')">
                                                        <i class="fa fa-times"></i> Tolak
                                                    </button>
                                                </form>
                                            @endif

                                            @if (auth()->user()->role != 'Admin')
                                                <form action="{{ url('panel/permintaanhapus/' . $value->id) }}"
                                                    method="POST" style="display:inline;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-sm btn-danger mb-1"
                                                        onclick="return confirm('Hapus data ini?')">
                                                        <i class="fa fa-trash"></i> Hapus
                                                    </button>
                                                </form>
                                            @endif
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

    {{-- ELEMENT AUDIO UNTUK SUARA NOTIFIKASI --}}
    <audio id="notifAudio">
        <source src="{{ asset('assets/notif/notif.mp3') }}" type="audio/mpeg">
    </audio>

    {{-- STRUKTUR POP-UP NOTIFIKASI DARI ATAS (CSS KUSTOM) --}}
    <div id="popupNotifikasi" class="custom-popup-notif">
        <div class="popup-content shadow-lg">
            <div class="popup-icon">
                <i class="fas fa-bell fa-lg text-white"></i>
            </div>
            <div class="popup-text">
                <h6 class="fw-bold m-0 text-dark">Permintaan Baru Masuk!</h6>
                <p class="m-0 text-muted" id="notifMessage">Ada permintaan barang baru dari Cabang.</p>
            </div>
            <button type="button" class="btn-close ms-2" onclick="tutupNotifikasi()"></button>
        </div>
    </div>

    {{-- CSS KUSTOM UNTUK ANIMASI SLIDE DOWN POP-UP --}}
    <style>
        .custom-popup-notif {
            position: fixed;
            top: -100px; /* Sembunyi di atas layar luar view */
            left: 50%;
            transform: translateX(-50%);
            z-index: 9999;
            transition: top 0.5s cubic-bezier(0.175, 0.885, 0.32, 1.275); /* Efek membal halus */
            width: 90%;
            max-width: 450px;
        }
        .custom-popup-notif.show {
            top: 25px; /* Turun menduduki bagian atas layar */
        }
        .popup-content {
            background: #ffffff;
            border-left: 5px solid #ffc107; /* Warna kuning peringatan */
            border-radius: 8px;
            padding: 15px;
            display: flex;
            align-items: center;
            gap: 12px;
        }
        .popup-icon {
            background: #ffc107;
            padding: 10px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            width: 40px;
            height: 40px;
        }
        .popup-text {
            flex-grow: 1;
        }
        .popup-text p {
            font-size: 12px;
        }
    </style>

    {{-- JAVASCRIPT LOGIC REAL-TIME CHECKER (HANYA AKTIF JIKA USER = ADMIN) --}}
    @if(auth()->user()->role == 'Admin')
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            // Jalankan pengecekan setiap 7 detik sekali
            setInterval(function() {
                fetch("{{ route('permintaan.cekbaru') }}")
                    .then(response => response.json())
                    .then(data => {
                        if (data.status === true) {
                            // 1. Ubah teks pesan pop-up sesuai cabang peminta
                            document.getElementById('notifMessage').innerHTML = 'Menerima dokumen baru dari <strong>' + data.cabang + '</strong> pada pukul ' + data.waktu + ' WIB.';

                            // 2. Munculkan pop-up (Slide Down)
                            var popup = document.getElementById('popupNotifikasi');
                            popup.classList.add('show');

                            // 3. Mainkan file Audio MP3 (Interaksi browser mengharuskan admin pernah klik halaman minimal sekali)
                            var audio = document.getElementById('notifAudio');
                            audio.play().catch(function(error) {
                                console.log("Suara terblokir sistem keamanan browser sebelum ada interaksi klik user.");
                            });

                            // 4. Reload otomatis tabel di background setelah 4 detik agar Admin melihat data barunya langsung
                            setTimeout(function() {
                                location.reload();
                            }, 4500);
                        }
                    })
                    .catch(error => console.error('Gagal memproses pengecekan real-time:', error));
            }, 7000);
        });

        function tutupNotifikasi() {
            document.getElementById('popupNotifikasi').classList.remove('show');
        }
    </script>
    @endif
@endsection
