@extends('layouts.main')

@section('title', 'Tiket')

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <div class="card-title-wrap bar-success">
                    <h4 class="card-title">Data Transaksi Tiket</h4>
                </div>
            </div>
            <div class="card-body">
                <div class="card-block">
                    @if (session('error'))
                        <div class="col-md-12">
                            <div class="alert alert-danger">
                                <strong>Error!</strong> {{ session('error') }}
                            </div>
                        </div>
                    @endif
                    @if (session('success'))
                        <div class="col-md-12">
                            <div class="alert alert-success">
                                <strong>Success!</strong> {{ session('success') }}
                            </div>
                        </div>
                    @endif
                    <div class="col-md-12">
                        <table class="table table-striped table-bordered base-style">
                            <thead>
                                <th>Tanggal</th>
                                <th>Jam Keberangkatan</th>
                                <th>Rute</th>
                                <th>Kendaraan</th>
                                <th>Kapasitas</th>
                                <th>Tersedia</th>
                                <th>Action</th>
                            </thead>
                            <tbody>
                                @foreach ($data as $item)
                                    <tr>
                                        <td nowrap>{{ date('d F Y', strtotime($item->tanggal)) }}</td>
                                        <td>{{ $item->jam_berangkat }}</td>
                                        <td nowrap>{{ $item->kota_asal.' - '.$item->kota_destinasi }}</td>
                                        <td nowrap>{{ $item->merk.' - '.$item->tipe_jenis }}</td>
                                        <td class="text-center">
                                            {{ $item->kapasitas }} Penumpang
                                        </td>
                                        <td>
                                            @if ($item->tersedia == 0)
                                                <div class="col-md-12">
                                                    <label class="badge badge-success text-white">
                                                        PENUH
                                                    </label>
                                                </div>
                                            @else
                                                <div class="col-md-12">
                                                    <label class="badge badge-info text-white">
                                                        {{ $item->tersedia }} Kursi
                                                    </label>
                                                </div>
                                                {{-- <div class="col-md-12">
                                                    <label class="badge badge-second">
                                                        {{ $item->booking }} Booking
                                                    </label>
                                                </div> --}}
                                            @endif
                                        </td>
                                        <td>
                                            <a href="{{ url('transaksi/create/'.$item->id) }}" class="btn btn-info btn-block">
                                                <i class="icon-plus"></i> Tambah
                                            </a>
                                            <a href="{{ url('transaksi/'.$item->id) }}" class="btn btn-primary btn-block">
                                                <i class="icon-eye"></i> Detil
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <th>Tanggal</th>
                                <th>Jam Keberangkatan</th>
                                <th>Rute</th>
                                <th>Kendaraan</th>
                                <th>Kapasitas</th>
                                <th>Tersedia</th>
                                <th>Action</th>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        
    </div>
</div>
@endsection

@section('scriptpage')
    <script src="{{ asset('app-assets/vendors/js/datatable/datatables.min.js') }}"></script>
@endsection

@section('script')
    <script src="{{ asset('app-assets/js/data-tables/datatable-styling.js') }}"></script>
@endsection