<?php
defined('BASEPATH') OR exit('No direct script access allowed');

switch ($screen):
    case 'settings':
?>
                <header class="row">
                    <div class="small-10 columns"><h2>Editar usuário</h2></div>
                    <div class="small-2 columns"><a class="button small" href="<?php echo base_url('index.php/users'); ?>">Listar todos</a></div>
                </header>
                <article class="row">

                    <?php
                    $id_user = $this->uri->segment(3);
                    echo form_open(current_url(), 'id="settings-form" class="medium-12 large-8 columns"');
                        errors_validating();
                        get_msg('msg');
                        echo form_label('Título do site');
                        $user = array();
                        echo form_input(array('name'=>'title_site', 'placeholder'=>'Título do site'), set_value('title_site', get_setting('title_site')), 'autofocus');
                        echo form_label('Descrição do site');
                        echo form_textarea(array('name'=>'description_site', 'placeholder'=>'Descrição do site', 'rows'=>'3'), set_value('description_site', get_setting('description_site')));
                        echo form_label('Método do site');
                        $method_options=array('0'=>'Vários mapas', '1'=>'Mapa único');
                        echo form_dropdown('method', $method_options, get_setting('method'));
                        echo form_submit(array('name'=>'save', 'class'=>'button small'), 'Salvar');
                    echo form_close();
                    ?>

                </article>

<?php
        break;
endswitch;