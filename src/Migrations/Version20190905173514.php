<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190905173514 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE photo (id INT AUTO_INCREMENT NOT NULL, tamanho_id INT NOT NULL, preco DOUBLE PRECISION NOT NULL, copias INT NOT NULL, photo_file_name VARCHAR(255) NOT NULL, INDEX IDX_14B7841850E68399 (tamanho_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE tamanhos (id INT AUTO_INCREMENT NOT NULL, tamanho VARCHAR(10) NOT NULL, valor DOUBLE PRECISION NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE photo ADD CONSTRAINT FK_14B7841850E68399 FOREIGN KEY (tamanho_id) REFERENCES tamanhos (id)');
        $this->addSql('INSERT INTO tamanhos (id, tamanho, valor) VALUES (1,\'10X20\',0.10)');
        $this->addSql('INSERT INTO tamanhos (id, tamanho, valor) VALUES (2,\'10X30\',0.15)');
        $this->addSql('INSERT INTO tamanhos (id, tamanho, valor) VALUES (3,\'12X40\',0.20)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE photo DROP FOREIGN KEY FK_14B7841850E68399');
        $this->addSql('DROP TABLE photo');
        $this->addSql('DROP TABLE tamanhos');
    }
}
