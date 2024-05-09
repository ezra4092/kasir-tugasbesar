<li class="nav-link {{ $title == 'Produk' ? 'active' : '' }}">
    <a class="nav-link ml-3"  href="{{ route('dashboard') }}">
        <i class="fa-solid fa-layer-group" style="color: black;"></i>
        <span class="text-dark ml-2">Dashboard</span>
    </a>
    </li>

<li class="nav-link {{ $title == 'Produk' ? 'active' : '' }}">
<a class="nav-link ml-3"  href="{{ route('produk') }}">
    <i class="fa-solid fa-marker" style="color: black;"></i>
    <span class="text-dark ml-2">Stok Produk</span>
</a>
</li>

<li class="nav-link {{ $title == 'Penjualan' ? 'active' : '' }}">
<a class="nav-link ml-3" href="{{route('penjualan')}}">
    <i class="fa-solid fa-cash-register" style="color: black;"></i>
    <span class="text-dark ml-2">Kasir</span>
</a>
</li>


@if(Auth::user()->level == 'admin')
<li class="nav-link {{ $title == 'Produk' ? 'active' : '' }}">
<a class="nav-link ml-3" href="{{route('user')}}">
    <i class="fa-solid fa-user" style="color: black;"></i>
    <span class="text-dark ml-2">Data Petugas</span>
</a>
</li>
@endif
