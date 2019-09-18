# Testaufgabe für Bewerber

## Einleitung
Mit diesen Aufgaben wollen wir herausfinden, wie du an Programmieraufgaben herangehst, wie sicher und sauber du mit PHP und MySQL arbeitest und wie dein Code im Allgemeinen aussieht. Für uns ist das wichtig, weil wir uns so eine viel bessere Vorstellung davon machen können, auf welchem "Level" du bist und ob deine Arbeitsweise in unser Team passt. Für dich ist das interessant, weil die Aufgaben (bzw. die Konzepte dahinter) so auch in deinem Alltag bei uns auftauchen können, d.h. du kannst danach vielleicht besser einschätzen, was dich bei uns erwartet.

Für die folgenden Aufgaben setzen wir ein paar Dinge voraus, nämlich:
- dass du programmieren kannst (logischerweise) und
- dass du ein Grundverständnis davon hast, wie PHP und MySQL in der Webentwicklung verwendet werden

Die Aufgaben bauen lose aufeinander auf, aber müssen nicht unbedingt in dieser Reihenfolge bearbeitet werden (außer Aufgabe 0). Welche und wie viele Aufgaben du bearbeitest entscheidest du am besten selbst, je nachdem wieviel Zeit du dafür hast.

> Denk dran: Das hier ist kein Einstellungstest, den du bestehen oder nicht bestehen kannst, sondern es geht uns wirklich nur darum ein Beispiel für deine Arbeit zu sehen.

### Vorgehensweise
1. Lies dir alles einmal durch, schau dir den vorhandenen Code an und überleg dir, wo du Probleme siehst oder was dir unklar ist. Wenn du Fragen hast, melde dich direkt bei uns.
2. Bearbeite die Aufgaben
3. Schreib auf wenn
   - dir Fehler in unserem Code oder den Aufgaben auffallen
   - du Anmerkungen zu deiner Lösung oder deinem Lösungsweg hast
   - du einen Lösungsansatz hast, den du aus Zeitgründen nicht verfolgst
4. Pushe deine Änderungen (und gerne auch deine Anmerkungen) wieder in dieses Repository, damit wir uns das vor dem nächsten Gespräch anschauen und mit dir darüber reden können.

## Aufgaben

### 0.) Das System aufsetzen
Dieses Formular-System braucht einen Webserver mit PHP und eine MySQL-Datenbank. Wir empfehlen [XAMPP](https://www.apachefriends.org/de/index.html), weil es überall einfach zu installieren ist und quasi ohne Konfiguration auskommt. Jede andere Umgebung ist aber natürlich auch möglich, solange PHP und MySQL darauf laufen.

Wenn der Webserver und der Datenbankserver laufen, musst du eine neue Datenbank anlegen und den mitgelieferten SQL-Dump (`sql/database.sql`) importieren. Danach sollte deine Datenbank die beiden Tabellen `registered_users` und `vehicles` enthalten. In der `vehicles`-Tabelle sollten bereits einige Einträge vorhanden sein.

Danach kannst du das Projekt aufrufen, zum Beispiel unter `localhost/mokom01-bewerber-aufgabe`. Wenn du jetzt ein Formular mit ein paar Inputfeldern und Checkboxen siehst, hast du diese Aufgabe schon gelöst.

### 1.) Daten ausgeben
In der Datei `index.php` sind die Beschriftungen der Checkboxen ("Coupé", "LKW", usw.) und ihrer Kategorien ("Land", "Luft", "Wasser") definiert. Eigentlich sollen diese Kategorien und Beschriftungen beim Laden der Seite aus der Datenbank-Tabelle `vehicles` gelesen werden anstatt fest definiert zu sein.

**Schreibe die benötigten Funktionen und passe die Checkboxen entsprechend an.**

### 2.) Daten speichern
Bisher passiert nichts, wenn man auf "Absenden" klickt. Deine Aufgabe ist es, beim Klick auf den Button die eingegebenen Daten in der Datenbank zu sichern. Dafür ist in der Datenbank bereits die Tabelle `registered_users` angelegt. Die Daten sollen folgendermaßen gespeichert werden:
- Vorname und Nachname in den Spalten `first_name` und `last_name`
- Das Alter des Benutzers in der Spalte `age`. Denk daran dass das Formular nur das Geburtsdatum abfragt und nicht das Alter.
- Für die Fahrzeuge haben wir bewusst nichts vorgegeben. Hier musst du selbst eine Lösung finden.

**Schreibe die benötigten Funktionen und passe die Datenbank entsprechend an.**

> Wenn du das Datenbank-Schema änderst, ändere bitte auch die Datei `sql/database.sql` entsprechend, damit wir deine Änderung nachvollziehen können.

### 3.) Daten prüfen
Momentan findet keine Validierung der Daten statt, es können beliebige Eingaben gemacht werden und das Formular kann immer abgesendet werden. Normalerweise gibt es ein paar Regeln, an die sich Benutzer beim Ausfüllen von Formularen halten müssen. Hier sind ein paar:
- Vor- und Nachname, sowie Geburtsdatum sind Pflichfelder, dürfen also nicht leer sein
- Es muss mindestens ein Fahrzeug ausgewählt werden, aber höchstens fünf

Wenn eine oder mehrere der Regeln verletzt werden, muss der Benutzer darauf hingewiesen werden und die Daten dürfen nicht gespeichert werden.

**Schreibe die benötigten Funktionen**

### 4.) Die gespeicherten Daten anzeigen
Jetzt soll unter dem Formular einer Übersicht aller bisher registrierten Benutzer aus der Datenbanktabelle `registered_users` angezeigt werden, zum Beispiel als Liste oder Tabelle.

> Das Design spielt keine Rolle, aber wenn du möchstest, kannst du Foundation CSS-Framework benutzen um die Ausgabe zu stylen. Das Foundation-CSS und -JavaScript sind bereits eingebunden, die Dokumentation findest du [hier](https://foundation.zurb.com/sites/docs/).

**Schreibe die benötigten Funktionen**

### 5.) Was auch immer dir noch einfällt
**Wenn du Ideen hast, wie man dieses perfekte High-Tech-Formular noch verbessern kann, dann erklär sie uns gerne oder bau sie direkt ein.**