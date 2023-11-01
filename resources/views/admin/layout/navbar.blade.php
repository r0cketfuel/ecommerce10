<nav>
    <div class="navbar">
        <div class="logo">
            <a href="/admin/dashboard">{{ session("infoComercio.nombre") }}</a>
        </div>
		<div class="responsive-nav-icon" id="responsive-nav">
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

                        <li class="more">
                            <div>
                                <div class="submenu-link">Categorías</div>
                                <i class="fa-solid fa-caret-right more-arrow arrow"></i>
                            </div>
                            <ul class="more-sub-menu sub-menu">
                                <li><a href="/admin/categorias/">Categorías</a></li>
                                <li><a href="/admin/subcategorias/">Subcategorías</a></li>
                            </ul>
                        </li>

                        <li class="more">
                            <div>
                                <div class="submenu-link">Usuarios</div>
                                <i class="fa-solid fa-caret-right more-arrow arrow"></i>
                            </div>
                            <ul class="more-sub-menu sub-menu">
                                <li><a href="/admin/usuarios/">Listado</a></li>
                            </ul>
                        </li>

                    </ul>
                </li>
                
                <li class='main-menu'>
                    <div>
                        <a class='main-menu-link' href="#">Menú 2</a>
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

                        <li class="more">
                            <div>
                                <div class="submenu-link">Categorías</div>
                                <i class="fa-solid fa-caret-right more-arrow arrow"></i>
                            </div>
                            <ul class="more-sub-menu sub-menu">
                                <li><a href="/admin/categorias/">Categorías</a></li>
                                <li><a href="/admin/subcategorias/">Subcategorías</a></li>
                            </ul>
                        </li>

                        <li class="more">
                            <div>
                                <div class="submenu-link">Usuarios</div>
                                <i class="fa-solid fa-caret-right more-arrow arrow"></i>
                            </div>
                            <ul class="more-sub-menu sub-menu">
                                <li><a href="/admin/usuarios/">Listado</a></li>
                            </ul>
                        </li>

                    </ul>
                </li>

                <li class='main-menu'>
                    <div>
                        <a class='main-menu-link' href="#">Menú 3</a>
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

                        <li class="more">
                            <div>
                                <div class="submenu-link">Categorías</div>
                                <i class="fa-solid fa-caret-right more-arrow arrow"></i>
                            </div>
                            <ul class="more-sub-menu sub-menu">
                                <li><a href="/admin/categorias/">Categorías</a></li>
                                <li><a href="/admin/subcategorias/">Subcategorías</a></li>
                            </ul>
                        </li>

                        <li class="more">
                            <div>
                                <div class="submenu-link">Usuarios</div>
                                <i class="fa-solid fa-caret-right more-arrow arrow"></i>
                            </div>
                            <ul class="more-sub-menu sub-menu">
                                <li><a href="/admin/usuarios/">Listado</a></li>
                            </ul>
                        </li>

                    </ul>
                </li>

                <li class='main-menu'>
                    <div>
                        <a class='main-menu-link' href="/admin/logout">Logout</a>
                    </div>
                </li>

			</ul>
		</div>
	</div>
</nav>