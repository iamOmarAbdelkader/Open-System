   <ul class="sidebar-menu" data-widget="tree">
        <li class="header"> العناصر الاساسية</li>
     
        @if(in_array('users',$perms))        
        <li class="{{request()->is('*users*')?'active':''}}">
          <a href="{{route('users.index')}}">
            <i class="fa fa-user"></i> <span>المستخدمين</span>
          </a>
        </li>
        <li class="{{request()->is('*roles*')?'active':''}}">
          <a href="{{route('roles.index')}}">
            <i class="fa fa-key"></i> <span>مستوي الصلاحيات</span>
          </a>
        </li>
        @endif
 

        @if(in_array('clients',$perms))                        
        <li class="{{request()->is('client*') ||  request()->is('accounts/client*') ?'active':''}}"> 
          <a href="{{route('clients.index')}}">
            <i class="fa fa-user"></i> <span>العملاء</span>
          </a>
        </li>
        
        @endif

        @if(in_array('actors',$perms))                           
        <li class="{{request()->is('*actors*') ?'active':''}}"> 
            <a href="{{route('actors.index')}}">
              <i class="fa fa-users"></i> <span>ممثلين الموردين</span>
            </a>
          </li>
        @endif

        @if(in_array('supplier',$perms))                           
        <li class="{{request()->is('supplier*') || request()->is('accounts/supplier*')?'active':''}}"> 
            <a href="{{route('suppliers.index')}}">
              <i class="fa fa-users"></i> <span>الموردين</span>
            </a>
          </li>
          @endif
        @if(in_array('jobs',$perms))                           
          <li class="{{request()->is('*jobs*') ?'active':''}}"> 
              <a href="{{route('jobs.index')}}">
                <i class="fa fa-users"></i> <span>الوظائف</span>
              </a>
            </li>
          @endif

        @if(in_array('employees',$perms))                           
          <li class="{{request()->is('*employees*') ?'active':''}}"> 
              <a href="{{route('employees.index')}}">
                <i class="fa fa-users"></i> <span>الموظفين</span>
              </a>
            </li>
            @endif
        @if(in_array('stores',$perms))                           
        <li class="{{request()->is('*stores*') ?'active':''}}"> 
            <a href="{{route('stores.index')}}">
              <i class="fa fa-user"></i> <span>المخازن</span>
            </a>
          </li>
          @endif

        @if(in_array('reposites',$perms))                           
          <li class="{{request()->is('*reposites*') ?'active':''}}"> 
              <a href="{{route('reposites.index')}}">
                <i class="fa fa-money"></i> <span>الخزن</span>
              </a>
            </li>
          @endif
        @if(in_array('items',$perms))                           
            <li class="{{request()->is('*items*') ?'active':''}}"> 
              <a href="{{route('items.index')}}">
                <i class="fa fa-list-ol"></i> <span>الاصناف</span>
              </a>
            </li>
            @endif
     

      <li class="header"> العمليات</li>

      @if(in_array('settings',$perms))                           
      <li class="{{request()->is('*meta*') ?'active':''}}"> 
          <a href="{{route('meta.index')}}">
            <i class="fa fa-cogs"></i> <span> الاعدادات (الاصناف) </span>
          </a>
        </li>
        @endif

      @if(in_array('buy',$perms))                           
        <li class="{{request()->is('orders-out*') ?'active':''}}"> 
          <a href="{{route('orders-out.index')}}">
            <i class="fa fa-chevron-left"></i> <span>شراء من مورد</span>
          </a>
        </li>

        <li class="{{request()->is('return-orders-out*') ?'active':''}}"> 
          <a href="{{route('return-orders-out.index')}}">
            <i class="fa fa-chevron-right"></i> <span>مرتجع الي مورد</span>
          </a>
        </li>
        @endif
        

      @if(in_array('sell',$perms))                           

        <li class="{{request()->is('orders-in*') ?'active':''}}"> 
          <a href="{{route('orders-in.index')}}">
            <i class="fa fa-chevron-right"></i> <span>بيع الي عميل</span>
          </a>
        </li>

         <li class="{{request()->is('return-orders-in*') ?'active':''}}"> 
          <a href="{{route('return-orders-in.index')}}">
            <i class="fa fa-chevron-left"></i> <span>مرتجع من عميل</span>
          </a>
        </li>
        @endif

      @if(in_array('load',$perms))                           

        <li class="{{request()->is('load*') ?'active':''}}"> 
          <a href="{{route('load.index')}}">
            <i class="fa fa-truck"></i> <span>تحميل</span>
          </a>
        </li>
        @endif

      @if(in_array('loan',$perms))                           

        <li class="{{request()->is('*loan*') ?'active':''}}"> 
            <a href="{{route('loans.index')}}">
              <i class="fa fa-money"></i> <span>سلف</span>
            </a>
          </li>
          @endif
      @if(in_array('salary',$perms))                           

          <li class="{{request()->is('*salary*') ?'active':''}}"> 
              <a href="{{route('salary.index')}}">
                <i class="fa fa-money"></i> <span>المرتبات</span>
              </a>
            </li>
            @endif
            
      @if(in_array('attendance',$perms))                           

          <li class="{{request()->is('attendance*') ?'active':''}}"> 
              <a href="{{route('attendance.index')}}">
                <i class="fa  fa-calendar"></i> <span>الحضور والانصراف</span>
              </a>
            </li>
          
            @endif 

        @if(in_array('daily',$perms))                           
            <li class="{{request()->is('*daily*') ?'active':''}}"> 
              <a href="{{route('daily.index')}}">
                <i class="fa fa-list-ol"></i> <span>التعاملات اليومية</span>
              </a>
            </li>
            @endif


      <li class="header"> التقارير </li>

      @if(in_array('reports',$perms))                           
      <li class="{{str_contains(request()->route()->getName(),'reports')?'active':''}}">
         <a href="{{route('reports.index')}}">
           <i class="fa   fa-bar-chart"></i> <span>  التقارير</span>
         </a>
       </li>
        @endif 


    </ul>       