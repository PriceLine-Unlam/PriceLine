USE [priceline]
GO

/****** Object:  StoredProcedure [dbo].[PLInsertarNuevoProductoASupermercado]    Script Date: 10/13/2014 23:03:44 ******/
IF  EXISTS (SELECT * FROM sys.objects WHERE object_id = OBJECT_ID(N'[dbo].[PLInsertarNuevoProductoASupermercado]') AND type in (N'P', N'PC'))
DROP PROCEDURE [dbo].[PLInsertarNuevoProductoASupermercado]
GO

USE [priceline]
GO

/****** Object:  StoredProcedure [dbo].[PLInsertarNuevoProductoASupermercado]    Script Date: 10/13/2014 23:03:44 ******/
SET ANSI_NULLS ON
GO

SET QUOTED_IDENTIFIER ON
GO


CREATE PROCEDURE [dbo].[PLInsertarNuevoProductoASupermercado] 
	 @IDPRODUCTO INT
	,@IDSUPERMERCADO INT
	,@VALOR NUMERIC(18,2)
	,@USERID VARCHAR(1000)
AS
BEGIN
	
	IF NOT EXISTS ( SELECT 1 FROM priceline..Precio WHERE idProducto = @IDPRODUCTO AND idSupermercado = @IDSUPERMERCADO )
		BEGIN
		
			INSERT INTO [priceline].[dbo].[Precio]
			   ([idProducto]
			   ,[idSupermercado]
			   ,[Valor]
			   ,[Validez])
			VALUES
			   (@IDPRODUCTO
			   ,@IDSUPERMERCADO
			   ,@VALOR
			   ,0)
	           
			INSERT INTO [priceline].[dbo].[Precio_log]
			   ([idProducto]
			   ,[idSupermercado]
			   ,[Valor]
			   ,[Validez]
			   ,[usuario_log]
			   ,[fecha_log]
			   ,[operacion_log])
			VALUES
			   (@IDPRODUCTO
			   ,@IDSUPERMERCADO
			   ,@VALOR
			   ,0
			   ,@USERID
			   ,GETDATE()
			   ,'A')	
		
		END
	ELSE
		BEGIN
		
			UPDATE priceline..Precio SET Valor = @VALOR 
			WHERE idProducto = @IDPRODUCTO AND idSupermercado = @IDSUPERMERCADO
			
			INSERT INTO [priceline].[dbo].[Precio_log]
			   ([idProducto]
			   ,[idSupermercado]
			   ,[Valor]
			   ,[Validez]
			   ,[usuario_log]
			   ,[fecha_log]
			   ,[operacion_log])
			VALUES
			   (@IDPRODUCTO
			   ,@IDSUPERMERCADO
			   ,@VALOR
			   ,0
			   ,@USERID
			   ,GETDATE()
			   ,'M')
		
		END
	
END

GO


