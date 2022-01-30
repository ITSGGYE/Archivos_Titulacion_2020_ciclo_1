<aside class="main-sidebar">

	 <section class="sidebar">

		<ul class="sidebar-menu">

		<?php

		if($_SESSION["perfil"] == "Administrador"|| $_SESSION["perfil"] == "Jefe de bodega" || $_SESSION["perfil"] == "Secretaria"){

			echo '<li class="active">

				<a href="inicio">

					<i class="fa fa-home"></i>
					<span>Inicio</span>

				</a>

			</li>';
		}

		if($_SESSION["perfil"] == "Administrador"){

			echo '<li class="active">

				<a href="ayuda">

					<i class="glyphicon glyphicon-exclamation-sign"></i>
					<span>ayuda</span>

				</a>

			</li>';

		}

		if($_SESSION["perfil"] == "Secretaria"){

			echo '<li class="active">

				<a href="Ayuda1">

					<i class="glyphicon glyphicon-exclamation-sign"></i>
					<span>ayuda</span>

				</a>

			</li>';

		}

		if($_SESSION["perfil"] == "Jefe de bodega"){

			echo '<li class="active">

				<a href="Ayuda2">

					<i class="glyphicon glyphicon-exclamation-sign"></i>
					<span>ayuda</span>

				</a>

			</li>';

		}


        if($_SESSION["perfil"] == "Administrador"){

			echo '<li class="active">

				<a href="usuarios">

					<i class="fa fa-user"></i>
					<span>Usuarios</span>

				</a>

			</li>';

		}

		

		if($_SESSION["perfil"] == "Administrador" || $_SESSION["perfil"] == "Jefe de bodega"){

			echo '<li>

				<a href="categorias">

					<i class="glyphicon glyphicon-tasks"></i>
					<span>Categorías</span>

				</a>

			</li>

			<li>

				<a href="productos">

					<i class="glyphicon glyphicon-gift"></i>
					<span>Productos</span>

				</a>

			</li>';

		}

		if($_SESSION["perfil"] == "Administrador" || $_SESSION["perfil"] == "Secretaria"){

			echo '<li>

				<a href="iglesias">
				
				<i class="glyphicon glyphicon-home"></i>
                <span>Iglesias</span>

				</a>

			</li>';

		}

		if($_SESSION["perfil"] == "Administrador" || $_SESSION["perfil"] == "Secretaria"){

			echo '<li class="treeview">

				<a href="#">

				    <i class="glyphicon glyphicon-list"></i>
					
					<span>Pedidos</span>
					
					<span class="pull-right-container">
					
						<i class="fa fa-angle-left pull-right"></i>

					</span>

				</a>

				<ul class="treeview-menu">
					
					<li>

						<a href="pedidos">
							
							<i class="fa fa-circle-o"></i>
							<span>Administrar pedidos</span>

						</a>

					</li>

					<li>

						<a href="crear-pedido">
							
							<i class="fa fa-circle-o"></i>
							<span>Crear pedido</span>

						</a>

					</li>';

					if($_SESSION["perfil"] == "Administrador"){

					echo '<li>

						<a href="reportes">
							
							<i class="fa fa-circle-o"></i>
							<span>Reporte de pedidos</span>

						</a>

					</li>';

					}

				

				echo '</ul>

			</li>';

		}

		?>

		</ul>

	 </section>

</aside>