<?php

namespace IoDigital\TruncateTable\Tests;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\DB;
use IoDigital\TruncateTable\TruncateTable;

class TruncateTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_can_truncate_tables()
    {
        DB::table('tests')->insert([
            ['name' => 'lorem'],
            ['name' => 'ipsum'],
        ]);
        $this->assertEquals(2, DB::table('tests')->count());
        $firstRecord = DB::table('tests')->first();
        $this->assertEquals(1, $firstRecord->id);

        DB::table('tests')
            ->where('name', '!=', null)
            ->delete();

        DB::table('tests')->insert([
            ['name' => 'lorem'],
            ['name' => 'ipsum'],
        ]);
        $firstRecord = DB::table('tests')->first();
        $this->assertEquals(3, $firstRecord->id);

        // Tests that records are truncated and ids start from 1 again.
        TruncateTable::fromArrays(tables: ['tests'])->clean();
        DB::table('tests')->insert([
            ['name' => 'lorem'],
            ['name' => 'ipsum'],
        ]);
        $firstRecord = DB::table('tests')->first();
        $this->assertEquals(1, $firstRecord->id);
    }

    /** @test */
    public function it_can_truncate_and_seed_tables()
    {
        DB::table('tests')->insert([
            ['name' => 'lorem'],
            ['name' => 'ipsum'],
        ]);
        $firstRecord = DB::table('tests')->first();
        $this->assertEquals(1, $firstRecord->id);

        TruncateTable::fromArrays(tables: ['tests'], seeders: [\TestTableSeeder::class]);

        $firstRecord = DB::table('tests')->first();
        $this->assertEquals(1, $firstRecord->id);
    }
}
