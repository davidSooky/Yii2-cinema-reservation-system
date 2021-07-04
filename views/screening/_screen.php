<?php

use yii\bootstrap4\ActiveForm;

$isGuest = Yii::$app->user->isGuest;
$form = ActiveForm::begin();

function reservationCheck($value, $isGuest, $reservedSeats) {
  $seatReserved = in_array($value, $reservedSeats);
  if(!$isGuest && $seatReserved) {
    return "disabled checked";
  } else if (!$isGuest ) {
    return "disabled";
  } else if ($isGuest && $seatReserved) {
    return "disabled";
  }
}

?>

<div class="form-group">
    <?php
      if ($isGuest) {
        echo $this->render("//ticket/_form.php", ["tickets" => $tickets ?? null, "form" => $form]);
      }
    ?>
</div>
<h4 class="my-2"><?= $isGuest ? "Select your seats" : ""?></h4>

<table class="table reservations <?= $isGuest ? "" : "admin"?>" id="reservations-table">
  <thead>
    <tr>
    <th scope="col"></th>
      <th scope="col">A</th>
      <th scope="col">B</th>
      <th scope="col">C</th>
      <th scope="col">D</th>
      <th scope="col">E</th>
      <th scope="col">F</th>
      <th scope="col">G</th>
      <th scope="col">H</th>
      <th scope="col">I</th>
      <th scope="col">J</th>
      <th scope="col">K</th>
      <th scope="col">L</th>
      <th scope="col">M</th>
      <th scope="col">N</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <th scope="row">4</th>
      <td>
        <input type="checkbox" name="seats[]" id="A4" value="A4" <?= reservationCheck("A4", $isGuest, $reservedSeats) ?>>
        <label for="A4">27</label>
      </td>
      <td>
        <input type="checkbox" name="seats[]" id="B4" value="B4" <?= reservationCheck("B4", $isGuest, $reservedSeats) ?>>
        <label for="B4">28</label>
      </td>
      <td>
        <input type="checkbox" name="seats[]" id="C4" value="C4" <?= reservationCheck("C4", $isGuest, $reservedSeats) ?>>
        <label for="C4">29</label>
      </td>
      <td>
        <input type="checkbox" name="seats[]" id="D4" value="D4" <?= reservationCheck("D4", $isGuest, $reservedSeats) ?>>
        <label for="D4">30</label>
      </td>
      <td>
        <input type="checkbox" name="seats[]" id="E4" value="E4" <?= reservationCheck("E4", $isGuest, $reservedSeats) ?>>
        <label for="E4">31</label>
      </td>
      <td>
        <input type="checkbox" name="seats[]" id="F4" value="F4" <?= reservationCheck("F4", $isGuest, $reservedSeats) ?>>
        <label for="F4">32</label>
      </td>
      <td>
        <input type="checkbox" name="seats[]" id="G4" value="G4" <?= reservationCheck("G4", $isGuest, $reservedSeats) ?>>
        <label for="G4">33</label>
      </td>
      <td>
        <input type="checkbox" name="seats[]" id="H4" value="H4" <?= reservationCheck("H4", $isGuest, $reservedSeats) ?>>
        <label for="H4">34</label>
      </td>
      <td>
        <input type="checkbox" name="seats[]" id="I4" value="I4" <?= reservationCheck("I4", $isGuest, $reservedSeats) ?>>
        <label for="I4">35</label>
      </td>
      <td>
        <input type="checkbox" name="seats[]" id="J4" value="J4" <?= reservationCheck("J4", $isGuest, $reservedSeats) ?>>
        <label for="J4">36</label>
      </td>
      <td>
        <input type="checkbox" name="seats[]" id="K4" value="K4" <?= reservationCheck("K4", $isGuest, $reservedSeats) ?>>
        <label for="K4">37</label>
      </td>
      <td>
        <input type="checkbox" name="seats[]" id="L4" value="L4" <?= reservationCheck("L4", $isGuest, $reservedSeats) ?>>
        <label for="L4">38</label>
      </td>
      <td>
        <input type="checkbox" name="seats[]" id="M4" value="M4" <?= reservationCheck("M4", $isGuest, $reservedSeats) ?>>
        <label for="M4">39</label>
      </td>
      <td>
        <input type="checkbox" name="seats[]" id="N4" value="N4" <?= reservationCheck("N4", $isGuest, $reservedSeats) ?>>
        <label for="N4">40</label>
      </td>
    </tr>
    <tr>
      <th scope="row">3</th>
      <td>
        <input type="checkbox" name="seats[]" id="A3" value="A3" <?= reservationCheck("A3", $isGuest, $reservedSeats) ?>>
        <label for="A3">13</label>
      </td>
      <td>
        <input type="checkbox" name="seats[]" id="B3" value="B3" <?= reservationCheck("B3", $isGuest, $reservedSeats) ?>>
        <label for="B3">14</label>
      </td>
      <td>
        <input type="checkbox" name="seats[]" id="C3" value="C3" <?= reservationCheck("C3", $isGuest, $reservedSeats) ?>>
        <label for="C3">15</label>
      </td>
      <td>
        <input type="checkbox" name="seats[]" id="D3" value="D3" <?= reservationCheck("D3", $isGuest, $reservedSeats) ?>>
        <label for="D3">16</label>
      </td>
      <td>
        <input type="checkbox" name="seats[]" id="E3" value="E3" <?= reservationCheck("E3", $isGuest, $reservedSeats) ?>>
        <label for="E3">17</label>
      </td>
      <td>
        <input type="checkbox" name="seats[]" id="F3" value="F3" <?= reservationCheck("F3", $isGuest, $reservedSeats) ?>>
        <label for="F3">18</label>
      </td>
      <td>
        <input type="checkbox" name="seats[]" id="G3" value="G3" <?= reservationCheck("G3", $isGuest, $reservedSeats) ?>>
        <label for="G3">19</label>
      </td>
      <td>
        <input type="checkbox" name="seats[]" id="H3" value="H3" <?= reservationCheck("H3", $isGuest, $reservedSeats) ?>>
        <label for="H3">20</label>
      </td>
      <td>
        <input type="checkbox" name="seats[]" id="I3" value="I3" <?= reservationCheck("I3", $isGuest, $reservedSeats) ?>>
        <label for="I3">21</label>
      </td>
      <td>
        <input type="checkbox" name="seats[]" id="J3" value="J3" <?= reservationCheck("J3", $isGuest, $reservedSeats) ?>>
        <label for="J3">22</label>
      </td>
      <td>
        <input type="checkbox" name="seats[]" id="K3" value="K3" <?= reservationCheck("K3", $isGuest, $reservedSeats) ?>>
        <label for="K3">23</label>
      </td>
      <td>
        <input type="checkbox" name="seats[]" id="L3" value="L3" <?= reservationCheck("L3", $isGuest, $reservedSeats) ?>>
        <label for="L3">24</label>
      </td>
      <td>
        <input type="checkbox" name="seats[]" id="M3" value="M3" <?= reservationCheck("M3", $isGuest, $reservedSeats) ?>>
        <label for="M3">25</label>
      </td>
      <td>
        <input type="checkbox" name="seats[]" id="N3" value="N3" <?= reservationCheck("N3", $isGuest, $reservedSeats) ?>>
        <label for="N3">26</label>
      </td>
    </tr>
    <tr>
      <th scope="row">2</th>
      <td></td>
      <td></td>
      <td></td>
      <td></td>
      <td>
        <input type="checkbox" name="seats[]" id="E2" value="E2" <?= reservationCheck("E2", $isGuest, $reservedSeats) ?>>
        <label for="E2">7</label>
      </td>
      <td>
        <input type="checkbox" name="seats[]" id="F2" value="F2" <?= reservationCheck("F2", $isGuest, $reservedSeats) ?>>
        <label for="F2">8</label>
      </td>
      <td>
        <input type="checkbox" name="seats[]" id="G2" value="G2" <?= reservationCheck("G2", $isGuest, $reservedSeats) ?>>
        <label for="G2">9</label>
      </td>
      <td>
        <input type="checkbox" name="seats[]" id="H2" value="H2" <?= reservationCheck("H2", $isGuest, $reservedSeats) ?>>
        <label for="H2">10</label>
      </td>
      <td>
        <input type="checkbox" name="seats[]" id="I2" value="I2" <?= reservationCheck("I2", $isGuest, $reservedSeats) ?>>
        <label for="I2">11</label>
      </td>
      <td>
        <input type="checkbox" name="seats[]" id="J2" value="J2" <?= reservationCheck("J2", $isGuest, $reservedSeats) ?>>
        <label for="J2">12</label>
      </td>
      <td></td>
      <td></td>
      <td></td>
      <td></td>
    </tr>
    <tr>
      <th scope="row">1</th>
      <td></td>
      <td></td>
      <td></td>
      <td></td>
      <td>
        <input type="checkbox" name="seats[]" id="E1" value="E1" <?= reservationCheck("E1", $isGuest, $reservedSeats) ?>>
        <label for="E1">1</label>
      </td>
      <td>
        <input type="checkbox" name="seats[]" id="F1" value="F1" <?= reservationCheck("F1", $isGuest, $reservedSeats) ?>>
        <label for="F1">2</label>
      </td>
      <td>
        <input type="checkbox" name="seats[]" id="G1" value="G1" <?= reservationCheck("G1", $isGuest, $reservedSeats) ?>>
        <label for="G1">3</label>
      </td>
      <td>
        <input type="checkbox" name="seats[]" id="H1" value="H1" <?= reservationCheck("H1", $isGuest, $reservedSeats) ?>>
        <label for="H1">4</label>
      </td>
      <td>
        <input type="checkbox" name="seats[]" id="I1" value="I1" <?= reservationCheck("I1", $isGuest, $reservedSeats) ?>>
        <label for="I1">5</label>
      </td>
      <td>
        <input type="checkbox" name="seats[]" id="J1" value="J1" <?= reservationCheck("J1", $isGuest, $reservedSeats) ?>>
        <label for="J1">6</label>
      </td>
      <td></td>
      <td></td>
      <td></td>
      <td></td>
    </tr>
  </tbody>
</table>

<?php ActiveForm::end(); ?>