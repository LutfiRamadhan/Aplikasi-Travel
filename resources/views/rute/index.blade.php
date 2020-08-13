@extends('layouts.main')

@section('title', 'Rute')

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <div class="card-title-wrap bar-success">
                    <h4 class="card-title">Data Rute</h4>
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
                        <a href="{{ url('rute/create') }}" class="btn btn-info shadow-z-1">
                            Tambah Rute
                        </a>
                        <table class="table table-striped table-bordered base-style">
                            <thead>
                                <th>Kota Asal</th>
                                <th>Kota Destinasi</th>
                                <th>Action</th>
                            </thead>
                            <tbody>
                                @foreach ($rute as $item)
                                    <tr>
                                        <td>{{ $item->kota_asal }}</td>
                                        <td>{{ $item->kota_destinasi }}</td>
                                        <td>
                                            <form action="{{ url('rute/'.$item->id) }}" method="post">
                                                @csrf
                                                @method('delete')
                                                <a href="{{ url('rute/'.$item->id.'/edit') }}" class="btn btn-warning">
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
                                <th>Kota Asal</th>
                                <th>Kota Destinasi</th>
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