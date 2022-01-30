SELECT * FROM ferreteria_santos.marca;

delimiter $$
create trigger ninguna_marca_bi before insert on marca for each row 
	begin
		declare _default varchar(10) default 'Ninguna';        
		if( new.PaisOrigen = '' ) then
			set new.PaisOrigen = _default;
		end if;
        if( new.Descripcion = '' ) then
			set new.Descripcion = _default;
		end if;
	end $$
delimiter ; 
drop trigger  ninguna_marca_bi;

delimiter $$
create procedure registrar_marca( p_nombre varchar(25), p_origen varchar(35), p_descripcion varchar(45) )
	begin
		insert into marca ( Nombre, PaisOrigen, Descripcion ) values ( p_nombre, p_origen, p_descripcion );
    end; $$
delimiter ;