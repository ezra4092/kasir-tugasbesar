@if(Auth::user()->level == 'admin')
<li class="nav-item @if ($active == 'Kasir')
    {{'active'}}
@endif">
    <a class="nav-link" href="{{url('stok')}}">
        <i class="fa-solid fa-marker" style="color: black;"></i>
        <span class="text-dark">Stok Barang</span>
    </a>
</li>


<li class="nav-item @if ($title == 'Akun') {{ 'active' }} @endif">
    <a href="{{ url('datapetugas') }}" class="nav-link">
        <i class="fa-solid fa-user" style="color: black;"></i>
        <span class="text-dark">Data Petugas</span>
    </a>
</li>
@endif
