@extends('adminlte::page')

@section('title', 'Data Jabatan Karyawan')

@section('content_header')
    <h1 class="m-0 text-dark">Data Jabatan Karyawan</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title"><strong>Tambah Data Jabatan Karyawan</strong></h3>
                </div>
                <div class="card-body">
                    @include('partials._error')
                    <form action="{{ route('jabatan-karyawan.store') }}" method="post">
                        @csrf
                        <div class="form-group row">
                            <label class="form-label col-sm-2">Nama Jabatan</label>
                            <div class="col-sm-4">
                                <select name="jabatan_id" class="form-control select2" required>
                                    <option value="" disabled selected>-- Pilih Jabatan --</option>
                                    @foreach ($jabatans as $jabatan)
                                        <option value="{{ $jabatan->id }}" {{ old('jabatan_id') == $jabatan->id ? 'selected' : '' }}>
                                            {{ $jabatan->nama_jabatan }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <label class="form-label col-sm-2">Nama Karyawan</label>
                            <div class="col-sm-4">
                                <select name="karyawan_id" class="form-control select2" required>
                                    <option value="" disabled selected>-- Pilih Karyawan --</option>
                                    @foreach ($karyawans as $karyawan)
                                        <option value="{{ $karyawan->id }}" {{ old('karyawan_id') == $karyawan->id ? 'selected' : '' }}>
                                            {{ $karyawan->nik }} - {{ $karyawan->nama_lengkap }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="form-label col-sm-2">Tanggal Mulai</label>
                            <div class="col-sm-4">
                                <input type="date" name="tanggal_mulai" class="form-control"
                                       value="{{ old('tanggal_mulai') }}" required>
                            </div>
                        </div>

                        <div class="card-footer text-center">
                            <button type="submit" class="btn btn-info" id="simpan">SIMPAN</button>
                            <a href="{{ route('jabatan-karyawan.index') }}" class="btn btn-danger">BATAL</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@stop

@section('js')
    <script>
        $(function () {
            $('.select2').select2({
                width: '100%',
                theme: 'bootstrap4'
            });
        });
    </script>
@stop
