      <?php
      if (isset($_GET['brand'])){
      switch($_GET['brand']){
      case 'Audi' :
      echo "A3-1;A4-2;A6-3;A8-4";
      break;
      case 'BMW' :
      echo "320-1;520-2;630-3;745-4";
      break;
      case 'Mercedes' :
      echo "A180-1;C200-2;E320-3;S500-4";
      break;
      case 'Lexus' :
      echo "IS200-1;GS300-2;LS600-3";
      break;
      }
      }
      ?>
