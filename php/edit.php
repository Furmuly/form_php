    <?php require_once "style.php";
    require_once "config.php";

    if($_SERVER['REQUEST_METHOD'] == 'GET') {
        header("Location: index.php");
    } else {
        $id_users = $_POST['val'];
        $sql ='SELECT * FROM users
    INNER JOIN users_has_adresses uha on users.idusers = uha.users_idusers
    INNER JOIN adresses a on uha.adresses_idadresses = a.idadresses
    INNER JOIN countries c on a.countries_idcountries = c.idcountries
    WHERE idusers = :idusers 
    ';
        $stmt_edit = $pdo->prepare($sql);

        $stmt_edit->execute([
                'idusers' => $_GET['id']
        ]);

        $user = $stmt_edit->fetch();

        if($user = $stmt_edit->fetch()) {
            $idusers = $user['idusers'];
            $first_name = $user['first_name'];
            $last_name = $user['last_name'];
            $birthdate = $user['birthdate'];
            $phone = $user['phone'];
            $email = $user['email'];
            $civility = $user['civility'];
            $sex = $user['sex'];
            $street = $user['street'];
            $postal_code = $user['postal_code'];
            $city = $user['city'];
            $country = $user['name'];
        }
    }
  ?>
    <?php
    if(isset($_POST['submit'])){
        $users_id = $_POST['val'];
        $user_first_name = $_POST['first_name'];
        $last_name = $_POST['last_name'];
        $birthdate = $_POST['birthdate'];
        $phone = $_POST['phone'];
        $email = $_POST['email'];
        $civility = $_POST['civility'];
        $sex = $_POST['sex'];
        $street = $_POST['street'];
        $postal_code = $_POST['postal_code'];
        $city = $_POST['city'];
        $country = $_POST['name'];

        if(empty($first_name) || empty($last_name) || empty($birthdate) || empty($phone) || empty($email) || empty($civility) || empty($sex) || empty($street) || empty($postal_code) || empty($city) || empty($country)) {
            echo "<div class='alert alert-danger'> Field can't be blank!</div>";
        }else {

            //Update the user

            $sql = 'UPDATE users, adresses, countries SET first_name = :first_name, last_name = :last_name, birthdate = :birthdate, phone = :phone, email = :email, civility = :civility,
                 sex = :sex, street = :street, postal_code = :postal_code, city = :city, name = :country WHERE idusers = :idusers';
            $stmt = $pdo->prepare($sql);
            $stmt->execute([
                    'first_name' => $first_name,
              'last_name' => $last_name,
                'birthdate' => $birthdate,
                'phone' => $phone,
                'email' => $email,
                'civility' => $civility,
             'sex' => $sex,
                'street' => $street,
                'postal_code' => $postal_code,
                'city'=> $city,
                'name' => $country,
            ]);
            header("Location: index.php");

        }
    }
    ?>
    <form action ="edit.php" method="POST" autocomplete="off">
        <div>
            <input type="hidden" value="<?php echo $idusers; ?>" name="val" />


            <label for="first_name">
                Your First Name :
                <input type="text" name="first_name" value="<?php echo $first_name; ?>" class="form-control" id="first_name" placeholder="first_name"></label>



            <label for="last_name">
                Your Last Name
                <input type="text" name="last_name" value="<?php echo $last_name; ?>" class="form-control" id="last_name" placeholder="last_name"></label><br>


            <label for="birthdate">
                Your Birthdate :
                <input type="date" name="birthdate" value="<?php echo $birthdate; ?>" class="form-control" id="birthdate"></label><br>



            <label for="phone">
                Your Phone Number :
                <input type="tel" name="phone" value="<?php echo $phone; ?>" class="form-control" id="phone" placeholder="phone_number"> </label><br>



            <label for="email">
                Your email :
                <input type="email" name="email" value="<?php echo $email; ?>" class="form-control" id="email" placeholder="email" > </label><br>



            <label for="civility"> </label>
            Your Civility :
            <select name="civility" id="civility">
                <option value="0 <?php echo $civility; ?>">Single</option>
                <option value="1 <?php echo $civility; ?>">Married</option>
                <option value="2 <?php echo $civility; ?>">perfer not to say</option>
            </select><br>




            <label for="sex"> </label>
            Your Sex :
            <select name="sex" id="sex">
                <option value="0 <?php echo $sex; ?>">Male</option>
                <option value="1 <?php echo $sex; ?>">Female</option>
                <option value="2 <?php echo $sex; ?>">Perfer not to say</option>
            </select><br>




            <label for="street">
                Your Adresse :
                <input type="text" name="street" value="<?php echo $street; ?>" class="form-control" id="street" placeholder="street and number" min="1" max="99"></label>



            <label for="postal_code">
                <input type="number" name="postal_code" value="<?php echo $postal_code; ?>" class="form-control" id="postal_code" placeholder="postal_code" min="1" max="9999999999"></label>



            <label for="city">
                <input type="text" name="city" value="<?php echo ':city'; ?>" class="form-control" id="city"  placeholder="city" ></label><br>



            <label for="country">
                Your Country :
                <input type="text" name="country" value="<?php echo $country; ?>" class="form-control" id="country"  placeholder="your country" ></label><br>

            <div><button  name="submit" type="submit" class="btn btn-primary">Submit</button></div>


        </div>



    </form>



