<?php $__env->startSection('title','التقارير'); ?>
<?php $__env->startSection('sub-title','الرئسية'); ?>
<?php $__env->startSection('content'); ?>
<div class="row">
    <div class="col-md-12">
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">التقارير</h3>
                
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <div class="row">
                  <div class="col-md-4">
                    <a  class="btn btn-block btn-primary btn-sm btn-flat"  href="<?php echo e(route('reports.client.index')); ?>">كشف حساب عميل</a>
                  </div>

                  <div class="col-md-4">
                    <a class="btn btn-block btn-primary btn-sm btn-flat" href="<?php echo e(route('reports.supplier.index')); ?>">كشف حساب مورد</a>
                  </div>

                   <div class="col-md-4">
                    <a class="btn btn-block btn-primary btn-sm btn-flat" href="<?php echo e(route('reports.reposite.index')); ?>">كشف حساب خزنة</a>
                  </div>

                  <div class="col-md-4">
                    <a class="btn btn-block btn-primary btn-sm btn-flat" href="<?php echo e(route('reports.load.index')); ?>">التحميل بين المخازن</a>
                  </div>

                  <div class="col-md-4">
                    <a class="btn btn-block btn-primary btn-sm btn-flat" href="<?php echo e(route('reports.employee.index')); ?>">تاريخ تعيين الموظفين</a>
                  </div>


                    <div class="col-md-4">
                    <a class="btn btn-block btn-primary btn-sm btn-flat" href="<?php echo e(route('reports.attendance.index')); ?>">حضور وانصراف  الموظفين</a>
                  </div>

                </div>
            </div>
            <!-- /.box-body -->

          </div>
          <!-- /.box -->
        </div>

</div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layout.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>