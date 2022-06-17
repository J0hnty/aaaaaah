<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220616203216 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE bestelregel ADD bestelling_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE bestelregel ADD CONSTRAINT FK_8D814692A2E63037 FOREIGN KEY (bestelling_id) REFERENCES bestelling (id)');
        $this->addSql('CREATE INDEX IDX_8D814692A2E63037 ON bestelregel (bestelling_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE bestelregel DROP FOREIGN KEY FK_8D814692A2E63037');
        $this->addSql('DROP INDEX IDX_8D814692A2E63037 ON bestelregel');
        $this->addSql('ALTER TABLE bestelregel DROP bestelling_id');
    }
}
