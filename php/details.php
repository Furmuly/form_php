    <?php
    require "style.php";
    $pdo = new PDO("mysql:host=localhost;dbname=mydb","root","Nab@Jan1");
    $query= "select * From mydb.users, adresses, countries ORDER BY idusers DESC LIMIT 1";
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
                <td><?php echo $data["civility"]; ?></td>
                <td><?php echo $data["sex"]; ?></td>
                <td><?php echo $data["street"]; ?></td>
                <td><?php echo $data["postal_code"]; ?></td>
                <td><?php echo $data["city"]; ?></td>
                <td><?php echo $data["name"]; ?></td>
            </tr>
            <?php
        }
        ?>
    </table>