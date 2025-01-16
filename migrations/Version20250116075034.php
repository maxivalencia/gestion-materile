<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250116075034 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE mouvement ADD expedition_id_id INT DEFAULT NULL, ADD user_reception_id INT DEFAULT NULL, ADD date_reception DATE DEFAULT NULL');
        $this->addSql('ALTER TABLE mouvement ADD CONSTRAINT FK_5B51FC3E6966CF7 FOREIGN KEY (expedition_id_id) REFERENCES mouvement (id)');
        $this->addSql('ALTER TABLE mouvement ADD CONSTRAINT FK_5B51FC3EFCD8A350 FOREIGN KEY (user_reception_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_5B51FC3E6966CF7 ON mouvement (expedition_id_id)');
        $this->addSql('CREATE INDEX IDX_5B51FC3EFCD8A350 ON mouvement (user_reception_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE mouvement DROP FOREIGN KEY FK_5B51FC3E6966CF7');
        $this->addSql('ALTER TABLE mouvement DROP FOREIGN KEY FK_5B51FC3EFCD8A350');
        $this->addSql('DROP INDEX IDX_5B51FC3E6966CF7 ON mouvement');
        $this->addSql('DROP INDEX IDX_5B51FC3EFCD8A350 ON mouvement');
        $this->addSql('ALTER TABLE mouvement DROP expedition_id_id, DROP user_reception_id, DROP date_reception');
    }
}
