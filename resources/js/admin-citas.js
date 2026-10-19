document.querySelectorAll('.js-status-form').forEach((form) => {
    form.addEventListener('submit', async (event) => {
        event.preventDefault();

        const select = form.querySelector('select[name="estado"]');
        const message = form.querySelector('.status-update-message');
        const previousValue = select.dataset.originalValue;
        const formData = new FormData(form);

        select.disabled = true;
        message.className = 'status-update-message is-saving';
        message.textContent = 'Guardando...';

        try {
            const response = await fetch(form.action, {
                method: 'POST',
                body: formData,
                headers: {
                    Accept: 'application/json',
                    'X-Requested-With': 'XMLHttpRequest',
                },
            });
            const data = await response.json();

            if (!response.ok) {
                throw new Error(data.message || 'No se pudo actualizar el estado.');
            }

            select.dataset.originalValue = data.estado;
            const citaId = select.dataset.citaId;
            const row = document.querySelector(`[data-cita-row="${citaId}"]`);
            const badge = row?.querySelector('.cita-status-badge');
            const statusClass = {
                pendiente: 'status-pending',
                confirmada: 'status-confirmed',
                cancelada: 'status-cancelled',
                completada: 'status-completed',
            }[data.estado];

            if (badge) {
                badge.textContent = data.estado.charAt(0).toUpperCase() + data.estado.slice(1);
                badge.className = `badge cita-status-badge ${statusClass}`;
            }

            const modal = select.closest('.modal');
            const productsForm = modal?.querySelector('[data-products-form]');
            const productsLocked = modal?.querySelector('[data-products-locked]');

            if (productsForm && productsLocked) {
                const isCompleted = data.estado === 'completada';
                productsForm.hidden = !isCompleted;
                productsLocked.hidden = isCompleted;
            }

            message.className = 'status-update-message is-success';
            message.textContent = 'Estado guardado';
        } catch (error) {
            select.value = previousValue;
            message.className = 'status-update-message is-error';
            message.textContent = error.message;
        } finally {
            select.disabled = false;
        }
    });

    form.querySelector('select[name="estado"]').addEventListener('change', () => {
        form.requestSubmit();
    });
});
