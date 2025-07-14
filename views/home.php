<script src="./assets/js/form.js?upd=4"></script>
<div class="py-2">
  <div class="min-h-screen flex items-center justify-center px-4">
    <div class="max-w-xl w-full p-8" x-data="homeManager()" x-init="form.idguest = <?= $idInvite ?? 'null' ?>;">
      <div class="text-center font-bold text-xl animate__animated animate__fadeIn">
        <h1 class="text-3xl"><?= EVENT_SUBTITLE ?></h1>
      </div>
      <div class="flex justify-center py-3 animate__animated animate__flipInY">
        <img src="./assets/img/title.png" alt="Mis 27 años David" class="logo">
      </div>

      <?php
        $start = date('Ymd', strtotime(EVENT_DAY));
        $end = date('Ymd', strtotime(EVENT_DAY . ' +1 day'));

        $googleUrl = "https://calendar.google.com/calendar/render?action=TEMPLATE"
            . "&text=" . urlencode(EVENT_TITLE)
            . "&dates={$start}/{$end}"
            . "&details=" . urlencode(EVENT_DESCRIPTION)
            . "&location=" . urlencode(EVENT_LOCATION);
      ?>
      <div class="flex justify-start items-center flex-col pt-5">

        <div class="flex items-end">

          <a class="cursor-pointer group" target="_blank" href="<?= $googleUrl ?>" title="Agregar evento a calendar">
            <div class="diamond">
              <span class="text flex flex-col items-center justify-center text-2xl">
                <span class="text-red-100">SÁB</span><br />
                <span class="text-red-100">19 DE</span>
                <span class="text-red-100">JULIO</span>
              </span>
            </div>
          </a>

          <div class="ps-10">
            <div class="diamond diamond-outline ms-10">
              <span class="text flex flex-col items-center justify-center text-1xl">
                <span class="text-pink-800">Estás invitad@</span><br />
                <span class="text-pink-800">a mi fiesta</span>
                <span class="text-pink-800">(y despedida)</span>
              </span>
            </div>
          </div>
        
        </div>

        <div style="margin-top:-20px">
          <div class="diamond">
            <span class="text flex flex-col items-center justify-center text-1xl">
              <span class="text-red-100 text-center">Santo Tomás</span><br />
              <span class="text-red-100 text-center">de Aquino #4418</span>
              <span class="text-red-100 text-center">Col. Camino Real</span>
            </span>
          </div>
        </div>
        

      </div>
      

      <div 
        x-data="countdown('<?= EVENT_DAY . 'T' . EVENT_START; ?>')" 
        x-init="startCountdown()" 
        class="text-center text-lg font-semibold text-gray-700 animate__animated animate__fadeInUp"
      >
        <div class="flex justify-center items-center gap-10 text-2xl mt-4 flex-col md:flex-row pt-6 md:pt-1">

          <div class="flex flex-row gap-10">
            <div class="diamond diamond-sm py-2 px-4">
              <span class="text">
                <span x-text="days" class="text-2sl text-red-100"></span>
                <div class="text-sm text-red-100">días</div>
              </span>
            
            </div>
            <div class="diamond diamond-outline diamond-sm py-2 px-4">
              <span class="text">
                <span x-text="hours" class="text-pink-800"> class="text-2sl"</span>
                <div class="text-sm text-pink-800">horas</div>
              </span>
            </div>
          </div>

          <div class="flex flex-row gap-10">
            <div class="diamond diamond-sm py-2 px-4">
              <span class="text">
                <span x-text="minutes" class="text-2sl text-red-100"></span>
                <div class="text-sm text-red-100">min</div>
              </span>
            </div>
            <div class="diamond diamond-outline diamond-sm py-2 px-4">
              <span class="text">
                <span x-text="seconds" class="text-2sl text-pink-800"></span>
                <div class="text-sm text-pink-800">seg</div>
              </span>
            </div>
          </div>
          
        </div>

      </div>

      <div class="animate__animated animate__fadeInUp pt-10">
        <p class="text-center text-md py-4"><?= EVENT_DESCRIPTION ?></p>
      </div>

      <div class="pt-5 mb-2 text-center">
        <h1 class="text-4xl">Puntos a considerar:</h1>
      </div>

      <div class="py-4 text-start w-full flex flex-col gap-5 items-start justify-center">
        <div class="flex gap-2 items-center animate__animated animate__flipInX">
          <span>
            <span class="diamond diamond-xsm"></span>
          </span>
          <span class="text-rose-800 ps-3">Cada año suelo comprar comida y bebida. Este año espero repetir la costumbre.</span>
        </div>
        <div class="flex gap-2 items-center animate__animated animate__flipInX">
          <span>
            <span class="diamond diamond-xsm"></span>
          </span>
          <span class="text-rose-800 ps-3">Confirmar asistencia en la encuesta de WhatsApp.</span>
        </div>
        <div class="flex gap-2 items-center animate__animated animate__flipInX">
          <span>
            <span class="diamond diamond-xsm"></span>
          </span>
          <span class="text-rose-800 ps-3">Se permite invitar un +1 con previo aviso.</span>
        </div>
      </div>

      <div class="pt-5 mb-2 text-center">
        <h1 class="text-4xl">No está permitido:</h1>
      </div>

      <div class="py-4 text-start w-full flex flex-col gap-5 items-start justify-center">
        <div class="flex gap-2 items-center animate__animated animate__flipInX">
          <span>
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 384 512" width="20" height="20"><path class="fill-pink-800" d="M342.6 150.6c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0L192 210.7 86.6 105.4c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3L146.7 256 41.4 361.4c-12.5 12.5-12.5 32.8 0 45.3s32.8 12.5 45.3 0L192 301.3 297.4 406.6c12.5 12.5 32.8 12.5 45.3 0s12.5-32.8 0-45.3L237.3 256 342.6 150.6z"/></svg>
          </span>
          <span class="text-rose-800 ps-3">Mala copear.</span>
        </div>
        <div class="flex gap-2 items-center animate__animated animate__flipInX">
          <span>
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 384 512" width="20" height="20"><path class="fill-pink-800" d="M342.6 150.6c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0L192 210.7 86.6 105.4c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3L146.7 256 41.4 361.4c-12.5 12.5-12.5 32.8 0 45.3s32.8 12.5 45.3 0L192 301.3 297.4 406.6c12.5 12.5 32.8 12.5 45.3 0s12.5-32.8 0-45.3L237.3 256 342.6 150.6z"/></svg>
          </span>
          <span class="text-rose-800 ps-3">Subir al segundo piso.</span>
        </div>
        <div class="flex gap-2 items-center animate__animated animate__flipInX">
          <span>
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 384 512" width="20" height="20"><path class="fill-pink-800" d="M342.6 150.6c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0L192 210.7 86.6 105.4c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3L146.7 256 41.4 361.4c-12.5 12.5-12.5 32.8 0 45.3s32.8 12.5 45.3 0L192 301.3 297.4 406.6c12.5 12.5 32.8 12.5 45.3 0s12.5-32.8 0-45.3L237.3 256 342.6 150.6z"/></svg>
          </span>
          <span class="text-rose-800 ps-3">Cancelar tu asistencia el día del festejo.</span>
        </div>
      </div>

      <div class="pt-5 mb-2 text-center">
        <h1 class="text-4xl">Si está permitido:</h1>
      </div>

      <div class="py-4 text-start w-full flex flex-col gap-5 items-start justify-center">
        <div class="flex gap-2 items-center animate__animated animate__flipInX">
          <span>
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 384 512" width="20" height="20"><path class="fill-pink-800" d="M438.6 105.4c12.5 12.5 12.5 32.8 0 45.3l-256 256c-12.5 12.5-32.8 12.5-45.3 0l-128-128c-12.5-12.5-12.5-32.8 0-45.3s32.8-12.5 45.3 0L160 338.7 393.4 105.4c12.5-12.5 32.8-12.5 45.3 0z"/></svg>
          </span>
          <span class="text-rose-800 ps-3">Invitar a +1 [No más]</span>
        </div>
        <div class="flex gap-2 items-center animate__animated animate__flipInX">
          <span>
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 384 512" width="20" height="20"><path class="fill-pink-800" d="M438.6 105.4c12.5 12.5 12.5 32.8 0 45.3l-256 256c-12.5 12.5-32.8 12.5-45.3 0l-128-128c-12.5-12.5-12.5-32.8 0-45.3s32.8-12.5 45.3 0L160 338.7 393.4 105.4c12.5-12.5 32.8-12.5 45.3 0z"/></svg>
          </span>
          <span class="text-rose-800 ps-3">Llevar botanitas y algo de tomar.</span>
        </div>
        <div class="flex gap-2 items-center animate__animated animate__flipInX">
          <span>
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 384 512" width="20" height="20"><path class="fill-pink-800" d="M438.6 105.4c12.5 12.5 12.5 32.8 0 45.3l-256 256c-12.5 12.5-32.8 12.5-45.3 0l-128-128c-12.5-12.5-12.5-32.8 0-45.3s32.8-12.5 45.3 0L160 338.7 393.4 105.4c12.5-12.5 32.8-12.5 45.3 0z"/></svg>
          </span>
          <span class="text-rose-800 ps-3">Disfrutar el día con gente que conoces y conmigo.</span>
        </div>
      </div>

      <div class="flex justify-center py-5">
        <div class="diamond diamond-sm2"></div>
      </div>

    <div class="flex justify-center">
          <a href="https://chat.whatsapp.com/JSsq2CS22wzEQ138dh8qec" target="_blank"><button class="button text-red-50 hover:bg-pink-700 rounded-full px-6 py-2 transition flex items-center gap-2 text-center gap-3 my-5">
            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-whatsapp" viewBox="0 0 16 16">
            <path class="fill-red-100" d="M13.601 2.326A7.85 7.85 0 0 0 7.994 0C3.627 0 .068 3.558.064 7.926c0 1.399.366 2.76 1.057 3.965L0 16l4.204-1.102a7.9 7.9 0 0 0 3.79.965h.004c4.368 0 7.926-3.558 7.93-7.93A7.9 7.9 0 0 0 13.6 2.326zM7.994 14.521a6.6 6.6 0 0 1-3.356-.92l-.24-.144-2.494.654.666-2.433-.156-.251a6.56 6.56 0 0 1-1.007-3.505c0-3.626 2.957-6.584 6.591-6.584a6.56 6.56 0 0 1 4.66 1.931 6.56 6.56 0 0 1 1.928 4.66c-.004 3.639-2.961 6.592-6.592 6.592m3.615-4.934c-.197-.099-1.17-.578-1.353-.646-.182-.065-.315-.099-.445.099-.133.197-.513.646-.627.775-.114.133-.232.148-.43.05-.197-.1-.836-.308-1.592-.985-.59-.525-.985-1.175-1.103-1.372-.114-.198-.011-.304.088-.403.087-.088.197-.232.296-.346.1-.114.133-.198.198-.33.065-.134.034-.248-.015-.347-.05-.099-.445-1.076-.612-1.47-.16-.389-.323-.335-.445-.34-.114-.007-.247-.007-.38-.007a.73.73 0 0 0-.529.247c-.182.198-.691.677-.691 1.654s.71 1.916.81 2.049c.098.133 1.394 2.132 3.383 2.992.47.205.84.326 1.129.418.475.152.904.129 1.246.08.38-.058 1.171-.48 1.338-.943.164-.464.164-.86.114-.943-.049-.084-.182-.133-.38-.232"/>
          </svg>
          <h2 class="text-lg text-red-100">Entra al grupo de WhatsApp</h2>
        </button></a>
    </div>

    <div class="flex justify-center py-5 mb-5">
      <div class="diamond diamond-sm2"></div>
    </div>


      <div class="text-center animate__animated animate__fadeIn">
        <h2 class="text-2xl mb-4">Envía felicitaciones:</h2>
        <form @submit.prevent="submitForm" class="max-w-md mx-auto py-3">

          <template x-if="loading">
              <div class="text-rose-800 text-center mb-2">Cargando..</div>
          </template>

        <template x-if="msg">
            <div class="text-green-600 text-center mb-2" x-text="msg"></div>
        </template>

        <template x-if="errors">
            <div class="text-red-600 text-center mb-2" x-text="errors"></div>
        </template>

          <div class="mb-4">
            <input
                type="text"
                x-model="form.name"
                class="input border border-rose-800 rounded-full focus:outline-none focus:ring-4 focus:ring-rose-800 px-4 py-2 transition w-full mb-2"
                placeholder="Tu nombre"
                required
            >
          </div>

          <div class="mb-4">
            <textarea x-model="form.congrats"
              class="input w-full border border-rose-800 rounded-full focus:outline-none focus:ring-4 focus:ring-rose-800 px-4 py-2 transition" required
              placeholder="Tus felicitaciones para David"></textarea>
          </div>

          <div class="flex gap-3 w-full flex-col md:flex-row">

            <div class="w-full">
              <select
                x-model="form.confirm"
                class="input w-full border border-rose-800 rounded-full focus:outline-none focus:ring-4 focus:ring-rose-800 px-4 py-2 transition" required
              >
                <option hidden>SELECCIONA: ¿Asistirás a la fiesta?</option>
                <option value="Si">Asistiré a la fiesta</option>
                <option value="Si +1">Asistiré y llevaré a alguien</option>
                <option value="No">No voy a asistir</option>
                <option value="Tal vez">Aún no sé si asistiré</option>
              </select>
            </div>

            <button
              type="submit"
              class="button text-red-50 hover:bg-pink-700 rounded-full px-6 py-2 transition flex items-center gap-2 text-center justify-center disabled:bg-slate-300" :disabled="loading">
              Enviar
              <svg xmlns="http://www.w3.org/2000/svg" height="14" width="12.25" viewBox="0 0 448 512"><path fill="#ffffff" d="M438.6 105.4c12.5 12.5 12.5 32.8 0 45.3l-256 256c-12.5 12.5-32.8 12.5-45.3 0l-128-128c-12.5-12.5-12.5-32.8 0-45.3s32.8-12.5 45.3 0L160 338.7 393.4 105.4c12.5-12.5 32.8-12.5 45.3 0z"/></svg>
            </button>

          </div>
          
        </form>

      </div>
      
    </div>
  </div>


  </div>