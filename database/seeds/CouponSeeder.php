<?php

use App\Models\Coupon;
use Illuminate\Database\Seeder;

class CouponSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Coupon::create([
            'code' => 'SPRING20',
            'type' => 'percent',
            'percent_off' => 50
        ]);

        Coupon::create([
            'code' => '10EUROS',
            'type' => 'fixed',
            'value' => 10
        ]);
    }
}
