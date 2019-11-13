@extends('layout.app')
@section('title','الموظفين')
@section('sub-title','عرض')
@section('content')
<div class="row">
    <div class="col-md-12">
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">بيانات الموظف</h3>
                
            </div>
            <!-- /.box-header -->
            <div class="box-body">
        <div class="table-responsive">
            <table class="table table-responsive table-bordered">
                <tbody>
                        <tr>
                                <td>الاسم</td>
                                <td>{{$employee->name}}</td>                        
                        </tr>

                        <tr>
                                        <td>الوظيفة</td>
                                        <td>{{optional($employee->job)->name}}</td>                        
                        </tr>

                        <tr>
                                        <td>1 تليفون</td>
                                        <td>{{$employee->phone_1}}</td>                        
                        </tr>
                        <tr>
                                <td>2 تليفون</td>
                                <td>{{$employee->phone_2}}</td>                        
                        </tr>

                        <tr>
                                <td>تليفون 3</td>
                                <td>{{$employee->phone_3}}</td>                        
                        </tr>

                        <tr>
                                <td>واتس</td>
                                <td>{{$employee->whatsapp}}</td>                        
                        </tr>

                        <tr>
                                <td>ملاحظات</td>
                                <td>{{$employee->notes}}</td>                        
                        </tr>

                        <tr>
                                        <td>العنوان</td>
                                        <td>{{$employee->address}}</td>                        
                        </tr>

                        <tr>
                                        <td>المحافظة</td>
                                        <td>{{optional($employee->country)->name}}</td>                        
                        </tr>

                        <tr>
                                <td>تاريخ الميلاد</td>
                                <td>{{optional($employee->date_of_birth)->toDateString()}}</td>                        
                        </tr>

                        <tr>
                                        <td>تاريخ التعيين</td>
                                        <td>{{optional($employee->date_of_appointment)->toDateString()}}</td>                        
                        </tr>

                        <tr>
                                        <td> المؤهل</td>
                                        <td>{{$employee->degree}}</td>                        
                        </tr>

                                        <td>صورة البطاقة 1 </td>
                                        <td>
                                                <a href="{{ $employee->id_image_1 }}" class="fancybox" title="{{ $employee->name }}">
                                                        <img src="{{ $employee->id_image_1 }}" class="img-thumbnail" width="100px" height="100px">
                                                </a>
                                        </td>
                        </tr>

                        <tr>
                                        <td>صورة البطاقة 2</td>
                                        <td>
                                                <a href="{{ $employee->id_image_2 }}" class="fancybox" title="{{ $employee->name }}">
                                                        <img src="{{ $employee->id_image_2 }}" class="img-thumbnail" width="100px" height="100px">
                                                </a>
                                        </td>
                        </tr>

                        @isset($employee->cv)
                        <tr>
                                        <td> cv</td>
                                        <td>
                                                <a class="btn btn-primary btn-sm btn-flat" href="{{route('employees.download',['employee'=>$employee,'resource'=>'cv'])}}">
                                                        <i class="fa fa-cloud-download"></i>
                                                </a>
                                        </td>                        
                        </tr>
                        @endisset
                        @isset($employee->cv)
                        <tr>
                                        <td>  صحيفة الحالة الجنائية</td>
                                        <td>
                                                <a class="btn btn-primary btn-sm btn-flat" href="{{route('employees.download',['employee'=>$employee,'resource'=>'criminal_record'])}}">
                                                                <i class="fa fa-cloud-download"></i>
                                                </a>
                                        </td>                        
                        </tr>
                        @endisset
                    
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