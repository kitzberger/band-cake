<?php

use Migrations\AbstractMigration;

class AddIsFullDayToDates extends AbstractMigration
{
    /**
     * Change Method.
     *
     * More information on this method is available here:
     * http://docs.phinx.org/en/latest/migrations.html#the-change-method
     * @return void
     */
    public function change()
    {
        $table = $this->table('dates');
        $table->addColumn('is_fullday', 'boolean', [
            'default' => false,
            'limit' => null,
            'null' => false,
        ]);
        $table->update();
    }
}
