<a href="{{route('accounts.edit',$id)}}" class="btn btn-sm  btn-warning  btn-flat"> <i class="fa fa-edit"></i>
</a>
<form action="{{route('accounts.destroy',$id)}}" class="inline" method="POST">
{{csrf_field()}}
{{method_field('DELETE')}}
    <button user="submit" class="btn btn-sm confirm btn-danger  btn-flat"> 
            <i class="fa fa-close"></i>
    </button>
</form>