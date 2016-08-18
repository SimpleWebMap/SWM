<?php
defined('BASEPATH') OR exit('No direct script access allowed');

switch ($screen):
    case 'pages':
?>
                <header class="row">
                    <div class="small-10 columns"><h2>Páginas</h2></div>
                    <div class="small-2 columns"><a class="button small" href="<?php echo base_url('index.php/pages/insert'); ?>">Adicionar nova</a></div>
                </header>
                <article class="row">
                    <?php get_msg('msg'); ?>
                    <table cellspacing="0" class="sortable">
                        <thead>
                            <tr>
                                <th class="small-1">ID</th>
                                <th class="small-4">Título</th>
                                <th class="small-4">Autor</th>
                                <th class="small-3">Data de criação</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $query = obj_to_array($this->pages->get_pages());
                            foreach ($query as $page):
                                $page_id = $this->pages->get_id_by_slug($page['slug']);
                                echo '<tr>';
                                    echo '<td class="text-center">';
                                        echo $page_id;
                                    echo '</td>';
                                    echo '<td>';
                                        echo '<a href="'.base_url('index.php/pages/edit/'.$page_id).'" title="Ver ou editar dados da página">';
                                        echo $page['title'];
                                        echo '</a>';
                                    echo '</td>';
                                    $id_user = $page['author'];
                                    $user = $this->users->get_user_by_id($id_user);
                                    echo '<td>'.$user['name'].'</td>';
                                    echo '<td>'.$page['date'].'</td>';
                                echo '</tr>';
                            endforeach;                            
                            ?> 
                        </tbody>
                    </table>
                    
                    <div id="pager" class="pager small-8 columns">
                        <form>
                            <span>registros</span>
                            <select class="pagesize">
                                <option selected="selected"  value="10">10</option>
                                <option value="20">20</option>
                                <option value="30">30</option>
                                <option  value="40">40</option>
                            </select>
                            <span>Exibir</span>
                            <span>
                                <i class="fa fa-fast-backward first"></i>
                                <i class="fa fa-backward prev"></i>
                                <input type="text" class="pagedisplay" style="display:block;" />
                                <i class="fa fa-forward next"></i>
                                <i class="fa fa-fast-forward last"></i>
                            </span>
                        </form>
                    </div>

                </article>

<?php
        break;
    case 'edit':
?>
                <header class="row">
                    <div class="small-10 columns"><h2>Editar página</h2></div>
                    <div class="small-2 columns"><a class="button small" href="<?php echo base_url('index.php/pages'); ?>">Listar todas</a></div>
                </header>
                <article class="row">

                    <?php
                    $id_page = $this->uri->segment(3);
                    echo form_open(current_url(), 'id="pages-edit-form" class="medium-12 large-12 columns"');
                        errors_validating();
                        get_msg('msg');
                        echo form_label('Nome');
                        $page = $this->pages->get_page_by_id($id_page);
                        echo form_input(array('name'=>'title', 'placeholder'=>'Título da página'), set_value('title', $page['title']), 'autofocus');
                        echo form_textarea(array('name'=>'content', 'placeholder'=>'Conteúdo', 'rows'=>'15', 'class'=>'editor'), set_value('content', $page['content']));
                        echo form_submit(array('name'=>'save', 'class'=>'button radius small'), 'Salvar');
                    echo form_close();
                    ?>

                </article>

<?php
        break;
    case 'insert':
?>
                <header class="row">
                    <div class="small-10 columns"><h2>Adicionar nova página</h2></div>
                    <div class="small-2 columns"><a class="button small" href="<?php echo base_url('index.php/pages'); ?>">Listar todos</a></div>
                </header>
                <article class="row">

                    <?php
                    $id_user = $this->uri->segment(3);
                    echo form_open(current_url(), 'id="pages-insert" class="medium-12 columns"');
                        errors_validating();
                        get_msg('msg');
                        echo form_input(array('name'=>'title', 'placeholder'=>'Título da página'), set_value('title'), 'autofocus');
                        echo form_textarea(array('name'=>'content', 'placeholder'=>'Conteúdo', 'rows'=>'15', 'class'=>'editor'), set_value('content'));
                        echo form_submit(array('name'=>'save', 'class'=>'button radius small'), 'Publicar');
                    echo form_close();
                    ?>

                </article>

<?php
        break;
endswitch;