<?php

$item = null;
$valor = null;
$orden = "id";

$pedidos = ControladorPedidos::ctrSumaTotalPedidos();

$categorias = ControladorCategorias::ctrMostrarCategorias($item, $valor);
$totalCategorias = count($categorias);

$iglesias = ControladorIglesias::ctrMostrarIglesias($item, $valor);
$totalIglesias = count($iglesias);

$productos = ControladorProductos::ctrMostrarProductos($item, $valor, $orden);
$totalProductos = count($productos);

?>



<div class="col-lg-3 col-xs-6">

  <div class="small-box bg-red">
    
    <div class="inner">
      
      <h3>$<?php echo number_format($pedidos["total"],2); ?></h3>

      <p>Pedidos</p>
    
    </div>
    
    <div class="icon">
      
      <i class="ion ion-clipboard"></i>
    
    </div>
 
  </div>

</div>

<div class="col-lg-3 col-xs-6">

  <div class="small-box bg-yellow">
    
    <div class="inner">
    
      <h3><?php echo number_format($totalCategorias); ?></h3>

      <p>Categorías</p>
    
    </div>
    
    <div class="icon">
      
      <i class="ion-ios-bookmarks"></i>
    
    </div>

  </div>

</div>

<div class="col-lg-3 col-xs-6">

  <div class="small-box bg-blue">
    
    <div class="inner">
    
      <h3><?php echo number_format($totalIglesias); ?></h3>

      <p>Iglesias</p>
  
    </div>
    
    <div class="icon">
    
      <i class="ion-ios-home-outline"></i>
    
    </div>

  </div>

</div>

<div class="col-lg-3 col-xs-6">

  <div class="small-box bg-purple">
  
    <div class="inner">
    
      <h3><?php echo number_format($totalProductos); ?></h3>

      <p>Productos</p>
    
    </div>
    
    <div class="icon">
      
      <i class="ion-ios-pricetags"></i>
    
    </div>
  
  </div>

</div>