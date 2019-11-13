@extends('layout.app')
@section('title','الحضور و الانصراف')
@section('sub-title','اضافة')
@section('content')
    <div class="row">
    @if($employees->count())
        <div class="col-md-12">
          <!-- general form elements -->
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title"> اضافة </h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form role="form" class="validate" action="{{route('attendance.store')}}" method="POST" enctype="multipart/form-data">
            {{csrf_field()}}
              <div class="box-body">

                <div class="row">
                  <div class="col-md-12">
                    <div class="form-group">
                      <label for="date">التاريخ</label>
                      <input type="text"  required class="form-control date" name="date" id="date">
                    </div>
    
                  </div>

            
                </div>    
                
                <div class="row">
                   

                  <div class="col-md-12">
                      <div class="form-group">
                              <label for="employee_id"> الموظف</label>
                              <select class="form-control" name="employee_id" id="employee_id">
                                  @foreach ($employees as $employee )
                                      <option value="{{$employee->id}}">{{$employee->name}}</option>
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
                          <option>حضور</option>
                          <option>انصراف</option>
                          <option>غياب</option>
                          <option>غياب باذن</option>
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
                <button type="submit" class="btn btn-sm btn-success btn-flat">اضافة</button>
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