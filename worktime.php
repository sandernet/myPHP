<?php


?>

<!--Форма для отметки сотрудников во время прихода и ухода на работу-->

<section class="container">
    <div class="login">  
    <h1>ОТМЕТИТЬСЯ</h1>
        <p><input type="password" name="pin" value="" placeholder="Пароль"></p>
        <p class="remember_me">
            <label>
                <!-- Блок для вывода сообщений об ошибках -->
                <?php
                echo $errors['full_error'].' ';
                ?>
            </label>
        </p>
        <p class="submit"><input type="submit" name="submit" value="Ok"></p>    
	</form>
    </div>
</section>

