<article class= "update">
    <h3>Modifier ce produit</h3>
    
<div class='updateGeocache'>
    <table>
        <thead>
            <tr>
                <th>Géocaches</th>
                <th class="suppr">Suppr.</th>
                <th class="modif">Modifier</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($geoCaches as $geocache) :?>
            <tr>
                <td><?= htmlspecialchars($geocache['name']) ?></td>
                <td><a href="index.php?p=deletee&numGeocache=<?= htmlspecialchars($geocache['id']) ?>"><i class="fas fa-trash-alt" ></i></a></td>
                <td><a href="index.php?p=update&numGeocache=<?= htmlspecialchars($geocache['id']) ?>"> modifier</a></td>
            
            </tr>
            <?php endforeach ?>
        </tbody>
    </table>
    
</div>

</article>