SELECT * FROM ferreteria_santos.categoria;
alter table categoria auto_increment = 1;
delete from categoria where idCategoria < 100;

delimiter $$
create procedure registrar_categoria( p_nombre varchar(50), p_descripcion varchar(100) )
	begin		
		 insert into categoria ( Nombre, FechaRegistro, HoraRegistro, Descripcion) values ( p_nombre, date(now()), time(now()), p_descripcion);
    end; $$
delimiter ;

delimiter $$
create trigger indefinida_Categoria_bi before insert on categoria  for each row 
	begin
		if( new.Descripcion = '' ) then
			set new.Descripcion = 'Indefinida';
		end if;
    end $$
delimiter ;
drop trigger indefinida_Categoria_bi ;

delimiter $$
create procedure actualizar_categoria( p_idCategoria int, p_nombre varchar(50), p_fecha_registro date, p_hora_registro time,
	p_descripcion varchar(100) )
	begin
		update categoria set Nombre = p_nombre, FechaRegistro = p_fecha_registro, HoraRegistro = p_hora_registro, 
         Descripcion = p_descripcion   where idCategoria =p_idCategoria;
    end; $$
delimiter ;

delete from categoria where idCategoria > 13;