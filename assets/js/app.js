document.addEventListener('DOMContentLoaded', function () {
    setTimeout(() => {
        document.querySelector("#loading-page").style.display = 'none';
    }, 200);
})

function showConfetti() {
    var diamond = confetti.shapeFromPath({
        path: 'M284.3 11.7c-15.6-15.6-40.9-15.6-56.6 0l-216 216c-15.6 15.6-15.6 40.9 0 56.6l216 216c15.6 15.6 40.9 15.6 56.6 0l216-216c15.6-15.6 15.6-40.9 0-56.6l-216-216z',
        matrix: [0.020491803278688523, 0, 0, 0.020491803278688523, -7.172131147540983, -5.9016393442622945]
    });

    var defaults = {
        scalar: 2,
        spread: 180,
        particleCount: 30,
        origin: { y: -0.1 },
        startVelocity: -35
    };

    confetti({
        ...defaults,
        shapes: [diamond],
        colors: ['#a50644','#e884ac','#e3305d']
    });
}
