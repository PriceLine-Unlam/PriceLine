USE [priceline]
GO

/****** Object:  StoredProcedure [dbo].[Presupuesto]    Script Date: 09/06/2014 16:21:28 ******/
IF  EXISTS (SELECT * FROM sys.objects WHERE object_id = OBJECT_ID(N'[dbo].[Presupuesto]') AND type in (N'P', N'PC'))
DROP PROCEDURE [dbo].[Presupuesto]
GO

USE [priceline]
GO

/****** Object:  StoredProcedure [dbo].[Presupuesto]    Script Date: 09/06/2014 16:21:28 ******/
SET ANSI_NULLS ON
GO

SET QUOTED_IDENTIFIER ON
GO



-- =============================================
-- Author:		<Author,,Name>
-- Create date: <Create Date,,>
-- Description:	<Description,,>
-- =============================================
CREATE PROCEDURE [dbo].[Presupuesto] 
	-- Add the parameters for the stored procedure here
--	@idProductos varchar(MAX), 
--	@importancia varchar(MAX)
	@username varchar(100),
	@idLista int,
	@latitude decimal(18,14) = 0,
    @longtitude decimal(18,14) = 0,
    @option int = 1 
AS
BEGIN
			
SET NOCOUNT ON;
-- @idProductos 1,1,1

DECLARE @individual varchar(20),
		@IndividualImp varchar(20),
		@idProductos varchar(max) = '',
		@importancia varchar(max) = '',
		@supermercados varchar(max) = ''

IF(@latitude = 0)
BEGIN
	SET @latitude =  (SELECT top 1 Latitud FROM priceline..Supermercado WHERE (ABS(CAST(  (BINARY_CHECKSUM(*) *  RAND()) as int)) % 100) <70)
	SET @longtitude = (SELECT top 1 Longitud FROM priceline..Supermercado WHERE (ABS(CAST(  (BINARY_CHECKSUM(*) *  RAND()) as int)) % 100) <70)
END


IF OBJECT_ID('tempdb..##tempPresupuesto') IS NULL
BEGIN 
		CREATE TABLE ##tempPresupuesto(
		idProducto int not null,
		importancia int not null,
		idSupermercado1 int,
		Supermercado1 numeric(18,2) default 0.00,
		idSupermercado2 int,
		Supermercado2 numeric(18,2) default 0.00,
		idSupermercado3 int,
		Supermercado3 numeric(18,2) default 0.00,
		idSupermercado4 int,
		Supermercado4 numeric(18,2) default 0.00,
		idSupermercado5 int,
		Supermercado5 numeric(18,2) default 0.00
		)
END
ELSE
BEGIN
	TRUNCATE TABLE ##tempPresupuesto
END

declare @p1 geography = geography::Point(@latitude,@longtitude, 4326);

SELECT @idProductos += CONVERT(VARCHAR,pl.idProducto) + ',' FROM Lista l INNER JOIN  Producto_Lista pl  ON l.idLista = pl.idLista WHERE l.usuario = @username and l.idLista = @idLista ORDER BY pl.idProducto
SELECT @importancia += CONVERT(VARCHAR,pl.importancia) + ',' FROM Lista l INNER JOIN  Producto_Lista pl  ON l.idLista = pl.idLista WHERE l.usuario = @username and l.idLista = @idLista ORDER BY pl.idProducto
SELECT @supermercados +=  convert(VARCHAR,idSupermercado) +'|'  FROM Supermercado  -- WHERE  @p1.STDistance(geography::Point(Latitud, Longitud, 4326)) < 1000

--SELECT @supermercados,@latitude,@longtitude
--SELECT @p1.STDistance(geography::Point(Latitud, Longitud, 4326)) FROM Supermercado

WHILE LEN(@idProductos) > 0
BEGIN
    IF PATINDEX('%,%',@idProductos) > 0
    BEGIN
        SET @individual = SUBSTRING(@idProductos, 0, PATINDEX('%,%',@idProductos))
        SET @IndividualImp = SUBSTRING(@importancia, 0, PATINDEX('%,%',@importancia))
        
