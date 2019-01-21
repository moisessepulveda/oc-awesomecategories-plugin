<?php

namespace GinoPane\AwesomeCategories\Updates;

use Schema;
use System\Classes\PluginManager;
use October\Rain\Database\Updates\Migration;

/**
 * Class CreateFields
 *
 * @package GinoPane\AwesomeCategories\Updates
 */
class CreateFields extends Migration
{

    const TABLE = 'rainlab_blog_categories';

    /**
     * Execute migrations
     */
    public function up()
    {
        if (PluginManager::instance()->hasPlugin('RainLab.Blog')) {
            $this->createFields();
        }
    }

    /**
     * Rollback migrations
     */
    public function down()
    {
        if (PluginManager::instance()->hasPlugin('RainLab.Blog')) {
            $this->dropFields();
        }
    }

    /**
     * Remove new fields
     */
    private function dropFields()
    {
        $this->dropColumn('awesome_icon');
        $this->dropColumn('awesome_class');
        $this->dropColumn('awesome_color');
    }

    /**
     * Create new fields
     */
    private function createFields()
    {
        if (!Schema::hasColumn(self::TABLE, 'awesome_icon'))
        {
            Schema::table(self::TABLE, function ($table) {
                $table->string('awesome_icon', 50)->nullable()->default(null);
            });
        }

        if (!Schema::hasColumn(self::TABLE, 'awesome_class'))
        {
            Schema::table(self::TABLE, function ($table) {
                $table->string('awesome_class')->nullable()->default(null);
            });
        }

        if (!Schema::hasColumn(self::TABLE, 'awesome_color'))
        {
            Schema::table(self::TABLE, function ($table) {
                $table->string('awesome_color', 7)->nullable()->default(null);
            });
        }
    }

    /**
     * @param string $column
     */
    private function dropColumn(string $column)
    {
        if (Schema::hasColumn(self::TABLE, $column)) {
            Schema::table(self::TABLE, function ($table) use ($column) {
                $table->dropColumn($column);
            });
        }
    }
}
