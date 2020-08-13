@extends('layouts.main')

@section('title', 'Kendaraan')

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <div class="card-title-wrap bar-success">
                    <h4 class="card-title">Data Kendaraan</h4>
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
                        <a href="{{ url('kendaraan/create') }}" class="btn btn-info shadow-z-1">
                            Tambah Kendaraan
                        </a>
                        <table class="table table-striped table-bordered base-style">
                            <thead>
                                <th>Merk</th>
                                <th>Tipe Jenis</th>
                                <th>Status</th>
                                <th>Plat Nomor</th>
                                <th>Kapasitas</th>
                                <th>Action</th>
                            </thead>
                            <tbody>
                                @foreach ($kendaraan as $item)
                                    <tr>
                                        <td>{{ $item->merk }}</td>
                                        <td>{{ $item->tipe_jenis }}</td>
                                        <td>{{ $item->status }}</td>
                                        <td>{{ $item->plat_nomor }}</td>
                                        <td>{{ $item->kapasitas }}</td>
                                        <td>
                                            <form action="{{ url('kendaraan/'.$item->id) }}" method="post">
                                                @csrf
                                                @method('delete')
                                                <a href="{{ url('kendaraan/'.$item->id.'/edit') }}" class="btn btn-warning">
                                                    <i class="icon-pencil"></i> Edit
                                                </a>
                                                <button type="submit" class="btn btn-danger">
                                                    <i class="icon-pencil"></i> Delete
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <th>Merk</th>
                                <th>Tipe Jenis</th>
                                <th>Status</th>
                                <th>Plat Nomor</th>
                                <th>Kapasitas</th>
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