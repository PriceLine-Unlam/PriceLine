USE [priceline]
GO

/****** Object:  StoredProcedure [dbo].[validarPrecio]    Script Date: 10/04/2014 19:38:13 ******/
IF  EXISTS (SELECT * FROM sys.objects WHERE object_id = OBJECT_ID(N'[dbo].[validarPrecio]') AND type in (N'P', N'PC'))
DROP PROCEDURE [dbo].[validarPrecio]
GO

USE [priceline]
GO

/****** Object:  StoredProcedure [dbo].[validarPrecio]    Script Date: 10/04/2014 19:38:13 ******/
SET ANSI_NULLS ON
GO

SET QUOTED_IDENTIFIER ON
GO

-- =============================================
-- Author:		<Author,,Name>
-- Create date: <Create Date,,>
-- Description:	<Description,,>
-- =============================================
CREATE PROCEDURE validarPrecio
   -- Add the parameters for the stored procedure here
   @IDPRODUCTO INT,
   @IDSUPERMERCADO INT,
   @USUARIO VARCHAR(100)
AS
BEGIN
   -- SET NOCOUNT ON added to prevent extra result sets from
   -- interfering with SELECT statements.
   SET NOCOUNT ON;

  -- Insert statements for procedure here
    IF(SELECT 1 FROM Precio_log WHERE usuario_log = @USUARIO AND idProducto = @IDPRODUCTO AND idSupermercado = @IDSUPERMERCADO and operacion_log  = 'V' )  = 1
    BEGIN

                 SELECT 0  'resultado'  
      END    
      ELSE
      BEGIN
      UPDATE Precio SET Validez +=1 WHERE idProducto = @IDPRODUCTO AND idSupermercado = @IDSUPERMERCADO
  
   INSERT INTO [Precio_log]
           ([idProducto]
           ,[idSupermercado]
           ,[Valor]
           ,[Validez]
           ,[usuario_log]
           ,[fecha_log]
           ,[operacion_log])
     SELECT
           @IDPRODUCTO
           ,@IDSUPERMERCADO
           ,Valor
           ,Validez
           ,@USUARIO
           ,CONVERT(DATE,GETDATE())
           ,'V'
           FROM Precio WHERE idProducto = @IDPRODUCTO AND idSupermercado = @IDSUPERMERCADO
          
           SELECT 1 'resultado'
      END
END