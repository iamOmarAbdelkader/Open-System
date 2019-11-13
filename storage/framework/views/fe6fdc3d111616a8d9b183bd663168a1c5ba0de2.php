<a href="<?php echo e(route('users.edit',$id)); ?>" class="btn  btn-warning btn-sm  btn-flat">تعديل</a>
<?php if($id != 1): ?>
<form action="<?php echo e(route('users.destroy',$id)); ?>" class="inline" method="POST">
<?php echo e(csrf_field()); ?>

<?php echo e(method_field('DELETE')); ?>

    <button user="submit" class="btn btn-sm confirm btn-danger  btn-flat"> 
        حذف
    </button>
</form>
<?php endif; ?>