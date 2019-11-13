@extends('layout.app')
@section('title','التقارير')
@section('sub-title','كشف حساب مورد')
@section('content')
<div class="row">
    <div class="col-md-12">
        

        <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
              <li class="active"><a href="#orders-in-tab" data-toggle="tab" aria-expanded="true">فواتير مرتجعات المورد</a></li>
              <li class=""><a href="#orders-out-tab" data-toggle="tab" aria-expanded="false">فواتير شراء المورد</a></li>
              <li class=""><a href="#accounts-in-tab" data-toggle="tab" aria-expanded="false">مدفوع من المورد</a></li>
              <li class=""><a href="#accounts-out-tab" data-toggle="tab" aria-expanded="false">مدفوع الي المورد</a></li>
              <li class="pull-left">
                  <button  data-toggle="modal" data-target="#modal" class="btn btn-success btn-flat btn-sm">
                      <i class="fa fa-cog fa-spin"></i>
                    </button>
              </li>
            </ul>
            <div class="tab-content">
              <div class="tab-pane  active" id="orders-in-tab">
                 <div class="table-responsive">
                     <table width="100%" id="orders-in" class="table table-bordered"></table> 
                </div>
              </div>
              <!-- /.tab-pane -->
              <div class="tab-pane fade" id="orders-out-tab">
               <div class="table-responsive">
                     <table width="100%" id="orders-out" class="table table-bordered"></table> 
                </div>
              </div>
              <!-- /.tab-pane -->

               <div class="tab-pane fade" id="accounts-in-tab">
               <div class="table-responsive">
                     <table width="100%" id="accounts-in" class="table table-bordered"></table> 
                </div>
              </div>
              <!-- /.tab-pane -->

               <div class="tab-pane fade" id="accounts-out-tab">
               <div class="table-responsive">
                     <table  width="100%" id="accounts-out" class="table table-bordered"></table> 
                </div>
              </div>
              <!-- /.tab-pane -->

            </div>
            <!-- /.tab-content -->
          </div>

   <!-- Modal -->
                <div class="modal fade" id="modal" tabindex="-1" role="dialog" aria-labelledby="modalLabel">
                  <div class="modal-dialog" role="document">
                    <div class="modal-content">
                      <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="modalLabel">كشف حساب مورد</h4>
                      </div>
                      <form class="validate">
                      <div class="modal-body">
                      <div class="row">
                      
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="from">من</label>
                                <input required type="text" class="form-control date" name="from" id="from">
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="to">الي</label>
                                <input  required type="text" class="form-control date" name="to" id="to">
                            </div>
                        </div>


                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="supplier_id">المورد</label>
                                <select name="supplier_id" id="supplier_id">
                                    @foreach ($suppliers as $supplier)
                                        <option value="{{$supplier->id}}">{{$supplier->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>


                      
                    </div> 
                    {{--  .row  --}}
                      </div>
                      {{--  .modal-body  --}}
                      <div class="modal-footer">
                        <button type="button" class="btn btn-default btn-sm btn-flat" data-dismiss="modal">الغاء</button>
                        <button type="submit" class="btn btn-primary btn-sm btn-flat">موافق </button>
                      </div>
                    </form>
                    </div>
                  </div>
                </div>

                
    </div>
</div>
@stop
@push('scripts')
{{--  <script src="{{asset('vendor/datatables/buttons.server-side.js')}}"></script>  --}}

<script>
  $form = $('.validate')
  $modal = $('#modal')
  $supplierId = $('#supplier_id')
  $from = $('#from')
  $to = $('#to')

  supplierId = null;
  from = null;
  to = null;
  $(document).ready(function(){

  $form.validate();

   $form.submit(function(e){
     e.preventDefault();
     if($form.valid()){
       $modal.modal('hide');
       supplierId = $supplierId.val();
       from = $from.val();
       to = $to.val();

       console.log(to , from ,supplierId);
       $('.table').each(function(index , item){
         $(item).DataTable().clear().draw()
         console.log(index);
       })
     }
     })
   })


 $('#orders-in').DataTable({
        dom:'Bfrtip',
        paging:false,
         language:{
          url:'{{url('/vendor/datatables/arabic.json')}}'
        },
        processing: true,
        serverSide: true,
        ajax: {
          type:'POST',
          url:'{{route('reports.supplier.orders-in')}}',
          data:function(data){
            data.supplier_id = supplierId;
            data.from = from;
            data.to = to;
          }
        },
        columns: [
            { data: 'no', name: 'no',title:'رقم الفاتورة' },
            { data: 'date', name: 'date',title:'التاريخ' },
            { data: 'name', name: 'suppliers.name',title:'المورد' },
            { data: 'final_total', name: 'final_total',title:'الاجمالي' },
            { data: 'payed', name: 'payed',title:'المدفوع من المورد' },
            { data: 'rest', name: 'rest',title:'الباقي' },
        ],
        buttons: ['excel', 'print']
    });

    $('#orders-out').DataTable({
        dom:'Bfrtip',
        paging:false,
         language:{
          url:'{{url('/vendor/datatables/arabic.json')}}'
        },
        processing: true,
        serverSide: true,
        ajax: {
          type:'POST',
          url:'{{route('reports.supplier.orders-out')}}',
          data:function(data){
            data.supplier_id = supplierId;
            data.from = from;
            data.to = to;
          }
        },
        columns: [
            { data: 'no', name: 'no',title:'رقم الفاتورة' },
            { data: 'date', name: 'date',title:'التاريخ' },
            { data: 'name', name: 'suppliers.name',title:'المورد' },
            { data: 'final_total', name: 'final_total',title:'الاجمالي' },
            { data: 'payed', name: 'payed',title:'المدفوع الي المورد' },
            { data: 'rest', name: 'rest',title:'الباقي' },
        ],
        buttons: ['excel', 'print']
    });



    $('#accounts-in').DataTable({
        dom:'Bfrtip',
        paging:false,
        language:{
          url:'{{url('/vendor/datatables/arabic.json')}}'
        },
        processing: true,
        serverSide: true,
        ajax: {
          type:'POST',
          url:'{{route('reports.supplier.accounts-in')}}',
          data:function(data){
            data.supplier_id = supplierId;
            data.from = from;
            data.to = to;
          }
        },
        columns: [
            { data: 'no', name: 'accounts.no',title:'رقم السند' },
            { data: 'date', name: 'date',title:'التاريخ' },
            { data: 'supplier', name: 'suppliers.name',title:'المورد' },
            { data: 'name', name: 'reposites.name',title:'الخزنة' },
            { data: 'cost', name: 'cost',title:'المدفوع' },
            { data: 'order', name: 'orders.no',title:'رقم الفاتورة' },
        ],
         buttons: ['excel', 'print']
    });



    $('#accounts-out').DataTable({
        dom:'Bfrtip',
        paging:false,
        language:{
          url:'{{url('/vendor/datatables/arabic.json')}}'
        },
        processing: true,
        serverSide: true,
        ajax: {
          type:'POST',
          url:'{{route('reports.supplier.accounts-out')}}',
          data:function(data){
            data.supplier_id = supplierId;
            data.from = from;
            data.to = to;
          }
        },
        columns: [
            { data: 'no', name: 'accounts.no',title:'رقم السند' },
            { data: 'date', name: 'date',title:'التاريخ' },
            { data: 'supplier', name: 'suppliers.name',title:'المورد' },
            { data: 'name', name: 'reposites.name',title:'الخزنة' },
            { data: 'cost', name: 'cost',title:'المدفوع' },
            { data: 'order', name: 'orders.no',title:'رقم الفاتورة' },
        ],
         buttons: ['excel', 'print']
    });




</script>
@endpush