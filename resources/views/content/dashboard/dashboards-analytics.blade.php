@extends('layouts/contentNavbarLayout')

@section('title', 'Dashboard - Analytics')

@section('vendor-style')
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/apex-charts/apex-charts.css') }}">
@endsection

@section('vendor-script')
    <script src="{{ asset('assets/vendor/libs/apex-charts/apexcharts.js') }}"></script>
@endsection

@section('page-script')
    <script>
        const orderStatistics = {!! json_encode($orderStatistics) !!};
        const chartOrderStatistics = document.querySelector('#orderStatisticsChart');

        if (typeof chartOrderStatistics !== 'undefined' && chartOrderStatistics !== null) {
            const orderChartConfig = {
                chart: {
                    type: 'donut',
                },
                series: orderStatistics.map(statistic => statistic.total_orders),
                labels: orderStatistics.map(statistic => statistic.section),
            };

            const statisticsChart = new ApexCharts(chartOrderStatistics, orderChartConfig);
            statisticsChart.render();
        }
    </script>
@endsection

@section('content')
    <div class="row">
        <div class="col-lg-8 mb-4 order-0">
            <div class="card">
                <div class="d-flex align-items-end row">
                    <div class="col-sm-8">
                        <div class="card-body">
                            <h5 class="card-title text-success">Bonjour! 🎉</h5>
                            <p class="mb-4">Vous pouvez exporter vos données dans un fichier Excel pour sauvegarder et importer des données à partir d'un fichier Excel pour les ajouter à votre application.</p>
                            <form action="{{ url('/import') }}" method="post" enctype="multipart/form-data"
                                class="input-group">
                                @csrf
                                <label for="file"  class="btn btn-sm btn-outline-success">Choose File</label>
                                <input type="file" name="file" id="file" class="form-control visually-hidden" aria-label="Upload">

                                <button class="btn btn-md btn-success" value="Import data" class="-2" type="submit"
                                    value="import">import</button>
                                <a class="btn btn-md btn-success" href="{{url('exportall')}}">export</a>
                            </form>


                            <!-- <a  class="btn btn-md btn-success" value="export">export</a>
                                                                                                                                                                                                <input type="button"  class="btn btn-md btn-success" value="import"> -->
                        </div>
                    </div>
                    <div class="col-sm-4 text-center text-sm-left">
                        <div class="card-body pb-0 px-0 px-md-4">
                            <img src="{{ asset('assets/img/illustrations/man-with-laptop-light.png') }}" height="140"
                                alt="View Badge User" data-app-dark-img="illustrations/man-with-laptop-dark.png"
                                data-app-light-img="illustrations/man-with-laptop-light.png">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-md-4 order-1">
            <div class="row">
            <div class="col-lg-6 col-md-12 col-6 mb-4" >
                <div class="card" >
                    <div class="card-body">
                        <div class="card-title d-flex align-items-start justify-content-between">
                            <div class="avatar flex-shrink-0">
                                <img src="{{ asset('assets/img/icons/unicons/chart-success.png') }}" alt="chart success" class="rounded">
                            </div>
                        </div>
                        <span class="fw-semibold d-block mb-1">Totale montant </span>
                        <h6 class="card-title  mb-5">{{ $totalMONTANT }} .00Dh</h6>
                    </div>
                </div>
            </div>

                <div class="col-lg-6 col-md-12 col-6 mb-4">
                    <div class="card">
                        <div class="card-body">
                            <div class="card-title d-flex align-items-start justify-content-between">
                                <div class="avatar flex-shrink-0">
                                    <img src="{{ asset('assets/img/icons/unicons/wallet-info.png') }}" alt="Credit Card"
                                        class="rounded">
                                </div>

                            </div>
                            <span>justifiée</span>
                            <h4 class="card-title text-nowrap mb-5">{{ $totalJustificationOui }}</h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        {{-- Statistics --}}
        <div class="col-12 col-lg-8 order-2 order-md-3 order-lg-2 mb-4">
            <div class="card h-100">
                <div class="card-header d-flex align-items-center justify-content-between pb-0">
                    <div class="card-title mb-0">
                        <h5 class="m-0 me-2">Gestion de</h5>
                        <small class="text-muted">{{ $totalMONTANT }}  Dh</small>
                    </div>
                </div>
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <div class="d-flex flex-column align-items-center gap-1">
                            <h2 class="mb-2">{{ $totalOCBG }}</h2>
                            <span>Total </span>
                        </div>
                        <div id="orderStatisticsChart"></div>
                    </div>
                    <ul class="p-0 m-0">
                        @foreach ($orderStatistics as $statistic)
                            <li class="d-flex mb-4 pb-1">
                                <div class="avatar flex-shrink-0 me-3">
                                    <img src="{{ asset('assets/img/icons/unicons/chart-success.png') }}"
                                        alt="chart success" class="rounded">
                                </div>
                                <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                                    <div class="me-2">
                                        <h6 class="mb-0">{{ $statistic->section }}</h6>
                                    </div>
                                    <div class="user-progress">
                                        <small class="fw-medium">{{ $statistic->total_orders }}</small>
                                    </div>
                                </div>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>

        <!--/  Statistics -->

        <div class="col-12 col-md-8 col-lg-4 order-3 order-md-2">
            <div class="row">
                <div class="col-6 mb-10">
                    <div class="card">
                        <div class="card-body">
                            <div class="card-title d-flex align-items-start justify-content-between">
                                <div class="avatar flex-shrink-0">
                                    <img src="{{ asset('assets/img/icons/unicons/paypal.png') }}" alt="Credit Card"
                                        class="rounded">
                                </div>

                            </div>
                            <span class="d-block mb-1">Non justifiée</span>
                            <h3 class="card-title text-nowrap mb-2">{{ $totalJustificationNon}}</h3>
                        </div>
                    </div>
                </div>
                <div class="col-6 mb-4">
                    <div class="card">
                        <div class="card-body">
                            <div class="card-title d-flex align-items-start justify-content-between">
                                <div class="avatar flex-shrink-0">
                                    <img src="{{ asset('assets/img/icons/unicons/cc-primary.png') }}" alt="Credit Card"
                                        class="rounded">
                                </div>

                            </div>
                            <span class="fw-semibold d-block mb-1">Combien OCBG</span>
                            <h3 class="card-title mb-2">{{ $totalOCBG }}</h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    </div>

@endsection

