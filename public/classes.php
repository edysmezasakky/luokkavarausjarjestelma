<?php

define('__ROOT__' , dirname(dirname(__FILE__)));

require_once (__ROOT__. '/config/db.php');

$sql = "SELECT classroom_id, name, location, description, capacity, created_at FROM classrooms ORDER BY name ASC";
$stmt = $pdo->query($sql);
$classes = $stmt->fetchAll();

?>

<!doctype html>
<html lang="fi">
<head>
    <meta charset="utf-8">
    <title>Luokat</title>
    <style>
        table {border-collapse: collapse; width: 100%;}
        th, td {border: 1px solid #ddd; padding: 8px;}
        th {background: #f4f4f4; text-align: left;}
        h1 {text-align: center;}
    </style>
</head>
<body>
<h1>Luokat</h1>

<?php if (empty($classes)) : ?>
    <p>Ei luokkia tietokannassa.</p>
<?php else: ?>
    <table>
        <thead>
            <tr>
                <th>Nimi</th>
                <th>Kapasiteetti</th>
                <th>Sijainti</th>
                <th>Kuvaus</th>
                <th>Lisätty</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($classes as $c): ?>
                <tr>
                    <td><?php echo htmlspecialchars($c['name'], ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8'); ?> </td>
                    <td><?php echo htmlspecialchars($c['capacity'], ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8'); ?> </td>
                    <td><?php echo htmlspecialchars($c['location'], ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8'); ?> </td>
                    <td><?php echo nl2br(htmlspecialchars($c['description'], ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8')); ?> </td>
                    <td><?php echo htmlspecialchars($c['created_at'], ENT_QUOTES, 'UTF-8'); ?> </td>
                </tr>
                <?php endforeach; ?>
        </tbody>
    </table>
<?php endif; ?>

</body>
</html>