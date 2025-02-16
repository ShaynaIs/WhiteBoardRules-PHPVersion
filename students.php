<?php
$title = "Students";
include "header.php";

// Connect to the database
$dbhost = '127.0.0.1';
$dbuser = 'root';
$dbpass = '';
$dbname = 'white_board_rules';
$connection = new mysqli($dbhost, $dbuser, $dbpass, $dbname);

// Check for connection errors
if ($connection->connect_error) {
    die("Connection failed: " . $connection->connect_error);
}

// Retrieve subjects from the database
$subjects_result = $connection->query("SELECT subject_id, subject_name FROM subjects"); ?>

<h2>Students</h2>
<form action='view_students.php' method='get' id='gradeForm'>
    <label for='subject_id'>Select Subject:</label>
    <select onchange="document.forms[0].selected_subject_name.value = jQuery('#subject_id>option:selected')[0].innerText;" name='subject_id' id='subject_id' required>

        <?php
        while ($row = $subjects_result->fetch_assoc()) {
            echo "<option value='{$row['subject_id']}'>{$row['subject_name']}</option>";
        }
        ?>
    </select><br>
    <input id="selected_subject_name" name="subject_name" value='Math' type="hidden" />
    <input type='submit' value='View Students' class='btn'>
</form>

<?php
// Close the database connection
$connection->close();


include "footer.php";
?>