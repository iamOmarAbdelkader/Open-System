   <ul class="sidebar-menu" data-widget="tree">
        <li class="header"> العناصر الاساسية</li>
     
        <?php if(in_array('users',$perms)): ?>        
        <li class="<?php echo e(request()->is('*users*')?'active':''); ?>">
          <a href="<?php echo e(route('users.index')); ?>">
            <i class="fa fa-user"></i> <span>المستخدمين</span>
          </a>
        </li>
        <li class="<?php echo e(request()->is('*roles*')?'active':''); ?>">
          <a href="<?php echo e(route('roles.index')); ?>">
            <i class="fa fa-key"></i> <span>مستوي الصلاحيات</span>
          </a>
        </li>
        <?php endif; ?>
 

        <?php if(in_array('clients',$perms)): ?>                        
        <li class="<?php echo e(request()->is('client*') ||  request()->is('accounts/client*') ?'active':''); ?>"> 
          <a href="<?php echo e(route('clients.index')); ?>">
            <i class="fa fa-user"></i> <span>العملاء</span>
          </a>
        </li>
        
        <?php endif; ?>

        <?php if(in_array('actors',$perms)): ?>                           
        <li class="<?php echo e(request()->is('*actors*') ?'active':''); ?>"> 
            <a href="<?php echo e(route('actors.index')); ?>">
              <i class="fa fa-users"></i> <span>ممثلين الموردين</span>
            </a>
          </li>
        <?php endif; ?>

        <?php if(in_array('supplier',$perms)): ?>                           
        <li class="<?php echo e(request()->is('supplier*') || request()->is('accounts/supplier*')?'active':''); ?>"> 
            <a href="<?php echo e(route('suppliers.index')); ?>">
              <i class="fa fa-users"></i> <span>الموردين</span>
            </a>
          </li>
          <?php endif; ?>
        <?php if(in_array('jobs',$perms)): ?>                           
          <li class="<?php echo e(request()->is('*jobs*') ?'active':''); ?>"> 
              <a href="<?php echo e(route('jobs.index')); ?>">
                <i class="fa fa-users"></i> <span>الوظائف</span>
              </a>
            </li>
          <?php endif; ?>

        <?php if(in_array('employees',$perms)): ?>                           
          <li class="<?php echo e(request()->is('*employees*') ?'active':''); ?>"> 
              <a href="<?php echo e(route('employees.index')); ?>">
                <i class="fa fa-users"></i> <span>الموظفين</span>
              </a>
            </li>
            <?php endif; ?>
        <?php if(in_array('stores',$perms)): ?>                           
        <li class="<?php echo e(request()->is('*stores*') ?'active':''); ?>"> 
            <a href="<?php echo e(route('stores.index')); ?>">
              <i class="fa fa-user"></i> <span>المخازن</span>
            </a>
          </li>
          <?php endif; ?>

        <?php if(in_array('reposites',$perms)): ?>                           
          <li class="<?php echo e(request()->is('*reposites*') ?'active':''); ?>"> 
              <a href="<?php echo e(route('reposites.index')); ?>">
                <i class="fa fa-money"></i> <span>الخزن</span>
              </a>
            </li>
          <?php endif; ?>
        <?php if(in_array('items',$perms)): ?>                           
            <li class="<?php echo e(request()->is('*items*') ?'active':''); ?>"> 
              <a href="<?php echo e(route('items.index')); ?>">
                <i class="fa fa-list-ol"></i> <span>الاصناف</span>
              </a>
            </li>
            <?php endif; ?>
     

      <li class="header"> العمليات</li>

      <?php if(in_array('settings',$perms)): ?>                           
      <li class="<?php echo e(request()->is('*meta*') ?'active':''); ?>"> 
          <a href="<?php echo e(route('meta.index')); ?>">
            <i class="fa fa-cogs"></i> <span> الاعدادات (الاصناف) </span>
          </a>
        </li>
        <?php endif; ?>

      <?php if(in_array('buy',$perms)): ?>                           
        <li class="<?php echo e(request()->is('orders-out*') ?'active':''); ?>"> 
          <a href="<?php echo e(route('orders-out.index')); ?>">
            <i class="fa fa-chevron-left"></i> <span>شراء من مورد</span>
          </a>
        </li>

        <li class="<?php echo e(request()->is('return-orders-out*') ?'active':''); ?>"> 
          <a href="<?php echo e(route('return-orders-out.index')); ?>">
            <i class="fa fa-chevron-right"></i> <span>مرتجع الي مورد</span>
          </a>
        </li>
        <?php endif; ?>
        

      <?php if(in_array('sell',$perms)): ?>                           

        <li class="<?php echo e(request()->is('orders-in*') ?'active':''); ?>"> 
          <a href="<?php echo e(route('orders-in.index')); ?>">
            <i class="fa fa-chevron-right"></i> <span>بيع الي عميل</span>
          </a>
        </li>

         <li class="<?php echo e(request()->is('return-orders-in*') ?'active':''); ?>"> 
          <a href="<?php echo e(route('return-orders-in.index')); ?>">
            <i class="fa fa-chevron-left"></i> <span>مرتجع من عميل</span>
          </a>
        </li>
        <?php endif; ?>

      <?php if(in_array('load',$perms)): ?>                           

        <li class="<?php echo e(request()->is('load*') ?'active':''); ?>"> 
          <a href="<?php echo e(route('load.index')); ?>">
            <i class="fa fa-truck"></i> <span>تحميل</span>
          </a>
        </li>
        <?php endif; ?>

      <?php if(in_array('loan',$perms)): ?>                           

        <li class="<?php echo e(request()->is('*loan*') ?'active':''); ?>"> 
            <a href="<?php echo e(route('loans.index')); ?>">
              <i class="fa fa-money"></i> <span>سلف</span>
            </a>
          </li>
          <?php endif; ?>
      <?php if(in_array('salary',$perms)): ?>                           

          <li class="<?php echo e(request()->is('*salary*') ?'active':''); ?>"> 
              <a href="<?php echo e(route('salary.index')); ?>">
                <i class="fa fa-money"></i> <span>المرتبات</span>
              </a>
            </li>
            <?php endif; ?>
            
      <?php if(in_array('attendance',$perms)): ?>                           

          <li class="<?php echo e(request()->is('attendance*') ?'active':''); ?>"> 
              <a href="<?php echo e(route('attendance.index')); ?>">
                <i class="fa  fa-calendar"></i> <span>الحضور والانصراف</span>
              </a>
            </li>
          
            <?php endif; ?> 

        <?php if(in_array('daily',$perms)): ?>                           
            <li class="<?php echo e(request()->is('*daily*') ?'active':''); ?>"> 
              <a href="<?php echo e(route('daily.index')); ?>">
                <i class="fa fa-list-ol"></i> <span>التعاملات اليومية</span>
              </a>
            </li>
            <?php endif; ?>


      <li class="header"> التقارير </li>

      <?php if(in_array('reports',$perms)): ?>                           
      <li class="<?php echo e(str_contains(request()->route()->getName(),'reports')?'active':''); ?>">
         <a href="<?php echo e(route('reports.index')); ?>">
           <i class="fa   fa-bar-chart"></i> <span>  التقارير</span>
         </a>
       </li>
        <?php endif; ?> 


    </ul>       