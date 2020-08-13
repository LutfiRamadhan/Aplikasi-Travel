@extends('layouts.main')

@section('title', 'Tambah Data Jadwal')

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <div class="card-title-wrap bar-success">
                    <h4 class="card-title">Data Perjalanan</h4>
                </div>
            </div>
            <div class="card-body">
                <div class="card-block">
                    <form class="form-horizontal">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="tanggal">
                                        Tanggal Berangkat :
                                    </label>
                                    <input type="text" id="tanggal" class="form-control" disabled value="{{ date('d/m/Y', strtotime($jadwal->tanggal)) }}">
                                </div>
                                <div class="form-group">
                                    <label for="kota_awal">
                                        Kota Asal :
                                    </label>
                                    <input type="text" id="kota_awal" class="form-control" disabled value="{{ $jadwal->rute->kota_asal }}">
                                </div>
                                <div class="form-group">
                                    <label for="jam_berangkat">
                                        Jam Berangkat :
                                    </label>
                                    <input type="text" id="jam_berangkat" class="form-control" disabled value="{{ $jadwal->jam_berangkat }}">
                                </div>
                                <div class="form-group">
                                    <label for="kendaraan">
                                        Kendaraan :
                                    </label>
                                    <input type="text" id="kendaraan" class="form-control" disabled value="{{ $jadwal->kendaraan->merk.' - '.$jadwal->kendaraan->tipe_jenis }}">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="tanggal_now">
                                        Tanggal Hari Ini :
                                    </label>
                                    <input type="text" id="tanggal_now" class="form-control" disabled value="{{ date('d/m/Y') }}">
                                </div>
                                <div class="form-group">
                                    <label for="kota_destinasi">
                                        Kota Destinasi :
                                    </label>
                                    <input type="text" id="kota_destinasi" class="form-control" disabled value="{{ $jadwal->rute->kota_destinasi }}">
                                </div>
                                <div class="form-group">
                                    <label for="perkiraan_tiba">
                                        Perkiraan Tiba :
                                    </label>
                                    <input type="text" id="perkiraan_tiba" class="form-control" disabled value="{{ $jadwal->perkiraan_tiba }}">
                                </div>
                                <div class="form-group">
                                    <label for="harga">
                                        Harga :
                                    </label>
                                    <input type="text" id="harga" class="form-control" disabled value="{{ number_format($jadwal->harga, 0, ',', '.') }}">
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <div class="card-title-wrap bar-success">
                    <h4 class="card-title">Data Transaksi</h4>
                </div>
            </div>
            <div class="card-body">
                <div class="card-block">
                    @if (session('success'))
                        <div class="alert alert-success">
                            <strong>Success!</strong> {{ session('success') }}
                        </div>
                    @endif
                    @if (session('error'))
                        <div class="alert alert-danger">
                            <strong>Error!</strong> {{ session('error') }}
                        </div>
                    @endif
                    <div class="col-md-12">
                        <table class="table table-striped table-bordered base-style">
                            <thead>
                                <th>No. Transaction</th>
                                <th>Nama Penumpang</th>
                                <th>Nomor Telepon</th>
                                <th>Seat Number</th>
                                <th>Status</th>
                                <th>Action</th>
                            </thead>
                            <tbody>
                                @foreach ($transaksi as $item)
                                    <tr>
                                        <td nowrap>{{ $item->no_transaction }}</td>
                                        <td nowrap>{{ $item->nama_penumpang }}</td>
                                        <td nowrap>{{ $item->nomor_telepon }}</td>
                                        <td class="text-center">{{ $item->seat_number }}</td>
                                        <td class="text-center">
                                            {{ $item->status }} 
                                        </td>
                                        <td class="text-center">
                                            <form action="{{ url('transaksi/'.$item->id) }}" method="post">
                                                @csrf
                                                @method('delete')
                                                <a href="{{ url('transaksi/'.$item->id.'/edit') }}" class="btn btn-warning">
                                                    <i class="icon-pencil"></i> Edit
                                                </a>
                                                <button type="submit" class="btn btn-danger">
                                                    <i class="icon-trash"></i> Delete
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <th>No. Transaction</th>
                                <th>Nama Penumpang</th>
                                <th>Nomor Telepon</th>
                                <th>Seat Number</th>
                                <th>Status</th>
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
    <script src="{{ asset('app-assets/vendors/js/jqBootstrapValidation.js') }}"></script>
    <script src="{{ asset('app-assets/vendors/js/datatable/datatables.min.js') }}"></script>
@endsection

@section('script')
    <script src="{{ asset('app-assets/js/form-validation.js') }}"></script>
    <script src="{{ asset('app-assets/js/data-tables/datatable-styling.js') }}"></script>
@endsection 