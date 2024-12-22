<?php 
session_start();

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upload Files</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            background-color: #f4f4f9;
        }

        .upload-form {
            background: #ffffff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            width: 300px;
        }

        .upload-form h1 {
            text-align: center;
            font-size: 1.5em;
            margin-bottom: 20px;
        }

        .upload-form input[type="text"],
        .upload-form input[type="date"],
        .upload-form input[type="file"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ddd;
            border-radius: 5px;
        }

        .upload-form button {
            width: 100%;
            padding: 10px;
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 5px;
            font-size: 1em;
            cursor: pointer;
        }

        .upload-form button:hover {
            background-color: #0056b3;
        }

        .error {
            color: red;
            font-size: 0.9em;
        }
    </style>
</head>

<body>
    <div class="upload-form">
        <h1>Upload Files</h1>
        <form action="../logic/upload_files_process.php" method="post" enctype="multipart/form-data">
            <input type="hidden" name="students_Id" value="<?php echo isset($_SESSION["accountId"]) ? htmlspecialchars($_SESSION["accountId"]) : ''; ?>" required>

            <label for="file_name">File Name:</label>
            <input type="text" name="file_name" id="file_name" placeholder="Enter file name" value="<?php echo isset($_POST['file_name']) ? htmlspecialchars($_POST['file_name']) : ''; ?>" required>

            <label for="upload_date">Upload Date:</label>
            <input type="date" name="upload_date" id="upload_date" value="<?php echo isset($_POST['upload_date']) ? htmlspecialchars($_POST['upload_date']) : ''; ?>" required>

            <label for="uploadFiles">Choose File:</label>
            <input type="file" name="uploadFiles" id="uploadFiles" required>

            <button type="submit" name="submit">Submit</button>
        </form>
    </div>
</body>

</html>
