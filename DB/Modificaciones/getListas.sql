USE [priceline]
GO

/****** Object:  StoredProcedure [dbo].[getListas]    Script Date: 08/13/2014 20:43:43 ******/
IF  EXISTS (SELECT * FROM sys.objects WHERE object_id = OBJECT_ID(N'[dbo].[getListas]') AND type in (N'P', N'PC'))
DROP PROCEDURE [dbo].[getListas]
GO

USE [priceline]
GO

/****** Object:  StoredProcedure [dbo].[getListas]    Script Date: 08/13/2014 20:43:43 ******/
SET ANSI_NULLS ON
GO

SET QUOTED_IDENTIFIER ON
GO

-- =============================================
-- Author:		<Author,,Name>
-- Create date: <Create Date,,>
-- Description:	<Description,,>
-- =============================================
CREATE PROCEDURE [dbo].[getListas] 
	-- Add the parameters for the stored procedure here
	@userid varchar(100)
AS
BEGIN
	-- SET NOCOUNT ON added to prevent extra result sets from
	-- interfering with SELECT statements.
	SET NOCOUNT ON;
	
	DECLARE @listas VARCHAR(MAX) = ''
	SELECT @listas += CONVERT(VARCHAR,idLista) +'|' FROM Lista WHERE usuario=@userid
	
	SELECT SUBSTRING (@listas,0,LEN(@listas)) lista
END

GO


