<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230209135023 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE agences (id INT AUTO_INCREMENT NOT NULL, titre VARCHAR(200) NOT NULL, adresse VARCHAR(50) NOT NULL, ville VARCHAR(50) NOT NULL, cp INT NOT NULL, description VARCHAR(255) NOT NULL, photo VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE commande (id INT AUTO_INCREMENT NOT NULL, id_membre_id INT DEFAULT NULL, id_vehicule_id INT DEFAULT NULL, agence_id INT DEFAULT NULL, date_heure_depart DATETIME NOT NULL, date_heure_fin DATETIME NOT NULL, prix_total INT NOT NULL, date_enregistrement DATETIME NOT NULL, INDEX IDX_6EEAA67DEAAC4B6D (id_membre_id), INDEX IDX_6EEAA67D5258F8E6 (id_vehicule_id), INDEX IDX_6EEAA67DD725330D (agence_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE membre (id INT AUTO_INCREMENT NOT NULL, pseudo VARCHAR(20) NOT NULL, mdp VARCHAR(60) NOT NULL, nom VARCHAR(20) NOT NULL, prenom VARCHAR(20) NOT NULL, email VARCHAR(50) NOT NULL, civilite VARCHAR(20) NOT NULL, statut INT NOT NULL, date_enregistrement DATETIME NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE vehicule (id INT AUTO_INCREMENT NOT NULL, id_agence_id INT DEFAULT NULL, titre VARCHAR(200) NOT NULL, marque VARCHAR(50) NOT NULL, modele VARCHAR(50) NOT NULL, description VARCHAR(255) NOT NULL, photo VARCHAR(200) NOT NULL, prix_journalier INT NOT NULL, INDEX IDX_292FFF1D57108F2A (id_agence_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE commande ADD CONSTRAINT FK_6EEAA67DEAAC4B6D FOREIGN KEY (id_membre_id) REFERENCES membre (id)');
        $this->addSql('ALTER TABLE commande ADD CONSTRAINT FK_6EEAA67D5258F8E6 FOREIGN KEY (id_vehicule_id) REFERENCES vehicule (id)');
        $this->addSql('ALTER TABLE commande ADD CONSTRAINT FK_6EEAA67DD725330D FOREIGN KEY (agence_id) REFERENCES agences (id)');
        $this->addSql('ALTER TABLE vehicule ADD CONSTRAINT FK_292FFF1D57108F2A FOREIGN KEY (id_agence_id) REFERENCES agences (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE commande DROP FOREIGN KEY FK_6EEAA67DEAAC4B6D');
        $this->addSql('ALTER TABLE commande DROP FOREIGN KEY FK_6EEAA67D5258F8E6');
        $this->addSql('ALTER TABLE commande DROP FOREIGN KEY FK_6EEAA67DD725330D');
        $this->addSql('ALTER TABLE vehicule DROP FOREIGN KEY FK_292FFF1D57108F2A');
        $this->addSql('DROP TABLE agences');
        $this->addSql('DROP TABLE commande');
        $this->addSql('DROP TABLE membre');
        $this->addSql('DROP TABLE vehicule');
    }
}
