<?php

use Illuminate\Database\Seeder;


class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Models\User::class,5)
        ->create(['password'=>'password'])
        ->each(function($user)
        {
            $user->name= $user->id==1?'Kiki':$user->name;
            $user->email= $user->id==1?'mohzulkiflikatili@gmail.com':$user->email;
            $user->kategori= $user->id==1?'Supervisor':$user->kategori;

            $user->name= $user->id==2?'admin':$user->name;
            $user->email= $user->id==2?'admin@gmail.com':$user->email;
            $user->kategori= $user->id==2?'Admin':$user->kategori;

            $user->name= $user->id==3?'surveyor':$user->name;
            $user->email= $user->id==3?'surveyor@gmail.com':$user->email;
            $user->kategori= $user->id==3?'Surveyor':$user->kategori;
            $user->id_instansi= $user->id==3?'2':$user->id_instansi;

            $user->name= $user->id==4?'surveyor2':$user->name;
            $user->email= $user->id==4?'surveyor2@gmail.com':$user->email;
            $user->kategori= $user->id==4?'Surveyor':$user->kategori;
            $user->id_instansi= $user->id==4?'1':$user->id_instansi;

            $user->name= $user->id==5?'surveyor3':$user->name;
            $user->email= $user->id==5?'surveyor3@gmail.com':$user->email;
            $user->kategori= $user->id==5?'Surveyor':$user->kategori;
            $user->id_instansi= $user->id==5?'1':$user->id_instansi;

            // $user->kategori=='Supervisor'?$user->assignRole('Supervisor'):$user->assignRole('Admin');

            if($user->kategori=='Supervisor')$user->assignRole('Supervisor');
            elseif($user->kategori=='Surveyor')$user->assignRole('Surveyor');
            elseif($user->kategori=='Admin')$user->assignRole('Admin');

            $user->save();
        });
    }
}
