<article class="addGeocache">
   <!-- start Title article addGeocache -->
    <h2>Ajouter une géo-cache</h2>
    <div >
        <p>Pour actualiser votre position</p>
        <button class="currentPosition">Cliquer ici</button>
    </div>
   
    <div class="addGeoCache-form">
        <!-- form to add a new GeoCache -->
        <form enctype="multipart/form-data" action="index.php?p=admin" method="post">
            <div class="geoCacheNameForm">
                <label for="geoCacheName">Numéro de la géocache</label>
                <input type="text" id="geoCacheName" name="geoCacheName" placeholder="Ex: Indice_4"  >
            </div> 
            <div class="latForm">
                <label for="lat">Latitude :</label>
                <input type="text" id="lat" name="lat">
            </div>
            <div class="lngForm">
                <label for="lng">Longitude :</label>
                <input type="text" id="lng" name="lng">
            </div>
            <div class="teamAssignForm">
                <p><img src="./assets/img/high-voltage-sign-min.png" alt="logo hight voltage sign">
                Affecter la géocache à 1 ou 2 équipe(s)</p>
                <select name="teamAssignment" id="teamAssignment">
                    <option> A et/ou B</option>
                    <option value="A">Equipe A</option>
                    <option value="B">Equipe B</option>
                    <option value="AB">Equipe A et B</option>
                 </select>
            </div>
            <div class="themeForm">
                <select name="theme" id="theme">
                    <option>Choisir un thème pour la géocache</option>
                    <option value="optim">optimisation des ressources</option>
                    <option value="climat">Agir pour le climat</option>
                    <option value="naturals_areas">Préserver les milieux naturels</option>
                </select>
            </div>
            <div class="allResponseForm">
                <p><img src="./assets/img/high-voltage-sign-min.png" alt="logo hight voltage sign">
                    Attention 1 seule réponse doit être correct.</p>
                <div>
                    <label for="resp1">Réponse 1</label>
                    <input type="text" id="resp1" name="resp1" placeholder="chiffre ou texte">
                </div>
                <div>
                    <label for="resp2">Réponse 2</label>
                    <input type="text" id="resp2" name="resp2" placeholder="chiffre ou texte">
                </div>
                <div>
                    <label for="resp3">Réponse 3</label>
                    <input type="text" id="resp3" name="resp3" placeholder="chiffre ou texte">
                </div>
                <div>
                    <p>Quel est la bonne réponse?</p>
                    <div>
                        <input type="radio" id="case1" name="group" value="resp1" checked >
                        <label for="case1">Réponse 1</label>
                    </div>
                    <div>
                        <input type="radio" id="case2" name="group" value="resp2">
                        <label for="case2">Réponse 2</label>
                    </div>
                    <div>
                        <input type="radio" id="case3" name="group" value="resp3">
                        <label for="case3">Réponse 3</label>
                    </div>
                </div>
            </div>
            <button type="submit">ajouter la géo-cache</button>
        </form>
    </div>
</article>