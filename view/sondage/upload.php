<!DOCTYPE html>
                <html>
                    <head>
                        <meta charset="UTF-8">
                        <title>Upload à l'iut</title>
                            <style>
                                b{
                                    color:red;
                                }
                            </style>
                    </head>
                    <body>
                        <pre>
                            $uploads_dir = __
                        <?php
                            //On espionne $_FILES
                            var_dump($_FILES);


                            $nomFichier = $_FILES["fileToUpload"]["name"];
                            $dossier = $_FILES["fileToUpload"]["tmp_name"];
                            echo $dossier;
                            echo "<div>Import du fichier : <b>$dossier/$nomFichier</b></div>";
                            echo "<div><b>résultat de l'upload : </b>";
                            var_dump(move_uploaded_file("$dossier", "./upload/test/$nomFichier"));

                            echo "<div><a href='./upload/$nomFichier'>Accès au fichier uploadé</a></div></div>";
                        ?>
                    </body>
                    </html>
