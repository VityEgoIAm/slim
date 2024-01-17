<?php

declare(strict_types=1);

use Phinx\Migration\AbstractMigration;

final class CreateTableShop extends AbstractMigration
{
    public function up()
    {
        // create the table
        $table = $this->table('shop', ['limit' => 11]);
        $table->addColumn('article', 'string', ['null' => false, 'limit' => 10])
              ->addColumn('dealer', 'string', ['null' => false, 'limit' => 10])
              ->addColumn('price', 'float', ['null' => false])
              ->create();
    }

    public function down()
    {
        $this->table('shop')->drop()->save();
    }
}
