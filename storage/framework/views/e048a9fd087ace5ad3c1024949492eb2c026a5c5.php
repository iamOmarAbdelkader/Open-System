<a href="<?php echo e(route('accounts.index',['id'=>$id,'owner'=>'client'])); ?>" class="btn  btn-sm btn-primary  btn-flat">الحسابات</a>
<a href="<?php echo e(route('clients.show',$id)); ?>" class="btn  btn-sm btn-info  btn-flat">عرض</a>
<a href="<?php echo e(route('clients.edit',$id)); ?>" class="btn btn-sm  btn-warning  btn-flat">تعديل</a>
<form action="<?php echo e(route('clients.destroy',$id)); ?>" class="inline" method="POST">
<?php echo e(csrf_field()); ?>

<?php echo e(method_field('DELETE')); ?>

    <button user="submit" class="btn btn-sm confirm btn-danger  btn-flat"> 
        حذف
    </button>
</form>