<?php
/**
 * Modified by Atom.
 * User: sumo stephane
 * Date: 16/09/2019
 * Time: 17:30
 */
 // Header und Footer eingefügt
 // css ein wenig geändert(background-color, horizontal-line)
?>
<?php
//dbverbindung file abrufen
require "dbverbindung.php";
//Wählt category und displayed_name in der 'vehicles' Tabelle aus
$request = $dbh->query("SELECT category, displayed_name FROM vehicles");
//Ruft alle Zeilen der Abfrage ab, und speichern die in einer Variablen $vehicles
$vehicles = $request->fetchAll();
?>
<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Bewerber-Aufgabe</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/foundation/6.5.3/css/foundation-float.css" integrity="sha384-RgKKWex+zr/UMkk10qX6uL46Vvpo23H7QXDfntNEDvJ6mAkRLlIjjy4Pwv9Ebp0U" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/foundation/6.5.3/js/foundation.min.js" integrity="sha384-9ksAFjQjZnpqt6VtpjMjlp2S0qrGbcwF/rvrLUg2vciMhwc1UJJeAAOLuJ96w+Nj" crossorigin="anonymous"></script>
    <script src="eventclick.js"></script>
</head>
<body style="background-color: #CCCCCC !important;">
    <!-- Anfang des Headers - selbst eingefügt -->
    <div style="margin: 50px">
        <!-- jquery event click -->
        <h3 id="header" style="text-align: center">Header</h3>
    </div><hr style="color: white; background-color: white; padding: 2px">
    <!-- Ende des Headers -->
    <div class="row">
        <div class="columns">
            <h1>Hello, world!</h1>
            <p>Bitte geben Sie hier Ihre Daten ein und wählen Sie Ihre Lieblingsfahrzeuge aus.</p>
            <?php
            // Konvertiert Sonderzeichen in HTML-Entitäten und einige Daten der Tabelle 'vehicles' in Variablen speichern
            $category1 = htmlspecialchars($vehicles[0]['category']);
            $category2 = htmlspecialchars($vehicles[3]['category']);
            $category3 = htmlspecialchars($vehicles[6]['category']);

            $mark1 = htmlspecialchars($vehicles[0]['displayed_name']);
            $mark2 = htmlspecialchars($vehicles[1]['displayed_name']);
            $mark3 = htmlspecialchars($vehicles[2]['displayed_name']);
            $mark4 = htmlspecialchars($vehicles[3]['displayed_name']);
            $mark5 = htmlspecialchars($vehicles[4]['displayed_name']);
            $mark6 = htmlspecialchars($vehicles[5]['displayed_name']);
            $mark7 = htmlspecialchars($vehicles[6]['displayed_name']);
            $mark8 = htmlspecialchars($vehicles[7]['displayed_name']);
            $mark9 = htmlspecialchars($vehicles[8]['displayed_name']);

            // If-Bedingung fortzetzen wenn $_POST['first_name'] oder $_POST['last_name'] oder $_POST['birthdate'] ist leer
            if(empty($_POST['first_name']) || empty($_POST['last_name']) || empty($_POST['birthdate']))
            {
                echo "<p style='color: red'>Ein oder mehrere Felder fehlen</p>";
                //var_dump($vehicles[0]['displayed_name']);
                //echo $_POST['birthdate'];
                //header("Location: index.php");
            } else {
                // If-Bedingung fortzetzen, wenn die Rückgabe der Methode 'createFromFormat()' der Klasse DateTime nicht FALSE ist,
                if (DateTime::createFromFormat('d.m.Y', $_POST['birthdate']) !== FALSE) {
                    $birthDate = explode(".", $_POST['birthdate']);
                    /* Alter ab Datum oder Geburtsdatum ermitteln
                    Wenn Tag-Monat des Geburtstages > aktueller Tag-Monat, Alter = (aktuelles Jahr - Geburtstagsjahr) - 1, andernfalls Alter = aktuelles Jahr - Geburtstagsjahr */
                    $age = (date("md", date("U", mktime(0, 0, 0, $birthDate[0], $birthDate[1], $birthDate[2]))) > date("md")
                      ? ((date("Y") - $birthDate[2]) - 1)
                      : (date("Y") - $birthDate[2]));

                    
                    // SQL-Abfrage ausführen(Einige daten in der 'registered_users' Tabelle auswählen) und eine Ergebnismenge als Objekt zurückgeben
                    $request1 = $dbh->query('SELECT first_name, last_name, age FROM registered_users WHERE first_name="'.$_POST['first_name'].'" AND last_name="'.$_POST['last_name'].'" AND age="'.$age.'"');
                    // Ruft alle Zeilen der Abfrage ab, und speichern die in einer Variable $user1
                    $user1 = $request1->fetch(PDO::FETCH_ASSOC);

                    //$vehicles=array();
                    // If-Bedingung fortzetzen, wenn $_POST['vehicles'] existiert und die Anzahl kleiner oder gleich als 5 ist
                    if(isset($_POST['vehicles']) && count($_POST['vehicles']) <= 5 && $user1 <= 1){
                      // Bereitet eine Abfrage(first_name,last_name,age in die registered_users Tabelle einfügen) zur Laufzeit vor und gibt ein Objekt zurück
                      $req = $dbh->prepare('INSERT INTO registered_users(first_name,last_name,age) VALUES (?,?,?)');
                      // Die Vorbereitete Abfrage ausführen
                      $req->execute(array(htmlspecialchars($_POST['first_name']),htmlspecialchars($_POST['last_name']),$age));
                      // Die ID der zuletzt eingefügten Zeile liefern und in der Variable $last_id speichern
                      $last_id = $dbh->lastInsertId();
                      //--$req->execute(array($_POST['first_name'],$_SESSION['user']));

                      $vehicles = $_POST['vehicles'];
                      // Laufen durch den Input Value(innerhalb des HTML-Formulares)
                      foreach($vehicles as $value)
                      {
                          // If-Bedingung fortzetzen, wenn $value=="LKW" oder "Coupé" oder "Bagger"
                          if(($value == "LKW") || ($value == "Coupé") || ($value == "Bagger")){
                            // SQL-Abfrage ausführen(Daten in der 'vehicles' Tabelle einfügen) und eine Ergebnismenge als Objekt zurückgeben
                            $req1 = $dbh->query('INSERT INTO vehicles(registered_id,category,displayed_name) VALUES ("'.$last_id.'","'.$value.'","'.$category1.'")');
                            // Test-Ausgabe der Value
                            echo $value.' - ';
                          }
                          // If-Bedingung fortzetzen, wenn $value=="Airliner" oder "Huschrauber" oder "Business-Jet"
                          else if(($value == "Airliner") || ($value == "Hubschrauber") || ($value == "Business-Jet")){
                            // SQL-Abfrage ausführen(Daten in der 'vehicles' Tabelle einfügen) und eine Ergebnismenge als Objekt zurückgeben
                            $req1 = $dbh->query('INSERT INTO vehicles(registered_id,category,displayed_name) VALUES ("'.$last_id.'","'.$value.'","'.$category2.'")');
                            // Test-Ausgabe der Value
                            echo $value.' - ';
                          }
                          // If-Bedingung fortzetzen, wenn $value=="Öltanker" oder "Jetski" oder "Yacht"
                          else if(($value == "Öltanker") || ($value == "Jetski") || ($value == "Yacht")){
                            // SQL-Abfrage ausführen(Daten in der 'vehicles' Tabelle einfügen) und eine Ergebnismenge als Objekt zurückgeben
                            $req1 = $dbh->query('INSERT INTO vehicles(registered_id,category,displayed_name) VALUES ("'.$last_id.'","'.$value.'","'.$category3.'")');
                            // Test-Ausgabe der Value
                            echo $value;
                          }
                          else{

                          }
                      }
                    } else{
                          // Fehlermeldung wenn die If-Bedingung nicht erfüllt ist
                          echo "<p style='color: red'>Sie haben nicht zwischen einer und 5 Auswahlmöglichkeiten gewählt, oder der Benutzer mit diesem Geburtsdatum existiert bereits</p>";
                    }
                } else {
                  // Fehlermeldung wenn die If-Bedingung nicht erfüllt ist
                  echo "<p style='color: red'>Datumsformat ist nicht korrekt</p>";
                }

            }

            ?>
            <form action="" method="POST">

                <!-- Vorname -->
                <div class="form-group">
                    <label for="form-field-first_name">Vorname:</label>
                    <!-- Attribute - required und placeholder eingefügt-->
                    <input type="text" name="first_name" placeholder="Vorname" id="form-field-first_name" required>
                </div>

                <!-- Nachname -->
                <div class="form-group">
                    <label for="form-field-last_name">Nachname:</label>
                    <!-- Attribute - required und placeholder eingefügt-->
                    <input type="text" name="last_name" placeholder="Nachname" id="form-field-last_name" required>
                </div>

                <!-- Geburtsdatum -->
                <div class="form-group">
                    <label for="form-field-birthdate">Geburtsdatum (Format TT.MM.YYYY):</label>
                    <!-- Attribute - required und placeholder eingefügt-->
                    <input type="text" name="birthdate" placeholder="Geburtsdatum" id="form-field-birthdate" required pattern="\d{1,2}.\d{1,2}.\d{4}">
                </div>

                <!-- Landfahrzeuge -->
                <div class="form-group">
                    <fieldset>
                        <legend><?php echo $category1.'<br>'; ?></legend>

                        <div class="form-check">
                            <input type="checkbox" name="vehicles[]" value="Coupé" id="form-field-vehicles-1">
                            <label for="form-field-vehicles-1"><?php echo $mark1.'<br>'; ?></label>
                        </div>

                        <div class="form-check">
                            <input type="checkbox" name="vehicles[]" value="LKW" id="form-field-vehicles-2">
                            <label for="form-field-vehicles-2"><?php echo $mark2.'<br>'; ?></label>
                        </div>

                        <div class="form-check">
                            <input type="checkbox" name="vehicles[]" value="Bagger" id="form-field-vehicles-3">
                            <label for="form-field-vehicles-3"><?php echo $mark3.'<br>'; ?></label>
                        </div>
                    </fieldset>
                </div>

                <!-- Luftfahrzeuge -->
                <div class="form-group">
                    <fieldset>
                        <legend><?php echo $category2.'<br>'; ?></legend>

                        <div class="form-check">
                            <input type="checkbox" name="vehicles[]" value="Airliner" id="form-field-vehicles-4">
                            <label for="form-field-vehicles-4"><?php echo $mark4.'<br>'; ?></label>
                        </div>

                        <div class="form-check">
                            <input type="checkbox" name="vehicles[]" value="Hubschrauber" id="form-field-vehicles-5">
                            <label for="form-field-vehicles-5"><?php echo $mark5.'<br>'; ?></label>
                        </div>

                        <div class="form-check">
                            <input type="checkbox" name="vehicles[]" value="Business-Jet" id="form-field-vehicles-6">
                            <label for="form-field-vehicles-6"><?php echo $mark6.'<br>'; ?></label>
                        </div>
                    </fieldset>
                </div>

                <!-- Wasser -->
                <div class="form-group">
                    <fieldset>
                        <legend><?php echo $category3.'<br>'; ?></legend>

                        <div class="form-check">
                            <input type="checkbox" name="vehicles[]" value="Öltanker" id="form-field-vehicles-7">
                            <label for="form-field-vehicles-7"><?php echo $mark7.'<br>'; ?></label>
                        </div>

                        <div class="form-check">
                            <input type="checkbox" name="vehicles[]" value="Jetski" id="form-field-vehicles-8">
                            <label for="form-field-vehicles-8"><?php echo $mark8.'<br>'; ?></label>
                        </div>

                        <div class="form-check">
                            <input type="checkbox" name="vehicles[]" value="Yacht" id="form-field-vehicles-9">
                            <label for="form-field-vehicles-9"><?php echo $mark9.'<br>'; ?></label>
                        </div>
                    </fieldset>
                </div>

                <button type="submit" class="button">Absenden</button>

            </form>
        </div>
    </div>

    <?php
    // SQL-Abfrage ausführen(Daten für jede Spalte jeder Zeile in der 'registered_users' Tabelle auswählen) und eine Ergebnismenge als Objekt zurückgeben
    $userrequest = $dbh->query("SELECT * FROM registered_users");
    // Ruft alle Zeilen der Abfrage ab, und speichern die in einer Variable $users
    $users = $userrequest->fetchAll();
    echo "<hr><div style='margin: 0 auto; width: 400px'><h4 style='text-decoration: underline; text-align: center; font-weight: bold'>Übsersicht - Registrierte User:</h4><table style='border: 3px solid black'>
            <tr>
              <th>#</th>
              <th style='border: 3px solid black'>Firstname</th>
              <th style='border: 3px solid black'>Lastname</th>
              <th style='border: 3px solid black'>Age</th>
            </tr>";
    //Durchlauf und Ausgabe von registrierten User-Daten(id,first_name,last_name,age) in der Tabelle
    foreach($users as $user){
      echo '
              <tr style="text-align: center">
                <td style="border: 3px solid black">'.$user['id'].
                '</td>
                <td style="border: 3px solid black">'.$user['first_name'].
                '</td>
                <td style="border: 3px solid black">'.$user['last_name'].
                '</td>
                <td style="border: 3px solid black">'.$user['age'].
                '</td>
              </tr>
            ';
    }
    echo '</table></div><hr style="color: white; background-color: white; padding: 2px">';
    ?>
    <?php
      /*$request1 = $dbh->query("SELECT id FROM vehicles WHERE category = 'Luft'");
      $vehicles1 = $request1->fetchAll();
      foreach($vehicles1 as $vehicle1){
        echo $vehicle1['id'];
      }*/
    ?>
    <!-- Anfang der Fußzeile - selbst eingefügt -->
    <div style="margin: 50px">
        <h3 id="footer" style="text-align: center">Footer</h3>
    </div>
    <!-- Ende der Fußzeile -->
</body>
</html>
