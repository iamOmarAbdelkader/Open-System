@extends('layout.app')
@section('title','مرتجع  الي المورد')
@section('sub-title','عرض')
@section('content')
<div class="row">
        <div class="col-md-12">
                <div class="box box-primary">
                  <div class="box-header with-border">
                    <h3 class="box-title">بيانات العملية </h3>
                      
                  </div>
                  <!-- /.box-header -->
                  <div class="box-body">
              <div class="table-responsive">
                  <table class="table table-responsive table-bordered">
                      <tbody>
                              <tr>
                                      <td>رقم الفاتورة</td>
                                      <td>{{$order->no}}</td>                        
                              </tr>
                              <tr>
                                      <td>التاريخ</td>
                                      <td>{{optional($order->date)->toDateString()}}</td>                        
                              </tr>
                              <tr>
                                  <td>المورد</td>
                                  <td>{{optional($order->ownerable)->name}}</td>                        
                            </tr>

                            <tr>
                                    <td>المخزن</td>
                                    <td>{{optional($order->store)->name}}</td>                       
                              </tr>

                              <tr>
                                    <td>الاجمالي</td>
                                    <td>{{$order->total}}</td>                        
                              </tr>

                              <tr>
                                    <td>ضريبة القيمة المضافة</td>
                                    <td>{{$order->vat}}</td>                        
                              </tr>


                              <tr>
                                    <td>الاجمالي بعد الخصم و الضريبة</td>
                                    <td>{{$order->final_total}}</td>                        
                              </tr>

                              <tr>
                                    <td>ملاحظات</td>
                                    <td>{{$order->notes}}</td>                        
                              </tr>


                      </tbody>
                  </table>
                    </div>
                  </div>
                  <!-- /.box-body -->
               
                </div>
                <!-- /.box -->
              </div>

    <div class="col-md-12">
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">{{$order->no}}</h3>
                
            </div>
            <!-- /.box-header -->
            <div class="box-body">
            <div class="table-responsive">
             {!! $dataTable->table(['class' => 'table table-bordered']) !!} 
            
            </div>
            </div>

            <!-- /.box-body -->
         
          </div>
          <!-- /.box -->
        </div>

</div>
@stop
 @push('scripts')
<script src="{{asset('vendor/datatables/buttons.server-side.js')}}"></script>
{!! $dataTable->scripts() !!}
@endpush 