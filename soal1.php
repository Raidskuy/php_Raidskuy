<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Dinamis</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        .container {
            margin: 20px auto;
            width: 300px;
            text-align: center;
        }
        input {
            margin: 5px 0;
        }
    </style>
</head>
<body>
    <?php
    // interface no 1
    if (!isset($_POST['step']) || $_POST['step'] == 1) { 
    ?>
        <div class="container">
            <h3>Tampilan No. 1</h3>
            <form method="post">
                <input type="hidden" name="step" value="2">
                <label>Inputkan Jumlah Baris:</label><br>
                <input type="number" name="rows" min="1" required><br>
                <label>Inputkan Jumlah Kolom:</label><br>
                <input type="number" name="cols" min="1" required><br>
                <button type="submit">SUBMIT</button>
            </form>
        </div>
    <?php
    // interface no 2
    } elseif ($_POST['step'] == 2) {
        $rows = (int)$_POST['rows'];
        $cols = (int)$_POST['cols'];
    ?>
        <div class="container">
            <h3>Tampilan No. 2</h3>
            <form method="post">
                <input type="hidden" name="step" value="3">
                <input type="hidden" name="rows" value="<?= $rows ?>">
                <input type="hidden" name="cols" value="<?= $cols ?>">
                <?php for ($i = 1; $i <= $rows; $i++): ?>
                    <?php for ($j = 1; $j <= $cols; $j++): ?>
                        <label><?= $i ?>.<?= $j ?>:</label>
                        <input type="text" name="data[<?= $i ?>][<?= $j ?>]" required><br>
                    <?php endfor; ?>
                <?php endfor; ?>
                <button type="submit">SUBMIT</button>
            </form>
        </div>
    <?php
    // interface no 3
    } elseif ($_POST['step'] == 3) {
        $data = $_POST['data'];
    ?>
        <div class="container">
            <h3>Tampilan No. 3</h3>
            <?php foreach ($data as $row => $cols): ?>
                <?php foreach ($cols as $col => $value): ?>
                    <p><?= $row ?>.<?= $col ?>: <?= htmlspecialchars($value) ?></p>
                <?php endforeach; ?>
            <?php endforeach; ?>
        </div>
    <?php } ?>
</body>
</html>
