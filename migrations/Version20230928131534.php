<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230928131534 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE tache ADD debut DATETIME NOT NULL, ADD fin DATETIME NOT NULL, ADD toutela_journee TINYINT(1) NOT NULL, DROP date, DROP heure');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE tache ADD date DATE NOT NULL, ADD heure TIME NOT NULL, DROP debut, DROP fin, DROP toutela_journee');
    }
}
