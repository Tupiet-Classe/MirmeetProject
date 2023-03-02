<template>

    <div class="titul">
        <h1>Perfil</h1>
    </div>
    <form class="bg-white p-6 rounded-lg">

        <div>
            <img class="img-perfil"
                src="https://profesional.semillasbatlle.com/wp-content/uploads/2020/07/semillas-oleaginosas-industriales-girasol.jpg"
                alt="">
        </div>

        <div class="mb-4">
            <label class="block font-bold mb-2">
                Nombre
            </label>
            <input class="w-full border border-gray-400 p-2 rounded-lg" type="text" name="name" required>
        </div>


        <div class="mb-4">
            <label class="block font-bold mb-2">
                Nombre del usuario
            </label>
            <input class="w-full border border-gray-400 p-2 rounded-lg" type="text" name="username" required>
        </div>


        <div class="mb-6">
            <label class="block font-bold mb-2">
                Descripción
            </label>
            <input class="w-full border border-gray-400 p-2 rounded-lg" type="text" name="bibliografy" required>
        </div>


        <div class="mb-4">
            <label class="block font-bold mb-2">
                Añadir enlace
            </label>
            <input class="w-full border border-gray-400 p-2 rounded-lg" type="text" required>
        </div>


        <div>
            <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-lg" type="submit">
                Guardar cambios
            </button>
        </div>
</form>
</template>

<style>

.img-perfil {
    width: 30%;
    border-radius: 50%;
    margin-bottom: 10%;

}

form {
    width: 70%;
    border-radius: 10px;
    margin: auto;
}

.titul {
    padding-top: 1%;
    text-align: center;
    font-weight: bold; font-size: 30px;
    background: black;
    background-clip: text;
    color: transparent;
    text-shadow: 0px 3px 3px rgba(255,255,255,0.4),0px -1px 1px rgba(0,0,0,0.3);
    }

input[type="text"],
input[type="email"],
input[type="password"] {
    width: 100%;
    padding: 5px;
    margin-top: 10px;
    border-radius: 5px;
}

input[type="submit"] {
    width: 100%;
    align-items: center;
    border-radius: 5px;
    border: none;
    background-color: #4CAF50;
    color: white;
    cursor: pointer;
}

</style>
