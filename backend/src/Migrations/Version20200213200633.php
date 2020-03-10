<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200213200633 extends AbstractMigration
{
    public function getDescription() : string
    {
        return 'Added user table';
    }

    public function up(Schema $schema) : void
    {
        $userTable = $schema->createTable('user');

        $userTable->addColumn(
            'id',
            'integer',
            ['autoincrement' => true]
        );
        $userTable->setPrimaryKey(['id']);

        $userTable->addColumn(
            'username',
            'string',
            ['notnull' => true, 'length' => 255, 'unique' => true]
        );

        $userTable->addColumn(
            'email',
            'string',
            ['notnull' => true, 'length' => 255, 'unique' => true]
        );

        $userTable->addColumn(
            'password',
            'string',
            ['notnull' => true, 'length' => 255, 'unique' => true]
        );

        $userTable->addColumn(
            'created_at',
            'datetime',
            ['notnull' => true, 'default' => 'CURRENT_TIMESTAMP']
        );
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE user');
    }
}
