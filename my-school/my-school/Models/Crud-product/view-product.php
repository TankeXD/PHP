<?php
    include("../../layouts/config.php");
    $con = connection();

    $sql = "SELECT * FROM marcas";
    $query = mysqli_query($con, $sql);
    ?>

<select name="rol" class="form-select mb-3" aria-label=".form-select-lg example" style="width: 300px; margin-left: 10px;">
    <option selected>Seleccionar</option>
    <?php while ($row = mysqli_fetch_array($query)) : ?>
    <option ><?= $row['nombre_cat'] ?></option>
    <?php endwhile; ?>
</select>

