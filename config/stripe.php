<?php

return [

    'trial_days' => 7,
    'model' => \App\Models\Team::class,

    'plans' => [
        [
            'name' => 'Basic',
            'description' => 'Basic is right.',
            'monthly_id' => env('basic_monthly_id', 'price_1MuHWOARjxFKY8qXD2mRcv5n'),
            'yearly_id' => env('basic_yearly_id', 'price_1MuHWOARjxFKY8qXsDGsrMzI'),
            'seats' => '2',
            'word_limit' => '50000',
            'credits' => '50000',
            'archived' => false,
            'featured' => false,
            'popular' => false,
            'cta' => 'Buy Now',
            'price' =>
                [
                    'monthly' => '$10',
                    'annually' => '$100'
                ],
            'features' => [
                '50,000 Credits',
                '2 seats',
            ]
        ],

        [
            'name' => 'Standard',
            'description' => 'Standard is right.',
            'monthly_id' => env('standard_monthly_id','price_1MuMMzARjxFKY8qXcZijigqm'),
            'yearly_id' => env('standard_yearly_id','price_1MuMMzARjxFKY8qXeU0D0x77'),
            'seats' => '5',
            'word_limit' => '100000',
            'credits' => '100000',
            'archived' => false,
            'featured' => false,
            'popular' => true,
            'cta' => 'Buy Now',
            'price' =>
                [
                    'monthly' => '$29',
                    'annually' => '$299'
                ],
            'features' => [
                '100,000 Credits',
                '5 seats'
            ],
        ]
    ]
];
