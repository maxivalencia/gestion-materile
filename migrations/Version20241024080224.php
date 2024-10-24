<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20241024080224 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE historique_materiel (id INT AUTO_INCREMENT NOT NULL, user_id INT DEFAULT NULL, materiel_id INT DEFAULT NULL, objet VARCHAR(255) DEFAULT NULL, sujet VARCHAR(255) DEFAULT NULL, date DATETIME NOT NULL, ancien LONGTEXT DEFAULT NULL, nouveau LONGTEXT DEFAULT NULL, INDEX IDX_D80AC863A76ED395 (user_id), INDEX IDX_D80AC86316880AAF (materiel_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE historique_materiel ADD CONSTRAINT FK_D80AC863A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE historique_materiel ADD CONSTRAINT FK_D80AC86316880AAF FOREIGN KEY (materiel_id) REFERENCES materiel (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE historique_materiel DROP FOREIGN KEY FK_D80AC863A76ED395');
        $this->addSql('ALTER TABLE historique_materiel DROP FOREIGN KEY FK_D80AC86316880AAF');
        $this->addSql('DROP TABLE historique_materiel');
    }
}
