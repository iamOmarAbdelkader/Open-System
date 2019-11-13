@if($canBeReturned)
<a href="{{route('return-orders-in.create',$id)}}" class="btn  btn-sm btn-default  btn-flat">مرتجع</a>
@endif
<a href="{{route('orders-in.show',$id)}}" class="btn  btn-sm btn-info  btn-flat">عرض</a>
{{--  <a href="{{route('orders-in.edit',$id)}}" class="btn btn-sm  btn-warning  btn-flat">تعديل</a>  --}}
<form action="{{route('orders-in.destroy',$id)}}" class="inline" method="POST">
{{csrf_field()}}
{{method_field('DELETE')}}
    <button user="submit" class="btn btn-sm confirm btn-danger  btn-flat"> 
        حذف
    </button>
</form>