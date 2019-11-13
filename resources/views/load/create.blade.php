@extends('layout.app')
@section('title','تحميل')
@section('sub-title','اضافة')
@section('content')
    <div class="row">
    @if($stores->count())
        <div class="col-md-12">
          <!-- general form elements -->
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title"> اضافة </h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form role="form" class="validate" action="{{route('load.store')}}" method="POST" enctype="multipart/form-data">
            {{csrf_field()}}
            <input type="hidden" name="items" id="items">
              <div class="box-body">

                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="no">الكود </label>
                      <input type="text"  required class="form-control" name="no" id="no">
                    </div>
    
                  </div>

                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="date"> التاريخ</label>
                      <input type="text"  required class="form-control date" name="date" id="date">
                    </div>
                  </div>


                </div>


                
                  


              

             
           

                          
             
                      
                <div class="row">
                    <div class="col-md-6">
                            <div class="form-group">
                                <label for="from_id"> من</label>
                                <select class="form-control select-store" name="from_id" id="from_id">
                                    @foreach ($stores as $store )
                                        <option data-id="{{$store->id}}" value="{{$store->id}}">{{$store->name}}</option>    
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="col-md-6">
                                <div class="form-group">
                                    <label for="to_id"> الي</label>
                                    <select class="form-control select-store" name="to_id" id="to_id">
                                        @foreach ($to as $store )
                                            <option  data-id="{{$store->id}}" value="{{$store->id}}">{{$store->name}}</option>    
                                        @endforeach
                                    </select>
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
                <button type="submit" class="btn btn-sm btn-success btn-flat" disabled>اضافة</button>
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
                                                {{--  @foreach ($items as $item )
                                                    <option data-id="{{$item->id}}" value="{{$item->id}}">{{$item->name}}</option>    
                                                @endforeach  --}}
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="quantity">الكمية</label>
                                            <input type="text" required id="quantity"  class="form-control order-form">
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
                                    <th>عمليات</th>
                                </tr>
                            </thead>
                            <tbody class="to-append">
                               {{--  <tr>
                                   <td></td>
                                   <td></td>
                                   <td></td>
                               </tr>  --}}
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
        @else

        @unless($stores->count())
            <div class="col-sm-12">
                    <div class="alert alert-danger">
                        لايوجد مخازن 
                    </div>
            </div>
        @endunless
        @endif
    </div>
@stop
@push('scripts')
<script>
    $(document).ready(function(){

        //variables
        $addBtn = $('#add');
        $items = $('#items');
        $fromId = $('#from_id');
        $toId = $('#to_id');
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
        $selectStore = $('.select-store');
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

        selectStore();

        $selectStore.change(selectStore);
        $openModal.click(function(){
            $.ajax({
                url:'{{route('api.get-items-in-the-store')}}',
                type:'POST',
                data:{
                    id: $fromId.find(':selected').val()
                },
                success:function(data){
                    options = ``;
                    $itemId.html('');
                    $(data.items).each(function(index , el){
                        options += `<option value="${el.item_id}" data-price="${el.item.price}" data-max="${el.quantity}" data-id="${el.item_id}" >${el.item.name}</option>` 
                    })
                    $itemId.append(options);


                },
                error:function(err){
                    console.log(err);
                }
            }).then(function(){
                $modal.modal({backdrop: 'static',keyboard: false})
                setModalForm();
                $modal.modal('show');
            })

            
        })
       $addBtn.click(function(){
           if($('.order-form').valid() && ($itemId.find(':selected').prop('disabled') == false)){

            //first calc  the item total with discount 

            item = {
                item_name: $itemId.find(':selected').text(),
                item_id: $itemId.find(':selected').val(),
                quantity: $quantity.val(),
            }


            //disable the selected item
            $itemId.find(':selected').prop('disabled',true);
            //console.log(item)

            items.push(item);


            table.row.add([
                item.item_name,
                item.quantity,
                `<button data-id="${item.item_id}"  type="button" class="btn btn-danger btn-flat btn-sm delete-item">
                    <i class="fa fa-close"></i>
                </button>`
            ]).draw(false);


            //refresh the select 
            $itemId.select2('destroy')
            setTimeout(function(){  $('#item_id').select2({width:'100%',dir:'rtl'})  }, 10);
            if($itemId.next())
            {
                $itemId.find(':selected').next().prop('selected',true)
            }
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
            $modal.modal('hide');

           //calculate the final totals
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
        //put this into variable
        $items.val(JSON.stringify(items));
       //calculate the final totals
       table.clear().draw();

       //enable all options
       $('#item_id').find(':disabled').prop('disabled',false);
       $itemId.select2('destroy')
       setTimeout(function(){  $('#item_id').select2({width:'100%',dir:'rtl'})  }, 10);
       $submitFormBtn.prop('disabled',true);
      
    })



       function setModalForm()
       {
            max =  $itemId.find(':selected').data('max');
            price =  $itemId.find(':selected').data('price');
            $quantity.prop('max',max);
            $quantity.prop('placeholder',`الكمية المتاحة ${max}`);
            $unitePrice.val(price);
       }


       function selectStore()
       {
           id = $fromId.find(':selected').data('id')
           selector = `[data-id=${id}]`
           $toId.find('option').each(function(index , item){
               $(item).prop('disabled',false);
           })
           $toId.find(selector).prop({'disabled': true , 'selected':false});
           $toId.select2('destroy')
           setTimeout(function(){  $toId.select2({width:'100%',dir:'rtl'})  }, 10);
           $openModal.prop('disabled',$toId.find(':selected').prop('disabled'))
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
                      method:'unique:loads,no',
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