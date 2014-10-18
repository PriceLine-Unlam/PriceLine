ALTER PROCEDURE [dbo].[spGetNearLocations]
    @latitude decimal(18,14),
    @longtitude decimal(18,14),
    @idProducto int
AS
BEGIN
    SET NOCOUNT ON;
    -- @p1 is the point you want to calculate the distance from which is passed as parameters
    declare @p1 geography = geography::Point(@latitude,@longtitude, 4326);
 
    SELECT TOP 5 S.idSupermercado
    , S.Nombre
    , S.Direccion+' '+CAST(S.Numero AS VARCHAR(MAX)) direccion
    , D.Nombre+' - '+P.Nombre provincia 
    , S.Latitud
    , S.Longitud
    ,@p1.STDistance(geography::Point(S.Latitud, S.Longitud, 4326)) as [DistaciaEnMetros]
    FROM Supermercado S
    INNER JOIN priceline..Departamento D ON S.Localidad = D.ID
    INNER JOIN priceline..Provincia P ON D.idProvincia = P.ID
    INNER JOIN priceline..Precio PR ON PR.idSupermercado = S.idSupermercado
    WHERE  @p1.STDistance(geography::Point(S.Latitud, S.Longitud, 4326)) < 1000
    AND PR.idProducto = @idProducto  ORDER by DistaciaEnMetros
END