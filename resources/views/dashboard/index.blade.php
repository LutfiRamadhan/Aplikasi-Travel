@extends('layouts.main')

@section('title', 'Dashboard')

@section('content')
    <div class="row">
        <div class="col-xl-4 col-lg-6 col-md-6 col-12">
            <div class="card bg-white">
                <div class="card-body">
                    <div class="card-block pt-2 pb-0">
                        <div class="media">
                            <div class="media-body white text-left">
                                <h4 class="font-medium-5 card-title mb-0">9</h4>
                                <span class="grey darken-1">Total Transaksi</span>
                            </div>
                            <div class="media-right text-right">
                                <i class="icon-cup font-large-1 primary"></i>
                            </div>
                        </div>
                    </div>
                    <div id="Widget-line-chart" class="height-150 lineChartWidget WidgetlineChart mb-2">
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-4 col-lg-6 col-md-6 col-12">
            <div class="card bg-white">
                <div class="card-body">
                    <div class="card-block pt-2 pb-0">
                        <div class="media">
                            <div class="media-body white text-left">
                                <h4 class="font-medium-5 card-title mb-0">Rp. 1.718.320</h4>
                                <span class="grey darken-1">Total Pendapatan</span>
                            </div>
                            <div class="media-right text-right">
                                <i class="icon-wallet font-large-1 warning"></i>
                            </div>
                        </div>
                    </div>
                    <div id="Widget-line-chart1" class="height-150 lineChartWidget WidgetlineChart1 mb-2">
                    </div>

                </div>
            </div>
        </div>
        <div class="col-xl-4 col-lg-6 col-md-6 col-12">
            <div class="card bg-white">
                <div class="card-body">
                    <div class="card-block pt-2 pb-0">
                        <div class="media">
                            <div class="media-body white text-left">
                                <h4 class="font-medium-5 card-title mb-0">11</h4>
                                <span class="grey darken-1">Total Penumpang Terbanyak</span>
                            </div>
                            <div class="media-right text-right">
                                <i class="icon-basket-loaded font-large-1 success"></i>
                            </div>
                        </div>
                    </div>
                    <div id="Widget-line-chart2" class="height-150 lineChartWidget WidgetlineChart2 mb-2">
                </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12 col-md-6">
            <div class="card">
                <div class="card-header">
                    <div class="card-title-wrap bar-success">
                        <h4 class="card-title">Laporan Mingguan</h4>
                    </div>
                </div>
                <div class="card-body">
                    <div class="card-block">
                        <div class="col-md-12">
                            <table class="table table-striped table-bordered base-style">
                                <thead>
                                    <th>Tanggal</th>
                                    <th>Rute</th>
                                    <th>Total Penumpang</th>
                                    <th>Total Pemasukan</th>
                                </thead>
                                <tbody>
                                    @foreach ($data as $item)
                                        <tr>
                                            <td nowrap>{{ date('d F Y', strtotime($item->tanggal)) }}</td>
                                            <td nowrap>{{ $item->kota_asal.' - '.$item->kota_destinasi }}</td>
                                            <td>{{ $item->total_penumpang }}</td>
                                            <td>{{ $item->total_pemasukan }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                                <tfoot>
                                    <th>Tanggal</th>
                                    <th>Rute</th>
                                    <th>Total Penumpang</th>
                                    <th>Total Pemasukan</th>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            
        </div>
        <div class="col-12 col-md-6" id="recent-sales">
            <div class="card">
                <div class="card-header">
                    <div class="card-title-wrap bar-primary">
                    <h4 class="card-title">Pembelian Terbaru</h4>
                    </div>
                    <a class="heading-elements-toggle">
                        <i class="la la-ellipsis-v font-medium-3"></i>
                    </a>
                </div>
                <div class="card-content mt-1">
                    <div class="table-responsive">
                    <table class="table table-hover table-xl mb-0" id="recent-orders">
                        <thead>
                        <tr>
                            <th class="border-top-0">Tanggal Berangkat</th>
                            <th class="border-top-0">Rute</th>
                            <th class="border-top-0">Nama Penumpang</th>
                            <th class="border-top-0">Supir</th>
                            <th class="border-top-0">Kendaraan</th>
                        </tr>
                        </thead>
                        <tbody>
                            @foreach ($neworder as $item)
                                <tr>
                                    <td class="text-truncate">{{ date('d F Y', strtotime($item->tanggal)) }}</td>
                                    <td class="text-truncate">{{ $item->kota_asal.' - '.$item->kota_destinasi }}</td>
                                    <td class="text-truncate">{{ $item->nama }}</td>
                                    <td class="text-truncate">{{ $item->supir }}</td>
                                    <td class="text-truncate">{{ $item->merk.' - '.$item->tipe_jenis }}</td>
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

@section('scriptpage')
    <script src="app-assets/vendors/js/chartist.min.js"></script>
@endsection

@section('script')
    <script src="app-assets/js/dashboard-ecommerce.js"></script>
@endsection