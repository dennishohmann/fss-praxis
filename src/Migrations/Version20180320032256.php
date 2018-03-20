<?php declare(strict_types = 1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20180320032256 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE klasse ADD teacher_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE klasse ADD CONSTRAINT FK_63D43DFB41807E1D FOREIGN KEY (teacher_id) REFERENCES teacher (id)');
        $this->addSql('CREATE INDEX IDX_63D43DFB41807E1D ON klasse (teacher_id)');
    }

    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE klasse DROP FOREIGN KEY FK_63D43DFB41807E1D');
        $this->addSql('DROP INDEX IDX_63D43DFB41807E1D ON klasse');
        $this->addSql('ALTER TABLE klasse DROP teacher_id');
    }
}
