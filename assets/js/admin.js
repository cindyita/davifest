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

    sortColumn: 'id',
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
