<div class="sidebar">
    <div class="header">
        <div class="list-item">
            <a href="#" class="logo">
                <img src="{{ asset('Assets/image/logo_rounded.png') }}" alt="" class="logo-icon">
                <img src="{{ asset('Assets/image/sidebar_logo.png') }}" alt="" class="logo-des">
            </a>
        </div>
    </div>
    <div class="main-sidebar">
        <div class="list-item dashboard">
            <a href="{{ route('dashboard') }}">
                <img src="{{ asset('Assets/icon/home-blue.png') }}" alt="" class="icon-nan">
                <span class="name-item">Dashboard</span>
            </a>
        </div>
        <div class="dropdown" id="drdw">
            <div class="list-item">
                <img src="{{ asset('Assets/icon/icon _acount_.png') }}" alt="" class="icon-nan">
                <span class="name-item">Acount</span>
                <img src="{{ asset('Assets/icon/icon _chevron down.png') }}" alt="" id="icon-dw">
            </div>
            <div class="sub-menu off" id="sub-item">
                <a href="{{ route('dataUser') }}">
                    <div class="item-submenu">
                      Acount Admin
                    </div>
                </a>
                <a href="{{ route('dataRole') }}">
                    <div class="item-submenu">
                        Role Admin
                    </div>
                </a>

            </div>
        </div>
        <div class="dropdown" id="drdw">
            <div class="list-item">
                <img src="{{ asset('Assets/icon/icon _users_.png') }}" alt="" class="icon-nan">
                <span class="name-item">Group</span>
                <img src="{{ asset('Assets/icon/icon _chevron down.png') }}" alt="" id="icon-dw">
            </div>
            <div class="sub-menu off" id="sub-item">
                <a href="{{ route('dataGroup') }}">
                    <div class="item-submenu">
                      Group/Toko
                    </div>
                </a>
                <a href="{{ route('dataGroupMember') }}">
                    <div class="item-submenu">
                       Group Member
                    </div>
                </a>

            </div>
        </div>
        <div class="list-item">
            <a href="{{ route('purchase') }}">
                <img src="{{ asset('Assets/icon/🦆 icon _shopping cart_ blue.png') }}" alt="" class="icon-nan">
                <span class="name-item">Purchase</span>
            </a>
        </div>
        <div class="list-item">
            <a href="{{ route('sales') }}">
                <img src="{{ asset('Assets/icon/🦆 icon _tag_ blue.png') }}" alt="" class="icon-nan">
                <span class="name-item">Sales</span>
            </a>
        </div>
        <div class="list-item">
            <a href="#">
                <img src="{{ asset('Assets/icon/🦆 icon _clipboard list_ blue.png') }}" alt="" class="icon-nan">
                <span class="name-item">Laporan</span>
            </a>
        </div>
        <div class="list-item">
            <a href="#">
                <img src="{{ asset('Assets/icon/🦆 icon _book_ blue.png') }}" alt="" class="icon-nan">
                <span class="name-item">Jurnal</span>
            </a>
        </div>
        <div class="dropdown" id="drdw">
            <div class="list-item">
                <img src="{{ asset('Assets/icon/🦆 icon _archive_ blue.png') }}" alt="" class="icon-nan">
                <span class="name-item">Product</span>
                <img src="{{ asset('Assets/icon/icon _chevron down.png') }}" alt="" id="icon-dw">
            </div>
            <div class="sub-menu off" id="sub-item">
                <a href="{{ route('product') }}">
                    <div class="item-submenu">
                        Master Product
                    </div>
                </a>
                <a href="{{ route('Aliasproduct') }}">
                    <div class="item-submenu">
                        Product Alias
                    </div>
                </a>
                <a href="{{ route('jenisProduct') }}">
                    <div class="item-submenu">
                       Jenis Product
                    </div>
                </a>


            </div>
        </div>

        <div class="list-item">
            <a href="{{ route('delivery') }}">
                <img src="{{ asset('Assets/icon/icon _truck_.png') }}" alt="" class="icon-nan">
                <span class="name-item">Delivery Status</span>
            </a>
        </div>
        <div class="dropdown" id="drdw">
            <div class="list-item">
                {{--  {{ route('supplier') }}  --}}

                <img src="{{ asset('Assets/icon/🦆 icon _group_ blue.png') }}" alt="" class="icon-nan">
                <span class="name-item">Supplier</span>
                <img src="{{ asset('Assets/icon/icon _chevron down.png') }}" alt="" id="icon-dw">

            </div>
            <div class="sub-menu off" id="sub-item">
                <a href="{{ route('supplier') }}">
                    <div class="item-submenu">
                       Contact Detail
                    </div>
                </a>


            </div>
        </div>
        <div class="list-item">
            <a href="{{ route('customer') }}">
                <img src="{{ asset('Assets/icon/🦆 icon _contact_ blue.png') }}" alt="" class="icon-nan">
                <span class="name-item">Customer</span>
            </a>
        </div>
        <div class="list-item">
            <a href="#">
                <img src="{{ asset('Assets/icon/🦆 icon _list_ blue.png') }}" alt="" class="icon-nan">
                <span class="name-item">Daftar Akun</span>
            </a>
        </div>

        <div class="list-item">
            <a href="#">
                <img src="{{ asset('Assets/icon/🦆 icon _bank_ blue.png') }}" alt="" class="icon-nan">
                <span class="name-item">Kas/Bank</span>
            </a>
        </div>
    </div>
    <div class="footer-sidebar">
        <div class="illustration">
            <img src="{{ asset('Assets/image/FG1.png') }}" alt="" class="img-illustrasion">
        </div>
    </div>
</div>

<script>

$(()=>{
    const dropdown = $('.dropdown');
    dropdown.on('click', function(){
        $(this).find('.sub-menu').slideToggle("fast");
    })
})

</script>
