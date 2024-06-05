<style>
  .seccion-menu {
    display: flex;
    justify-content: center;
    align-items: center;
    margin: 20px 15px 40px 15px;
    flex-direction: column;
  }

  @media (min-width: 768px) {
    .seccion-menu {
      display: grid;
      grid-template-columns: 1fr 1fr;
      grid-gap: 20px;
    }
  }

  @media (min-width: 1000px) {
    .seccion-menu {
      display: grid;
      grid-template-columns: 1fr 1fr 1fr 1fr;
      grid-gap: 30px;
    }
  }

  .menu__boton {
    width: 100%;
    height: 130px;

    display: grid;
    grid-template-columns: 1fr 1fr;
    align-items: center;
    justify-content: space-between;
    padding: 15px;
    border-radius: 10px;
    color: #fff;
    margin-top: 20px;
    text-decoration: none;
    box-shadow: 0 8px 10px rgba(0, 0, 0, 0.5);
  }

  @media (min-width: 768px) {
    .menu__boton {
      width: 95%;
    }
  }

  /* Home (Degradado de azul oscuro a azul claro) */
  .menu__boton:nth-child(1) {
    background: linear-gradient(to top left, #0D47A1, #42A5F5);
  }

  .menu__boton:nth-child(1):hover {
    background: linear-gradient(to bottom right, #42A5F5, #0D47A1);
  }
  a:hover{
    color:white !important;
  }

  /* Inscripciones (Degradado de naranja oscuro a naranja claro) */
  .menu__boton:nth-child(2) {
    background: linear-gradient(to top left, #E65100, #FFB74D);
  }

  .menu__boton:nth-child(2):hover {
    background: linear-gradient(to bottom right, #FFB74D, #E65100);
  }

  /* Proyectos (Degradado de verde oscuro a verde claro) */
  .menu__boton:nth-child(3) {
    background: linear-gradient(to top left, #1B5E20, #4CAF50);
  }

  .menu__boton:nth-child(3):hover {
    background: linear-gradient(to bottom right, #4CAF50, #1B5E20);
  }

  /* Pagos (Degradado de morado oscuro a morado claro) */
  .menu__boton:nth-child(4) {
    background: linear-gradient(to top left, #6A1B9A, #9C27B0);
  }

  .menu__boton:nth-child(4):hover {
    background: linear-gradient(to bottom right, #9C27B0, #6A1B9A);
  }

  .boton__info {
    text-align: start;
    display: flex;
    flex-direction: column;
    justify-content: space-evenly;
    font-size: 20px;
  }

  .info__titulo {
    margin-bottom: 20px;
    font-weight: bold;
  }

  .info__total {}

  .boton__icon {
    text-align: end;
  }

  .fas {
    font-size: 60px;
  }
  .boton__icon .fas{
    color:white !important;
    
  }

  .container-graficas {
    margin-top: 20px;
    width: 100%;
  }

  .graficas {
    width: 100%;
    display: grid;
    place-items: center;
    grid-column-gap: 5px;
    /* Espacio entre las columnas */
    grid-row-gap: 45px;
    /* Espacio entre las filas */
  }

  @media (min-width: 1000px) {
    .graficas {
      grid-template-columns: 1fr 1fr;
    }
  }

  .graficas-title {
    font-family: 'Roboto', sans-serif;
    font-size: 16px;
  }

  @media (min-width: 468px) {
    .graficas-title {
      font-size: 20px;
    }
  }

  .title-inscripcion {
    color: #42A5F5;
  }

  .title-pago {
    color: #4CAF50;
  }

  .grafica {
    width: 91%;
    background-color: #f9f9f9;
    padding: 10px;
    border-radius: 10px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    border: 1px solid #ccc;
  }

  .grafica:nth-child(1) {
    border: 1px solid #42A5F5;
  }

  .grafica:nth-child(2) {
    border: 1px solid #4CAF50;
  }

  .graficasFecha {
    display: flex;
    align-items: center;
    justify-content: center;                            
    margin-bottom: 40px;
}
.graficasFecha h2 {
    margin: 0 15px;
    font-size: 30px;
    color: #333;
}
.graficasFecha button {
        background-color: #007BFF;
        border: none;
        color: #fff;
        padding: 10px 15px;
        font-size: 18px;
        cursor: pointer;
        border-radius:
        transition: background-color 0.3s;
      }
      .graficasFecha button:hover {
          background-color: #0056b3;
      }
      .graficasFecha button:focus {
          outline: none;
      }
</style>
<x-app-layout>


  <section class="seccion-menu">

    <a href="{{route('inscripciones.index')}}" class="menu__boton">
      <div class="boton__info">
        <h3 class="info__titulo">Inscripciones</h3>
        <p class="info__total">#{{ $numinscripciones }}</p>
      </div>
      <div class="boton__icon">
        <i class="fas fa-users icon"></i>
      </div>
    </a>

    <a href="{{route('proyectos.index')}}" class="menu__boton">
      <div class="boton__info">
        <h3 class="info__titulo">Proyectos</h3>
        <p class="info__total">#{{ $numproyectos }}</p>
      </div>
      <div class="boton__icon">
        <i class="fas fa-tasks"></i>
      </div>
    </a>

    <a href="{{route('cheques.lista')}}" class="menu__boton">
      <div class="boton__info">
        <h3 class="info__titulo">Pagos</h3>
        <p class="info__total">#{{ $numpagos }}</p>
      </div>
      <div class="boton__icon">
        <i class="fas fa-money-bill-wave"></i>
      </div>
    </a>

    <a href="{{route('usuarios.index')}}" class="menu__boton">
      <div class="boton__info">
        <h3 class="info__titulo">Usuarios</h3>
        <p class="info__total">#{{ $numusuarios }}</p>
      </div>
      <div class="boton__icon">
        <i class="fas fa-user"></i>
      </div>
    </a>
  </section>

  <div class="container-graficas">
    <div class="graficasFecha">
      <button id="decrementarAnio"><</button>
      <h2 id="anio">2024</h2>
      <button id="incrementarAnio">></button>
    </div>
    <div class="graficas">
      <div class="grafica">
        <h2 class="graficas-title">Total de <span class="title-inscripcion">Inscripciones</span> Mensuales</h2>
        <canvas id="inscripcionNumero" width="400" height="200"></canvas>
      </div>
      <div class="grafica">
        <h2 class="graficas-title">Total de <span class="title-pago">Pagos</span> Mensuales</h2>
        <canvas id="pagosNumero" width="400" height="200"></canvas>
      </div>
      <!--<div class="grafica">
  <h2>Ganancias Mensuales por Inscripciones</h2>
  <canvas id="inscripcionGanancia" width="400" height="200"></canvas>
  </div>    	
  <div class="grafica">
  <h2>Ganancias Mensuales por Pagos</h2>
  <canvas id="pagosGanancia" width="400" height="200"></canvas>
  </div>-->
    </div>
  </div>



  </section>

  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</x-app-layout>