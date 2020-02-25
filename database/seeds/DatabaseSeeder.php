<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $user = App\User::create([
        	'name'	=>	'super Admin',
        	'role_id'	=>	'2',
            'role_name' =>  'superadmin',
        	'email'	=>	'superadmin@blog.com',
        	'password'	=>	bcrypt('superadmin'),
        ]);

         $user = App\User::create([
        	'name'	=>	'seller',
        	'role_id'	=>	'1',
            'role_name' =>  'seller',
        	'email'	=>	'seller@blog.com',
        	'password'	=>	bcrypt('seller'),
        ]);

          $user = App\User::create([
        	'name'	=>	'user',
        	'role_id'	=>	'3',
            'role_name' =>  'user',
        	'email'	=>	'user@blog.com',
        	'password'	=>	bcrypt('user'),
        ]);

        $role = App\Role::create([
        	'name'	=>	'Seller',
        	'slug'	=>	'seller',
        	'description'	=>	'This is selller role',
        ]);

         $role = App\Role::create([
        	'name'	=>	'super admin',
        	'slug'	=>	'super Admin',
        	'description'	=>	'This is superAdmin role',
        ]);

          $role = App\Role::create([
        	'name'	=>	'user',
        	'slug'	=>	'user',
        	'description'	=>	'This is user role',
        ]);

       
    }
}
