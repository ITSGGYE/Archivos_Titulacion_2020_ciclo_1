-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS
, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS
, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE
, SQL_MODE='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';

-- -----------------------------------------------------
-- Schema mydb
-- -----------------------------------------------------
-- -----------------------------------------------------
-- Schema ferreteria_santos(2)
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema ferreteria_santos(2)
-- -----------------------------------------------------
CREATE SCHEMA
IF NOT EXISTS `ferreteria_santos
(2)` DEFAULT CHARACTER
SET utf8mb4
COLLATE utf8mb4_general_ci ;
USE `ferreteria_santos
(2)` ;

-- -----------------------------------------------------
-- Table `ferreteria_santos(2)`.`administrador`
-- -----------------------------------------------------
CREATE TABLE
IF NOT EXISTS `ferreteria_santos
(2)`.`administrador`
(
  `idAdministrador` INT
(11) NOT NULL AUTO_INCREMENT,
  `Nombres` VARCHAR
(100) NULL DEFAULT NULL,
  `Apellidos` VARCHAR
(100) NULL DEFAULT NULL,
  `Telefono` VARCHAR
(13) NULL DEFAULT NULL,
  `FechaRegistro` DATETIME NULL DEFAULT NULL,
  `Descripcion` VARCHAR
(100) NULL DEFAULT NULL,
  `Usuario` VARCHAR
(45) NULL DEFAULT NULL,
  `Constraseña` VARCHAR
(45) NULL DEFAULT NULL,
  PRIMARY KEY
(`idAdministrador`))
ENGINE = InnoDB
AUTO_INCREMENT = 5
DEFAULT CHARACTER
SET = utf8;


-- -----------------------------------------------------
-- Table `ferreteria_santos(2)`.`categoria`
-- -----------------------------------------------------
CREATE TABLE
IF NOT EXISTS `ferreteria_santos
(2)`.`categoria`
(
  `idCategoria` INT
(11) NOT NULL AUTO_INCREMENT,
  `Nombre` VARCHAR
(50) NULL DEFAULT NULL,
  `FechaRegistro` DATE NULL DEFAULT NULL,
  `HoraRegistro` TIME NULL DEFAULT NULL,
  `Descripcion` VARCHAR
(100) NULL DEFAULT NULL,
  PRIMARY KEY
(`idCategoria`))
ENGINE = InnoDB
AUTO_INCREMENT = 95
DEFAULT CHARACTER
SET = utf8;


-- -----------------------------------------------------
-- Table `ferreteria_santos(2)`.`cliente`
-- -----------------------------------------------------
CREATE TABLE
IF NOT EXISTS `ferreteria_santos
(2)`.`cliente`
(
  `idCliente` INT
(11) NOT NULL AUTO_INCREMENT,
  `Nombres` VARCHAR
(100) NULL DEFAULT NULL,
  `Apellidos` VARCHAR
(100) NULL DEFAULT NULL,
  `Telefono` VARCHAR
(13) NULL DEFAULT NULL,
  `Correo` VARCHAR
(45) NULL DEFAULT NULL,
  `FechaRegistro` DATETIME NULL DEFAULT NULL,
  `Descripcion` VARCHAR
(100) NULL DEFAULT NULL,
  PRIMARY KEY
(`idCliente`))
ENGINE = InnoDB
AUTO_INCREMENT = 25
DEFAULT CHARACTER
SET = utf8;


-- -----------------------------------------------------
-- Table `ferreteria_santos(2)`.`tipo_cuenta`
-- -----------------------------------------------------
CREATE TABLE
IF NOT EXISTS `ferreteria_santos
(2)`.`tipo_cuenta`
(
  `idTipo_cuenta` INT
(11) NOT NULL AUTO_INCREMENT,
  `Nombre` VARCHAR
(45) NULL DEFAULT NULL,
  PRIMARY KEY
(`idTipo_cuenta`))
ENGINE = InnoDB
DEFAULT CHARACTER
SET = utf8mb4;
-- COLLATE = utf8mb4_general_ci;


