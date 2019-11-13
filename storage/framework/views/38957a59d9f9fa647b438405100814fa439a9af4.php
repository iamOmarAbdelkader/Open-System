<?php $__env->startSection('content'); ?>
<div class="row">
    <div class="col-md-4">
            <div class="info-box">
            <span class="info-box-icon bg-aqua"><i class="fa fa-users"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">العملاء</span>
              <span class="info-box-number"><?php echo e($clients); ?></span>
            </div>
            <!-- /.info-box-content -->
          </div>    
    </div>


     <div class="col-md-4">
            <div class="info-box">
            <span class="info-box-icon bg-aqua"><i class="fa fa-users"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">الموردين</span>
              <span class="info-box-number"><?php echo e($suppliers); ?></span>
            </div>
            <!-- /.info-box-content -->
          </div>    
    </div>

     <div class="col-md-4">
            <div class="info-box">
            <span class="info-box-icon bg-aqua"><i class="fa fa-users"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">الموظفين</span>
              <span class="info-box-number"><?php echo e($employees); ?></span>
            </div>
            <!-- /.info-box-content -->
          </div>    
    </div>


     <div class="col-md-4">
            <div class="info-box">
            <span class="info-box-icon bg-aqua"><i class="fa fa-money"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">اجمالي المبيعات</span>
              <span class="info-box-number"><?php echo e($ordersIn); ?></span>
            </div>
            <!-- /.info-box-content -->
          </div>    
    </div>

      <div class="col-md-4">
            <div class="info-box">
            <span class="info-box-icon bg-aqua"><i class="fa fa-money"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">اجمالي المرتجعات</span>
              <span class="info-box-number"><?php echo e($ordersOut); ?></span>
            </div>
            <!-- /.info-box-content -->
          </div>    
    </div>


     <div class="col-md-4">
            <div class="info-box">
            <span class="info-box-icon bg-aqua"><i class="fa fa-money"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">الارباح</span>
              <span class="info-box-number"><?php echo e($profits); ?></span>
            </div>
            <!-- /.info-box-content -->
          </div>    
    </div>


    <div class="col-md-12">
            <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
              <li class="active"><a href="#quantities-less-than-tab" data-toggle="tab" aria-expanded="true">كميات اقل من 10</a></li>
            </ul>
            <div class="tab-content">
              <div class="tab-pane  active" id="quantities-less-than-tab">
                 <div class="table-responsive">
                     <table width="100%" id="quantities-less-than-table" class="table table-bordered"></table> 
                </div>
              </div>
              <!-- /.tab-pane -->
            </div>
            <!-- /.tab-content -->
          </div>

    
    </div>

</div>
<?php $__env->stopSection(); ?>





<?php $__env->startPush('scripts'); ?>
<script src="<?php echo e(asset('vendor/datatables/buttons.server-side.js')); ?>"></script>

<script>
  $(document).ready(function(){
        $('#quantities-less-than-table').DataTable({
                dom:'Bfrtip',
                language:{
                url:'<?php echo e(url('/vendor/datatables/arabic.json')); ?>'
                },
                processing: true,
                serverSide: true,
                ajax: {
                type:'POST',
                url:'<?php echo e(route('home.quantities-less-than')); ?>'
                },
                columns: [
                    { data: 'item', name: 'items.name',title:'الصنف' },
                    { data: 'store', name: 'stores.name',title:'المخزن' },
                    { data: 'quantity', name: 'quantity',title:'الكمية' },
                ],
                order:[],
                buttons: ['reset','reload']
            });

   })
 

 

</script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('layout.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>