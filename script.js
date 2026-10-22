document.addEventListener("DOMContentLoaded", () => {
    const forms = document.querySelectorAll(
        "form[data-validar]"
    );

    forms.forEach((form) => {
        form.addEventListener("submit", (event) => {
            const campos = form.querySelectorAll(
                "[required]"
            );

            let valido = true;

            campos.forEach((campo) => {
                if (!campo.value.trim()) {
                    valido = false;
                    campo.setAttribute(
                        "aria-invalid",
                        "true"
                    );
                } else {
                    campo.removeAttribute(
                        "aria-invalid"
                    );
                }
            });

            if (!valido) {
                event.preventDefault();
                alert(
                    "Preencha todos os campos obrigatórios."
                );
            }
        });
    });

    document.querySelectorAll("[data-confirmar]")
        .forEach((elemento) => {
            elemento.addEventListener("click", (event) => {
                if (!confirm("Deseja continuar?")) {
                    event.preventDefault();
                }
            });
        });
});
