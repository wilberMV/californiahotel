<?php
    if (file_exists("../../usuarios/".$_SESSION['cod_user'].".jpg")){
        echo '<img src="../../usuarios/'.$_SESSION['cod_user'].'.jpg" alt="user-img" class="img-circle"/>';
            }else{
                echo '<img src="../../usuarios/defecto.png" alt="user-img" class="img-circle"/>';
            }
 ?>