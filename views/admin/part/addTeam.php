<article class="addTeam">
    <!-- form to add a new team -->
    <h2 class="section-title">Ajouter une équipe</h2>
    <div class="addTeam-form">
        <form enctype="multipart/form-data" action="index.php?p=admin" method="post">
            <div>
                <label for="teamName">Nom de l'équipe</label>
                <input type="text" class="form-control" id="teamName" name="teamName" placeholder="Ex: team R.A." required >
            </div>
            <div>
                <label for="password">Mot de passe</label>
                <input type="password" class="form-control" id="password" name="password" required ></input>
            </div>   
            <div>
                <label for="password2">Répéter le mot de passe</label>
                <input type="password" class="form-control" id="password2" name="password2" required ></input>
            </div>
            <div>
                <select name="teamAssignment" id="teamAssignment">
                    <option value="">Choisir équipe A ou B</option>
                    <option value="A">Equipe A</option>
                    <option value="B">Equipe B</option>
                </select>
            </div>  
            <div>
                <button type="submit" id="form-submit" class="details main-button">Ajouter l'équipe</button>
            </div>
        </form>
    </div>
</article>