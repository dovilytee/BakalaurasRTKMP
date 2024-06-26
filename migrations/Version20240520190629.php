<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240520190629 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE place_comment ADD place_id INT DEFAULT NULL, ADD user_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE place_comment ADD CONSTRAINT FK_A0B84597DA6A219 FOREIGN KEY (place_id) REFERENCES place (id)');
        $this->addSql('ALTER TABLE place_comment ADD CONSTRAINT FK_A0B84597A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_A0B84597DA6A219 ON place_comment (place_id)');
        $this->addSql('CREATE INDEX IDX_A0B84597A76ED395 ON place_comment (user_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE place_comment DROP FOREIGN KEY FK_A0B84597DA6A219');
        $this->addSql('ALTER TABLE place_comment DROP FOREIGN KEY FK_A0B84597A76ED395');
        $this->addSql('DROP INDEX IDX_A0B84597DA6A219 ON place_comment');
        $this->addSql('DROP INDEX IDX_A0B84597A76ED395 ON place_comment');
        $this->addSql('ALTER TABLE place_comment DROP place_id, DROP user_id');
    }
}
