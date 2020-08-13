@extends('layouts.main')

@section('title', 'Tambah Data Kendaraan')

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <div class="card-title-wrap bar-success">
                    <h4 class="card-title">Tambah Data Kendaraan</h4>
                </div>
                <p>Isilah Formulir dibawah ini dengan data kendaraan yang akan di simpan ke database</p>
            </div>
            <div class="card-body">
                <div class="card-block">
                    @if (session('error'))
                        <div class="alert alert-danger">
                            <strong>Error!</strong> {{ session('error') }}
                        </div>
                    @endif
                    <form action="{{ url('kendaraan') }}" method="post" class="form-horizontal">
                        <div class="form-group row">
                            <label for="merk" class="label-control col-md-3">
                                Merk Kendaraan :
                            </label>
                            <div class="col-md-9">
                                <input type="text" id="merk" name="merk" class="form-control" required placeholder="Masukan Merk Kendaraan Anda" data-validation-required-message="Merk Kendaraan harus diisi">
                                @if ($errors->first('merk') != "")
                                    <div class="help-block">
                                        <ul role="alert">
                                            <li>{{ $errors->first('merk') }}</li>
                                        </ul>
                                    </div>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="tipe_jenis" class="label-control col-md-3">
                                Tipe Jenis : 
                            </label>
                            <div class="col-md-9">
                                <input type="text" name="tipe_jenis" id="tipe_jenis" placeholder="Masukan Tipe Jenis Kendaraan Anda" class="form-control" required  data-validation-required-message="Tipe Jenis Kendaraan harus diisi">
                                @if ($errors->first('tipe_jenis') != "")
                                    <div class="help-block">
                                        <ul role="alert">
                                            <li>{{ $errors->first('tipe_jenis') }}</li>
                                        </ul>
                                    </div>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="plat_nomor" class="label-control col-md-3">
                                Plat Nomor :
                            </label>
                            <div class="col-md-9" style="position: relative">
                                <input type="text" name="plat_nomor" id="plat_nomor" class="form-control" required data-validation-required-message="Plat Nomor wajib diisi" placeholder="Masukan Plat Nomor Kendaraan">
                                @if ($errors->first('plat_nomor') != "")
                                    <div class="help-block">
                                        <ul role="alert">
                                            <li>{{ $errors->first('plat_nomor') }}</li>
                                        </ul>
                                    </div>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="kapasitas" class="label-control col-md-3">
                                Kapasitas : 
                            </label>
                            <div class="col-md-9">
                                <input type="number" name="kapasitas" id="kapasitas" class="form-control" required data-validation-min-message="Kapasitas Kendaraan Minimal 4" data-validation-min-message="Kapasitas Kendaraan Maximal 10" placeholder="Masukan Kapasitas Kendaraan" min="4" max="10">
                                @if ($errors->first('kapasitas') != "")
                                    <div class="help-block">
                                        <ul role="alert">
                                            <li>{{ $errors->first('kapasitas') }}</li>
                                        </ul>
                                    </div>
                                @endif
                            </div>
                        </div>
                        @csrf
                        @method('post')
                        <div class="form-group col-md-3 offset-md-4">
                            <button type="submit" class="btn btn-info btn-block">
                                Simpan Data
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        
    </div>
</div>
@endsection

@section('scriptpage')
    <script src="{{ asset('app-assets/vendors/js/jqBootstrapValidation.js') }}"></script>
    <script src="{{ asset('app-assets/vendors/js/pickadate/picker.js') }}"></script>
    <script src="{{ asset('app-assets/vendors/js/pickadate/picker.date.js') }}"></script>
    <script src="{{ asset('app-assets/vendors/js/pickadate/picker.time.js') }}"></script>
    {{-- <script src="{{ asset('app-assets/vendors/js/pickadate/legacy.js') }}"></script> --}}
@endsection

@section('script')
<script src="{{ asset('app-assets/js/form-validation.js') }}"></script>
    {{-- <script src="{{ asset('app-assets/js/pick-a-datetime.js') }}"></script> --}}
    <script>
        $(document).ready(function(){
            // $('.pickadate-limits').pickadate()
        })
    </script>
@endsection 