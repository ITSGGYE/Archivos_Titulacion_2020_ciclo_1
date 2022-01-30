SELECT * FROM ferreteria_santos.proveedor;
alter table proveedor auto_increment = 1;
delete from proveedor where idProveedor < 100;

delimiter $$
create procedure registrar_proveedor( p_nombre varchar(45), p_correo varchar(45), p_direccion varchar(45), p_telefono varchar(13), p_especialidad varchar(100), p_descripcion varchar(100) )
	begin
		 insert into proveedor (Nombre, Correo, Direccion, Telefono, FechaRegistro, HoraRegistro, Especialidad, Descripcion) values (p_nombre, p_correo,  p_direccion,  p_telefono, date(now()), time(now()),  p_especialidad,  p_descripcion);
	 end; $$
delimiter ;

delimiter $$
create procedure actualizar_proveedor( p_idProveedor int, p_nombre varchar(10),  p_correo varchar(45), p_direccion varchar(45), p_telefono varchar(13),
 p_fecha_registro date, p_hora_registro time, p_especialidad varchar(100), p_descripcion varchar(100) )
	begin
		update proveedor set Nombre = p_nombre, Correo = p_correo, Direccion =  p_direccion, Telefono = p_telefono , FechaRegistro = p_fecha_registro, 
        HoraRegistro = p_hora_registro, Especialidad = p_especialidad, Descripcion = p_descripcion  where idProveedor = p_idProveedor;
    end; $$
delimiter ;
         
delimiter $$
create trigger indefinida_proveedor_bi before insert on proveedor for each row 
	begin
		declare _default varchar(10) default 'Indefinida';
		if( new.Correo = '' ) then
			set new.Correo = _default;
		end if;
		if( new.Direccion = '') then 
			set new.Direccion = _default;
		end if;
		if( new.Telefono = '' ) then
			set new.Telefono = _default;
		end if;
		if( new.Especialidad = '' ) then
			set new.Especialidad = _default;
		end if;
		if( new.Descripcion = '' ) then
			set new.Descripcion = _default;
		end if;
	end $$
delimiter ; 
drop trigger indefinida_proveedor_bi;