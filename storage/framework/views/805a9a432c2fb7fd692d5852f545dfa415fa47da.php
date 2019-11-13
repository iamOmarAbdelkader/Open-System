
<a href="<?php echo e(route('meta.edit',$id)); ?>" class="btn btn-sm  btn-warning  btn-flat">تعديل</a>
<form action="<?php echo e(route('meta.destroy',$id)); ?>" class="inline" method="POST">
<?php echo e(csrf_field()); ?>

<?php echo e(method_field('DELETE')); ?>

    <button user="submit" class="btn btn-sm confirm btn-danger  btn-flat"> 
        حذف
    </button>
</form>