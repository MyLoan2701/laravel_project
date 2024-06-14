<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Admin;
use App\Models\Role;

class AdminTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Admin::truncate();
        
        $admin_role = Role::where('name_role', 'Admin')->first();
        $admin = Admin::create([
            'email_admin' => 'admin@gmail.com',
            'password_admin' => md5('123456'),
            'name_admin' => 'Admin',
            'phone_admin' => '0936485721',
            'address_admin' => '69, P.Phúc Xá, Phường Phúc Xá, Quận Ba Đình, Thành phố Hà Nội',
            'sex_admin' => 'Nữ',
            'hometown_admin' => 'Phường Phúc Xá, Quận Ba Đình, Thành phố Hà Nội',
            'birth_admin' => '2000-11-20',
        ]);

        $admin->role()->attach($admin_role);
    }
}
