<?php
defined('BASEPATH') OR exit('No direct script access allowed');

switch ($screen):
    case 'login':
?>
        <div class="row">
            <div id="space" class="show-for-medium small-12 columns"></div>
        </div>
        <div class="row">
            <div class="medium-6 medium-centered large-3 large-centered columns">
                <p class="text-center"><i class="fa fa-map-marker"></i><span>Simple<strong>WebMap</strong></span></p>
                <?php errors_validating();
                get_msg('msg');
                echo form_open('login', 'id="login-index-form-login"');
                    echo '<div class="row column log-in-form">';
                        echo '<label>Email';
                            echo form_input(array('name'=>'email', 'placeholder'=>'somebody@example.com'), set_value('email'), 'autofocus');
                        echo '</label>';
                        echo '<label>Password';
                            echo form_password(array('name'=>'password', 'placeholder'=>'Senha'));
                        echo '</label>';
                        echo '<small><a href="'.base_url('index.php/login/newpass').'"><i class="fa fa-key"></i> Esqueceu sua senha?</a></small>';
                        echo form_submit(array('name'=>'log', 'class'=>'button radius small'), 'Acessar');
                    echo '</div>';
                echo form_close();
                ?>
            </div>
        </div>

<?php
        break;
    case 'newpass':
?>
        <div class="row">
            <div id="space" class="show-for-medium small-12 columns"></div>
        </div>
        <div class="row">
            <div class="medium-6 medium-centered large-4 large-centered columns">
                <p class="text-center"><i class="fa fa-map-marker"></i><span>Simple<strong>WebMap</strong></span></p>
                <?php errors_validating();
                get_msg('msg');
                echo form_open('login/newpass', 'id="login-index-form-login"');
                    echo '<div class="row column log-in-form">';
                        echo '<small>Insira seu e-mail no campo abaixo que lhe enviaremos uma mensagem com uma nova senha.</small>';
                        echo '<label>Email';
                            echo form_input(array('name'=>'email', 'placeholder'=>'somebody@example.com'), set_value('email'), 'autofocus');
                        echo '</label>';
                        echo '<small><a href="'.base_url('index.php/login').'"><i class="fa fa-arrow-left"></i> Voltar para a tela de login</a></small>';
                        echo form_submit(array('name'=>'log', 'class'=>'button radius small'), 'Enviar');
                    echo '</div>';
                echo form_close();
                ?>
            </div>
        </div>

<?php
        break;
endswitch;