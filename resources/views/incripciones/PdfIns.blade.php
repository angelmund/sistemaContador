<!DOCTYPE html>

<html>

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Recibo Benita Galeana</title>

    <style>
        /* Estilo para ocultar el encabezado y el pie de página al imprimir */
        @media print {

            /* Oculta el encabezado */
            @page {
                margin-top: 0;
            }

            /* Oculta el pie de página */
            @page {
                margin-bottom: 0;
            }

            #boton-imprimir {
                display: none;
            }
        }

        * {
            padding: 0;
            margin: 0;
            box-sizing: border-box;
        }

        html {
            font-size: 62.5%;
        }

        body {
            font-size: 1.4rem;
            display: flex;
            justify-content: center;
        }

        ul {
            list-style: none;
        }

        a {
            text-decoration: none;
            color: var(--color-principal);
        }

        img {
            width: 100%;
        }

        h1 {
            text-align: center;
        }

        #boton-imprimir {
            padding: 1.5rem;
            background-color: #0DACF0;
            color: #fff;
            border-radius: 5px;
            border: none;
            position: fixed;
            top: 10PX;
            left: 10PX;
            cursor: pointer;
            font-size: 1.5rem;
            font-weight: bold;
            transition: background-color 1s ease;
        }

        #boton-imprimir:hover {
            background-color: #08A0C5;
        }

        .texto-centrar {
            text-align: center;
        }

        .texto-grande {
            font-size: 1.4rem;
            text-transform: uppercase;
        }

        .separador {
            margin: 2.5rem 0;
            border: 1px dashed #000;
        }

        .contenedor-recibo {
            margin-top: 2rem;
            width: 73.3rem;
        }

        .header-recibo {
            display: grid;
            grid-template-columns: 1fr 33.3rem 1fr;
            align-items: center;

            gap: 2rem;

            text-align: center;
        }

        .header-recibo__QR {
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
            font-weight: bold;
        }

        .header-recibo__QR p {
            margin-top: .3rem;
            text-align: center;
        }

        .logo__img {
            width: 7.5rem;
            height: 7.5rem;
        }

        .info__titulo {
            font-size: 1.8rem;
        }

        .info__texto {
            font-size: 1rem;
        }

        /**/
        .recibo__info {
            padding: 2rem 4rem;
        }

        .recibo__numero {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .numero__datos {
            padding: 1rem;
            border-radius: 1rem;
            border: 1px solid black;
            text-align: center;
        }

        .info__item-fechas {
            display: grid;
            grid-template-columns: 1fr 1fr;
            margin-bottom: 1rem;
        }

        .info__item {
            display: flex;
            margin-bottom: 1rem;
        }

        .info__item p,
        .info__item-fechas p {
            margin-right: .5rem;
        }

        .item__datos {
            display: flex;
            flex: 2;
        }

        .info__item .item__datos {
            min-width: 0;
        }

        .info__item:nth-child(4) .item__datos {
            flex: 1.5;
        }

        .info__item:nth-child(4) .item__datos:nth-child(2) {
            flex: 1;
        }

        .info__item:nth-child(4) .item__datos:nth-child(3) {
            flex: 2;
        }

        .item__datos:nth-child(2) {
            padding-left: .5rem;
            flex: 1.1;
        }

        .item__datos:nth-child(3) {
            padding-left: .5rem;
            flex: 1.1;
        }

        .datos__negrita {
            font-weight: bold;
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
        }

        .datos__linea {
            flex-grow: 1;
            border-bottom: 1px solid #000;

            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
        }

        .recibo__firmas {
            display: flex;
            margin: 0 auto;
            margin-top: 2rem;
            width: 100%;
        }

        .firmas_firma {
            text-align: center;
            border-top: 1px solid #000;
            flex-grow: 1;
            flex: 2;
            margin: 0 1rem;
        }

        .firmas__QR {
            flex: 1;
        }

        .recibo-terminos {
            margin: 2rem;
            0;
            text-align: center;
            font-size: 1rem;
        }

        .recibo-terminos h3 {
            margin-bottom: .5rem;
        }

        .datos__negrita {
            font-weight: bold;
        }

        .texto-centrar {
            text-align: center;
        }

        .letras-grandes {
            text-transform: uppercase;
        }
    </style>

    <script defer src="https://cdnjs.cloudflare.com/ajax/libs/qrcodejs/1.0.0/qrcode.min.js"></script>

</head>

<body>
    
    <button id="boton-imprimir" onclick="imprimir()">Imprimir</button>
    <div class="contenedor-recibo">

        <header class="header-recibo">
            <div class="header-recibo__logo">
                <img class="logo__img" src="{{asset('img/logoB.png')}}" alt="logo benita galeana">
            </div>

            <div class="header-recibo__info">
                <h1 class="info__titulo">Unión Popular Benita Galeana, A C.</h1>
                <h5>R.C.F UPB-981</h5>
                <p class="info__texto">Holbein No. 75 Col San Juan C.P. 03730 Alcaldia Benito Juarez. Ciudad Mexico</p>
                <p class="info__texto">Horarios de Atencion 5:00 pm - 8:00 pm Tel: 55 8952 8891</p>
            </div>

            <div class="header-recibo__QR">
                <div id="contenedorQR" class="logo__img"></div>
                <p>Folio: {{$inscripcion->id}}</p>
            </div>
        </header>

        <div class="recibo__info">
            <!-- info item -->
            <div class="info__item">
                <!--datos item-->
                <div class="item__datos">
                    <p class="datos__negrita">Nombre: </p>
                    <div class="datos__linea">
                        <p class="letras-grandes">{{ $inscripcion->nombre_completo }}</p>
                    </div>
                </div>
                <!--fin datos item-->
            </div>
            <!-- Fin datos -->

            <!-- info item -->
            <div class="info__item">
                <!--datos item-->
                <div class="item__datos">
                    <p class="datos__negrita">Dirección: </p>
                    <div class="datos__linea">
                        <p>{{ $inscripcion->direccion }}</p>
                    </div>
                </div>
                <!--fin datos item-->
            </div>
            <!-- info item -->
            <div class="info__item">
                <!--datos item-->
                <div class="item__datos">
                    <p class="datos__negrita">Alcaldia: </p>
                    <div class="datos__linea">
                        <p>{{ $inscripcion->alcaldia }}</p>
                    </div>
                </div>
                <!--fin datos item-->
                <!--datos item-->
                <div class="item__datos">
                    <p class="datos__negrita">Telefono: </p>
                    <div class="datos__linea">
                        <p>{{ $inscripcion->telefono }}</p>
                    </div>
                </div>
                <!--fin datos item-->
            </div>
            <!-- Fin datos -->
            <!-- info item -->
            <div class="info__item">
                <!--datos item-->
                <div class="item__datos">
                    <p class="datos__negrita">Concepto: </p>
                    <div class="datos__linea">
                        <p>{{ $inscripcion->concepto }}</p>
                    </div>
                </div>
                <!--fin datos item-->
                <!--datos item-->
                <div class="item__datos">
                    <p class="datos__negrita">Importe: </p>
                    <div class="datos__linea">
                        <p> ${{ number_format($inscripcion->importe , 0, '.', ',') }}</p>
                    </div>
                </div>
                <!--fin datos item-->
                <!--datos item-->
                <div class="item__datos">
                    <p class="datos__negrita">No. Solicitud: </p>
                    <div class="datos__linea">
                        <p>{{ $inscripcion->numero_solicitud }} </p>
                    </div>
                </div>
                <!--fin datos item-->
            </div>
            <!-- Fin datos -->
            <!-- info item -->
            <div class="info__item-fechas ">
                <!--datos item-->
                <div class="item__datos">
                    <p class="datos__negrita">Fecha Registro: </p>
                    <div class="datos__linea">
                        <p>{{ $fecha_regis }}</p>
                    </div>
                </div>
                <!--fin datos item-->
                <!--datos item-->
                <div class="item__datos">
                    <p class="datos__negrita">Fecha Deposito: </p>
                    <div class="datos__linea">
                        <p>{{ $fecha_formateada}}</p>
                    </div>
                </div>
                <!--fin datos item-->
            </div>
            <!-- Fin datos -->
            <!-- info item -->
            <div class="info__item">
                <!--datos item-->
                <div class="item__datos">
                    <p class="datos__negrita">Importe en texto: </p>
                    <div class="datos__linea">
                        <p class="texto-centrar letras-grandes">{{ $importeEnPalabras}} PESOS</p>
                    </div>
                </div>
                <!--fin datos item-->
            </div>

            <!-- info item -->
            <div class="info__item">
                <!--datos item-->
                <div class="item__datos">
                    <p class="datos__negrita">Observaciones: </p>
                    <div class="datos__linea">
                        <p class="texto-centrar">{{$inscripcion->observaciones}}</p>
                    </div>
                </div>
            </div>
            <!-- Fin datos -->
        </div>

        <div class="recibo__firmas">
            <div class="firmas_firma">
                <div class="firma__texto">
                    <p class="datos__negrita">{{ $inscripcion->nombre_completo }}</p>
                    <p>Firma Inscrito</p>
                </div>
            </div>
            <div class="firmas_firma">
                <div class="firma__texto">
                    <p class="datos__negrita">Jose Javier Hernandez Perales</p>
                    <p>Firma Autor</p>
                </div>
            </div>
        </div>

        <div class="recibo-terminos">
            <h3>Nota: </h3>
            <p>
                EL IMPORTE DE ESTE RECIBO NO ES REEMBOLSABLE, NI TRANSFERIBLE EN CASO DE RETIRO DEL PROYECTO
            </p>
            <p>
                EL PAGO DE LA INSCRIPCIÓN ES EN UNA SOLA EXHIBICIÓN.
            </p>
            <p>
                EL PAGO SE REALIZARA SOLO EN VENTANILLA ÚNICA O PRACTI-CAJA.
            </p>
            <p>
                NO SE RECIBE DINERO EN EFECTIVO, TODO DEPOSITO SE REALIZA A LA CUENTA DE LA ASOCIACIÓN:
            </p>
        </div>

        <!--Separador ALV-->
        <div class="separador"></div>

        <!--Contenedor 2-->
        <header class="header-recibo">
            <div class="header-recibo__logo">
                <img class="logo__img" src="{{asset('img/logoB.png')}}" alt="logo benita galeana">
            </div>

            <div class="header-recibo__info">
                <h1 class="info__titulo">Unión Popular Benita Galeana, A C.</h1>
                <h5>R.C.F UPB-981</h5>
                <p class="info__texto">Holbein No. 75 Col San Juan C.P. 03730 Alcaldia Benito Juarez. Ciudad Mexico</p>
                <p class="info__texto">Horarios de Atencion 5:00 pm - 8:00 pm Tel: 55 8952 8891</p>
            </div>

            <div class="header-recibo__QR">
                <div id="contenedorQR2" class="logo__img"></div>
                <p>Folio: {{$inscripcion->id}}</p>
            </div>
        </header>

        <div class="recibo__info">
            <!-- info item -->
            <div class="info__item">
                <!--datos item-->
                <div class="item__datos">
                    <p class="datos__negrita">Nombre: </p>
                    <div class="datos__linea">
                        <p class="letras-grandes">{{ $inscripcion->nombre_completo }}</p>
                    </div>
                </div>
                <!--fin datos item-->
            </div>
            <!-- Fin datos -->

            <!-- info item -->
            <div class="info__item">
                <!--datos item-->
                <div class="item__datos">
                    <p class="datos__negrita">Dirección: </p>
                    <div class="datos__linea">
                        <p>{{ $inscripcion->direccion }}</p>
                    </div>
                </div>
                <!--fin datos item-->
            </div>
            <!-- info item -->
            <div class="info__item">
                <!--datos item-->
                <div class="item__datos">
                    <p class="datos__negrita">Alcaldia: </p>
                    <div class="datos__linea">
                        <p>{{ $inscripcion->alcaldia }}</p>
                    </div>
                </div>
                <!--fin datos item-->
                <!--datos item-->
                <div class="item__datos">
                    <p class="datos__negrita">Telefono: </p>
                    <div class="datos__linea">
                        <p>{{ $inscripcion->telefono }}</p>
                    </div>
                </div>
                <!--fin datos item-->
            </div>
            <!-- Fin datos -->
            <!-- info item -->
            <div class="info__item">
                <!--datos item-->
                <div class="item__datos">
                    <p class="datos__negrita">Concepto: </p>
                    <div class="datos__linea">
                        <p>{{ $inscripcion->concepto }}</p>
                    </div>
                </div>
                <!--fin datos item-->
                <!--datos item-->
                <div class="item__datos">
                    <p class="datos__negrita">Importe: </p>
                    <div class="datos__linea">
                        <p>${{ number_format($inscripcion->importe , 0, '.', ',') }}</p>
                    </div>
                </div>
                <!--fin datos item-->
                <!--datos item-->
                <div class="item__datos">
                    <p class="datos__negrita">No. Solicitud: </p>
                    <div class="datos__linea">
                        <p>{{ $inscripcion->numero_solicitud }}</p>
                    </div>
                </div>
                <!--fin datos item-->
            </div>
            <!-- Fin datos -->
            <!-- info item -->
            <div class="info__item-fechas ">
                <!--datos item-->
                <div class="item__datos">
                    <p class="datos__negrita">Fecha Registro: </p>
                    <div class="datos__linea">
                        <p>{{ $fecha_regis }}</p>
                    </div>
                </div>
                <!--fin datos item-->
                <!--datos item-->
                <div class="item__datos">
                    <p class="datos__negrita">Fecha Deposito: </p>
                    <div class="datos__linea">
                        <p>{{ $fecha_formateada}}</p>
                    </div>
                </div>
                <!--fin datos item-->
            </div>
            <!-- Fin datos -->
            <!-- info item -->
            <div class="info__item">
                <!--datos item-->
                <div class="item__datos">
                    <p class="datos__negrita">Importe en texto: </p>
                    <div class="datos__linea">
                        <p class="texto-centrar letras-grandes">{{ $importeEnPalabras }} PESOS</p>
                    </div>
                </div>
                <!--fin datos item-->
            </div>

            <!-- info item -->
            <div class="info__item">
                <!--datos item-->
                <div class="item__datos">
                    <p class="datos__negrita">Observaciones: </p>
                    <div class="datos__linea">
                        <p class="texto-centrar"> {{$inscripcion->observaciones}}</p>
                    </div>
                </div>
            </div>
            <!-- Fin datos -->
        </div>

        <div class="recibo__firmas">
            <div class="firmas_firma">
                <div class="firma__texto">
                    
                    <p class="datos__negrita">{{ $inscripcion->nombre_completo }} </p>
                    <p>Firma Inscrito</p>
                </div>
            </div>
            <div class="firmas_firma">
                <div class="firma__texto">
                    <p class="datos__negrita">Jose Javier Hernandez Perales </p>
                    <p>Firma Autor</p>
                </div>
            </div>
        </div>

        <div class="recibo-terminos">
            <h3>Nota: </h3>
            <p>
                EL IMPORTE DE ESTE RECIBO NO ES REEMBOLSABLE, NI TRANSFERIBLE EN CASO DE RETIRO DEL PROYECTO
            </p>
            <p>
                EL PAGO DE LA INSCRIPCIÓN ES EN UNA SOLA EXHIBICIÓN.
            </p>
            <p>
                EL PAGO SE REALIZARA SOLO EN VENTANILLA ÚNICA O PRACTI-CAJA.
            </p>
            <p>
                NO SE RECIBE DINERO EN EFECTIVO, TODO DEPOSITO SE REALIZA A LA CUENTA DE LA ASOCIACIÓN:
            </p>
        </div>

    </div>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const url = window.location.pathname;
            // Dividir la URL utilizando el caracter "/"
            const partes = url.split("/");

            // El último elemento en partes será tu ID
            const id = partes[partes.length - 1];

            // Convertimos el folio a cadena de texto
            const folio = id.toString();
        
            const contenedorQR = document.getElementById('contenedorQR');
            const QR = new QRCode(contenedorQR, {
                width: 75, // Ancho deseado
                height: 75 // Alto deseado
            });   
        
            const contenedorQR2 = document.getElementById('contenedorQR2');
            const QR2 = new QRCode(contenedorQR2, { // <-- Aquí corregí el parámetro
                width: 75, // Ancho deseado
                height: 75 // Alto deseado
            });
        
            QR.makeCode(folio.toString());
            QR2.makeCode(folio.toString()); // <-- Aquí está corregido
        });
        
        // Función para imprimir la página
        function imprimir() {
            window.print(); // Abre el cuadro de diálogo de impresión    
        }
    </script>
</body>

</html>