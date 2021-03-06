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
                    $id_map = ($this->uri->segment(3) != NULL) ? $this->uri->segment(3) : '0';
                    $map = $this->maps->get_map_by_id($id_map);
                    echo form_open(current_url(), 'id="pages-edit-form" class="medium-12 large-8 columns"');
                        errors_validating();
                        get_msg('msg');
                        echo '<h4>Geral</h4>';
                        echo form_label('Título do mapa');
                        echo form_input(array('name'=>'title', 'placeholder'=>'Título do mapa'), set_value('title', $map['title']), 'autofocus');
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
                            echo form_dropdown('base_map', $options, set_value('base_map', $map['base_map']));
                        echo '<h4>Dados</h4>';
                        echo '<ul class="accordion" data-accordion data-allow-all-closed="true">';
                            echo '<li data-accordion-item>';
                                echo '<a href="#" class="accordion-title">Páginas exibidas no menu</a>';
                                echo '<div class="accordion-content" data-tab-content>';
                                    echo '<select multiple="multiple" id="pages" class="multiselect" name="pages[]">';
                                        $pages = obj_to_array($this->pages->get_pages());
                                        foreach($pages as $page):
                                            echo '<option value="'.$this->pages->get_id_by_slug($page['slug']).'">'.$page['title'].'</option>';
                                        endforeach;
                                    echo'</select>';
                                echo '</div>';
                            echo '</li>';
                            echo '<li data-accordion-item>';
                                echo '<a href="#" class="accordion-title">Conteúdo da guia informações da barra lateral</a>';
                                echo '<div class="accordion-content" data-tab-content>';
                                    echo '<textarea name="content" placeholder="Conteúdo" rows="10" class="editor">'.set_value('content', $map['content']).'</textarea>';
                                echo '</div>';
                            echo '</li>';
                        echo '</ul>';
                        echo '<h4>Camadas</h4>';
                        echo '
                            <select multiple="multiple" id="multiselect" class="multiselect" name="layers[]">
                                <option value="elem_1">elem 1</option>
                                <option value="elem_2">elem 2</option>
                                <option value="elem_3">elem 3</option>
                                <option value="elem_4">elem 4</option>
                                <option value="elem_100">elem 100</option>
                            </select>
                        ';

                        echo '<h4>Aparência</h4>';
                        echo form_label('Banner topo');
                        echo '<label for="banner" class="button button-upload">Upload File</label>';
                        echo form_upload(array('name'=>'banner', 'id'=>'banner', 'class'=>"show-for-sr"), set_value('banner', $map['banner']));
                        echo form_label('Layout');
                        $options = array(
                            'sidebar_left'=>'Barra lateral esquerda',
                            'sidebar_right'=>'Barra lateral direita',
                            'fullscreen'=>'Tela cheia'
                            );
                        echo form_dropdown('layout', $options, set_value('layout', $map['layout']));
                        echo form_label('Estilo');
                        $options = array(
                            'dark_blue'=>'Azul escuro',
                            'light'=>'Branco',
                            'dark'=>'Preto'
                            );
                        echo form_dropdown('style', $options, set_value('style', $map['style']));
                        echo '<ul class="accordion" data-accordion data-allow-all-closed="true">';
                            echo '<li data-accordion-item>';
                                echo '<a href="#" class="accordion-title">Botões do mapa</a>';
                                echo '<div class="accordion-content" data-tab-content>';
                                    echo form_label(form_checkbox('btn_buttons_zoom', '1', ($map['btn_buttons_zoom'] == '1') ? TRUE : FALSE).'Botões de Zoom');
                                    echo form_label(form_checkbox('btn_slider_zoom', '1', ($map['btn_slider_zoom'] == '1') ? TRUE : FALSE).'Barra de Zoom');
                                    echo form_label(form_checkbox('btn_button_extend', '1', ($map['btn_button_extend'] == '1') ? TRUE : FALSE).'Extensão inicial do mapa');
                                    echo form_label(form_checkbox('btn_button_geolocation', '1', ($map['btn_button_geolocation'] == '1') ? TRUE : FALSE).'Location');
                                    echo form_label(form_checkbox('btn_button_north', '1', ($map['btn_button_north'] == '1') ? TRUE : FALSE).'Norte');
                                    echo form_label(form_checkbox('btn_button_info', '1', ($map['btn_button_info'] == '1') ? TRUE : FALSE).'Informações');
                                    echo form_label(form_checkbox('btn_button_fullscreen', '1', ($map['btn_button_fullscreen'] == '1') ? TRUE : FALSE).'Tela cheia');
                                echo '</div>';
                            echo '</li>';
                            echo '<li data-accordion-item>';
                                echo '<a href="#" class="accordion-title">Elementos do mapa</a>';
                                echo '<div class="accordion-content" data-tab-content>';
                                    echo form_label(form_checkbox('elm_bar_scale', '1', ($map['elm_bar_scale'] == '1') ? TRUE : FALSE).'Barra de escala');
                                    echo form_label(form_checkbox('elm_north', '1', ($map['elm_north'] == '1') ? TRUE : FALSE).'Norte');
                                    echo form_label(form_checkbox('elm_buttons_navigation', '1', ($map['elm_buttons_navigation'] == '1') ? TRUE : FALSE).'Botões de navegação');
                                    echo form_label(form_checkbox('elm_overview', '1', ($map['elm_overview'] == '1') ? TRUE : FALSE).'Visão geral');
                                    echo form_label(form_checkbox('elm_bar_status', '1', ($map['elm_bar_status'] == '1') ? TRUE : FALSE).'Barra de estatus');
                                echo '</div>';
                            echo '</li>';
                            echo '<li data-accordion-item>';
                                echo '<a href="#" class="accordion-title">Elementos da interface</a>';
                                echo '<div class="accordion-content" data-tab-content>';
                                    echo form_label(form_checkbox('eli_title', '1', ($map['eli_title'] == '1') ? TRUE : FALSE).'Título');
                                    echo form_label(form_checkbox('eli_banner', '1', ($map['eli_banner'] == '1') ? TRUE : FALSE).'Banner no topo');
                                    echo form_label(form_checkbox('eli_footer', '1', ($map['eli_footer'] == '1') ? TRUE : FALSE).'Rodapé');
                                    echo form_label(form_checkbox('eli_siderbar', '1', ($map['eli_siderbar'] == '1') ? TRUE : FALSE).'Barra lateral');
                                    echo form_label(form_checkbox('eli_statusbar', '1', ($map['eli_statusbar'] == '1') ? TRUE : FALSE).'Barra de estatus');
                                    echo form_label(form_checkbox('eli_menu', '1', ($map['eli_menu'] == '1') ? TRUE : FALSE).'Menu de navegação');
                                echo '</div>';
                            echo '</li>';
                            echo '<li data-accordion-item>';
                                echo '<a href="#" class="accordion-title">Elementos do menu de navegação</a>';
                                echo '<div class="accordion-content" data-tab-content>';
                                    echo form_label(form_checkbox('eln_basemap', '1', ($map['eln_basemap'] == '1') ? TRUE : FALSE).'Mapa base');
                                    echo form_label(form_checkbox('eln_search', '1', ($map['eln_search'] == '1') ? TRUE : FALSE).'Pesquisa');
                                    echo form_label(form_checkbox('eln_pages', '1', ($map['eln_pages'] == '1') ? TRUE : FALSE).'Páginas');
                                echo '</div>';
                            echo '</li>';
                            echo '<li data-accordion-item>';
                                echo '<a href="#" class="accordion-title">Elementos da barra lateral</a>';
                                echo '<div class="accordion-content" data-tab-content>';
                                    echo form_label(form_checkbox('els_legend', '1', ($map['els_legend'] == '1') ? TRUE : FALSE).'Legenda');
                                    echo form_label(form_checkbox('els_layers', '1', ($map['els_layers'] == '1') ? TRUE : FALSE).'Camadas');
                                    echo form_label(form_checkbox('els_info', '1', ($map['els_info'] == '1') ? TRUE : FALSE).'Informações');
                                    echo form_label(form_checkbox('els_filters', '1', ($map['els_filters'] == '1') ? TRUE : FALSE).'Consulta');
                                echo '</div>';
                            echo '</li>';
                        echo '</ul>';
                        echo form_submit(array('name'=>'save', 'class'=>'button small'), 'Salvar');
                    echo form_close();
                    ?>

                </article>

<?php
        break;

endswitch;