<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
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
                        <p>{{ $inscripcion->importe }}</p>
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
                        <p>{{ $inscripcion->importe }}</p>
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
                        {{--  <p>{{ $fecha_regis }}</p>  --}}
                    </div>
                </div>
                <!--fin datos item-->
                <!--datos item-->
                <div class="item__datos">
                    <p class="datos__negrita">Fecha Deposito: </p>
                    <div class="datos__linea">
                        {{--  <p>{{ $fecha_formateada}}</p>  --}}
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
</body>
</html>