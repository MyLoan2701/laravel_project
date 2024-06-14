<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Role;

class RoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Role::truncate(); //Xóa toàn bộ data đã tồn tại trong Role

        Role::create(['name_role' => 'Admin', 'status_role' => 0, 'description_role' => 'Quyền truy cập cao nhất, cho phép bạn sử dụng tất cả chức năng trên trang web.']);
        Role::create(['name_role' => 'Author', 'status_role' => 0, 'description_role' => 'Quyền truy cập bậc hai, cho phép bạn sử dụng các chức năng biên tập trên trang web.']);
        Role::create(['name_role' => 'User', 'status_role' => 0, 'description_role' => 'Quyền truy cập bậc ba, cho phép bạn xem các pages trên trang web.']);
    }
}
