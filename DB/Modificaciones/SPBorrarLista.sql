USE [priceline]
GO

/****** Object:  StoredProcedure [dbo].[SPBorrarLista]    Script Date: 08/24/2014 20:18:24 ******/
IF  EXISTS (SELECT * FROM sys.objects WHERE object_id = OBJECT_ID(N'[dbo].[SPBorrarLista]') AND type in (N'P', N'PC'))
DROP PROCEDURE [dbo].[SPBorrarLista]
GO

USE [priceline]
GO

/****** Object:  StoredProcedure [dbo].[SPBorrarLista]    Script Date: 08/24/2014 20:18:24 ******/
SET ANSI_NULLS ON
GO

SET QUOTED_IDENTIFIER ON
GO


-- =============================================
-- Author:		<Author,,Name>
-- Create date: <Create Date,,>
-- Description:	<Description,,>
-- =============================================
CREATE PROCEDURE [dbo].[SPBorrarLista]
	@id int
AS
BEGIN
	
	SET NOCOUNT ON;
	
	INSERT INTO Lista_log
	SELECT idLista
      ,Titulo
      ,usuario
      ,usuario
      ,GETDATE()
      ,'B'
      FROM  Lista WHERE idLista = @id

	INSERT INTO Producto_Lista_log
	SELECT
	[idLista]
      ,[idProducto]
      ,[cantidad]
      ,(SELECT usuario FROM Lista WHERE idLista = @id)
      ,GETDATE()
      ,'B'
     FROM Producto_Lista WHERE idLista = @id

    DELETE FROM Producto_Lista WHERE idLista = @id
    DELETE FROM Lista WHERE idLista = @id
    
    
    
END


GO


