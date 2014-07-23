USE [priceline]
GO

/****** Object:  Table [dbo].[Usuarios_log]    Script Date: 07/23/2014 21:00:38 ******/
IF  EXISTS (SELECT * FROM sys.objects WHERE object_id = OBJECT_ID(N'[dbo].[Usuarios_log]') AND type in (N'U'))
DROP TABLE [dbo].[Usuarios_log]
GO

USE [priceline]
GO

/****** Object:  Table [dbo].[Usuarios_log]    Script Date: 07/23/2014 21:00:38 ******/
SET ANSI_NULLS ON
GO

SET QUOTED_IDENTIFIER ON
GO

SET ANSI_PADDING ON
GO

CREATE TABLE [dbo].[Usuarios_log](
	[usuario] [varchar](100) NULL,
	[Nombre] [varchar](50) NULL,
	[Apellido] [varchar](50) NULL,
	[Latitud] [numeric](10, 6) NULL,
	[Longitud] [numeric](10, 6) NULL,
	[Direccion] [varchar](100) NULL,
	[Nro] [varchar](10) NULL,
	[Localidad] [varchar](100) NULL,
	[Provincia] [varchar](100) NULL,
	[Email] [varchar](100) NULL,
	[Password] [varchar](50) NULL,
	[usuario_log] [varchar](100) NULL,
	[fecha_log] [date] NULL,
	[operacion_log] [varchar](1) NULL
) ON [PRIMARY]

GO

SET ANSI_PADDING OFF
GO


