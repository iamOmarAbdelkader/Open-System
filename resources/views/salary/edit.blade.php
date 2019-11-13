@extends('layout.app')
@section('title','المرتبات')
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
            <form role="form" class="validate" action="{{route('salary.update',$salary)}}" method="POST" enctype="multipart/form-data">
            {{csrf_field()}}
            {{method_field('PUT')}}
              <div class="box-body">

                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="from">من</label>
                      <input type="text"  required class="form-control date" name="from" id="from" value="{{optional($salary->from)->toDateString()}}">
                    </div>
    
                  </div>

                    <div class="col-md-6">
                    <div class="form-group">
                      <label for="to">الي</label>
                      <input type="text"  required class="form-control date" name="to" id="to" value="{{optional($salary->to)->toDateString()}}">
                    </div>
    
                  </div>

                </div>

                  <div class="row">
                  <div class="col-md-6">
                      <div class="form-group">
                              <label for="employee_id"> الموظف</label>
                              <select class="form-control" name="employee_id" id="employee_id">
                                  @foreach ($employees as $employee )
                                      <option value="{{$employee->id}}" {{$salary->employee_id == $employee->id?'selected':''}}>{{$employee->name}}</option>
                                  @endforeach
                              </select>
                            </div>
              </div>

              <div class="col-md-6">
                    <div class="form-group">
                            <label for="reposite_id"> الخزنة</label>
                            <select class="form-control" name="reposite_id" id="reposite_id">
                              @foreach ($reposites as $reposite )
                                    <option value="{{$reposite->id}}" data-max="{{$reposite->balance}}" {{$salary->reposite_id == $reposite->id?'selected':''}}>{{$reposite->name}}</option>
                                @endforeach
                            </select>
                          </div>
                </div>

                </div>
              
             
           

                          
             
              <div class="row">
                   
                <div class="col-md-6">
                    <div class="form-group">
                      <label for="basic">الاساسي</label>
                      <input type="text" min="0"    required class="form-control observe " name="basic" id="basic" value="{{$salary->basic}}">
                    </div>
                  </div>

                  <div class="col-md-6">
                      <div class="form-group">
                        <label for="loan">سلف</label>
                        <input type="text" min="0"   readonly required class="form-control observe" name="loan" id="loan" value="{{$salary->loan}}">
                      </div>
                    </div>
                  
              </div>

               
              <div class="row">
                      <div class="col-md-6">
                          <div class="form-group">
                            <label for="absence">غياب</label>
                            <input type="text" min="0"   required class="form-control observe" name="absence" id="absence" value="{{$salary->absence}}">
                          </div>
                        </div>
  
                        <div class="col-md-6">
                            <div class="form-group">
                              <label for="late">تاخير</label>
                              <input type="text" min="0"   required class="form-control observe" name="late" id="late" value="{{$salary->late}}">
                            </div>
                          </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                          <label for="extra">اضافي</label>
                          <input type="text" min="0"   required class="form-control observe" name="extra" id="extra" value="{{$salary->extra}}">
                        </div>
                      </div>

                      <div class="col-md-6">
                          <div class="form-group">
                            <label for="financial_penalties">جزاءات</label>
                            <input type="text" min="0"    required class="form-control observe" name="financial_penalties" id="financial_penalties" value="{{$salary->financial_penalties}}">
                          </div>
                        </div>
              </div>


              <div class="row">
                  <div class="col-md-6">
                      <div class="form-group">
                        <label for="tax">ضريبة كسب عمل</label>
                        <input type="text" min="0"    required class="form-control observe" name="tax" id="tax" value="{{$salary->tax}}">
                      </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                          <label for="bonus">مكافاءة</label>
                          <input type="text" min="0"   required class="form-control observe" name="bonus" id="bonus" value="{{$salary->bonus}}">
                        </div>
                      </div>
            </div>






                      
                <div class="row">
                   
                    

                <div class="col-md-12">
                    <div class="form-group">
                      <label for="net">الصافي</label>
                      <input type="text" min="0"  required readonly class="form-control" name="net" id="net" value="{{$salary->net}}">
                    </div>
    
                  </div>


                  
            </div>


            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="notes">ملاحظات </label>
                        <textarea class="form-control" name="notes" id="notes">{{$salary->notes}}</textarea>
                      </div>
                </div>

              </div>


                
                    
        </div>
              <!-- /.box-body -->

              <div class="box-footer">
                <button type="submit" class="btn btn-sm btn-success btn-flat">تعديل</button>
                <button type="button" id="open-employee-modal" class="btn btn-info btn-sm btn-flat">
                   حضور وغياب
                  </button>


                  <div class="modal fade" tabindex="-1" id="employee-modal" role="dialog">
                      <div class="modal-dialog" role="document">
                        <div class="modal-content">
                          <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title"> حضور وانصراف الموظف</h4>
                          </div>
                          <div class="modal-body">
                           <div class="row">
                              <div class="col-sm-12">
                                <table class="table table-bordered">
                                  <tbody>
                                    <tr>
                                      <td>غياب</td>
                                      <td id="absense-in-modal"></td>
                                    </tr>

                                    <tr>
                                        <td>غياب باذن</td>
                                        <td id="absense-with-permission"></td>
                                      </tr>

                                      <tr>
                                          <td>حضور</td>
                                          <td id="presense"></td>
                                      </tr>


                                  </tbody>
                                </table>
                              </div>
                           </div>
                          </div>
                          {{--  <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">اغلاق</button>
                          </div>  --}}
                        </div><!-- /.modal-content -->
                      </div><!-- /.modal-dialog -->
                    </div><!-- /.modal -->



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

      $repositeId = $('#reposite_id')
      $cost = $('#cost')
      $date = $('.date');
      $from = $('#from');
      $to = $('#to');
      $employeeId = $('#employee_id')
      $openEmployeeModal = $('#open-employee-modal')
      $employeeModal = $('#employee-modal')
      $loan = $('#loan');
      $net = $('#net');
      changeMax()
      //getEmployeeLoan()
      $repositeId.change(changeMax);
      $employeeId.change(getEmployeeLoan)
      $date.change(getEmployeeLoan)

      $('.observe').keyup(function(){
        inc = 0;
        dec = 0;
        inc = parseFloat($('#basic').val() )+
        parseFloat($('#extra').val() )+
        parseFloat($('#bonus').val() );        
        console.log($('#basic').val() , $('#extra').val() , $('#bonus').val()  );
        dec = 
        parseFloat($('#loan').val() )+
        parseFloat($('#absence').val() )+
        parseFloat($('#late').val() ) + 
        parseFloat($('#financial_penalties').val() ) +
        parseFloat($('#tax').val() ) ;

        console.log($('#loan').val() ,  $('#absence').val() , $('#late').val() , $('#financial_penalties').val() , $('#tax').val())
        console.log(dec , inc);

        $('#net').val(inc - dec);
      })
        $('.validate').validate();
      
        function changeMax(){
          $net.prop('max',$repositeId.find(':selected').data('max'));
        }

        function getEmployeeLoan()
        {
          //get the employee id 
          $.ajax({
            url:'{{route('api.employee-loan')}}',
            type:'POST',
            data:{
              date:$date.val(),
              id:$employeeId.find(':selected').val()
            },
            success:function(data){
              $loan.val(data.loans)
            },
            error:function(err){
              console.log(err)
            }
          })
        }


        $openEmployeeModal.click(function(){
          $.ajax({
            url:'{{route('api.employee-attendance')}}',
            type:'POST',
            data:{
              from:$from.val(),
              to:$to.val(),
              id: $employeeId.find(':selected').val()
            },
            success:function(data){
              console.log(data);
              $('#absense-in-modal').text(data.absence)
              $('#absense-with-permission').text(data.absenceWithPermission)
              $('#presense').text(data.presence)
            },
            error:function(err){
              
            }
          }).then(function(){
            $employeeModal.modal('show');

          })
        })
    })

</script>
@endpush