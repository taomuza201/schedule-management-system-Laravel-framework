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

use App\Models\Districts;
use Spatie\Permission\Contracts\Role;

//api


Route::get('lecturers/{id}', 'DocumentController@lecturers');


Route::group(['middleware' => ['get.menu']], function () {
    Route::get('/', function () {
        
        if(Auth::check()){
            return view('dashboard.homepage');
        }else{

        }   return view('auth.login');
      
    
    
    });

    Route::group(['middleware' => ['role:user']], function () {
        Route::get('/colors', function () {return view('dashboard.colors');});
        Route::get('/typography', function () {return view('dashboard.typography');});
        Route::get('/charts', function () {return view('dashboard.charts');});
        Route::get('/widgets', function () {return view('dashboard.widgets');});
        Route::get('/404', function () {return view('dashboard.404');});
        Route::get('/500', function () {return view('dashboard.500');});
        Route::prefix('base')->group(function () {
            Route::get('/breadcrumb', function () {return view('dashboard.base.breadcrumb');});
            Route::get('/cards', function () {return view('dashboard.base.cards');});
            Route::get('/carousel', function () {return view('dashboard.base.carousel');});
            Route::get('/collapse', function () {return view('dashboard.base.collapse');});

            Route::get('/forms', function () {return view('dashboard.base.forms');});
            Route::get('/jumbotron', function () {return view('dashboard.base.jumbotron');});
            Route::get('/list-group', function () {return view('dashboard.base.list-group');});
            Route::get('/navs', function () {return view('dashboard.base.navs');});

            Route::get('/pagination', function () {return view('dashboard.base.pagination');});
            Route::get('/popovers', function () {return view('dashboard.base.popovers');});
            Route::get('/progress', function () {return view('dashboard.base.progress');});
            Route::get('/scrollspy', function () {return view('dashboard.base.scrollspy');});

            Route::get('/switches', function () {return view('dashboard.base.switches');});
            Route::get('/tables', function () {return view('dashboard.base.tables');});
            Route::get('/tabs', function () {return view('dashboard.base.tabs');});
            Route::get('/tooltips', function () {return view('dashboard.base.tooltips');});
        });
        Route::prefix('buttons')->group(function () {
            Route::get('/buttons', function () {return view('dashboard.buttons.buttons');});
            Route::get('/button-group', function () {return view('dashboard.buttons.button-group');});
            Route::get('/dropdowns', function () {return view('dashboard.buttons.dropdowns');});
            Route::get('/brand-buttons', function () {return view('dashboard.buttons.brand-buttons');});
        });
        Route::prefix('icon')->group(function () { // word: "icons" - not working as part of adress
            Route::get('/coreui-icons', function () {return view('dashboard.icons.coreui-icons');});
            Route::get('/flags', function () {return view('dashboard.icons.flags');});
            Route::get('/brands', function () {return view('dashboard.icons.brands');});
        });
        Route::prefix('notifications')->group(function () {
            Route::get('/alerts', function () {return view('dashboard.notifications.alerts');});
            Route::get('/badge', function () {return view('dashboard.notifications.badge');});
            Route::get('/modals', function () {return view('dashboard.notifications.modals');});
        });
        Route::resource('notes', 'NotesController');
    });
    Auth::routes();

    Route::resource('resource/{table}/resource', 'ResourceController')->names([
        'index' => 'resource.index',
        'create' => 'resource.create',
        'store' => 'resource.store',
        'show' => 'resource.show',
        'edit' => 'resource.edit',
        'update' => 'resource.update',
        'destroy' => 'resource.destroy',
    ]);

    Route::group(['middleware' => ['role:admin']], function () {

        Route::resource('bread', 'BreadController'); //create BREAD (resource)
        Route::resource('users', 'UsersController');
        Route::post('users/store', 'UsersController@store');
        Route::get('/addusers', function () {
            $districts = Districts::all();
            $roles = DB::table('roles')->select('*')->get();
            return view('dashboard.admin.register', compact('districts', 'roles'));});

        Route::resource('roles', 'RolesController');
        Route::resource('mail', 'MailController');
        Route::get('prepareSend/{id}', 'MailController@prepareSend')->name('prepareSend');
        Route::post('mailSend/{id}', 'MailController@send')->name('mailSend');
        Route::get('/roles/move/move-up', 'RolesController@moveUp')->name('roles.up');
        Route::get('/roles/move/move-down', 'RolesController@moveDown')->name('roles.down');
        Route::prefix('menu/element')->group(function () {
            Route::get('/', 'MenuElementController@index')->name('menu.index');
            Route::get('/move-up', 'MenuElementController@moveUp')->name('menu.up');
            Route::get('/move-down', 'MenuElementController@moveDown')->name('menu.down');
            Route::get('/create', 'MenuElementController@create')->name('menu.create');
            Route::post('/store', 'MenuElementController@store')->name('menu.store');
            Route::get('/get-parents', 'MenuElementController@getParents');
            Route::get('/edit', 'MenuElementController@edit')->name('menu.edit');
            Route::post('/update', 'MenuElementController@update')->name('menu.update');
            Route::get('/show', 'MenuElementController@show')->name('menu.show');
            Route::get('/delete', 'MenuElementController@delete')->name('menu.delete');
        });
        Route::prefix('menu/menu')->group(function () {
            Route::get('/', 'MenuController@index')->name('menu.menu.index');
            Route::get('/create', 'MenuController@create')->name('menu.menu.create');
            Route::post('/store', 'MenuController@store')->name('menu.menu.store');
            Route::get('/edit', 'MenuController@edit')->name('menu.menu.edit');
            Route::post('/update', 'MenuController@update')->name('menu.menu.update');
            Route::get('/delete', 'MenuController@delete')->name('menu.menu.delete');
        });
        Route::prefix('media')->group(function () {
            Route::get('/', 'MediaController@index')->name('media.folder.index');
            Route::get('/folder/store', 'MediaController@folderAdd')->name('media.folder.add');
            Route::post('/folder/update', 'MediaController@folderUpdate')->name('media.folder.update');
            Route::get('/folder', 'MediaController@folder')->name('media.folder');
            Route::post('/folder/move', 'MediaController@folderMove')->name('media.folder.move');
            Route::post('/folder/delete', 'MediaController@folderDelete')->name('media.folder.delete');;

            Route::post('/file/store', 'MediaController@fileAdd')->name('media.file.add');
            Route::get('/file', 'MediaController@file');
            Route::post('/file/delete', 'MediaController@fileDelete')->name('media.file.delete');
            Route::post('/file/update', 'MediaController@fileUpdate')->name('media.file.update');
            Route::post('/file/move', 'MediaController@fileMove')->name('media.file.move');
            Route::post('/file/cropp', 'MediaController@cropp');
            Route::get('/file/copy', 'MediaController@fileCopy')->name('media.file.copy');
        });

        //คณะ
        Route::prefix('faculties')->group(function () {
            Route::get('/', 'FacultiesController@index')->name('faculties.index');
            Route::post('/store', 'FacultiesController@store')->name('faculties.store');
            Route::get('/edit/{id}', 'FacultiesController@edit')->name('faculties.edit');
            Route::post('/update/{id}', 'FacultiesController@update')->name('faculties.update');
            Route::get('/delete/{id}', 'FacultiesController@destroy')->name('faculties.delete');
        });
        //ข้อมูลตำบล
        Route::prefix('districts')->group(function () {
            Route::get('/', 'DistrictsController@index')->name('districts.districts.index');
            // Route::get('/create',   'MenuController@create')->name('menu.menu.create');
            Route::post('/store', 'DistrictsController@store')->name('districts.store');
            Route::get('/edit/{id}', 'DistrictsController@edit')->name('districts.edit');
            Route::post('/update/{id}', 'DistrictsController@update')->name('districts.update');
            Route::get('/delete/{id}', 'DistrictsController@destroy')->name('districts.delete');

        });
        //ประเภทเอกสาร
        Route::prefix('document_types')->group(function () {
            Route::get('/', 'Document_typesController@index')->name('document_types.index');
            Route::post('/store', 'Document_typesController@store')->name('document_types.store');
            Route::get('/edit/{id}', 'Document_typesController@edit')->name('document_types.edit');
            Route::post('/update/{id}', 'Document_typesController@update')->name('document_types.update');
            Route::get('/delete/{id}', 'Document_typesController@destroy')->name('document_types.delete');
        });

        //รปูแบบเอกสาร
        Route::prefix('document_patterns')->group(function () {
            Route::get('/', 'Document_patternsController@index')->name('document_patterns.index');
            Route::post('/store', 'Document_patternsController@store')->name('document_patterns.store');
            Route::get('/edit/{id}', 'Document_patternsController@edit')->name('document_patterns.edit');
            Route::post('/update/{id}', 'Document_patternsController@update')->name('document_patterns.update');
            Route::get('/delete/{id}', 'Document_patternsController@destroy')->name('document_patterns.delete');
        });
        //ค่าต่างๆ
        Route::prefix('costs')->group(function () {
            Route::get('/', 'CostsController@index')->name('costs.index');
            Route::post('/store', 'CostsController@store')->name('costs.store');
            Route::get('/edit/{id}', 'CostsController@edit')->name('costs.edit');
            Route::post('/update/{id}', 'CostsController@update')->name('costs.update');
            Route::get('/delete/{id}', 'CostsController@destroy')->name('costs.delete');
        });
        //ขั้นตอนการทำเอกสาร
        Route::prefix('document_steps')->group(function () {
            Route::get('/', 'Document_stepsController@index')->name('document_steps.index');
            Route::get('/step/{id}', 'Document_stepsController@step')->name('document_steps.step');
            Route::post('/store', 'Document_stepsController@store')->name('document_steps.store');
            Route::get('/edit/{id}', 'Document_stepsController@edit')->name('document_steps.edit');
            Route::post('step/document_steps/update/{id}', 'Document_stepsController@update')->name('document_steps.update');
            Route::get('/delete/{id}', 'Document_stepsController@destroy')->name('document_steps.delete');
            Route::get('/show/{id}', 'Document_stepsController@show')->name('document_steps.show');
        });

        Route::prefix('document_steps_details')->group(function () {
            Route::get('/', 'Document_steps_detailsController@index')->name('document_steps_details.index');
            Route::post('/store', 'Document_steps_detailsController@store')->name('document_steps_details.store');
            Route::get('/edit/{id}', 'Document_steps_detailsController@edit')->name('document_steps_details.edit');
            Route::post('/update/{id}', 'Document_steps_detailsController@update')->name('document_steps_details.update');
            Route::get('/delete/{id}', 'Document_steps_detailsController@destroy')->name('document_steps_details.delete');
        });

        //ประเภทวิทยากร
        Route::prefix('lecturer_types')->group(function () {
            Route::get('/', 'Lecturer_typesController@index')->name('lecturer_types.index');
            Route::post('/store', 'Lecturer_typesController@store')->name('lecturer_types.store');
            Route::get('/edit/{id}', 'Lecturer_typesController@edit')->name('lecturer_types.edit');
            Route::post('/update/{id}', 'Lecturer_typesController@update')->name('lecturer_types.update');
            Route::get('/delete/{id}', 'Lecturer_typesController@destroy')->name('lecturer_types.delete');
        });
        //วิทยากร
        Route::prefix('lecturers')->group(function () {
            Route::get('/', 'LecturerController@index')->name('lecturers.index');
            Route::post('/store', 'LecturerController@store')->name('lecturers.store');
            Route::get('/edit/{id}', 'LecturerController@edit')->name('lecturers.edit');
            Route::post('/update/{id}', 'LecturerController@update')->name('lecturers.update');
            Route::get('/delete/{id}', 'LecturerController@destroy')->name('lecturers.delete');
        });

    });

    Route::group(['middleware' => ['role:user']], function () {
        // ทำเอกสาร
        Route::prefix('document')->group(function () {
            Route::get('/', 'DocumentController@index')->name('document.index');
            Route::get('/make', 'DocumentController@make')->name('document.make');
            Route::post('/makestore', 'DocumentController@makestore')->name('document.makestore');
            Route::post('/store', 'DocumentController@store')->name('document.store');
            Route::get('/edit/{id}', 'DocumentController@edit')->name('document.edit');
            Route::get('/render/{id}', 'DocumentController@render')->name('document.render');
            Route::post('/update/{id}', 'DocumentController@update')->name('document.update');
            Route::get('/delete/{id}', 'DocumentController@destroy')->name('document.delete');


            Route::get('/{id}', 'DocumentController@do');
            Route::get('/fetch', 'DocumentController@fetch');

            Route::post('/nextstep', 'DocumentController@nextstep');
            Route::post('/cancelstep', 'DocumentController@cancelstep');
            Route::post('/upload', 'DocumentController@upload');


            //สร้างอกสาร
            Route::post('/type_1', 'Document_pdfController@type_1');
          
         
        });

        Route::prefix('calendar')->group(function () {
            Route::get('/', 'FullCalenderController@index')->name('calendar.index');
            Route::post('/store', 'FullCalenderController@store')->name('calendar.store');
            Route::post('/update/{id}', 'FullCalenderController@update')->name('calendar.update');
            Route::get('/delete/{id}', 'FullCalenderController@delete')->name('calendar.delete');

            Route::get('/book/{id}', 'FullCalenderController@select_book');


            Route::get('/download/{id}/{month}/{year}', 'FullCalenderController@download')->name('calendar.download');
        });

        Route::prefix('agenda')->group(function () {
            Route::get('/', 'AgendaController@index')->name('agenda.index');
            Route::get('/book/{id}', 'AgendaController@book')->name('agenda.book.index');
            Route::post('/store', 'AgendaController@store')->name('agenda.store');
            // Route::post('/update/{id}', 'AgendaController@update')->name('agenda.update');
            Route::get('/delete/{id}', 'AgendaController@delete')->name('agenda.delete');



            Route::post('/book/{id}/update', 'AgendaController@update')->name('agenda.update');

           

        });


        Route::prefix('tracking')->group(function () {
            Route::get('/', 'TrackingController@index')->name('tracking.index');
            Route::get('/tracking_find/{id}', 'TrackingController@tracking_find');
            Route::get('/tracking_step/{id}/{step}/{status}', 'TrackingController@tracking_step');
            Route::get('/file_emty/{id}/{step}/{status}', 'TrackingController@file_emty');

            Route::post('/cancel', 'TrackingController@cancel')->name('tracking.cancel');
            Route::post('/upload', 'TrackingController@upload')->name('tracking.upload');
            Route::post('/store', 'TrackingController@store')->name('tracking.store');
            Route::get('/download/{month_year}/{districts}', 'TrackingController@download')->name('tracking.download');
        });
      
    });

    Route::post('confirm', 'DocumentController@confirm');

    Route::post('/img-upload', 'AgendaController@imgUplaod')->name('image_upload');
});
