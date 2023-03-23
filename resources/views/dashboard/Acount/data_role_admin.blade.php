@extends('layoute.latoute')
@section('content')

@include('dashboard.Acount.create_role')
<div class="content-dashboard">

    <div class="header-content">
            <p class="text-tittle">
                Data Role Admin
            </p>
            {{--  <a href="{{ route('createRole') }}">  --}}
                <div class="button-create">
                        <img src="{{ asset('Assets/icon/🦆 icon _plus_-1.png') }}" alt="" srcset="">
                        <p>New Role</p>
                </div>
            {{--  </a>  --}}
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
                        <th class="header-row" style="width:200px">Nama Jabatan</th>
                        <th class="header-row" style="width: 411px;">Level</th>
                        <th class="header-row" style="width: 130px;">Action</th>
                </tr>
                @foreach ($role as $level )
                <tr class="body-table">
                    <td class="body-row">{{ $no++ }}</td>
                    <td class="body-row"><a href="#">{{ $level->nama_role }}</a></td>
                    <td class="body-row">{{ $level->level }}</td>
                    <td class="body-row">
                        <div class="action-btn">
                            <div class="btn-edit" data-id="{{ $level->id }}">
                                <img src="{{ asset('Assets/icon/icon _pencil_.png') }}" alt="">
                            </div>
                            <form action="{{route('DeleteRole', ($level->id))}}" method="POST">
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

    $(()=>{

        $('.btn-edit').on('click', function(e){
            e.stopPropagation();
            e.preventDefault();
            var id = $(this).attr('data-id');
            setform(id);
        })
        $('.close').on('click', function(){
            $('.container-popup-card-create').removeClass('show').addClass('close-hide');
            $('.card-create-customer.role').removeClass('show').addClass('close-hide');
        });

        $('.button-create').on('click', function(){

            $('.container-popup-card-create').removeClass('close-hide').addClass('show');
            $('.card-create-customer.role').removeClass('close-hide').addClass('show');
            $('.card-create-customer.role').find('.text-tittle').text('Create Data Role Admin');
        })

        $('.btn-save-form').on('click', function(){
            //e.stopPropagation();
            //e.preventDefault();
            postData()
        })

        function setform(id){
           var obj ={};

           obj["_token"] = "{{ csrf_token() }}";
		   obj['id'] = id;
           $.ajax({
                url: "{{route('edit.role')}}",
                data: obj,
                method : 'GET',
                success : function(result){
                    form(result.data);
                    console.log(data);
                }
            }).fail(function(data){
            console.log(data);
            });
        }

        function form(data){
            var $formSet = $('.form-card');
            $formSet.data('id', data.id);
            $formSet.find('.col-form-p-input.jabatan input').val(data.nama_role);
            $formSet.find('.col-form-p-input.level input').val(data.level);

            $('.container-popup-card-create').removeClass('close-hide').addClass('show');
            $('.card-create-customer.role').removeClass('close-hide').addClass('show');
        }

        function clearForm(){
            var $formSet = $('.form-card');
            $formSet.removeData('id');
            $formSet.find('.col-form-p-input.jabatan input').val('');
            $formSet.find('.col-form-p-input.level input').val('');
        }
        function postData(){
            var obj = {};
            var $formSet = $('.form-card');
            var id = $formSet.data('id');
            var role = $formSet.find('.col-form-p-input.jabatan input').val();
            var level =  $formSet.find('.col-form-p-input.level input').val();

            obj['nama_role'] = role;
            obj['level'] = level;
            obj["_token"] = "{{ csrf_token() }}";
            if(id){
				obj['id'] = id;
			}
            $.ajax({
				url: "{{route('post.role')}}",
				data: obj,
				method : 'POST',
				success : function(result){
					console.log('success', result);
					clearForm();
					$('.container-popup-card-create').removeClass('show').addClass('close-hide');
                    $('.card-create-customer.role').removeClass('show').addClass('close-hide');
					window.location.reload();
				}
			}).fail(function(data){
			   console.log(data);
			});
        }
    })
</script>
@stop