-- -----------------------------------------------------
-- Table `ferreteria_santos(2)`.`cuenta`
-- -----------------------------------------------------
CREATE TABLE
IF NOT EXISTS `ferreteria_santos
(2)`.`cuenta`
(
  `idCuenta` INT
(11) NOT NULL AUTO_INCREMENT,
  `Nombre` VARCHAR
(20) NULL DEFAULT NULL,
  `Clave` VARCHAR
(20) NULL DEFAULT NULL,
  `FechaRegistro` DATE NULL DEFAULT NULL,
  `HoraRegistro` TIME NULL DEFAULT NULL,
  `descripcion` VARCHAR
(100) NULL DEFAULT NULL,
  `idTipo_cuenta` INT
(11) NOT NULL,
  PRIMARY KEY
(`idCuenta`),
  INDEX `fk_cuenta_tipo_cuenta1_idx`
(`idTipo_cuenta` ASC) VISIBLE,  
  CONSTRAINT `fk_cuenta_tipo_cuenta1`
    FOREIGN KEY
(`idTipo_cuenta`)
    REFERENCES `ferreteria_santos
(2)`.`tipo_cuenta`
(`idTipo_cuenta`))
ENGINE = InnoDB
AUTO_INCREMENT = 3
DEFAULT CHARACTER
SET = utf8;


-- -----------------------------------------------------
-- Table `ferreteria_santos(2)`.`curriculum`
-- -----------------------------------------------------
CREATE TABLE
IF NOT EXISTS `ferreteria_santos
(2)`.`curriculum`
(
  `idCurriculum` INT
(11) NOT NULL AUTO_INCREMENT,
  `Archivo` BLOB NOT NULL,
  `FechaRegistro` DATE NULL DEFAULT NULL,
  PRIMARY KEY
(`idCurriculum`))
ENGINE = InnoDB
DEFAULT CHARACTER
SET = utf8;


-- -----------------------------------------------------
-- Table `ferreteria_santos(2)`.`events`
-- -----------------------------------------------------
CREATE TABLE
IF NOT EXISTS `ferreteria_santos
(2)`.`events`
(
  `id` INT
(11) NOT NULL AUTO_INCREMENT,
  `title` VARCHAR
(255) NOT NULL,
  `color` VARCHAR
(7) NULL DEFAULT NULL,
  `start` DATETIME NOT NULL,
  `
end` DATETIME NULL DEFAULT NULL,
  PRIMARY KEY
(`id`))
ENGINE = InnoDB
AUTO_INCREMENT = 9
DEFAULT CHARACTER
SET = utf8;


-- -----------------------------------------------------
-- Table `ferreteria_santos(2)`.`opinion_publica`
-- -----------------------------------------------------
CREATE TABLE
IF NOT EXISTS `ferreteria_santos
(2)`.`opinion_publica`
(
  `idOpinion_publica` INT
(11) NOT NULL AUTO_INCREMENT,
  `Nombres` VARCHAR
(80) NULL DEFAULT NULL,
  `Correo` VARCHAR
(80) NULL DEFAULT NULL,
  `Titulo` VARCHAR
(50) NULL DEFAULT NULL,
  `FechaRegistro` DATE NULL DEFAULT NULL,
  `HoraRegistro` TIME NULL DEFAULT NULL,
  `Descripcion` VARCHAR
(300) NULL DEFAULT NULL,
  PRIMARY KEY
(`idOpinion_publica`))
ENGINE = MyISAM
AUTO_INCREMENT = 38
DEFAULT CHARACTER
SET = utf8mb4;
-- COLLATE = utf8mb4_general_ci;


-- -----------------------------------------------------
-- Table `ferreteria_santos(2)`.`proveedor`
-- -----------------------------------------------------
CREATE TABLE
IF NOT EXISTS `ferreteria_santos
(2)`.`proveedor`
(
  `idProveedor` INT
(11) NOT NULL AUTO_INCREMENT,
  `Nombre` VARCHAR
(40) NOT NULL,
  `Correo` VARCHAR
(45) NULL DEFAULT NULL,
  `Direccion` VARCHAR
(45) NULL DEFAULT NULL,
  `Telefono` VARCHAR
(13) NULL DEFAULT NULL,
  `FechaRegistro` DATE NULL DEFAULT NULL,
  `HoraRegistro` TIME NULL DEFAULT NULL,
  `Especialidad` VARCHAR
(100) NULL DEFAULT NULL,
  `Descripcion` VARCHAR
(100) NULL DEFAULT NULL,
  PRIMARY KEY
(`idProveedor`))
ENGINE = InnoDB
AUTO_INCREMENT = 10
DEFAULT CHARACTER
SET = utf8;


