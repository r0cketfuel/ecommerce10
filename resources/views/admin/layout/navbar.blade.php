<nav>
    <div class="navbar">
        <div class="logo">
            <a href="/admin/dashboard">{{ session("infoComercio.nombre") }}</a>
        </div>
		<div class="responsive-nav-icon">
			<div class="font-awesome-icon-bars">
				<i class="fa-solid fa-bars"></i>
			</div>
		</div>
		<div class="nav-links">
			<div class="sidebar-logo">
				<span class="logo-name">{{ session("infoComercio.nombre") }}</span>
				<div class='font-awesome-icon-close'>
					<i class="fa-solid fa-x"></i>
				</div>
			</div>
			<ul class="links">
                
                <li class='main-menu'>
                    <div>
                        <a class='main-menu-link' href="#">Administración</a>
                        <i class='fa-solid fa-caret-down menu-arrow arrow'></i>
                    </div>
                    <ul class="main-menu-links sub-menu">

                        <li class="more">
                            <div>
                                <a class="submenu-link" href="#">Artículos</a>
                                <i class="fa-solid fa-caret-right more-arrow arrow"></i>
                            </div>
                            <ul class="more-sub-menu sub-menu">
                                <li><a href="/admin/articulos/create">Nuevo</a></li>
                                <li><a href="/admin/articulos/">Listado</a></li>
                            </ul>
                        </li>

                        <li class="more">
                            <div>
                                <a class="submenu-link" href="#">Banners</a>
                                <i class="fa-solid fa-caret-right more-arrow arrow"></i>
                            </div>
                            <ul class="more-sub-menu sub-menu">
                                <li><a href="/admin/banners/create">Nuevo</a></li>
                                <li><a href="/admin/banners/">Listado</a></li>
                            </ul>
                        </li>                        
                    </ul>
                </li>                
                
                <!-- Menú Ordenes -->
                <li class='main-menu'>
                    <div>
                        <a class='main-menu-link' href="#">Ordenes</a>
                        <i class='fa-solid fa-chevron-down menu-arrow arrow'></i>
                    </div>
                    <ul class="main-menu-links sub-menu">
                        <a class='submenu-link' href='/admin/ordenes/listado'><li class='more'>listado</li></a>
                    </ul>
                </li>

                <!-- Menú Listados -->
                <li class='main-menu'>
                    <div>
                        <a class='main-menu-link' href="#">Listados</a>
                        <i class='fa-solid fa-chevron-down menu-arrow arrow'></i>
                    </div>
                    <ul class="main-menu-links sub-menu">
                        <a class='submenu-link' href='/admin/listados/simple'><li class='more'>Listado simple</li></a>
                        <a class='submenu-link' href='/admin/listados/filtros'><li class='more'>Listado con filtros</li></a>
                    </ul>
                </li>

                <!-- Menú Clientes -->
                <li class='main-menu'>
                    <div>
                        <a class='main-menu-link' href="#">Usuarios</a>
                        <i class='fa-solid fa-chevron-down menu-arrow arrow'></i>
                    </div>
                    <ul class="main-menu-links sub-menu">
                        <a class='submenu-link' href='/admin/clientes/listado/listado'><li class='more'>Listado</li></a>
                    </ul>
                </li>

                <!-- Menú Logout -->
                <li class='main-menu'>
                    <div>
                        <a class='main-menu-link' href="/admin/logout">Logout</a>
                    </div>
                </li>

			</ul>
		</div>
	</div>
</nav>