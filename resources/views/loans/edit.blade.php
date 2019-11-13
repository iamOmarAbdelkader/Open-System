@extends('layout.app')
@section('title','السلف')
@section('sub-title','تعديل')
@section('content')
    <div class="row">
      @if($employees->count() and $reposites->count())
        <div class="col-md-12">
          <!-- general form elements -->
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title"> تعديل </h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form role="form" class="validate" action="{{route('loans.update',$loan)}}" method="POST" enctype="multipart/form-data">
            {{csrf_field()}}
            {{method_field('PUT')}}
              <div class="box-body">

                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="date">التاريخ</label>
                      <input type="text"  required class="form-control date" name="date" id="date" value="{{optional($loan->date)->toDateString()}}">
                    </div>
    
                  </div>

                  <div class="col-md-6">
                      <div class="form-group">
                        <label for="cost">القيمة</label>
                        <input type="text" min="0"  required class="form-control" name="cost" id="cost" value="{{$loan->cost}}">
                      </div>
      
                    </div>
                </div>
              
             
           

                          
             
                      
                <div class="row">
                   
                    <div class="col-md-6">
                      
                        <div class="form-group">
                                <label for="reposite_id"> الخزنة</label>
                                <select class="form-control" name="reposite_id" id="reposite_id">
                                  @foreach ($reposites as $reposite )
                                        <option value="{{$reposite->id}}" data-max="{{$reposite->balance}}" {{$loan->reposite_id == $reposite->id?'selected':''}}>{{$reposite->name}}</option>
                                    @endforeach
                                </select>
                              </div>
                </div>


                    <div class="col-md-6">
                        <div class="form-group">
                                <label for="employee_id"> الموظف</label>
                                <select class="form-control" name="employee_id" id="employee_id">
                                    @foreach ($employees as $employee )
                                        <option value="{{$employee->id}}" {{$loan->employee_id == $employee->id?'selected':''}}>{{$employee->name}}</option>
                                    @endforeach
                                </select>
                              </div>
                </div>
            </div>


            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="notes">ملاحظات </label>
                        <textarea class="form-control" name="notes" id="notes">{{$loan->notes}}</textarea>
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
            <div class="col-sm-12">
              <div class="alert alert-danger">
                لايوجد موظفين
              </div>
            </div>
          @endunless


          @unless($reposites->count())
          <div class="col-sm-12">
            <div class="alert alert-danger">
              لايوجد موظفين
            </div>
          </div>
        @endunless


        @endif
    </div>
@stop
@push('scripts')
<script>
    $(document).ready(function(){
      $('.validate').validate();
      /*$repositeId = $('#reposite_id')
      $cost = $('#cost')

      changeMax()
      $repositeId.change(changeMax);
      
        function changeMax(){
          $cost.prop('max',$repositeId.find(':selected').data('max'));
        }/*

    })

</script>
@endpush