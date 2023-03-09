<!-- Codi de la pagina -->
<template>
<div style="width: 500px;">
<form class="content bg-white w-full mx-5 p-3 rounded-lg flex flex-col text-sm relative bg-white rounded-lg">

      <div>
        <img style="justify-content"  class="img-perfil" src="https://profesional.semillasbatlle.com/wp-content/uploads/2020/07/semillas-oleaginosas-industriales-girasol.jpg" alt="">
      </div>
        
        <div class="mb-4">
            <label class="block font-bold mb-2">
                Nombre
            </label>
            <input class="w-full border border-gray-400 p-2 rounded-lg" type="text"  required>
        </div>


        <div class="mb-4">
            <label class="block font-bold mb-2" for="email">
                Nombre del usuario
            </label>
            <input class="w-full border border-gray-400 p-2 rounded-lg" type="text" required>
        </div>


        <div class="mb-6">
            <label class="block font-bold mb-2">
                Descripción
            </label>
            <input class="w-full border border-gray-400 p-2 rounded-lg" type="text" required>
        </div>


        <div class="mb-4">
            <label class="block font-bold mb-2" for="email">
                Añadir enlace
            </label>
            <input class="w-full border border-gray-400 p-2 rounded-lg" type="email" id="email" name="email" required>
        </div>


        <div class="flex items-center">
            <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-lg" type="submit">
                Guardar cambios
            </button>
        </div>
    </form>
    </div>
</template>


<!-- Estils per a esta vista -->
<style scoped>
.img-perfil{
        width: 25%;
        border-radius: 50%;
    }

/* form{
        width:300px;
        padding:50px;
        border-radius:10px;
        margin:auto;
        background-color:#ccc;
    }

    .titul{
        text-align: center;
    }

    .form-container {
        display: flex;
        flex-direction: column;
        align-items: center;
        margin-top: 50px;
      }

      form {
        width: 25%;
        padding: 20px;
        background-color: #f2f2f2;
        border-radius: 10px;
      }

      input[type="text"], input[type="email"], input[type="password"] {
        width: 100%;
        padding: 10px;
        margin-top: 20px;
        border-radius: 5px;
        border: none;
      }

      input[type="submit"] {
        width: 100%;
        padding: 10px;
        margin-top: 20px;
        border-radius: 5px;
        border: none;
        background-color: #4CAF50;
        color: white;
        cursor: pointer;
      } */
</style>

<!-- Scripts per a esta vista -->
<script>

</script>
