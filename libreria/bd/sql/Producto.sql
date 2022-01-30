SELECT * FROM ferreteria_santos.producto;
alter table producto auto_increment = 1;
delete from producto where idProducto < 100;

delimiter $$
create trigger indefinida_producto_bi before insert on producto for each row 
	begin
		declare _default varchar(10) default 'Indefinida';        
        if( new.Marca = '' ) then
			set new.Marca = _default;
		end if;
		if( new.Descripcion = '' ) then
			set new.Descripcion = _default;
		end if;
        if( new.Imagen= 'd41d8cd98f00b204e9800998ecf8427e.jpg' ) then
			set new.Imagen= _default;
		end if;
	end $$
delimiter ; 
drop trigger  indefinida_producto_bi;

delimiter $$
create trigger entrada_producto_ai before insert on producto for each row 
	begin					        
        insert into producto_entrada set FechaEntrada = now(), Detalle = 'Compra - Gasto', Nombre = concat(new.Nombre, ' ', new.Marca), Cantidad = new.Stock, Total = new.Precio * new.Stock; 
	end $$
delimiter ; 
drop trigger entrada_producto_ai;



-- al usar este proceso los campos de precios y stocks deben de tomarse en cuenta, si no hay dato para estos campos, iniciarlizarlos en 0
delimiter $$
create procedure registrar_producto( p_nombre varchar(50), p_marca varchar(40), p_precio decimal(10,2) , p_sock int,
  p_proveedor int, p_categoria int , p_seccion int, p_descripcion varchar(100), p_imagen longtext )
	begin
		insert into producto ( Nombre, Marca, Precio, Stock, FechaRegistro, HoraRegistro, idProveedor, idCategoria, idSeccion, 
        Descripcion, Imagen ) values ( p_nombre, p_marca, p_precio, p_sock, date(now()), time(now()), p_proveedor, p_categoria,
        p_seccion, p_descripcion, p_imagen );
    end; $$
delimiter ;

delimiter $$
create procedure actualizar_producto( p_idProducto int, p_nombre varchar(50), p_marca varchar(40), p_precio decimal(10,2) , p_sock int,
  p_fecha_registro date, p_hora_registro time, p_proveedor int, p_categoria int , p_seccion int, p_descripcion varchar(100), p_imagen longtext )
	begin
		update producto set Nombre = p_nombre, Marca = p_marca, Precio = p_precio, Stock = p_sock, FechaRegistro = p_fecha_registro, 
        HoraRegistro = p_hora_registro, idProveedor = p_proveedor, idCategoria = p_categoria, idSeccion = p_seccion, Descripcion = p_descripcion,
        Imagen = p_imagen where idProducto = p_idProducto;
    end; $$
delimiter ;

delimiter $$
create procedure generar_salida(p_codigo int, p_nombre varchar(100), p_marca varchar(100), p_precio decimal(10,2), p_stock int)
	begin
		update producto set	Stock = (Stock - p_stock) where idProducto = p_codigo;
        insert into producto_salida (FechaSalida, Detalle, Nombre, Precio, Cantidad, Total) values (now(), 'Venta - Ganancia', p_nombre,
        p_precio, p_stock, (p_precio * p_stock));
    end; $$
delimiter $$

-- SET FOREIGN_KEY_CHECKS = 1 or 0;
-- SET GLOBAL FOREIGN_KEY_CHECKS = 1 or 0;

select concat("hola" " como estas");