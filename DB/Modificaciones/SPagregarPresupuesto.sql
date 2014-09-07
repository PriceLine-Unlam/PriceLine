USE [priceline]
GO

/****** Object:  StoredProcedure [dbo].[SPagregarPresupuestos]    Script Date: 09/01/2014 21:10:58 ******/
IF  EXISTS (SELECT * FROM sys.objects WHERE object_id = OBJECT_ID(N'[dbo].[SPagregarPresupuestos]') AND type in (N'P', N'PC'))
DROP PROCEDURE [dbo].[SPagregarPresupuestos]
GO

USE [priceline]
GO

/****** Object:  StoredProcedure [dbo].[SPagregarPresupuestos]    Script Date: 09/01/2014 21:10:58 ******/
SET ANSI_NULLS ON
GO

SET QUOTED_IDENTIFIER ON
GO


-- =============================================
-- Author:		<Author,,Name>
-- Create date: <Create Date,,>
-- Description:	<Description,,>
-- =============================================
CREATE PROCEDURE [dbo].[SPagregarPresupuestos] 
	@usuario varchar(100),
	@Productos varchar(max),
	@Importancia varchar(max),
	@nombreLista varchar(max)
AS
BEGIN
	-- SET NOCOUNT ON added to prevent extra result sets from
	-- interfering with SELECT statements.
	SET NOCOUNT ON;

DECLARE @idProducto VARCHAR(MAX) = ''
DECLARE @impProducto VARCHAR(MAX) = ''
DECLARE @id int

	INSERT INTO Lista VALUES (@nombreLista , @usuario)
	SET @id = (SELECT MAX(idLista) FROM Lista WHERE usuario = @usuario)
		
	INSERT INTO Lista_log VALUES (@id,@idProducto,@usuario,@usuario,GETDATE(),'A')
	

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
        INSERT INTO Producto_Lista_log VALUES (@id,@idProducto,1,@impProducto,@usuario,GETDATE(),'A')                                             
	END
    ELSE
    BEGIN
		SET @idProducto = SUBSTRING(@Productos, 0, PATINDEX('%|%',@Productos))
		SET @Productos = NULL
		
		SET @impProducto = SUBSTRING(@Importancia, 0, PATINDEX('%|%',@Importancia))
        SET @Importancia = NULL  
		
		INSERT INTO Producto_Lista VALUES (@id,@idProducto,1,@impProducto)
        INSERT INTO Producto_Lista_log VALUES (@id,@idProducto,1,@impProducto,@usuario,GETDATE(),'A')   
	END
END
	
END


GO


