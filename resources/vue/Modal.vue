<template>
  <div class="fixed flex justify-center z-10 inset-0 overflow-y-auto overflow-y-auto md:flex md:items-center md:justify-center" :class="{ 'hidden': !isOpen }">
    <div class="flex items-center justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
      <div class="fixed inset-0 transition-opacity" aria-hidden="true">
        <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
      </div>

      <div
        class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full"
        role="dialog" aria-modal="true" aria-labelledby="modal-headline">

        <!-- Contenido del modal -->
        <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
          <slot></slot>
        </div>

        <!-- Botones del modal
        <div class="bg-gray-50 px-4 py-3 sm:px-6 w-full justify-between sm:flex sm:flex-row-reverse">
          <button type="button" class="flex justify-start bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-full"
            @click="closeModal()">
            Compartir
          </button>
          <button type="button" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-full"
            @click="closeModal()">
            Cancelar
          </button>
        </div> -->
      </div>
    </div>
  </div>
</template>

<script>
export default {
  props: {
    isOpen: {
      type: Boolean,
      required: true
    }
  },
  methods: {
    closeModal() {
      this.$emit('update:isOpen', false)
    }
  }
}
</script>
