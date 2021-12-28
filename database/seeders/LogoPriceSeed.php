<?php

namespace Database\Seeders;

use App\Models\LogoPrice;
use Illuminate\Database\Seeder;

class LogoPriceSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $prices = [
            [
                'title' => json_encode([
                    'en' => 'Low-res'
                ]),
                'price' => 'free',
                'advantages' => json_encode([
                    'en' => 'PNG file format;200 pixels by 200 pixels'
                ]),
            ],
            [
                'title' => json_encode([
                    'en' => 'High-res'
                ]),
                'price' => '34',
                'currency' => 'USD',
                'symbol' => '$',
                'advantages' => json_encode([
                    'en' => 'PNG (5000 pixels by 5000 pixels);PDF and JPG files, vector SVG'
                ]),
            ],
            [
                'title' => json_encode([
                    'en' => 'Unlimited Package'
                ]),
                'price' => '109',
                'currency' => 'USD',
                'symbol' => '$',
                'advantages' => json_encode([
                    'en' => 'PNG (5000 pixels by 5000 pixels);PDF and JPG files, vector SVG;Get a FREE custom website quote from us.'
                ])
            ],
        ];

        foreach ($prices as $price) {
            LogoPrice::updateOrCreate(
                [
                    'price' => $price['price']
                ],
                $price
            );
        }
    }
}
