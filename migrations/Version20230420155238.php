<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230420155238 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE pedidos CHANGE CodUsu CodUsu INT DEFAULT NULL, CHANGE Nombre nombre VARCHAR(255) NOT NULL, CHANGE Direccion direccion VARCHAR(255) NOT NULL, CHANGE Telefono telefono VARCHAR(255) NOT NULL, CHANGE Email email VARCHAR(255) NOT NULL, CHANGE metodo_pago metodo_pago VARCHAR(255) NOT NULL, CHANGE Total total DOUBLE PRECISION NOT NULL, CHANGE cod_Prod cod_prod VARCHAR(10) DEFAULT NULL, CHANGE nombre_Prod nombre_prod VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE productos CHANGE Precio Precio INT NOT NULL, CHANGE image_link image_link VARCHAR(255) NOT NULL, CHANGE fecha_creacion fecha_creacion DATETIME NOT NULL');
        $this->addSql('DROP INDEX producto_id ON tallas');
        $this->addSql('ALTER TABLE tallas DROP nombre, DROP producto_id');
        $this->addSql('ALTER TABLE user CHANGE nombre nombre VARCHAR(255) NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE pedidos DROP FOREIGN KEY FK_6716CCAAD9221A74');
        $this->addSql('ALTER TABLE pedidos CHANGE nombre Nombre VARCHAR(255) DEFAULT NULL, CHANGE direccion Direccion VARCHAR(255) DEFAULT NULL, CHANGE telefono Telefono VARCHAR(255) DEFAULT NULL, CHANGE email Email VARCHAR(255) DEFAULT NULL, CHANGE metodo_pago metodo_pago VARCHAR(255) DEFAULT NULL, CHANGE total Total NUMERIC(10, 2) DEFAULT NULL, CHANGE nombre_prod nombre_Prod VARCHAR(255) DEFAULT NULL COMMENT \'Nombre del producto comprado\', CHANGE cod_prod cod_Prod INT DEFAULT NULL COMMENT \'Código único del producto comprado\', CHANGE CodUsu CodUsu INT NOT NULL');
        $this->addSql('ALTER TABLE tallas ADD nombre VARCHAR(20) NOT NULL, ADD producto_id INT NOT NULL');
        $this->addSql('CREATE INDEX producto_id ON tallas (producto_id)');
        $this->addSql('ALTER TABLE user CHANGE nombre nombre VARCHAR(50) NOT NULL');
        $this->addSql('ALTER TABLE productos CHANGE Precio Precio DOUBLE PRECISION NOT NULL, CHANGE image_link image_link TEXT DEFAULT NULL COMMENT \'ENLACE DE LA IMAGEN DEL PRODUCTO\', CHANGE fecha_creacion fecha_creacion DATE DEFAULT NULL COMMENT \'fecha de creacion del producto\'');
    }
}
