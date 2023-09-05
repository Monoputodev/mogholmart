<?php

use Illuminate\Database\Seeder;
use App\Modules\User\Models\Roles;
use App\Modules\Admin\Models\SettingsModel;

use App\User;

use App\Modules\User\Models\Permission;
use Illuminate\Support\Facades\Route;
use App\Modules\User\Models\RolesPermission;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Roles::class, 1)->create();
        factory(User::class, 1)->create();
       
       
        $settingsArray=[
        array( 
            'key'=>'site.name',
            'value'=>'Xotil',
            'type'=>'text',
            'created_at' => now(),
            'updated_at' => now(),
        ),
        array( 
            'key'=>'office.time',
            'value'=>'09:00:00-18:30:00',
            'type'=>'text',
            'created_at' => now(),
            'updated_at' => now(),
        ),
        array( 
            'key'=>'short.cut.icon',
            'value'=>'short.cut.icon.png',
            'type'=>'file',
            'created_at' => now(),
            'updated_at' => now(),
        ),
        array( 
            'key'=>'logo',
            'value'=>'logo.jpg',
            'type'=>'file',
            'created_at' => now(),
            'updated_at' => now(),
        ),
        array( 
            'key'=>'weekend',
            'value'=>'Friday',
            'type'=>'text',
            'created_at' => now(),
            'updated_at' => now(),
        ),
        array( 
            'key'=>'product.image.size',
            'value'=>'1024',
            'type'=>'text',
            'created_at' => now(),
            'updated_at' => now(),
        ),
    ];


    foreach($settingsArray as $settings){
        SettingsModel::create($settings);
    }

   
        //
        $routeCollection = Route::getRoutes();

        foreach ($routeCollection as $value) {

            $data = Permission::where('description',$value->getActionName())->first();

            if (!$data) {
               $model = New Permission;
               $model->method = $value->methods()[0];
               $model->route = $value->uri();
               $model->title = $value->getName();
               $model->description = $value->getActionName();
               $model->status = "active";
               $model->save();

           }else{
            $model = Permission::where('id',$data->id)->first();
            $model->method = $value->methods()[0];
            $model->route = $value->uri();
            $model->title = $value->getName();
            $model->description = $value->getActionName();
            $model->status = "active";
            $model->save();
        }

    }

    $allpermission=Permission::where('status','active')->get();

    foreach ($allpermission as $value) {

        $model = new RolesPermission();
        $model->roles_id = '1';
        $model->permission_id = $value->id;
        $model->status = "active";
        $model->save();
    }



    }
}
