<?php $__env->startSection('title','مستوي الصلاحيات'); ?>
<?php $__env->startSection('sub-title','اضافة'); ?>
<?php $__env->startSection('content'); ?>
    <div class="row">
        <div class="col-md-12">
          <!-- general form elements -->
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title"> اضافة </h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form role="form" class="validate" action="<?php echo e(route('roles.store')); ?>" method="POST">
            <?php echo e(csrf_field()); ?>

              <div class="box-body">

                <div class="form-group">
                  <label for="name">الاسم</label>
                  <input type="text" class="form-control" name="name" id="name">
                </div>

               

           

            


                <div class="form-group">
                  <label for="permissions">الصلاحيات</label>
                    <select class="form-control" name="permissions[]" id="permissions" multiple>
                        <?php $__currentLoopData = $permissions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $permission): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($permission->id); ?>"><?php echo e($permission->display_name); ?></option>                               
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
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
    </div>
<?php $__env->stopSection(); ?>
<?php $__env->startPush('scripts'); ?>
<script>
    $(document).ready(function(){
        $('.validate').validate({
          rules:{
            name:{
                required:true,
                remote:{
                    type:'post',
                    url:'<?php echo e(route('validate')); ?>',
                    data:{
                        field:"name",
                        value:function()
                        {
                            return $('[name=name]').val();
                        },
                        method:'unique:roles',
                    }
                    }
            }
            },
            messages:{
                name:{
                    remote:'هذه القيمة موجودة مسبقا'
                }
            }
        })
    })

</script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('layout.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>