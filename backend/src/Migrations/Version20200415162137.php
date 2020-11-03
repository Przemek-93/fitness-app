<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

final class Version20200415162137 extends AbstractMigration
{
    public function getDescription() : string
    {
        return 'Added Role table';
    }

    public function up(Schema $schema) : void
    {
        $table = $schema->createTable('role');

        $table->addColumn(
            'id',
            'integer',
            ['autoincrement' => true]
        );
        $table->setPrimaryKey(['id']);

        $table->addColumn(
            'name',
            'string',
            ['notnull' => true, 'length' => 255, 'unique' => true]
        );

        $table->addColumn(
            'rights',
            'string',
            ['notnull' => true, 'length' => 255, 'unique' => false]
        );
    }

    public function down(Schema $schema) : void
    {
        $schema->dropTable('role');
    }
}
