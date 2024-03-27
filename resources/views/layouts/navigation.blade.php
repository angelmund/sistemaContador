
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
<link rel="stylesheet" href="{{asset('styles.css')}}">
<link rel="stylesheet" href="{{asset('stylesNavbar.css')}}">
<link rel="stylesheet" href="{{asset('normalize.css')}}">
<nav x-data="{ open: false }" class="bg-white border-b border-gray-100">
    <!-- NavBar --->
    {{--  <div class="overlay" id="overlay"></div>

    <button id="toggleMenu" class="open-menu-button">☰</button>

    <div id="menu">
        <img src="{{asset('img/logoB.png')}}" alt="Logo">
        <h1>Menú</h1>


        <ul>
            <ul class="list-unstyled d-flex align-items-center">
                <li class="d-flex align-items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-home" width="24"
                        height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                        stroke-linecap="round" stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                        <path d="M5 12l-2 0l9 -9l9 9l-2 0" />
                        <path d="M5 12v7a2 2 0 0 0 2 2h10a2 2 0 0 0 2 -2v-7" />
                        <path d="M9 21v-6a2 2 0 0 1 2 -2h2a2 2 0 0 1 2 2v6" />
                    </svg>
                    <a href="{{ route('dashboard') }}" class="ms-2 text-decoration-none">Dashboard</a>
                </li>
            </ul>
           
            <ul class="list-unstyled d-flex align-items-center">
                <li class="d-flex align-items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-user-bolt" width="24"
                        height="24" viewBox="0 0 24 24" stroke-width="2.5" stroke="#7bc62d" fill="none"
                        stroke-linecap="round" stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                        <path d="M8 7a4 4 0 1 0 8 0a4 4 0 0 0 -8 0" />
                        <path d="M6 21v-2a4 4 0 0 1 4 -4h4c.267 0 .529 .026 .781 .076" />
                        <path d="M19 16l-2 3h4l-2 3" />
                    </svg>
                    <a href="{{ route('usuarios.index') }}" class="ms-2 text-decoration-none">Usuarios</a>
                </li>
            </ul>
            <li class="main-menu" id="proyectos">
                <button id="btn-menu-proyectos">
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-folder-filled"
                        width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                        stroke-linecap="round" stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                        <path
                            d="M9 3a1 1 0 0 1 .608 .206l.1 .087l2.706 2.707h6.586a3 3 0 0 1 2.995 2.824l.005 .176v8a3 3 0 0 1 -2.824 2.995l-.176 .005h-14a3 3 0 0 1 -2.995 -2.824l-.005 -.176v-11a3 3 0 0 1 2.824 -2.995l.176 -.005h4"
                            fill="#D8A81B" />
                    </svg>
                    Proyectos
                </button>

                <ul class="sub-menu" id="sub-menu-proyecto">
                    <li>
                        <a href="{{route('proyectos.create')}}" style="display: flex; align-items: center;">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-plus" width="16"
                                height="16" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                stroke-linecap="round" stroke-linejoin="round" style="margin-right: 5px;">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                <path d="M12 5l0 14" />
                                <path d="M5 12l14 0" />
                            </svg>
                            Agregar Proyecto Nuevo
                        </a>
                    </li>
                    <li>
                        <a href="{{route('proyectos.index')}}" style="display: flex; align-items: center;">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-menu-2"
                                width="16" height="16" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"
                                fill="none" stroke-linecap="round" stroke-linejoin="round" style="margin-right: 5px;">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                <path d="M4 6l16 0" />
                                <path d="M4 12l16 0" />
                                <path d="M4 18l16 0" />
                            </svg>
                            Mostrar Proyectos
                        </a>
                    </li>

                </ul>
            </li>
            <li class="main-menu" id="inscripciones">
                <button id="btn-menu-inscripciones">
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-users-group" width="24"
                        height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                        stroke-linecap="round" stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                        <path d="M10 13a2 2 0 1 0 4 0a2 2 0 0 0 -4 0" />
                        <path d="M8 21v-1a2 2 0 0 1 2 -2h4a2 2 0 0 1 2 2v1" />
                        <path d="M15 5a2 2 0 1 0 4 0a2 2 0 0 0 -4 0" />
                        <path d="M17 10h2a2 2 0 0 1 2 2v1" />
                        <path d="M5 5a2 2 0 1 0 4 0a2 2 0 0 0 -4 0" />
                        <path d="M3 13v-1a2 2 0 0 1 2 -2h2" fill="#1BAFEA" />
                    </svg>
                    Inscripciones
                </button>

                <ul class="sub-menu" id="sub-menu-inscripciones">
                    <li>
                        <a href="{{route('inscripciones.form')}}" style="display: flex; align-items: center;">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-user-plus"
                                width="16" height="16" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"
                                fill="none" stroke-linecap="round" stroke-linejoin="round" style="margin-right: 5px;">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                <path d="M8 7a4 4 0 1 0 8 0a4 4 0 0 0 -8 0" />
                                <path d="M16 19h6" />
                                <path d="M19 16v6" />
                                <path d="M6 21v-2a4 4 0 0 1 4 -4h4" />
                            </svg>
                            Agregar Inscripción Nueva
                        </a>
                    </li>

                    <li>
                        <a href="{{route('inscripciones.index')}}" style="display: flex; align-items: center;">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-table"
                                width="16" height="16" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"
                                fill="none" stroke-linecap="round" stroke-linejoin="round" style="margin-right: 5px;">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                <path
                                    d="M3 5a2 2 0 0 1 2 -2h14a2 2 0 0 1 2 2v14a2 2 0 0 1 -2 2h-14a2 2 0 0 1 -2 -2v-14z" />
                                <path d="M3 10h18" />
                                <path d="M10 3v18" />
                            </svg>
                            Mostrar Inscripciones
                        </a>
                    </li>

                </ul>
            </li>

        </ul>
    </div>  --}}
    <div class="nav-bar__abrir">
		<button class="abrir__btn">
			<i class="fas fa-bars"></i>
		</button>
	</div>

	<nav class="nav-bar flex">
		<!--Menu 1-->
		<div class="nav-bar__cerrar flex">
			<button class="cerrar_btn">
				<i class="fas fa-times"></i>
			</button>
		</div>

		<div class="menu__nav-bar">
		    <div class="nav-bar__img">
			    <img class="img__logo" src="{{asset('img/logoB.png')}}" alt="logo Benita Galeana">
		    </div>

		    <ul class="nav-bar__menu">
                <a href="{{route('dashboard')}}" class="icon-btn title_icon fas fa-home">Inicio</a>
                {{--  <a href="{{route('cheques.lista')}}" class="icon-btn title_icon fas fa-home">Lista cheques y pagos</a>  --}}
                <br>
	        <!--Items Desplegable-->
			    <!--Menu__subitems-->
			    <li class="menu__submenu">
			    	<div class="submenu__title flex">
			    		<i class="icon-btn title__icon fas fa-folder"></i>
			    	    <p class="title__text">Proyectos</p>
			    	</div>

				    <ul class="submenu">
					    <!--item url para ir a otra ventana-->
					    <li class="submenu__item proyecto">
						    <a class="item__link" href="{{route('proyectos.create')}}">
						        <i class="fas fa-plus"></i>
						        <span>Agregar Proyecto</span>
						    </a>						    
					    </li>
					    <!--Fin item -->

					    <!--item url para ir a otra ventana-->
					    <li class="submenu__item">
						    <a class="item__link" href="{{route('proyectos.index')}}">
						        <i class="fas fa-table"></i>
						        <span>Mostrar Proyecto</span>
						    </a>	
					    </li>
					    <!--Fin item -->
				    </ul>
			    </li>
			    <!--Fin Menu__subitems-->

                <!--Menu__subitems-->
			    <li class="menu__submenu">
			    	<div class="submenu__title flex">
                        <i class="icon-btn title__icon fas fa-users"></i>
			    	    <p class="title__text">Usuarios</p>
			    	</div>

				    <ul class="submenu">
					    <!--item url para ir a otra ventana-->
					    <li class="submenu__item proyecto">
						    <a class="item__link" href="{{route('usuarios.index')}}">
						        <i class="fas fa-user"></i>
						        <span>Mostrar Usuarios</span>
						    </a>						    
					    </li>
					    <!--Fin item -->

					    <!--item url para ir a otra ventana-->
					    <li class="submenu__item">
						    <a class="item__link" href="{{route('usuarios.roles.index')}}">
						        <i class="fas fa-key"></i>
						        <span>Roles</span>
						    </a>	
					    </li>
					    <!--Fin item -->

                        <!--item url para ir a otra ventana-->
					    <li class="submenu__item">
						    <a class="item__link" href="{{route('usuarios.permisos.index')}}">
						        <i class="fas fa-lock"></i>
						        <span>Permisos</span>
						    </a>	
					    </li>
					    <!--Fin item -->
				    </ul>
			    </li>
			    <!--Fin Menu__subitems-->

			    <!--Menu__subitems-->
			    <li class="menu__submenu">
			    	<div class="submenu__title flex">
			    		<i class="icon-btn title__icon fas fa-user"></i>
			    	    <p class="title__text">Inscripciones</p>
			    	</div>

				    <ul class="submenu">
					    <!--item url para ir a otra ventana-->
					    <li class="submenu__item persona">
						    <a class="item__link" href="{{route('inscripciones.form')}}">
						        <i class="fas fa-plus"></i>
						        <span>Agregar Inscripci&oacute;n</span>
						    </a>						    
					    </li>
					    <!--Fin item -->

					    <!--item url para ir a otra ventana-->
					    <li class="submenu__item">
						    <a class="item__link" href="{{route('inscripciones.index')}}">
						        <i class="fas fa-table"></i>
						        <span>Mostrar Inscripci&oacute;n</span>
						    </a>	
					    </li>
					    <!--Fin item -->
				    </ul>
			    </li>
			    <!--Fin Menu__subitems-->

                <!--Menu__subitems-->
			    <li class="menu__submenu">
			    	<div class="submenu__title flex">
			    		<i class="icon-btn title__icon fas fa-folder"></i>
			    	    <p class="title__text">Cheques y Pagos</p>
			    	</div>

				    <ul class="submenu">
					    <!--item url para ir a otra ventana-->
					    <li class="submenu__item proyecto">
						    <a class="item__link" href="{{route('pagos.nuevo')}}">
						        <i class="fas fa-plus"></i>
						        <span>Agregar pago/cheque</span>
						    </a>						    
					    </li>
					    <!--Fin item -->

					    
                        <!--item url para ir a otra ventana-->
					    <li class="submenu__item">
						    <a class="item__link" href="{{route('cheques.lista')}}">
						        <i class="fas fa-table"></i>
						        <span>Mostrar pago/cheque</span>
						    </a>	
					    </li>
					    <!--Fin item -->

				    </ul>
			    </li>
			    <!--Fin Menu__subitems-->

		    </ul>
		</div>

		{{--  <!--Menu 2-->
		<div class="menu__nav-bar menu2 flex">
			<!-- Btn para configuracion de perfil-->
			<div class="nav-bar__item">
				<a class="item__btn configuracion" href="#">
					<i class="fas fa-cog"></i>
					<span>Configuracion</span>
				</a>
			</div>

			<!-- Btn para salir-->
			<div class="nav-bar__item">
				<a class="item__btn salir" href="#">
					<i class="fas fa-sign-out-alt"></i>
					<span>Salir</span>
				</a>
			</div>		
		</div>  --}}
	</nav>


    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-end h-16">

            <!-- Settings Dropdown -->
            <div class="hidden sm:flex sm:items-center sm:ms-6">
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button
                            class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none transition ease-in-out duration-150">
                            <div>{{ Auth::user()->name }}</div>

                            <div class="ms-1">
                                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg"
                                    viewBox="0 0 20 20">
                                    <path fill-rule="evenodd"
                                        d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                        clip-rule="evenodd" />
                                </svg>
                            </div>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <x-dropdown-link :href="route('profile.edit')">
                            {{ __('Profile') }}
                        </x-dropdown-link>

                        <!-- Authentication -->
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf

                            <x-dropdown-link :href="route('logout')" onclick="event.preventDefault();
                                                this.closest('form').submit();">
                                {{ __('Log Out') }}
                            </x-dropdown-link>
                        </form>
                    </x-slot>
                </x-dropdown>
            </div>

            <!-- Hamburger -->
            <div class="-me-2 flex items-center sm:hidden">
                <button @click="open = ! open"
                    class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition duration-150 ease-in-out">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex"
                            stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round"
                            stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden">
        {{-- <div class="pt-2 pb-3 space-y-1">
            <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                {{ __('Dashboard') }}
            </x-responsive-nav-link>
        </div> --}}

        <!-- Responsive Settings Options -->
        <div class="pt-4 pb-1 border-t border-gray-200">
            <div class="px-4">
                <div class="font-medium text-base text-gray-800">{{ Auth::user()->name }}</div>
                <div class="font-medium text-sm text-gray-500">{{ Auth::user()->email }}</div>
            </div>

            <div class="mt-3 space-y-1">
                <x-responsive-nav-link :href="route('profile.edit')">
                    {{ __('Profile') }}
                </x-responsive-nav-link>

                <!-- Authentication -->
                <form method="POST" action="{{ route('logout') }}">
                    @csrf

                    <x-responsive-nav-link :href="route('logout')" onclick="event.preventDefault();
                                        this.closest('form').submit();">
                        {{ __('Log Out') }}
                    </x-responsive-nav-link>
                </form>
            </div>
        </div>
    </div>
</nav>
<script src="{{asset('js/scriptNavbar.js')}}"></script>