-- -----------------------------------------------------
-- Table `ferreteria_santos(2)`.`seccion`
-- -----------------------------------------------------
CREATE TABLE
IF NOT EXISTS `ferreteria_santos
(2)`.`seccion`
(
  `idSeccion` INT
(11) NOT NULL AUTO_INCREMENT,
  `Nombre` VARCHAR
(10) NULL DEFAULT NULL,
  `FechaRegistro` DATE NULL DEFAULT NULL,
  `HoraRegistro` TIME NULL DEFAULT NULL,
  `Descripcion` VARCHAR
(100) NULL DEFAULT NULL,
  PRIMARY KEY
(`idSeccion`))
ENGINE = InnoDB
AUTO_INCREMENT = 13
DEFAULT CHARACTER
SET = utf8mb4;
-- COLLATE = utf8mb4_general_ci;


-- -----------------------------------------------------
-- Table `ferreteria_santos(2)`.`producto`
-- -----------------------------------------------------
CREATE TABLE
IF NOT EXISTS `ferreteria_santos
(2)`.`producto`
(
  `idProducto` INT
(11) NOT NULL AUTO_INCREMENT,
  `Nombre` VARCHAR
(50) NULL DEFAULT NULL,
  `Marca` VARCHAR
(40) NULL DEFAULT NULL,
  `Precio` DECIMAL
(10,2) NULL DEFAULT NULL,
  `Stock` INT
(5) NULL DEFAULT NULL,
  `FechaRegistro` DATE NULL DEFAULT NULL,
  `HoraRegistro` TIME NULL DEFAULT NULL,
  `idProveedor` INT
(11) NOT NULL,
  `idCategoria` INT
(11) NOT NULL,
  `idSeccion` INT
(11) NOT NULL,
  `Descripcion` VARCHAR
(100) NULL DEFAULT NULL,
  `Imagen` LONGTEXT NULL DEFAULT NULL,
  PRIMARY KEY
(`idProducto`),
  INDEX `fk_Producto_Categoria1_idx`
(`idCategoria` ASC) VISIBLE,
  INDEX `fk_Producto_Proveedor1_idx`
(`idProveedor` ASC) VISIBLE,
  INDEX `fk_producto_seccion1_idx`
(`idSeccion` ASC) VISIBLE,
  CONSTRAINT `fk_Producto_Categoria1`
    FOREIGN KEY
(`idCategoria`)
    REFERENCES `ferreteria_santos
(2)`.`categoria`
(`idCategoria`),
  CONSTRAINT `fk_Producto_Proveedor1`
    FOREIGN KEY
(`idProveedor`)
    REFERENCES `ferreteria_santos
(2)`.`proveedor`
(`idProveedor`),
  CONSTRAINT `fk_producto_seccion1`
    FOREIGN KEY
(`idSeccion`)
    REFERENCES `ferreteria_santos
(2)`.`seccion`
(`idSeccion`))
ENGINE = InnoDB
AUTO_INCREMENT = 654
DEFAULT CHARACTER
SET = utf8;


-- -----------------------------------------------------
-- Table `ferreteria_santos(2)`.`producto_entrada`
-- -----------------------------------------------------
CREATE TABLE
IF NOT EXISTS `ferreteria_santos
(2)`.`producto_entrada`
(
  `idProducto_entrada` INT
(11) NOT NULL AUTO_INCREMENT,
  `FechaEntrada` DATETIME NULL DEFAULT NULL,
  `Detalle` VARCHAR
(100) NULL DEFAULT NULL,
  `Nombre` VARCHAR
(100) NULL DEFAULT NULL,
  `Cantidad` INT
(11) NULL DEFAULT NULL,
  `Total` DECIMAL
(10,2) NULL DEFAULT NULL,
  PRIMARY KEY
(`idProducto_entrada`))
ENGINE = MyISAM
AUTO_INCREMENT = 555
DEFAULT CHARACTER
SET = utf8mb4;
-- COLLATE = utf8mb4_general_ci;


-- -----------------------------------------------------
-- Table `ferreteria_santos(2)`.`producto_salida`
-- -----------------------------------------------------
CREATE TABLE
IF NOT EXISTS `ferreteria_santos
(2)`.`producto_salida`
(
  `idproducto_salida` INT
(11) NOT NULL AUTO_INCREMENT,
  `FechaSalida` DATETIME NULL DEFAULT NULL,
  `Detalle` VARCHAR
(100) NULL DEFAULT NULL,
  `Nombre` VARCHAR
(100) NULL DEFAULT NULL,
  `Precio` DECIMAL
(10,2) NULL DEFAULT NULL,
  `Cantidad` INT
(11) NULL DEFAULT NULL,
  `Total` DECIMAL
(10,2) NULL DEFAULT NULL,
  PRIMARY KEY
(`idproducto_salida`))
ENGINE = MyISAM
AUTO_INCREMENT = 5
DEFAULT CHARACTER
SET = utf8mb4;
-- COLLATE = utf8mb4_general_ci;