--        SELECT @individual
--        SELECT @IndividualImp

        SET @idProductos = SUBSTRING(@idProductos, LEN(@individual + ',') + 1,
                                                     LEN(@idProductos))
        SET @importancia = SUBSTRING(@importancia, LEN(@IndividualImp + ',') + 1,
                                                     LEN(@importancia))                                             
                                                     
   
        INSERT INTO ##tempPresupuesto (idProducto,importancia, idSupermercado1 ,Supermercado1, idSupermercado2,Supermercado2, idSupermercado3,Supermercado3, idSupermercado4 ,Supermercado4, idSupermercado5,Supermercado5) VALUES (@individual,convert(int,@IndividualImp),CONVERT(INT,SUBSTRING(@supermercados,1,1)),dbo.obtenerPrecio(@individual,CONVERT(INT,SUBSTRING(@supermercados,1,1))),CONVERT(INT,SUBSTRING(@supermercados,3,1)),dbo.obtenerPrecio(@individual,CONVERT(INT,SUBSTRING(@supermercados,3,1))),CONVERT(INT,SUBSTRING(@supermercados,5,1)),dbo.obtenerPrecio(@individual,CONVERT(INT,SUBSTRING(@supermercados,5,1))), CONVERT(INT,SUBSTRING(@supermercados,7,1)) ,dbo.obtenerPrecio(@individual,CONVERT(INT,SUBSTRING(@supermercados,7,1))), CONVERT(INT,SUBSTRING(@supermercados,9,1)) ,dbo.obtenerPrecio(@individual,CONVERT(INT,SUBSTRING(@supermercados,9,1))))
   
    END
    ELSE
    BEGIN
        SET @individual = @idProductos
        SET @IndividualImp = @importancia
        
        SET @idProductos = NULL
        SET @importancia = NULL
     
       INSERT INTO ##tempPresupuesto (idProducto,importancia, idSupermercado1 ,Supermercado1, idSupermercado2,Supermercado2, idSupermercado3,Supermercado3, idSupermercado4 ,Supermercado4, idSupermercado5,Supermercado5) VALUES (@individual,convert(int,@IndividualImp),CONVERT(INT,SUBSTRING(@supermercados,1,1)),dbo.obtenerPrecio(@individual,CONVERT(INT,SUBSTRING(@supermercados,1,1))),CONVERT(INT,SUBSTRING(@supermercados,3,1)),dbo.obtenerPrecio(@individual,CONVERT(INT,SUBSTRING(@supermercados,3,1))),CONVERT(INT,SUBSTRING(@supermercados,5,1)),dbo.obtenerPrecio(@individual,CONVERT(INT,SUBSTRING(@supermercados,5,1))), CONVERT(INT,SUBSTRING(@supermercados,7,1)) ,dbo.obtenerPrecio(@individual,CONVERT(INT,SUBSTRING(@supermercados,7,1))), CONVERT(INT,SUBSTRING(@supermercados,9,1)) ,dbo.obtenerPrecio(@individual,CONVERT(INT,SUBSTRING(@supermercados,9,1))))
    END
    
END

IF(@option = 1)
BEGIN
	SELECT *  FROM ##tempPresupuesto t	ORDER BY importancia
	SELECT idSupermercado1,SUM(Supermercado1) CostoTotal1 ,idSupermercado2,SUM(Supermercado2) CostoTotal2,idSupermercado3, SUM(Supermercado3) CostoTotal3,idSupermercado4, SUM(Supermercado4) CostoTotal4 ,idSupermercado5 ,SUM(Supermercado5) CostoTotal5  FROM ##tempPresupuesto t group by idSupermercado1,idSupermercado2,idSupermercado3,idSupermercado4,idSupermercado5 
	SELECT (Nombre +' - '+ Marca + '  ' + Cantidad) 'Nombre',[idProducto],[Descripcion],[Cantidad],[Marca],[Categoria],[Foto],[Visitado] FROM Producto WHERE idProducto in (SELECT idProducto FROM ##tempPresupuesto)
	SELECT * FROM Supermercado WHERE idSupermercado IN (SELECT idSupermercado FROM ##tempPresupuesto)
END

END



GO


