@extends('layout.app')
@section('title','الموردين')
@section('sub-title','تعديل')
@section('content')
    <div class="row">
        <div class="col-md-12">
          <!-- general form elements -->
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title"> تعديل </h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form role="form" class="validate" action="{{route('suppliers.update',$supplier)}}" method="POST" enctype="multipart/form-data">
            {{csrf_field()}}
            {{method_field('PUT')}}
            <div class="box-body">

                    <div class="row">
                      <div class="col-md-4">
                        <div class="form-group">
                          <label for="name">الاسم</label>
                          <input type="text" class="form-control" name="name" id="name" value="{{$supplier->name}}">
                        </div>
        
                      </div>
                      <div class="col-md-4">
                          <div class="form-group">
                              <label for="email">  البريد الالكتروني</label>
                              <input type="email" class="form-control" name="email" id="email" value="{{$supplier->email}}">
                            </div>  
                      </div> 
    
                      <div class="col-md-4">
                            <div class="form-group">
                                <label for="website"> Web Site</label>
                                <input type="text" class="form-control" name="website" id="website" value="{{$supplier->website}}">
                              </div>
                        </div> 
    
    
                    </div>
                  
                 
                    <div class="row">
                            <div class="col-md-4">
                              
                                    <div class="form-group">
                                            <label for="country_id"> المحافظة</label>
                                            <select class="form-control" name="country_id" id="country_id">
                                                @foreach ($countries as $country )
                                                    <option value="{{$country->id}}" {{$country->id == $supplier->country_id?'selected':''}}>{{$country->name}}</option>
                                                @endforeach
                                            </select>
                                          </div>
                            </div>
    
    
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="address">العنوان</label>
                                <input type="text" class="form-control" name="address" id="address" value="{{$supplier->address}}">
                              </div>
                            </div>
    
                            <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="whatsapp">واتس</label>
                                        <input type="text" class="form-control" name="whatsapp" id="whatsapp" value="{{$supplier->whatsapp}}">
                                      </div>
                                    </div>
                                
                                 
    
                      </div>
    
               
                      <div class="row">
                            <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="phone_1"> تليفون  1</label>
                                        <input type="text" class="form-control" name="phone_1" id="phone_1" value="{{$supplier->phone_1}}">
                                      </div>  
                                </div>       
                          <div class="col-md-4">
                              <div class="form-group">
                                  <label for="phone_2"> تليفون 2</label>
                                  <input type="text" class="form-control" name="phone_2" id="phone_2" value="{{$supplier->phone_2}}">
                              </div>
                          </div>
    
                          <div class="col-md-4">
                                <div class="form-group">
                                    <label for="phone_3"> تليفون  3</label>
                                    <input type="text" class="form-control" name="phone_3" id="phone_3" value="{{$supplier->phone_3}}">
                                  </div>
                            </div>  
                                    
                        </div>
    
                              
                      <div class="row">
                               
                         
                          </div>
    
                          <div class="row">
                                <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="wechat"> wechat</label>
                                            <input type="text" class="form-control" name="wechat" id="wechat" value="{{$supplier->wechat}}">
                                          </div>
                                    </div> 
    
                                 
                                <div class="col-md-4">
                                        <div class="form-group">
                                                <label for="whatsapp"> واتس</label>
                                                <input type="text" class="form-control" name="whatsapp" id="whatsapp" value="{{$supplier->whatsapp}}">
                                        </div>
                                </div>
    
                                <div class="col-md-4">
                              
                                        <div class="form-group">
                                                <label for="actor_id"> الممثل</label>
                                                <select class="form-control" name="actor_id" id="actor_id">
                                                    <option value="">لايوجد</option>
                                                    @foreach ($actors as $actor )
                                                    <option value="{{$actor->id}}" {{$supplier->actor_id == $actor->id?'selected':''}}>{{$actor->name}}</option>
                                                    @endforeach
                                                </select>
                                              </div>
                                </div>
                            </div>
    
    
                          <div class="row">
                                <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="commercial_record">سجل تجاري</label>
                                            <input type="text" class="form-control" name="commercial_record" id="commercial_record" value="{{$supplier->commercial_record}}">
                                          </div>
                                    </div>      
                                <div class="col-md-4">
                                  
                                        <div class="form-group">
                                                <label for="tax_card"> بطاقة ضريبية</label>
                                                <input type="text" class="form-control" name="tax_card" id="tax_card" value="{{$supplier->tax_card}}">
                                        </div>
            
                                </div>
    
                                <div class="col-md-4">
                              
                                        <div class="form-group">
                                                <label for="balance"> رصيد اول المدة</label>
                                                <input type="text" class="form-control" name="balance" id="balance" value="{{$supplier->balance}}">
                                        </div>
            
                                </div>
                              </div>
    
    
        
                          
                    <div class="row">
                        <div class="col-md-12">
                          
                            <div class="form-group">
                                <label for="notes">ملاحظات </label>
                                <textarea class="form-control" name="notes" id="notes">{{$supplier->notes}}</textarea>
                              </div>
    
                        </div>
                      </div>
    
                      <div class="row">
                         
                          
    
                         
    
                            
    
    
                          </div>
    
    
                      
                    <div class="row">
                        <div class="col-md-6">
    
                            <div class="form-group">
                                <label class="file-upload btn-sm btn btn-default">
                                    صورة البطاقة 1 <input type="file"  name="id_image_1"/>
                                </label>
                        </div>
                        </div>
                        <div class="col-md-6">
                        
                            <div class="form-group">
                                <label class="file-upload btn-sm btn btn-default">
                                    صورة البطاقة 2 <input type="file" name="id_image_2"/>
                                </label>
                            </div>
    
                        </div>                  
                      </div>
    
    
                            
    
                           
    
                        
            </div>
                  <!-- /.box-body -->

              <div class="box-footer">
                <button type="submit" class="btn btn-sm btn-success btn-flat">تعديل</button>
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
            email:{
              remote:{
                  type:'post',
                  url:'{{route('validate')}}',
                  data:{
                      field:"email",
                      value:function()
                      {
                          return $('[name=email]').val();
                      },
                      method:'unique:suppliers,email,{{$supplier->id}}',
                  }
                  }
          },
            phone_1:{
              remote:{
                  type:'post',
                  url:'{{route('validate')}}',
                  data:{
                      field:"phone_1",
                      value:function()
                      {
                          return $('[name=phone_1]').val();
                      },
                      method:'unique:suppliers,phone_1,{{$supplier->id}}|unique:suppliers,phone_2,{{$supplier->id}}|unique:suppliers,phone_3,{{$supplier->id}}',
                  }
                  }
          },
            phone_2:{
              remote:{
                  type:'post',
                  url:'{{route('validate')}}',
                  data:{
                      field:"phone_2",
                      value:function()
                      {
                          return $('[name=phone_2]').val();
                      },
                      method:'unique:suppliers,phone_1,{{$supplier->id}}|unique:suppliers,phone_2,{{$supplier->id}}|unique:suppliers,phone_3,{{$supplier->id}}',
                  }
                  }
          },
          phone_3:{
            remote:{
                type:'post',
                url:'{{route('validate')}}',
                data:{
                    field:"phone_3",
                    value:function()
                    {
                        return $('[name=phone_3]').val();
                    },
                    method:'unique:suppliers,phone_1,{{$supplier->id}}|unique:suppliers,phone_2,{{$supplier->id}}|unique:suppliers,phone_3,{{$supplier->id}}',
                }
                }
        },
        id_image_1:{
          extension:'jpg|jpeg|png'
        },
        id_image_2:{
          extension:'jpg|jpeg|png'
        }
            },
            messages:{
              email:{
                remote:'هذه القيمة موجودة مسبقا'
            },
              phone_1:{
                    remote:'هذه القيمة موجودة مسبقا'
                },
                phone_2:{
                  remote:'هذه القيمة موجودة مسبقا'
              },
              phone_3:{
                remote:'هذه القيمة موجودة مسبقا'
            }
            }
        })


    })

</script>
@endpush