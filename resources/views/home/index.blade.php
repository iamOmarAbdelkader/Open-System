@extends('layout.app')
@section('content')
<div class="row">
    <div class="col-md-4">
            <div class="info-box">
            <span class="info-box-icon bg-aqua"><i class="fa fa-users"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">العملاء</span>
              <span class="info-box-number">{{$clients}}</span>
            </div>
            <!-- /.info-box-content -->
          </div>    
    </div>


     <div class="col-md-4">
            <div class="info-box">
            <span class="info-box-icon bg-aqua"><i class="fa fa-users"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">الموردين</span>
              <span class="info-box-number">{{$suppliers}}</span>
            </div>
            <!-- /.info-box-content -->
          </div>    
    </div>

     <div class="col-md-4">
            <div class="info-box">
            <span class="info-box-icon bg-aqua"><i class="fa fa-users"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">الموظفين</span>
              <span class="info-box-number">{{$employees}}</span>
            </div>
            <!-- /.info-box-content -->
          </div>    
    </div>


     <div class="col-md-4">
            <div class="info-box">
            <span class="info-box-icon bg-aqua"><i class="fa fa-money"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">اجمالي المبيعات</span>
              <span class="info-box-number">{{$ordersIn}}</span>
            </div>
            <!-- /.info-box-content -->
          </div>    
    </div>

      <div class="col-md-4">
            <div class="info-box">
            <span class="info-box-icon bg-aqua"><i class="fa fa-money"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">اجمالي المرتجعات</span>
              <span class="info-box-number">{{$ordersOut}}</span>
            </div>
            <!-- /.info-box-content -->
          </div>    
    </div>


     <div class="col-md-4">
            <div class="info-box">
            <span class="info-box-icon bg-aqua"><i class="fa fa-money"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">الارباح</span>
              <span class="info-box-number">{{$profits}}</span>
            </div>
            <!-- /.info-box-content -->
          </div>    
    </div>


    <div class="col-md-12">
            <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
              <li class="active"><a href="#quantities-less-than-tab" data-toggle="tab" aria-expanded="true">كميات اقل من 10</a></li>
            </ul>
            <div class="tab-content">
              <div class="tab-pane  active" id="quantities-less-than-tab">
                 <div class="table-responsive">
                     <table width="100%" id="quantities-less-than-table" class="table table-bordered"></table> 
                </div>
              </div>
              <!-- /.tab-pane -->
            </div>
            <!-- /.tab-content -->
          </div>

    
    </div>

</div>
@stop





@push('scripts')
<script src="{{asset('vendor/datatables/buttons.server-side.js')}}"></script>

<script>
  $(document).ready(function(){
        $('#quantities-less-than-table').DataTable({
                dom:'Bfrtip',
                language:{
                url:'{{url('/vendor/datatables/arabic.json')}}'
                },
                processing: true,
                serverSide: true,
                ajax: {
                type:'POST',
                url:'{{route('home.quantities-less-than')}}'
                },
                columns: [
                    { data: 'item', name: 'items.name',title:'الصنف' },
                    { data: 'store', name: 'stores.name',title:'المخزن' },
                    { data: 'quantity', name: 'quantity',title:'الكمية' },
                ],
                order:[],
                buttons: ['reset','reload']
            });

   })
 

 

</script>
@endpush