<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="Content-Type" content="text/html" />
        <!--responsive-->
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no"">
        <!--title-->
        <title>Géocaching - CEGELEC Ancenis</title>
        <!--description-->
        <meta name="description" content="#" />
        <!-- leaflet map -->
        <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css"
              integrity="sha512-xodZBNTC5n17Xt2atTPuE1HxjVMSvLVW9ocqUKLsCC5CXdbqCmblAshOMAS6/keqq/sMZMZ19scR4PsZChSR7A=="
              crossorigin=""/>
        <!--font awesome-->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" 
              integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" 
              crossorigin="anonymous" referrerpolicy="no-referrer" />
        <!-- CSS only -->
        <link rel="stylesheet" href="assets/css/normalize.css" type="text/css" />
        <link rel="stylesheet" href="assets/css/style.css">
        <!-- favicon -->
        <link rel="shortcut icon" type="image/png" href="assets/img/Cegelec-Ancenis.png">
    </head>
    
    <!---body-->
    <body>
    <!-- Header -->
        <header>
        <div class="bc-image"></div>
        <nav>
                <ul>
                  <li><a href="index.php?p=home">Accueil</a></li>
                  <?php if (empty($_SESSION['user'])): ?>
                    <li>
                      <a href="index.php?p=login" <?= $https::active(
                          'login'
                      ) ?>>Connexion</a>
                    </li>
                  <?php else: ?>
                    <li>
                      <a href="index.php?p=logout">Déconnexion</a>
                    </li>
                    <li>
                      <a href="index.php?p=themes">Thèmes</a>
                    </li>
                    <li>
                      <a href="index.php?p=map">Carte</a>
                    </li>
                  <?php endif; ?>
                  <?php if (!empty($_SESSION['user']['type'])): ?>
                    <li>
                      <a href="index.php?p=admin" <?= $https::active(
                          'admin'
                      ) ?>>Administrateur</a>
                    </li>
                  <?php endif; ?>
                </ul>
              </nav>

    
<!--Header ends-->
        </header>
        <!--main-->
        <main>
             <!--SECTION DESCRIPTION-->
          <section class='container'>
              
            <?php require 'views/' . $path; ?>
            
          </section>
        </main>

        <!--footer-->
        <footer>
            
        </footer>
        <!-- Leaflet JS -->
        <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"
                integrity="sha512-XQoYMqMTK8LvdxXYG3nZ448hOEQiglfqkJs1NOQV44cWnUrBc8PkAOcXy20w0vlaXaVUearIOBhiXZ5V3ynxwA=="
                crossorigin="" defer ></script>
                <!-- JS -->
        <script type="module" src="assets/js/main.js" defer></script>
    </body>
</html>

