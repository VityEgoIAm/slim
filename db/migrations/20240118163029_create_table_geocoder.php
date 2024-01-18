<?php

declare(strict_types=1);

use Phinx\Migration\AbstractMigration;

final class CreateTableGeocoder extends AbstractMigration
{
    public function up()
    {
        // create the table
        $table = $this->table('geocoder', ['limit' => 11]);
        $table->addColumn('request', 'string', ['null' => false])
              ->addColumn('response', 'string', ['null' => true])
              ->create();
    }

    public function down()
    {
        $this->table('geocoder')->drop()->save();
    }
}
