@extends('layout.app')
@section('title','التقارير')
@section('sub-title','حضور وانصراف  الموظفين')
@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">

              <li class="active"><a href="#attendance-detailed-tab" data-toggle="tab" aria-expanded="true">تفصيلي</a></li>
              <li class=""><a href="#attendance-abstracted-tab" data-toggle="tab" aria-expanded="false">اجمالي</a></li>
              <li class="pull-left">
                  <button  data-toggle="modal" data-target="#modal" class="btn btn-success btn-flat btn-sm">
                      <i class="fa fa-cog fa-spin"></i>
                    </button>
              </li>
            </ul>
            <div class="tab-content">
              <div class="tab-pane  active" id="attendance-detailed-tab">
                 <div class="table-responsive">
                     <table width="100%" id="attendance-detailed-table" class="table table-bordered"></table> 
                </div>
              </div>
              <!-- /.tab-pane -->

                <div class="tab-pane  fade" id="attendance-abstracted-tab">
                 <div class="table-responsive">
                     <table width="100%" id="attendance-abstracted-table" class="table table-bordered"></table> 
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
                        <h4 class="modal-title" id="modalLabel">حضور وانصراف  الموظفين</h4>
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
                                <label for="employee_id">الموظف</label>
                                <select name="employee_id" id="employee_id">
                                    <option value="">الكل</option>
                                    @foreach ($employees as $employee)
                                        <option value="{{$employee->id}}">{{$employee->name}}</option>
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
  $employeeId = $('#employee_id')
  $from = $('#from')
  $to = $('#to')

  employeeId = null;
  from = null;
  to = null;
  type = null;

  $(document).ready(function(){

  $form.validate();

   $form.submit(function(e){
     e.preventDefault();
     if($form.valid()){
       $modal.modal('hide');
       employeeId = $employeeId.val();
       from = $from.val();
       to = $to.val();
       $('.table').each(function(index , item){
         $(item).DataTable().clear().draw()
       })
     }
     })

        $('#attendance-detailed-table').DataTable({
                dom:'Bfrtip',
                paging:false,
                language:{
                url:'{{url('/vendor/datatables/arabic.json')}}'
                },
                processing: true,
                serverSide: true,
                ajax: {
                type:'POST',
                url:'{{route('reports.attendance.detailed')}}',
                data:function(data){
                    data.employee_id = employeeId;
                    data.from = from;
                    data.to = to;
                }
                },
                columns: [
                    { data: 'date', name: 'date',title:'التاريخ' },
                    { data: 'employee', name: 'employees.name',title:'الاسم' },
                    { data: 'job', name: 'jobs.name',title:'الوظيفة' },
                    { data: 'attendance_time', name: 'attendance_time',title:'الحضور' },
                    { data: 'abandonment_time', name: 'abandonment_time',title:'الانصراف' },
                    { data: 'absence_with_permission', name: 'absence_with_permission',title:'غياب  باذن' },
                    { data: 'absence', name: 'absence',title:'غياب' }
                ],
                buttons: ['excel', 'print']
            });

            $('#attendance-abstracted-table').DataTable({
                dom:'Bfrtip',
                paging:false,
                language:{
                url:'{{url('/vendor/datatables/arabic.json')}}'
                },
                processing: true,
                serverSide: true,
                ajax: {
                type:'POST',
                url:'{{route('reports.attendance.abstracted')}}',
                data:function(data){
                    data.employee_id = employeeId;
                    data.from = from;
                    data.to = to;
                }
                },
                columns: [
                    { data: 'employee', name: 'employees.name',title:'الاسم' },
                    { data: 'job', name: 'jobs.name',title:'الوظيفة' },
                    { data: 'attendance', name: 'attendance',title:'الحضور' },
                    { data: 'absence_with_permission', name: 'absence_with_permission',title:'غياب  باذن' },
                    { data: 'absence', name: 'absence',title:'غياب' }
                ],
                buttons: ['excel', 'print']
            })



   })
 

 

</script>
@endpush