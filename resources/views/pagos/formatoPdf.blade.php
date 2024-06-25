<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

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

        .info__item {
            display: flex;
            margin-bottom: 1rem;
        }

        .info__item p {
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
            font-size: 1.2rem;
        }

        .recibo-terminos h3 {
            margin-bottom: 1rem;
        }

        body {
            font-size: 1.6rem;
        }

        .info__titulo {
            font-size: 2.1rem;
        }

        .header-recibo__info h5 {
            font-size: 1.7rem;
            margin-bottom: .5rem;
        }

        .info__texto {
            font-size: 1.4rem;
        }

        .item__datos {
            flex: 1;
        }

        .info__item:nth-child(4) .item__datos {
            flex: 1;
        }

        .info__item:nth-child(4) .item__datos:nth-child(2) {
            flex: 1;
        }

        .numero__datos p:nth-child(1) {
            font-weight: bold;
            margin-bottom: .5rem;
        }

        .fecha__item {
            font-size: 1.5rem;
        }

        .separador {
            margin: 2.5rem 0;
        }

        .espacio-qr {
            margin-left: 5rem;
            margin: 0 auto;
        }

        .centrarQR {
            align-items: center;
            justify-content: space-between;
        }

        .numero__datos p:nth-child(1) {
            margin-bottom: .5rem;
        }

        .firmas__QR p:nth-child(1) {
            margin-bottom: .5rem;
        }

        .firmas__QR p:nth-child(2) {
            margin-top: .5rem;
        }
    </style>


    <script defer src="https://cdnjs.cloudflare.com/ajax/libs/qrcodejs/1.0.0/qrcode.min.js"></script>
    <script type="text/javascript" src="js/script.js"></script>

    <title>Recibo de Pago</title>
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
            <div class="numero__datos">
                <p>Sucursal Bancaria</p>
                <p>{{ $transaccion->referencia_pago ?? $transaccion->numero_cheque }}</p>
            </div>
        </header>
        
        <div class="recibo__info">
            <div class="info__item">
                <div class="item__datos">
                    <p class="datos__negrita">Proyecto: </p>
                    <div class="datos__linea">
                        <p>
                            @if($transaccion->proyecto)
                                {{ $transaccion->proyecto->nombre }}
                            @else
                                No aplica
                            @endif
                        </p>
                    </div>
                </div>
            </div>
            <div class="info__item">
                <div class="item__datos">
                    <p class="datos__negrita">Recibi de: </p>
                    <div class="datos__linea texto-grande">
                        <p>{{ $transaccion->inscripcione->nombre_completo }}</p>
                    </div>
                </div>
            </div>
            <div class="info__item">
                <div class="item__datos">
                    <p class="datos__negrita">La cantidad de: </p>
                    <div class="datos__linea">
                        <p>${{ number_format($transaccion->monto , 0, '.', ',') }}<span>.00</span></p>
                    </div>
                </div>
                <div class="item__datos">
                    <p class="datos__negrita">Por concepto de: </p>
                    <div class="datos__linea">
                        <p>{{ ucfirst($tipo) }}</p>
                    </div>
                </div>
            </div>
            <div class="info__item">
                <div class="item__datos">
                    <div class="datos__linea">
                        <p class="texto-centrar texto-grande">{{ $importeEnPalabras }}<span> PESOS</span></p>
                    </div>
                </div>
            </div>
            <div class="info__item fecha__item">
                <div class="item__datos">
                    <p class="datos__negrita">Fecha recibo: </p>
                    <div class="datos__linea">
                        <p>{{ $fecha_formateada }}</p>
                    </div>
                </div>
                <div class="item__datos">
                    <p class="datos__negrita">Fecha deposito: </p>
                    <div class="datos__linea">
                        <p>{{ $fecha_formateada }}</p>
                    </div>
                </div>
            </div>
            <div class="info__item">
                <div class="item__datos">
                    <p class="datos__negrita">Observaciones: </p>
                    <div class="datos__linea">
                        <p class="texto-centrar">{{ $transaccion->descripcion }}</p>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="recibo__firmas centrarQR">
            <div class="header-recibo__QR firmas__QR">
                <p>Folio</p>
                <div id="contenedorQR1" class="logo__img"></div>
                <p class="idFolio">{{ $transaccion->id_cliente }}</p>
            </div>
        
            <div class="firmas_firma">
                <div class="firma__texto">
                    <p class="datos__negrita">C.P. Jose Javier Hernandez Perales</p>
                    <p>Firma</p>
                </div>
            </div>
        
            <div class="header-recibo__QR firmas__QR">
                <p>No. {{ ucfirst($tipo) }}</p>
                <div id="contenedorQR2" class="logo__img"></div>
                <p class="idPago">{{ $transaccion->id }}</p>
            </div>
        </div>
        
        
        <div class="separador"></div>
        
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
            <div class="numero__datos">
                <p>Sucursal Bancaria</p>
                <p>{{ $transaccion->referencia_pago ?? $transaccion->numero_cheque }}</p>
            </div>
        </header>
        
        <div class="recibo__info">
            <div class="info__item">
                <!--datos item-->
                <div class="item__datos">
                    <p class="datos__negrita">Proyecto: </p>
                    <div class="datos__linea">
                        <p>
                            @if($transaccion->proyecto)
                                {{ $transaccion->proyecto->nombre }}
                            @else
                                No aplica
                            @endif
                        </p>
                    </div>
                </div>
                <!--fin datos item-->
            </div>
        
            <!-- info item -->
            <div class="info__item">
                <!--datos item-->
                <div class="item__datos">
                    <p class="datos__negrita">Recibi de: </p>
                    <div class="datos__linea texto-grande">
                        <p>{{ $transaccion->inscripcione->nombre_completo }}</p>
                    </div>
                </div>
            </div>
        
            <!-- info item -->
            <div class="info__item">
                <!--datos item-->
                <div class="item__datos">
                    <p class="datos__negrita">La cantidad de:</p>
                    <div class="datos__linea">
                        <p>${{ number_format($transaccion->monto , 0, '.', ',') }}<span>.00</span></p>
                    </div>
                </div>
                <!--fin datos item-->
                <!--datos item-->
                <div class="item__datos">
                    <p class="datos__negrita">Por concepto de: </p>
                    <div class="datos__linea">
                        <p>{{ ucfirst($tipo) }}</p>
                    </div>
                </div>
                <!--fin datos item-->
            </div>
        
            <!-- info item -->
            <div class="info__item">
                <!--datos item-->
                <div class="item__datos">
                    <div class="datos__linea">
                        <p class="texto-centrar texto-grande">{{ $importeEnPalabras }}<span> PESOS</span></p>
                    </div>
                </div>
                <!--fin datos item-->
            </div>
        
            <!-- info item -->
            <div class="info__item fecha__item">
                <!--datos item-->
                <div class="item__datos">
                    <p class="datos__negrita">Fecha recibo: </p>
                    <div class="datos__linea">
                        <p>{{$fecha_formateada}}</p>
                    </div>
                </div>
                <!--fin datos item-->
                <div class="item__datos">
                    <p class="datos__negrita">Fecha deposito: </p>
                    <div class="datos__linea">
                        <p>{{$fecha_formateada}}</p>
                    </div>
                </div>
            </div>
        
            <!-- info item -->
            <div class="info__item">
                <!--datos item-->
                <div class="item__datos">
                    <p class="datos__negrita">Observaciones: </p>
                    <div class="datos__linea">
                        <p class="texto-centrar">{{ $transaccion->descripcion }}</p>
                    </div>
                </div>
                <!--fin datos item-->
            </div>
        </div>
        
        <div class="recibo__firmas centrarQR">
            <div class="header-recibo__QR firmas__QR">
                <p>Folio</p>
                <div id="contenedorQR3" class="logo__img"></div>
                <p class="idFolio">{{ $transaccion->id_cliente }}</p>
            </div>
        
            <div class="firmas_firma">
                <div class="firma__texto">
                    <p class="datos__negrita">C.P. Jose Javier Hernandez Perales</p>
                    <p>Firma</p>
                </div>
            </div>
        
            <div class="header-recibo__QR firmas__QR">
                <p>No. {{ ucfirst($tipo) }}</p>
                <div id="contenedorQR4" class="logo__img"></div>
                <p class="idPago">{{ $transaccion->id }}</p>
            </div>
        </div>
        
        </div>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
           // Obtener el idFolio y el idPago
            const idFolio = document.querySelector('.idFolio').textContent.trim();
            const idPago = document.querySelector('.idPago').textContent.trim();
            // Generar códigos QR
            const QR1 = new QRCode(document.getElementById('contenedorQR1'), {
                width: 100,
                height: 100
            });
            // Generar códigos QR
            const QR2 = new QRCode(document.getElementById('contenedorQR2'), {
                width: 100,
                height: 100
            });
            // Generar códigos QR
            const QR3 = new QRCode(document.getElementById('contenedorQR3'), {
                width: 100,
                height: 100
            });
            const QR4 = new QRCode(document.getElementById('contenedorQR4'), {
                width: 100,
                height: 100
            });

            // Convertir los valores a cadenas de texto
            const nFolio = idFolio.toString();
            const nPago = idPago.toString();

            // Generar los códigos QR con los valores obtenidos
            QR1.makeCode(nFolio);
            QR2.makeCode(nPago);
            QR3.makeCode(nFolio);
            QR4.makeCode(nPago);
        });
        
        // Función para imprimir la página
        function imprimir() {
            window.print(); // Abre el cuadro de diálogo de impresión    
        }
        
    </script>
</body>

</html>