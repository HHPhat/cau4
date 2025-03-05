<!DOCTYPE html>
<html>
<head>
    <title>Upload File CSV</title>
</head>
<body>
    <h2>Upload file CSV</h2>
    <form action="upload-csv-processing.php" method="post" enctype="multipart/form-data">
        Chọn file CSV:
        <input type="file" name="fileToUpload" accept=".csv" required>
        <input type="submit" value="Upload" name="submit">
    </form>
</body>
</html>
