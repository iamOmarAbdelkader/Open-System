@extends('layout.app')
@section('title','التقارير')
@section('sub-title','التحميل بين المخازن')
@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
              <li class="active"><a href="#load-tab" data-toggle="tab" aria-expanded="true">المخازن</a></li>
              <li class="pull-left">
                  <button  data-toggle="modal" data-target="#modal" class="btn btn-success btn-flat btn-sm">
                      <i class="fa fa-cog fa-spin"></i>
                    </button>
              </li>
            </ul>
            <div class="tab-content">
              <div class="tab-pane  active" id="load-tab">
                 <div class="table-responsive">
                     <table width="100%" id="load-table" class="table table-bordered"></table> 
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
                        <h4 class="modal-title" id="modalLabel">التحميل بين المخازن</h4>
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
                                <label for="type">التحميل</label>
                                <select name="type" id="type">
                                    <option value="from">من</option>
                                    <option value="to">الي</option>
                                </select>
                            </div>
                        </div>
                    <div class="col-md-12">
                            <div class="form-group">
                                <label for="store_id">المخزن</label>
                                <select name="store_id" id="store_id">
                                    <option value="">الكل</option>
                                    @foreach ($stores as $store)
                                        <option value="{{$store->id}}">{{$store->name}}</option>
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
  $storeId = $('#store_id')
  $type = $('#type')
  $from = $('#from')
  $to = $('#to')

  storeId = null;
  from = null;
  to = null;
  type = null;

  $(document).ready(function(){

  $form.validate();

   $form.submit(function(e){
     e.preventDefault();
     if($form.valid()){
       $modal.modal('hide');
       storeId = $storeId.val();
       from = $from.val();
       to = $to.val();
       type = $type.val();

       $('.table').each(function(index , item){
         $(item).DataTable().clear().draw()
       })
     }
     })

        $('#load-table').DataTable({
                dom:'Bfrtip',
                paging:false,
                language:{
                url:'{{url('/vendor/datatables/arabic.json')}}'
                },
                processing: true,
                serverSide: true,
                ajax: {
                type:'POST',
                url:'{{route('reports.load.perform')}}',
                data:function(data){
                    data.store_id = storeId;
                    data.from = from;
                    data.to = to;
                }
                },
                columns: [
                    { data: 'no', name: 'no',title:'الكود' },
                    { data: 'name', name: 'stores.name',title:'الاسم' },
                    { data: 'date', name: 'date',title:'التاريخ' },
                ],
                buttons: ['excel', 'print']
            });



   })
 

 

</script>
@endpush