USE [priceline]
GO

/****** Object:  StoredProcedure [dbo].[modificarPresupuesto]    Script Date: 09/06/2014 16:06:24 ******/
IF  EXISTS (SELECT * FROM sys.objects WHERE object_id = OBJECT_ID(N'[dbo].[modificarPresupuesto]') AND type in (N'P', N'PC'))
DROP PROCEDURE [dbo].[modificarPresupuesto]
GO

USE [priceline]
GO

/****** Object:  StoredProcedure [dbo].[modificarPresupuesto]    Script Date: 09/06/2014 16:06:24 ******/
SET ANSI_NULLS ON
GO

SET QUOTED_IDENTIFIER ON
GO

-- =============================================
-- Author:		<Author,,Name>
-- Create date: <Create Date,,>
-- Description:	<Description,,>
-- =============================================
CREATE PROCEDURE [dbo].[modificarPresupuesto]
	@usuario varchar(100),
	@Productos varchar(max),
	@Importancia varchar(max),
	@nombreLista varchar(max),
	@id int
AS
BEGIN
	-- SET NOCOUNT ON added to prevent extra result sets from
	-- interfering with SELECT statements.
	SET NOCOUNT ON;
	
	DECLARE @idProducto VARCHAR(MAX) = ''
	DECLARE @impProducto VARCHAR(MAX) = ''

	DELETE FROM Producto_Lista WHERE idLista = @id


WHILE LEN(@Productos) > 0
BEGIN
	IF PATINDEX('%|%',@Productos) > 0
    BEGIN
		
		SET @idProducto = SUBSTRING(@Productos, 0, PATINDEX('%|%',@Productos))
		SET @Productos = SUBSTRING(@Productos, LEN(@idProducto + '|') + 1,
                                                     LEN(@Productos))
        SET @impProducto = SUBSTRING(@Importancia, 0, PATINDEX('%|%',@Importancia))
        SET @Importancia = SUBSTRING(@Importancia, LEN(@impProducto + '|') + 1,
                                                     LEN(@Importancia))                                             
                                                     
        INSERT INTO Producto_Lista VALUES (@id,@idProducto,1,@impProducto)
        INSERT INTO Producto_Lista_log VALUES (@id,@idProducto,1,@impProducto,@usuario,GETDATE(),'B')                                             
	END
    ELSE
    BEGIN
		SET @idProducto = SUBSTRING(@Productos, 0, PATINDEX('%|%',@Productos))
		SET @Productos = NULL
		
		SET @impProducto = SUBSTRING(@Importancia, 0, PATINDEX('%|%',@Importancia))
        SET @Importancia = NULL  
		
		INSERT INTO Producto_Lista VALUES (@id,@idProducto,1,@impProducto)
        INSERT INTO Producto_Lista_log VALUES (@id,@idProducto,1,@impProducto,@usuario,GETDATE(),'B')   
	END	
	
END
END



