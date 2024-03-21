<?php

use Migrations\AbstractMigration;

class AddBandsTable extends AbstractMigration
{
    public function change()
    {
        $this->table('bands')
            ->addColumn('user_id', 'integer', [
                'default' => null,
                'limit' => 11,
                'null' => false,
            ])
            ->addColumn('title', 'string', [
                'default' => null,
                'limit' => 255,
                'null' => false,
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

        $this->table('bands_users', ['id' => false, 'primary_key' => ['band_id', 'user_id']])
            ->addColumn('band_id', 'integer', [
                'default' => null,
                'limit' => 11,
                'null' => false,
            ])
            ->addColumn('user_id', 'integer', [
                'default' => null,
                'limit' => 11,
                'null' => false,
            ])
            ->addIndex(['band_id'])
            ->addIndex(['user_id'])
            ->create();

        $this->table('bands_dates', ['id' => false, 'primary_key' => ['band_id', 'date_id']])
            ->addColumn('band_id', 'integer', [
                'default' => null,
                'limit' => 11,
                'null' => false,
            ])
            ->addColumn('date_id', 'integer', [
                'default' => null,
                'limit' => 11,
                'null' => false,
            ])
            ->addIndex(['band_id'])
            ->addIndex(['date_id'])
            ->create();

        $this->table('bands_ideas', ['id' => false, 'primary_key' => ['band_id', 'idea_id']])
            ->addColumn('band_id', 'integer', [
                'default' => null,
                'limit' => 11,
                'null' => false,
            ])
            ->addColumn('idea_id', 'integer', [
                'default' => null,
                'limit' => 11,
                'null' => false,
            ])
            ->addIndex(['band_id'])
            ->addIndex(['idea_id'])
            ->create();

        $this->table('bands_songs', ['id' => false, 'primary_key' => ['band_id', 'song_id']])
            ->addColumn('band_id', 'integer', [
                'default' => null,
                'limit' => 11,
                'null' => false,
            ])
            ->addColumn('song_id', 'integer', [
                'default' => null,
                'limit' => 11,
                'null' => false,
            ])
            ->addIndex(['band_id'])
            ->addIndex(['song_id'])
            ->create();

        $this->table('bands_songversions', ['id' => false, 'primary_key' => ['band_id', 'version_id']])
            ->addColumn('band_id', 'integer', [
                'default' => null,
                'limit' => 11,
                'null' => false,
            ])
            ->addColumn('version_id', 'integer', [
                'default' => null,
                'limit' => 11,
                'null' => false,
            ])
            ->addIndex(['band_id'])
            ->addIndex(['version_id'])
            ->create();

        $this->table('bands_collections', ['id' => false, 'primary_key' => ['band_id', 'collection_id']])
            ->addColumn('band_id', 'integer', [
                'default' => null,
                'limit' => 11,
                'null' => false,
            ])
            ->addColumn('collection_id', 'integer', [
                'default' => null,
                'limit' => 11,
                'null' => false,
            ])
            ->addIndex(['band_id'])
            ->addIndex(['collection_id'])
            ->create();
    }
}
