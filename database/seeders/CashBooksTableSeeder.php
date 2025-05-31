<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class CashBooksTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {


        \DB::table('cash_books')->delete();

        \DB::table('cash_books')->insert(array (
            0 =>
            array (
                'id' => 1,
                'code' => 'KT',
                'name' => 'Kas Tunai',
                'description' => 'Kas Tunai',
                'is_active' => 1,
                'begining_balance' => '0.00',
                'ending_balance' => '0.00',
                'deleted_at' => NULL,
                'created_at' => '2025-05-28 09:45:46',
                'updated_at' => '2025-05-28 09:45:46',
            ),
            1 =>
            array (
                'id' => 2,
                'code' => 'BSI',
                'name' => 'Bank Syariah Indonesia',
                'description' => 'Bank Syariah Indonesia',
                'is_active' => 1,
                'begining_balance' => '0.00',
                'ending_balance' => '0.00',
                'deleted_at' => NULL,
                'created_at' => '2025-05-28 09:46:37',
                'updated_at' => '2025-05-28 09:48:14',
            ),
            2 =>
            array (
                'id' => 3,
                'code' => 'BRI',
                'name' => 'Bank Rakyat Indonesia',
                'description' => 'Bank Rakyat Indonesia',
                'is_active' => 1,
                'begining_balance' => '0.00',
                'ending_balance' => '0.00',
                'deleted_at' => NULL,
                'created_at' => '2025-05-28 09:47:14',
                'updated_at' => '2025-05-28 09:48:02',
            ),
        ));


    }
}