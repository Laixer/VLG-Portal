<?php

use Illuminate\Database\Seeder;

class StaticSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $group_guest = App\UserType::create(['group' => 'guest', 'name' => 'gast']);
        $group_user  = App\UserType::create(['group' => 'user', 'name' => 'gebruiker']);
        $group_admin = App\UserType::create(['group' => 'admin', 'name' => 'administrator']);

        $function_adviseur = App\UserFunction::create(['name' => 'adviseur']);
        $function_specialist = App\UserFunction::create(['name' => 'specialist']);
        $function_projectondersteuner = App\UserFunction::create(['name' => 'projectondersteuner']);
        $function_onderzoeksmedewerker = App\UserFunction::create(['name' => 'onderzoeksmedewerker']);
        $function_laborant = App\UserFunction::create(['name' => 'laborant']);
        $function_projectleider = App\UserFunction::create(['name' => 'projectleider']);
        $function_overig = App\UserFunction::create(['name' => 'overig']);

        App\User::create([
            'name' => 'admin',
            'last_name' => 'portal',
        	'mobile' => '000',
        	'email' => 'admin@portal.lan',
        	'password' => Hash::make('ABC@123'),
        	'functions_id' => $function_overig->id,
        	'user_type_id' => $group_admin->id,
        ]);

    }
}
