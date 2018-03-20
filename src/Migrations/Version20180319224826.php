<?php declare(strict_types = 1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20180319224826 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE klasse (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, klassenlehrer VARCHAR(255) NOT NULL, jahrgang VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE lehrer (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, vname VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE sus ADD klasse_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE sus ADD CONSTRAINT FK_32B2A22E34860711 FOREIGN KEY (klasse_id) REFERENCES klasse (id)');
        $this->addSql('CREATE INDEX IDX_32B2A22E34860711 ON sus (klasse_id)');
    }

    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE sus DROP FOREIGN KEY FK_32B2A22E34860711');
        $this->addSql('DROP TABLE klasse');
        $this->addSql('DROP TABLE lehrer');
        $this->addSql('DROP INDEX IDX_32B2A22E34860711 ON sus');
        $this->addSql('ALTER TABLE sus DROP klasse_id');
    }
}
