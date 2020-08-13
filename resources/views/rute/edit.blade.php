@extends('layouts.main')

@section('title', 'Tambah Data Rute')

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <div class="card-title-wrap bar-success">
                    <h4 class="card-title">Edit Data Rute {{ $rute->kota_asal . ' - ' . $rute->kota_destinasi }}</h4>
                </div>
                <p>Ubah Isi Formulir dibawah ini dengan data rute yang baru</p>
            </div>
            <div class="card-body">
                <div class="card-block">
                    @if (session('error'))
                        <div class="alert alert-danger">
                            <strong>Error!</strong> {{ session('error') }}
                        </div>
                    @endif
                    <form action="{{ url('rute/'.$rute->id) }}" method="post" class="form-horizontal">
                        <div class="form-group row">
                            <label for="rute" class="label-control col-md-3">
                                Kota Asal :
                            </label>
                            <div class="col-md-9">
                                <input type="text" id="kota_asal" name="kota_asal" class="form-control" required placeholder="Masukan Kota Asal" data-validation-required-message="Kota Asal harus diisi" value="{{ $rute->kota_asal }}">
                                @if ($errors->first('kota_asal') != "")
                                    <div class="help-block">
                                        <ul role="alert">
                                            <li>{{ $errors->first('kota_asal') }}</li>
                                        </ul>
                                    </div>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="kota_destinasi" class="label-control col-md-3">
                                Kota Destinasi : 
                            </label>
                            <div class="col-md-9">
                                <input type="text" name="kota_destinasi" id="kota_destinasi" placeholder="Masukan Kota Destinasi" class="form-control" required  data-validation-required-message="Kota Destinasi harus diisi" value="{{ $rute->kota_destinasi }}">
                                @if ($errors->first('kota_destinasi') != "")
                                    <div class="help-block">
                                        <ul role="alert">
                                            <li>{{ $errors->first('kota_destinasi') }}</li>
                                        </ul>
                                    </div>
                                @endif
                            </div>
                        </div>
                        @csrf
                        @method('put')
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