<?php declare(strict_types = 1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20180320000312 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE sus_lehrer (sus_id INT NOT NULL, lehrer_id INT NOT NULL, INDEX IDX_92000466EDCCA223 (sus_id), INDEX IDX_920004663302EA81 (lehrer_id), PRIMARY KEY(sus_id, lehrer_id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE sus_lehrer ADD CONSTRAINT FK_92000466EDCCA223 FOREIGN KEY (sus_id) REFERENCES sus (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE sus_lehrer ADD CONSTRAINT FK_920004663302EA81 FOREIGN KEY (lehrer_id) REFERENCES lehrer (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE lehrer ADD klasse_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE lehrer ADD CONSTRAINT FK_90407A9F34860711 FOREIGN KEY (klasse_id) REFERENCES klasse (id)');
        $this->addSql('CREATE INDEX IDX_90407A9F34860711 ON lehrer (klasse_id)');
    }

    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE sus_lehrer');
        $this->addSql('ALTER TABLE lehrer DROP FOREIGN KEY FK_90407A9F34860711');
        $this->addSql('DROP INDEX IDX_90407A9F34860711 ON lehrer');
        $this->addSql('ALTER TABLE lehrer DROP klasse_id');
    }
}
