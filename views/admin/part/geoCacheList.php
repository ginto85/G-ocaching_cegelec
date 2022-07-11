
<article class="geocacheList">
     <!-- display geocache list -->
     <div>
        <h3>liste des géo-caches</h3>

        <table>
            <thead>
                <tr>
                    <th>Nom de la cache</th>
                    <th>Equipe "A" ou "B"</th>
                    <th>Thème</th>
                    <th>Réponse correcte</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($geoCaches as $geoCache): ?>
                <tr>
                    <td  id="<?= htmlspecialchars($geoCache['id'])  ?>"><?= htmlspecialchars($geoCache['name']) ?></td>
                    <td><?= htmlspecialchars($geoCache['team_assignment']) ?></td>
                    <td><?= htmlspecialchars($geoCache['theme']) ?></td>
                    <td><?= htmlspecialchars($geoCache['good_resp']) ?></td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>


    </div>
</article>
<!-- end Title article addGeocache -->