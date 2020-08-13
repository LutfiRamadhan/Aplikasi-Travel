@extends('layouts.main')

@section('title', 'Users')

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <div class="card-title-wrap bar-success">
                    <h4 class="card-title">Data Users</h4>
                </div>
            </div>
            <div class="card-body">
                <div class="card-block">
                    <a href="url('users/create')" class="btn btn-info shadow-z-1">
                        Tambah User
                    </a>
                    <table class="table table-striped table-hover table-bordered">
                        <thead>
                            <th>Nama</th>
                            <th>Username</th>
                            <th>Email</th>
                            <th>Jabatan</th>
                            <th>Action</th>
                        </thead>
                        <tbody>
                            @foreach ($users as $item)
                                <tr>
                                    <td>{{ $item->nama }}</td>
                                    <td>{{ $item->username }}</td>
                                    <td>{{ $item->email }}</td>
                                    <td>{{ $item->jabatan }}</td>
                                    <td>{{ $item->status }}</td>
                                    <td>
                                        <a href="{{ url('users/edit/{$item->id}') }}" class="btn btn-warning">
                                            <i class="icon-pencil"></i> Edit
                                        </a>
                                        <a href="{{ url('users/delete/{$item->id}') }}" class="btn btn-danger">
                                            <i class="icon-pencil"></i> Delete
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <th>Nama</th>
                            <th>Username</th>
                            <th>Email</th>
                            <th>Jabatan</th>
                            <th>Action</th>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
        
    </div>
</div>
@endsection