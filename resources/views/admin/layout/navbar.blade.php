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
                                <div class="submenu-link">Artículos</div>
                                <i class="fa-solid fa-caret-right more-arrow arrow"></i>
                            </div>
                            <ul class="more-sub-menu sub-menu">
                                <li><a href="/admin/articulos/">Listado</a></li>
                            </ul>
                        </li>

                        <li class="more">
                            <div>
                                <div class="submenu-link">Banners</div>
                                <i class="fa-solid fa-caret-right more-arrow arrow"></i>
                            </div>
                            <ul class="more-sub-menu sub-menu">
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
                        <li class='more'><a class='submenu-link' href='/admin/ordenes/listado'>listado</a></li>
                    </ul>
                </li>

                <!-- Menú Listados -->
                <li class='main-menu'>
                    <div>
                        <a class='main-menu-link' href="#">Listados</a>
                        <i class='fa-solid fa-chevron-down menu-arrow arrow'></i>
                    </div>
                    <ul class="main-menu-links sub-menu">
                        <li class='more'><a class='submenu-link' href='/admin/listados/simple'>Listado simple</a></li>
                        <li class='more'><a class='submenu-link' href='/admin/listados/filtros'>Listado con filtros</a></li>
                    </ul>
                </li>

                <!-- Menú Clientes -->
                <li class='main-menu'>
                    <div>
                        <a class='main-menu-link' href="#">Usuarios</a>
                        <i class='fa-solid fa-chevron-down menu-arrow arrow'></i>
                    </div>
                    <ul class="main-menu-links sub-menu">
                        <li class='more'><a class='submenu-link' href='/admin/clientes/listado/listado'>Listado</a></li>
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