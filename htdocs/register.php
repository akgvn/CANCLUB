<?php

// TODO:

// If a user is already logged in, redirect to index.php.

// Connect to database and select all dept names and id's. -> USE PDO

// If POST data has been sent, register the user.

?>



<html>

<body>
    <form action="register.php" method="POST">
        <fieldset>
            <legend>Your Details:</legend>
            <label> First Name <input required type="text" id="fname" name="fname" size="30" maxlength="100"></label><br /><br>
            <label> Last Name <input required type="text" id="lname" name="lname" size="30" maxlength="100"></label><br /><br>
            <label> Birth Date <input required type="date" id="birth" name="birth" size="30" maxlength="100"></label><br />
            <label> e-Mail: <input required type="text" id="mail" name="mail" size="30" maxlength="100"></label><br /><br>
            <label> Username: <input required type="text" id="user" name="user" size="30" maxlength="100"></label><br /><br>
            <label> Password:&nbsp&nbsp<input required type="password" id="pass" name="pass" size="30" maxlength="100"></label><br />
        </fieldset><br />
        <fieldset>
            <legend>Additional Information:</legend>
            <label> What department are you in?
                <select name="dept">
                    <?php

                    // TODO

                    ?>
                    <option value="php">Php</option>
                </select>
            </label> <br> <br>
            <label> Favorite IDE? <br>
                <div> <label><input class="form-check-input" required type="radio" name="favide" value="devcpp"> Dev-C++</label> </div>
                <div> <label><input class="form-check-input" type="radio" name="favide" value="eclipse"> Eclipse</label> </div>
                <div> <label><input class="form-check-input" type="radio" name="favide" value="vim"> Vim</label> </div>
                <div> <label><input class="form-check-input" type="radio" name="favide" value="visual_studio"> Visual Studio</label> </div>
            </label>
        </fieldset>
        <input class="btn btn-sm btn-primary btn-block" type="submit" value="Submit" />
    </form>
</body>