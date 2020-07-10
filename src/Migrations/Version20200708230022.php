<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200708230022 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, nom VARCHAR(255) NOT NULL, prenom VARCHAR(255) NOT NULL, addresse VARCHAR(255) DEFAULT NULL, telephone VARCHAR(255) NOT NULL, datenaissance DATE NOT NULL, photo_url VARCHAR(255) DEFAULT NULL, pseudo VARCHAR(255) DEFAULT NULL, deleted TINYINT(1) NOT NULL, type VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_8D93D649E7927C74 (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE demande CHANGE diplome_id diplome_id INT DEFAULT NULL, CHANGE secretaire_id secretaire_id INT DEFAULT NULL, CHANGE entreprise_id entreprise_id INT DEFAULT NULL, CHANGE laureat_id laureat_id INT DEFAULT NULL, CHANGE etablissement_id etablissement_id INT DEFAULT NULL, CHANGE directeur_pedagogique_id directeur_pedagogique_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE diplome CHANGE type_id type_id INT DEFAULT NULL, CHANGE specialite_id specialite_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE signalisation CHANGE laureat_id laureat_id INT DEFAULT NULL, CHANGE etablissement_id etablissement_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE directeur_pedagogique DROP pseudo, DROP nom, DROP prenom, DROP password, DROP adresse, DROP email, DROP telephone, DROP deleted, DROP date_naissance, DROP photo_url, CHANGE id id INT NOT NULL, CHANGE etablissement_id etablissement_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE directeur_pedagogique ADD CONSTRAINT FK_7C33481FBF396750 FOREIGN KEY (id) REFERENCES user (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE entreprise DROP pseudo, DROP nom, DROP prenom, DROP password, DROP adresse, DROP email, DROP telephone, DROP deleted, CHANGE id id INT NOT NULL');
        $this->addSql('ALTER TABLE entreprise ADD CONSTRAINT FK_D19FA60BF396750 FOREIGN KEY (id) REFERENCES user (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE etablissement DROP pseudo, DROP nom, DROP prenom, DROP password, DROP adresse, DROP email, DROP telephone, DROP deleted, CHANGE id id INT NOT NULL, CHANGE pays_id pays_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE etablissement ADD CONSTRAINT FK_20FD592CBF396750 FOREIGN KEY (id) REFERENCES user (id) ON DELETE CASCADE');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_20FD592CACA3E3B2 ON etablissement (nom_etablissement)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_20FD592CE48E9A13 ON etablissement (logo)');
        $this->addSql('ALTER TABLE laureat DROP pseudo, DROP nom, DROP prenom, DROP password, DROP adresse, DROP email, DROP telephone, DROP deleted, DROP datenaissance, DROP photo_url, CHANGE id id INT NOT NULL');
        $this->addSql('ALTER TABLE laureat ADD CONSTRAINT FK_8744C4B0BF396750 FOREIGN KEY (id) REFERENCES user (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE secretaire DROP pseudo, DROP nom, DROP prenom, DROP password, DROP adresse, DROP email, DROP telephone, DROP deleted, DROP date_naissance, DROP photo_url, CHANGE id id INT NOT NULL, CHANGE etablissement_id etablissement_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE secretaire ADD CONSTRAINT FK_7DB5C2D0BF396750 FOREIGN KEY (id) REFERENCES user (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE directeur_pedagogique DROP FOREIGN KEY FK_7C33481FBF396750');
        $this->addSql('ALTER TABLE entreprise DROP FOREIGN KEY FK_D19FA60BF396750');
        $this->addSql('ALTER TABLE etablissement DROP FOREIGN KEY FK_20FD592CBF396750');
        $this->addSql('ALTER TABLE laureat DROP FOREIGN KEY FK_8744C4B0BF396750');
        $this->addSql('ALTER TABLE secretaire DROP FOREIGN KEY FK_7DB5C2D0BF396750');
        $this->addSql('DROP TABLE user');
        $this->addSql('ALTER TABLE demande CHANGE diplome_id diplome_id INT DEFAULT NULL, CHANGE secretaire_id secretaire_id INT DEFAULT NULL, CHANGE entreprise_id entreprise_id INT DEFAULT NULL, CHANGE laureat_id laureat_id INT DEFAULT NULL, CHANGE etablissement_id etablissement_id INT DEFAULT NULL, CHANGE directeur_pedagogique_id directeur_pedagogique_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE diplome CHANGE type_id type_id INT DEFAULT NULL, CHANGE specialite_id specialite_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE directeur_pedagogique ADD pseudo VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, ADD nom VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, ADD prenom VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, ADD password VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, ADD adresse VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, ADD email VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, ADD telephone VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, ADD deleted TINYINT(1) NOT NULL, ADD date_naissance DATE NOT NULL, ADD photo_url VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE id id INT AUTO_INCREMENT NOT NULL, CHANGE etablissement_id etablissement_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE entreprise ADD pseudo VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, ADD nom VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, ADD prenom VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, ADD password VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, ADD adresse VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, ADD email VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, ADD telephone VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, ADD deleted TINYINT(1) NOT NULL, CHANGE id id INT AUTO_INCREMENT NOT NULL');
        $this->addSql('DROP INDEX UNIQ_20FD592CACA3E3B2 ON etablissement');
        $this->addSql('DROP INDEX UNIQ_20FD592CE48E9A13 ON etablissement');
        $this->addSql('ALTER TABLE etablissement ADD pseudo VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, ADD nom VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, ADD prenom VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, ADD password VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, ADD adresse VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, ADD email VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, ADD telephone VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, ADD deleted TINYINT(1) NOT NULL, CHANGE id id INT AUTO_INCREMENT NOT NULL, CHANGE pays_id pays_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE laureat ADD pseudo VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, ADD nom VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, ADD prenom VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, ADD password VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, ADD adresse VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, ADD email VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, ADD telephone VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, ADD deleted TINYINT(1) NOT NULL, ADD datenaissance DATE NOT NULL, ADD photo_url VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE id id INT AUTO_INCREMENT NOT NULL');
        $this->addSql('ALTER TABLE secretaire ADD pseudo VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, ADD nom VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, ADD prenom VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, ADD password VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, ADD adresse VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, ADD email VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, ADD telephone VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, ADD deleted TINYINT(1) NOT NULL, ADD date_naissance DATE NOT NULL, ADD photo_url VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE id id INT AUTO_INCREMENT NOT NULL, CHANGE etablissement_id etablissement_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE signalisation CHANGE laureat_id laureat_id INT DEFAULT NULL, CHANGE etablissement_id etablissement_id INT DEFAULT NULL');
    }
}
