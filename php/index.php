<?php
require_once 'config.php';

if(isset($_POST['submit'])) {
    $country = ucfirst(strtolower(trim($_POST['country'])));

    $stmt_country_exist_or_not = pdo->prepare('SELECT * FROM countries WHERE name = :country');
    $stmt_country_exist_or_not->execute([
            'country' => $country
    ]);
    $data = $stmt_country_exist_or_not->fetchAll();

    if($data) {
        $id_country = $data[0]['id_country'];

    }else{
        $stmt_country = $pdo->prepare('INSERT INTO countries(name)VALUE(:name)');
        $stmt_country->excutes(['name'=>$country,]);

        $id_country=$pdo->lastinsertintoId();
    }

    $stmt_adresses = $pdo->prepare('INSERT INTO adresses (street, postal_code, city, countries_idcountries)
            VALUES (:street, :postal_code, :city, :countries_idcountries )');
    $stmt_adresses->execute(['first_name' => $_POST['first_name'],
        'street' => $_POST['street'],
        'postal_code' => $_POST['postal_code'],
        'city' => $_POST['city'],
        'countries_idcountries'=> $id_country,]);
    $id_adresse = $pdo->lastInsertId();

    $stmt = $pdo->prepare('INSERT INTO `mydb`.`users` (first_name, last_name, birthdate, phone, email, civility, sex)
            VALUES (:first_name, :last_name, :birthdate, :phone, :emai, :civility, :sex)');
    $stmt->execute(['first_name' => $_POST['first_name'],
        'last_name' => $_POST['last_name'],
        'birthdate' => $_POST['birthdate'],
        'phone' => $_POST['phone'],
        'email' => $_POST['email'],
        'civility' => $_POST['civility'],
        'sex' => $_POST['sex']]);
    $id_user = $pdo->lastInsertId();

    $stmt_users_has_adresse = $pdo->prepare(
            'INSERT INTO users_has_adresses(users_id_user, adresses_id_adresse) VALUES (:users_id_user, :adresses_id:adresse)'
    );

    $stmt_users_has_adresse->execute([
            'users_id_user'=> $id_user,
            'adresses_id_adresse'=> $id_adresse,
    ]);

}
?>

    <form action="index.php" method="post">
        <table>

            <tr>

                <td><label for="first_name">
                        <input type="text" name="first_name"  placeholder="first_name"></label></td>
            </tr>

            <tr>
                <td><label for="last_name">
                        <input type="text" name="last_name" placeholder="last_name"></label></td
            </tr>

            <tr>
                <td><label for="birthdate">
                        <input type="date" name="birthdate" value="birthdate"> </label><br></td>
            </tr>

            <tr>
                <td><label for="phone">
                        <input type="tel" name="phone"  placeholder="phone_number"> </label><br></td>
            </tr>

            <tr>
                <td><label for="email">
                        <input type="email" name="email" placeholder="email" > </label><br></td>
            </tr>

            <tr>
                <td><label for="civility"> </label></td>
                <td><select name="civility" id="civility">
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="Perfer not to say">perfer not to say</option>
                    </select><br></td>

            </tr>

            <tr>
                <td><label for="sex"> </label></td>
                <td><select name="sex" id="sex">
                        <option value="Male">Male</option>
                        <option value="Female">Female</option>
                        <option value="Perfer not to say">perfer not to say</option>
                    </select><br></td>

            </tr>

            <tr>
                <td><label for="street">
                        <input type="text" name="street" placeholder="street" min="1" max="99"></label><br></td>
            </tr>

            <tr>
                <td><label for="postal_code">
                        <input type="number" name="postal_code" placeholder="postal_code" min="1" max="9999"></label><br></td>
            </tr>

            <tr>
                <td><label for="city">
                        <input type="text" name="city" placeholder="city" ></label><br></td>
            </tr>

            <tr>
                <td><button  name="submit" type="submit" class="btn btn-primary">Submit</button></td>
            </tr>
        </table>
            
    </form>
    



