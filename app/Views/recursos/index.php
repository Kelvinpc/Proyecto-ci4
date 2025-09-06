<?= $header; ?>

<div class="container mt-2">
  <div class="my-2">
    <h4>Lista de personas</h4>
    <a href="<?= base_url("personas/crear") ?>">Registrar</a>

  </div>

  <div class="table-responsive">
    <table class="table table-sm table-striped">
      <thead>
        <tr>
          <th>#</th>
          <th>idsubcategoria</th>
          <th>ideditorial</th>
          <th>tipo</th>
          <th>titulo</th>
          <th>apublicacion</th>
          <th>isbn</th>
          <th>numpaginas</th>
          <th>estado</th>
          <th>creado</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($recursos as $recurso): ?>
          <tr>
            <td><?= $recurso['idrecurso'] ?>  </td>
            <td><?= $recurso['idsubcategoria'] ?>        </td>
            <td><?= $recurso['ideditorial'] ?>  </td>
            <td><?= $recurso['tipo'] ?>    </td>
            <td><?= $recurso['titulo'] ?>   </td>
            <td><?= $recurso['apublicacion'] ?> </td>
            <td><?= $recurso['isbn'] ?></td>
            <td><?= $recurso['numpaginas'] ?></td>
            <td><?= $recurso['estado'] ?></td>
            <td><?= $recurso['creado'] ?></td>

            <!-- <td><?= $recurso['rutaportada'] ?></td>
            <td><?= $recurso['rutarecurso'] ?></td> -->

          </tr>
        
        <?php endforeach; ?>
      </tbody>
    </table>
  </div>

</div>

<script>
  document.addEventListener("DOMContainer")
</script>

<?= $footer; ?>


            <!-- idrecurso
            idsubcategoria
            ideditorial
            tipo
            titulo
            apublicacion
            isbn
            numpaginas
            rutaportada
            rutarecurso
            estado
            creado
            modificado -->