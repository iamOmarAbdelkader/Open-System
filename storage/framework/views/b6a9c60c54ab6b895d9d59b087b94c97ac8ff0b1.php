<?php $__env->startSection('title','مرتجع  الي المورد'); ?>
<?php $__env->startSection('sub-title','الرئسية'); ?>
<?php $__env->startSection('content'); ?>
<div class="row">
    <div class="col-md-12">
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">مرتجع  الي المورد</h3>
              <div class="box-btn">
                    
              </div>
                
            </div>
            <!-- /.box-header -->
            <div class="box-body">
            <div class="table-responsive">
             <?php echo $dataTable->table(['class' => 'table table-bordered']); ?> 
            
            </div>
            </div>

            <!-- /.box-body -->
         
          </div>
          <!-- /.box -->
        </div>

</div>
<?php $__env->stopSection(); ?>
 <?php $__env->startPush('scripts'); ?>
<script src="<?php echo e(asset('vendor/datatables/buttons.server-side.js')); ?>"></script>
<?php echo $dataTable->scripts(); ?>

<?php $__env->stopPush(); ?> 
<?php echo $__env->make('layout.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>