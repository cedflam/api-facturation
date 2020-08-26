<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200826083257 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE advance CHANGE invoice_id invoice_id INT DEFAULT NULL, CHANGE amount amount DOUBLE PRECISION DEFAULT NULL');
        $this->addSql('ALTER TABLE customer CHANGE user_id user_id INT DEFAULT NULL, CHANGE address address VARCHAR(255) DEFAULT NULL, CHANGE postal_code postal_code VARCHAR(255) DEFAULT NULL, CHANGE city city VARCHAR(255) DEFAULT NULL, CHANGE tel tel VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE description CHANGE estimate_id estimate_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE estimate CHANGE user_id user_id INT DEFAULT NULL, CHANGE customer_id customer_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE invoice ADD estimate_id INT DEFAULT NULL, CHANGE user_id user_id INT DEFAULT NULL, CHANGE total_advance total_advance DOUBLE PRECISION DEFAULT NULL, CHANGE remaining remaining DOUBLE PRECISION DEFAULT NULL');
        $this->addSql('ALTER TABLE invoice ADD CONSTRAINT FK_9065174485F23082 FOREIGN KEY (estimate_id) REFERENCES estimate (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_9065174485F23082 ON invoice (estimate_id)');
        $this->addSql('ALTER TABLE user CHANGE roles roles JSON NOT NULL, CHANGE address address VARCHAR(255) DEFAULT NULL, CHANGE postal_code postal_code VARCHAR(255) DEFAULT NULL, CHANGE city city VARCHAR(255) DEFAULT NULL, CHANGE tel tel VARCHAR(255) DEFAULT NULL, CHANGE legal_mention1 legal_mention1 VARCHAR(255) DEFAULT NULL, CHANGE legal_mention2 legal_mention2 VARCHAR(255) DEFAULT NULL, CHANGE legal_mention3 legal_mention3 VARCHAR(255) DEFAULT NULL, CHANGE logo logo VARCHAR(255) DEFAULT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE advance CHANGE invoice_id invoice_id INT DEFAULT NULL, CHANGE amount amount DOUBLE PRECISION DEFAULT \'NULL\'');
        $this->addSql('ALTER TABLE customer CHANGE user_id user_id INT DEFAULT NULL, CHANGE address address VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`, CHANGE postal_code postal_code VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`, CHANGE city city VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`, CHANGE tel tel VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE description CHANGE estimate_id estimate_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE estimate CHANGE user_id user_id INT DEFAULT NULL, CHANGE customer_id customer_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE invoice DROP FOREIGN KEY FK_9065174485F23082');
        $this->addSql('DROP INDEX UNIQ_9065174485F23082 ON invoice');
        $this->addSql('ALTER TABLE invoice DROP estimate_id, CHANGE user_id user_id INT DEFAULT NULL, CHANGE total_advance total_advance DOUBLE PRECISION DEFAULT \'NULL\', CHANGE remaining remaining DOUBLE PRECISION DEFAULT \'NULL\'');
        $this->addSql('ALTER TABLE user CHANGE roles roles LONGTEXT CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_bin`, CHANGE address address VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`, CHANGE postal_code postal_code VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`, CHANGE city city VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`, CHANGE tel tel VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`, CHANGE legal_mention1 legal_mention1 VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`, CHANGE legal_mention2 legal_mention2 VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`, CHANGE legal_mention3 legal_mention3 VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`, CHANGE logo logo VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`');
    }
}
