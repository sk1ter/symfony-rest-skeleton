<?php

declare(strict_types = 1);

namespace App\User\Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210718134115 extends AbstractMigration
{
    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE "user_profile" (user_id int not null,first_name varchar(100) not null, middle_name varchar(100), last_name varchar(100) not null, phone varchar(20), email varchar(100), birthday date,primary key (user_id),foreign key (user_id) references "user" (id))');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE "user_profile"');
    }
}
