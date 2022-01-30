SELECT * FROM ferreteria_santos.cuenta;

delimiter $$
create procedure registrar_cuenta( p_nombre varchar(20), p_clave varchar(20), p_descripcion varchar(100) )
	begin
		insert into cuenta ( Nombre, Clave, FechaRegistro, HoraRegistro, Descripcion ) values ( p_nombre, p_clave,
		date(now()), time(now()), p_descripcion);
    
    end $$
delimiter ;

delimiter $$
create trigger indefinida_cuenta_bi before insert on cuenta for each row
	begin
		if( new.descripcion = '' ) then
			set new.descripcion = 'Indefinida';
		end if;    
    end $$
delimiter ;
drop trigger indefinida_cuenta_bi;