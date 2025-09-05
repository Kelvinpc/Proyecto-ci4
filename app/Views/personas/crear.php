<?= $header; ?>

<div class="container mt-2">
  <div class="my-2">
    <h4>Registrar nueva persona</h4>
    <a href="<?= base_url("personas/index"); ?>">Volver</a>
    <button id="toast" type="button">Mostrar toast</button>
  </div>


  <form method="POST" id="form-personas" action="<?= base_url('personas/guardar') ?>" enctype="multipart/form-data">
    <div class="card">
      <div class="card-body">
        <div class="mb-2">
          <label for="">Buscando por DNI</label><small class="d-none" id="searching" ></small>
          <div class="input-group">
          <input type="text" class="form-control" id="dni" name="dni" maxlength="8" >
          <button class="btn btn-outline-success" type="button" id="buscar-dni">Buscar</button>

          </div>
        </div>
        


        

        <div class="row">
          <div class="col-mb-6 mb-2">
            <label for="apellidos">Apellidos</label>
            <input type="text" class="form-control" id="apellidos" name="apellidos" required>
          </div>
          <div class="col-mb-6 mb-2">
            <label for="nombres">Nombres</label>
            <input type="text" class="form-control" id="nombres" name="nombres" required>
          </div>
        </div>

        <div class="row g-2">
          <div class="col-md-4 mb-2">
            <label for="telefono">Teléfono</label>
            <input type="text" class="form-control" id="telefono" name="telefono"  maxlength="9" pattern="[0-9]*" required>
          </div>
          <div class="col-md-8 mb-2">
            <label for="direccion">Dirección</label>
            <input type="text" class="form-control" id="direccion" required>
          </div>
        </div>

        <div class="row g-2">
          <div class="col-md-4 mb-2">
            <label for="departamentos">Departamentos</label>
            <select name="departamentos" id="departamentos" class="form-select" >
              <option value="">Seleccione</option>
              <?php foreach ($departamentos as $departamento):  ?>
                <option value=" <?= $departamento['iddepartamento'] ?>"> <?= $departamento['departamento']?></option>
              <?php endforeach; ?>
              </select>
          </div>
          <div class="col-md-4 mb-2">
            <label for="provincias">Provincias</label>
            <select name="provincias" id="provincias" class="form-select" ></select>
          </div>
          <div class="col-md-4 mb-2">
            <label for="distritos">Distritos</label>
            <select name="iddistrito" id="distritos" class="form-select" ></select>
          </div>
        </div>

        

      
      <div class="card-footer text-end">
        <button type="reset" class="btn btn-sm btn-outline-secondary">Cancelar</button>
        <button type="submit" class="btn btn-sm btn-primary">Guardar</button>
      </div>
    </div>
  </form>

</div>

<script>
  document.addEventListener("DOMContentLoaded", () => {
    const formulario = document.querySelector("#form-personas");

    const botonBusqueda = document.querySelector("#buscar-dni");
    const apellidos = document.querySelector("#apellidos");
    const nombres = document.querySelector("#nombres");
    const dni = document.querySelector("#dni");
    const telefono = document.querySelector("#telefono");
    const buscando = document.querySelector("#searching");

    // Ubigeo
    const departamentos = document.querySelector("#departamentos");
    const provincias = document.querySelector("#provincias");
    const distritos = document.querySelector("#distritos");

    function showToast(message= ``){

      swal.fire({
        text: 'No encontrado',
        showConfirmButton:false,
        icon:'info',
        toast:true,
        position:'top-end',
        timer:3000,
        timerProgressBar:true,
        background:'#FF5F00',
        iconColor:'#FFF',
        color:'#FFF'

      })
    }

    


    departamentos.addEventListener('change', async () => {
      const iddepartamento = departamentos.value.trim();  // Eliminar espacios al principio y al final

      if (!iddepartamento) {
        provincias.innerHTML = `<option value=''>Seleccione</option>`;
        distritos.innerHTML = `<option value=''>Seleccione</option>`;
        return;
      }

      try {
        const response = await fetch(`http://biblioteca.test/api/ubigeo/provincias/${iddepartamento}`, {
          method: 'GET',
          headers: { 'Content-Type': 'application/json' }
        });

        if (!response.ok) {
          throw new Error('Error en la solicitud al servidor');
        }

        const data = await response.json();
        if (data.length) {
          provincias.innerHTML = `<option value=''>Seleccione</option>`;
          data.forEach(provincia => {
            provincias.innerHTML += `<option value='${provincia.idprovincia}'>${provincia.provincia}</option>`;
          });
        }
      } catch (error) {
        console.error(error);
      }
    });

    provincias.addEventListener('change', async () => {
      const idprovincia = provincias.value.trim();  // Eliminar espacios al principio y al final

      if (!idprovincia) {
        distritos.innerHTML = `<option value=''>Seleccione</option>`;
        return;
      }

      try {
        const response = await fetch(`http://biblioteca.test/api/ubigeo/distritos/${idprovincia}`, {
          method: 'GET',
          headers: { 'Content-Type': 'application/json' }
        });

        if (!response.ok) {
          throw new Error('Error en la solicitud al servidor');
        }

        const data = await response.json();
        if (data.length) {
          distritos.innerHTML = `<option value=''>Seleccione</option>`;
          data.forEach(distrito => {
            distritos.innerHTML += `<option value='${distrito.iddistrito}'>${distrito.distrito}</option>`;
          });
        }
      } catch (error) {
        console.error(error);
      }
    });

    // Función para buscar persona por DNI
    async function buscarAPI() {
      if (!dni.value) {
        alert('Escriba el DNI');
        return;
      }

      try {
        buscando.classList.remove("d-none");
        const response = await fetch(`http://biblioteca.test/api/personas/buscardni/${dni.value}`, {
          method: 'GET',
          headers: { 'Content-type': 'application/json' }
        });

        if (!response.ok) {
          throw new Error('Error en la solicitud');
        }

        const data = await response.json();
        buscando.classList.add("d-none");

        if (data.success) {
          apellidos.value = `${data.Apellidomaterno} ${data.Apellidomaterno}`;
          nombres.value = data.Nombres;
          telefono.focus();

        } else {
          showToast('No encontramos datos ');
          dni.focus();
          apellidos.value = '';
          nombres.value = '';
        }

        console.log(data);

      } catch (error) {
        console.log(error);
      }
    }

    // Escuchar el evento 'Enter' para llamar a la función buscarAPI
    dni.addEventListener('keydown', (event) => {
      if (event.key === 'Enter') {
        buscarAPI();  // Llama a la función buscarAPI cuando el usuario presiona "Enter"
      }
    });

    // Configuración de SweetAlert2
    Swal.fire({
      title: "Registrar persona",
      icon: "question",
      iconHtml: "؟",  // Puede ser cualquier ícono de SweetAlert2 o un HTML personalizado
      confirmButtonText: "Guardar",
      cancelButtonText: "Cancelar",
      showCancelButton: true,
      showCloseButton: true
    }).then((result) => {
      if (result.isConfirmed) {

      } 
    });
  });
</script>


<?= $footer; ?>