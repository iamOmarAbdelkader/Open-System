@extends('layout.app')
@section('title','المستخدمين')
@section('sub-title','اضافة')
@section('content')
    <div class="row">
        <div class="col-md-12">
          <!-- general form elements -->
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title"> اضافة </h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form role="form" class="validate" action="{{route('users.store')}}" method="POST">
            {{csrf_field()}}
              <div class="box-body">

                <div class="form-group">
                  <label for="name">الاسم</label>
                  <input type="text" required class="form-control" name="name" id="name">
                </div>

                <div class="form-group">
                  <label for="user_name">اسم المستخدم</label>
                  <input type="text" class="form-control" name="user_name" id="user_name">
                </div>

                <div class="form-group">
                  <label for="password">كلمة المرور</label>
                  <input type="password" class="form-control" name="password" id="password">
                </div>

                <div class="form-group">

                  <label for="role_id"> مستوي الصلاحيات </label>

                  <select class="form-control" name="role_id">

                        @foreach ($roles as $role)

                            <option value="{{$role->id}}">{{$role->name}}</option>                            

                        @endforeach

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
@stop
@push('scripts')
<script>
    $(document).ready(function(){
        $('.validate').validate({
          rules:{
            user_name:{
                required:true,
                remote:{
                    type:'post',
                    url:'{{route('validate')}}',
                    data:{
                        field:"user_name",
                        value:function()
                        {
                            return $('[name=user_name]').val();
                        },
                        method:'unique:users',
                    }
                    }
            }
            },
            messages:{
              user_name:{
                    remote:'هذه القيمة موجودة مسبقا'
                }
            }
        })
    })

</script>
@endpush