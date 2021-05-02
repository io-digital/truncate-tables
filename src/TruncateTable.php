<?php

namespace IoDigital\TruncateTable;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TruncateTable extends Seeder
{
    private array $toTruncate;
    private array $toSeed;

    public static function fromArrays(array $tables, array $seeders = []): self
    {
        return new static(toTruncate: $tables, toSeed: $seeders);
    }

    public function __construct(array $toTruncate, array $toSeed = [])
    {
        $this->toTruncate = $toTruncate;
        $this->toSeed = $toSeed;
    }

    public function clean()
    {
        Model::unguard();

        $this->wipe();

        Model::reguard();
    }

    public function cleanAndSeed()
    {
        Model::unguard();

        $this->wipe();
        $this->seed();

        Model::reguard();
    }

    private function wipe()
    {
        $this->turnOffFKCheck();

        foreach ($this->toTruncate as $table) {
            DB::table($table)->truncate();
        }

        $this->turnOnFKCheck();
    }

    private function seed()
    {
        if ($this->toSeed !== []) {
            foreach ($this->toSeed as $seeder) {
                $this->call($seeder);
            }
        }
    }

    private function turnOffFKCheck()
    {
        switch (DB::getDriverName()) {
            case 'mysql':
                DB::statement('SET FOREIGN_KEY_CHECKS=0');

                break;
            case 'sqlite':
                DB::statement('PRAGMA foreign_keys = OFF');

                break;
        }
    }

    private function turnOnFKCheck()
    {
        switch (DB::getDriverName()) {
            case 'mysql':
                DB::statement('SET FOREIGN_KEY_CHECKS=1');

                break;
            case 'sqlite':
                DB::statement('PRAGMA foreign_keys = ON');

                break;
        }
    }
}
