@extends('layouts.panel')

@section('content')
<style>
    /* ===================== GLOBAL & ANIMASI ===================== */
    @import url('https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap');

    .page-inner, .page-inner * {
        font-family: 'Plus Jakarta Sans', sans-serif;
    }

    .fade-in { animation: fadeIn 0.9s ease-out; }
    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(24px); }
        to { opacity: 1; transform: translateY(0); }
    }
    .fade-in-delay-1 { animation: fadeIn 0.9s ease-out 0.1s both; }
    .fade-in-delay-2 { animation: fadeIn 0.9s ease-out 0.2s both; }

    /* ===================== HERO HEADER ===================== */
    .dashboard-hero {
        position: relative;
        border-radius: 24px;
        padding: 36px 40px;
        margin-bottom: 28px;
        background: linear-gradient(135deg, #0f172a 0%, #1e3a8a 55%, #0ea5e9 100%);
        overflow: hidden;
        box-shadow: 0 20px 40px -15px rgba(15, 23, 42, 0.45);
    }
    .dashboard-hero::before {
        content: '';
        position: absolute;
        top: -60px; right: -60px;
        width: 260px; height: 260px;
        background: radial-gradient(circle, rgba(56,189,248,0.35) 0%, transparent 70%);
        border-radius: 50%;
    }
    .dashboard-hero::after {
        content: '';
        position: absolute;
        bottom: -90px; left: 10%;
        width: 220px; height: 220px;
        background: radial-gradient(circle, rgba(99,102,241,0.25) 0%, transparent 70%);
        border-radius: 50%;
    }
    .dashboard-hero h4 {
        color: #fff;
        font-weight: 800;
        font-size: 1.65rem;
        letter-spacing: -0.3px;
        margin-bottom: 6px;
        position: relative;
        z-index: 2;
    }
    .dashboard-hero p {
        color: rgba(226,232,240,0.85);
        font-size: 0.92rem;
        margin: 0;
        position: relative;
        z-index: 2;
    }
    .hero-badge {
        position: relative;
        z-index: 2;
        display: inline-flex;
        align-items: center;
        gap: 8px;
        background: rgba(255,255,255,0.12);
        backdrop-filter: blur(6px);
        border: 1px solid rgba(255,255,255,0.2);
        color: #fff;
        font-size: 0.78rem;
        font-weight: 600;
        padding: 7px 14px;
        border-radius: 30px;
        margin-top: 16px;
    }
    .hero-badge .dot {
        width: 7px; height: 7px;
        border-radius: 50%;
        background: #4ade80;
        box-shadow: 0 0 0 4px rgba(74,222,128,0.25);
    }

    /* ===================== STAT CARD (KASIR) ===================== */
    .stat-card {
        border: none;
        border-radius: 20px;
        background: #fff;
        box-shadow: 0 8px 30px rgba(15, 23, 42, 0.06);
        padding: 22px;
        display: flex;
        align-items: center;
        gap: 16px;
        transition: transform 0.3s ease, box-shadow 0.3s ease;
        height: 100%;
    }
    .stat-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 16px 40px rgba(15, 23, 42, 0.10);
    }
    .stat-icon {
        width: 52px; height: 52px;
        border-radius: 14px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.3rem;
        flex-shrink: 0;
    }
    .stat-icon.blue { background: linear-gradient(135deg,#bfdbfe,#93c5fd); color: #1d4ed8; }
    .stat-icon.amber { background: linear-gradient(135deg,#fde68a,#fbbf24); color: #b45309; }
    .stat-icon.green { background: linear-gradient(135deg,#86efac,#4ade80); color: #15803d; }
    .stat-icon.red { background: linear-gradient(135deg,#fecaca,#fca5a5); color: #b91c1c; }
    .stat-value {
        font-size: 1.55rem;
        font-weight: 800;
        color: #0f172a;
        line-height: 1.1;
    }
    .stat-label {
        font-size: 0.78rem;
        font-weight: 600;
        color: #94a3b8;
        margin-top: 2px;
    }

    /* ===================== CARD MODERN ===================== */
    .card-modern {
        border: none;
        border-radius: 20px;
        background: #fff;
        box-shadow: 0 8px 30px rgba(15, 23, 42, 0.06);
        overflow: hidden;
        transition: transform 0.35s ease, box-shadow 0.35s ease;
    }
    .card-modern:hover {
        transform: translateY(-4px);
        box-shadow: 0 16px 40px rgba(15, 23, 42, 0.10);
    }

    .card-modern-header {
        padding: 22px 24px 16px 24px;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }
    .card-modern-header h6 {
        font-weight: 700;
        font-size: 0.95rem;
        margin: 0;
        color: #1e293b;
        display: flex;
        align-items: center;
        gap: 10px;
    }
    .icon-pill {
        width: 36px; height: 36px;
        border-radius: 12px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        font-size: 0.95rem;
        flex-shrink: 0;
    }
    .icon-pill.danger { background: linear-gradient(135deg,#fecaca,#fca5a5); color: #b91c1c; }
    .icon-pill.primary { background: linear-gradient(135deg,#bfdbfe,#93c5fd); color: #1d4ed8; }

    /* ===================== CHART CONTAINER ===================== */
    .chart-container {
        position: relative;
        height: 260px;
        width: 100%;
        padding: 10px 24px 24px 24px;
    }
    .chart-wrapper-bg {
        background: linear-gradient(180deg, rgba(248,250,252,0.6) 0%, rgba(255,255,255,0) 100%);
        border-radius: 16px;
    }

    /* ===================== LEGEND RANKING BAR CHART ===================== */
    .chart-rank-legend {
        display: flex;
        flex-wrap: wrap;
        gap: 14px;
        padding: 0 24px 16px 24px;
        margin-top: -6px;
    }
    .rank-legend-item {
        display: flex;
        align-items: center;
        gap: 6px;
        font-size: 0.72rem;
        font-weight: 600;
        color: #64748b;
    }
    .rank-legend-dot {
        width: 9px; height: 9px;
        border-radius: 50%;
        flex-shrink: 0;
    }

    /* ===================== TABEL ===================== */
    .table-header {
        font-size: 0.72rem;
        letter-spacing: 0.06em;
        color: #94a3b8;
        background: #f8fafc;
        text-transform: uppercase;
    }
    .table-header th {
        border: none !important;
        padding-top: 14px;
        padding-bottom: 14px;
    }
    .table-row-item {
        transition: background 0.25s;
        border-bottom: 1px solid #f1f5f9 !important;
    }
    .table-row-item:last-child { border-bottom: none !important; }
    .table-row-item:hover { background: #f8faff; }
    .table-row-item td { border: none !important; }

    .status-badge {
        padding: 6px 14px;
        border-radius: 30px;
        font-weight: 700;
        font-size: 0.72rem;
        background: #eff6ff;
        color: #3b82f6;
        text-transform: uppercase;
        letter-spacing: 0.02em;
        display: inline-block;
    }

    .badge-jumlah-kritis {
        background: linear-gradient(135deg,#ef4444,#b91c1c);
        color: #fff;
        font-weight: 700;
        font-size: 0.78rem;
        padding: 7px 14px;
        border-radius: 30px;
        box-shadow: 0 6px 16px rgba(239,68,68,0.35);
    }

    .badge-stok-kritis {
        background: #fef2f2;
        color: #dc2626;
        font-weight: 700;
        padding: 5px 12px;
        border-radius: 8px;
        font-size: 0.78rem;
    }

    .link-more {
        text-decoration: none;
        font-size: 0.8rem;
        font-weight: 700;
        color: #2563eb;
        transition: gap 0.25s;
        display: inline-flex;
        align-items: center;
        gap: 4px;
    }
    .link-more:hover { gap: 8px; color: #1d4ed8; }

    .empty-state {
        text-align: center;
        padding: 40px 20px;
        color: #94a3b8;
        font-size: 0.85rem;
    }
    .empty-state i { font-size: 1.8rem; display: block; margin-bottom: 10px; color: #cbd5e1; }
</style>

<div class="container py-4">
    <div class="page-inner fade-in">

        {{-- ===================== HERO HEADER ===================== --}}
        <div class="dashboard-hero">
            <h4>Halo, {{ Auth::user()->name }} 👋</h4>
            <p>Ringkasan data operasional terkini, dipantau secara real-time.</p>
            <div class="hero-badge">
                <span class="dot"></span>
                Sistem Aktif & Tersinkronisasi
            </div>
        </div>

        @if (Auth::user()->role == 'Admin')

            {{-- ===================== ROW CHART (ADMIN) ===================== --}}
            <div class="row g-4 mb-4">
                <div class="col-lg-8 fade-in-delay-1">
                    <div class="card-modern h-100">
                        <div class="card-modern-header">
                            <h6><span class="icon-pill primary"><i class="fas fa-chart-column"></i></span> Top 5 Barang Paling Sering Diminta</h6>
                        </div>
                        <div class="chart-rank-legend" id="rankLegend"></div>
                        <div class="chart-container chart-wrapper-bg"><canvas id="barangChart"></canvas></div>
                    </div>
                </div>
                <div class="col-lg-4 fade-in-delay-1">
                    <div class="card-modern h-100">
                        <div class="card-modern-header">
                            <h6><span class="icon-pill primary"><i class="fas fa-circle-notch"></i></span> Rasio Validasi Status</h6>
                        </div>
                        <div class="chart-container chart-wrapper-bg"><canvas id="doughnutChartStatus"></canvas></div>
                    </div>
                </div>
            </div>

            {{-- ===================== ROW TABEL (ADMIN) ===================== --}}
            <div class="row g-4 fade-in-delay-2">
                <div class="col-md-6">
                    <div class="card-modern h-100">
                        <div class="card-modern-header">
                            <h6><span class="icon-pill danger"><i class="fas fa-box-open"></i></span> Stok Kritis (&lt; 10)</h6>
                            <span class="badge-jumlah-kritis">{{ $jumlahKritis }} Item</span>
                        </div>
                        <div class="table-responsive">
                            <table class="table align-middle mb-0">
                                <thead class="table-header">
                                    <tr>
                                        <th class="ps-4">NAMA BARANG</th>
                                        <th class="text-end pe-4">STOK</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($stokKritis as $item)
                                    <tr class="table-row-item">
                                        <td class="ps-4 py-3 fw-semibold text-dark">{{ $item->nama }}</td>
                                        <td class="text-end pe-4 py-3"><span class="badge-stok-kritis">{{ $item->jumlah }}</span></td>
                                    </tr>
                                    @empty
                                    <tr>
                                        <td colspan="2" class="empty-state">
                                            <i class="fas fa-circle-check"></i>
                                            Tidak ada stok kritis saat ini
                                        </td>
                                    </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="card-modern h-100">
                        <div class="card-modern-header">
                            <h6><span class="icon-pill primary"><i class="fas fa-clipboard-list"></i></span> Permintaan Terbaru</h6>
                            <a href="{{ route('permintaan.index') }}" class="link-more">Selengkapnya <i class="fas fa-arrow-right"></i></a>
                        </div>
                        <div class="table-responsive">
                            <table class="table align-middle mb-0">
                                <thead class="table-header">
                                    <tr>
                                        <th class="ps-4">CABANG</th>
                                        <th class="text-end pe-4">STATUS</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($permintaanTerbaru as $p)
                                    <tr class="table-row-item">
                                        <td class="ps-4 py-3 text-secondary fw-medium">{{ $p->cabang->nama ?? 'N/A' }}</td>
                                        <td class="text-end pe-4 py-3"><span class="status-badge">{{ $p->status }}</span></td>
                                    </tr>
                                    @empty
                                    <tr>
                                        <td colspan="2" class="empty-state">
                                            <i class="fas fa-inbox"></i>
                                            Belum ada permintaan masuk
                                        </td>
                                    </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

        @elseif (Auth::user()->role == 'Kasir')

            {{-- ===================== STAT CARD (KASIR) ===================== --}}
            <div class="row g-3 mb-4 fade-in-delay-1">
                <div class="col-6 col-lg-3">
                    <div class="stat-card">
                        <div class="stat-icon blue"><i class="fas fa-clipboard-list"></i></div>
                        <div>
                            <div class="stat-value">{{ $totalpermintaan }}</div>
                            <div class="stat-label">Total Permintaan</div>
                        </div>
                    </div>
                </div>
                <div class="col-6 col-lg-3">
                    <div class="stat-card">
                        <div class="stat-icon amber"><i class="fas fa-hourglass-half"></i></div>
                        <div>
                            <div class="stat-value">{{ $permintaanmenunggu }}</div>
                            <div class="stat-label">Menunggu Konfirmasi</div>
                        </div>
                    </div>
                </div>
                <div class="col-6 col-lg-3">
                    <div class="stat-card">
                        <div class="stat-icon green"><i class="fas fa-circle-check"></i></div>
                        <div>
                            <div class="stat-value">{{ $statusDiterima }}</div>
                            <div class="stat-label">Diterima</div>
                        </div>
                    </div>
                </div>
                <div class="col-6 col-lg-3">
                    <div class="stat-card">
                        <div class="stat-icon red"><i class="fas fa-circle-xmark"></i></div>
                        <div>
                            <div class="stat-value">{{ $statusDitolak }}</div>
                            <div class="stat-label">Ditolak</div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- ===================== ROW CHART + TABEL (KASIR) ===================== --}}
            <div class="row g-4 fade-in-delay-2">
                <div class="col-lg-4">
                    <div class="card-modern h-100">
                        <div class="card-modern-header">
                            <h6><span class="icon-pill primary"><i class="fas fa-circle-notch"></i></span> Rasio Status Permintaan</h6>
                        </div>
                        <div class="chart-container chart-wrapper-bg"><canvas id="doughnutChartStatus"></canvas></div>
                    </div>
                </div>

                <div class="col-lg-8">
                    <div class="card-modern h-100">
                        <div class="card-modern-header">
                            <h6><span class="icon-pill primary"><i class="fas fa-clipboard-list"></i></span> Permintaan Terbaru</h6>
                            <a href="{{ route('permintaan.index') }}" class="link-more">Lihat Semua <i class="fas fa-arrow-right"></i></a>
                        </div>
                        <div class="table-responsive">
                            <table class="table align-middle mb-0">
                                <thead class="table-header">
                                    <tr>
                                        <th class="ps-4">CABANG</th>
                                        <th class="text-end pe-4">STATUS</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($permintaanTerbaru as $p)
                                    <tr class="table-row-item">
                                        <td class="ps-4 py-3 text-secondary fw-medium">{{ $p->cabang->nama ?? 'N/A' }}</td>
                                        <td class="text-end pe-4 py-3"><span class="status-badge">{{ $p->status }}</span></td>
                                    </tr>
                                    @empty
                                    <tr>
                                        <td colspan="2" class="empty-state">
                                            <i class="fas fa-inbox"></i>
                                            Belum ada permintaan masuk
                                        </td>
                                    </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

        @endif
    </div>
</div>
@endsection

@section('script')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels@2"></script>
<script>
    $(document).ready(function() {
        Chart.register(ChartDataLabels);

        const commonOptions = { responsive: true, maintainAspectRatio: false };

        /* =========================================================
           1. GRAFIK BAR — Top 5 Barang Paling Sering Diminta (Admin only)
        ========================================================= */
        if (document.getElementById('barangChart')) {
            const barCtx = document.getElementById('barangChart').getContext('2d');

            const rankColors = [
                { from: '#fbbf24', to: '#d97706', solid: '#f59e0b', label: '🥇 Rank 1' },
                { from: '#cbd5e1', to: '#64748b', solid: '#94a3b8', label: '🥈 Rank 2' },
                { from: '#fb923c', to: '#9a3412', solid: '#ea580c', label: '🥉 Rank 3' },
                { from: '#60a5fa', to: '#1d4ed8', solid: '#3b82f6', label: 'Rank 4' },
                { from: '#a78bfa', to: '#6d28d9', solid: '#8b5cf6', label: 'Rank 5' },
            ];

            const barLabels = {!! json_encode($labels) !!};
            const barData   = {!! json_encode($data) !!};

            const barColors = barData.map((_, i) => {
                const c = rankColors[i % rankColors.length];
                const grad = barCtx.createLinearGradient(0, 0, 0, 260);
                grad.addColorStop(0, c.from);
                grad.addColorStop(1, c.to);
                return grad;
            });

            const legendHtml = barLabels.map((label, i) => {
                const c = rankColors[i % rankColors.length];
                return `<div class="rank-legend-item">
                            <span class="rank-legend-dot" style="background:${c.solid}"></span>
                            ${label}
                        </div>`;
            }).join('');
            document.getElementById('rankLegend').innerHTML = legendHtml;

            new Chart(barCtx, {
                type: 'bar',
                data: {
                    labels: barLabels,
                    datasets: [{
                        label: 'Total Diminta',
                        data: barData,
                        backgroundColor: barColors,
                        hoverBackgroundColor: barColors,
                        borderRadius: { topLeft: 12, topRight: 12, bottomLeft: 0, bottomRight: 0 },
                        borderSkipped: false,
                        maxBarThickness: 50,
                        barPercentage: 0.6,
                        categoryPercentage: 0.75
                    }]
                },
                options: {
                    ...commonOptions,
                    animation: { duration: 1400, easing: 'easeOutBack' },
                    plugins: {
                        legend: { display: false },
                        tooltip: {
                            backgroundColor: '#0f172a',
                            titleFont: { size: 12, weight: '700' },
                            bodyFont: { size: 12 },
                            padding: 12,
                            cornerRadius: 10,
                            displayColors: false,
                            callbacks: { label: (ctx) => ' ' + ctx.parsed.y + ' kali diminta' }
                        },
                        datalabels: {
                            anchor: 'end',
                            align: 'top',
                            color: '#1e293b',
                            font: { weight: '800', size: 12 },
                            formatter: (value) => value
                        }
                    },
                    layout: { padding: { top: 30 } },
                    scales: {
                        x: {
                            grid: { display: false },
                            ticks: { color: '#475569', font: { weight: '600', size: 11 } }
                        },
                        y: { display: false, beginAtZero: true, grace: '20%' }
                    }
                },
                plugins: [
                    ChartDataLabels,
                    {
                        id: 'crownOnTop',
                        afterDatasetsDraw: (chart) => {
                            const { ctx, data } = chart;
                            const values = data.datasets[0].data;
                            if (!values.length) return;
                            const maxValue = Math.max(...values);
                            const maxIndex = values.indexOf(maxValue);
                            const meta = chart.getDatasetMeta(0);
                            const bar = meta.data[maxIndex];
                            if (!bar) return;
                            ctx.save();
                            ctx.font = '18px sans-serif';
                            ctx.textAlign = 'center';
                            ctx.fillText('👑', bar.x, bar.y - 22);
                            ctx.restore();
                        }
                    }
                ]
            });
        }

        /* =========================================================
           2. GRAFIK DOUGHNUT — Rasio Validasi Status (Admin & Kasir)
        ========================================================= */
        if (document.getElementById('doughnutChartStatus')) {
            const canvas = document.getElementById('doughnutChartStatus');
            const ctx = canvas.getContext('2d');

            const gradPending = ctx.createLinearGradient(0, 0, 0, 300);
            gradPending.addColorStop(0, '#fde68a'); gradPending.addColorStop(1, '#d97706');

            const gradDisetujui = ctx.createLinearGradient(0, 0, 0, 300);
            gradDisetujui.addColorStop(0, '#6ee7b7'); gradDisetujui.addColorStop(1, '#059669');

            const gradDitolak = ctx.createLinearGradient(0, 0, 0, 300);
            gradDitolak.addColorStop(0, '#fca5a5'); gradDitolak.addColorStop(1, '#dc2626');

            new Chart(canvas, {
                type: 'doughnut',
                data: {
                    labels: ['Pending', 'Disetujui', 'Ditolak'],
                    datasets: [{
                        data: [{{ $permintaanmenunggu }}, {{ $statusDiterima }}, {{ $statusDitolak }}],
                        backgroundColor: [gradPending, gradDisetujui, gradDitolak],
                        borderWidth: 4,
                        borderColor: '#ffffff',
                        borderRadius: 14,
                        spacing: 6,
                        hoverOffset: 14,
                        hoverBorderWidth: 4
                    }]
                },
                options: {
                    ...commonOptions,
                    cutout: '74%',
                    animation: { animateRotate: true, animateScale: true, duration: 1200, easing: 'easeOutQuart' },
                    plugins: {
                        legend: {
                            position: 'right',
                            labels: {
                                usePointStyle: true,
                                pointStyle: 'circle',
                                padding: 22,
                                font: { weight: '600', size: 12 },
                                color: '#475569'
                            }
                        },
                        tooltip: {
                            backgroundColor: '#0f172a',
                            padding: 12,
                            cornerRadius: 10,
                            displayColors: true,
                            boxPadding: 4
                        },
                        datalabels: { display: false }
                    }
                },
                plugins: [{
                    id: 'centerText',
                    beforeDraw: (chart) => {
                        const { ctx, chartArea: { left, top, width, height } } = chart;
                        const centerX = left + (width / 2);
                        const centerY = top + (height / 2);
                        const total = chart.data.datasets[0].data.reduce((a, b) => a + b, 0);

                        ctx.save();
                        ctx.shadowColor = 'rgba(15,23,42,0.08)';
                        ctx.shadowBlur = 6;

                        ctx.fillStyle = '#94a3b8';
                        ctx.font = '700 0.7rem "Plus Jakarta Sans", sans-serif';
                        ctx.textAlign = 'center';
                        ctx.textBaseline = 'middle';
                        ctx.letterSpacing = '1px';
                        ctx.fillText('TOTAL PERMINTAAN', centerX, centerY - 16);

                        ctx.fillStyle = '#0f172a';
                        ctx.font = 'bold 2rem "Plus Jakarta Sans", sans-serif';
                        ctx.textAlign = 'center';
                        ctx.fillText(total, centerX, centerY + 12);
                        ctx.restore();
                    }
                }]
            });
        }
    });
</script>
@endsection
