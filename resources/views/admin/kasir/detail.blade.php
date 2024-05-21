
@extends('template.main')
@section('konten')
<div class="container-fluid">
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <div class="h3 mt-3 mb-2 ml-3 text-gray-800">Detail Penjualan</div>
            <p class="ml-4 mb-0">Kedai Dapur Bunda</p>
            <div class="row justify-content-end">
                    <p class="font-weight-bold mr-5">Nama Pelanggan : {{$pelanggan}}</p>

              </div>
        </div>
        <div class="row">
            <div class="col-9 d-flex justify-content-center">
                <button class="btn btn-outline-success w-50 mt-3 ml-4" data-toggle="modal" data-target="#pilihData"><i class="fa-solid fa-square-plus mt-1 ml-2 mr-2" style="font-size: 20px"></i></button>
            </div>
            <div class="col-3 d-flex justify-content-center">
                <button class="btn btn-outline-success w-50 mt-3 ml-4" data-toggle="modal" data-target="#bayar"><i class="fa-solid fa-money-bill-wave mt-1 ml-2 mr-2" style="font-size: 20px"></i></button>
            </div>
        </div>
        <div class="row">
            <div class="col-9">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-sm table-hover table-striped" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama Produk</th>
                                    <th>Harga</th>
                                    <th>Kuantitas</th>
                                    <th>Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php $no = 1; @endphp
                                @foreach ($data as $row)
                                <tr class="border-bottom mb-5">
                                    <td width="5%">{{$no++}}</td>
                                    <td>{{$row->produk->namaproduk}}</td>
                                    <td>Rp. {{number_format($row->produk->harga, 0, ',', '.')}}</td>
                                    <td>{{$row->jumlahproduk}}</td>
                                    <td>Rp. {{number_format($row->subtotal, 0, ',', '.')}}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        </div>
                    </div>
                </div>
                <div class="col-3 mt-3">
                    <div class="table-responsive">
                        <table class="table table-sm table-borderless">
                            <tr>
                                <td class="text-right">Total Harga : </td>
                                <td class="text-success fw-bold">Rp. {{number_format( $total, 0, ',', '.')  }}</td>
                            </tr>
                            <tr>
                                <td class="text-right">Bayar : </td>
                                <td class="text-primary">Rp. {{number_format( $dataPenjualan->jumPembayaran, 0, ',', '.')}}</td>
                            </tr>
                            <tr>
                                <td class="text-right">Kembalian : </td>
                                <td class="text-danger">Rp. {{$dataPenjualan->jumPembayaran == null ? '0' : number_format( $dataPenjualan->jumPembayaran - $total, 0, ',', '.')}}</td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>
</div>


{{-- modal bayar --}}
<div class="modal fade" id="bayar" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Pembayaran</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">x</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{route('bayar')}}" method="POST">
                    @csrf
                    <input type="hidden" name="idPenjualan" value="{{$dataPenjualan->idpenjualan}}">
                    <input type="hidden" name="total" value="{{$total}}">
                    <div class="form-group">
                        <label for="total">Total Harga</label>
                        <input type="input" class="form-control" id="total" name="total" value="{{ number_format($total, 0, ',', '.') }}" disabled>
                    </div>
                    <div class="form-group">
                        <label for="bayar">Bayar</label>
                        <input type="number" class="form-control" name="bayar" value="{{$dataPenjualan->jumPembayaran == null ? '0' : $dataPenjualan->jumPembayaran}}">
                    </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                <input type="submit" class="btn btn-primary" value="Bayar" name="simpan">
                </form>
            </div>
        </div>
    </div>
</div>

{{-- modal pilih produk --}}
<div class="modal fade" id="pilihData" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Pilih Produk</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">x</span>
                </button>
            </div>
            <div class="modal-body">
                <table class="table table-borderless mb-0">
                    <thead class="border-bottom">
                        <tr>
                             <th>Nama Produk</th>
                            <th>Harga</th>
                            <th>Stok</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($produk as $row)
                        <tr class="border-bottom">
                            <td>
                                <div class="fw-bold">{{ $row->namaproduk}}</div>
                            </td>
                            <td class="text-end fw-bold">{{number_format($row->harga, 0, ',', '.')}}</td>
                            <td class="text-end fw-bold">{{$row->stok}}</td>
                            <td class="text-end fw-bold">
                                <button class="btn btn-primary btn-sm" {{ $row->stok <= 0 ? 'disabled' : '' }} id="pilih" data-toggle="modal" data-target="#tambahModal{{ $row->idproduk }}" data-id="" data-nama="" data-harga="" data-stok="">Pilih</button>
                            </td>
                        </tr>

                        <div class="modal fade" id="tambahModal{{ $row->idproduk }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Tambah Produk</h5>
                                        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">x</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <form action="{{url('detailpenjualan/save')}}" method="POST">
                                            @csrf
                                            <input type="hidden" name="idproduk" value="{{ $row->idproduk }}">
                                            <input type="hidden" name="idPelanggan" value="{{ $idPelanggan }}">
                                            <div class="form-group">
                                                <label for="nama_cust">Nama Produk</label>
                                                <input type="input" class="form-control" id="nama_cust" name="nama_cust" value="{{ $row->namaproduk }}" readonly>
                                            </div>
                                            <div class="form-group">
                                                <label for="notelp">Harga</label>
                                                <input type="number" class="form-control" name="" value="{{ number_format($row->harga, 0, ',', '.') }}" readonly>
                                            </div>
                                            <div class="form-group">
                                                <label for="notelp">Stok Tersedia</label>
                                                <input type="number" class="form-control" id="" name="" value="{{ $row->stok }}" readonly>
                                            </div>
                                            <div class="form-group">
                                                <label for="notelp">Jumlah Yang Dibeli</label>
                                                <input type="number" class="form-control" name="stok">
                                            </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                                        <input type="submit" class="btn btn-primary" value="Simpan" name="simpan">
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                         @endforeach
                        </tbody>
                </table>
            </div>
            <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                </form>
            </div>
        </div>
    </div>
</div>


@endsection
@section('js')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
         $(document).on('click', '#pilih', function(e) {
            var id = $(this).attr("data-id");
            var nama = $(this).attr("data-nama");
            var harga = $(this).attr("data-harga");
            var stok = $(this).attr("data-stok");
            $('#id').val(id);
            $('#nama').val(nama);
            $('#harga').val(harga);
            $('#stok').val(stok);
        });
    </script>
@if(Session::get('error'))
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
        icon: 'error',
        title: 'Tidak Cukup'
    });
</script>
@endif
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>


@endsection
