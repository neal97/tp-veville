<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230210111016 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE commande ADD agence_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE commande ADD CONSTRAINT FK_6EEAA67DEAAC4B6D FOREIGN KEY (id_membre_id) REFERENCES membre (id)');
        $this->addSql('ALTER TABLE commande ADD CONSTRAINT FK_6EEAA67D5258F8E6 FOREIGN KEY (id_vehicule_id) REFERENCES vehicule (id)');
        $this->addSql('ALTER TABLE commande ADD CONSTRAINT FK_6EEAA67DD725330D FOREIGN KEY (agence_id) REFERENCES agences (id)');
        $this->addSql('CREATE INDEX IDX_6EEAA67DEAAC4B6D ON commande (id_membre_id)');
        $this->addSql('CREATE INDEX IDX_6EEAA67D5258F8E6 ON commande (id_vehicule_id)');
        $this->addSql('CREATE INDEX IDX_6EEAA67DD725330D ON commande (agence_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE commande DROP FOREIGN KEY FK_6EEAA67DEAAC4B6D');
        $this->addSql('ALTER TABLE commande DROP FOREIGN KEY FK_6EEAA67D5258F8E6');
        $this->addSql('ALTER TABLE commande DROP FOREIGN KEY FK_6EEAA67DD725330D');
        $this->addSql('DROP INDEX IDX_6EEAA67DEAAC4B6D ON commande');
        $this->addSql('DROP INDEX IDX_6EEAA67D5258F8E6 ON commande');
        $this->addSql('DROP INDEX IDX_6EEAA67DD725330D ON commande');
        $this->addSql('ALTER TABLE commande DROP agence_id');
    }
}
