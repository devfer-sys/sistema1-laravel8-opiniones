<template>
    <div class="card shadow-sm">
        <div class="card-header bg-success text-white">
            Resumen de Opiniones con Vue
        </div>

        <div class="card-body">
            <p><strong>Total de opiniones:</strong> {{ opiniones.length }}</p>
            <p><strong>Promedio de valoración:</strong> {{ promedio }} ⭐</p>
        </div>
    </div>
</template>

<script>
export default {
    props: ['opiniones'],

    computed: {
        promedio() {
            if (this.opiniones.length === 0) {
                return 0;
            }

            let suma = this.opiniones.reduce((total, item) => {
                return total + parseInt(item.valoracion);
            }, 0);

            return (suma / this.opiniones.length).toFixed(1);
        }
    }
}
</script>