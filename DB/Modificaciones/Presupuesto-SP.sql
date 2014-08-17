USE [priceline]
GO
/****** Object:  StoredProcedure [dbo].[Presupuesto]    Script Date: 08/13/2014 20:28:48 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO

-- =============================================
-- Author:		<Author,,Name>
-- Create date: <Create Date,,>
-- Description:	<Description,,>
-- =============================================
ALTER PROCEDURE [dbo].[Presupuesto] 
	-- Add the parameters for the stored procedure here
--	@idProductos varchar(MAX), 
--	@importancia varchar(MAX)
	@username varchar(100),
	@idLista int,
	@latitude decimal(18,14),
    @longtitude decimal(18,14),
    @option int  = 1
AS
BEGIN
			
SET NOCOUNT ON;
-- @idProductos 1,1,1

DECLARE @individual varchar(20),
		@IndividualImp varchar(20),
		@idProductos varchar(max) = '',
		@importancia varchar(max) = '',
		@supermercados varchar(max) = ''



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
        
       -- SELECT @individual
       -- SELECT @IndividualImp --es el ultimo
        
       -- INSERT INTO ##tempPresupuesto (idProducto,importancia,Supermercado1,Supermercado2,Supermercado3,Supermercado4,Supermercado5) VALUES (@individual,convert(int,@IndividualImp),(select Valor from Precio where idProducto= @individual and idSupermercado = 1),(select Valor from Precio where idProducto= @individual and idSupermercado = 2),(select Valor from Precio where idProducto= @individual and idSupermercado = 3))
       INSERT INTO ##tempPresupuesto (idProducto,importancia, idSupermercado1 ,Supermercado1, idSupermercado2,Supermercado2, idSupermercado3,Supermercado3, idSupermercado4 ,Supermercado4, idSupermercado5,Supermercado5) VALUES (@individual,convert(int,@IndividualImp),CONVERT(INT,SUBSTRING(@supermercados,1,1)),dbo.obtenerPrecio(@individual,CONVERT(INT,SUBSTRING(@supermercados,1,1))),CONVERT(INT,SUBSTRING(@supermercados,3,1)),dbo.obtenerPrecio(@individual,CONVERT(INT,SUBSTRING(@supermercados,3,1))),CONVERT(INT,SUBSTRING(@supermercados,5,1)),dbo.obtenerPrecio(@individual,CONVERT(INT,SUBSTRING(@supermercados,5,1))), CONVERT(INT,SUBSTRING(@supermercados,7,1)) ,dbo.obtenerPrecio(@individual,CONVERT(INT,SUBSTRING(@supermercados,7,1))), CONVERT(INT,SUBSTRING(@supermercados,9,1)) ,dbo.obtenerPrecio(@individual,CONVERT(INT,SUBSTRING(@supermercados,9,1))))
    END
    
END

IF(@option = 1)
BEGIN
	SELECT * FROM ##tempPresupuesto	ORDER BY importancia
END
END

