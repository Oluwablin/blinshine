<?php


use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class bugfix extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('subscription_plans')->insert([
            'name' => 'Starter',
            'description' => 'Starter plan',
            'features' => '{"Three active projects": true, "Two collaborators per project": true, "One of each generatable document": true}',
            'price' => 0.00
        ]);

        DB::table('subscription_plans')->insert([
            'name' => 'Pro',
            'description' => 'Pro plan',
            'features' => '{"Unlimited active projects": true, "Five collaborators per project": true, "Three of each generatable document": true}',
            'price' => 24.99
        ]);

      DB::table('subscription_plans')->insert([
            'name' => 'Pro_plus',
            'description' => 'Pro Plus plan',
            'features' => '{"Unlimited collaborators": true, "Unlimited document generation": true, "Dedicated support": true, "Beta access to test new features": true}',
            'price' => 79.99
        ]);


        DB::table('countries')->insert([
            'name' => 'Nigeria',

        ]);
        DB::table('countries')->insert([
            'name' => 'France',

        ]);
        DB::table('countries')->insert([
            'name' => 'Zambia',

        ]);
        DB::table('states')->insert([
            'name' => 'Lagos',
            'country_id' => 1
        ]);
        DB::table('states')->insert([
            'name' => 'Abia',
            'country_id' => 1
        ]);
        DB::table('states')->insert([
            'name' => 'Abuja',
            'country_id' => 1
        ]);
        DB::table('states')->insert([
            'name' => 'kogi',
            'country_id' => 1
        ]);
        DB::table('states')->insert([
            'name' => 'Bayelsa',
            'country_id' => 1
        ]);
        DB::table('states')->insert([
            'name' => 'Ebonyi',
            'country_id' => 1
        ]);
        DB::table('states')->insert([
            'name' => 'Taraba',
            'country_id' => 1
        ]);
        DB::table('states')->insert([
            'name' => 'Kano',
            'country_id' => 1
        ]);
        DB::table('currencies')->insert([
            'name' => 'US DOLLAR',
            'code'=> 'USD',
            'symbol' => '$'
        ]);
        DB::table('currencies')->insert([
            'name' => 'NIGERIAN NAIRA',
            'code'=> 'NGR',
            'symbol' => 'N'
        ]);
        DB::table('currencies')->insert([
            'name' => 'EURO',
            'code'=> 'EUR',
            'symbol' => '€'
        ]);
        DB::table('currencies')->insert([
            'name' => 'POUNDS',
            'code'=> 'GBP',
            'symbol' => '£ '
        ]);

    }
}
