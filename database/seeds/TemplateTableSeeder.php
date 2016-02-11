<?php

use Illuminate\Database\Seeder;

class TemplateTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         DB::table('templates')->insert([
            'title' => 'Default README.md',
            'description' => 'A starter template for your README.md files',
            'content' => '# Title',
            'user_id' => 1
        ]);
    }
}
