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
            <tr>
                <th>User_ID</th>
                <th>First_Name</th>
                <th>Last_Name</th>
                <th>Birthdate</th>
                <th>Phone</th>
                <th>Email</th>
                <th>Civility</th>
                <th>Sex</th>
                <th>Street</th>
                <th>Postal_code</th>
                <th>City</th>
                <th>Country</th>
                <th>Details</th>
            </tr>

        <?php
        foreach($d as $data)
        {
            ?>
            <tr class="table-success">
                <td><?php echo $data["idusers"]; ?></td>
                <td><?php echo $data["first_name"]; ?></td>
                <td><?php echo $data["last_name"]; ?></td>
                <td><?php echo $data["birthdate"]; ?></td>
                <td><?php echo $data["phone"]; ?></td>
                <td><?php echo $data["email"]; ?></td>
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
                <td><?php echo $data["street"]; ?></td>
                <td><?php echo $data["postal_code"]; ?></td>
                <td><?php echo $data["city"]; ?></td>
                <td><?php echo $data["name"]; ?></td>
                <td><a href="details.php?id<?php $data["idusers"]?>">Details</a></td>
            </tr>
            <?php
        }
        ?>
    </table>

    <?php
    //require "footer.php";
    ?>