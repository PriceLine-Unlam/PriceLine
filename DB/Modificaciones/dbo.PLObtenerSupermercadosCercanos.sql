USE [priceline]
GO
/****** Object:  StoredProcedure [dbo].[PLObtenerSupermercadosCercanos]    Script Date: 10/09/2014 19:46:30 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO

-- =============================================
-- Author:		<Author,,Name>
-- Create date: <Create Date,,>
-- Description:	<Description,,>
-- =============================================
ALTER PROCEDURE [dbo].[PLObtenerSupermercadosCercanos] 
	@USERID varchar(100),
	@LATITUD decimal(18,14) = 0,
    @LONGITUD decimal(18,14) = 0
AS
BEGIN

	IF(@LATITUD = 0)
	BEGIN
		SET @LATITUD =  (SELECT top 1 Latitud FROM Supermercado WHERE (ABS(CAST(  (BINARY_CHECKSUM(*) *  RAND()) as int)) % 100) <70)
		SET @LONGITUD = (SELECT top 1 Longitud FROM Supermercado WHERE (ABS(CAST(  (BINARY_CHECKSUM(*) *  RAND()) as int)) % 100) <70)
	END
	
	DECLARE @PUNTO_REFERENCIA GEOGRAPHY = GEOGRAPHY::Point(@LATITUD,@LONGITUD, 4326)
	
	SELECT TOP 5 S.idSupermercado,S.Nombre
	, S.Direccion+' '+CAST(S.Numero AS VARCHAR) Direccion
	, P.Nombre+' - '+L.Nombre AS 'Provincia'
	, S.Horario
	, S.Longitud
	, S.Latitud  
	FROM Supermercado S
	INNER JOIN Provincia P ON
	S.Provincia = P.ID
	INNER JOIN Departamento L ON
	S.Localidad = L.ID
	WHERE  @PUNTO_REFERENCIA.STDistance(GEOGRAPHY::Point(Latitud, Longitud, 4326)) > 1000
	
END

