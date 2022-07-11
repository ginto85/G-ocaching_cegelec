<article class="updateGeocache">
    <h3>Modifier cette géocache</h3>
    <div >
        <p>Pour actualiser votre position</p>
        <button class="currentPosition">Cliquer ici</button>
    </div>

    <div class="updateGeoCache-form">
        <form enctype="multipart/form-data" name="numPost" action="index.php?p=update&numGeocache=<?= htmlspecialchars($geocacheData['id']) ?>" method="post">
            <div>
                <input type="hidden" name='geocacheId' value="<?= htmlspecialchars($geocacheData['id']) ?> " required>
            </div>
            <div class="geoCacheNameForm">
                <label for="geoCacheName">Nom de la géocache</label>
                <input type="text" id="geoCacheName" name="geoCacheName"  value="<?= htmlspecialchars($geocacheData['name']) ?> " placeholder="Ex: Indice_4"  >
            </div> 
                <div class="latForm">
                    <label for="lat">Latitude :</label>
                    <input type="text" id="lat" name="lat"
                    value="<?= htmlspecialchars($geocacheData['lat']) ?>  " required>
                </div>
                <div class="lngForm">
                    <label for="lng">Longitude :</label>
                    <input type="text" id="lng" name="lng"
                    value="<?= htmlspecialchars($geocacheData['lng']) ?> " required>
                </div>
                <div class="teamAssignForm">
                    <p><img src="./assets/img/high-voltage-sign-min.png" alt="logo hight voltage sign">
                    Affecter la géocache à 1 ou 2 équipe(s)</p>
                    <select name="teamAssignment" id="teamAssignment"  >
                        <option value="A"
                        <?php if( htmlspecialchars($geocacheData['team_assignment'])== 'A')
                            {echo("selected");} ?> >
                                Equipe A</option>
                        <option value="B" 
                        <?php if( htmlspecialchars($geocacheData['team_assignment'])== 'B')
                            {echo("selected");} ?>>
                                Equipe B</option>
                        <option value="AB" 
                        <?php if( htmlspecialchars($geocacheData['team_assignment'])== 'AB')
                            {echo("selected");} ?>>
                                Equipe A et B</option>
                    </select>
                </div>
                <div class="themeForm">
                    <select name="theme" id="theme">
                        <option value="optim"  
                            <?php if( htmlspecialchars($geocacheData['theme'])== 'optim')
                                {echo("selected");} ?>>
                                    optimisation des ressources
                        </option>
                        <option value="climat"  
                            <?php if( htmlspecialchars($geocacheData['theme'])== 'climat')
                                {echo("selected");} ?>>
                                    Agir pour le climat
                        </option>
                        <option value="naturals_areas"
                            <?php if( htmlspecialchars($geocacheData['theme'])== 'naturals_areas')
                                {echo("selected");} ?>>
                                    Préserver les milieux naturels
                        </option>
                    </select>
                </div>
                <div class="allResponseForm">
                    <p><img src="./assets/img/high-voltage-sign-min.png" alt="logo hight voltage sign">
                        Attention 1 seule réponse doit être correct.</p>
                    <div>
                        <label for="resp1">Réponse 1</label>
                        <input type="text" id="resp1" name="resp1"
                        value="<?= htmlspecialchars($geocacheData['resp1']) ?>" placeholder="chiffre ou texte">
                    </div>
                    <div>
                        <label for="resp2">Réponse 2</label>
                        <input type="text" id="resp2" name="resp2" 
                        value="<?= htmlspecialchars($geocacheData['resp2']) ?>" placeholder="chiffre ou texte">
                    </div>
                    <div>
                        <label for="resp3">Réponse 3</label>
                        <input type="text" id="resp3" name="resp3"
                        value="<?= htmlspecialchars($geocacheData['resp3']) ?>" placeholder="chiffre ou texte">
                    </div>
                    <div>
                        <p>Quel est la bonne réponse?</p>
                        <div>
                            <input type="radio" id="case1" name="group" value="resp1"
                                <?php if( htmlspecialchars($geocacheData['good_resp'])== 'resp1'){echo("checked");} ?> >
                            <label for="case1">Réponse 1</label>
                        </div>
                        <div>
                            <input type="radio" id="case2" name="group" value="resp2"
                                <?php if( htmlspecialchars($geocacheData['good_resp'])== 'resp2'){echo("checked");} ?>>
                            <label for="case2">Réponse 2</label>
                        </div>
                        <div>
                            <input type="radio" id="case3" name="group" value="resp3"
                                <?php if( htmlspecialchars($geocacheData['good_resp'])== 'resp3'){echo("checked");} ?>>
                            <label for="case3">Réponse 3</label>
                        </div>
                    </div>
                </div>
                <button type="submit">Modifier la géo-cache</button>
        </form>
    </div>
</article>
