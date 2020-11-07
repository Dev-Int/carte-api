<?php

declare(strict_types=1);

/*
 * This file is part of the Carte-API Apps package.
 *
 * (c) Dev-Int Création <devint.creation@gmail.com>.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Infrastructure\DoctrineMigrations;

/*
 * This file is part of the Carte-API Apps package.
 *
 * (c) Dev-Int Création <devint.creation@gmail.com>.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

final class Version20201101225550 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Create carte, menu and product tables.';
    }

    public function up(Schema $schema): void
    {
        $this->addSql(
            'CREATE TABLE carte ('.
            'uuid CHAR(36) NOT NULL COMMENT \'(DC2Type:guid)\', '.
            'products_id CHAR(36) NOT NULL COMMENT \'(DC2Type:guid)\', '.
            'menus_id CHAR(36) DEFAULT NULL COMMENT \'(DC2Type:guid)\', '.
            'label VARCHAR(50) NOT NULL, '.
            'created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', '.
            'updated_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', '.
            'deleted_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', '.
            'INDEX IDX_BAD4FFFD6C8A81A9 (products_id), '.
            'INDEX IDX_BAD4FFFD14041B84 (menus_id), '.
            'PRIMARY KEY(uuid)'.
            ') DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB'
        );
        $this->addSql(
            'CREATE TABLE menu ('.
            'uuid CHAR(36) NOT NULL COMMENT \'(DC2Type:guid)\', '.
            'products_id CHAR(36) NOT NULL COMMENT \'(DC2Type:guid)\', '.
            'label VARCHAR(50) NOT NULL, '.
            'created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', '.
            'updated_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', '.
            'deleted_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', '.
            'INDEX IDX_7D053A936C8A81A9 (products_id), '.
            'PRIMARY KEY(uuid)'.
            ') DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB'
        );
        $this->addSql(
            'CREATE TABLE product ('.
            'uuid CHAR(36) NOT NULL COMMENT \'(DC2Type:guid)\', '.
            'label VARCHAR(50) NOT NULL, '.
            'created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', '.
            'updated_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', '.
            'deleted_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', '.
            'PRIMARY KEY(uuid)'.
            ') DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB'
        );
        $this->addSql(
            'ALTER TABLE carte ADD CONSTRAINT FK_BAD4FFFD6C8A81A9 FOREIGN KEY (products_id) REFERENCES product (uuid)'
        );
        $this->addSql(
            'ALTER TABLE carte ADD CONSTRAINT FK_BAD4FFFD14041B84 FOREIGN KEY (menus_id) REFERENCES menu (uuid)'
        );
        $this->addSql(
            'ALTER TABLE menu ADD CONSTRAINT FK_7D053A936C8A81A9 FOREIGN KEY (products_id) REFERENCES product (uuid)'
        );
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE carte DROP FOREIGN KEY FK_BAD4FFFD14041B84');
        $this->addSql('ALTER TABLE carte DROP FOREIGN KEY FK_BAD4FFFD6C8A81A9');
        $this->addSql('ALTER TABLE menu DROP FOREIGN KEY FK_7D053A936C8A81A9');
        $this->addSql('DROP TABLE carte');
        $this->addSql('DROP TABLE menu');
        $this->addSql('DROP TABLE product');
    }
}