USE `ferreteria_santos
(2)` ;

-- -----------------------------------------------------
-- procedure actualizar_categoria
-- -----------------------------------------------------

DELIMITER $$
USE `ferreteria_santos
(2)`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `actualizar_categoria`
( p_idCategoria int, p_nombre varchar
(50), p_fecha_registro date, p_hora_registro time,
	p_descripcion varchar
(100) )
begin
  update categoria set Nombre = p_nombre, FechaRegistro = p_fecha_registro, HoraRegistro = p_hora_registro, 
         Descripcion = p_descripcion   where idCategoria =p_idCategoria;
  end$$

DELIMITER
;

-- -----------------------------------------------------
-- procedure actualizar_cliente
-- -----------------------------------------------------

DELIMITER $$
USE `ferreteria_santos
(2)`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `actualizar_cliente`
( p_idCliente int, p_nombre varchar
(100), p_apellido varchar
(100), p_telefono varchar
(13), p_correo varchar
(45), p_fecha_registro datetime, p_descripcion varchar
(100) )
begin
  update cliente set Nombres =  p_nombre, Apellidos = p_apellido, Telefono = p_telefono, Correo = p_correo, FechaRegistro = p_fecha_registro, Descripcion = p_descripcion where idCliente = p_idCliente;
  end$$

DELIMITER
;

-- -----------------------------------------------------
-- procedure actualizar_producto
-- -----------------------------------------------------

DELIMITER $$
USE `ferreteria_santos
(2)`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `actualizar_producto`
( p_idProducto int, p_nombre varchar
(50), p_marca varchar
(40), p_precio decimal
(10,2) , p_sock int,
  p_fecha_registro date, p_hora_registro time, p_proveedor int, p_categoria int , p_seccion int, p_descripcion varchar
(100), p_imagen longtext )
begin
  update producto set Nombre = p_nombre, Marca = p_marca, Precio = p_precio, Stock = p_sock, FechaRegistro = p_fecha_registro, 
        HoraRegistro = p_hora_registro, idProveedor = p_proveedor, idCategoria = p_categoria, idSeccion = p_seccion, Descripcion = p_descripcion,
        Imagen = p_imagen where idProducto = p_idProducto;
  end$$

DELIMITER
;

-- -----------------------------------------------------
-- procedure actualizar_proveedor
-- -----------------------------------------------------

DELIMITER $$
USE `ferreteria_santos
(2)`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `actualizar_proveedor`
( p_idProveedor int, p_nombre varchar
(10),  p_correo varchar
(45), p_direccion varchar
(45), p_telefono varchar
(13),
 p_fecha_registro date, p_hora_registro time, p_especialidad varchar
(100), p_descripcion varchar
(100) )
begin
  update proveedor set Nombre = p_nombre, Correo = p_correo, Direccion =  p_direccion, Telefono = p_telefono , FechaRegistro = p_fecha_registro, 
        HoraRegistro = p_hora_registro, Especialidad = p_especialidad, Descripcion = p_descripcion  where idProveedor = p_idProveedor;
  end$$

DELIMITER
;

-- -----------------------------------------------------
-- procedure actualizar_seccion
-- -----------------------------------------------------

DELIMITER $$
USE `ferreteria_santos
(2)`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `actualizar_seccion`
( p_idSeccion int, p_nombre varchar
(10), p_fecha_registro date, p_hora_registro time,
	p_descripcion varchar
(100) )
begin
  update seccion set Nombre = p_nombre, FechaRegistro = p_fecha_registro, HoraRegistro = p_hora_registro, 
         Descripcion = p_descripcion   where idSeccion = p_idSeccion;
  end$$

DELIMITER
;

-- -----------------------------------------------------
-- procedure generar_salida
-- -----------------------------------------------------

DELIMITER $$
USE `ferreteria_santos
(2)`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `generar_salida`
(p_codigo int, p_nombre varchar
(100), p_marca varchar
(100), p_precio decimal
(10,2), p_stock int)
begin
  update producto set	Stock = (Stock - p_stock) where idProducto = p_codigo;
  insert into producto_salida
    (FechaSalida, Detalle, Nombre, Precio, Cantidad, Total)
  values
    (now(), 'Venta - Ganancia', p_nombre,
      p_precio, p_stock, (p_precio * p_stock));
  end$$

