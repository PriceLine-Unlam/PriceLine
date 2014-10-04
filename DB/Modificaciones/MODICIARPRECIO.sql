USE [priceline]
GO

/****** Object:  StoredProcedure [dbo].[modificarPrecio]    Script Date: 10/02/2014 19:45:07 ******/
IF  EXISTS (SELECT * FROM sys.objects WHERE object_id = OBJECT_ID(N'[dbo].[modificarPrecio]') AND type in (N'P', N'PC'))
DROP PROCEDURE [dbo].[modificarPrecio]
GO

USE [priceline]
GO

/****** Object:  StoredProcedure [dbo].[modificarPrecio]    Script Date: 10/02/2014 19:45:07 ******/
SET ANSI_NULLS ON
GO

SET QUOTED_IDENTIFIER ON
GO

-- =============================================
-- Author:		<Author,,Name>
-- Create date: <Create Date,,>
-- Description:	<Description,,>
-- =============================================
CREATE PROCEDURE [dbo].[modificarPrecio]
	-- Add the parameters for the stored procedure here
	@VALOR NUMERIC(18,2),
	@IDPRODUCTO INT,
	@IDSUPERMERCADO INT,
	@USUARIO VARCHAR(100)
AS
BEGIN
	-- SET NOCOUNT ON added to prevent extra result sets from
	-- interfering with SELECT statements.
	SET NOCOUNT ON;

	IF (SELECT 1 FROM Precio WHERE idProducto = @IDPRODUCTO AND idSupermercado = @IDSUPERMERCADO) = 1
	BEGIN
		DELETE FROM Precio WHERE idProducto = @IDPRODUCTO AND idSupermercado = @IDSUPERMERCADO 
	END
	INSERT INTO [Precio]
           ([idProducto]
           ,[idSupermercado]
           ,[Valor]
           ,[Validez])
     VALUES
           (@IDPRODUCTO
           ,@IDSUPERMERCADO
           ,@VALOR
           ,0)
	
	
	INSERT INTO [Precio_log]
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
           ,@USUARIO
           ,CONVERT(DATE,GETDATE())
           ,'M')
	
END

GO


