<?php $__currentLoopData = $permissions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $permission): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

<span class="label  label-info"><?php echo e($permission->display_name); ?></span>

<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>