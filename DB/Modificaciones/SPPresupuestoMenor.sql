USE [priceline]
GO

/****** Object:  StoredProcedure [dbo].[SPPresupuestoMenor]    Script Date: 08/31/2014 16:18:58 ******/
IF  EXISTS (SELECT * FROM sys.objects WHERE object_id = OBJECT_ID(N'[dbo].[SPPresupuestoMenor]') AND type in (N'P', N'PC'))
DROP PROCEDURE [dbo].[SPPresupuestoMenor]
GO

USE [priceline]
GO

/****** Object:  StoredProcedure [dbo].[SPPresupuestoMenor]    Script Date: 08/31/2014 16:18:58 ******/
SET ANSI_NULLS ON
GO

SET QUOTED_IDENTIFIER ON
GO


-- =============================================
-- Author:		<Author,,Name>
-- Create date: <Create Date,,>
-- Description:	<Description,,>
-- =============================================
CREATE PROCEDURE [dbo].[SPPresupuestoMenor] 
	@username varchar(100),
	@idLista int,
	@latitude decimal(18,14) = 0,
    @longtitude decimal(18,14) = 0
AS
BEGIN
	-- SET NOCOUNT ON added to prevent extra result sets from
	-- interfering with SELECT statements.
	SET NOCOUNT ON;
END

DECLARE @idSupermercado int, @costo numeric(18,2)

IF(@latitude = 0)
BEGIN
	SET @latitude =  (SELECT top 1 Latitud FROM priceline..Supermercado WHERE (ABS(CAST(  (BINARY_CHECKSUM(*) *  RAND()) as int)) % 100) <70)
	SET @longtitude = (SELECT top 1 Longitud FROM priceline..Supermercado WHERE (ABS(CAST(  (BINARY_CHECKSUM(*) *  RAND()) as int)) % 100) <70)
END

		 --EXEC dbo.Presupuesto 'gimenez166@hotmail.com',1,-34.522128,148.120969
		 EXEC dbo.Presupuesto @username, @idLista, @latitude,@longtitude,2
				 
		 SET @costo = (SELECT SUM(supermercado1) S1 FROM ##tempPresupuesto)
		 SET @idSupermercado = (SELECT TOP 1 idsupermercado1 FROM ##tempPresupuesto)
		 
		 
		 IF( @costo > (SELECT SUM(supermercado2) S2 FROM ##tempPresupuesto) AND (SELECT SUM(supermercado2) S2 FROM ##tempPresupuesto)!= 0.00)
		 BEGIN
			SET @costo = (SELECT SUM(supermercado2) S2 FROM ##tempPresupuesto)
			SET @idSupermercado = (SELECT TOP 1 idsupermercado2 FROM ##tempPresupuesto)
		 END
		 IF( @costo > (SELECT SUM(supermercado3) S3 FROM ##tempPresupuesto) AND (SELECT SUM(supermercado3) S3 FROM ##tempPresupuesto)!= 0.00)
		 BEGIN
			SET @costo = (SELECT SUM(supermercado3) S3 FROM ##tempPresupuesto )
			SET @idSupermercado = (SELECT TOP 1 idsupermercado3 FROM ##tempPresupuesto)
		 END
		 IF( @costo > (SELECT SUM(supermercado4) S4 FROM ##tempPresupuesto) AND (SELECT SUM(supermercado4) S4 FROM ##tempPresupuesto)!= 0.00)
		 BEGIN
			SET @costo = (SELECT SUM(supermercado4) S4 FROM ##tempPresupuesto)
			SET @idSupermercado = (SELECT TOP 1 idsupermercado4 FROM ##tempPresupuesto)
		 END
		 IF( @costo > (SELECT SUM(supermercado5) S5 FROM ##tempPresupuesto) AND (SELECT SUM(supermercado5) S5 FROM ##tempPresupuesto)!= 0.00)
		 BEGIN
			SET @costo = (SELECT SUM(supermercado5) S5 FROM ##tempPresupuesto)
			SET @idSupermercado = (SELECT TOP 1 idsupermercado5 FROM ##tempPresupuesto)
		 END
		 
		 
		 SELECT @idLista idLista,(SELECT l.Titulo FROM Lista l WHERE idLista = @idLista) TituloLista,@costo COSTO, * FROM Supermercado WHERE idSupermercado = @idSupermercado 
		-- SELECT @costo,@idSupermercado


GO


