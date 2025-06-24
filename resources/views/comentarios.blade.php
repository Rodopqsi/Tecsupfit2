<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Comentarios Recibidos</title>
    <link rel="stylesheet" href="comentarios.css">
    <script src="script.js" defer></script>
</head>
<body>
    <div class="contenedor">
        <h1>📝 Comentarios Recibidos</h1>
        <div id="listaComentarios"></div>

        <div class="botones-finales">
            <a href="/reclamos" class="btn volver">+ Enviar otro comentario</a>
            <a href="/promociones" class="btn pagina">Volver a la página</a>
            <button id="borrarTodos" class="btn borrar">🗑️ Eliminar todos</button>
        </div>
    </div>
</body>
</html>
<style>
    body {
    margin: 0;
    padding: 0;
    font-family: Arial, sans-serif;
    background: linear-gradient(to bottom, #000000, #1a1a1a);
    color: #ffffff;
}

.contenedor {
    max-width: 800px;
    margin: 40px auto;
    background-color: #111;
    padding: 30px;
    border-radius: 15px;
    box-shadow: 0 0 20px rgba(255, 0, 0, 0.5);
}

h1 {
    text-align: center;
    color: #ff3b3b;
    margin-bottom: 30px;
    font-size: 2em;
}

/* Comentarios */
.comentario {
    background-color: #1c1c1c;
    border-left: 5px solid #ff3b3b;
    padding: 20px;
    margin-bottom: 20px;
    border-radius: 10px;
    transition: background 0.3s;
}

.comentario:hover {
    background-color: #2a2a2a;
}

.comentario h3 {
    color: #ffffff;
    margin-bottom: 5px;
}

.comentario .email {
    font-size: 0.9em;
    color: #bbbbbb;
    margin-bottom: 10px;
}

.comentario .texto {
    font-size: 1em;
    line-height: 1.5;
    color: #dddddd;
}

/* Botones */
.botones-finales {
    display: flex;
    justify-content: space-between;
    margin-top: 30px;
    flex-wrap: wrap;
    gap: 10px;
}

.btn {
    padding: 12px 20px;
    border: none;
    background-color: #ff3b3b;
    color: white;
    font-weight: bold;
    text-decoration: none;
    border-radius: 8px;
    cursor: pointer;
    text-align: center;
    transition: background-color 0.3s ease;
}

.btn:hover {
    background-color: #cc2e2e;
}

.btn.borrar {
    background-color: #444444;
}

.btn.pagina {
    background-color: #000000;
}

.btn.borrar:hover {
    background-color: #ff0000;
}

.eliminar {
    margin-top: 10px;
    padding: 8px 16px;
    font-size: 0.9em;
    background-color: #ff3b3b;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    color: #fff;
}

.eliminar:hover {
    background-color: #cc2e2e;
}
</style>
<script>
    document.addEventListener("DOMContentLoaded", () => {
    const form = document.getElementById("formReclamo");

    if (form) {
        form.addEventListener("submit", (e) => {
            e.preventDefault();
            const nombre = document.getElementById("nombre").value;
            const email = document.getElementById("email").value;
            const comentario = document.getElementById("comentario").value;

            const nuevoComentario = { nombre, email, comentario };
            let comentarios = JSON.parse(localStorage.getItem("comentarios")) || [];
            comentarios.push(nuevoComentario);
            localStorage.setItem("comentarios", JSON.stringify(comentarios));

            window.location.href = "/comentarios.html";
        });
    }

    const lista = document.getElementById("listaComentarios");
    if (lista) {
        let comentarios = JSON.parse(localStorage.getItem("comentarios")) || [];

        if (comentarios.length === 0) {
            lista.innerHTML = "<p>No hay comentarios aún.</p>";
        } else {
            comentarios.forEach((c, i) => {
                const div = document.createElement("div");
                div.className = "comentario";
                div.innerHTML = `
                    <h3>${c.nombre}</h3>
                    <p class="email">${c.email}</p>
                    <p class="texto">${c.comentario}</p>
                    <button class="btn eliminar" data-index="${i}">Eliminar</button>
                `;
                lista.appendChild(div);
            });

            // Botón eliminar individual
            document.querySelectorAll(".eliminar").forEach(boton => {
                boton.addEventListener("click", (e) => {
                    const index = e.target.getAttribute("data-index");
                    comentarios.splice(index, 1);
                    localStorage.setItem("comentarios", JSON.stringify(comentarios));
                    location.reload();
                });
            });
        }

        const borrarTodos = document.getElementById("borrarTodos");
        if (borrarTodos) {
            borrarTodos.addEventListener("click", () => {
                if (confirm("¿Estás seguro de borrar todos los comentarios?")) {
                    localStorage.removeItem("comentarios");
                    location.reload();
                }
            });
        }
    }
});
</script>