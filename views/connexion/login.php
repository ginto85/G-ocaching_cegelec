<article class='connect'>
    
    <h2>Connectez-vous</h2>
    <p class="select">Si vous n'avez pas de compte, raprochez-vous de l'organisateur de l'évènement.</p>
    <p class="mandatory">Champs avec <abbr title="(required)" aria-hidden="true">*</abbr>  obligatoires.</p>
    
    <?php if (!empty($messages['errors'])) { ?>
        <ul>
        <?php foreach ($messages['errors'] as $error): ?>    
            <li><?= $error ?></li>
        <?php endforeach; ?>    
        </ul>
    <?php } ?>
    <form action="index.php?p=login" method="post" class="connect-form">
    	<div>
    		<fieldset>
    			<legend>Login</legend>
    			<label for="teamName"><abbr title="(required)" aria-hidden="true">* </abbr>Nom de votre équipe</label>
    			<input type="text" id="teamName" name="teamName" value="<?php if (
           array_key_exists('teamName', $_COOKIE)
       ) {
           echo $_COOKIE['teamName'];
       } ?>"placeholder="ex: equipe rouge" required>
    			<label for="password"><abbr title="(required)" aria-hidden="true">* </abbr>Mot de passe</label>
    			<input type="password" id="password" name="password" value ="<?php if (
           array_key_exists('password', $_COOKIE)
       ) {
           echo $_COOKIE['password'];
       } ?>" required>
    			<div>
    			    <label for="remember"> Se souvenir de moi </label>	
    	            <input type="checkbox" value="true" id="remember" name="remember" checked>
    			</div>
    
    		</fieldset>
    	</div>
    	<div class="connectSubmit">
            <button type="submit" class="button" >Connexion</button>
        </div>
    </form>
    
</article>
