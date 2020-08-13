@extends('layouts.main')

@section('title', 'Jadwal')

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <div class="card-title-wrap bar-success">
                    <h4 class="card-title">Data Jadwal</h4>
                </div>
            </div>
            <div class="card-body">
                <div class="card-block">
                    @if (session('success'))
                        <div class="col-md-12">
                            <div class="alert alert-success">
                                <strong>Success!</strong> {{ session('success') }}
                            </div>
                        </div>
                    @endif
                    @if (session('error'))
                        <div class="col-md-12">
                            <div class="alert alert-danger">
                                <strong>Error!</strong> {{ session('error') }}
                            </div>
                        </div>
                    @endif
                    <a href="{{ url('jadwal/create') }}" class="btn btn-info shadow-z-1">
                        Tambah Jadwal
                    </a>
                    <table class="table table-striped table-bordered table-hover base-style">
                        <thead>
                            <th>Tanggal</th>
                            <th>Jam Berangkat</th>
                            <th>Perkiraan Tiba</th>
                            <th>Rute</th>
                            <th>Kendaraan</th>
                            <th>Supir</th>
                            <th>Harga</th>
                            <th>Action</th>
                        </thead>
                        <tbody>
                            @foreach ($jadwal as $item)
                                <tr>
                                    <td>{{ date('d F Y', strtotime($item->tanggal)) }}</td>
                                    <td>{{ $item->jam_berangkat }}</td>
                                    <td>{{ $item->perkiraan_tiba }}</td>
                                    <td>{{ $item->rute->kota_asal.' - '.$item->rute->kota_destinasi }}</td>
                                    <td>{{ $item->kendaraan->merk.' - '.$item->kendaraan->tipe_jenis }}</td>
                                    <td>{{ $item->supir->nama }}</td>
                                    <td>{{ number_format($item->harga, 0, ',', '.') }}</td>
                                    <td>
                                        <form action="{{ url('jadwal/'.$item->id) }}" method="post">
                                            @csrf
                                            @method('delete')
                                            @if (date('Y-m-d') <= $item->tanggal)
                                                <a href="{{ url('jadwal/'.$item->id.'/edit') }}" class="btn btn-warning">
                                                    <i class="icon-pencil"></i> Edit
                                                </a>
                                            @endif
                                            <button type="submit" class="btn btn-danger">
                                                <i class="icon-pencil"></i> Delete
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <th>Tanggal</th>
                            <th>Jam Berangkat</th>
                            <th>Perkiraan Tiba</th>
                            <th>Rute</th>
                            <th>Kendaraan</th>
                            <th>Supir</th>
                            <th>Harga</th>
                            <th>Action</th>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
        
    </div>
</div>
@endsection