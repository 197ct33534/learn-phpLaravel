<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // DB::statement('SET FOREIGN_KEY_CHECKS = 0');
        // $groupID = DB::table('groups')->insertGetId([
        //     'name' => 'Administrator',
        //     'user_id' => 0,
        //     'created_at' => date('Y-m-d H:i:s'),
        //     'updated_at' => date('Y-m-d H:i:s'),

        // ]);
        // DB::statement('SET FOREIGN_KEY_CHECKS = 1');
        // if ($groupID > 0) {
        //     $userID = DB::table('users')->insertGetId([
        //         'name' => 'Trung Nghĩa',
        //         'email' => 'trantrungnghia07122001@gmail.com',
        //         'password' => Hash::make(123456),
        //         'group_id' => $groupID,
        //         'user_id' => 0,
        //         'created_at' => date('Y-m-d H:i:s'),
        //         'updated_at' => date('Y-m-d H:i:s'),

        //     ]);
        //     if ($userID > 0) {
        //         for ($i = 0; $i < 5; $i++) {
        //             DB::table('posts')->insert([
        //                 'title' => 'What is Lorem Ipsum? ' . $i,
        //                 'content' => $i . 'It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum',
        //                 'user_id' => $userID,
        //                 'created_at' => date('Y-m-d H:i:s'),
        //                 'updated_at' => date('Y-m-d H:i:s'),
        //             ]);
        //         }
        //     }
        // }

        DB::table('modules')->insert([
            'name' => 'users',
            'title' => 'quản lí người dùng',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);
        DB::table('modules')->insert([
            'name' => 'groups',
            'title' => 'quản lí nhóm',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);
        DB::table('modules')->insert([
            'name' => 'posts',
            'title' => 'quản lí bài viết',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);
    }
}
