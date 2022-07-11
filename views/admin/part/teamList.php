
<!-- TeamList -->
<article class="teamList">
    
    <h3>liste des équipes</h3>
    <div>
        <table>
            <thead>
                <tr>
                    <th>Nom de l'équipe</th>
                    <th>Equipe</br> "A" ou "B"</th>
                    <th>Points</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($users as $user): ?>
                <tr>
                    <td><?= htmlspecialchars($user['teamName']) ?></td>
                    <td><?= htmlspecialchars($user['team_assignment']) ?></td>
                    <td><?= htmlspecialchars($user['points']) ?></td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</article>
