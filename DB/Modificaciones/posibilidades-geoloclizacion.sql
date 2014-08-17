execute dbo.Presupuesto '2,1,22','3,3,1'



SELECT idSupermercado, nombre, ( 6371 * ACOS(
COS( RADIANS(-34.6401977) )
* COS(RADIANS( Latitud ) )
* COS(RADIANS( Longitud )
- RADIANS(-58.6869723) )
+ SIN( RADIANS(-34.6401977) )
* SIN(RADIANS( Latitud ) )
)
) AS d
FROM Supermercado
group by Latitud , Longitud ,idSupermercado, nombre
HAVING ( 6371 * ACOS(
COS( RADIANS(-34.6401977) )
* COS(RADIANS( Latitud ) )
* COS(RADIANS( Longitud )
- RADIANS(-58.6869723) )
+ SIN( RADIANS(-34.6401977) )
* SIN(RADIANS( Latitud ) )
)
) < 1 /* 1 KM a la redonda */
ORDER BY d ASC

