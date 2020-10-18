<?php

namespace Modules\Core\Database\Schema;

use Doctrine\DBAL\Schema\SchemaException;
use Doctrine\DBAL\Schema\Table as DoctrineTable;
use Illuminate\Support\Facades\DB;

abstract class SchemaManager
{
    /**
     *
     *
     * @param [type] $method
     * @param [type] $args
     * @return void
     */
    public static function __callStatic($method, $args)
    {
        return static::manager()->$method(...$args);
    }

    /**
     *
     *
     * @return void
     */
    public static function manager()
    {
        return DB::connection()->getDoctrineSchemaManager();
    }

    /**
     *
     *
     * @return void
     */
    public static function getDatabaseConnection()
    {
        return DB::connection()->getDoctrineConnection();
    }

    /**
     *
     *
     * @param [type] $table
     * @return void
     */
    public static function tableExists($table)
    {
        if (!is_array($table)) {
            $table = [$table];
        }

        return static::manager()->tablesExist($table);
    }

    /**
     *
     *
     * @return void
     */
    public static function listTables()
    {
        $tables = [];

        foreach (static::manager()->listTableNames() as $tableName) {
            $tables[$tableName] = static::listTableDetails($tableName);
        }

        return $tables;
    }

    /**
     *
     *
     * @param [type] $table
     * @return void
     */
    public static function createTable($table)
    {
        if (!($table instanceof DoctrineTable)) {
            $table = Table::make($table);
        }

        static::manager()->createTable($table);
    }

    /**
     *
     *
     * @param [type] $table
     * @return void
     */
    public static function getDoctrineTable($table)
    {
        $table = trim($table);

        if (!static::tableExists($table)) {
            throw SchemaException::tableDoesNotExist($table);
        }

        return static::manager()->listTableDetails($table);
    }

    /**
     *
     *
     * @param [type] $table
     * @param [type] $column
     * @return void
     */
    public static function getDoctrineColumn($table, $column)
    {
        return static::getDoctrineTable($table)->getColumn($column);
    }
}
