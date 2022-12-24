<?php

use Migrations\AbstractMigration;

class AddIsPseudoToSongs extends AbstractMigration
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
        $table = $this->table('songs');
        $table->addColumn('is_pseudo', 'boolean', [
            'default' => null,
            'limit' => null,
            'null' => false,
        ]);
        $table->update();
    }
}
