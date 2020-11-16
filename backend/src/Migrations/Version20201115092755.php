<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\DBAL\Types\Types;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20201115092755 extends AbstractMigration
{
    public function getDescription() : string
    {
        return 'Create Training Activity table';
    }

    public function up(Schema $schema) : void
    {
        $activityTable = $schema->createTable('training_activity');
        $userTable = $schema->getTable('user');

        $activityTable->addColumn(
            'id',
            Types::INTEGER,
            ['autoincrement' => true]
        );
        $activityTable->setPrimaryKey(['id']);

        $activityTable->addColumn(
            'user_id',
            Types::INTEGER,
            ['notnull' => true]
        );

        $activityTable->addForeignKeyConstraint(
            $userTable,
            ['user_id'],
            ['id'],
            [],
            'FK_USER_TRAINING_ACTIVITY'
        );

        $activityTable->addColumn(
            'internal_id',
            Types::INTEGER,
            ['notnull' => true, 'unique' => true]
        );

        $activityTable->addColumn(
            'subject',
            Types::STRING,
            ['notnull' => true, 'length' => 255]
        );

        $activityTable->addColumn(
            'description',
            Types::STRING,
            ['notnull' => false, 'length' => 255]
        );

        $activityTable->addColumn(
            'location',
            Types::STRING,
            ['notnull' => false, 'length' => 255]
        );

        $activityTable->addColumn(
            'recurrence_rule',
            Types::STRING,
            ['notnull' => false, 'length' => 255]
        );

        $activityTable->addColumn(
            'start_time',
            Types::DATETIME_IMMUTABLE,
            ['notnull' => true]
        );

        $activityTable->addColumn(
            'end_time',
            Types::DATETIME_IMMUTABLE,
            ['notnull' => true]
        );

        $activityTable->addColumn(
            'is_all_day',
            Types::BOOLEAN,
            ['notnull' => true]
        );
    }

    public function down(Schema $schema) : void
    {
        $schema->dropTable('training_activity');
    }
}
