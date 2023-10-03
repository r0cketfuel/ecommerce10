<nav>
	<div class="navbar">
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
                
                <!-- Menú Artículos -->
                <li class='main-menu'>
                    <div>
                        <a class='main-menu-link' href="#">Artículos</a>
                        <i class='fa-solid fa-chevron-down menu-arrow arrow'></i>
                    </div>
                    <ul class="main-menu-links sub-menu">
                        <a class='submenu-link' href='/admin/articulos/nuevo'><li class='more'>Nuevo</li></a>
                        <a class='submenu-link' href='/admin/articulos/listado'><li class='more'>Listado</li></a>
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
                        <a class='submenu-link' href='/admin/listados/simple.php'><li class='more'>Listado simple</li></a>
                        <a class='submenu-link' href='/admin/listados/filtros.php'><li class='more'>Listado con filtros</li></a>
                    </ul>
                </li>

                <!-- Menú Clientes -->
                <li class='main-menu'>
                    <div>
                        <a class='main-menu-link' href="#">Usuarios</a>
                        <i class='fa-solid fa-chevron-down menu-arrow arrow'></i>
                    </div>
                    <ul class="main-menu-links sub-menu">
                        <a class='submenu-link' href='/admin/clientes/listado/listado.php'><li class='more'>Listado</li></a>
                    </ul>
                </li>

                <!-- Menú Logout -->
                <li class='main-menu'>
                    <div>
                        <a class='main-menu-link' href="/admin/logout.php">Logout</a>
                    </div>
                </li>

			</ul>
		</div>
	</div>
</nav>