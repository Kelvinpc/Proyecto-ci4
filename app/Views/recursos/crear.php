<?= $header; ?>

<div class="container mt-2">
  <div class="my-2">
    <h4>Registrar nuevo recurso</h4>
    <a href="<?= base_url("personas/index"); ?>">Volver</a>
    <button id="toast" type="button">Mostrar toast</button>
  </div>


  <form method="POST" action="guardar_recurso.php">
        <div class="row g-3">
          <!-- TITULO -->
          <div class="col-md-6">
            <label class="form-label">Título</label>
            <input type="text" name="titulo" class="form-control" required>
          </div>

          <!-- TIPO -->
          <div class="col-md-6">
            <label class="form-label">Tipo</label>
            <select name="tipo" class="form-select" required>
              <option value="">Seleccione...</option>
              <option value="Físico">Físico</option>
              <option value="Digital">Digital</option>
            </select>
          </div>

          <!-- PUBLICACION -->
          <div class="col-md-4">
            <label class="form-label">Año de Publicación</label>
            <input type="number" name="apublicacion" class="form-control" min="1900" max="2099" required>
          </div>

          <!-- ISBN -->
          <div class="col-md-4">
            <label class="form-label">ISBN</label>
            <input type="text" name="isbn" class="form-control" required>
          </div>

          <!-- N° PAGINAS -->
          <div class="col-md-4">
            <label class="form-label">N° Páginas</label>
            <input type="number" name="numpaginas" class="form-control" min="1" required>
          </div>

          <!-- ESTADO -->
          <div class="col-md-6">
            <label class="form-label">Estado</label>
            <select name="estado" class="form-select" required>
              <option value="">Seleccione...</option>
              <option value="Bueno">Bueno</option>
              <option value="Regular">Regular</option>
              <option value="Malo">Malo</option>
            </select>

          </div>

          <!-- CREADO (fecha actual por defecto) -->
          <div class="col-md-6">
            <label class="form-label">Creado</label>
            <input type="datetime-local" name="creado" class="form-control" value="<?= date('Y-m-d\TH:i') ?>" required>
          </div>

          <!-- CATEGORIA -->
          <div class="col-md-4">
            <label class="form-label">Categoría</label>
            <select name="categoria" id="categoria" class="form-select" required>
                <option value="">Seleccione</option>
                <?php foreach ($categorias as $categoria):  ?>
                  <option value="<?=$categoria['idcategoria'] ?>"><?=$categoria['categoria']?></option>
                <?php endforeach; ?>
            </select>
          </div>

          <!-- SUBCATEGORIA -->
          <div class="col-md-4">
            <label class="form-label">Subcategoría</label>
            <select name="subcategoria" id="subcategoria" class="form-select" ></select>

          </div>

          <!-- EDITORIAL -->
          <div class="col-md-4">
            <label class="form-label">Editorial</label>
            <input type="text" name="editorial" class="form-control" required>
          </div>

          <!-- NACIONALIDAD -->
          <div class="col-md-6">
            <label class="form-label">Nacionalidad</label>
            <input type="text" name="nacionalidad" class="form-control" required>
          </div>
        </div>

        <!-- BOTONES -->
        <div class="mt-4 text-end">
          <button type="reset" class="btn btn-secondary">Cancelar</button>
          <button type="submit" class="btn btn-primary">Guardar</button>
        </div>
      </form>

</div>

<script>
document.addEventListener("DOMContentLoaded", () => {
  const categoria = document.querySelector("#categoria");
  const subcategoria = document.querySelector("#subcategoria");

  categoria.addEventListener("change", async () => {
    const idcategoria = categoria.value.trim();

    if (!idcategoria) {
      subcategoria.innerHTML = `<option value=''>Seleccione</option>`;
      return;
    }

    try {
        const response = await fetch(`http://biblioteca.test:8080/subcategorias/porcategoria/${idcategoria}`, {
        method: "GET",
        headers: { "Content-Type": "application/json" }
        });

      if (!response.ok) throw new Error("Error en la solicitud al servidor");

      const data = await response.json();

      if (data.length) {
        subcategoria.innerHTML = `<option value=''>Seleccione</option>`;
        data.forEach(element => {
          subcategoria.innerHTML += `<option value='${element.idsubcategoria}'>${element.subcategoria}</option>`;
        });
      } else {
        subcategoria.innerHTML = `<option value=''>No hay subcategorías</option>`;
      }
    } catch (error) {
      console.error(error);
      subcategoria.innerHTML = `<option value=''>Error al cargar</option>`;
    }
  });
});
</script>



<?= $footer; ?>