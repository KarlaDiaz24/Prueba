<div class="px-4 py-2 text-sm text-gray-700 dark:text-white">
    <strong>Promedio del grupo:</strong>
    {{ is_numeric($promedio) ? $promedio : 'Sin calificaciones registradas' }}
</div>
