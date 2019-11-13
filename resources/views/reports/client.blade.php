@extends('layout.app')
@section('title','التقارير')
@section('sub-title','كشف حساب عميل')
@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
              <li class="active"><a href="#orders-in-tab" data-toggle="tab" aria-expanded="true">فواتير شراء العميل</a></li>
              <li class=""><a href="#orders-out-tab" data-toggle="tab" aria-expanded="false">فواتير مرتجعات العميل</a></li>
              <li class=""><a href="#accounts-in-tab" data-toggle="tab" aria-expanded="false">مدفوع من العميل</a></li>
              <li class=""><a href="#accounts-out-tab" data-toggle="tab" aria-expanded="false">مدفوع الي العميل</a></li>
              <li class=""><a href="#client-account-tab" data-toggle="tab" aria-expanded="false">كشف حساب عميل</a></li>
              <li class=""><a href="#client-info-tab" data-toggle="tab" aria-expanded="false">بيانات العميل</a></li>
              <li class="pull-left">
                  <button  data-toggle="modal" data-target="#modal" class="btn btn-success btn-flat btn-sm">
                      <i class="fa fa-cog fa-spin"></i>
                    </button>
              </li>
            </ul>
            <div class="tab-content">
              <div class="tab-pane  active" id="orders-in-tab">
                 <div class="table-responsive">
                     <table width="100%" id="orders-in" class="table data-table table-bordered"></table> 
                </div>
              </div>
              <!-- /.tab-pane -->
              <div class="tab-pane fade" id="orders-out-tab">
               <div class="table-responsive">
                     <table width="100%" id="orders-out" class="table data-table table-bordered"></table> 
                </div>
              </div>
              <!-- /.tab-pane -->

               <div class="tab-pane fade" id="accounts-in-tab">
               <div class="table-responsive">
                     <table width="100%" id="accounts-in" class="table data-table table-bordered"></table> 
                </div>
              </div>
              <!-- /.tab-pane -->

               <div class="tab-pane fade" id="accounts-out-tab">
               <div class="table-responsive">
                     <table  width="100%" id="accounts-out" class="table data-table table-bordered"></table> 
                </div>
              </div>
              <!-- /.tab-pane -->

                  <div class="tab-pane fade" id="client-account-tab">
                  <div class="table-responsive">
                        <table  width="100%" id="client-account" class="table   table-bordered"></table> 
                    </div>
              </div>
              <!-- /.tab-pane -->

              
                  <div class="tab-pane fade" id="client-info-tab">
                 <div class="row">
                   <div class="col-sm-12">
                        <div class="table-responsive">
                             <table class="table table-bordered">
                                <tr>
                                  <td>العميل</td>
                                  <td id="clientName"></td>
                                </tr>
                                <tr>
                                  <td>رصيد اول المدة</td>
                                  <td id="init"></td>
                                </tr>
                                <tr>
                                  <td>رصيد نهاية المدة</td>
                                  <td id="balance"></td>
                                </tr>
                          </table>
                        </div>
                   </div>
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
                        <h4 class="modal-title" id="modalLabel">كشف حساب عميل</h4>
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
                                <label for="client_id">العميل</label>
                                <select name="client_id" id="client_id">
                                    @foreach ($clients as $client)
                                        <option value="{{$client->id}}">{{$client->name}}</option>
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
  $clientId = $('#client_id')
  $from = $('#from')
  $to = $('#to')
  $accountTabel = null
  clientId = null;
  from = null;
  to = null;
  $(document).ready(function(){

  $form.validate();

   $form.submit(function(e){
     e.preventDefault();
     if($form.valid()){
       $modal.modal('hide');
       clientId = $clientId.val();
       from = $from.val();
       to = $to.val();

       $('.data-table').each(function(index , item){
         $(item).DataTable().clear().draw()
       })
        $accountTabel.clear().draw();

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
          url:'{{route('reports.client.orders-in')}}',
          data:function(data){
            data.client_id = clientId;
            data.from = from;
            data.to = to;
          }
        },
        columns: [
            { data: 'no', name: 'no',title:'رقم الفاتورة' },
            { data: 'date', name: 'date',title:'التاريخ' },
            { data: 'name', name: 'clients.name',title:'العميل' },
            { data: 'final_total', name: 'final_total',title:'الاجمالي' },
            { data: 'payed', name: 'payed',title:'المدفوع من العميل' },
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
          url:'{{route('reports.client.orders-out')}}',
          data:function(data){
            data.client_id = clientId;
            data.from = from;
            data.to = to;
          }
        },
        columns: [
            { data: 'no', name: 'no',title:'رقم الفاتورة' },
            { data: 'date', name: 'date',title:'التاريخ' },
            { data: 'name', name: 'clients.name',title:'العميل' },
            { data: 'final_total', name: 'final_total',title:'الاجمالي' },
            { data: 'payed', name: 'payed',title:'المدفوع من العميل' },
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
          url:'{{route('reports.client.accounts-in')}}',
          data:function(data){
            data.client_id = clientId;
            data.from = from;
            data.to = to;
          }
        },
        columns: [
            { data: 'no', name: 'accounts.no',title:'رقم السند' },
            { data: 'date', name: 'date',title:'التاريخ' },
            { data: 'client', name: 'clients.name',title:'العميل' },
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
          url:'{{route('reports.client.accounts-out')}}',
          data:function(data){
            data.client_id = clientId;
            data.from = from;
            data.to = to;
          }
        },
        columns: [
            { data: 'no', name: 'accounts.no',title:'رقم السند' },
            { data: 'date', name: 'date',title:'التاريخ' },
            { data: 'client', name: 'clients.name',title:'العميل' },
            { data: 'name', name: 'reposites.name',title:'الخزنة' },
            { data: 'cost', name: 'cost',title:'المدفوع' },
            { data: 'order', name: 'orders.no',title:'رقم الفاتورة' },
        ],
         buttons: ['excel', 'print']
    });

  $accountTabel  =   $('#client-account').DataTable({
        dom:'Bfrtip',
        language:{
          url:'{{url('/vendor/datatables/arabic.json')}}'
        },
        processing: true,
        serverSide: true,
        ajax: {
          type:'POST',
          url:'{{route('reports.client.account')}}',
          data:function(data){
            data.client_id = clientId;
            data.from = from;
            data.to = to;
          }
        },
        columns: [
            { data: 'date', name: 'date',title:'التاريخ' },
            { data: 'order_in', name: 'order_in',title:'فاتورة بيع' },
            { data: 'order_out', name: 'order_out',title:'فاتورة مرتجع' },
            { data: 'cost', name: 'cost',title:'المدفوع' },
            { data: 'balance', name:'balance',title:'رصيد' },
        ],
        "drawCallback": function( settings ) {
            data = $accountTabel.ajax.json();
            console.log(data);
            if(data.client)
            {
                $('#clientName').text(data.client.name)
                $('#init').text(data.client.init)
                $('#balance').text(data.balance)
            }
           
        },
         buttons: ['excel', 'print']
    });
 


</script>
@endpush