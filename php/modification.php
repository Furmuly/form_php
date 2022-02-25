<?php
require "style.php";
$pdo = new PDO("mysql:host=localhost;dbname=mydb","root","Nab@Jan1");
$query= 'SELECT * FROM users
INNER JOIN users_has_adresses uha on users.idusers = uha.users_idusers
INNER JOIN adresses a on uha.adresses_idadresses = a.idadresses
INNER JOIN countries c on a.countries_idcountries = c.idcountries
';
$d = $pdo->query($query);
?>



        <table class="table">
            <?php
            foreach($d as $data)
            {
            ?>
            <tr class="table-success">
                <td> <?php echo $data["idusers"]; ?><td>
                <td> <?php echo $data["first_name"]; ?><td>
                <td> <?php echo $data["last_name"]; ?><td>
                <td> <?php echo $data["birthdate"]; ?><td>
                <td> <?php  echo $data["phone"]; ?><td>
                <td> <?php echo $data["email"]; ?><td>
                <td>
                    <?php if ($data['civility'] === 0) { ?>
                        Single <?php } ?>
                    <?php if ($data['civility'] === 1) { ?>
                        Married <?php } ?>
                    <?php if ($data['civility'] === 2) { ?>
                        Prefer not to say <?php } ?>
                </td>
                <td>
                    <?php if ($data['sex'] === 0) { ?>
                        Male <?php } ?>

                    <?php if ($data['sex'] === 1) { ?>
                        Female <?php } ?>

                    <?php if ($data['sex'] === 3) { ?>
                        Prefer not to say  <?php } ?>

                </td>
                <td> <?php echo $data["street"]; ?><td>
                <td><?php  echo $data["postal_code"]; ?><td>
                <td> <?php echo $data["city"]; ?><td>
                <td><?php echo $data["name"]; ?></td>

                <td><form action="edit.php?id=<?php echo $data["idusers"] ?>" method="POST">
                        <input type="hidden" value="<?php echo $idusers ?> " name="val" />
                        <input type="submit" class="btn btn-link" value="Edit" name="submit" />
                    </form>
                </td>
            </tr>
                <td><form action="index.php?id=<?php echo $data["idusers"] ?>" method="POST">
                        <input type="hidden" value="<?php echo $idusers ?> " name="val" />
                        <input type="submit" class="btn btn-link" value="DELETE" name="submit" />
                    </form>
                </td>


            <?php
             }
            ?>
        </table>
        <?php
        if(isset($_POST['submit'])) {
            $id = $_POST['val'];
            $sql = "DELETE FROM  users 
    INNER JOIN users_has_adresses uha on users.idusers = uha.users_idusers
    INNER JOIN adresses a on uha.adresses_idadresses = a.idadresses
    INNER JOIN countries c on a.countries_idcountries = c.idcountries
    WHERE idusers = :idusers WHERE idusers = :idusers";
            $stmt = $pdo->prepare($sql);
            $stmt->execute([
                ':id' => $id
            ]);
        }


