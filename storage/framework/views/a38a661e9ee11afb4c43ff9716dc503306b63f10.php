<?php $__env->startSection('title','الوظائف'); ?>
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
            <form role="form" class="validate" action="<?php echo e(route('jobs.store')); ?>" method="POST" enctype="multipart/form-data">
            <?php echo e(csrf_field()); ?>

              <div class="box-body">

                <div class="row">
                  <div class="col-md-12">
                    <div class="form-group">
                      <label for="name">الاسم</label>
                      <input type="text"  required class="form-control" name="name" id="name">
                    </div>
    
                  </div>
                </div>
              
             
           

                          
             
                      
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="description">الوصف </label>
                            <textarea class="form-control" name="description" id="description"></textarea>
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
    </div>
<?php $__env->stopSection(); ?>
<?php $__env->startPush('scripts'); ?>
<script>
    $(document).ready(function(){

        $('.validate').validate({
          rules:{
            name:{
              remote:{
                  type:'post',
                  url:'<?php echo e(route('validate')); ?>',
                  data:{
                      field:"name",
                      value:function()
                      {
                          return $('[name=name]').val();
                      },
                      method:'unique:jobs,name',
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