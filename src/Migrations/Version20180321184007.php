<?php declare(strict_types = 1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20180321184007 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE genus_note DROP FOREIGN KEY FK_6478FCEC85C4074C');
        $this->addSql('ALTER TABLE student DROP FOREIGN KEY FK_B723AF3334860711');
        $this->addSql('ALTER TABLE students_teachers DROP FOREIGN KEY FK_F1C87848CB944F1A');
        $this->addSql('ALTER TABLE klasse DROP FOREIGN KEY FK_63D43DFB41807E1D');
        $this->addSql('ALTER TABLE students_teachers DROP FOREIGN KEY FK_F1C8784841807E1D');
        $this->addSql('CREATE TABLE article (id INT AUTO_INCREMENT NOT NULL, title VARCHAR(255) NOT NULL, content VARCHAR(255) NOT NULL, publish_date DATE NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('DROP TABLE genus');
        $this->addSql('DROP TABLE genus_note');
        $this->addSql('DROP TABLE klasse');
        $this->addSql('DROP TABLE student');
        $this->addSql('DROP TABLE students_teachers');
        $this->addSql('DROP TABLE teacher');
    }

    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE genus (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL COLLATE utf8_unicode_ci, sub_family VARCHAR(255) NOT NULL COLLATE utf8_unicode_ci, species_count INT NOT NULL, fun_fact VARCHAR(255) DEFAULT NULL COLLATE utf8_unicode_ci, is_published TINYINT(1) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE genus_note (id INT AUTO_INCREMENT NOT NULL, genus_id INT NOT NULL, username VARCHAR(255) NOT NULL COLLATE utf8_unicode_ci, user_avatar_filename VARCHAR(255) NOT NULL COLLATE utf8_unicode_ci, note LONGTEXT NOT NULL COLLATE utf8_unicode_ci, created_at DATETIME NOT NULL, INDEX IDX_6478FCEC85C4074C (genus_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE klasse (id INT AUTO_INCREMENT NOT NULL, teacher_id INT DEFAULT NULL, name VARCHAR(255) NOT NULL COLLATE utf8_unicode_ci, jahrgang VARCHAR(255) NOT NULL COLLATE utf8_unicode_ci, INDEX IDX_63D43DFB41807E1D (teacher_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE student (id INT AUTO_INCREMENT NOT NULL, klasse_id INT DEFAULT NULL, name VARCHAR(100) NOT NULL COLLATE utf8_unicode_ci, vname VARCHAR(100) NOT NULL COLLATE utf8_unicode_ci, INDEX IDX_B723AF3334860711 (klasse_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE students_teachers (student_id INT NOT NULL, teacher_id INT NOT NULL, INDEX IDX_F1C87848CB944F1A (student_id), INDEX IDX_F1C8784841807E1D (teacher_id), PRIMARY KEY(student_id, teacher_id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE teacher (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL COLLATE utf8_unicode_ci, vname VARCHAR(255) NOT NULL COLLATE utf8_unicode_ci, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE genus_note ADD CONSTRAINT FK_6478FCEC85C4074C FOREIGN KEY (genus_id) REFERENCES genus (id)');
        $this->addSql('ALTER TABLE klasse ADD CONSTRAINT FK_63D43DFB41807E1D FOREIGN KEY (teacher_id) REFERENCES teacher (id)');
        $this->addSql('ALTER TABLE student ADD CONSTRAINT FK_B723AF3334860711 FOREIGN KEY (klasse_id) REFERENCES klasse (id)');
        $this->addSql('ALTER TABLE students_teachers ADD CONSTRAINT FK_F1C8784841807E1D FOREIGN KEY (teacher_id) REFERENCES teacher (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE students_teachers ADD CONSTRAINT FK_F1C87848CB944F1A FOREIGN KEY (student_id) REFERENCES student (id) ON DELETE CASCADE');
        $this->addSql('DROP TABLE article');
    }
}
