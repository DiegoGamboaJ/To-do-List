// const form = document.querySelector("#frm-delete");
// console.log(form);

// form.addEventListener('submit', (e) => {
//     console.log("entro al ")
//     e.preventDefault();

//     confirm('¿Estas seguro que quieres eliminar la tarea?');
// });


const forms = document.querySelectorAll("#frm-delete");

forms.forEach(form => {
    form && form.addEventListener('submit', (e) => {
        var confirmacion = confirm('¿Estás seguro de que deseas eliminar este elemento?');
        if (!confirmacion) {
            e.preventDefault();
        }
    });
});

const save = document.querySelector("#save");

save.addEventListener('click', (e) => {
    e.preventDefault();

    fetch('/todo', {
        method: "post",
        headers: {
            'X-CSRF-TOKEN': document.querySelector('[name="_token"]').value,
            'Accept': 'application/json'
        },
        body: new FormData(e.target.closest('form'))
    })
        .then(response => {
            console.log(response);
            if (!response.ok) {
                throw new Error('Error al crear la tarea.');
            }
            return response.json();
        })
        .then(data => {
            if (data.errors) {
            // Si hay errores de validación, mostrar los mensajes de error
            Object.keys(data.errors).forEach(fieldName => {
                const field = form.querySelector('[name="' + fieldName + '"]');
                const errorMessage = data.errors[fieldName][0]; // Tomar el primer mensaje de error
                // Mostrar el mensaje de error debajo del campo correspondiente
                const errorElement = document.createElement('div');
                errorElement.classList.add('error-message');
                errorElement.textContent = errorMessage;
                field.parentNode.appendChild(errorElement);
            });
        } else if (data.response) {
            // Si no hay errores, redireccionar o realizar otra acción según sea necesario
            alert(data.message);
            window.location.href = '/todo';
        }
        })
        .catch(errors => {
            // Manejar errores de red o errores en el servidor
            console.error('Error:', errors);
        });
        
});
