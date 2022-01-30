SELECT * FROM ferreteria_santos.administrador;
delete from administrador where idAdministrador < 100;

delimiter $$
create procedure registrar_administrador( p_nombre varchar(45), p_apellido varchar(45), p_telefono varchar(13), p_descripcion varchar(100), p_cuenta int )
	begin
		insert into administrador ( Nombre, Apellido, Telefono, FechaRegistro, Descripcion, idCuenta ) values ( p_nombre, p_apellido, p_telefono,
		date(now()), p_descripcion, p_cuenta );
    
    end $$
delimiter ;
-- select * from cuenta c  join administrador a using (idCuenta); 

delimiter $$
create trigger indefinida_administrador_bi before insert on administrador for each row 
	begin
		declare _default varchar(10) default 'Indefinida';        
        if( new.Telefono = '' ) then
			set new.Telefono = _default;
		end if;
		if( new.Descripcion = '' ) then
			set new.Descripcion = _default;
		end if;        
	end $$
delimiter ; 
drop trigger  indefinida_administrador_b;