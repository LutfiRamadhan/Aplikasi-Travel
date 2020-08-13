@extends('layouts.main')

@section('title', 'Tambah Data Karyawan')

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <div class="card-title-wrap bar-success">
                    <h4 class="card-title">Tambah Data Karyawan</h4>
                </div>
                <p>Isilah Formulir dibawah ini dengan data karyawan yang akan di simpan ke database</p>
            </div>
            <div class="card-body">
                <div class="card-block">
                    @if (session('error'))
                        <div class="alert alert-danger">
                            <strong>Error!</strong> {{ session('error') }}
                        </div>
                    @endif
                    <form action="{{ url('karyawan') }}" method="post" class="form-horizontal">
                        <div class="form-group row">
                            <label for="nama" class="label-control col-md-3">
                                Nama Lengkap :
                            </label>
                            <div class="col-md-9">
                                <input type="text" id="nama" name="nama" class="form-control" required placeholder="Masukan Nama Lengkap Anda" data-validation-required-message="Nama Lengkap harus diisi">
                                @if ($errors->first('nama') != "")
                                    <div class="help-block">
                                        <ul role="alert">
                                            <li>{{ $errors->first('nama') }}</li>
                                        </ul>
                                    </div>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="email" class="label-control col-md-3">
                                E-Mail :
                            </label>
                            <div class="col-md-9">
                                <input type="text" id="email" name="email" class="form-control" required placeholder="Masukan E-Mail Anda" data-validation-required-message="E-Mail harus diisi">
                                @if ($errors->first('email') != "")
                                    <div class="help-block">
                                        <ul role="alert">
                                            <li>{{ $errors->first('email') }}</li>
                                        </ul>
                                    </div>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="password" class="label-control col-md-3">
                                Password :
                            </label>
                            <div class="col-md-9">
                                <input type="password" id="password" name="password" class="form-control" required placeholder="Masukan Password Anda" data-validation-required-message="Password harus diisi">
                                @if ($errors->first('password') != "")
                                    <div class="help-block">
                                        <ul role="alert">
                                            <li>{{ $errors->first('password') }}</li>
                                        </ul>
                                    </div>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="confirm_password" class="label-control col-md-3">
                                Confirm Password : 
                            </label>
                            <div class="col-md-9">
                                <input type="password" name="password_confirmation" id="confirm_password" placeholder="Masukan Password Confirmation Anda" class="form-control" required data-validation-required-message="Password harus diisi">
                                @if ($errors->first('confirm_password') != "")
                                    <div class="help-block">
                                        <ul role="alert">
                                            <li>{{ $errors->first('confirm_password') }}</li>
                                        </ul>
                                    </div>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="nik" class="label-control col-md-3">
                                NIK : 
                            </label>
                            <div class="col-md-9">
                                <input type="number" name="nik" id="nik" placeholder="Masukan NIK Anda" class="form-control" required minlength="16" maxlength="16" data-validation-maxlength-message="NIK harus 16 karakter" data-validation-minlength-message="NIK harus 16 karakter">
                                @if ($errors->first('nik') != "")
                                    <div class="help-block">
                                        <ul role="alert">
                                            <li>{{ $errors->first('nik') }}</li>
                                        </ul>
                                    </div>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="alamat" class="label-control col-md-3">
                                Alamat : 
                            </label>
                            <div class="col-md-9">
                                <textarea name="alamat" id="alamat" row="2" class="form-control" required placeholder="Alamat" data-validation-required-message="Alamat harus diisi"></textarea>
                                @if ($errors->first('alamat') != "")
                                    <div class="help-block">
                                        <ul role="alert">
                                            <li>{{ $errors->first('alamat') }}</li>
                                        </ul>
                                    </div>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="tanggal_lahir" class="label-control col-md-3">
                                Tanggal Lahir :
                            </label>
                            <div class="col-md-9">
                                <input type="date" name="tanggal_lahir" id="tanggal_lahir" class="form-control" required data-validation-required-message="Tanggal Lahir wajib diisi" placeholder="Masukan Tanggal Lahir Anda" min="{{ date('Y-m-d', strtotime('-30 year')) }}" max="{{ date('Y-m-d', strtotime('-17 year')) }}">
                                @if ($errors->first('tanggal_lahir') != "")
                                    <div class="help-block">
                                        <ul role="alert">
                                            <li>{{ $errors->first('tanggal_lahir') }}</li>
                                        </ul>
                                    </div>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="jabatan" class="label-control col-md-3">
                                Jabatan :
                            </label>
                            <div class="col-md-9">
                                <select name="jabatan" id="jabatan" class="form-control" required data-validation-required-message="Jabatan harus diisi">
                                    <option value="" disabled selected>Pilih Jabatan</option>
                                    @foreach ($jabatan as $item)
                                        <option value="{{ $item }}">{{ ucwords(str_replace('_', ' ', $item)) }}</option>
                                    @endforeach
                                </select>
                                @if ($errors->first('jabatan') != "")
                                    <div class="help-block">
                                        <ul role="alert">
                                            <li>{{ $errors->first('jabatan') }}</li>
                                        </ul>
                                    </div>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="telepon" class="label-control col-md-3">
                                Nomor Telepon :
                            </label>
                            <div class="col-md-9">
                                <input type="number" name="telepon" id="telepon" class="form-control" required data-validation-required-message="Nomor Telepon wajib diisi" placeholder="Masukan Nomor Telepon Anda" maxlength="13" minlength="9" data-validation-minlength-message="Nomor Telepon Minimal 9 Karakter Angka" data-validation-maxlength-message="Nomor Telepon Maximal 13 Karakter Angka">
                                @if ($errors->first('telepon') != "")
                                    <div class="help-block">
                                        <ul role="alert">
                                            <li>{{ $errors->first('telepon') }}</li>
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