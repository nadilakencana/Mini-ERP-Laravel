@extends('layoute.latoute')
@section('content')

{{--  @include('dashboard.part-lain.popUp_Create_customer')  --}}
<div class="content-dashboard">
    {{--  <div class="navigation-tab">
        <div class="nav-tab active" target-panel="panel1" order="1">Customer</div>
        <div class="nav-tab" target-panel="panel2" order="2">Detail Contact</div>
    </div>  --}}

    <div class="header-content">
            <p class="text-tittle">
                Data Group Member
            </p>
            <a href="{{ route('createGroupMember') }}">
                <div class="button-create">
                        <img src="{{ asset('Assets/icon/🦆 icon _plus_-1.png') }}" alt="" srcset="">
                        <p>New Member</p>
                </div>
            </a>
    </div>
    {{--  card-content  --}}
    <div class="card-content-display">
            <div class="header-display">
                <div class="box-search">
                    <div class="icon-search">
                        <img src="{{ asset('Assets/icon/🦆 icon _search_.png') }}" alt="" srcset="">
                    </div>
                    <p>Search</p>
                </div>
                <div class="button-section-display">
                    <div class="btn-import">
                        <img src="{{ asset('Assets/icon/🦆 icon _cloud download_.png') }}" alt="">
                        <p>Import</p>
                    </div>
                    <div class="btn-export">
                        <img src="{{ asset('Assets/icon/🦆 icon _account logout_.png') }}" alt="">
                        <p>Export</p>
                    </div>
                    <form action="">
                        <div class="Purchase-date">
                            <input type="date" name="date" id="date_po">
                        </div>
                    </form>
                </div>
            </div>
            <div class="table-data">
                @php $no=1; @endphp
                <table>
                <tr class="header-table">
                        <th class="header-row" >No</th>
                        <th class="header-row" style="width:200px">Group/Toko</th>
                        <th class="header-row" style="width: 411px;">Nama Admin</th>
                        <th class="header-row" style="width: 130px;">Action</th>
                </tr>
                @foreach ($member as $gpM )
                <tr class="body-table">
                    <td class="body-row">{{ $no++ }}</td>
                    <td class="body-row">{{ $gpM->group->nama_toko}}</td>
                    <td class="body-row">{{ $gpM->user->nama}}</td>
                    <td class="body-row">
                        <div class="action-btn">
                            <a href="{{ route('edit_member', encrypt($gpM->id)) }}">
                                <div class="btn-edit">
                                    <img src="{{ asset('Assets/icon/icon _pencil_.png') }}" alt="">
                                </div>
                            </a>
                            <form action="{{route('deleteMemeber', ($gpM->id))}}" method="POST">
                                @csrf
                                @method('delete')
                                <button type="submit">
                                    <div class="btn-delete">
                                        <img src="{{ asset('Assets/icon/icon _trash_.png') }}" alt="">
                                    </div>
                                </button>

                            </form>
                        </div>

                    </td>
            </tr>
                @endforeach

                </table>

                <div class="footer-table">
                    <div class="data-total">Showing 1-10 entries</div>
                    <div class="pagination"></div>
                </div>

            </div>
    </div>


</div>
@stop

@section('script')
<script>

</script>
@stop
