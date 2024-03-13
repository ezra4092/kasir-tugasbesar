<li class="nav-item @if ($active == 'Stok')
{{'active'}}
@endif">
<a class="nav-link" href="{{url('stok')}}">
    <i class="fa-solid fa-marker" style="color: black;"></i>
    <span class="text-dark">Stok Penjualan</span>
</a>
</li>

<li class="nav-item @if ($active == 'Stok')
{{'active'}}
@endif">
<a class="nav-link" href="{{url('kasir')}}">
    <i class="fa-solid fa-cash-register" style="color: black;"></i>
    <span class="text-dark">Kasir</span>
</a>
</li>


@if(Auth::user()->level == 'admin')
<li class="nav-item @if ($active == 'Stok')
{{'active'}}
@endif">
<a class="nav-link" href="{{url('user')}}">
    <i class="fa-solid fa-user" style="color: black;"></i>
    <span class="text-dark">Data Petugas</span>
</a>
</li>
@endif
