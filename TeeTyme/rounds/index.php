
<?php
      if(isset($_POST['table'])) {
        // Set Table
        if ($_POST['table'] == "tt_rounds") {
            require("rounds.php");
            $table = new Rounds(
                $_POST['id'],
                $_POST['persons_id'],
                $_POST['courses_id'],
                $_POST['round_01'],
                $_POST['round_02'],
                $_POST['round_03'],
                $_POST['round_04'],
                $_POST['round_05'],
                $_POST['round_06'],
                $_POST['round_07'],
                $_POST['round_08'],
                $_POST['round_09'],
                $_POST['round_10'],
                $_POST['round_11'],
                $_POST['round_12'],
                $_POST['round_13'],
                $_POST['round_14'],
                $_POST['round_15'],
                $_POST['round_16'],
                $_POST['round_17'],
                $_POST['round_18']
            );
        }
        // Select Action
            if($_POST['action'] == "displayList"  ) $table->displayListScreen();
        elseif($_POST['action'] == "displayCreate") $table->displayCreateScreen();
        elseif($_POST['action'] == "createRecord" ) $table->createRecord();
        elseif($_POST['action'] == "displayRead"  ) $table->displayReadScreen();
        elseif($_POST['action'] == "displayUpdate") $table->displayUpdateScreen();
        elseif($_POST['action'] == "updateRecord" ) $table->updateRecord();
        elseif($_POST['action'] == "displayDelete") $table->displayDeleteScreen();
        elseif($_POST['action'] == "deleteRecord" ) $table->deleteRecord();
    }
?>
