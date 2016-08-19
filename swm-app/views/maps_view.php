<?php
defined('BASEPATH') OR exit('No direct script access allowed');

switch ($screen):

    case 'map_unique':
?>
                <header class="row">
                    <div class="small-12 columns"><h2>Mapa</h2></div>
                </header>
                <article class="row">

                    <?php
                    $id_page = $this->uri->segment(3);
                    echo form_open_multipart(current_url(), 'id="pages-edit-form" class="medium-12 large-8 columns"');
                        errors_validating();
                        get_msg('msg');
                        echo '<h4>Geral</h4>';
                        echo form_label('Título do mapa');
                        echo form_input(array('name'=>'title', 'placeholder'=>'Título do mapa'), set_value('title'), 'autofocus');
                        echo '<h4>Aparência</h4>';
                        echo form_label('Banner topo');
                        echo '<label for="banner" class="button button-upload">Upload File</label>';
                        echo form_upload(array('name'=>'banner', 'id'=>'banner', 'class'=>"show-for-sr"), set_value('banner'));
                        echo form_label('Layout');
                        $options = array(
                            'sidebar_left'=>'Barra lateral esquerda',
                            'sidebar_right'=>'Barra lateral direita',
                            'fullscreen'=>'Tela cheia'
                            );
                        echo form_dropdown('layout', $options), set_value('layout');
                        echo form_label('Estilo');
                        $options = array(
                            'sidebar_left'=>'Azul escuro',
                            'sidebar_right'=>'Branco',
                            'fullscreen'=>'Preto'
                            );
                        echo form_dropdown('style', $options), set_value('style');
                        echo '<ul class="accordion" data-accordion data-allow-all-closed="true">';
                            echo '<li data-accordion-item>';
                                echo '<a href="#" class="accordion-title">Botões do mapa</a>';
                                echo '<div class="accordion-content" data-tab-content>';
                                    echo form_label(form_checkbox('newsletter', 'accept', TRUE).'Botões de Zoom');
                                    echo form_label(form_checkbox('newsletter', 'accept', TRUE).'Barra de Zoom');
                                    echo form_label(form_checkbox('newsletter', 'accept', TRUE).'Home');
                                    echo form_label(form_checkbox('newsletter', 'accept', TRUE).'Location');
                                    echo form_label(form_checkbox('newsletter', 'accept', TRUE).'Norte');
                                    echo form_label(form_checkbox('newsletter', 'accept', TRUE).'Informações');
                                    echo form_label(form_checkbox('newsletter', 'accept', TRUE).'Tela cheia');
                                echo '</div>';
                            echo '</li>';
                            echo '<li data-accordion-item>';
                                echo '<a href="#" class="accordion-title">Elementos do mapa</a>';
                                echo '<div class="accordion-content" data-tab-content>';
                                    echo form_label(form_checkbox('newsletter', 'accept', TRUE).'Barra de escala');
                                    echo form_label(form_checkbox('newsletter', 'accept', TRUE).'Norte');
                                    echo form_label(form_checkbox('newsletter', 'accept', TRUE).'Botões de navegação');
                                    echo form_label(form_checkbox('newsletter', 'accept', TRUE).'Visão geral');
                                    echo form_label(form_checkbox('newsletter', 'accept', TRUE).'Barra de estatus');
                                echo '</div>';
                            echo '</li>';
                            echo '<li data-accordion-item>';
                                echo '<a href="#" class="accordion-title">Elementos da interface</a>';
                                echo '<div class="accordion-content" data-tab-content>';
                                    echo form_label(form_checkbox('newsletter', 'accept', TRUE).'Título');
                                    echo form_label(form_checkbox('newsletter', 'accept', TRUE).'Banner no topo');
                                    echo form_label(form_checkbox('newsletter', 'accept', TRUE).'Rodapé');
                                    echo form_label(form_checkbox('newsletter', 'accept', TRUE).'Barra lateral');
                                    echo form_label(form_checkbox('newsletter', 'accept', TRUE).'Barra de estatus');
                                    echo form_label(form_checkbox('newsletter', 'accept', TRUE).'Menu de navegação');
                                echo '</div>';
                            echo '</li>';
                            echo '<li data-accordion-item>';
                                echo '<a href="#" class="accordion-title">Elementos do menu de navegação</a>';
                                echo '<div class="accordion-content" data-tab-content>';
                                    echo form_label(form_checkbox('newsletter', 'accept', TRUE).'Mapa base');
                                    echo form_label(form_checkbox('newsletter', 'accept', TRUE).'Pesquisa');
                                    echo form_label(form_checkbox('newsletter', 'accept', TRUE).'Páginas');
                                echo '</div>';
                            echo '</li>';
                            echo '<li data-accordion-item>';
                                echo '<a href="#" class="accordion-title">Elementos da barra lateral</a>';
                                echo '<div class="accordion-content" data-tab-content>';
                                    echo form_label(form_checkbox('newsletter', 'accept', TRUE).'Legenda');
                                    echo form_label(form_checkbox('newsletter', 'accept', TRUE).'Camadas');
                                    echo form_label(form_checkbox('newsletter', 'accept', TRUE).'Informações');
                                    echo form_label(form_checkbox('newsletter', 'accept', TRUE).'Consulta');
                                echo '</div>';
                            echo '</li>';
                        echo '</ul>';
                        echo '<h4>Base</h4>';
                            $options = array(
                            'osm'=>'Open Street Maps',
                            'osm_vector_tiles'=>'Open Street Maps - Vector tiles',
                            'google_maps'=>'Google Maps',
                            'google_satelite'=>'Google Earth',
                            'google_streets'=>'Google Streets',
                            'google_topografic'=>'Google Topografia',
                            'bing_aerial'=>'Bing Aerial',
                            'bing_road'=>'Bing Road',
                            'bing_collins'=>'Bing Collins Bart',
                            'bing_ordinance'=>'Bing Ordinance Survey'
                            );
                            echo form_dropdown('base_map', $options), set_value('style');
                        echo '<h4>Dados</h4>';
                        echo '<ul class="accordion" data-accordion data-allow-all-closed="true">';
                            echo '<li data-accordion-item>';
                                echo '<a href="#" class="accordion-title">Páginas exibidas no menu</a>';
                                echo '<div class="accordion-content" data-tab-content>';
                                    echo form_label(form_checkbox('newsletter', 'accept', TRUE).'Título da página 01');
                                    echo form_label(form_checkbox('newsletter', 'accept', TRUE).'Título da página 02');
                                echo '</div>';
                            echo '</li>';
                            echo '<li data-accordion-item>';
                                echo '<a href="#" class="accordion-title">Conteúdo da guia informações da barra lateral</a>';
                                echo '<div class="accordion-content" data-tab-content>';
                                    echo '<textarea name="content" placeholder="Conteúdo" rows="10" class="editor"></textarea>';
                                echo '</div>';
                            echo '</li>';
                        echo '</ul>';
                        echo '<h4>Camadas</h4>';
                        echo '
<select multiple="multiple" id="multiselect" class="multiselect" name="multiselect[]">
      <option value="elem_1">elem 1</option>
      <option value="elem_2">elem 2</option>
      <option value="elem_3">elem 3</option>
      <option value="elem_4">elem 4</option>
      <option value="elem_100">elem 100</option>
    </select>
                        ';
                        
                        echo form_submit(array('name'=>'save', 'class'=>'button radius small'), 'Salvar');
                    echo form_close();
                    ?>

                </article>

<?php
        break;

endswitch;