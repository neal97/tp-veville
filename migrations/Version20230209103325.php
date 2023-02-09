<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230209103325 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE agences DROP FOREIGN KEY FK_B46015DD82EA2E54');
        $this->addSql('DROP INDEX IDX_B46015DD82EA2E54 ON agences');
        $this->addSql('ALTER TABLE agences DROP commande_id');
        $this->addSql('ALTER TABLE commande DROP FOREIGN KEY FK_6EEAA67D5258F8E6');
        $this->addSql('ALTER TABLE commande DROP FOREIGN KEY FK_6EEAA67DEAAC4B6D');
        $this->addSql('DROP INDEX IDX_6EEAA67D5258F8E6 ON commande');
        $this->addSql('DROP INDEX IDX_6EEAA67DEAAC4B6D ON commande');
        $this->addSql('ALTER TABLE commande ADD id_membre_id INT DEFAULT NULL, ADD id_vehicule_id INT DEFAULT NULL, DROP membre_id, DROP vehicule_id');
        $this->addSql('ALTER TABLE commande ADD CONSTRAINT FK_6EEAA67D5258F8E6 FOREIGN KEY (id_vehicule_id) REFERENCES vehicule (id)');
        $this->addSql('ALTER TABLE commande ADD CONSTRAINT FK_6EEAA67DEAAC4B6D FOREIGN KEY (id_membre_id) REFERENCES membre (id)');
        $this->addSql('CREATE INDEX IDX_6EEAA67D5258F8E6 ON commande (id_vehicule_id)');
        $this->addSql('CREATE INDEX IDX_6EEAA67DEAAC4B6D ON commande (id_membre_id)');
        $this->addSql('ALTER TABLE vehicule DROP FOREIGN KEY FK_292FFF1D57108F2A');
        $this->addSql('DROP INDEX IDX_292FFF1D57108F2A ON vehicule');
        $this->addSql('ALTER TABLE vehicule CHANGE agence_id id_agence_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE vehicule ADD CONSTRAINT FK_292FFF1D57108F2A FOREIGN KEY (id_agence_id) REFERENCES agences (id)');
        $this->addSql('CREATE INDEX IDX_292FFF1D57108F2A ON vehicule (id_agence_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE agences ADD commande_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE agences ADD CONSTRAINT FK_B46015DD82EA2E54 FOREIGN KEY (commande_id) REFERENCES commande (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('CREATE INDEX IDX_B46015DD82EA2E54 ON agences (commande_id)');
        $this->addSql('ALTER TABLE vehicule DROP FOREIGN KEY FK_292FFF1D57108F2A');
        $this->addSql('DROP INDEX IDX_292FFF1D57108F2A ON vehicule');
        $this->addSql('ALTER TABLE vehicule CHANGE id_agence_id agence_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE vehicule ADD CONSTRAINT FK_292FFF1D57108F2A FOREIGN KEY (agence_id) REFERENCES agences (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('CREATE INDEX IDX_292FFF1D57108F2A ON vehicule (agence_id)');
        $this->addSql('ALTER TABLE commande DROP FOREIGN KEY FK_6EEAA67DEAAC4B6D');
        $this->addSql('ALTER TABLE commande DROP FOREIGN KEY FK_6EEAA67D5258F8E6');
        $this->addSql('DROP INDEX IDX_6EEAA67DEAAC4B6D ON commande');
        $this->addSql('DROP INDEX IDX_6EEAA67D5258F8E6 ON commande');
        $this->addSql('ALTER TABLE commande ADD membre_id INT DEFAULT NULL, ADD vehicule_id INT DEFAULT NULL, DROP id_membre_id, DROP id_vehicule_id');
        $this->addSql('ALTER TABLE commande ADD CONSTRAINT FK_6EEAA67DEAAC4B6D FOREIGN KEY (membre_id) REFERENCES membre (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('ALTER TABLE commande ADD CONSTRAINT FK_6EEAA67D5258F8E6 FOREIGN KEY (vehicule_id) REFERENCES vehicule (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('CREATE INDEX IDX_6EEAA67DEAAC4B6D ON commande (membre_id)');
        $this->addSql('CREATE INDEX IDX_6EEAA67D5258F8E6 ON commande (vehicule_id)');
    }
}
