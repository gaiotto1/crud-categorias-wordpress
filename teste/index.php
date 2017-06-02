<?php get_header();?>

<?php
    $sucesso = 0;
    $erro = 0;
    $msg = '';
    $acao = '';

    //CADASTRAR
    if($_POST['cadastrar'] == "Cadastrar"){
      $categoria = trim(@$_POST['categoria']);
      //INSERE UM TERMO EM UMA TAXONOMIA
      if(trim(@$_POST['categoria']) !== ''){
        wp_insert_term($categoria, 'categoria-redes-sociais');
        $sucesso = 1;
        $msg = "Categoria inserida com sucesso!";
      }else{
        $erro = 1;
        $msg = "Falha ao cadastrar! O campo Nome da categoria não pode ser vazio.";
      }
    }

    //ALTERAR
    if($_POST['alterar'] == "Alterar"){
      $idCategoria = $_POST['id-categoria'];
      $nameCategoria = $_POST['name-categoria'];
      $acao = 'alterar';
    }

    if($_POST['update-categoria'] == "Alterar"){
      $acao = 'alterar';

      $idCategoria = $_POST['id-categoria'];
      $categoria = trim(@$_POST['categoria']);

      if(trim(@$_POST['categoria']) !== ''){
        Wp_update_term ($idCategoria, 'categoria-redes-sociais', array(
          'name' => $categoria
        ));
        $sucesso = 1;
        $msg = "Categoria alterada com sucesso!";
        $acao = '';
      }else{
        $erro = 1;
        $msg = "Falha ao alterar! O campo Nome da categoria não pode ser vazio.";
      }
    }

    //EXCLUIR
    if($_POST['excluir'] == "Excluir"){
      $acao = '';
      $idCategoria = $_POST['id-categoria'];
      $nomeCategoria = $_POST['name-categoria'];
      wp_delete_term( $idCategoria, 'categoria-redes-sociais');
      $sucesso = 1;
      $msg = "A Categoria " .$nomeCategoria. " foi excluida com sucesso!";
    }

    //BUSCA OS TERMOS CADASTRADOS
    $categories = get_terms( 'categoria-redes-sociais', array(
      'orderby'    => 'count',
      'hide_empty' => 0,
    ));
 ?>

<section class="conteudo">
  <?php if($sucesso == 1){?>
      <div class="alert alert-success" role="alert"><?php echo $msg; ?></div>
  <?php } ?>

  <?php if($erro == 1){?>
    <div class="alert alert-danger" role="alert"><?php echo $msg; ?></div>
  <?php } ?>


  <?php if($acao == ''){?>

    <h2>Cadastro de categorias</h2>
    <form method="post" class="form-cadastro">
      <div class="form-group">
        <label for="exampleInputEmail1">Nome da categoria:</label>
        <input type="text" class="form-control" name="categoria" placeholder="Ex: Facebook" required>
      </div>
      <button type="submit" class="btn btn-default" name="cadastrar" value="Cadastrar">Cadastrar</button>
    </form>

  <?php }else{?>

    <h2>Alterar categorias</h2>
    <form method="post" class="form-cadastro">
      <div class="form-group">
        <label for="exampleInputEmail1">Nome da categoria:</label>
        <input type="text" class="form-control" name="categoria" value="<?php echo $nameCategoria ?>" required>
        <input type="hidden" class="form-control" name="id-categoria" value="<?php echo $idCategoria ?>">
      </div>
      <button type="submit" class="btn btn-default" name="update-categoria" value="Alterar">Alterar</button>
    </form>

  <?php } ?>



  <div class="list-group">
    <?php if ( ! empty( $categories ) && ! is_wp_error( $categories ) ){ ?>

    <a href="#" class="list-group-item active">
      Editar categorias
    </a>

    <?php
      foreach ( $categories as $term ) {
    ?>
      <a href="#" class="list-group-item"><?php echo $term->name; ?>

          <span class="pull-right">
            <form  method="post">
              <button class="btn btn-primary" type="submit" name="alterar" value="Alterar">Alterar</button>
              <input type="hidden" name="id-categoria" value="<?php echo $term->term_id; ?>">
              <input type="hidden" name="name-categoria" value="<?php echo $term->name; ?>">
              <button class="btn btn-danger" type="submit" name="excluir" value="Excluir">Excluir</button>
            </form>

          </span>

      </a>
    <?php
      }
    }
    ?>

  </div>

</section>

<?php get_footer();?>