DELIMITER
;

-- -----------------------------------------------------
-- procedure registrar_administrador
-- -----------------------------------------------------

DELIMITER $$
USE `ferreteria_santos
(2)`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `registrar_administrador`
( p_nombre varchar
(45), p_apellido varchar
(45), p_telefono varchar
(13), p_descripcion varchar
(100), p_cuenta int )
begin
  insert into administrador
    ( Nombre, Apellido, Telefono, FechaRegistro, Descripcion, idCuenta )
  values
    ( p_nombre, p_apellido, p_telefono,
      date(now()), p_descripcion, p_cuenta );

  end$$

DELIMITER
;

-- -----------------------------------------------------
-- procedure registrar_categoria
-- -----------------------------------------------------

DELIMITER $$
USE `ferreteria_santos
(2)`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `registrar_categoria`
( p_nombre varchar
(50), p_descripcion varchar
(100) )
begin
  insert into categoria
    ( Nombre, FechaRegistro, HoraRegistro, Descripcion)
  values
    ( p_nombre, date(now()), time(now()), p_descripcion);
  end$$

DELIMITER
;

-- -----------------------------------------------------
-- procedure registrar_cliente
-- -----------------------------------------------------

DELIMITER $$
USE `ferreteria_santos
(2)`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `registrar_cliente`
( p_nombre varchar
(100), p_apellido varchar
(100), p_telefono varchar
(13), p_correo varchar
(45), p_descripcion varchar
(100) )
begin
  insert into cliente
    ( Nombres, Apellidos, Telefono, Correo, FechaRegistro, Descripcion )
  values
    ( p_nombre, p_apellido, p_telefono, p_correo,
      now(), p_descripcion);

  end$$

DELIMITER
;

-- -----------------------------------------------------
-- procedure registrar_cuenta
-- -----------------------------------------------------

DELIMITER $$
USE `ferreteria_santos
(2)`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `registrar_cuenta`
( p_nombre varchar
(20), p_clave varchar
(20), p_descripcion varchar
(100) )
begin
  insert into cuenta
    ( Nombre, Clave, FechaRegistro, HoraRegistro, Descripcion )
  values
    ( p_nombre, p_clave,
      date(now()), time(now()), p_descripcion);

  end$$

DELIMITER
;

-- -----------------------------------------------------
-- procedure registrar_producto
-- -----------------------------------------------------

DELIMITER $$
USE `ferreteria_santos
(2)`
CREATE DEFINER=`root`@`localhost` PROCEDURE `registrar_producto`
( p_nombre varchar
(50), p_marca varchar
(40), p_precio decimal
(10,2) , p_sock int,
  p_proveedor int, p_categoria int , p_seccion int, p_descripcion varchar
(100), p_imagen longtext )
begin
  insert into producto
    ( Nombre, Marca, Precio, Stock, FechaRegistro, HoraRegistro, idProveedor, idCategoria, idSeccion,
    Descripcion, Imagen )
  values
    ( p_nombre, p_marca, p_precio, p_sock, date(now()), time(now()), p_proveedor, p_categoria,
      p_seccion, p_descripcion, p_imagen );
  end$$

DELIMITER
;

-- -----------------------------------------------------
-- procedure registrar_proveedor
-- -----------------------------------------------------

DELIMITER $$
USE `ferreteria_santos
(2)`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `registrar_proveedor`
( p_nombre varchar
(45), p_correo varchar
(45), p_direccion varchar
(405), p_telefono varchar
(13), p_especialidad varchar
(100), p_descripcion varchar
(100) )
begin
  insert into proveedor
    (Nombre, Correo, Direccion, Telefono, FechaRegistro, HoraRegistro, Especialidad, Descripcion)
  values
    (p_nombre, p_correo, p_direccion, p_telefono, date(now()), time(now()), p_especialidad, p_descripcion);
  end$$

DELIMITER
;

-- -----------------------------------------------------
-- procedure registrar_seccion
-- -----------------------------------------------------

DELIMITER $$
USE `ferreteria_santos
(2)`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `registrar_seccion`
( p_nombre varchar
(10), p_descripcion varchar
(100) )
begin
  insert into seccion
    ( Nombre, FechaRegistro, HoraRegistro, descripcion )
  values
    ( p_nombre, date(now()), time(now()), p_descripcion );
  end$$

DELIMITER
;
USE `ferreteria_santos
(2)`;

