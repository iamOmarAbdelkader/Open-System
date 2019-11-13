@extends('layout.app')
@section('title','الحضور و الانصراف')
@section('sub-title','الرئسية')
@section('content')
<div class="row">
    <div class="col-md-12">
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">الحضور و الانصراف</h3>
              <div class="box-btn">
              
                

<!-- Button trigger modal -->
<button type="button" class="btn btn-primary btn-flat btn-sm" data-toggle="modal" data-target="#modal">
  <i class="fa fa-calendar"></i>
</button>



    <!-- Modal -->
    <div class="modal fade" id="modal" tabindex="-1" role="dialog" aria-labelledby="modalLabel">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
        <form class="validate">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title" id="modalLabel"> اختر التاريخ</h4>
          </div>
          <div class="modal-body">
            <div class="row"> 
                <div class="col-sm-12">
                  <div class="form-group">
                    <label for="date">التاريخ</label>
                    <input type="text" id="date"  required class="form-control date" name="date" value="{{Carbon\Carbon::now()->toDateString()}}">
                  </div>
                </div>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button"   class="btn btn-default btn-sm btn-flat" data-dismiss="modal">الغاء</button>
            <button type="submit" id="accept" class="btn btn-primary btn-sm btn-flat">موافق</button>
          </div>
          </form>
        </div>
      </div>
    </div>



              </div>
                
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
<script>


  var $modal = $('#modal');
  var $accept = $('#accept')
  var $date = $('#date');
  var date = '{{Carbon\Carbon::now()->toDateString()}}';
  var $form = $('.validate');
  var $table  = $('.table');

  $(document).ready(function(){
    $form.validate();
    $form.on('submit',function(e){
      e.preventDefault();
      if($form.valid()){
          date = $date.val();
          $table.DataTable().clear().draw();
          $modal.modal('hide');
      }

    })

    $(document).on('change','.observe',function(){
      var key = null;
      var value = null;
      var employee_id = $(this).data('employee')
      key =  $(this).data('name')
      if($(this).data('is-check')){
        value = $(this).prop('checked')?1:0;
      } else {
        value = $(this).val()
      }

      data = {
        employee_id: employee_id , 
        date: $date.val(),
        key: key,
        value: value
      };

      //send ajax request

      $.ajax({
        url: '{{route('api.attendance-store')}}',
        data:data,
        type:'POST',
        success:function(data){
          $table.DataTable().clear().draw();
           iziToast.success({
                    timeout: 0,
                    transitionIn: 'flipInX',
                    transitionOut: 'flipOutX',
                    position:'bottomLeft',
                    rtl:true,
                    message: 'تم التعديل بنجاح ',
            });
            console.log(data);
        },
        error:function(err){
          console.log(err);
           iziToast.error({
                    timeout: 0,
                    transitionIn: 'flipInX',
                    transitionOut: 'flipOutX',
                    position:'bottomLeft',
                    rtl:true,
                    message: 'خطا بالسيرفر ',
            });
        }
      })
    })


    $(document).on('click','.destroy',function(){
      id = $(this).data('id');
      $.ajax({
        url: '{{route('api.attendance-destroy')}}',
        data:{id: id},
        type:'DELETE',
        success:function(data){
          $table.DataTable().clear().draw();
           iziToast.success({
                    timeout: 0,
                    transitionIn: 'flipInX',
                    transitionOut: 'flipOutX',
                    position:'bottomLeft',
                    rtl:true,
                    message: 'تمت اعادة الضبط بنجاح ',
            });
            console.log(data);
        },
        error:function(err){
          console.log(err);
           iziToast.error({
                    timeout: 0,
                    transitionIn: 'flipInX',
                    transitionOut: 'flipOutX',
                    position:'bottomLeft',
                    rtl:true,
                    message: 'خطا بالسيرفر ',
            });
        }
      })
    })

  })
</script>
@endpush 


@push('scripts')
<script src="{{asset('vendor/datatables/buttons.server-side.js')}}"></script>
{!! $dataTable->scripts() !!}
@endpush 