USE [priceline]
GO

/****** Object:  Table [dbo].[Usuarios]    Script Date: 07/24/2014 21:22:28 ******/
IF  EXISTS (SELECT * FROM sys.objects WHERE object_id = OBJECT_ID(N'[dbo].[Usuarios]') AND type in (N'U'))
DROP TABLE [dbo].[Usuarios]
GO

USE [priceline]
GO

/****** Object:  Table [dbo].[Usuarios]    Script Date: 07/24/2014 21:22:29 ******/
SET ANSI_NULLS ON
GO

SET QUOTED_IDENTIFIER ON
GO

SET ANSI_PADDING ON
GO

CREATE TABLE [dbo].[Usuarios](
	[Usuario] [varchar](100) NOT NULL,
	[Nombre] [varchar](50) NULL,
	[Apellido] [varchar](50) NULL,
	[Latitud] [numeric](10, 6) NULL,
	[Longitud] [numeric](10, 6) NULL,
	[Direccion] [varchar](100) NULL,
	[Nro] [varchar](10) NULL,
	[Localidad] [int] NULL,
	[Provincia] [int] NULL,
	[Email] [varchar](100) NULL,
	[Password] [varchar](50) NULL,
 CONSTRAINT [PK_Usuarios] PRIMARY KEY CLUSTERED 
(
	[Usuario] ASC
)WITH (PAD_INDEX  = OFF, STATISTICS_NORECOMPUTE  = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS  = ON, ALLOW_PAGE_LOCKS  = ON) ON [PRIMARY]
) ON [PRIMARY]

GO

SET ANSI_PADDING OFF
GO


