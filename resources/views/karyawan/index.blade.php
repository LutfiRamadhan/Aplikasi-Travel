@extends('layouts.main')

@section('title', 'Karyawan')

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <div class="card-title-wrap bar-success">
                    <h4 class="card-title">Data Karyawan</h4>
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
                    <div class="col-md-12">
                        <a href="{{ url('karyawan/create') }}" class="btn btn-info shadow-z-1">
                            Tambah Karyawan
                        </a>
                        <table class="table table-striped table-bordered base-style">
                            <thead>
                                <th>Nama</th>
                                <th>NIK</th>
                                <th>Alamat</th>
                                <th>Tanggal Lahir</th>
                                <th>Jabatan</th>
                                <th>Telepon</th>
                                <th>Status</th>
                                <th>Action</th>
                            </thead>
                            <tbody>
                                @foreach ($karyawan as $item)
                                    <tr>
                                        <td>{{ $item->nama }}</td>
                                        <td>{{ $item->nik }}</td>
                                        <td>{{ $item->alamat }}</td>
                                        <td>{{ $item->tanggal_lahir }}</td>
                                        <td>{{ ucwords(str_replace('_', ' ', $item->jabatan)) }}</td>
                                        <td>{{ $item->telepon }}</td>
                                        <td>{{ $item->status }}</td>
                                        <td>
                                            <form action="{{ url('karyawan/'.$item->id) }}" method="post">
                                                @csrf
                                                @method('delete')
                                                <a href="{{ url('karyawan/'.$item->id.'/edit') }}" class="btn btn-warning">
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
                                <th>Nama</th>
                                <th>NIK</th>
                                <th>Alamat</th>
                                <th>Tanggal Lahir</th>
                                <th>Jabatan</th>
                                <th>Telepon</th>
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
    <script src="{{ asset('app-assets/vendors/js/datatable/datatables.min.js') }}"></script>
@endsection

@section('script')
    <script src="{{ asset('app-assets/js/data-tables/datatable-styling.js') }}"></script>
@endsection