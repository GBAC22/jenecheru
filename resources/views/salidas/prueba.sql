DELIMITER //
CREATE TRIGGER tr_stock_salida AFTER INSERT ON detalle_salidas
FOR EACH ROW BEGIN
   UPDATE articulos SET stock= stock - NEW.cantidad
   WHERE articulos.id= NEW.articulo_id;
END; //
DELIMITER ;


DELIMITER //
CREATE TRIGGER tr_stock_salida_Anular AFTER UPDATE ON salidas
FOR EACH ROW BEGIN
   UPDATE articulos p
   JOIN detalle_salidas dv
   ON dv.articulo_id= p.id
   AND dv.salida_id= new.id
   set p.stock = p.stock + dv.cantidad;

END; //
DELIMITER ;