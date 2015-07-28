DELIMITER $$

drop trigger if exists protect_default_functions_delete $$
create trigger protect_default_functions_delete before delete on eop_entity for each row 
begin
	IF old.`name`= 'Sample Function' THEN
	  call do_not_delete();
	end IF;

END$$ 