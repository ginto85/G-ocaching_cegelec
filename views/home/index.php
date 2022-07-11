<article class="presentation">

    <?php if (!empty($_SESSION['user'])) { ?>
        <p>Bienvenue <?= $_SESSION['user']['teamName'] ?> vous êtes maintenant près.</p>
    <?php } ?>
    <h1>Géocaching - Cegelec Ancenis</h1>
    <ul class='rules'>
        <li>
            <h2>Connectez vous avec vos identifiant.</h2>
            <a href="index.php?p=login" >
                <img class="imagesRules" src="assets/img/register.png" alt="">
            </a>
        </li>
        <li>
            <h2>Cherchez les géocaches.</h2>
            <a href="index.php?p=map" >
                <img class="imagesRules" src="assets/img/map.png" alt="portable et géolocalisation">
            </a>
        </li>
        <li>
            <h2>Répondez aux questions.</h2>
            <img class="imagesRules" src="assets/img/checklist.png" alt="Répondre aux questionnaire">
        </li>
    </ul>
</article>
<!-- article description start -->
<article class="descriptionGame">
    <h2>Mise en place du jeu</h2> 
    <p>Avant de commencer, assurez-vous d'avoir activer les <strong>données mobiles</strong> <img src="assets/img/4g.png" alt="Logo données mobiles">
        et la <strong>géolocation</strong> <img src="assets/img/placeholder.png" alt="Logo géolocation">.</p>
    <?php if(empty($_SESSION['user'])): ?>
    <p>Connectez-vous avec l'<strong>identifiant</strong> et le <strong>mot de passe</strong> que l'organisateur vous à données,
        afin de pouvoir accéder à la <a href="index.php?p=map" >carte</a>.</p>
    <?php  else: ?>
    <h2>Description du jeu</h2>
    <ol>
        <li>Rechercher les géocaches grâce la carte.</li>
        <li>Pour chaque géocache, vous devrez trouver le thème de la question et la réponse bien sûr.<br/>
        Cliquez <a href="index.php?p=themes">&#x27EA; ici &#x27EB;</a> pour voir Les thèmes.</li>
        <li>Vous avez 45 minutes pour trouver toutes les géocaches.</li>
        <li>
            <img src="./assets/img/high-voltage-sign-min.png" alt="logo attention">
            Vous ne pouvez répondre q'une fois par question. Choisissez bien le thème et la réponse.</br> Puis valider.
        </li>
    </ol>
    <?php endif; ?>
    <div class="bee">
        <img src="./assets/img/visuel2.png" alt="Abeille et rûche">
    </div>
</article>
<!-- article description end -->