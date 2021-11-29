 <!DOCTYPE html>
                <html>
                    <head>
                        <meta charset="UTF-8">
                        <title>Uploader un fichier à l'iut</title>
                    </head>
                    <body>
                        <form action="upload.php" method="post" enctype="multipart/form-data">
                            Selectionner le fichier à "uploader":
                            <input type="file" name="fileToUpload" id="fileToUpload">
                            <input type="submit" value="Uploader le fichier" name="submit">
                        </form>      
                    </body>
                </html>