@extends('layout.app')
@section('title','الحضور و الانصراف')
@section('sub-title','تعديل')
@section('content')
    <div class="row">
    @if($employees->count())
        <div class="col-md-12">
          <!-- general form elements -->
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title"> تعديل </h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form role="form" class="validate" action="{{route('attendance.update',$attendance)}}" method="POST" enctype="multipart/form-data">
            {{csrf_field()}}

            {{method_field('PUT')}}
              <div class="box-body">

                <div class="row">
                  <div class="col-md-12">
                    <div class="form-group">
                      <label for="date">التاريخ</label>
                      <input type="text"  required class="form-control date" name="date" id="date" value="{{optional($attendance->date)->toDateString()}}">
                    </div>
    
                  </div>

            
                </div>    
                
                <div class="row">
                   

                  <div class="col-md-12">
                      <div class="form-group">
                              <label for="employee_id"> الموظف</label>
                              <select class="form-control" name="employee_id" id="employee_id">
                                  @foreach ($employees as $employee )
                                      <option value="{{$employee->id}}" {{$attendance->employee_id == $employee->id?'selected':''}}>{{$employee->name}}</option>
                                  @endforeach
                              </select>
                            </div>
              </div>
          </div>


          <div class="row">
                   

            <div class="col-md-12">
                <div class="form-group">
                        <label for="type"> النوع</label>
                        <select class="form-control" name="type" id="type">
                          <option {{$attendance->type =='حضور'?'selected':''}}>حضور</option>
                          <option {{$attendance->type =='انصراف'?'selected':''}}>انصراف</option>
                          <option {{$attendance->type =='غياب'?'selected':''}}>غياب</option>
                          <option {{$attendance->type =='غياب باذن'?'selected':''}}>غياب باذن</option>
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
                <button type="submit" class="btn btn-sm btn-success btn-flat">تعديل</button>
              </div>
            </form>
          </div>
          <!-- /.box -->
         
        </div>
        @else
        @unless($employees->count())
        <div class="col-md-12">
          <div class="alert alert-danger">
            لايوجد  موظفين
          </div>
        </div>
        @endunless
        @endif  
    </div>
@stop
@push('scripts')
<script>
    $(document).ready(function(){

        $('.validate').validate()


    })

</script>
@endpush