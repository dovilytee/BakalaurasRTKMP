<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240521175852 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE place ADD place_type_id INT NOT NULL');
        $this->addSql('ALTER TABLE place ADD CONSTRAINT FK_741D53CDF1809B68 FOREIGN KEY (place_type_id) REFERENCES place_type (id)');
        $this->addSql('CREATE INDEX IDX_741D53CDF1809B68 ON place (place_type_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE place DROP FOREIGN KEY FK_741D53CDF1809B68');
        $this->addSql('DROP INDEX IDX_741D53CDF1809B68 ON place');
        $this->addSql('ALTER TABLE place DROP place_type_id');
    }
}
