<div class="container">
        <ul class="collection">
            <?php
            $stmt = $mysqli->prepare("SELECT item.id,titre,description,prix,image,type FROM item,p_item WHERE item.idtype = p_item.id order by type;");
            $stmt->execute();
            $stmt->bind_result($id,$titre,$description,$prix,$image,$type);
            while($stmt->fetch()) {
                echo "<li class=\"collection-item avatar\">"; ?>
                <img src="
                    <?php
                if(isset($image)){
                    echo $_GLOBAL['dirimg'].$image;
                }
                ?>"
                     alt="" class="circle">
                <?php
                echo "<span value=\"$titre\">$titre</span>";
                echo "<p>";
                echo "<span value='$description'> $description <br>";
                echo "<span value='$prix'> $prix <br>";
                echo "<span value='$type'> $type <br>";
                echo "</p>";
                echo "<a href=\"admin-plat?id=$id\" class=\"secondary-content\"><i class=\"material-icons\">send</i></a>";
                echo "</li>";
            }
            $stmt->close();
            ?>
        </ul>
</div>