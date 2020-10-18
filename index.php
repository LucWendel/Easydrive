<?php include 'check.php'; ?>
                <html>
                <head>
                    <title>Index</title>
                </head>
                <body>
                <h2>Index</h2>
                    
                    <?php
                        if(isset($_GET['msg']))
                        {
                            if($_GET['msg'] == 'succes')
                            {
                                echo 'U bent succesvol ingelogd!';
                            }
                        }
                    ?>

                      
                </body>
                </html>  