<?php include 'cabecera.php' ?>

<div class="container-fluid mt-5">
    <div class="row">
        <div class="col-12">
            <table class="table">
                <thead>
                    <tr><th>Nombre</th><th>Telefono</th><th>email</th></tr>
                </thead>
                <tbody> 
                        <?php foreach $resultado as $dato:?>
                    <tr><td><?php $dato['nombre'] ?></td><td><?php $dato['telefono'] ?></td><td><?php $dato['email'] ?></td></tr>
                    <tr><td>Ana Perez</td><td>6000000</td><td>ana@mail.com</td></tr>
                    <tr><td>Nadia Martinez</td><td>6000000</td><td>nadia@mail.com</td></tr>
                        <?php endforeach ?>
                </tbody>
            </table>

        </div>
    </div>
</div>
















<?php include 'piepagina.php' ?>