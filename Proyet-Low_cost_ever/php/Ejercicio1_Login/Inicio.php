<!-- Para crear un sistema simple de autenticación y autorización usando PHP, MySQL y CSS, podemos implementar las siguientes tres páginas:

**Página 1 - Autenticación (Login Page)**
Esta página solicita una contraseña y verifica si es correcta. Si la contraseña es correcta, muestra un enlace a la segunda página; de lo contrario, muestra un mensaje de acceso denegado.
```html -->

<!-- login.php -->
<!DOCTYPE html>
<html lang="es">
<head>
    <title>Inicio.php</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
    <h1>Página de incio.</h1>
    <form action="Inicio.php" method="post">
        <label for="password">Contraseña:</label>
        <input type="password" name="password" id="password" required>
        <input type="submit" value="Ingresar">
    </form>

    <?php
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $password = $_POST['password'];
        // Contraseña correcta (en un entorno real, se debe guardar como hash y verificar con hash)
        $correct_password = "12345"; 

        if ($password === $correct_password) {
            echo '<p>Contraseña correcta. <a href="resultado-login.php">Ir a roles</a></p>';
        } else {
            echo '<p>Acceso denegado.</p>';
        }
    }
    ?>
</body>
</html>




<!-- ```

**Página 2 - Autorización Basada en Roles**
Esta página verifica el rol del usuario. Dependiendo del rol, muestra un enlace a la tercera página con un mensaje de autorización apropiado.

```html
 page2.php -->
<!-- <!DOCTYPE html>
<html lang="es">
<head>
    <title>Roles</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
    <h1>Verificación de Roles</h1>
    <form action="page2.php" method="post">
        <label for="role">Rol:</label>
        <input type="text" name="role" id="role" required>
        <input type="submit" value="Comprobar">
    </form>



    php
    // if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    //     $role = $_POST['role'];

    //     if ($role === "administrador") {
    //         echo '<p>Bienvenido, administrador. <a href="page3.php">Ir a Página 3</a></p>';
    //     } elseif ($role === "usuario") {
    //         echo '<p>Bienvenido, usuario. <a href="page3.php">Ir a Página 3</a></p>';
    //     } else {
    //         echo '<p>Acceso denegado.</p>';
    //     }
    // }
    /
cierre php

</body>
</html>
```

**Página 3 - Página de Destino**
Esta página simplemente muestra que se ha llegado al destino final, en función de la autorización anterior.

```html -->
<!-- page3.php -->
<!-- <!DOCTYPE html>
<html lang="es">
<head>
    <title>Página 3</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
    <h1>¡Has llegado a la Página 3!</h1>
    <p>Esta es la página final del sistema.</p>
</body>
</html>
```  -->


<!-- Estas páginas proporcionan un ejemplo básico de autenticación y autorización utilizando PHP. Asegúrate de tener un servidor PHP y MySQL configurado para ejecutarlas, y recuerda siempre aplicar medidas de seguridad al trabajar con contraseñas y roles. -->