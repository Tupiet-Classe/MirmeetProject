<!-- Codi de la pagina -->
<template>
    <div style="width: 500px;">
        <form class="content bg-white w-full mx-5 p-3 rounded-lg flex flex-col text-sm relative bg-white rounded-lg">
            <div style="width: 500px;">
                <div style="display: inline-block;">
                    <img class="img-perfil"
                        src="https://profesional.semillasbatlle.com/wp-content/uploads/2020/07/semillas-oleaginosas-industriales-girasol.jpg"
                        alt="">
                </div>
                <div style="display: inline-block; text-align:">
                    <div class="contador" style="display:inline-block; padding-right: 30px; padding-left: 50px;">
                        <h2>Publicaciones</h2>
                        <p>57</p>
                    </div>
                    <div class="contador" style="display: inline-block; padding-right: 30px;">
                        <h2>Seguidores</h2>
                        <p>512</p>
                    </div>
                    <div class="contador" style="display: inline-block;">
                        <h2>Siguiendo</h2>
                        <p>247</p>
                    </div>
                </div>
            </div>

            <div class="mb-4">
                <label class="block font-bold mb-2">
                    Nombre
                </label>
                <input class="w-full border border-gray-400 p-2 rounded-lg" type="text" required>
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
.img-perfil {
    width: 30%;
    border-radius: 50%;
}

.contador {
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
    margin-bottom: 10%;
    margin-top: 10%;
}

.contador h2 {
    margin: 0;
    font-size: 18px;
    font-weight: bold;
}

.contador p {
    margin: 0;
    font-size: 16px;
    font-weight: bold;
}
</style>

<!-- Scripts per a esta vista -->
<script>

</script>
