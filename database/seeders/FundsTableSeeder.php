<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class FundsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {


        \DB::table('funds')->delete();

        \DB::table('funds')->insert(array (
            0 =>
            array (
                'id' => 2,
                'name' => 'Sedekah Subuh',
                'description' => 'Sedekah Subuh',
                'is_active' => 1,
                'begining_balance' => '0.00',
                'ending_balance' => '0.00',
                'created_at' => '2025-05-28 09:51:31',
                'updated_at' => '2025-05-28 09:51:31',
            ),
            1 =>
            array (
                'id' => 3,
                'name' => 'Tabungan Qurban',
                'description' => 'Tabungan Qurban',
                'is_active' => 1,
                'begining_balance' => '0.00',
                'ending_balance' => '0.00',
                'created_at' => '2025-05-28 09:59:54',
                'updated_at' => '2025-05-28 10:00:14',
            ),
            2 =>
            array (
                'id' => 4,
                'name' => 'Ambulance',
                'description' => 'Ambulance',
                'is_active' => 1,
                'begining_balance' => '0.00',
                'ending_balance' => '0.00',
                'created_at' => '2025-05-28 10:00:10',
                'updated_at' => '2025-05-28 10:00:17',
            ),
            3 =>
            array (
                'id' => 5,
                'name' => 'PHBI',
                'description' => 'Perayaan Hari Besar Islam',
                'is_active' => 1,
                'begining_balance' => '0.00',
                'ending_balance' => '0.00',
                'created_at' => '2025-05-28 10:00:35',
                'updated_at' => '2025-05-28 10:00:35',
            ),
            4 =>
            array (
                'id' => 6,
                'name' => 'Operasional Masjid',
                'description' => 'Operasional Masjid',
                'is_active' => 1,
                'begining_balance' => '0.00',
                'ending_balance' => '0.00',
                'created_at' => '2025-05-28 10:00:49',
                'updated_at' => '2025-05-28 10:02:35',
            ),
            5 =>
            array (
                'id' => 7,
                'name' => 'Muharam',
                'description' => 'Muharam',
                'is_active' => 1,
                'begining_balance' => '0.00',
                'ending_balance' => '0.00',
                'created_at' => '2025-05-28 10:02:55',
                'updated_at' => '2025-05-28 10:02:55',
            ),
        ));


    }
}