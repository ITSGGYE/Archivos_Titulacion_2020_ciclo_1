   <meta charset="utf-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1">
   <!-- Main CSS-->
   <link rel="stylesheet" type="text/css" href="../css/main.css">
   <link href="../view/css/style.css" rel="stylesheet" type="text/css"/>
   <!-- Font-icon css-->
   <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
   <!--CONFIGURACIÓN DE FECHA -->
   <?php include "../view/layouts/functions.php" ?>
   <!-- FECHA -->
 </head>
 <body class="app sidebar-mini">
  <!-- Navbar-->
  <header class="app-header"><a class="app-header__logo" href="#">Farmacia Alejandra</a>
    <!-- Sidebar toggle button--><a class="app-sidebar__toggle" href="#" data-toggle="sidebar" aria-label="Hide Sidebar"></a>
    <!-- Navbar Right Menu-->
    <ul class="app-nav">
      <li class="app-search" style="color: white;">
        <h4>Guayaquil, <?php echo fechaC(); ?></h4>
      </li>
      <!-- User Menu-->
      <li class="dropdown"><a class="app-nav__item" href="#" data-toggle="dropdown" aria-label="Open Profile Menu"><i class="fa fa-user fa-lg"></i></a>
        <ul class="dropdown-menu settings-menu dropdown-menu-right">
          <li><a class="dropdown-item" href="../view/configuracion.php"><i class="fa fa-cog fa-lg"></i> Configuración</a></li>
          <li><a class="dropdown-item" href="../salir.php"><i class="fa fa-sign-out fa-lg"></i> Logout</a></li>
        </ul>
      </li>
    </ul>
  </header>
  <!-- Sidebar menu-->
  <div class="app-sidebar__overlay" data-toggle="sidebar"></div>
  <aside class="app-sidebar">
    <div class="app-sidebar__user"><img class="app-sidebar__user-avatar" src="../view/img/logo.png" alt="User Image">
      <div>
        <p class="app-sidebar__user-name">usuario:</p>
        <p class="app-sidebar__user-designation"><?php echo $_SESSION['user']; ?></p>
      </div>
    </div>
    <ul class="app-menu">
      <li><a class="app-menu__item" href="../view/dashboard.php"><i class="app-menu__icon fa fa-home"></i><span class="app-menu__label">INICIO</span></a></li>

      <li class="treeview"><a class="app-menu__item" href="#" data-toggle="treeview"><i class="app-menu__icon fa fa-list-alt"></i><span class="app-menu__label"> PROVEEDOR</span><i class="treeview-indicator fa fa-angle-right"></i></a>
        <ul class="treeview-menu">
         <?php 
         if($_SESSION['rol'] == 1){
           ?>
           <li><a class="treeview-item" href="../view/proveedor.php"><i class="icon fa fa-circle-o"></i>Nuevo Proveedor</a></li>
         <?php } ?>
         <li><a class="treeview-item" href="../view/listaProveedor.php"><i class="icon fa fa-circle-o"></i>Lista de Proveedores</a></li>
       </ul>
     </li>


     <li class="treeview"><a class="app-menu__item" href="#" data-toggle="treeview"><i class="fa fa-cubes" aria-hidden="true"></i><span class="app-menu__label"> PRODUCTOS</span><i class="treeview-indicator fa fa-angle-right"></i></a>
      <ul class="treeview-menu">
        <?php 
        if($_SESSION['rol'] == 1){
         ?>
         <li><a class="treeview-item" href="../view/productos.php"><i class="icon fa fa-circle-o"></i>Nuevo Producto</a></li>

       <?php } ?>

       <li><a class="treeview-item" href="../view/listaProducto.php"><i class="icon fa fa-circle-o"></i>Lista de Productos</a></li>
     </ul>
   </li>

   <?php 
   if($_SESSION['rol'] == 1){
     ?>

     <li class="treeview"><a class="app-menu__item" href="#" data-toggle="treeview"><i class="app-menu__icon fa fa-user"></i><span class="app-menu__label">USUARIOS</span><i class="treeview-indicator fa fa-angle-right"></i></a>
      <ul class="treeview-menu">
        <li><a class="treeview-item" href="../view/usuario.php"><i class="icon fa fa-circle-o"></i>Nuevo Usuario</a></li>
        <li><a class="treeview-item" href="../view/listaUsuario.php"><i class="icon fa fa-circle-o"></i>Lista de Usuarios</a></li>
      </ul>
    </li>

  <?php } ?>

  <li class="treeview"><a class="app-menu__item" href="#" data-toggle="treeview"><i class="app-menu__icon fa fa-users"></i><span class="app-menu__label">CLIENTES</span><i class="treeview-indicator fa fa-angle-right"></i></a>
    <ul class="treeview-menu">
      <li><a class="treeview-item" href="../view/cliente.php"><i class="icon fa fa-circle-o"></i>Nuevo Cliente</a></li>
      <li><a class="treeview-item" href="../view/listaCliente.php"><i class="icon fa fa-circle-o"></i>Lista de Clientes</a></li>
    </ul>
  </li>

  <li class="treeview"><a class="app-menu__item" href="#" data-toggle="treeview"><i class="app-menu__icon  fa fa-shopping-cart"></i><span class="app-menu__label">VENTAS</span><i class="treeview-indicator fa fa-angle-right"></i></a>
    <ul class="treeview-menu">
      <li><a class="treeview-item" href="../view/nuevaVenta.php"><i class="icon fa fa-circle-o"></i>Nueva Venta</a></li>
      <li><a class="treeview-item" href="../view/ventas.php"><i class="icon fa fa-circle-o"></i>Detalle de Ventas</a></li>
    </ul>
  </li>

</ul>
</aside>