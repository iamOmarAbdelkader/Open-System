@extends('layout.app')
@section('title','مرتجع الي مورد')
@section('sub-title','اضافة')
@section('content') 
    <div class="row">
        <div class="col-md-12">
          <!-- general form elements -->
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title"> اضافة </h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form role="form" class="validate" action="{{route('return-orders-out.store',$order)}}" method="POST" enctype="multipart/form-data">
            {{csrf_field()}}
            <input type="hidden" name="items" id="items">
            <input type="hidden" name="order_id" id="order_id" value="{{$order->id}}">
              <div class="box-body">

                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="no">رقم الفاتورة</label>
                      <input type="text"  required class="form-control" name="no" id="no">
                    </div>
    
                  </div>

                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="date">التاريخ </label>
                      <input type="text"  required class="form-control date" name="date" id="date">
                    </div>
                  </div>


                </div>

                  <div class="row">
                        <div class="col-md-6">
                          <div class="form-group">
                            <label for="vat">ضريبة القيمة المضافة</label>
                            <input type="text"  value="14" required class="form-control observe" name="vat" id="vat">
                          </div>
                        </div>
                        <div class="col-md-6">
                                <div class="form-group">
                                  <label for="discount">الخصم</label>
                                  <input type="text" value="0" required class="form-control observe" name="discount" id="discount">
                                </div>
                            </div>
                      </div>
                      <div class="row">
                            <div class="col-md-6">
                                    <div class="form-group">
                                      <label for="total">الاجمالي</label>
                                      <input type="text"  readonly required class="form-control" name="total" id="total">
                                    </div>
                            </div>
                            <div class="col-md-6">
                              <div class="form-group">
                                <label for="final_total">الاجمالي بعد الضريبة والخصم</label>
                                <input type="text" readonly  required class="form-control" name="final_total" id="final_total">
                              </div>
                            </div>
                          </div>

                      <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="notes">ملاحظات </label>
                                    <textarea class="form-control" name="notes" id="notes"></textarea>
                                  </div>
                            </div>
                          </div>
                    
        </div>
              <!-- /.box-body -->
              <div class="box-footer">
                <button type="submit" class="btn btn-sm btn-success btn-flat" disabled>حفظ</button>
                <button type="button"  
                {{--  data-toggle="modal"  
                data-backdrop="static"
                data-keyboard="false"
                data-target="#modal"  --}}
                
                id="open-modal"
                 class="btn btn-sm btn-danger btn-flat">الاصناف</button>

                {{--  start-modal  --}}
                <!-- Modal -->
                <div class="modal fade" id="modal" tabindex="-1" role="dialog" aria-labelledby="modalLabel">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                    <div class="modal-header">
                        {{--  <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>  --}}
                        <h4 class="modal-title" id="modalLabel">الاصناف</h4>
                    </div>
                    <div class="modal-body">
                        {{--  form  --}}
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="item_id">الصنف</label>
                                        <select required id="item_id">
                                                @foreach ($order->getAvailableQuantaties() as $detail )
                                                    <option data-id="{{$detail->item_id}}" data-price="{{$detail->unite_price}}" data-max="{{$detail->quantity}}" value="{{$detail->item_id}}">{{optional($detail->item)->name}}</option>    
                                                @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="quantity">الكمية</label>
                                            <input type="text" required id="quantity"  class="form-control order-form">
                                        </div>
                                    </div>

                                    <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="unite_price">سعر الوحدة</label>
                                                <input type="text" required id="unite_price"  readonly class="form-control order-form">
                                            </div>
                                    </div>

                                    <div class="col-md-2">
                                            <div class="form-group">
                                                <label for="item_discount">الخصم</label>
                                                <input type="text" required id="item_discount"  class="form-control order-form">
                                            </div>
                                    </div>

                                    <div class="col-md-1">
                                            <div class="form-group">
                                                <label for="discount"></label>
                                                <button type="button" class="btn btn-block btn-flat btn-sm btn-info" id="add">
                                                        <i class="fa  fa-chevron-down"></i>
                                                    </button>
                                            </div>
                                    </div>


                                    {{--  <div class="col-md-12">
                                            <button type="button" class="btn btn-block btn-flat btn-sm btn-danger" id="add">
                                                <i class="fa  fa-chevron-down"></i>
                                            </button>
                                    </div>  --}}


                            </div>

                        {{--  ./form  --}}

                        {{--  .table  --}}
                        <hr/>
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>الاسم</th>
                                    <th>الكمية</th>
                                    <th>سعر الوحدة</th>
                                    <th>الخصم</th>
                                    <th>الاجمالي</th>
                                    <th>حذف</th>
                                </tr>
                            </thead>
                            <tbody class="to-append">
                          
                            </tbody>
                        </table>
                        {{--  .end-table  --}}
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default btn-flat btn-sm"  id="cancel" data-dismiss="modal">الغاء</button>
                        <button type="button" class="btn btn-primary btn-flat btn-sm" id="accept">موافق</button>
                    </div>
                    </div>
                </div>
                </div>
       
            {{--  end-modal  --}}
            </div>
            </form>
          </div>
          <!-- /.box -->
         
        </div>
    </div>
