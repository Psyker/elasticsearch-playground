<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210519012612 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE anime (id INT AUTO_INCREMENT NOT NULL, title VARCHAR(255) NOT NULL, description LONGTEXT DEFAULT NULL, image_url VARCHAR(255) NOT NULL, episodes_count INT NOT NULL, airing TINYINT(1) NOT NULL, score DOUBLE PRECISION NOT NULL, mal_id INT NOT NULL, url VARCHAR(255) NOT NULL, trailer_url VARCHAR(255) DEFAULT NULL, title_english VARCHAR(255) DEFAULT NULL, title_japanese VARCHAR(255) DEFAULT NULL, status VARCHAR(255) NOT NULL, aired_from DATETIME DEFAULT NULL, aired_to DATETIME DEFAULT NULL, duration VARCHAR(255) DEFAULT NULL, rating VARCHAR(255) NOT NULL, synonyms JSON NOT NULL COMMENT \'(DC2Type:json_array)\', type VARCHAR(255) NOT NULL, `rank` INT NOT NULL, popularity INT NOT NULL, opening_themes JSON NOT NULL COMMENT \'(DC2Type:json_array)\', ending_themes JSON NOT NULL COMMENT \'(DC2Type:json_array)\', broadcast VARCHAR(255) DEFAULT NULL, banner_image_url VARCHAR(255) DEFAULT NULL, poster_image_url VARCHAR(255) DEFAULT NULL, background_image_url VARCHAR(255) DEFAULT NULL, INDEX mal_anime_idx (mal_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE anime_genre (anime_id INT NOT NULL, genre_id INT NOT NULL, INDEX IDX_EFF953C7794BBE89 (anime_id), INDEX IDX_EFF953C74296D31F (genre_id), PRIMARY KEY(anime_id, genre_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE genre (id INT AUTO_INCREMENT NOT NULL, mal_id INT NOT NULL, name VARCHAR(255) NOT NULL, url VARCHAR(255) NOT NULL, INDEX mal_genre_idx (mal_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE recommendation (id INT AUTO_INCREMENT NOT NULL, recommended_id INT DEFAULT NULL, anime_id INT DEFAULT NULL, recommendation_count INT NOT NULL, INDEX IDX_433224D270C20237 (recommended_id), INDEX IDX_433224D2794BBE89 (anime_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE anime_genre ADD CONSTRAINT FK_EFF953C7794BBE89 FOREIGN KEY (anime_id) REFERENCES anime (id)');
        $this->addSql('ALTER TABLE anime_genre ADD CONSTRAINT FK_EFF953C74296D31F FOREIGN KEY (genre_id) REFERENCES genre (id)');
        $this->addSql('ALTER TABLE recommendation ADD CONSTRAINT FK_433224D270C20237 FOREIGN KEY (recommended_id) REFERENCES anime (id)');
        $this->addSql('ALTER TABLE recommendation ADD CONSTRAINT FK_433224D2794BBE89 FOREIGN KEY (anime_id) REFERENCES anime (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE anime_genre DROP FOREIGN KEY FK_EFF953C7794BBE89');
        $this->addSql('ALTER TABLE recommendation DROP FOREIGN KEY FK_433224D270C20237');
        $this->addSql('ALTER TABLE recommendation DROP FOREIGN KEY FK_433224D2794BBE89');
        $this->addSql('ALTER TABLE anime_genre DROP FOREIGN KEY FK_EFF953C74296D31F');
        $this->addSql('DROP TABLE anime');
        $this->addSql('DROP TABLE anime_genre');
        $this->addSql('DROP TABLE genre');
        $this->addSql('DROP TABLE recommendation');
    }
}
