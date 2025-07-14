function homeManager() {
    return {
        form: {
            name: '',
            congrats: '',
            confirm: '',
        },
        msg: '',
        errors: '',
        loading: false,

        async submitForm() {
            this.loading = true;
            this.msg = '';
            this.errors = '';

            if (!this.form.name || !this.form.congrats || !this.form.confirm) {
                this.errors = 'Faltan campos por llenar.';
                setTimeout(() => this.errors = '', 8000);
                this.loading = false;
                return;
            }

            const res = await fetch('getname', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({ name: this.form.name })
            });

            const data = await res.json();
            if (data != false) {
                this.errors = "ERROR: Ya hay una felicitación con tu nombre.";
                this.loading = false;
                return;
            }

            try {
                const res = await fetch('confirm', {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/json' },
                    body: JSON.stringify(this.form)
                });
            
                const result = await res.json();

                if (result.success) {
                    showConfetti();
                    this.msg = '🎉 ¡Gracias por enviar felicitaciones!';
                    this.form = { name: '',congrats: '', confirm: '' };
                    setTimeout(()=> this.msg = '', 8000);
                } else {
                    this.errors = 'Ocurrió un error al enviar.';
                    setTimeout(() => this.errors = '',8000);
                }
            } catch (e) {
                this.errors = 'Error fatal.';
                console.log(e);
            } finally {
                this.loading = false;
            }
        }
    }
}

function countdown(targetDateStr) {
    return {
      targetDate: new Date(targetDateStr),
      days: 0,
      hours: 0,
      minutes: 0,
      seconds: 0,

      startCountdown() {
        this.updateCountdown();
        setInterval(() => this.updateCountdown(), 1000);
      },

      updateCountdown() {
        const now = new Date();
        const diff = this.targetDate - now;

        if (diff <= 0) {
          this.days = this.hours = this.minutes = this.seconds = 0;
          return;
        }

        this.days = Math.floor(diff / (1000 * 60 * 60 * 24));
        this.hours = Math.floor((diff / (1000 * 60 * 60)) % 24);
        this.minutes = Math.floor((diff / (1000 * 60)) % 60);
        this.seconds = Math.floor((diff / 1000) % 60);
      }
    }
  }