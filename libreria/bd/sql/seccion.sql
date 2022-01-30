SELECT * FROM ferreteria_santos.seccion;
alter table seccion auto_increment = 1;
delete from seccion where idSeccion < 100;

delimiter $$
create procedure registrar_seccion( p_nombre varchar(45), p_descripcion varchar(100) )
	begin
		insert into seccion( Nombre, FechaRegistro, HoraRegistro, descripcion ) values ( p_nombre, date(now()), time(now()), p_descripcion );
    end $$
delimiter ;

delimiter $$
create procedure actualizar_seccion( p_idSeccion int, p_nombre varchar(10), p_fecha_registro date, p_hora_registro time,
	p_descripcion varchar(100) )
	begin
		update seccion set Nombre = p_nombre, FechaRegistro = p_fecha_registro, HoraRegistro = p_hora_registro, 
         Descripcion = p_descripcion   where idSeccion = p_idSeccion;
    end; $$
delimiter ;

delimiter $$
create trigger indefinida_seccion_bi before insert on seccion for each row
	begin
		if( new.descripcion = '' ) then
			set new.descripcion = 'Indefinida';
		end if;    
    end $$
delimiter ;
drop trigger indefinida_seccion_bi;