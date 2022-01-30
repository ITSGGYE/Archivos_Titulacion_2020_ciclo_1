SELECT * FROM ferreteria_santos.producto_salida;

delimiter $$
create trigger salida_producto_bi before insert on producto_salida for each row 
	begin					        
        update producto set Stock = 1;
	end $$
delimiter ; 
drop trigger salida_producto_bi;