<?= $header;?>



<div class="container mt-2">
  <div class="my-2">
    <h4>Buscador de Libros</h4>
    <a href="<?= base_url("libros"); ?>" class="btn btn-primary">Listar</a>
  </div>

  <form action="action" autocomplete="off">
    <div class="mb-2">
      <label for="id">Ingrese el ID del Libro</label>
      <div class="form-group">
        <input type="text" class="form-control" name="id" id="id" autofocus>
        <br>
        <button type="button" id="buscar" class="btn btn-success">Buscar</button>
      </div>
    </div>
    <div class="mb-2">
      <label for="nombre">Nombre Del Libro</label>
      <input type="text" class="form-control" name="nombre" id="nombre">
    </div>
    <img src="" alt="" id="portada">
  </form>
</div>


<script>
document.addEventListener("DOMContentLoaded", () => {
    const id= document.querySelector("#id");
    const nombre= document.querySelector("#nombre");
    const buscar= document.querySelector("#buscar");
    const portada= document.querySelector("#portada");

    buscar.addEventListener("click",async()=>{
      if(!id.value){
        alert("Debe ingresar un Id");
        return;
      }
      try{
        const response = await fetch('http://biblioteca.test/public/api/buscarlibro', {
          method: 'POST',
          headers: {
            "Content-Type": "application/json"
          },
          body: JSON.stringify({id: id.value})
        })
        if(!response.ok){
          throw new Error("Error en la solicitud")
        }

        const data = await response.json()

        if(data.success){
          nombre.value = data.nombre
          portada.setAttribute("src", `http://biblioteca.test/uploads/${data.imagen}`);
        }else{
          nombre.value =``
          portada.setAttribute("src", ``);
          console.log(data.mensaje);
        }

      }catch(error){
        console.error("Error:", error);
      }
    })
  })
</script>


