<?php

use Migrations\AbstractMigration;

class AddIsPublicToFiles extends AbstractMigration
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
        $table = $this->table('files');
        $table->addColumn('is_public', 'boolean', [
            'default' => null,
            'limit' => null,
            'null' => false,
        ]);
        $table->update();
    }
}
