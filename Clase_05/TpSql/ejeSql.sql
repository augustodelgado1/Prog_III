/*
Alumno : Augusto Delgado 
Div : A332
*/

1. Obtener los detalles completos de todos los usuarios, ordenados alfabéticamente.

SELECT * FROM usuario ORDER BY nombre ASC; 

2. Obtener los detalles completos de todos los productos líquidos.

SELECT * FROM producto
WHERE tipo = 'liquido';

3. Obtener todas las compras en los cuales la cantidad esté entre 6 y 10 inclusive.
SELECT * FROM venta WHERE cantidad BETWEEN 6 AND 10 


4. Obtener la cantidad total de todos los productos vendidos.

SELECT SUM(cantidad) as cantidadTotal FROM venta;

5. Mostrar los primeros 3 números de productos que se han enviado.
SELECT id FROM producto LIMIT 3;

6. Mostrar los nombres del usuario y los nombres de los productos de cada venta.
SELECT u.nombre AS nombreDeUsuario, p.nombre AS nombreDeProducto FROM venta as v
JOIN usuario u on u.id = v.idUsuario
JOIN producto p on p.id = v.idProducto;

7. Indicar el monto (cantidad * precio) por cada una de las ventas.
SELECT p.nombre , cantidad * p.precio as montoTotal FROM venta as v
JOIN producto p on p.id = v.idProducto;

8. Obtener la cantidad total del producto 1003 vendido por el usuario 104.
SELECT sum(v.cantidad) as CantidadTotal FROM venta as v
WHERE v.idUsuario=104 AND v.idProducto = 1003;

9. Obtener todos los números de los productos vendidos por algún usuario de ‘Avellaneda’.
SELECT v.idProducto as CantidadTotal FROM venta as v
JOIN usuario u on u.id = v.idUsuario AND u.localidad = 'Avellaneda'

10.Obtener los datos completos de los usuarios cuyos nombres contengan la letra ‘u’.
SELECT * FROM usuario WHERE nombre LIKE '%u%';

11. Traer las ventas entre junio del 2020 y febrero 2021.
SELECT * FROM venta as v WHERE v.fechaDeVenta BETWEEN '2020-06-01' AND '2021-02-28'

12. Obtener los usuarios registrados antes del 2021.
SELECT * FROM usuario WHERE fechaDeRegistro < '2021-01-01';

13.Agregar el producto llamado ‘Chocolate’, de tipo Sólido y con un precio de 25,35.
INSERT INTO producto (nombre,tipo,precio,fechaDeCreacion,fechaDeModificacion)
 VALUES ('Chocolate','Solido',25.35, CURDATE(), CURDATE());

14.Insertar un nuevo usuario .
INSERT INTO usuario (nombre, apellido, clave, mail, fechaDeRegistro, localidad)
VALUES ('pepe', 'pepona', 'pepe123', 'pepe@example.com', CURDATE(), 'Wilde');

15.Cambiar los precios de los productos de tipo sólido a 66,60.
UPDATE producto SET precio=66.60 WHERE tipo='solido';

16.Cambiar el stock a 0 de todos los productos cuyas cantidades de stock sean menores
a 20 inclusive.
UPDATE producto SET stock=0 WHERE stock <= 20;

17.Eliminar el producto número 1010.
DELETE FROM producto WHERE id=1010;

18.Eliminar a todos los usuarios que no han vendido productos
DELETE FROM usuario WHERE usuario.id  NOT IN (SELECT idUsuario FROM venta);