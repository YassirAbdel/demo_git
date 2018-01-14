<?php 
// session_start(); activer en production
?>
<!DOCTYPE html>
<html lang="fr">
    <head>
        <title><?= $title ?></title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="public/css/style.css" rel="stylesheet" /> 
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
        <script src="public/js/tinymce/tinymce.min.js"></script>
        <script type="text/javascript">
           tinymce.init({
                selector: 'textarea',
                height: 200,
                menubar: false,
                plugins: [
                     'advlist autolink lists link image charmap print preview anchor textcolor',
                      'searchreplace visualblocks code fullscreen',
                      'insertdatetime media table contextmenu paste code help'
                ],
                toolbar: 'insert | undo redo | formatselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | preview | removeformat | fullscreen | help',
                content_css: [
                     '//fonts.googleapis.com/css?family=Lato:300,300i,400,400i',
                     '//www.tinymce.com/css/codepen.min.css']
                });
        </script>
        <style>
            /* Set height of the grid so .sidenav can be 100% (adjust if needed) */
            .row.content {height: auto;}
    
            /* Set gray background color and 100% height */
            .sidenav {
            background-color: #f1f1f1;
            height: 100%;
            }
    
            /* Set black background color, white text and some padding */
            footer {
            background-color: #555;
            color: white;
            padding: 15px;
            }
            footer a {
                color:#ffffff;
            }
            footer a:hover {
                color:#f1f1f1;
                text-decoration: none;
            }
            
            /* On small screens, set height to 'auto' for sidenav and grid */
            @media screen and (max-width: 767px) {
                .sidenav {
                height: auto;
                padding: 15px;
                }
                .row.content {height: auto;} 
            }
        </style>
   </head>
    <body>
        <?= $content ?>
    </body>
</html>
