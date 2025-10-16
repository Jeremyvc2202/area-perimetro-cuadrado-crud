<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <meta name="robots" content="index,follow">
  <meta name="description">
  <meta name="author">
  <meta name="keywords">
  <title>Hola Mundo MVC</title>
  <link rel="icon" href="<?= BASE_URL ? rtrim(BASE_URL,characters: '/'): ''?>/imagenes/logo1.ico">
  <link rel="stylesheet" href="<?= BASE_URL ? rtrim(BASE_URL,'/') : '' ?>/assets/css/styles.css">
</head>
<body>
  <header class="container">
    <h1>
      <a href="<?= BASE_URL ? rtrim(BASE_URL,'/') : '' ?>/">✔️CRUD CUADRADO✔️</a>
    </h1>
    <nav>
      <a href="<?= BASE_URL ? rtrim(BASE_URL,'/') : '' ?>/mensajes">listar cuadrados</a>
      <a class="btn" href="<?= BASE_URL ? rtrim(BASE_URL,'/') : '' ?>/mensajes/create">Nuevo</a>
    </nav>
  </header>
  <main class="container">
    <?php include $viewFile; ?>
  </main>
  <footer class="container footer">
    <small>Hecho con ❤️ en PHP • MVC • PDO • Laragon</small>
  </footer>
  <script src="<?= BASE_URL ? rtrim(BASE_URL,'/') : '' ?>/assets/js/app.js"></script>
</body>
</html>
