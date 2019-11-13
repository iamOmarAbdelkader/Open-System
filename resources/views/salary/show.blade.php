@extends('layout.app')
@section('title','المرتبات')
@section('sub-title','عرض')
@section('content')
<div class="row">
    <div class="col-md-12">
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">بيانات المرتب</h3>
                
            </div>
            <!-- /.box-header -->
            <div class="box-body">
        <div class="table-responsive">
            <table class="table table-responsive table-bordered">
                <tbody>
                         <tr>
                                <td>من</td>
                                <td>{{optional($salary->from)->toDateString()}}</td>                        
                        </tr>
                         <tr>
                                <td>الي</td>
                                <td>{{optional($salary->to)->toDateString()}}</td>                                         
                        </tr>
                        <tr>
                                <td>الموظف</td>
                                <td>{{optional($salary->employee)->name}}</td>                        
                        </tr>

                        <tr>
                                        <td>الوظيفة</td>
                                        <td>{{optional(optional($salary->employee)->job)->name}}</td>                        
                        </tr>

                        <tr>
                                <td>الخزنة</td>
                                <td>{{optional($salary->reposite)->name}}</td>                        
                        </tr>

                        <tr>
                                        <td>الاساسي</td>
                                        <td>{{$salary->basic}}</td>                        
                        </tr>

                        <tr>
                                <td>سلف</td>
                                <td>{{$salary->loan}}</td>                        
                        </tr>

                        <tr>
                                <td>غياب</td>
                                <td>{{$salary->absence}}</td>                        
                        </tr>

                        <tr>
                                <td>تاخير</td>
                                <td>{{$salary->late}}</td>                        
                        </tr>


                        <tr>
                                <td>اضافي</td>
                                <td>{{$salary->extra}}</td>                        
                        </tr>

                        <tr>
                                <td>جزاءات</td>
                                <td>{{$salary->financial_penalties}}</td>                        
                        </tr>

                        <tr>
                                <td>ضريبة كسب عمل</td>
                                <td>{{$salary->tax}}</td>                        
                        </tr>


                        <tr>
                                <td>مكافاءة</td>
                                <td>{{$salary->bonus}}</td>                        
                        </tr>

                        <tr>
                                <td> الصافي</td>
                                <td>{{$salary->net}}</td>                        
                        </tr>

                        <tr>
                                <td> ملاحظات</td>
                                <td>{{$salary->notes}}</td>                        
                        </tr>

                </tbody>
            </table>
              </div>
            </div>
            <!-- /.box-body -->
         
          </div>
          <!-- /.box -->
        </div>
</div>

@stop