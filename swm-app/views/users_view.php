<?php
defined('BASEPATH') OR exit('No direct script access allowed');

switch ($screen):
    case 'users':
?>
                <header class="row">
                    <div class="small-10 columns"><h2>Usuários</h2></div>
                    <div class="small-2 columns"><a class="button small" href="<?php echo base_url('index.php/users/insert'); ?>">Adicionar novo</a></div>
                </header>
                <article class="row">

                    <?php get_msg('msg'); ?>
                    <table cellspacing="0" class="sortable">
                        <thead>
                            <tr>
                                <th class="small-1">ID</th>
                                <th class="small-6">Nome</th>
                                <th class="small-5">E-mail</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $query = obj_to_array($this->users->get_users());
                            foreach ($query as $user):
                                $user_id = $this->users->get_id_by_email($user['email']);
                                echo '<tr>';
                                    echo '<td class="text-center">';
                                        echo $user_id;
                                    echo '</td>';
                                    echo '<td>';
                                        echo '<a href="'.base_url('index.php/users/edit/'.$user_id).'" title="Ver ou editar dados do usuário">';
                                        echo $user['name'];
                                        echo '</a>';
                                    echo '</td>';
                                    echo '<td>'.$user['email'].'</td>';
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
                    <div class="small-10 columns"><h2>Editar usuário</h2></div>
                    <div class="small-2 columns"><a class="button small" href="<?php echo base_url('index.php/users'); ?>">Listar todos</a></div>
                </header>
                <article class="row">

                    <?php
                    $id_user = $this->uri->segment(3);
                    echo form_open(current_url(), 'id="users-insert-form-edit" class="medium-12 large-8 columns"');
                        errors_validating();
                        get_msg('msg');
                        echo form_label('Nome');
                        $user = $this->users->get_user_by_id($id_user);
                        echo form_input(array('name'=>'name', 'placeholder'=>'Nome'), set_value('name', $user['name']), 'autofocus');
                        echo form_label('E-mail');
                        echo form_input(array('name'=>'email', 'placeholder'=>'E-mail'), set_value('email', $user['email']));
                        echo form_label('Senha <span data-tooltip aria-haspopup="true" class="has-tip top" data-disable-hover="false" tabindex="2" title="Deixe em branco para que a senha não seja alterada.">?</span>');
                        echo form_password(array('name'=>'pass', 'placeholder'=>'Senha'), set_value('pass'));
                        echo form_label('Telefone');
                        echo form_input(array('name'=>'tel', 'placeholder'=>'Telefone'), set_value('tel', (isset($user['tel'])) ? $user['tel'] : ''));
                        echo form_label('Endereço');
                        echo form_textarea(array('name'=>'address', 'placeholder'=>'Endereço', 'rows'=>'3'), set_value('address', (isset($user['address'])) ? $user['address'] : ''));
                        echo form_hidden(array('id'=>$id_user));
                        echo form_submit(array('name'=>'save', 'class'=>'button radius small'), 'Salvar');
                        echo anchor('users/delete/'.$id_user, 'Excluir usuário', array('class'=>'alert'));
                    echo form_close();
                    ?>

                </article>

<?php
        break;
    case 'insert':
?>
                <header class="row">
                    <div class="small-10 columns"><h2>Adicionar novo usuário</h2></div>
                    <div class="small-2 columns"><a class="button small" href="<?php echo base_url('index.php/users'); ?>">Listar todos</a></div>
                </header>
                <article class="row">

                    <?php
                    $id_user = $this->uri->segment(3);
                    echo form_open(current_url(), 'id="users-insert-form-edit" class="medium-12 large-8 columns"');
                        errors_validating();
                        get_msg('msg');
                        echo form_label('Nome');
                        echo form_input(array('name'=>'name', 'placeholder'=>'Nome'), set_value('name'), 'autofocus');
                        echo form_label('E-mail');
                        echo form_input(array('name'=>'email', 'placeholder'=>'E-mail'), set_value('email'));
                        echo form_label('Senha');
                        echo form_password(array('name'=>'pass', 'placeholder'=>'Senha'), set_value('pass'));
                        echo form_label('Telefone');
                        echo form_input(array('name'=>'tel', 'placeholder'=>'Telefone'), set_value('tel'));
                        echo form_label('Endereço');
                        echo form_textarea(array('name'=>'address', 'placeholder'=>'Endereço', 'rows'=>'3'), set_value('address'));
                        echo form_submit(array('name'=>'save', 'class'=>'button radius small'), 'Salvar');
                    echo form_close();
                    ?>

                </article>

<?php
        break;
endswitch;