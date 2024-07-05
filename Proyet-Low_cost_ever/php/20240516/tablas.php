<?php include 'xabecera.php'  ?>

<div class="row">
    <div class="col-12">
        <table>
            <thead>Aqui van los títulos de las columnas
                <tr><th>Nombre</th><th>Telefono</th><th>email</th>
</thead>
<tbody>  
    <?php foreach $resultado as $dato:?>
    <tr><td>Manolo Gonzalez</td><td>6000000</td><td>manolo@nail.com</td></tr>
    <tr><td>Ana Pérez</td><td>6000000</td><td>ana@nail.com</td></tr>
    <tr><td>Nadia Martínez</td><td>6000000</td><td>nadia@nail.com</td></tr>
    <?php endforeach ?>
</tbody>
</table>
</div>
</div>
</div>