DELIMITER $$
USE `ferreteria_santos
(2)`$$
CREATE
DEFINER=`root`@`localhost`
TRIGGER `ferreteria_santos`.`indefinida_administrador_bi`
BEFORE
INSERT ON `
ferreteria_santos`.`administrador
`
FOR EACH ROW
begin
  declare _default varchar
  (10) default 'Indefinida';
  if( new.Telefono = '' ) then
  set new
  .Telefono = _default;
end
if;
		if( new.Descripcion = '' ) then
set new
.Descripcion = _default;
end
if;        
	end$$

USE `ferreteria_santos
(2)`$$
CREATE
DEFINER=`root`@`localhost`
TRIGGER `ferreteria_santos`.`indefinida_Categoria_bi`
BEFORE
INSERT ON `
ferreteria_santos`.`categoria
`
FOR EACH ROW
begin
  if( new.Descripcion = '' ) then
  set new
  .Descripcion = 'Indefinida';
end
if;
    end$$

USE `ferreteria_santos
(2)`$$
CREATE
DEFINER=`root`@`localhost`
TRIGGER `ferreteria_santos`.`indefinida_cliente_bi`
BEFORE
INSERT ON `
ferreteria_santos`.`cliente
`
FOR EACH ROW
begin
  declare _default varchar
  (10) default 'Indefinida';
  if( new.Apellidos = '' ) then
  set new
  .Apellidos = _default;
end
if;
		if( new.Descripcion = '' ) then
set new
.Descripcion = _default;
end
if;
        if( new.Telefono= '' ) then
set new
.Telefono= _default;
end
if;
	end$$

USE `ferreteria_santos
(2)`$$
CREATE
DEFINER=`root`@`localhost`
TRIGGER `ferreteria_santos`.`indefinida_cuenta_bi`
BEFORE
INSERT ON `
ferreteria_santos`.`cuenta
`
FOR EACH ROW
begin
  if( new.descripcion = '' ) then
  set new
  .descripcion = 'Indefinida';
end
if;    
    end$$

USE `ferreteria_santos
(2)`$$
CREATE
DEFINER=`root`@`localhost`
TRIGGER `ferreteria_santos`.`indefinida_proveedor_bi`
BEFORE
INSERT ON `
ferreteria_santos`.`proveedor
`
FOR EACH ROW
begin
  declare _default varchar
  (10) default 'Indefinida';
  if( new.Correo = '' ) then
  set new
  .Correo = _default;
end
if;
		if( new.Direccion = '') then
set new
.Direccion = _default;
end
if;
		if( new.Telefono = '' ) then
set new
.Telefono = _default;
end
if;
		if( new.Especialidad = '' ) then
set new
.Especialidad = _default;
end
if;
		if( new.Descripcion = '' ) then
set new
.Descripcion = _default;
end
if;
	end$$

USE `ferreteria_santos
(2)`$$
CREATE
DEFINER=`root`@`localhost`
TRIGGER `ferreteria_santos`.`indefinida_seccion_bi`
BEFORE
INSERT ON `
ferreteria_santos`.`seccion
`
FOR EACH ROW
begin
  if( new.descripcion = '' ) then
  set new
  .descripcion = 'Indefinida';
end
if;    
    end$$

USE `ferreteria_santos
(2)`$$
CREATE
DEFINER=`root`@`localhost`
TRIGGER `ferreteria_santos`.`entrada_producto_ai`
BEFORE
INSERT ON `
ferreteria_santos`.`producto
`
FOR EACH ROW
begin
  insert into producto_entrada
  set FechaEntrada
  = now
  (), Detalle = 'Compra - Gasto', Nombre = concat
  (new.Nombre, ' ', new.Marca), Cantidad = new.Stock, Total = new.Precio * new.Stock;
end$$

USE `ferreteria_santos
(2)`$$
CREATE
DEFINER=`root`@`localhost`
TRIGGER `ferreteria_santos`.`indefinida_producto_bi`
BEFORE
INSERT ON `
ferreteria_santos`.`producto
`
FOR EACH ROW
begin
  declare _default varchar
  (10) default 'Indefinida';
  if( new.Marca = '' ) then
  set new
  .Marca = _default;
end
if;
		if( new.Descripcion = '' ) then
set new
.Descripcion = _default;
end
if;
        if( new.Imagen= 'd41d8cd98f00b204e9800998ecf8427e.jpg' ) then
set new
.Imagen= _default;
end
if;
	end$$


DELIMITER ;

SET SQL_MODE
=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS
=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS
=@OLD_UNIQUE_CHECKS;
