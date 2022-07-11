<h2 class='AdminTitle'>Bonjour 
    <?php echo $_SESSION['user']['teamName']; ?>
</h2>	
<article class="admin">
    <div class="admin__ajax">
        <div>
            <h3>Equipes</h3>
            <button type="button" class="details" data-filter='addTeam'>Ajouter une équipe</button>
            <button type="button" class="details" data-filter='teamList'>Voir la liste des équipes</button>
        </div>
        <div>
            <h3>Géocaches</h3>
            <button type="button" class="details" data-filter='addGeoCache'>Ajouter une  géocache</button>
            <button type="button" class="details" data-filter='geoCacheList'>Voir la liste des géocaches</button>
            <button type="button" class="details" data-filter='removeGeocache'>Modifier une géocache</button>
        </div>
    </div>
    <div class='choiceAdmin myresult'></div>
    <?php if (!empty($messages['errors'])) { ?>
        <ul>
            <?php foreach ($messages['errors'] as $error): ?>
                <li><?= $error ?></li>
            <?php endforeach; ?>
        </ul>
    <?php } ?>
    <?php if (!empty($messages['success'])): ?>
        <?php foreach ($messages['success'] as $success): ?>
            <p><?= $success ?></p>
        <?php endforeach; ?>
    <?php endif; ?>
</article>