<?php
use Migrations\AbstractMigration;

class AddMailsTable extends AbstractMigration
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
        $this->table('mails')
            ->addColumn('user_id', 'integer', [
                'default' => null,
                'limit' => 11,
                'null' => false,
            ])
            ->addColumn('subject', 'string', [
                'default' => null,
                'limit' => null,
                'null' => true,
            ])
            ->addColumn('text', 'text', [
                'default' => null,
                'limit' => null,
                'null' => true,
            ])
            ->addColumn('created', 'datetime', [
                'default' => null,
                'limit' => null,
                'null' => true,
            ])
            ->addColumn('modified', 'datetime', [
                'default' => null,
                'limit' => null,
                'null' => true,
            ])
            ->create();

        $this->table('locations_mails', ['id' => false, 'primary_key' => ['location_id', 'mail_id']])
            ->addColumn('location_id', 'integer', [
                'default' => null,
                'limit' => 11,
                'null' => false,
            ])
            ->addColumn('mail_id', 'integer', [
                'default' => null,
                'limit' => 11,
                'null' => false,
            ])
            ->addColumn('email', 'string', [
                'default' => null,
                'limit' => 255,
                'null' => true,
            ])
            ->addColumn('subject', 'string', [
                'default' => null,
                'limit' => null,
                'null' => true,
            ])
            ->addColumn('text', 'text', [
                'default' => null,
                'limit' => null,
                'null' => true,
            ])
            ->addColumn('sent', 'datetime', [
                'default' => null,
                'limit' => null,
                'null' => true,
            ])
            ->addIndex(
                [
                    'location_id',
                ]
            )
            ->addIndex(
                [
                    'mail_id',
                ]
            )
            ->create();
    }
}
