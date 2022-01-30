<?php 
if(empty($_SESSION['active']))
{
    header('location: ../');
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta name="description" content="Vali is a responsive and free admin theme built with Bootstrap 4, SASS and PUG.js. It's fully customizable and modular.">
    <!-- Twitter meta-->
    <meta property="twitter:card" content="summary_large_image">
    <meta property="twitter:site" content="@pratikborsadiya">
    <meta property="twitter:creator" content="@pratikborsadiya">
    <!-- Open Graph Meta-->
    <meta property="og:type" content="website">
    <meta property="og:site_name" content="Vali Admin">
    <meta property="og:title" content="Vali - Free Bootstrap 4 admin theme">
    <meta property="og:url" content="http://pratikborsadiya.in/blog/vali-admin">
    <meta property="og:image" content="http://pratikborsadiya.in/blog/vali-admin/hero-social.png">
    <meta property="og:description" content="Vali is a responsive and free admin theme built with Bootstrap 4, SASS and PUG.js. It's fully customizable and modular.">

    <!-- Font-icon css--> 
    <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <!-- MODAL AGREGAR STOCK -->
    <link href="../view/css/style.css" rel="stylesheet" type="text/css"/>
        <div class="modal">
        <div class="bodyModal">
           <!-- <form action="" method="post" name="form_add_product" id="form_add_product" onsubmit="event.preventDefault(); sendDataProduct(); ">
            <h4><i class="fa fa-cubes" style="font-size: 45pt;"></i><br> Agregar Producto</h4>
            <h2 class="nameProducto">'+info.descripcion+'</h2>
            <input type="number" name="cantidad" id="txtCantidad" placeholder="Cantidad del producto" required><br>
            <input type="text" name="precio" id="txtPrecio" placeholder="Pecio del producto" required>
            <input type="hidden" name="producto_id" id="producto_id" value="'+info.codproducto+'" required>
            <input type="hidden" name="action" value="addProduct" required>
            <div class="alert alertAddProduct"></div>
            <button type="submit" class="btn_new"><i class="fa fa-plus-circle" aria-hidden="true"></i> Agregar</button>
            <a href="#" class="btn_ok closeModal"  onclick="closeModal();" ><i class="fa fa-ban" aria-hidden="true"></i> Cerrar</a>
        </form> -->
    </div>
</div>