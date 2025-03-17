<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250317085256 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE etat CHANGE etat etat VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE fournisseur CHANGE nom nom VARCHAR(255) DEFAULT NULL, CHANGE sigle sigle VARCHAR(255) DEFAULT NULL, CHANGE nif nif VARCHAR(255) DEFAULT NULL, CHANGE stat stat VARCHAR(255) DEFAULT NULL, CHANGE rcs rcs VARCHAR(255) DEFAULT NULL, CHANGE mail mail VARCHAR(255) DEFAULT NULL, CHANGE telephone telephone VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE genre_produit CHANGE genre genre VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE historique_materiel CHANGE date date DATETIME DEFAULT NULL');
        $this->addSql('ALTER TABLE mouvement CHANGE date date DATETIME DEFAULT NULL, CHANGE reference reference VARCHAR(255) DEFAULT NULL, CHANGE debut_serie debut_serie VARCHAR(255) DEFAULT NULL, CHANGE fin_serie fin_serie VARCHAR(255) DEFAULT NULL, CHANGE observation observation VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE produit CHANGE nom nom VARCHAR(255) DEFAULT NULL, CHANGE sigle sigle VARCHAR(255) DEFAULT NULL, CHANGE code code VARCHAR(255) DEFAULT NULL, CHANGE caracteristique caracteristique VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE service CHANGE nom nom VARCHAR(255) DEFAULT NULL, CHANGE sigle sigle VARCHAR(255) DEFAULT NULL, CHANGE mail mail VARCHAR(255) DEFAULT NULL, CHANGE telephone telephone VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE stock CHANGE date date DATETIME DEFAULT NULL');
        $this->addSql('ALTER TABLE type_mouvement CHANGE type type VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE type_produit CHANGE type type VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE unite CHANGE nom nom VARCHAR(255) DEFAULT NULL, CHANGE sigle sigle VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE user CHANGE nom nom VARCHAR(255) DEFAULT NULL, CHANGE telephone telephone VARCHAR(255) DEFAULT NULL, CHANGE mail mail VARCHAR(255) DEFAULT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE produit CHANGE nom nom VARCHAR(255) NOT NULL, CHANGE sigle sigle VARCHAR(255) NOT NULL, CHANGE code code VARCHAR(255) NOT NULL, CHANGE caracteristique caracteristique VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE mouvement CHANGE date date DATETIME NOT NULL, CHANGE reference reference VARCHAR(255) NOT NULL, CHANGE debut_serie debut_serie VARCHAR(255) NOT NULL, CHANGE fin_serie fin_serie VARCHAR(255) NOT NULL, CHANGE observation observation VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE type_mouvement CHANGE type type VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE historique_materiel CHANGE date date DATETIME NOT NULL');
        $this->addSql('ALTER TABLE unite CHANGE nom nom VARCHAR(255) NOT NULL, CHANGE sigle sigle VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE etat CHANGE etat etat VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE type_produit CHANGE type type VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE fournisseur CHANGE nom nom VARCHAR(255) NOT NULL, CHANGE sigle sigle VARCHAR(255) NOT NULL, CHANGE nif nif VARCHAR(255) NOT NULL, CHANGE stat stat VARCHAR(255) NOT NULL, CHANGE rcs rcs VARCHAR(255) NOT NULL, CHANGE mail mail VARCHAR(255) NOT NULL, CHANGE telephone telephone VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE genre_produit CHANGE genre genre VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE service CHANGE nom nom VARCHAR(255) NOT NULL, CHANGE sigle sigle VARCHAR(255) NOT NULL, CHANGE mail mail VARCHAR(255) NOT NULL, CHANGE telephone telephone VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE user CHANGE nom nom VARCHAR(255) NOT NULL, CHANGE telephone telephone VARCHAR(255) NOT NULL, CHANGE mail mail VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE stock CHANGE date date DATETIME NOT NULL');
    }
}
