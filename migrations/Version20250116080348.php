<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250116080348 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE mouvement ADD user_expedition_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE mouvement ADD CONSTRAINT FK_5B51FC3EB9E0554E FOREIGN KEY (user_expedition_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_5B51FC3EB9E0554E ON mouvement (user_expedition_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE mouvement DROP FOREIGN KEY FK_5B51FC3EB9E0554E');
        $this->addSql('DROP INDEX IDX_5B51FC3EB9E0554E ON mouvement');
        $this->addSql('ALTER TABLE mouvement DROP user_expedition_id');
    }
}
