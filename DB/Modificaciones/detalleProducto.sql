USE [priceline]
GO

/****** Object:  StoredProcedure [dbo].[detalleProducto]    Script Date: 09/13/2014 16:39:39 ******/
IF  EXISTS (SELECT * FROM sys.objects WHERE object_id = OBJECT_ID(N'[dbo].[detalleProducto]') AND type in (N'P', N'PC'))
DROP PROCEDURE [dbo].[detalleProducto]
GO

USE [priceline]
GO

/****** Object:  StoredProcedure [dbo].[detalleProducto]    Script Date: 09/13/2014 16:39:39 ******/
SET ANSI_NULLS ON
GO

SET QUOTED_IDENTIFIER ON
GO


-- =============================================
-- Author:		<Author,,Name>
-- Create date: <Create Date,,>
-- Description:	<Description,,>
-- =============================================
CREATE PROCEDURE [dbo].[detalleProducto]
	@idProducto INT,
	@Longitud NUMERIC(10,6),
	@LATITUD NUMERIC(10,6)
	
AS
BEGIN
	-- SET NOCOUNT ON added to prevent extra result sets from
	-- interfering with SELECT statements.
	SET NOCOUNT ON;
	
	IF @Longitud = 0 
	BEGIN
		SET @LATITUD = (SELECT top 1 Latitud FROM priceline..Supermercado WHERE (ABS(CAST(  (BINARY_CHECKSUM(*) *  RAND()) as int)) % 100) <70)
		SET @Longitud = (SELECT top 1 Longitud FROM priceline..Supermercado WHERE (ABS(CAST(  (BINARY_CHECKSUM(*) *  RAND()) as int)) % 100) <70)
	END

	
	declare @p1 geography = geography::Point(@LATITUD,@Longitud, 4326);
	
	SELECT P.[idProducto] producto
      ,P.[Nombre]
      ,P.[Descripcion]
      ,P.[Cantidad]
      ,P.[Marca]
      ,P.[Categoria]
      ,P.[Foto]
      ,P.[Visitado]
      ,PR.[idProducto]
      ,PR.[idSupermercado]
      ,PR.[Valor]
      ,PR.[Validez]
      ,S.[idSupermercado]
      ,S.[Nombre] nombre_supermercado
      ,S.[Direccion]
      ,S.[Longitud]
      ,S.[Latitud]
      ,S.[Horario]
      ,S.[Borrado]
       FROM Producto P LEFT JOIN Precio PR ON P.idProducto = PR.idProducto
	LEFT JOIN Supermercado S ON PR.idSupermercado = S.idSupermercado WHERE P.idProducto = @idProducto
	AND  @p1.STDistance(geography::Point(@LATITUD,@Longitud, 4326)) <= 1000 
	ORDER BY PR.Valor desc
END


GO


