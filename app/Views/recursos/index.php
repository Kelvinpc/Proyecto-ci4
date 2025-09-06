<?= $header; ?>

<div class="container mt-2">
  <div class="my-2">
    <h4>Lista de recursos</h4>
    <a href="<?= base_url("recursos/crear") ?>">Registrar</a>

  </div>

  <div class="table-responsive">
    <table class="table table-striped w-380">
      <thead>
          <tr>
            <!-- <th>rutaportada</th> -->
            <!-- <th>rutarecurso</th> -->

          <th style="width:18%;">TITULO</th>
          <th style="width:7%;">TIPO</th>
          <th style="width:6%;">PUBLICACIÓN</th>
          <th style="width:10%;">ISBN</th>
          <th style="width:7%;">N° PAGINAS</th>
          <th style="width:7%;">ESTADO</th>
          <th style="width:10%;">CREADO</th>
          <th style="width:9%;">CATEGORIA</th>
          <th style="width:9%;">SUBCATEGORIA</th>
          <th style="width:10%;">EDITORIAL</th>
          <th style="width:7%;">NACIONALIDAD</th>

        </tr>
      </thead>
      <tbody>
        <?php foreach ($recursos as $recurso): ?>
          <tr>
            <!-- <td><?= $recurso['idrecurso'] ?>  </td> -->
            <!-- <td><?= $recurso['rutaportada']      ?></td> -->
            <!-- <td><?= $recurso['rutarecurso']      ?></td> -->

            <td class="text-start"><?= $recurso['titulo'] ?></td>
            <td class="text-center"><?= $recurso['tipo'] ?></td>
            <td class="text-center"><?= $recurso['apublicacion'] ?></td>
            <td class="text-center"><?= $recurso['isbn'] ?></td>
            <td class="text-center"><?= $recurso['numpaginas'] ?></td>
            <td class="text-center"><?= $recurso['estado'] ?></td>
            <td class="text-center"><?= $recurso['creado'] ?></td>
            <td class="text-center"><?= $recurso['categoria'] ?></td>
            <td class="text-center"><?= $recurso['subcategoria'] ?></td>
            <td class="text-center"><?= $recurso['editorial'] ?></td>
            <td class="text-center"><?= $recurso['nacionalidad'] ?></td>

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

            <!-- CREATE VIEW mostrar_recursos AS
	SELECT 
	RE.idrecurso,
	RE.tipo,
	RE.titulo,
	RE.apublicacion,
	RE.isbn,
	RE.numpaginas,
	RE.rutaportada,
	RE.rutarecurso,
	RE.estado,
	RE.creado,
	CA.categoria,
	SC.subcategoria,
	ED.editorial,
	ED.nacionalidad	
	FROM recursos AS RE
	INNER JOIN subcategorias SC
		ON SC.idsubcategoria = RE.idsubcategoria
	INNER JOIN categorias CA
		ON CA.idcategoria = SC.idcategoria
	INNER JOIN editoriales ED
		ON ED.ideditorial = RE.ideditorial; -->