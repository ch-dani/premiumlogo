<?php

namespace Database\Seeders;

use App\Models\DesignerPlan;
use Illuminate\Database\Seeder;

class DsignerPlanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $plans = [
            [
                'title' => json_encode([
                    'en' => 'Basic package'
                ]),
                'is_black' => true,
                'price' => '79',
                'currency' => 'USD',
                'symbol' => '$',
                'advantages' => json_encode([
                    'en' => 'Logo Design Concepts x 4;Number of Revisions x 1;Standard Delivery Within 5 Days;Number of Designers x 1;100% Satisfaction Guarantee;8 File Formats;24 Hours Email Support'
                ]),
            ],
            [
                'title' => json_encode([
                    'en' => 'Startup Package'
                ]),
                'is_black' => false,
                'price' => '99',
                'currency' => 'USD',
                'symbol' => '$',
                'advantages' => json_encode([
                    'en' => 'Logo Design Concepts x 6;Number of Revisions x 4;Standard Delivery 48 Hours;Business Card Design Included;Business Stationery Included;Number of Designers x 1;100% Satisfaction Guarantee;8 File Formats;24 Hours Email Support'
                ]),
            ],
            [
                'title' => json_encode([
                    'en' => 'Unlimited Package'
                ]),
                'is_black' => true,
                'price' => '129',
                'currency' => 'USD',
                'symbol' => '$',
                'advantages' => json_encode([
                    'en' => 'Logo Design Concepts Unlimited;Number of Revisions Unlimited;Standard Delivery is 24 Hours;Business Card Design Included;Business Stationery Included;Email Signature Included;MS Word Letterhead Included;Number of Designers x 2;100% Satisfaction Guarantee;8 File Formats'
                ])
            ],
        ];

        foreach ($plans as $plan) {
            DesignerPlan::updateOrCreate(
                [
                    'price' => $plan['price']
                ],
                $plan
            );
        }
    }
}
