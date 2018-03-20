<?php declare(strict_types = 1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20180320024152 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE sus_lehrer DROP FOREIGN KEY FK_920004663302EA81');
        $this->addSql('ALTER TABLE sus_lehrer DROP FOREIGN KEY FK_92000466EDCCA223');
        $this->addSql('CREATE TABLE student (id INT AUTO_INCREMENT NOT NULL, klasse_id INT DEFAULT NULL, name VARCHAR(100) NOT NULL, vname VARCHAR(100) NOT NULL, INDEX IDX_B723AF3334860711 (klasse_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE students_teachers (student_id INT NOT NULL, teacher_id INT NOT NULL, INDEX IDX_F1C87848CB944F1A (student_id), INDEX IDX_F1C8784841807E1D (teacher_id), PRIMARY KEY(student_id, teacher_id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE teacher (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, vname VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE student ADD CONSTRAINT FK_B723AF3334860711 FOREIGN KEY (klasse_id) REFERENCES klasse (id)');
        $this->addSql('ALTER TABLE students_teachers ADD CONSTRAINT FK_F1C87848CB944F1A FOREIGN KEY (student_id) REFERENCES student (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE students_teachers ADD CONSTRAINT FK_F1C8784841807E1D FOREIGN KEY (teacher_id) REFERENCES teacher (id) ON DELETE CASCADE');
        $this->addSql('DROP TABLE lehrer');
        $this->addSql('DROP TABLE sus');
        $this->addSql('DROP TABLE sus_lehrer');
    }

    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE students_teachers DROP FOREIGN KEY FK_F1C87848CB944F1A');
        $this->addSql('ALTER TABLE students_teachers DROP FOREIGN KEY FK_F1C8784841807E1D');
        $this->addSql('CREATE TABLE lehrer (id INT AUTO_INCREMENT NOT NULL, klasse_id INT DEFAULT NULL, name VARCHAR(255) NOT NULL COLLATE utf8_unicode_ci, vname VARCHAR(255) NOT NULL COLLATE utf8_unicode_ci, INDEX IDX_90407A9F34860711 (klasse_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE sus (id INT AUTO_INCREMENT NOT NULL, klasse_id INT DEFAULT NULL, name VARCHAR(100) NOT NULL COLLATE utf8_unicode_ci, vname VARCHAR(100) NOT NULL COLLATE utf8_unicode_ci, INDEX IDX_32B2A22E34860711 (klasse_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE sus_lehrer (sus_id INT NOT NULL, lehrer_id INT NOT NULL, INDEX IDX_92000466EDCCA223 (sus_id), INDEX IDX_920004663302EA81 (lehrer_id), PRIMARY KEY(sus_id, lehrer_id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE lehrer ADD CONSTRAINT FK_90407A9F34860711 FOREIGN KEY (klasse_id) REFERENCES klasse (id)');
        $this->addSql('ALTER TABLE sus ADD CONSTRAINT FK_32B2A22E34860711 FOREIGN KEY (klasse_id) REFERENCES klasse (id)');
        $this->addSql('ALTER TABLE sus_lehrer ADD CONSTRAINT FK_920004663302EA81 FOREIGN KEY (lehrer_id) REFERENCES lehrer (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE sus_lehrer ADD CONSTRAINT FK_92000466EDCCA223 FOREIGN KEY (sus_id) REFERENCES sus (id) ON DELETE CASCADE');
        $this->addSql('DROP TABLE student');
        $this->addSql('DROP TABLE students_teachers');
        $this->addSql('DROP TABLE teacher');
    }
}
