@extends('adminlte::page')

@section('title', 'Data Jabatan')

@section('content_header')
    <h1 class="m-0 text-dark">Data Jabatan</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header clearfix">
                    <h2 class="card-title mb-0"><strong>Table Data Jabatan</strong></h2>
                    <div class="card-tools">
                        <a href="{{ route('jabatan.create') }}" class="btn btn-primary btn-md">Tambah Jabatan</a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="jabatan-table" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>NO.</th>
                                    <th>NAMA JABATAN</th>
                                    <th>GAJI POKOK</th>
                                    <th>TUNJANGAN JABATAN</th>
                                    <th>UANG MAKAN PERHARI</th>
                                    <th class="text-center">AKSI</th>
                                </tr>
                            </thead>
                            <tbody>
                            @foreach ($jabatans as $jabatan)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $jabatan->nama_jabatan }}</td>
                                    <td>Rp {{ number_format($jabatan->gapok_jabatan, 0, ',', '.') }}</td>
                                    <td>Rp {{ number_format($jabatan->tunjangan_jabatan, 0, ',', '.') }}</td>
                                    <td>Rp {{ number_format($jabatan->uang_makan_perhari, 0, ',', '.') }}</td>
                                    <td class="text-center">
                                        <form action="{{ route('jabatan.destroy', $jabatan->id) }}" method="post" style="display: inline-block;">
                                            @method('DELETE')
                                            @csrf
                                            <a href="{{ route('jabatan.edit', $jabatan->id) }}" class="btn btn-md btn-warning">EDIT</a>
                                            <button type="submit" class="btn btn-md btn-danger" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">HAPUS</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop

@section('css')
    {{-- DataTables Bootstrap4 --}}
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap4.min.css">
@stop

@section('js')
    {{-- jQuery sudah tersedia di AdminLTE; tambahkan DataTables --}}
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap4.min.js"></script>
    <script>
        $(function () {
            $('#jabatan-table').DataTable({
                paging: true,
                searching: true,
                ordering: true,
                responsive: true,
                autoWidth: false,
                language: {
                    search: 'Cari:',
                    lengthMenu: 'Tampilkan _MENU_ data',
                    info: 'Menampilkan _START_ - _END_ dari _TOTAL_ data',
                    paginate: {
                        previous: 'Sebelumnya',
                        next: 'Berikutnya'
                    },
                    zeroRecords: 'Data tidak ditemukan'
                }
            });
        });
    </script>
@stop
