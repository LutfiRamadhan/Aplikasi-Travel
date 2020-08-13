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
                    <h4 class="card-title">Tambah Data Transaksi</h4>
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
                    <form action="{{ url('transaksi') }}" method="post" class="form-horizontal">
                        <div class="form-group row">
                            <label for="number_transaction" class="label-control col-md-3">
                                NO. TRANSAKSI :
                            </label>
                            <div class="col-md-9">
                                <input type="text" id="number_transaction" class="form-control" required data-validation-required-message="Nomor Transaksi harus diisi" value="{{ $no_transaksi }}" readonly>
                                <input type="hidden" id="no_transaction" name="no_transaction" class="form-control" required value="{{ $no_transaksi }}" readonly>
                                @if ($errors->first('no_transaction') != "")
                                    <div class="help-block">
                                        <ul role="alert">
                                            <li>{{ $errors->first('no_transaction') }}</li>
                                        </ul>
                                    </div>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="nama_penumpang" class="label-control col-md-3">
                                <input type="hidden" name="id_jadwal" required value="{{ $jadwal->id }}" readonly>
                                Nama Penumpang :
                            </label>
                            <div class="col-md-9">
                                <input type="text" id="nama_penumpang" name="nama_penumpang" class="form-control" required placeholder="Masukan Nama Penumpang" data-validation-required-message="Nama Penumpang harus diisi">
                                @if ($errors->first('nama_penumpang') != "")
                                    <div class="help-block">
                                        <ul role="alert">
                                            <li>{{ $errors->first('nama_penumpang') }}</li>
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
                                <input type="number" name="nomor_telepon" id="telepon" class="form-control" required data-validation-required-message="Nomor Telepon wajib diisi" placeholder="Masukan Nomor Telepon Anda" maxlength="13" minlength="9" data-validation-minlength-message="Nomor Telepon Minimal 9 Karakter Angka" data-validation-maxlength-message="Nomor Telepon Maximal 13 Karakter Angka">
                                @if ($errors->first('nomor_telepon') != "")
                                    <div class="help-block">
                                        <ul role="alert">
                                            <li>{{ $errors->first('nomor_telepon') }}</li>
                                        </ul>
                                    </div>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="seat_number" class="label-control col-md-3">
                                Seat Number :
                            </label>
                            <div class="col-md-9">
                                <select name="seat_number" id="seat_number" class="form-control" required data-validation-required-message="Seat Number harus diisi">
                                    <option value="" disabled selected>Pilih Seat Number</option>
                                    @foreach ($seat_number as $item)
                                        <option value="{{ $item }}">{{ $item }}</option>
                                    @endforeach
                                </select>
                                @if ($errors->first('seat_number') != "")
                                    <div class="help-block">
                                        <ul role="alert">
                                            <li>{{ $errors->first('seat_number') }}</li>
                                        </ul>
                                    </div>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="status" class="label-control col-md-3">
                                Status :
                            </label>
                            <div class="col-md-9">
                                <select name="status" id="status" class="form-control" required data-validation-required-message="Status harus diisi">
                                    <option value="" disabled selected>Pilih Status</option>
                                    @foreach ($status as $item)
                                        <option value="{{ $item }}">{{ $item }}</option>
                                    @endforeach
                                </select>
                                @if ($errors->first('status') != "")
                                    <div class="help-block">
                                        <ul role="alert">
                                            <li>{{ $errors->first('status') }}</li>
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
@endsection

@section('script')
    <script src="{{ asset('app-assets/js/form-validation.js') }}"></script>
@endsection 