@extends('template.main')
@section('konten')
<div class="container-fluid">
    <h1 class="h3 mb-2 text-gray-800">Data Pelanggan</h1>
    <p class="mb-4">Kedai Dapur Bunda</p>
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">
                <button class="btn btn-sm btn-primary float-right" data-toggle="modal" data-target="#tambahData"><i class="fa-solid fa-square-plus mt-1 ml-2 mr-2" style="font-size: 20px"></i></button>
            </h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-sm table-hover table-striped" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Pelanggan</th>
                            <th>Alamat</th>
                            <th>Nomor Telepon</th>
                            <th>Total Harga</th>
                            @if(Auth::user()->level == 'admin')
                            <th>Aksi</th>
                            @endif
                            @if(Auth::user()->level == 'petugas')
                            <th>Aksi</th>
                            @endif
                        </tr>
                    </thead>
                    <tbody>
                        @php $no = 1; @endphp
                        @foreach ($data as $row)
                        <tr>
                            <td width="5%">{{$no++}}</td>
                            <td>{{$row->namacust}}</td>
                            <td>{{$row->alamat}}</td>
                            <td>{{$row->notelp}}</td>
                            <td>{{$row->penjualan->sum('totalharga')}}</td>
                            @if(Auth::user()->level == 'admin')
                            <td class="row" width="80%">
                                <a href="/detailpenjualan/{{ $row->idpelanggan }}"  class="btn btn-sm btn-success fa-solid fa-cart-shopping mr-1"></a>
                                <button class="btn btn-sm btn-warning fa-solid fa-pen-to-square mr-2" data-toggle="modal" data-target="#editData{{$row->id}}"></button>
                                <form action="{{route('cust-delete')}}" method="POST">
                                    <input type="hidden" name="idpelanggan" value="{{ $row->idpelanggan }}">
                                    @csrf
                                    <button type="submit" class="btn btn-sm btn-danger fa-solid fa-trash-can mr-2" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')"></button>
                                </form>
                            </td>
                            @endif
                            @if(Auth::user()->level == 'petugas')
                            <td>
                                <a href="/detailpenjualan/{{ $row->idpelanggan }}"  class="btn btn-sm btn-success fa-solid fa-cart-shopping mr-1"></a>
                            </td>
                            @endif
                        </tr>
                        <div class="modal fade" id="editData{{$row->id}}" tabindex="-1" role="dialog" aria-labelledby="editDataLabel{{$row->id}}" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Edit Cust</h5>
                                        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">x</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <form action="{{ route('cust-edit') }}" method="POST">
                                            <input type="hidden" name="idpelanggan" value="{{ $row->idpelanggan }}">
                                            @csrf
                                            <div class="form-group">
                                                <label for="namacust">Nama Pelanggan</label>
                                                <input type="input" class="form-control" id="namacust" name="namacust" value="{{$row->namacust}}">
                                            </div>
                                            <div class="form-group">
                                                <label for="alamat">Alamat</label>
                                                <textarea name="alamat" class="form-control" id="alamat" cols="30" rows="2" value="{{$row->alamat}}"></textarea>
                                            </div>
                                            <div class="form-group">
                                                <label for="notelp">No Telp</label>
                                                <input type="number" class="form-control" id="notelp" name="notelp" value="{{$row->notelp}}">
                                            </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button class="btn btn-secondary" type="button" data-dismiss="modal">Batal</button>
                                        <button type="submit" class="btn btn-primary">Simpan</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

{{-- modal tambah --}}
<div class="modal fade" id="tambahData" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Tambah Data</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">x</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{route('cust-save')}}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="namacust">Nama Pelanggan</label>
                        <input type="input" class="form-control" id="namacust" name="namacust" >
                    </div>
                    <div class="form-group">
                        <label for="alamat">Alamat</label>
                        <textarea name="alamat" id="alamat" cols="30" rows="2" class="form-control" ></textarea>
                    </div>
                    <div class="form-group">
                        <label for="notelp">No Telp</label>
                        <input type="number" class="form-control" id="notelp" name="notelp" >
                    </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">Batal</button>
                <input type="submit" class="btn btn-primary" value="Simpan" name="simpan">
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
@section('js')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
@if ($message = Session::get('dataTambah'))
<script>
   const Toast = Swal.mixin({
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 3000,
        timerProgressBar: true,
        didOpen: (toast) => {
            toast.addEventListener('mouseenter', Swal.stopTimer);
            toast.addEventListener('mouseleave', Swal.resumeTimer);
        }
    })
    Toast.fire({
        icon: 'success',
        title: 'Data berhasil ditambahkan'
    });
</script>
@endif
@if ($message = Session::get('dataDelete'))
<script>
   const Toast = Swal.mixin({
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 3000,
        timerProgressBar: true,
        didOpen: (toast) => {
            toast.addEventListener('mouseenter', Swal.stopTimer);
            toast.addEventListener('mouseleave', Swal.resumeTimer);
        }
    })
    Toast.fire({
        icon: 'success',
        title: 'Data berhasil dihapus'
    });
</script>
@endif
@if ($message = Session::get('dataEdit'))
<script>
   const Toast = Swal.mixin({
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 3000,
        timerProgressBar: true,
        didOpen: (toast) => {
            toast.addEventListener('mouseenter', Swal.stopTimer);
            toast.addEventListener('mouseleave', Swal.resumeTimer);
        }
    })
    Toast.fire({
        icon: 'success',
        title: 'Data berhasil diedit'
    });
</script>
@endif
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

{{-- <script>
    function printTable(row) {
        var nama = row.querySelector('td:nth-child(2)').innerText.trim();
        var tgl_bayar = row.querySelector('td:nth-child(3)').innerText.trim();
        var jumlah = row.querySelector('td:nth-child(4)').innerText.trim();

        var newWin = window.open('', 'Print-Window');
        newWin.document.open();
        newWin.document.write('<html><head><title>Laporan</title></head><body>');

        newWin.document.write('<h1>Laporan Pembayaran SPP</h1>');
        newWin.document.write('<p>Nama Siswa         : ' + nama + '</p>');
        newWin.document.write('<p>Tanggal Pembayaran : ' + tgl_bayar + '</p>');
        newWin.document.write('<p>Jumlah             : ' + jumlah + '</p>');
        newWin.document.write('<hr>');

        newWin.document.write('</body></html>');
        newWin.document.close();
        newWin.print();
        setTimeout(function () { newWin.close(); }, 10);
    }
</script> --}}

@endsection
