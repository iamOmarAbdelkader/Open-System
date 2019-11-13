<a href="<?php echo e(route('roles.edit',$id)); ?>" class="btn  btn-sm btn-warning  btn-flat">تعديل</a>
<?php if($id != 1): ?>
<form class="inline" action="<?php echo e(route('roles.destroy',$id)); ?>" method="POST">
<?php echo e(csrf_field()); ?>

<?php echo e(method_field('DELETE')); ?>

    <button role="submit" class="btn btn-sm confirm btn-danger  btn-flat"> 
        حذف
    </button>
</form>
<?php endif; ?>