<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190905142730 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE tamanhos (id INT AUTO_INCREMENT NOT NULL, tamanho VARCHAR(10) NOT NULL, valor DOUBLE PRECISION NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE photo ADD tamanho_id INT NOT NULL, DROP tamanho');
        $this->addSql('ALTER TABLE photo ADD CONSTRAINT FK_14B7841850E68399 FOREIGN KEY (tamanho_id) REFERENCES tamanhos (id)');
        $this->addSql('CREATE INDEX IDX_14B7841850E68399 ON photo (tamanho_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE photo DROP FOREIGN KEY FK_14B7841850E68399');
        $this->addSql('DROP TABLE tamanhos');
        $this->addSql('DROP INDEX IDX_14B7841850E68399 ON photo');
        $this->addSql('ALTER TABLE photo ADD tamanho VARCHAR(10) NOT NULL COLLATE utf8mb4_unicode_ci, DROP tamanho_id');
    }
}