@stop
@push('scripts')
<script>
    $(document).ready(function(){

        //variables
        $addBtn = $('#add');
        $items = $('#items');
        $storeId = $('#store_id');
        $itemId = $('#item_id');
        $quantity = $('#quantity');
        $itemDiscount = $('#item_discount');
        $unitePrice = $('#unite_price');
        $discount = $('#discount');
        $toAppend = $('.to-append');
        $cancel  = $('#cancel');
        $accept  = $('#accept');
        $total  = $('#total');
        $vat  = $('#vat');
        $finalTotal  = $('#final_total');
        $observe = $('.observe');
        $submitFormBtn = $('[type=submit]')
        $openModal = $('#open-modal')
        $modal = $('#modal');
        total = 0;
        var items = [];
        //init
        table = $('.table').DataTable({
            //order:'',
            language:{
                url: '{{url('/vendor/datatables/arabic.json')}}'
            }
        });



        //events

        $openModal.click(function(){
            $modal.modal({backdrop: 'static',keyboard: false})
            setModalForm();
            $modal.modal('show');
        })
       $addBtn.click(function(){
           if($('.order-form').valid() && ($itemId.find(':selected').prop('disabled') == false)){

            //first calc  the item total with discount 

            item = {
                item_name: $itemId.find(':selected').text(),
                item_id: $itemId.find(':selected').val(),
                quantity: $quantity.val(),
                unite_price : $unitePrice.val(),
                discount: $itemDiscount.val(),
                item_total_price : ( $unitePrice.val() - $itemDiscount.val() ) * $quantity.val()
            }


            //disable the selected item
            $itemId.find(':selected').prop('disabled',true);
            //console.log(item)

            items.push(item);


            table.row.add([
                item.item_name,
                item.quantity,
                item.unite_price,
                item.discount,
                item.item_total_price,
                `<button data-id="${item.item_id}"  type="button" class="btn btn-danger btn-flat btn-sm delete-item">
                    <i class="fa fa-close"></i>
                </button>`
            ]).draw(false);

            total+=  item.item_total_price;

            //refresh the select 
            $itemId.select2('destroy')
            setTimeout(function(){  $('#item_id').select2({width:'100%',dir:'rtl'})  }, 10);
            if($itemId.next())
            {
                $itemId.find(':selected').next().prop('selected',true)
            }

            //set selected item price in the textbox
            setSelectedItemPrice();
           }
       })


       $(document).on('click','.delete-item',function(){
           
            //enable the item 
            $itemId.find(`[data-id=${$(this).data('id')}]`).prop('disabled',false);
            
            $itemId.select2('destroy')
            setTimeout(function(){  $('#item_id').select2({width:'100%',dir:'rtl'})  }, 10);

            index = items.map(function(item){ return item.item_id}).indexOf($(this).data('id').toString());
            console.log(index);
            //minos the total
            total-=  items[index].item_total_price;
            //remove from the array
            items.splice(index,1);
            //fetch the row in the datatables
            row =  $(this).parent().parent().addClass('remove');
            //remove it
            table.row($(this).parent().parent()).remove().draw();
       })



       //accept clicked
       $accept.click(function(){
           
            //put this into variable
            $items.val(JSON.stringify(items));
            $total.val(total);
            $modal.modal('hide');

           //calculate the final totals
           getTotal();

           if(items.length)
           {
               $submitFormBtn.prop('disabled',false);
           }
           else{
                $submitFormBtn.prop('disabled',true);
           }
       })


      $itemId.change(setModalForm);   
       $cancel.click(function(){
           
        items = [];
        total = 0;
        //put this into variable
        $items.val(JSON.stringify(items));
        $total.val(0);
       //calculate the final totals
       getTotal();
       table.clear().draw();

       //enable all options
       $('#item_id').find(':disabled').prop('disabled',false);
       $itemId.select2('destroy')
       setTimeout(function(){  $('#item_id').select2({width:'100%',dir:'rtl'})  }, 10);
       $submitFormBtn.prop('disabled',true);
      
    })


   //observe 

   $observe.keyup(function(){
      getTotal();
   })




       //methods
       function getTotal()
       {
        var final_total = 0;
        var total = $total.val();
        var discount = $discount.val();
        var vat = $vat.val();

        total -= discount;
        var final_total = ((parseFloat(vat) / 100) * total) +  total;
        $finalTotal.val(final_total.toFixed(2));
       }


       function setModalForm()
       {
        max =  $itemId.find(':selected').data('max');
        price =  $itemId.find(':selected').data('price');

        console.log($itemId.find(':selected') , max , price);
        $quantity.prop('max',max);
        $quantity.prop('placeholder',`الكمية المتاحة ${max}`);
        $unitePrice.val(price);

       }

       function setSelectedItemPrice()
       {
           price = $itemId.find(':selected').data('price');
           $unitePrice.val(price);
       }
    })

</script>
@endpush
@push('scripts')
<script>
    $(document).ready(function(){

        $('.validate').validate({
          rules:{
            no:{
              remote:{
                  type:'post',
                  url:'{{route('validate')}}',
                  data:{
                      field:"no",
                      value:function()
                      {
                          return $('[name=no]').val();
                      },
                      method:'unique:orders,no',
                  }
                  }
          }
        },
            messages:{
              no:{
                remote:'هذه القيمة موجودة مسبقا'
              }
            }
        })


    })

</script>
@endpush