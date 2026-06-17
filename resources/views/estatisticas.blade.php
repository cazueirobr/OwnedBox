<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Estatísticas - OwnedBox</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@400;500;700&display=swap" rel="stylesheet">

    @vite('resources/css/estatisticas.css')
</head>
<body>
    @include('components.nav')

    <main class="main-content">
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-12 col-xl-10 col-xxl-8">
                    <div class="page-header">
                        <h2 class="page-title">Estatísticas</h2>
                    </div>

                    <div class="stats-grid">
                        <div class="stat-card">
                            <span class="stat-label">Laboratórios concluídos nesta semana</span>
                            <span class="stat-value">{{ $labsThisWeek }}</span>
                        </div>

                        <div class="stat-card">
                            <div class="progress-header">
                                <span class="progress-label">Progresso</span>
                                <span class="progress-value">{{ count($completedModules ?? []) }}/{{ $totalModules ?? 0 }} módulos ({{ $progressPercent ?? 0 }}%)</span>
                            </div>
                            <div class="progress-bar-container">
                                <div class="progress-bar-custom">
                                    <div class="progress-bar-fill" style="width: {{ $progressPercent ?? 0 }}%"></div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="chart-card">
                        <h3 class="section-title">Tempo de conclusão por módulo (minutos)</h3>
                        @if ($completionTimes->isEmpty())
                            <p class="chart-empty">Conclua um módulo para visualizar o tempo de conclusão.</p>
                        @else
                            <canvas id="completionChart"></canvas>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    @if ($completionTimes->isNotEmpty())
        <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.1/dist/chart.umd.min.js"></script>
        <script>
            const completionData = @json($completionTimes);

            new Chart(document.getElementById('completionChart'), {
                type: 'bar',
                data: {
                    labels: completionData.map(item => item.module),
                    datasets: [{
                        label: 'Minutos',
                        data: completionData.map(item => item.minutes),
                        backgroundColor: '#1294d4',
                        borderRadius: 6,
                    }]
                },
                options: {
                    responsive: true,
                    plugins: {
                        legend: { labels: { color: '#ffffff' } }
                    },
                    scales: {
                        x: { ticks: { color: '#ffffff' }, grid: { color: '#243d47' } },
                        y: { beginAtZero: true, ticks: { color: '#ffffff' }, grid: { color: '#243d47' } }
                    }
                }
            });
        </script>
    @endif
</body>
</html>
