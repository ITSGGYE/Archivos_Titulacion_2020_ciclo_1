SELECT * FROM ferreteria_santos.cliente;

delimiter $$
create trigger indefinida_cliente_bi before insert on cliente for each row 
	begin
		declare _default varchar(10) default 'Indefinida';        
        if( new.Apellidos = '' ) then
			set new.Apellidos = _default;
		end if;
		if( new.Descripcion = '' ) then
			set new.Descripcion = _default;
		end if;
        if( new.Telefono= '' ) then
			set new.Telefono= _default;
		end if;
	end $$
delimiter ; 
drop trigger  indefinida_cliente_bi;

delimiter $$
create procedure registrar_cliente( p_nombre varchar(100), p_apellido varchar(100), p_telefono varchar(13), p_correo varchar(45), p_descripcion varchar(100) )
	begin
		insert into cliente ( Nombres, Apellidos, Telefono, Correo, FechaRegistro, Descripcion ) values ( p_nombre, p_apellido, p_telefono, p_correo,
		now(), p_descripcion);
    
    end; $$
delimiter ;    

delimiter $$
create procedure actualizar_cliente( p_idCliente int, p_nombre varchar(100), p_apellido varchar(100), p_telefono varchar(13), p_correo varchar(45), p_fecha_registro datetime, p_descripcion varchar(100) )
	begin		
		update cliente set Nombres =  p_nombre, Apellidos = p_apellido, Telefono = p_telefono, Correo = p_correo, FechaRegistro = p_fecha_registro, Descripcion = p_descripcion where idCliente = p_idCliente;
	end; $$
delimiter ;
