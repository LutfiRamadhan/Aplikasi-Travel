@extends('layouts.main')

@section('title', 'Tambah Data Kendaraan')

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <div class="card-title-wrap bar-success">
                    <h4 class="card-title">Tambah Data Jadwal</h4>
                </div>
                <p>Isilah Formulir dibawah ini dengan data jadwal yang akan di simpan ke database</p>
            </div>
            <div class="card-body">
                <div class="card-block">
                    @if (session('error'))
                        <div class="alert alert-danger">
                            <strong>Error!</strong> {{ session('error') }}
                        </div>
                    @endif
                    <form action="{{ url('jadwal') }}" method="post" class="form-horizontal">
                        <div class="form-group row">
                            <label for="tanggal" class="label-control col-md-3">
                                Tanggal :
                            </label>
                            <div class="col-md-9">
                                <input type="date" id="tanggal" name="tanggal" class="form-control" required placeholder="Masukan Tanggal" data-validation-required-message="Tanggal harus diisi" value="{{ date('Y-m-d') }}" min="{{ date('Y-m-d') }}" max="{{ date('Y-m-d', strtotime('+7 day')) }}">
                                @if ($errors->first('tanggal') != "")
                                    <div class="help-block">
                                        <ul role="alert">
                                            <li>{{ $errors->first('tanggal') }}</li>
                                        </ul>
                                    </div>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="jam_berangkat" class="label-control col-md-3">
                                Jam Berangkat :
                            </label>
                            <div class="col-md-9">
                                <input type="time" id="jam_berangkat" name="jam_berangkat" class="form-control" required placeholder="Masukan Jam berangkat" data-validation-required-message="Jam berangkat harus diisi">
                                @if ($errors->first('jam_berangkat') != "")
                                    <div class="help-block">
                                        <ul role="alert">
                                            <li>{{ $errors->first('jam_berangkat') }}</li>
                                        </ul>
                                    </div>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="perkiraan_tiba" class="label-control col-md-3">
                                Perkiraan Tiba : 
                            </label>
                            <div class="col-md-9">
                                <input type="time" name="perkiraan_tiba" id="perkiraan_tiba" placeholder="Masukan Perkiraan Tiba" class="form-control" required  data-validation-required-message="Perkiraan Tiba harus diisi">
                                @if ($errors->first('perkiraan_tiba') != "")
                                    <div class="help-block">
                                        <ul role="alert">
                                            <li>{{ $errors->first('perkiraan_tiba') }}</li>
                                        </ul>
                                    </div>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="rute" class="label-control col-md-3">
                                Rute :
                            </label>
                            <div class="col-md-9">
                                <select name="id_rute" id="rute" class="form-control" required data-validation-required-message="Rute harus dipilih">
                                    <option value="" disabled selected>Pilih Rute</option>
                                    @foreach ($rute as $item)
                                        <option value="{{ $item->id }}">{{ $item->kota_asal . ' - ' . $item->kota_destinasi }}</option>
                                    @endforeach
                                </select>
                                @if ($errors->first('rute') != "")
                                    <div class="help-block">
                                        <ul role="alert">
                                            <li>{{ $errors->first('rute') }}</li>
                                        </ul>
                                    </div>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="kendaraan" class="label-control col-md-3">
                                Kendaraan : 
                            </label>
                            <div class="col-md-9">
                                <select name="id_kendaraan"  id="kendaraan" class="form-control" required data-validation-required-message="Kendaraan harus dipilih">
                                    <option value="" disabled selected>Pilih Kendaraan</option>
                                    @foreach ($kendaraan as $item)
                                        <option value="{{ $item->id }}">{{ $item->merk . ' - ' . $item->tipe_jenis }}</option>
                                    @endforeach
                                </select>
                                @if ($errors->first('id_kendaraan') != "")
                                    <div class="help-block">
                                        <ul role="alert">
                                            <li>{{ $errors->first('id_kendaraan') }}</li>
                                        </ul>
                                    </div>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="supir" class="label-control col-md-3">
                                Supir :
                            </label>
                            <div class="col-md-9">
                                <select name="id_supir" id="supir" class="form-control" required data-validation-required-message="Supir harus dipilih">
                                    <option value="" disabled selected>Pilih Supir</option>
                                    @foreach ($supir as $item)
                                        <option value="{{ $item->id }}">{{ $item->nama }}</option>
                                    @endforeach
                                </select>
                                @if ($errors->first('id_supir') != "")
                                    <div class="help-block">
                                        <ul role="alert">
                                            <li>{{ $errors->first('id_supir') }}</li>
                                        </ul>
                                    </div>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="harga" class="label-control col-md-3">
                                Harga :
                            </label>
                            <div class="col-md-9">
                                <input type="number" id="harga" name="harga" class="form-control" required placeholder="Masukan Harga" data-validation-required-message="Harga harus diisi" min="50000" max="1000000">
                                @if ($errors->first('harga') != "")
                                    <div class="help-block">
                                        <ul role="alert">
                                            <li>{{ $errors->first('harga') }}</li>
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
@endsection 