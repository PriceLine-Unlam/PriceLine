create function obtenerPrecio
 (@IDPRODUCTO INT , @IDSUPERMERCADO INT)
  returns NUMERIC(18,2)
  BEGIN
   DECLARE @RESULTADO NUMERIC(18,2)
   
   IF NOT EXISTS(SELECT Valor from Precio where idProducto = @IDPRODUCTO AND idSupermercado = @IDSUPERMERCADO)
   BEGIN
	SET @RESULTADO = 0.00
   END
   ELSE
   BEGIN
	SET @RESULTADO = (SELECT Valor from Precio where idProducto = @IDPRODUCTO AND idSupermercado = @IDSUPERMERCADO)
   END
   
   RETURN @RESULTADO
  END