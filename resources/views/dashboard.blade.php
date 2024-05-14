
<x-app-layout>


    <div class="container mt-5">
        <div class="row ">
            <div class="col-xl-6 col-lg-6">
                <div class="card l-bg-blue-dark">
                    <div class="card-statistic-3 p-4">
                        <div class="card-icon card-icon-large"><i class="fas fa-users"></i></div>
                        <div class="mb-4">
                            <h1 class="card-title mb-0 text-center">Inscripciones</h1>
                        </div>
                        <div class="row align-items-center mb-2 d-flex justify-content-center">
                            <div class="col-12">
                                <a href="{{route('inscripciones.index')}}" class="d-flex align-items-center justify-content-center mb-0">
                                    Mostrar Inscripciones
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            {{--  <div class="col-xl-6 col-lg-6">
                <div class="card l-bg-green-dark">
                    <div class="card-statistic-3 p-4">
                        <div class="card-icon card-icon-large"><i class="fas fa-ticket-alt"></i></div>
                        <div class="mb-4">
                            <h1 class="card-title mb-0"></h1>
                        </div>
                        <div class="row align-items-center mb-2 d-flex">
                            <div class="col-8">
                                <h2 class="d-flex align-items-center mb-0">
                                    578
                                </h2>
                            </div>
                        </div>
                    </div>
                </div>
            </div>  --}}
            <div class="col-xl-6 col-lg-6">
                <div class="card l-bg-orange-dark">
                    <div class="card-statistic-3 p-4">
                        <div class="card-icon card-icon-large"><i class="fas fa-dollar-sign"></i></div>
                        <div class="mb-4">
                            <h1 class="card-title mb-0 text-center">Proyectos</h1>
                        </div>
                        <div class="row align-items-center mb-2 d-flex justify-content-center">
                            <div class="col-12">
                                <a href="{{route('proyectos.index')}}" class="d-flex align-items-center justify-content-center mb-0">
                                    Ver Proyectos
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
        </div>
    </div>
</x-app-layout>

