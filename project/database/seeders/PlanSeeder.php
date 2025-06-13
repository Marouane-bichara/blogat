<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PlanSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('plans')->insert([
            [
                'name' => 'Starter Plan',
                'slug' => 'starter-plan',
                'price' => 9.99,
                'billing_cycle' => 'monthly',
                'article_limit' => 10,
                'features' => json_encode([
                    'AI-generated articles',
                    'Basic analytics',
                    'Custom domains',
                ]),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Pro Plan',
                'slug' => 'pro-plan',
                'price' => 19.99,
                'billing_cycle' => 'monthly',
                'article_limit' => 50,
                'features' => json_encode([
                    'AI-generated articles',
                    'Advanced analytics',
                    'Multiple custom domains',
                    'Priority support',
                ]),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Enterprise Plan',
                'slug' => 'enterprise-plan',
                'price' => 99.99,
                'billing_cycle' => 'monthly',
                'article_limit' => 500,
                'features' => json_encode([
                    'Unlimited AI-generated articles',
                    'Detailed analytics',
                    'Unlimited custom domains',
                    'Dedicated support',
                    'Custom integrations',
                ]),
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
