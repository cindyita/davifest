function guestManager() {
  return {
    name: '',
    active: 1,
    msg: '',
    errors: '',
    guests: [],
    filter: "",

    guestsFilter() {
      if (!this.filter.trim()) return this.guests;

        return this.guests.filter(g =>
          g.name.toLowerCase().includes(this.filter.toLowerCase()) ||
          g.confirm.toLowerCase().includes(this.filter.toLowerCase())
        );
    },

    modal: {
      open: false,
      msg: '',
      name: '',
      show(msg,name) {
        this.msg = msg;
        this.name = name;
        this.open = true;
      }
    },
    confirmModal: {
      open: false,
      msg: '',
      confirmAction: () => {},

      show(msg, accion) {
        this.msg = msg;
        this.confirmAction = accion;
        this.open = true;
      }
    },
    editModal: {
      open: false,
      id: '',
      name: '',
      confirm: '',
      show(id,name,confirm) {
        this.id = id;
        this.name = name;
        this.confirm = confirm;
        this.open = true;
      }
    },
    presModal: {
      open: false,
      allCongrats: [],
      splideinstance: false,
      async show() {
        showConfetti();
        if (!this.splideinstance) {

          document.querySelector("#splide-list").innerHTML = "Cargando..";
          const res = await fetch('admin/getjustcongrats');
          const data = await res.json();
          this.allCongrats = data;  
          
          this.open = true;

          await new Promise(resolve => {
            requestAnimationFrame(() => {
              setTimeout(resolve, 50);
            });
          });

          let html = '';
          data.forEach(el => {
            html += '<li class="splide__slide px-5 w-full h-full"><p class="p-5 w-full h-full overflow-y-scroll text-center flex justify-start md:justify-center items-center flex-col gap-4 text-base md:text-xl lg:text-2xl 2xl:text-3xl">'+el.congrats+'<i class="text-pink-600">-'+el.name+'</i> <img src="https://i.pinimg.com/originals/b4/72/a1/b472a187696137c70e6456450b99c351.gif" width="60px"></p></li>';
          });
          document.querySelector("#splide-list").innerHTML = html;

          if (window.splideInstance) {
            window.splideInstance.destroy();
          }
          var splide = new Splide('#splide', {
            type: 'loop',
            perPage: 1,
            arrows: true,
            pagination: true
          });

          splide.on('moved', () => {
            showConfetti();
          });

          splide.mount();
          this.splideinstance = true;
        } else {
          this.open = true;
        }

      }
    },
    statsModal: {
      open: false,
      msg: '',
      stats: {total: 0, total_guests: 0, total_no: 0, total_si: 0, total_talvez: 0},
      async show(msg) {
        this.msg = msg;
        const res = await fetch('admin/getstats');
        const data = await res.json();
        this.stats = data[0];
        this.open = true;
      }
    },
    infoModal: {
      open: false,
      guest: {},
      show(guest) {
        this.guest = guest;
        this.open = true;
      }
    },

    sortColumn: 'row',
    sortAsc: false,
    sortBy(column) {
      if (this.sortColumn === column) {
        this.sortAsc = !this.sortAsc;
      } else {
        this.sortColumn = column;
        this.sortAsc = true;
      }

      this.guests.sort((a, b) => {
        let valA = a[column] ?? '';
        let valB = b[column] ?? '';

        if (column === 'confirm') {
          valA = valA?.split('(')[0].trim();
          valB = valB?.split('(')[0].trim();
        }

        if (!isNaN(valA) && !isNaN(valB)) {
          return this.sortAsc ? valA - valB : valB - valA;
        }

        return this.sortAsc
          ? String(valA).localeCompare(String(valB))
          : String(valB).localeCompare(String(valA));
      });
    },

    init() {
      this.fetchCongrats();
    },

    async fetchCongrats() {
      try {
        const res = await fetch('admin/getcongrats');
        const data = await res.json();
        this.guests = data;
      } catch (e) {
          this.errors = "Error cargando lista";
          console.error("Error cargando lista", e);
          console.log(e);
          console.log(res);
          setTimeout(() => this.errors = '', 10000);
      }
    },

    async deleteGuest(id) {
        try {
            const res = await fetch(`admin/delete/${id}`, {
                method: 'GET'
            });

            const data = await res.json();

            if (data.success) {
                this.guests = this.guests.filter(guest => guest.id !== id);
              this.msg = "Registro eliminado.";
              this.confirmModal.open = false;
            } else {
                this.errors = "Error al eliminar.";
            }
        } catch (e) {
            this.errors = "Error de conexión al eliminar.";
            console.error(e);
        }
      setTimeout(() => { this.errors = ''; this.msg = '' }, 10000);
    },

    async update() {

      try {
        const res = await fetch('admin/update', {
          method: 'POST',
          headers: { 'Content-Type': 'application/json' },
          body: JSON.stringify({ id: this.editModal.id, name: this.editModal.name, confirm: this.editModal.confirm }),
        });

        const data = await res.json();

        if (data.success) {
          this.msg = "Invitado actualizado correctamente";
          setTimeout(() => this.msg = '', 8000);

          const index = this.guests.findIndex(g => g.id === this.editModal.id);
          if (index !== -1) {
            this.guests[index].name = this.editModal.name;
            this.guests[index].confirm = this.editModal.confirm;
          }

          this.editModal.id = '';
          this.editModal.name = '';
          this.editModal.confirm = '';
          this.editModal.open = false;
        } else {
            this.errors = "Error al actualizar invitado";
            console.log(data);
            setTimeout(() => this.errors = '', 10000);
        }
      } catch (e) {
          this.errors = "Error fatal";
          console.log(e);  
          console.log(res);
          setTimeout(() => this.errors = '', 10000);
      }
    },

    exportTableToCSV(archiveName, idTable) {
      this.exporting = true;
      
      setTimeout(() => {
              const table = document.getElementById(idTable);
              let csv = [];

              for (let row of table.rows) {
                  let cols = [...row.cells].map(cell => {
                      let text = cell.innerText.replace(/"/g, '""');
                      return `"${text}"`;
                  });
                  csv.push(cols.join(","));
              }

              const blob = new Blob([csv.join("\n")], { type: "text/csv" });
              const url = URL.createObjectURL(blob);
              const link = document.createElement("a");
              link.href = url;
              link.download = archiveName;
              link.click();

              this.exporting = false;
          }, 100);
    }
    
  }
}

function modal() {
  return {
    open: false,
    msg: '',
    show(msg) {
      this.msg = msg;
      this.open = true;
    }
  }
}
