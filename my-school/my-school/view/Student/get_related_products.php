<?php
include("../../layouts/config.php");
$con = connection();

$product_description = $_GET['product_description'];
$id_product_select = $_GET['productid'];
$id_list = $_GET['idList'];
$id_alumno = $_GET['idAlumno'];
$nombre_colegio = $_GET['nombreColegio'];
$id_curso = $_GET['idCurso'];

// Obtener la primera palabra de la descripción del producto
$first_word = explode(' ', trim($product_description))[0];

// Preparar la consulta SQL
$sql_related = "SELECT id_producto, nombre_prod, ruta_img, precio_prod 
                FROM producto 
                WHERE descripcion_prod LIKE ?";
$stmt = $con->prepare($sql_related);
$search_term = "{$first_word}%";
$stmt->bind_param("s", $search_term);

// Ejecutar la consulta
$stmt->execute();
$result = $stmt->get_result();

while ($row = $result->fetch_assoc()) {
    $id_producto = $row['id_producto'];
    $nombre_prod = $row['nombre_prod'];
    $ruta_img = $row['ruta_img'];
    $precio_prod = $row['precio_prod'];

    echo <<<HTML
    
    <div class="col-md-4">
        <div class="card mb-4">
            <img class="card-img-top" src="$ruta_img" alt="Product image">
            <div class="card-body">
                <h5 class="card-title">$nombre_prod</h5>
                <p class="card-text">Precio Unitario: $$precio_prod</p>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="new_product_radio" value="$id_producto" onchange="updateNewProduct('$id_producto')">
                    <label class="form-check-label">Seleccionar</label>
                </div>
            </div>
        </div>
    </div>
HTML;
}

// Cerrar la declaración
$stmt->close();
