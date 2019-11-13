@extends('layout.app')
@section('title','التقارير')
@section('sub-title','الرئسية')
@section('content')
<div class="row">
    <div class="col-md-12">
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">التقارير</h3>
                
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <div class="row">
                  <div class="col-md-4">
                    <a  class="btn btn-block btn-primary btn-sm btn-flat"  href="{{route('reports.client.index')}}">كشف حساب عميل</a>
                  </div>

                  <div class="col-md-4">
                    <a class="btn btn-block btn-primary btn-sm btn-flat" href="{{route('reports.supplier.index')}}">كشف حساب مورد</a>
                  </div>

                   <div class="col-md-4">
                    <a class="btn btn-block btn-primary btn-sm btn-flat" href="{{route('reports.reposite.index')}}">كشف حساب خزنة</a>
                  </div>

                  <div class="col-md-4">
                    <a class="btn btn-block btn-primary btn-sm btn-flat" href="{{route('reports.load.index')}}">التحميل بين المخازن</a>
                  </div>

                  <div class="col-md-4">
                    <a class="btn btn-block btn-primary btn-sm btn-flat" href="{{route('reports.employee.index')}}">تاريخ تعيين الموظفين</a>
                  </div>


                    <div class="col-md-4">
                    <a class="btn btn-block btn-primary btn-sm btn-flat" href="{{route('reports.attendance.index')}}">حضور وانصراف  الموظفين</a>
                  </div>

                </div>
            </div>
            <!-- /.box-body -->

          </div>
          <!-- /.box -->
        </div>

</div>

@stop