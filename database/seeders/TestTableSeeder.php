<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TestTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('tests')->insert([
            [
                'name' => 'Castor, agripeta, et gabalium.'
            ],
            [
                'name' => 'Axona, scutum, et hilotae.'
            ],
            [
                'name' => 'Ignigena nobilis fides est.'
            ],
            [
                'name' => 'Exemplar, humani generis, et secula.'
            ],
            [
                'name' => 'Repressor, decor, et plasmator.'
            ],
            [
                'name' => 'Cursus, lanista, et repressor.'
            ],
        ]);
    }
}
