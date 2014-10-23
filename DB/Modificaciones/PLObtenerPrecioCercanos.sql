ALTER PROCEDURE [dbo].[PLObtenerPreciosCercanos]
    @latitude decimal(18,14),
    @longtitude decimal(18,14),
    @idProducto int,
    @idsupermercado int
AS
BEGIN
    SET NOCOUNT ON;
    -- @p1 is the point you want to calculate the distance from which is passed as parameters
    declare @p1 geography = geography::Point(@latitude,@longtitude, 4326);

    SELECT TOP 4 S.idSupermercado
    ,PR.idProducto
    ,P.Foto
    ,P.Nombre+' - '+P.Marca nombre
    ,REPLACE(PR.Valor,'.',',') valor
   , PR.Validez
  , S.idSupermercado
, P.idProducto
    ,@p1.STDistance(geography::Point(S.Latitud, S.Longitud, 4326)) as [DistaciaEnMetros]
    FROM Supermercado S
    INNER JOIN Precio PR ON PR.idSupermercado = S.idSupermercado
    INNER JOIN Producto P ON PR.idProducto = P.idProducto
    WHERE  @p1.STDistance(geography::Point(S.Latitud, S.Longitud, 4326)) < 1000
    AND PR.idProducto = @idProducto AND PR.idSupermercado <> @idsupermercado  ORDER by DistaciaEnMetros
END