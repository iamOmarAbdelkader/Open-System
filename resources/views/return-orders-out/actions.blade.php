<a href="{{route('return-orders-out.show',$id)}}" class="btn  btn-sm btn-info  btn-flat">عرض</a>
<form action="{{route('return-orders-out.destroy',$id)}}" class="inline" method="POST">
{{csrf_field()}}
{{method_field('DELETE')}}
    <button user="submit" class="btn btn-sm confirm btn-danger  btn-flat"> 
        حذف
    </button>
</form>