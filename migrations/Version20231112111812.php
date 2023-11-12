<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231112111812 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE news_letter_user (news_letter_id INT NOT NULL, user_id INT NOT NULL, INDEX IDX_23175F1C5900A0E7 (news_letter_id), INDEX IDX_23175F1CA76ED395 (user_id), PRIMARY KEY(news_letter_id, user_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE news_letter_user ADD CONSTRAINT FK_23175F1C5900A0E7 FOREIGN KEY (news_letter_id) REFERENCES news_letter (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE news_letter_user ADD CONSTRAINT FK_23175F1CA76ED395 FOREIGN KEY (user_id) REFERENCES `user` (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE news_letter_user DROP FOREIGN KEY FK_23175F1C5900A0E7');
        $this->addSql('ALTER TABLE news_letter_user DROP FOREIGN KEY FK_23175F1CA76ED395');
        $this->addSql('DROP TABLE news_letter_user');
    }
}
