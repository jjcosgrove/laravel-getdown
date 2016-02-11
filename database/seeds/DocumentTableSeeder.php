<?php

use Illuminate\Database\Seeder;

class DocumentTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('documents')->insert([
            'title' => 'QuickGuide to GetDown',
            'description' => 'A quick introduction on how to use GetDown',
            'content' => '# QuickGuide to GetDown',
            'user_id' => 1
        ]);
    }
}
