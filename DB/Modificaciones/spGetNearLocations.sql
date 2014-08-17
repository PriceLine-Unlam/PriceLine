CREATE PROCEDURE [dbo].[spGetNearLocations]
    @latitude decimal(18,14),
    @longtitude decimal(18,14)
AS
BEGIN
    SET NOCOUNT ON;
    -- @p1 is the point you want to calculate the distance from which is passed as parameters
    declare @p1 geography = geography::Point(@latitude,@longtitude, 4326);
 
    SELECT TOP 5 *
        ,@p1.STDistance(geography::Point(Latitud, Longitud, 4326)) as [DistaciaEnMetros]
    FROM Supermercado WHERE  @p1.STDistance(geography::Point(Latitud, Longitud, 4326)) < 1000  ORDER by DistaciaEnMetros
END