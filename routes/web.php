<?php


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

use App\Models\Permission;
Route::get('t',function(){
  Permission::create(['name'=>'dashboard','display_name'=>'لوحة العدادات']);
});

Route::group(['middleware'=>['auth']],function(){



  

Route::group(['middleware'=>['permission:clients','permission:supplier']],function(){
  Route::resource('accounts','AccountController',['except'=>['index','create']]);
  Route::get('accounts/{owner}/{id}',[
    'uses'=>'AccountController@index',
    'as'=>'accounts.index'
  ]);

  Route::get('accounts/{owner}/{id}/create',[
    'uses'=>'AccountController@create',
    'as'=>'accounts.create'
  ]);

  });

Route::group(['middleware'=>['permission:daily']],function(){
  Route::resource('daily','DailyController');
});

Route::group(['middleware'=>['permission:jobs']],function(){
  Route::resource('jobs','JobController');
});
  Route::group(['middleware'=>['permission:loan']],function(){
     Route::resource('loans','LoanController');
  });
  Route::group(['middleware'=>['permission:salary']],function(){
  Route::resource('salary','SalaryController');
  });

  Route::group(['middleware'=>['permission:attendance']],function(){
    Route::resource('attendance','AttendanceController');
  });

  Route::group(['middleware'=>['permission:load']],function(){
    Route::resource('load','LoadController');
  });

  Route::group(['middleware'=>['permission:buy']],function(){
    Route::resource('orders-out','OrdersOutController', ['except'=>'show']);

    Route::get('orders-out/{Order}',[
      'uses'=>'OrdersOutController@show',
      'as'=>'orders-out.show'
    ]);

    Route::resource('return-orders-out','ReturnOrdersOutController',[
      'only'=>['index']
    ]);

    Route::get('return-orders-out/create/{order}',[
      'uses'=>'ReturnOrdersOutController@create',
      'as'=>'return-orders-out.create'
    ]);

    Route::get('return-orders-out/{Order}',[
      'uses'=>'ReturnOrdersOutController@show',
      'as'=>'return-orders-out.show'
    ]);

    Route::delete('return-orders-out/{order}',[
      'uses'=>'ReturnOrdersOutController@destroy',
      'as'=>'return-orders-out.destroy'
    ]);

    Route::post('return-orders-out/{order}',[
      'uses'=>'ReturnOrdersOutController@store',
      'as'=>'return-orders-out.store'
    ]);
  });

  Route::group(['middleware'=>['permission:sell']],function(){
    Route::resource('orders-in','OrdersInController',['except'=>'show']);
    Route::get('orders-in/{Order}',[
      'uses'=>'OrdersInController@show',
      'as'=>'orders-in.show'
    ]);

    Route::resource('return-orders-in','ReturnOrdersInController',[
      'only'=>['index']
    ]);

    Route::get('return-orders-in/create/{order}',[
      'uses'=>'ReturnOrdersInController@create',
      'as'=>'return-orders-in.create'
    ]);

    Route::get('return-orders-in/{Order}',[
      'uses'=>'ReturnOrdersInController@show',
      'as'=>'return-orders-in.show'
    ]);

    Route::delete('return-orders-in/{order}',[
      'uses'=>'ReturnOrdersInController@destroy',
      'as'=>'return-orders-in.destroy'
    ]);

    Route::post('return-orders-in/{order}',[
      'uses'=>'ReturnOrdersInController@store',
      'as'=>'return-orders-in.store'
    ]);

  });
  Route::group(['middleware'=>['permission:items']],function(){
  Route::resource('items','ItemController');
  });
  Route::group(['middleware'=>['permission:settings']],function(){
    Route::resource('meta','MetaController');
  });
  Route::group(['middleware'=>['permission:users']],function(){
    Route::resource('users','UsersController');
  Route::resource('roles','RolesController');
  });


  Route::group(['middleware'=>['permission:supplier']],function(){
  Route::resource('suppliers','SupplierController');
  });
  Route::group(['middleware'=>['permission:actors']],function(){
    Route::resource('actors','ActorController');
  });

  Route::group(['middleware'=>['permission:employees']],function(){
    Route::resource('employees','EmployeeController');
    Route::get('employees/{employee}/{resource}',[
      'uses'=>'EmployeeController@download',
      'as'=>'employees.download'
    ]);
  });


  Route::group(['middleware'=>['permission:stores']],function(){
    Route::resource('stores','StoreController');
  });

  Route::group(['middleware'=>['permission:reposites']],function(){
    Route::resource('reposites','RepositeController');
  });

  Route::group(['middleware'=>['permission:clients']],function(){
    Route::resource('clients','ClientsController');
  });



  Route::group(['middleware'=>['permission:reports'] ,'namespace'=>'Reports', 'prefix'=>'reports','as'=>'reports.'],function(){
    Route::get('',[
      'uses'=>'ReportsController@index',
      'as'=>'index'
    ]);

   
    Route::group(['prefix'=>'load','as'=>'load.'],function(){
      Route::get('',[
        'uses'=>'LoadController@index',
        'as'=>'index'
      ]);

      Route::any('perform',[
        'uses'=>'LoadController@perform',
        'as'=>'perform'
      ]);
    });


    Route::group(['prefix'=>'employee','as'=>'employee.'],function(){

      Route::get('',[
        'uses'=>'EmployeeController@index',
        'as'=>'index'
      ]);

      Route::any('perform',[
        'uses'=>'EmployeeController@perform',
        'as'=>'perform'
      ]);
    });



    Route::group(['prefix'=>'attendance','as'=>'attendance.'],function(){

      Route::get('',[
        'uses'=>'AttendanceController@index',
        'as'=>'index'
      ]);
       
      Route::any('detailed',[
        'uses'=>'AttendanceController@detailed',
        'as'=>'detailed'
      ]);


      Route::any('abstracted',[
        'uses'=>'AttendanceController@abstracted',
        'as'=>'abstracted'
      ]);

    });


    Route::group(['prefix'=>'client','as'=>'client.'],function(){
      Route::get('',[
        'uses'=>'ClientController@index',
        'as'=>'index'
      ]);

      Route::any('orders-in',[
        'uses'=>'ClientController@ordersIn',
        'as'=>'orders-in'
      ]);

      Route::any('orders-out',[
        'uses'=>'ClientController@ordersOut',
        'as'=>'orders-out'
      ]);

      Route::any('accounts-in',[
        'uses'=>'ClientController@accountsIn',
        'as'=>'accounts-in'
      ]);

      Route::any('accounts-out',[
        'uses'=>'ClientController@accountsOut',
        'as'=>'accounts-out'
      ]);

      Route::any('account',[
        'uses'=>'ClientController@account',
        'as'=>'account'
      ]);


    });


    Route::group(['prefix'=>'supplier','as'=>'supplier.'],function(){
      Route::get('',[
        'uses'=>'SupplierController@index',
        'as'=>'index'
      ]);

      Route::any('orders-in',[
        'uses'=>'SupplierController@ordersIn',
        'as'=>'orders-in'
      ]);

      Route::any('orders-out',[
        'uses'=>'SupplierController@ordersOut',
        'as'=>'orders-out'
      ]);

      Route::any('accounts-in',[
        'uses'=>'SupplierController@accountsIn',
        'as'=>'accounts-in'
      ]);

      Route::any('accounts-out',[
        'uses'=>'SupplierController@accountsOut',
        'as'=>'accounts-out'
      ]);

      Route::any('account',[
        'uses'=>'SupplierController@account',
        'as'=>'account'
      ]);


    });

    Route::group(['prefix'=>'all-suppliers','as'=>'all-suppliers.'],function(){
      Route::get('',[
        'uses'=>'AllSuppliersController@index',
        'as'=>'index'
      ]);

      Route::any('accounts',[
        'uses'=>'AllSuppliersController@accounts',
        'as'=>'accounts'
      ]);
    });


    
    Route::group(['prefix'=>'all-clients','as'=>'all-clients.'],function(){
      Route::get('',[
        'uses'=>'AllClientsController@index',
        'as'=>'index'
      ]);

      Route::any('accounts',[
        'uses'=>'AllClientsController@accounts',
        'as'=>'accounts'
      ]);
    });
    


    Route::group(['prefix'=>'reposite','as'=>'reposite.'],function(){
      Route::get('',[
        'uses'=>'RepositeController@index',
        'as'=>'index'
      ]);

      Route::any('clients-accounts-in',[
        'uses'=>'RepositeController@clientsAccountsIn',
        'as'=>'clients-accounts-in'
      ]);

      Route::any('clients-accounts-out',[
        'uses'=>'RepositeController@clientsAccountsOut',
        'as'=>'clients-accounts-out'
      ]);

      Route::any('suppliers-accounts-in',[
        'uses'=>'RepositeController@suppliersAccountsIn',
        'as'=>'suppliers-accounts-in'
      ]);

      Route::any('suppliers-accounts-out',[
        'uses'=>'RepositeController@suppliersAccountsOut',
        'as'=>'suppliers-accounts-out'
      ]);


      Route::any('daily-in',[
        'uses'=>'RepositeController@dailyIn',
        'as'=>'daily-in'
      ]);

      Route::any('daily-out',[
        'uses'=>'RepositeController@dailyOut',
        'as'=>'daily-out'
      ]);


      Route::any('salaries',[
        'uses'=>'RepositeController@salaries',
        'as'=>'salaries'
      ]);

      Route::any('loans',[
        'uses'=>'RepositeController@loans',
        'as'=>'loans'
      ]);


    });

   

    Route::get('supplier-accounts',[
      'uses'=>'ReportsController@supplierAccounts',
      'as'=>'reports.supplier-accounts'
    ]);


  });

  Route::group(['prefix'=>'home','as'=>'home'],function(){
    Route::get('',[
      'uses'=>'HomeController@index',
      'as'=>''
    ]);
    
    Route::any('quantities-less-than',[
      'uses'=>'HomeController@quantitiesLessThan',
      'as'=>'.quantities-less-than'
    ]);

    Route::any('items-balance',[
      'uses'=>'HomeController@itemsBalance',
      'as'=>'.items-balance'
    ]);

  });
 

  
});


// tree
Route::post('/tree','TreeController@store')->name('tree.store');
Route::post('/tree/destroy','TreeController@destroy')->name('tree.destroy');
Route::post('/tree/update','TreeController@update')->name('tree.update');

// auth routes
Route::redirect('/','/login');

Route::any('/login',[
  'uses'=>'AuthController@login',
  'as'=>'login',
])->middleware('guest');

Route::post('/logout',[
  'uses'=>'AuthController@logout',
  'as'=>'logout',
]);
