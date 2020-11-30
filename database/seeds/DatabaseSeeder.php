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
        // $this->call(UsersTableSeeder::class);
        // DB::table('region')->insert(
        // 	['region_name' => 'Miền Nam','created_at'=>new DateTime()]
        // );
        DB::table('category')->insert([
        	
        	['category_name' => 'Nhà Hàng','created_at'=>new DateTime()],
        	['category_name' => 'Khách Sạn','created_at'=>new DateTime()]

        ]);
    }
}
