@extends('layoute.latoute')
@section('content')
{{--  card-content  --}}
<div class="card-content-display">
    <div class="header-display">
        <p class="text-tittle">
          Edit Purchase
        </p>
    </div>
    <div class="head">
        <div class="part-head-left">
            <div class="vendor-selection">
                <label for="vendor">Vendor</label>
                <select name="" id="" placeholder="Select Vendor"></select>
            </div>
            <div class="purchase-type-selection">
                <label for="vendor">Purchase Type</label>
                <select name="" id="" placeholder="Select Purchase type"></select>
            </div>
        </div>
        <div class="part-head-right">
            <div class="Purchase-date">
                <label for="date-purchase">Purchase Date</label>
                <div class="filter-date">
                    <p>Date</p>
                    <img src="{{ asset('Assets/icon/🦆 icon _calendar_.png') }}" alt="" class="icon_calender" id="calender_cp">
                </div>
            </div>
            <div class="Purchase-date">
                <label for="date-purchase">PO Date</label>
                <div class="filter-date">
                    <p>Date</p>
                    <img src="{{ asset('Assets/icon/🦆 icon _calendar_.png') }}" alt="" class="icon_calender" id="calender_co">
                </div>
            </div>
            <div class="calender-purchase off">
                <div id="dycalendar-cp"></div>

            </div>
            <div class="calender-pO off">
                <div id="dycalendar-co"></div>

            </div>
        </div>
    </div>
    <div class="form-table">
        <table class="table-form">
            <tr class="header-table">
                 <th class="header-row" style="width:260px">Product</th>
                 <th class="header-row" style="width:317px">Description</th>
                 <th class="header-row" style="width:55px">Qty</th>
                 <th class="header-row" style="width:151px">Unit Price</th>
                 <th class="header-row">Tax</th>
                 <th class="header-row" style="width:150px">Amount</th>
                 <th class="header-row" style="display:none"></th>
            </tr>
            <tr class="body-table" >
                 <td class="body-row input-row">data</td>
                 <td class="body-row input-row">data</td>
                 <td class="body-row input-row">data</td>
                 <td class="body-row input-row">data</td>
                 <td class="body-row input-row">data</td>
                 <td class="body-row input-row">data</td>
                 <td class="body-row action-btn">
                    <div class="icon-plus">
                        <img src="{{ asset('Assets/icon/🦆 icon _plus_.png') }}" alt="" srcset="">
                    </div>
                    <div class="icon-delete">
                        <img src="{{ asset('Assets/icon/🦆 icon _trash_.png') }}" alt="" srcset="">
                    </div>
                 </td>
            </tr>
         </table>
         <div class="border-line"></div>
         <div class="border-line"></div>

         <div class="footer-form">
            <div class="f-from-l">
                <div class="catatan">
                    <label for="catatan">Catatan</label>
                    <textarea name="" id="" cols="50" rows="10"></textarea>
                 </div>
            </div>
            <div class="f-form-r">
                <div class="colum-total">
                    <p>Discount%</p>
                    <input type="text" class="f-input" placeholder="0">
                    <p>=</p>
                    <input type="text" class="f-hasil" placeholder="0">
                </div>
                <div class="colum-total" style="margin-left: 58px;">
                    <p>Tax</p>
                    <input type="text" class="f-input" placeholder="0">
                    <p>=</p>
                    <input type="text" class="f-hasil" placeholder="0">
                </div>
                <div class="colum-total" style="margin-left: 98px;">
                    <p>Total</p>
                    <p>=</p>
                    <input type="text" class="f-hasil" placeholder="0">
                </div>
            </div>
         </div>

         <div class="button-action-form">
            <div class="btn-save-form">Save</div>
            <div class="btn-cencel-form">Cancel</div>
         </div>
    </div>

</div>
@stop
@section('script')
<script>
    dycalendar.draw({
        target:'#dycalendar-cp',
        type:'month',
        dayformat: 'full',
        monthformat: 'full',
        highlighttargetdate: true,
        prevnextbutton: 'show'
    });
    dycalendar.draw({
        target:'#dycalendar-co',
        type:'month',
        dayformat: 'full',
        monthformat: 'full',
        highlighttargetdate: true,
        prevnextbutton: 'show'
    });

    const calendar_cp =   document.getElementById('calender_cp');
    const calendar_co =   document.getElementById('calender_co');
    const show_calendar_p = document.getElementsByClassName('calender-purchase')[0];
    const show_calendar_o = document.getElementsByClassName('calender-pO')[0];

    calendar_cp.addEventListener('click', function(){
        show_calendar_p.classList.toggle('off');
    });
    calendar_co.addEventListener('click', function(){
        show_calendar_o.classList.toggle('off');
    });

    $(()=>{
        $('.icon-plus').on('click', function(){
            var $content_ = $('.table-form');

			$content_.append(`<tr class="body-table">` +
                '<td class="body-row input-row">'+'</td>'+
                '<td class="body-row input-row">'+'</td>'+
                '<td class="body-row input-row">'+'</td>'+
                '<td class="body-row input-row">'+'</td>'+
                '<td class="body-row input-row">'+'</td>'+
                '<td class="body-row input-row">'+'</td>'+
                '<td class="body-row action-btn">'+
                    '<div class="icon-plus">'+
                        '<img src="{{ asset('Assets/icon/🦆 icon _plus_.png') }}" alt="" srcset="">'+
                    '</div>'+
                    '<div class="icon-delete">'+
                        '<img src="{{ asset('Assets/icon/🦆 icon _trash_.png') }}" alt="" srcset="">'+
                    '</div>'+

                '</td>'+
                '</tr>' );
        })

        $('.icon-delete').on('click', function(){
            var $elm = $('.body-table');
            var konfirmasi = confirm('yakin menghapus colume?');
			if(konfirmasi){
				$elm.remove();
			}
        })
    })


</script>
@stop
