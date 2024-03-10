<?php
/*
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/PHPClass.php to edit this template
 */

/**
 * Description of OplataForm
 *
 * @author olive
 */
class OplataForm {

    public function oplataForm() {
        ?>
        <div class="container">
            <h1>Formularz opłaty</h1>
            <form id="buyForm" action="" method="post">
                <div class="form-group">
                    <label for="numberCard">Numer katry:</label>
                    <input type="text" id="numberCard" required>
                </div>

                <div class="form-group">
                    <label for="numberCard">CVV:</label>
                    <input type="text" id="CVV" required>
                </div>

                <div class="form-group">
                    <label for="numberCard">Data ważności:</label>
                    <input type="date" id="date" required>
                </div>

                <div>
                    <button type="submit" name="submit">Zapłać</button>
                </div>
            </form>
        </div>
        </div>
        <?php
    }
}
?>