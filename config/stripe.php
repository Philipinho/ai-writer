<?php

return [

    'secret_key' => env('STRIPE_SECRET'),

    'trial_days' => 7,
    'free_plan_credits' => 2000,

    'plans' => [
        [
            'name' => 'Free',
            'description' => 'Free is right.',
            'seats' => '1',
            'word_limit' => '2000',
            'credits' => '2000',
            'archived' => false,
            'featured' => false,
            'free' => true,
            'cta' => 'Subscribe',
            'price' =>
                [
                    'monthly' => '$0',
                    'yearly' => '$0'
                ],
            'features' => [
                '2,000 Credits',
                '1 seat',
                '50+ Templates',
                'Support for 25+ languages',
                'Rich text editor',
                'Priority support',
            ]
        ],
        [
            'name' => 'Basic',
            'description' => 'Basic is right.',
            'monthly_id' => env('BASIC_MONTHLY_ID', 'price_1MuHWOARjxFKY8qXsDGsrMzI'),
            'yearly_id' => env('BASIC_YEARLY_ID', 'price_1MuHWOARjxFKY8qXD2mRcv5n'),
            'seats' => '2',
            'word_limit' => '50000',
            'credits' => '50000',
            'archived' => false,
            'featured' => false,
            'free' => false,
            'cta' => 'Subscribe',
            'price' =>
                [
                    'monthly' => '$9',
                    'yearly' => '$99'
                ],
            'features' => [
                '50,000 Credits',
                '2 seats',
                '50+ Templates',
                'Support for 25+ languages',
                'Rich text editor',
                'Unlimited documents',
                'Priority support',
            ]
        ],

        [
            'name' => 'Standard',
            'description' => 'Standard is right.',
            'monthly_id' => env('STANDARD_MONTHLY_ID','price_1MuMMzARjxFKY8qXcZijigqm'),
            'yearly_id' => env('STANDARD_YEARLY_ID','price_1MuMMzARjxFKY8qXeU0D0x77'),
            'seats' => '5',
            'word_limit' => '400000',
            'credits' => '400000',
            'archived' => false,
            'featured' => false,
            'free' => false,
            'cta' => 'Subscribe',
            'price' =>
                [
                    'monthly' => '$29',
                    'yearly' => '$299'
                ],
            'features' => [
                '400,000 Credits',
                '5 seats',
                '50+ Templates',
                'Support for 25+ languages',
                'Rich text editor',
                'Unlimited documents',
                'Priority support',
            ]
        ],

    ]
];
