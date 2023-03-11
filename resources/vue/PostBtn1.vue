<template>
    <div>
        <button class="hidden sm:block absolute bottom-0 right-0 p-3 bg-red rounded-lg px-3 py-2 m-4 text-lg"
            @click.prevent="openModal"><i class="fa fa-add text-white"></i></button>
    </div>
    <div id="default-modal" tabindex="-1" aria-hidden="true"
        class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-modal md:h-full">
        <div class="relative w-full h-full max-w-2xl md:h-auto">
            <!-- Modal content -->
            <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                <!-- Modal header -->
                <div class="flex items-start justify-between p-4 border-b rounded-t dark:border-gray-600">
                    <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                        Edit
                    </h3>
                    <button type="button"
                        class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-600 dark:hover:text-white"
                        @click="closeModal">
                        <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"
                            xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd"
                                d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                                clip-rule="evenodd"></path>
                        </svg>
                        <span class="sr-only">Close modal</span>
                    </button>
                </div>
                <!-- Modal body -->
                <div class="p-6 space-y-6">
                    <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Getionado
                        por</label>
                    <ul
                        class="items-center w-full text-sm font-medium text-gray-900 bg-white border border-gray-200 rounded-lg sm:flex dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                        <li class="w-full border-b border-gray-200 sm:border-b-0 sm:border-r dark:border-gray-600">
                            <div class="flex items-center px-3">
                                <input id="horizontal-list-radio-si" type="radio" value="Me aconseja Pymeralia"
                                    name="si-radio"
                                    class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                                <label for="horizontal-list-radio-si"
                                    class="w-full py-3 ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">Pymeralia
                                </label>
                            </div>
                        </li>
                        <li class="w-full border-b border-gray-200 sm:border-b-0 sm:border-r dark:border-gray-600">
                            <div class="flex items-center px-3">
                                <input id="horizontal-list-radio-si-no" type="radio" value="Me lo gestiono yo"
                                    name="si-no-radio"
                                    class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                                <label for="horizontal-list-radio-si-no"
                                    class="w-full py-3 ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">Yo
                                    mismo</label>
                            </div>
                        </li>
                        <li class="w-full border-b border-gray-200 sm:border-b-0 sm:border-r dark:border-gray-600">
                            <div class="flex items-center px-3">
                                <input id="horizontal-list-radio-no" type="radio" value="No aceptada" name="no-radio"
                                    class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                                <label for="horizontal-list-radio-no"
                                    class="w-full py-3 ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">No
                                    realizar la tarea</label>
                            </div>
                        </li>
                    </ul>
                </div>
                <!-- Modal footer -->
                <div class="flex items-center p-6 space-x-2 border-t border-gray-200 rounded-b dark:border-gray-600">
                    <button type="submit"
                        class="w-full text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Edit
                    </button>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import { Modal } from 'flowbite';
import axios from 'axios';
import swal from 'sweetalert';

export default {
    mounted() {
        const options = {
            placement: 'center',
            backdrop: false,
            backdropClasses: false,
            closable: true,
            onHide: () => {
                console.log('modal is hidden');
            },
            onShow: () => {
                console.log('modal is shown');
            },
            onToggle: () => {
                console.log('modal has been toggled');
            }
        };
        this.targetEl = document.getElementById('default-modal');
        this.modal = new Modal(this.targetEl, options);

    },
    data() {
        return {
            url: 'all-data',
            title: '',
            targetEl: null,
            modal: null,
        }
    },
    methods: {
        keydown: function (e) {
            console.log(e)
        },

        isLetter(e) {
            let char = String.fromCharCode(e.keyCode); // Get the character
            if (/^[A-Za-z0-9?¿ ]+$/.test(char)) return true; // Match with regex 
            else e.preventDefault(); // If not match, don't add to input text
        },

        isNUMBER(e) {
            let char = String.fromCharCode(e.keyCode); // Get the character
            if (/^[0-9,]+$/.test(char)) return true; // Match with regex 
            else e.preventDefault(); // If not match, don't add to input text
        },
        closeModal() {
            this.modal.hide();
        },
        
        openModal() {
            this.modal.show();
        },
    }
}
</script>
