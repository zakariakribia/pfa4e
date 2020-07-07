<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200707171624 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, nom VARCHAR(255) NOT NULL, prenom VARCHAR(255) NOT NULL, addresse VARCHAR(255) DEFAULT NULL, telephone VARCHAR(255) NOT NULL, datenaissance DATE NOT NULL, photo_url VARCHAR(255) DEFAULT NULL, UNIQUE INDEX UNIQ_8D93D649E7927C74 (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE demande CHANGE diplome_id diplome_id INT DEFAULT NULL, CHANGE secretaire_id secretaire_id INT DEFAULT NULL, CHANGE entreprise_id entreprise_id INT DEFAULT NULL, CHANGE laureat_id laureat_id INT DEFAULT NULL, CHANGE etablissement_id etablissement_id INT DEFAULT NULL, CHANGE directeur_pedagogique_id directeur_pedagogique_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE diplome CHANGE type_id type_id INT DEFAULT NULL, CHANGE specialite_id specialite_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE directeur_pedagogique CHANGE etablissement_id etablissement_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE etablissement CHANGE pays_id pays_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE secretaire CHANGE etablissement_id etablissement_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE signalisation CHANGE laureat_id laureat_id INT DEFAULT NULL, CHANGE etablissement_id etablissement_id INT DEFAULT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE user');
        $this->addSql('ALTER TABLE demande CHANGE diplome_id diplome_id INT DEFAULT NULL, CHANGE secretaire_id secretaire_id INT DEFAULT NULL, CHANGE entreprise_id entreprise_id INT DEFAULT NULL, CHANGE laureat_id laureat_id INT DEFAULT NULL, CHANGE etablissement_id etablissement_id INT DEFAULT NULL, CHANGE directeur_pedagogique_id directeur_pedagogique_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE diplome CHANGE type_id type_id INT DEFAULT NULL, CHANGE specialite_id specialite_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE directeur_pedagogique CHANGE etablissement_id etablissement_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE etablissement CHANGE pays_id pays_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE secretaire CHANGE etablissement_id etablissement_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE signalisation CHANGE laureat_id laureat_id INT DEFAULT NULL, CHANGE etablissement_id etablissement_id INT DEFAULT NULL');
    }
}
