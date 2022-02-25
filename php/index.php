    <?php
    require_once 'config.php';
    require 'style.php';
    require_once 'header.php';

    if(isset($_POST['submit'])) {

        $country = ucfirst(mb_strtolower(trim($_POST['country'])));

        $stmt_countries_exist_or_not = $pdo->prepare('SELECT * FROM countries WHERE name = :country');
        $stmt_countries_exist_or_not->execute(['country'=>$country]);
        $data = $stmt_countries_exist_or_not->fetch();

        if($data) {
            $id_countries = $data['idcountries'];

        }else{
            $stmt_countries = $pdo->prepare('INSERT INTO countries(name)VALUE(:name)');
            $stmt_countries->execute(['name'=>$country,
                ]);

            $id_countries= $pdo->lastInsertId();
        }

        $stmt_adresses = $pdo->prepare('INSERT INTO adresses (street, postal_code, city, countries_idcountries)
                VALUES (:street, :postal_code, :city, :countries_idcountries)');
        $stmt_adresses->execute(array(
            'street' => $_POST['street'],
            'postal_code' => $_POST['postal_code'],
            'city' => $_POST['city'],
            'countries_idcountries'=> $id_countries,
        ));
        $id_adresses = $pdo->lastInsertId();

        $stmt = $pdo->prepare('INSERT INTO `mydb`.`users` (first_name, last_name, birthdate, phone, email, civility, sex)
                VALUES (:first_name, :last_name, :birthdate, :phone, :email, :civility, :sex)');
        $stmt->execute([
            'first_name' => $_POST['first_name'],
            'last_name' => $_POST['last_name'],
            'birthdate' => $_POST['birthdate'],
            'phone' => $_POST['phone'],
            'email' => $_POST['email'],
            'civility' => $_POST['civility'],
            'sex' => $_POST['sex'],
        ]);

        $id_users = $pdo->lastInsertId();

       $stmt_users_has_adresses = $pdo->prepare('INSERT INTO `mydb` . `users_has_adresses` (users_idusers, adresses_idadresses)
            VALUES (:users_idusers, :adresses_idadresses)
    ');

        $stmt_users_has_adresses->execute([
                'users_idusers'=> $id_users,
                'adresses_idadresses'=> $id_adresses,
       ]);

    }
    ?>

        <form action ="index.php" method="post">

              <div>

                    <label for="first_name">
                        Your First Name :
                            <input type="text" name="first_name"  placeholder="first_name"></label>



                    <label for="last_name">
                        Your Last Name
                            <input type="text" name="last_name" placeholder="last_name"></label><br>


                    <label for="birthdate">
                        Your Birthdate :
                            <input type="date" name="birthdate"></label><br>



                    <label for="phone">
                        Your Phone Number :
                            <input type="tel" name="phone"  placeholder="phone_number"> </label><br>



                    <label for="email">
                        Your email :
                            <input type="email" name="email" placeholder="email" > </label><br>



                    <label for="civility"> </label>
                  Your Civility :
                    <select name="civility" id="civility">
                            <option value="0">Single</option>
                            <option value="1">Married</option>
                            <option value="2">perfer not to say</option>
                        </select><br>




                    <label for="sex"> </label>
                  Your Sex :
                    <select name="sex" id="sex">
                            <option value="0">Male</option>
                            <option value="1">Female</option>
                            <option value="2">Perfer not to say</option>
                        </select><br>




                    <label for="street">
                        Your Adresse :
                            <input type="text" name="street" placeholder="street and number" min="1" max="99"></label>



                    <label for="postal_code">
                            <input type="number" name="postal_code" placeholder="postal_code" min="1" max="9999999999"></label>



                    <label for="city">
                            <input type="text" name="city" placeholder="city" ></label><br>



                    <label for="country">
                        <input type="text" name="country" placeholder="your country" ></label><br>



                    <div><button  name="submit" type="submit" class="btn btn-primary">Submit</button></div>


              </div>



        </form>

    <?php require 'footer.php'; ?>


