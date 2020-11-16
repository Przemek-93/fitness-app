<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\DBAL\Types\Types;
use Doctrine\Migrations\AbstractMigration;

final class Version20200415163237 extends AbstractMigration
{
    public function getDescription() : string
    {
        return 'Added user table';
    }

    public function up(Schema $schema) : void
    {
        $userTable = $schema->createTable('user');
        $roleTable = $schema->getTable('role');

        $userTable->addColumn(
            'id',
            Types::INTEGER,
            ['autoincrement' => true]
        );
        $userTable->setPrimaryKey(['id']);

        $userTable->addColumn(
            'username',
            Types::STRING,
            ['notnull' => true, 'length' => 255, 'unique' => true]
        );

        $userTable->addColumn(
            'email',
            Types::STRING,
            ['notnull' => true, 'length' => 255, 'unique' => true]
        );

        $userTable->addColumn(
            'password',
            Types::STRING,
            ['notnull' => true, 'length' => 255, 'unique' => true]
        );

        $userTable->addColumn(
            'role_id',
            Types::INTEGER,
            ['notnull' => false]
        );

        $userTable->addForeignKeyConstraint(
            $roleTable,
            ['role_id'],
            ['id'],
            [],
            'FK_HAS_USER_ROLE'
        );

        $userTable->addColumn(
            'created_at',
            Types::DATETIME_IMMUTABLE,
            ['notnull' => true, 'default' => 'CURRENT_TIMESTAMP']
        );
    }

    public function down(Schema $schema) : void
    {
        $schema->dropTable('user');
    }
}
