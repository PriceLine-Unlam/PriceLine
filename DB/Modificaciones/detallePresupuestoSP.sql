USE [priceline]
GO

/****** Object:  StoredProcedure [dbo].[detallePresupuestoSP]    Script Date: 09/06/2014 15:15:48 ******/
IF  EXISTS (SELECT * FROM sys.objects WHERE object_id = OBJECT_ID(N'[dbo].[detallePresupuestoSP]') AND type in (N'P', N'PC'))
DROP PROCEDURE [dbo].[detallePresupuestoSP]
GO

USE [priceline]
GO

/****** Object:  StoredProcedure [dbo].[detallePresupuestoSP]    Script Date: 09/06/2014 15:15:48 ******/
SET ANSI_NULLS ON
GO

SET QUOTED_IDENTIFIER ON
GO

-- =============================================
-- Author:		<Author,,Name>
-- Create date: <Create Date,,>
-- Description:	<Description,,>
-- =============================================
CREATE PROCEDURE [dbo].[detallePresupuestoSP] 
	@idLista INT,
	@usuario VARCHAR(100)
AS
BEGIN
	-- SET NOCOUNT ON added to prevent extra result sets from
	-- interfering with SELECT statements.
	SET NOCOUNT ON;
	
	SELECT L.idLista,L.Titulo,P.idProducto,P.Descripcion+ ' '+P.Cantidad 'Nombre', PL.importancia FROM Lista L INNER JOIN Producto_Lista PL ON L.idLista=PL.idLista INNER JOIN Producto P ON PL.idProducto = P.idProducto 
	WHERE L.idLista = @idLista AND L.usuario = @usuario
	
END

GO


