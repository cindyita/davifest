<script src="https://cdn.jsdelivr.net/npm/@splidejs/splide@4.1.4/dist/js/splide.min.js"></script>
<script src="./assets/js/admin.js?upd=12"></script>
<div class="p-7" x-data="guestManager()">
    
    <template x-if="msg">
        <div class="text-green-600 text-center mb-2" x-text="msg"></div>
    </template>

    <template x-if="errors">
        <div class="text-red-600 text-center mb-2" x-text="errors"></div>
    </template>
    
    <div class="p-5 bg-white rounded-lg border border-pink-300">

        <div class="flex justify-between mb-2 gap-3 flex-col md:flex-row">
            <h2 class="text-xl font-bold mb-4">Invitados del evento: <?= $_ENV['EVENT_TITLE'] ?></h2>
            <div class="flex gap-2">
                <a title="Presentación de felicitaciones">
                    <button @click="presModal.show()"
                        class="border border-pink-800 hover:bg-pink-200 text-pink-800 rounded-full px-4 transition flex items-center gap-2 py-2">
                        <svg xmlns="http://www.w3.org/2000/svg" height="20" width="22.5" viewBox="0 0 576 512"><path class="fill-pink-800" d="M64 0C28.7 0 0 28.7 0 64L0 352c0 35.3 28.7 64 64 64l176 0-10.7 32L160 448c-17.7 0-32 14.3-32 32s14.3 32 32 32l256 0c17.7 0 32-14.3 32-32s-14.3-32-32-32l-69.3 0L336 416l176 0c35.3 0 64-28.7 64-64l0-288c0-35.3-28.7-64-64-64L64 0zM512 64l0 288L64 352 64 64l448 0z"/></svg>
                    </button>
                </a>
                <form method="get" action="logout" title="Cerrar sesión">
                    <button
                        type="submit"
                        class="border border-pink-800 hover:bg-pink-700 hover:text-white text-pink-800 rounded-full px-4 transition flex items-center gap-2 py-2">
                        Logout
                    </button>
                </form>
            </div>
        </div>
        
        <div class="flex justify-between items-center gap-2">
            <div class="flex gap-2 items-center">
                <div title="Estadísticas">
                    <button @click="statsModal.show()" class="button-secondary hover:bg-pink-700 text-white rounded-full px-4 transition flex items-center gap-2 py-2">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512" width="20" height="20"><path class="fill-red-100" d="M304 240l0-223.4c0-9 7-16.6 16-16.6C443.7 0 544 100.3 544 224c0 9-7.6 16-16.6 16L304 240zM32 272C32 150.7 122.1 50.3 239 34.3c9.2-1.3 17 6.1 17 15.4L256 288 412.5 444.5c6.7 6.7 6.2 17.7-1.5 23.1C371.8 495.6 323.8 512 272 512C139.5 512 32 404.6 32 272zm526.4 16c9.3 0 16.6 7.8 15.4 17c-7.7 55.9-34.6 105.6-73.9 142.3c-6 5.6-15.4 5.2-21.2-.7L320 288l238.4 0z"/></svg>
                    </button>
                </div>
                <div class="mt-3 w-full">
                    <input
                        type="text"
                        x-model="filter"
                        class="input border border-pink-300 rounded-full focus:outline-none focus:ring-4 focus:ring-pink-300 px-3 py-2 text-sm mb-3 transition w-full"
                        placeholder="Buscar.."
                        title="Escribe un nombre o confirmación para filtrar los datos"
                    >
                </div>
            </div>
            <div title="Exportar datos a .csv">
                <button @click="exportTableToCSV('lista_invitados.csv','list-guests')" class="button-secondary text-white hover:bg-pink-700 rounded-full px-4 transition py-2">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512" width="20" height="20"><path class="fill-white" d="M0 64C0 28.7 28.7 0 64 0L224 0l0 128c0 17.7 14.3 32 32 32l128 0 0 144-208 0c-35.3 0-64 28.7-64 64l0 144-48 0c-35.3 0-64-28.7-64-64L0 64zm384 64l-128 0L256 0 384 128zM200 352l16 0c22.1 0 40 17.9 40 40l0 8c0 8.8-7.2 16-16 16s-16-7.2-16-16l0-8c0-4.4-3.6-8-8-8l-16 0c-4.4 0-8 3.6-8 8l0 80c0 4.4 3.6 8 8 8l16 0c4.4 0 8-3.6 8-8l0-8c0-8.8 7.2-16 16-16s16 7.2 16 16l0 8c0 22.1-17.9 40-40 40l-16 0c-22.1 0-40-17.9-40-40l0-80c0-22.1 17.9-40 40-40zm133.1 0l34.9 0c8.8 0 16 7.2 16 16s-7.2 16-16 16l-34.9 0c-7.2 0-13.1 5.9-13.1 13.1c0 5.2 3 9.9 7.8 12l37.4 16.6c16.3 7.2 26.8 23.4 26.8 41.2c0 24.9-20.2 45.1-45.1 45.1L304 512c-8.8 0-16-7.2-16-16s7.2-16 16-16l42.9 0c7.2 0 13.1-5.9 13.1-13.1c0-5.2-3-9.9-7.8-12l-37.4-16.6c-16.3-7.2-26.8-23.4-26.8-41.2c0-24.9 20.2-45.1 45.1-45.1zm98.9 0c8.8 0 16 7.2 16 16l0 31.6c0 23 5.5 45.6 16 66c10.5-20.3 16-42.9 16-66l0-31.6c0-8.8 7.2-16 16-16s16 7.2 16 16l0 31.6c0 34.7-10.3 68.7-29.6 97.6l-5.1 7.7c-3 4.5-8 7.1-13.3 7.1s-10.3-2.7-13.3-7.1l-5.1-7.7c-19.3-28.9-29.6-62.9-29.6-97.6l0-31.6c0-8.8 7.2-16 16-16z"/></svg>
                </button>
            </div>
        </div>
        

        <?php
            $sortDefault = '<svg width="15" height="15" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512"><path class="fill-pink-300" d="M137.4 41.4c12.5-12.5 32.8-12.5 45.3 0l128 128c9.2 9.2 11.9 22.9 6.9 34.9s-16.6 19.8-29.6 19.8L32 224c-12.9 0-24.6-7.8-29.6-19.8s-2.2-25.7 6.9-34.9l128-128zm0 429.3l-128-128c-9.2-9.2-11.9-22.9-6.9-34.9s16.6-19.8 29.6-19.8l256 0c12.9 0 24.6 7.8 29.6 19.8s2.2 25.7-6.9 34.9l-128 128c-12.5 12.5-32.8 12.5-45.3 0z"/></svg>';
            $sortUp = '<svg width="15" height="15" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512"><path class="fill-pink-300" d="M182.6 41.4c-12.5-12.5-32.8-12.5-45.3 0l-128 128c-9.2 9.2-11.9 22.9-6.9 34.9s16.6 19.8 29.6 19.8l256 0c12.9 0 24.6-7.8 29.6-19.8s2.2-25.7-6.9-34.9l-128-128z"/></svg>';
            $sortDown = '<svg width="15" height="15" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512"><path class="fill-pink-300" d="M182.6 470.6c-12.5 12.5-32.8 12.5-45.3 0l-128-128c-9.2-9.2-11.9-22.9-6.9-34.9s16.6-19.8 29.6-19.8l256 0c12.9 0 24.6 7.8 29.6 19.8s2.2 25.7-6.9 34.9l-128 128z"/></svg>';
        ?>


        <div class="relative overflow-x-auto pb-2">
            <table class="w-full text-sm text-left rtl:text-right" id="list-guests">
                <thead class="text-xs uppercase">
                    <tr>
                        <th @click="sortBy('row')" class="py-1 px-2 border border-pink-300 bg-pink-100 cursor-pointer"><span class="flex gap-1 items-center">Row <span x-html="sortColumn != 'row' ? '<?= htmlspecialchars($sortDefault, ENT_QUOTES) ?>' : (sortAsc ? '<?= htmlspecialchars($sortUp, ENT_QUOTES) ?>' : '<?= htmlspecialchars($sortDown, ENT_QUOTES) ?>')"></span></span>
                        </th>
                        <th @click="sortBy('name')" class="py-1 px-2 border border-pink-300 bg-pink-100 cursor-pointer"><span class="flex gap-1 items-center">Nombre <span x-html="sortColumn != 'name' ? '<?= htmlspecialchars($sortDefault, ENT_QUOTES) ?>' : (sortAsc ? '<?= htmlspecialchars($sortUp, ENT_QUOTES) ?>' : '<?= htmlspecialchars($sortDown, ENT_QUOTES) ?>')"></span></span></th>
                        <th @click="sortBy('confirm')" class="py-1 px-2 border border-pink-300 bg-pink-100 cursor-pointer"><span class="flex gap-1 items-center">Irá al evento <span x-html="sortColumn != 'confirm' ? '<?= htmlspecialchars($sortDefault, ENT_QUOTES) ?>' : (sortAsc ? '<?= htmlspecialchars($sortUp, ENT_QUOTES) ?>' : '<?= htmlspecialchars($sortDown, ENT_QUOTES) ?>')"></span></span></th>
                        <th class="p-2 border border-pink-300 bg-pink-100">Felicitaciones</th>
                        <th x-show="false">FELICITACIONES (Completo)</th>
                        <th class="py-1 px-2 border border-pink-300 bg-pink-100"></th>
                    </tr>
                </thead>
                <tbody>
                    <template x-for="guest in guestsFilter()" :key="guest.id">
                        <tr>
                            
                            <td class="p-2 md:table-cell font-medium border border-pink-300" x-text="guest.row">
                            </td>
                            <td class="p-2 md:table-cell font-medium border border-pink-300" x-text="guest.name">
                            </td>
                            <td class="p-2 md:table-cell border border-pink-300" x-text="guest.confirm">
                            </td>
                            <td
                            class="p-2 border border-pink-300 hover:underline">   
                                <span x-show="guest.congrats" @click="modal.show(guest.congrats, guest.name)" class="cursor-pointer" :title="guest.congrats">
                                    <span x-text="guest.congrats ? (guest.congrats.length > 24 ? guest.congrats.slice(0, 24) + '…' : guest.congrats) : ''"></span>
                                    <span class="text-pink-500 ml-1">[Ver más]</span>
                                </span>

                            </td>
                            <td x-show="false"><span x-text="guest.congrats"></span></td>
                            <td class="p-2 md:table-cell  font-medium border border-pink-300">
                                <div class="flex gap-2 items-center">
                                    <a class="cursor-pointer group" @click="confirmModal.show('¿Eliminar a ' + guest.name + '?', () => deleteGuest(guest.id))" title="Eliminar registro">
                                        <svg xmlns="http://www.w3.org/2000/svg" height="20" width="17.5" viewBox="0 0 448 512">
                                            <path
                                            class="fill-pink-500 group-hover:fill-red-500 transition-colors duration-200"
                                            d="M135.2 17.7L128 32 32 32C14.3 32 0 46.3 0 64S14.3 96 32 96l384 0c17.7 0 32-14.3 32-32s-14.3-32-32-32l-96 0-7.2-14.3C307.4 6.8 296.3 0 284.2 0L163.8 0c-12.1 0-23.2 6.8-28.6 17.7zM416 128L32 128 53.2 467c1.6 25.3 22.6 45 47.9 45l245.8 0c25.3 0 46.3-19.7 47.9-45L416 128z"
                                            />
                                        </svg>
                                    </a>

                                    <a class="cursor-pointer group" @click="editModal.show(guest.id,guest.name,guest.confirm)" title="Editar registro">
                                        <svg xmlns="http://www.w3.org/2000/svg" height="20" width="17.5" viewBox="0 0 512 512"><path class="fill-pink-500 group-hover:fill-red-500 transition-colors duration-200" d="M362.7 19.3L314.3 67.7 444.3 197.7l48.4-48.4c25-25 25-65.5 0-90.5L453.3 19.3c-25-25-65.5-25-90.5 0zm-71 71L58.6 323.5c-10.4 10.4-18 23.3-22.2 37.4L1 481.2C-1.5 489.7 .8 498.8 7 505s15.3 8.5 23.7 6.1l120.3-35.4c14.1-4.2 27-11.8 37.4-22.2L421.7 220.3 291.7 90.3z"/></svg>
                                    </a>

                                    <a class="cursor-pointer group" @click="infoModal.show(guest)" title="Información del registro">
                                        <svg xmlns="http://www.w3.org/2000/svg" height="20" width="17.5" viewBox="0 0 512 512"><path class="fill-pink-500 group-hover:fill-red-500 transition-colors duration-200" d="M256 512A256 256 0 1 0 256 0a256 256 0 1 0 0 512zM216 336l24 0 0-64-24 0c-13.3 0-24-10.7-24-24s10.7-24 24-24l48 0c13.3 0 24 10.7 24 24l0 88 8 0c13.3 0 24 10.7 24 24s-10.7 24-24 24l-80 0c-13.3 0-24-10.7-24-24s10.7-24 24-24zm40-208a32 32 0 1 1 0 64 32 32 0 1 1 0-64z"/></svg>
                                    </a>

                                </div>
                            </td>
                        </tr>
                    </template>
                </tbody>
            </table>
        </div>
    </div>


    <!----MODALS---->
    <div
        x-show="modal.open"
        @click.away="modal.open = false"
        @keydown.escape.window="modal.open = false"
        class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 z-50 p-3"
        style="display: none;"
    >
        <div class="bg-white rounded-xl shadow-xl p-6 w-full max-w-md relative">
            <button
            @click="modal.open = false"
            class="absolute top-0 right-3 text-gray-500 hover:text-red-500 text-3xl"
            >&times;</button>
            <h2 class="text-xl mb-4">🎉 Felicitación de <span x-text="modal.name"></span></h2>
            <p class="text-gray-800 whitespace-pre-line text-regular" x-text="modal.msg"></p>
        </div>
    </div>

    <div
        x-show="confirmModal.open"
        @click.away="confirmModal.open = false"
        @keydown.escape.window="confirmModal.open = false"
        class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 z-50 p-3"
        style="display: none;"
    >
        <div class="bg-white rounded-xl shadow-xl p-6 w-full max-w-sm relative">
            <button
            @click="confirmModal.open = false"
            class="absolute top-2 right-3 text-gray-500 hover:text-red-500 text-2xl"
            >&times;</button>

            <h2 class="text-lg font-semibold text-gray-800 mb-3">¿Estás segur@?</h2>
            <p class="mb-5 text-gray-700" x-text="confirmModal.msg"></p>

            <div class="flex justify-end gap-3">
                <button
                    @click="confirmModal.confirmAction()"
                    class="button text-white rounded-full px-6 transition flex items-center gap-2 py-2 bg-red-600 hover:bg-red-700"
                >Eliminar</button>
            </div>
        </div>
    </div>

    <div
        x-show="statsModal.open"
        @click.away="statsModal.open = false"
        @keydown.escape.window="statsModal.open = false"
        class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 z-50 p-3"
        style="display: none;"
    >
        <div class="bg-white rounded-xl shadow-xl p-6 w-full max-w-md relative">
            <button
            @click="statsModal.open = false"
            class="absolute top-0 right-3 text-gray-500 hover:text-red-500 text-3xl"
            >&times;</button>
            <h2 class="text-xl mb-4">Estadísticas</h2>
            <div>
                <table class="w-full text-sm text-left rtl:text-right">
                <tbody>
                    <tr>
                        <td title="Considera cualquier registro = 1">Total de registros: <span x-text="statsModal.stats.total"></span></td>
                    </tr>
                    <tr>
                        <td title="Considera Si = 1, Si+1 = 1">Total de confirmados "Si" o "Si +1": <span x-text="statsModal.stats.total_si"></span></td>
                    </tr>
                    <tr>
                        <td title="Considera No = 1">Total de confirmados "No": <span x-text="statsModal.stats.total_no"></span></td>
                    </tr>
                    <tr>
                        <td title="Considera Tal vez = 1">Total de confirmados "Tal vez": <span x-text="statsModal.stats.total_talvez"></span></td>
                    </tr>
                    <tr>
                        <td title="Considera Si = 1, Si+1 = 2">Total de asistentes al evento (Considerando a los confirmados "Si" y sus +1): <span x-text="statsModal.stats.total_guests"></span></td>
                    </tr>
                </tbody>
                </table>
            </div>
        </div>
    </div>

    <div
        x-show="editModal.open"
        @click.away="editModal.open = false"
        @keydown.escape.window="editModal.open = false"
        class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 z-50 p-3"
        style="display: none;"
    >
        <div class="bg-white rounded-xl shadow-xl p-6 w-full max-w-sm relative mx-3">
            <button
            @click="editModal.open = false"
            class="absolute top-2 right-3 text-gray-500 hover:text-red-500 text-2xl"
            >&times;</button>

            <h2 class="text-lg font-semibold text-gray-800 mb-3">Editar invitad@</h2>
            <div>
                <input
                    type="text"
                    x-model="editModal.name"
                    class="input border border-blue-300 rounded-full focus:outline-none focus:ring-4 focus:ring-blue-300 px-4 py-2 transition w-full mb-2"
                    placeholder="Nombre completo"
                    required
                >
                <div class="w-full mb-2">
                    <select
                        x-model="editModal.confirm"
                        class="input w-full border border-rose-800 rounded-full focus:outline-none focus:ring-4 focus:ring-rose-800 px-4 py-2 transition" required
                    >
                        <option hidden>SELECCIONA: ¿Asistirás a la fiesta?</option>
                        <option value="Si">Si (Asistiré a la fiesta)</option>
                        <option value="Si +1">Si +1 (Asistiré y llevaré a alguien)</option>
                        <option value="No">No (No voy a asistir)</option>
                        <option value="Tal vez">Tal vez (Aún no sé si asistiré)</option>
                    </select>
                </div>
            </div>

            <div class="flex justify-end gap-3">
                <button
                    @click="update()"
                    class="button text-white rounded-full px-6 transition flex items-center gap-2 py-2"
                >Editar</button>
            </div>
        </div>
    </div>

    <div
        x-show="presModal.open"
        @click.away="presModal.open = false"
        @keydown.escape.window="presModal.open = false"
        class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 z-50 p-5"
        style="display: none;"
    >
        <div class="bg-white rounded-xl shadow-xl p-6 w-full h-full relative" style="overflow:hidden;">
            
            <button
            @click="presModal.open = false"
            class="absolute top-2 right-3 text-pink-500 hover:text-red-500 text-2xl z-10"
            >&times;</button>

            <h2 class="text-lg font-semibold text-pink-700 mb-3 z-10">Las felicitaciones que has recibido</h2>
            <div class="w-full h-full z-10">
                <div class="w-full h-full">

                    <section class="splide slideshow" style="width:100%;height:90%;" id="splide">
                        <div class="splide__track px-10 w-full h-full">
                            <ul class="splide__list" style="width:100%;height:90%;" id="splide-list">
                            </ul>
                        </div>
                        
                    </section>

                </div>
            </div>
            
        </div>

    </div>

    <div
        x-show="infoModal.open"
        @click.away="infoModal.open = false"
        @keydown.escape.window="infoModal.open = false"
        class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 z-50 p-3"
        style="display: none;"
    >
        <div class="bg-white rounded-xl shadow-xl p-6 w-full max-w-md relative mx-3">
            
            <button
            @click="infoModal.open = false"
            class="absolute top-2 right-3 text-pink-500 hover:text-red-500 text-2xl z-10"
            >&times;</button>

            <h2 class="text-lg font-semibold text-pink-700 mb-3 z-10">Información del registro</h2>
            <div>
                <table class="w-full text-sm text-left rtl:text-right" id="list-guests">
                    <thead class="text-xs uppercase">
                        <tr>
                            <th class="py-1 px-2 border border-pink-300 bg-pink-100">Id</th>
                            <th class="py-1 px-2 border border-pink-300 bg-pink-100">Row</th>
                            <th class="py-1 px-2 border border-pink-300 bg-pink-100">Nombre</th>
                            <th class="py-1 px-2 border border-pink-300 bg-pink-100">Confirmación</th>
                            <th class="py-1 px-2 border border-pink-300 bg-pink-100">Fecha</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="p-2 md:table-cell font-medium border border-pink-300" x-text="infoModal.guest.id"></td>
                            <td class="p-2 md:table-cell font-medium border border-pink-300" x-text="infoModal.guest.row"></td>
                            <td class="p-2 md:table-cell font-medium border border-pink-300" x-text="infoModal.guest.name"></td>
                            <td class="p-2 md:table-cell font-medium border border-pink-300" x-text="infoModal.guest.confirm"></td>
                            <td class="p-2 md:table-cell font-medium border border-pink-300" x-text="infoModal.guest.date_confirm"></td>
                        </tr>
                    </tbody>
                </table>
            </div>
            
        </div>

    </div>


</div>

