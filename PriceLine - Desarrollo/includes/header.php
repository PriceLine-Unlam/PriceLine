<?php session_start(); ?>
<header id="header">
								
									<!-- Logo -->
										<div class="3u">
											<h1><a href="#" class="image image-full"><img class="position-image" src="images/logo.png" alt="" /></a></h1>
											<span></span>
										</div>
									
									<!-- Nav -->
										<nav id="nav">
											<ul>
												<li><a href="index.php">Home</a></li>
												<li><a href="Supermercado.php">Supermercado</a></li>
												<li><a href="Presupuesto.php">Presupuesto</a></li>
												<li><a href="BuscadorProducto.php">Productos</a></li>
                                                                                                <?php if(!isset($_SESSION['usuario_nombre'])){ ?>
                                                                                                    <li class="current_page_item"><a href="Login.php">Login</a></li>
                                                                                                <?php }else{?>
                                                                                                    <li class="current_page_item"><a href="Login.php"><?php echo $_SESSION['usuario_nombre'];?></a></li>
                                                                                                    <li class="current_page_salir" title="salir" ><a href="index.php?login=loginout">[Salir]</a></li>
                                                                                                <?php }?>    
											</ul>
										</nav>
								
</header>