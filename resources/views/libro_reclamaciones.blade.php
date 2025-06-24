<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Libro de Reclamaciones - TecsUpFit</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Arial', sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            padding: 20px;
        }

        .container {
            max-width: 800px;
            margin: 0 auto;
            background: white;
            border-radius: 20px;
            box-shadow: 0 20px 40px rgba(0,0,0,0.1);
            overflow: hidden;
            animation: slideIn 0.6s ease-out;
        }

        @keyframes slideIn {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .header {
            background: linear-gradient(45deg, #ff6b6b, #ee5a24);
            color: white;
            padding: 30px;
            text-align: center;
            position: relative;
            overflow: hidden;
        }

        .header::before {
            content: '';
            position: absolute;
            top: -50%;
            left: -50%;
            width: 200%;
            height: 200%;
            background: repeating-linear-gradient(
                45deg,
                transparent,
                transparent 10px,
                rgba(255,255,255,0.1) 10px,
                rgba(255,255,255,0.1) 20px
            );
            animation: shimmer 3s linear infinite;
        }

        @keyframes shimmer {
            0% { transform: translateX(-100%) translateY(-100%); }
            100% { transform: translateX(100%) translateY(100%); }
        }

        .header h1 {
            font-size: 2.5rem;
            font-weight: bold;
            margin-bottom: 10px;
            position: relative;
            z-index: 1;
        }

        .header p {
            font-size: 1.1rem;
            opacity: 0.9;
            position: relative;
            z-index: 1;
        }

        .form-container {
            padding: 40px;
        }

        .form-group {
            margin-bottom: 25px;
            position: relative;
        }

        .form-row {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
        }

        label {
            display: block;
            margin-bottom: 8px;
            font-weight: 600;
            color: #333;
            font-size: 14px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        input, select, textarea {
            width: 100%;
            padding: 15px;
            border: 2px solid #e1e8ed;
            border-radius: 12px;
            font-size: 16px;
            transition: all 0.3s ease;
            background: #f8f9fa;
        }

        input:focus, select:focus, textarea:focus {
            outline: none;
            border-color: #667eea;
            background: white;
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(102, 126, 234, 0.15);
        }

        textarea {
            min-height: 120px;
            resize: vertical;
            font-family: inherit;
        }

        .checkbox-group {
            display: flex;
            align-items: center;
            gap: 12px;
            margin-top: 20px;
            padding: 20px;
            background: #f1f3f4;
            border-radius: 12px;
            border-left: 4px solid #667eea;
        }

        .checkbox-group input[type="checkbox"] {
            width: auto;
            margin: 0;
            transform: scale(1.2);
        }

        .checkbox-group label {
            margin: 0;
            font-weight: normal;
            text-transform: none;
            font-size: 14px;
            line-height: 1.4;
        }

        .submit-btn {
            background: linear-gradient(45deg, #667eea, #764ba2);
            color: white;
            padding: 18px 40px;
            border: none;
            border-radius: 50px;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            width: 100%;
            text-transform: uppercase;
            letter-spacing: 1px;
            position: relative;
            overflow: hidden;
        }

        .submit-btn:hover {
            transform: translateY(-3px);
            box-shadow: 0 15px 35px rgba(102, 126, 234, 0.4);
        }

        .submit-btn:active {
            transform: translateY(-1px);
        }

        .info-section {
            background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
            color: white;
            padding: 30px;
            margin: 30px;
            border-radius: 15px;
            text-align: center;
        }

        .info-section h3 {
            margin-bottom: 15px;
            font-size: 1.3rem;
        }

        .contact-info {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 15px;
            margin-top: 20px;
        }

        .contact-item {
            background: rgba(255,255,255,0.2);
            padding: 15px;
            border-radius: 10px;
            backdrop-filter: blur(10px);
        }

        .legal-info {
            background: #2c3e50;
            color: white;
            padding: 25px;
            font-size: 12px;
            line-height: 1.6;
        }

        @media (max-width: 768px) {
            .form-row {
                grid-template-columns: 1fr;
            }
            
            .header h1 {
                font-size: 2rem;
            }
            
            .form-container {
                padding: 25px;
            }
            
            .contact-info {
                grid-template-columns: 1fr;
            }
        }

        .success-message {
            display: none;
            background: linear-gradient(45deg, #56ab2f, #a8e6cf);
            color: white;
            padding: 20px;
            border-radius: 12px;
            margin-bottom: 20px;
            text-align: center;
            animation: fadeIn 0.5s ease-in;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(-10px); }
            to { opacity: 1; transform: translateY(0); }
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>📋 Libro de Reclamaciones</h1>
            <p>TecsUpFit - Tu aliado fitness de confianza</p>
        </div>

        <div class="form-container">
            <div class="success-message" id="successMessage">
                ✅ Tu reclamo ha sido registrado exitosamente. Te contactaremos en un plazo máximo de 15 días hábiles.
            </div>

            <form id="reclamacionForm">
                <div class="form-group">
                    <label for="tipoDocumento">Tipo de Documento</label>
                    <select id="tipoDocumento" name="tipoDocumento" required>
                        <option value="">Selecciona tu documento</option>
                        <option value="dni">DNI</option>
                        <option value="ce">Carnet de Extranjería</option>
                        <option value="pasaporte">Pasaporte</option>
                        <option value="ruc">RUC</option>
                    </select>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label for="numeroDocumento">Número de Documento</label>
                        <input type="text" id="numeroDocumento" name="numeroDocumento" required placeholder="Ej: 12345678">
                    </div>
                    <div class="form-group">
                        <label for="telefono">Teléfono</label>
                        <input type="tel" id="telefono" name="telefono" required placeholder="Ej: 987654321">
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label for="nombres">Nombres</label>
                        <input type="text" id="nombres" name="nombres" required placeholder="Tus nombres completos">
                    </div>
                    <div class="form-group">
                        <label for="apellidos">Apellidos</label>
                        <input type="text" id="apellidos" name="apellidos" required placeholder="Tus apellidos completos">
                    </div>
                </div>

                <div class="form-group">
                    <label for="email">Correo Electrónico</label>
                    <input type="email" id="email" name="email" required placeholder="tu@email.com">
                </div>

                <div class="form-group">
                    <label for="direccion">Dirección</label>
                    <input type="text" id="direccion" name="direccion" required placeholder="Tu dirección completa">
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label for="numeroPedido">Número de Pedido</label>
                        <input type="text" id="numeroPedido" name="numeroPedido" placeholder="TSF-2024-001234">
                    </div>
                    <div class="form-group">
                        <label for="fechaCompra">Fecha de Compra</label>
                        <input type="date" id="fechaCompra" name="fechaCompra">
                    </div>
                </div>

                <div class="form-group">
                    <label for="tipoReclamo">Tipo de Reclamo</label>
                    <select id="tipoReclamo" name="tipoReclamo" required>
                        <option value="">Selecciona el tipo</option>
                        <option value="reclamo">Reclamo - Disconformidad con producto/servicio</option>
                        <option value="queja">Queja - Disconformidad con atención</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="producto">Producto/Servicio</label>
                    <select id="producto" name="producto" required>
                        <option value="">Selecciona la categoría</option>
                        <option value="proteinas">Proteínas (Whey, Casein, etc.)</option>
                        <option value="creatinas">Creatinas</option>
                        <option value="preworkout">Pre-entrenos</option>
                        <option value="aminoacidos">Aminoácidos (BCAA, etc.)</option>
                        <option value="quemadores">Quemadores de grasa</option>
                        <option value="vitaminas">Vitaminas y minerales</option>
                        <option value="barras">Barras proteicas</option>
                        <option value="otros">Otros suplementos</option>
                        <option value="servicio">Servicio de atención/envío</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="detalleReclamo">Detalle del Reclamo</label>
                    <textarea id="detalleReclamo" name="detalleReclamo" required placeholder="Describe detalladamente tu reclamo: ¿Qué pasó? ¿Cuándo ocurrió? ¿Qué esperabas que sucediera?"></textarea>
                </div>

                <div class="form-group">
                    <label for="pedidoCliente">Pedido del Cliente</label>
                    <textarea id="pedidoCliente" name="pedidoCliente" required placeholder="¿Qué solución esperas? Ejemplo: Cambio de producto, devolución, compensación, etc."></textarea>
                </div>

                <div class="checkbox-group">
                    <input type="checkbox" id="autorizacion" name="autorizacion" required>
                    <label for="autorizacion">
                        Autorizo el tratamiento de mis datos personales para la gestión de este reclamo, conforme a la Ley de Protección de Datos Personales N° 29733 y acepto que TecsUpFit se comunique conmigo para resolver mi solicitud.
                    </label>
                </div>

                <button type="submit" class="submit-btn">
                    🚀 Enviar Reclamo
                </button>
            </form>
        </div>

        <div class="info-section">
            <h3>📞 Información de Contacto</h3>
            <p>Nos comprometemos a responderte en un plazo máximo de 15 días hábiles</p>
            <div class="contact-info">
                <div class="contact-item">
                    <strong>📧 Email</strong><br>
                    soporte@tecsupfit.pe
                </div>
                <div class="contact-item">
                    <strong>📱 WhatsApp</strong><br>
                    +51 956 104 920
                </div>
                <div class="contact-item">
                    <strong>🌐 Web</strong><br>
                    www.tecsupfit.pe
                </div>
                <div class="contact-item">
                    <strong>⏰ Horario</strong><br>
                    Lun-Vie: 9:00-16:00
                </div>
            </div>
        </div>

        <div class="legal-info">
            <strong>Marco Legal:</strong> Este libro de reclamaciones se encuentra conforme al Código de Protección y Defensa del Consumidor (Ley N° 29571) y su reglamento. La formulación del reclamo no impide acudir a otras vías de solución de controversias ni es requisito previo para interponer una denuncia ante el INDECOPI. El proveedor debe dar respuesta al reclamo en un plazo no mayor a quince (15) días hábiles, pudiendo ampliar el plazo hasta por treinta (30) días más, previa comunicación al consumidor.
        </div>
    </div>

    <script>
        document.getElementById('reclamacionForm').addEventListener('submit', function(e) {
            e.preventDefault();
            
            // Simulación de envío
            const submitBtn = document.querySelector('.submit-btn');
            const originalText = submitBtn.innerHTML;
            
            submitBtn.innerHTML = '⏳ Enviando...';
            submitBtn.disabled = true;
            
            setTimeout(() => {
                document.getElementById('successMessage').style.display = 'block';
                document.getElementById('successMessage').scrollIntoView({ behavior: 'smooth' });
                
                // Reset form
                this.reset();
                
                // Reset button
                submitBtn.innerHTML = originalText;
                submitBtn.disabled = false;
                
                // Hide success message after 5 seconds
                setTimeout(() => {
                    document.getElementById('successMessage').style.display = 'none';
                }, 5000);
            }, 2000);
        });

        // Validación en tiempo real del número de documento
        document.getElementById('numeroDocumento').addEventListener('input', function(e) {
            const tipoDoc = document.getElementById('tipoDocumento').value;
            const numero = e.target.value;
            
            if (tipoDoc === 'dni' && numero.length > 8) {
                e.target.value = numero.slice(0, 8);
            }
        });

        // Auto-formateo de teléfono
        document.getElementById('telefono').addEventListener('input', function(e) {
            let value = e.target.value.replace(/\D/g, '');
            if (value.length > 9) {
                value = value.slice(0, 9);
            }
            e.target.value = value;
        });
    </script>
</body>
</html>