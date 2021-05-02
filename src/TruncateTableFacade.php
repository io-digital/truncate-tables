<?php

namespace IoDigital\TruncateTable;

use Illuminate\Support\Facades\Facade;

/**
 * @see \IoDigital\TruncateTable\TruncateTable
 */
class TruncateTableFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'truncate-tables';
    }
}
