<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Backup Restore</title>
</head>

<body>
    <h2>Backup</h2>
    <a href="backup.php">Backup</a>
    <h2>Restore</h2>
    <form enctype="multipart/form-data" action="restore.php" method="post">
        <table>
            <tr>
                <td>File Backup Database (*.sql) <input type="file" name="datafile"></td>
            </tr>
            <tr>
                <td><input type="submit" onclick="return confirm('Apakah Anda yakin akan restore database?')" name="restore" value="Restore Database"></td>
            </tr>
        </table>
    </form>
</body>

</html>