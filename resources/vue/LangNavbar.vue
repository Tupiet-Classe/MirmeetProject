<template>
  <nav class="bg-white border-gray-200 dark:bg-gray-900 fixed w-full z-10 top-0">
    <div class="max-w-screen-xl flex flex-wrap items-center justify-between mx-auto px-2">
      <div class="hidden w-full md:block md:w-auto" id="navbar-default">
        {{ currentLocale }}
        <ul class="font-medium flex flex-col px-2 md:p-0 mt-2 border border-gray-100 rounded-lg bg-gray-100 md:flex-row md:space-x-4 md:mt-0 md:border-0 md:bg-white dark:bg-gray-800 md:dark:bg-gray-900 justify-end">
          <li>
            <button @click="setLocale('en')" class="language-button block py-2 pl-3 pr-4 text-gray-900 rounded hover:bg-gray-100 md:hover:bg-transparent md:border-0 md:hover:text-blue-700 md:p-0 dark:text-white md:dark:hover:text-blue-500 dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent text-xs">
              EN |
            </button>
          </li>
          <li class="mx-2">
            <button @click="setLocale('es')" class="language-button block py-2 pl-3 pr-4 text-gray-900 rounded hover:bg-gray-100 md:hover:bg-transparent md:border-0 md:hover:text-blue-700 md:p-0 dark:text-white md:dark:hover:text-blue-500 dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent text-xs">
              ES |
            </button>
          </li>
          <li class="mx-2">
            <button @click="setLocale('ca')" class="language-button block py-2 pl-3 pr-4 text-gray-900 rounded hover:bg-gray-100 md:hover:bg-transparent md:border-0 md:hover:text-blue-700 md:p-0 dark:text-white md:dark:hover:text-blue-500 dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent text-xs">
              CA
            </button>
          </li>
        </ul>
      </div>
    </div>
  </nav>
  
  
  
</template>

<script>
export default {
  name: 'LangNavbar',
  data() {
    return {
      currentLocale: '',
    };
  },
  mounted() {
  if (this.$root.$i18n) {
    this.currentLocale = this.$root.$i18n.locale;
  }
},

methods: {
  async setLocale(locale) {
    this.currentLocale = locale;
    if (this.$root.$i18n) {
      this.$root.$i18n.locale = locale;
    }
    window.location.href = `/language/${locale}`;
  },
},
}
</script>

<style>
  /* Añadir un margen superior a los elementos que siguen después del nav */
  .page-content {
    margin-top: 5px; /* Ajustar el valor según sea necesario */
  }
</style>
