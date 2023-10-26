<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231026062004 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP SEQUENCE joueur_crud_id_seq CASCADE');
        $this->addSql('CREATE SEQUENCE player_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE clubs (id INT NOT NULL, nom VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE contrat (id INT NOT NULL, player_id INT NOT NULL, numero INT NOT NULL, date_signature DATE NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_6034999399E6F5DF ON contrat (player_id)');
        $this->addSql('CREATE TABLE joueur (id INT NOT NULL, nom VARCHAR(255) NOT NULL, numero INT NOT NULL, nom_club VARCHAR(255) NOT NULL, date_adhesion TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE player (id INT NOT NULL, statistique_id INT NOT NULL, nom VARCHAR(255) NOT NULL, numero INT NOT NULL, nom_club VARCHAR(255) NOT NULL, date_adhesion DATE NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_98197A6576A81463 ON player (statistique_id)');
        $this->addSql('CREATE TABLE player_clubs (player_id INT NOT NULL, clubs_id INT NOT NULL, PRIMARY KEY(player_id, clubs_id))');
        $this->addSql('CREATE INDEX IDX_1ACF4A6599E6F5DF ON player_clubs (player_id)');
        $this->addSql('CREATE INDEX IDX_1ACF4A652FC7F5AF ON player_clubs (clubs_id)');
        $this->addSql('CREATE TABLE statistique (id INT NOT NULL, victoire INT NOT NULL, defaite INT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE messenger_messages (id BIGSERIAL NOT NULL, body TEXT NOT NULL, headers TEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, available_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, delivered_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_75EA56E0FB7336F0 ON messenger_messages (queue_name)');
        $this->addSql('CREATE INDEX IDX_75EA56E0E3BD61CE ON messenger_messages (available_at)');
        $this->addSql('CREATE INDEX IDX_75EA56E016BA31DB ON messenger_messages (delivered_at)');
        $this->addSql('COMMENT ON COLUMN messenger_messages.created_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('COMMENT ON COLUMN messenger_messages.available_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('COMMENT ON COLUMN messenger_messages.delivered_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('CREATE OR REPLACE FUNCTION notify_messenger_messages() RETURNS TRIGGER AS $$
            BEGIN
                PERFORM pg_notify(\'messenger_messages\', NEW.queue_name::text);
                RETURN NEW;
            END;
        $$ LANGUAGE plpgsql;');
        $this->addSql('DROP TRIGGER IF EXISTS notify_trigger ON messenger_messages;');
        $this->addSql('CREATE TRIGGER notify_trigger AFTER INSERT OR UPDATE ON messenger_messages FOR EACH ROW EXECUTE PROCEDURE notify_messenger_messages();');
        $this->addSql('ALTER TABLE contrat ADD CONSTRAINT FK_6034999399E6F5DF FOREIGN KEY (player_id) REFERENCES player (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE player ADD CONSTRAINT FK_98197A6576A81463 FOREIGN KEY (statistique_id) REFERENCES statistique (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE player_clubs ADD CONSTRAINT FK_1ACF4A6599E6F5DF FOREIGN KEY (player_id) REFERENCES player (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE player_clubs ADD CONSTRAINT FK_1ACF4A652FC7F5AF FOREIGN KEY (clubs_id) REFERENCES clubs (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('DROP SEQUENCE player_id_seq CASCADE');
        $this->addSql('CREATE SEQUENCE joueur_crud_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('ALTER TABLE contrat DROP CONSTRAINT FK_6034999399E6F5DF');
        $this->addSql('ALTER TABLE player DROP CONSTRAINT FK_98197A6576A81463');
        $this->addSql('ALTER TABLE player_clubs DROP CONSTRAINT FK_1ACF4A6599E6F5DF');
        $this->addSql('ALTER TABLE player_clubs DROP CONSTRAINT FK_1ACF4A652FC7F5AF');
        $this->addSql('DROP TABLE clubs');
        $this->addSql('DROP TABLE contrat');
        $this->addSql('DROP TABLE joueur');
        $this->addSql('DROP TABLE player');
        $this->addSql('DROP TABLE player_clubs');
        $this->addSql('DROP TABLE statistique');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
