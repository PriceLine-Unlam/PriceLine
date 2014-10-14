USE [priceline]
GO

/****** Object:  StoredProcedure [dbo].[PLObtenerDatosSupermercado]    Script Date: 10/13/2014 15:14:41 ******/
IF  EXISTS (SELECT * FROM sys.objects WHERE object_id = OBJECT_ID(N'[dbo].[PLObtenerDatosSupermercado]') AND type in (N'P', N'PC'))
DROP PROCEDURE [dbo].[PLObtenerDatosSupermercado]
GO

USE [priceline]
GO

/****** Object:  StoredProcedure [dbo].[PLObtenerDatosSupermercado]    Script Date: 10/13/2014 15:14:41 ******/
SET ANSI_NULLS ON
GO

SET QUOTED_IDENTIFIER ON
GO


-- =============================================
-- Author:		<Author,,Name>
-- Create date: <Create Date,,>
-- Description:	<Description,,>
-- =============================================
CREATE PROCEDURE [dbo].[PLObtenerDatosSupermercado] 
	@IDSUPERMERCADO VARCHAR(MAX)
AS
BEGIN

	DECLARE @NOMBRE_SUPERMERCADO VARCHAR(MAX)
	
	SELECT @NOMBRE_SUPERMERCADO = NOMBRE FROM SUPERMERCADO WHERE IDSUPERMERCADO = @IDSUPERMERCADO
	
	SELECT @NOMBRE_SUPERMERCADO Nombre_Supermercado
	
END


GO


