@extends("admin.layout.master")

@section("title", "Nuevo artículo")

@section("css")
    <link rel="stylesheet"	href="{{config('constants.framework_css')}}modal.css">
    <link rel="stylesheet"	href="{{config('constants.framework_css')}}layout.css">
    <link rel="stylesheet"	href="{{config('constants.framework_css')}}panel.css">
@endsection

@section("body")
    <div class="main-container">
        <h1>Nuevo artículo</h1>

        @if ($errors->any())
            <div class="alert danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{$error}}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        @if (session("success"))
            <div class="alert success">
                <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span>
                {{session("success")}}
            </div>
        @endif

        @if (session("error"))
            <div class="alert danger">
                <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span>
                {{session("error")}}
            </div>
        @endif

        @include('admin.articulos.modals.categoria')
        @include('admin.articulos.modals.subcategoria')

        <div class="grid grid-cols-12 grid-align-start gap3">
            <div class="col-span-6 col-span-900p-12">
                <div class="panel">
                    <div class="panel-title">Datos del producto</div>
                    <div class="panel-content">
                        <fieldset>
                            <legend>Categoría</legend>
                            <select form="form-upload" id="categoria_id" name="categoria_id">
                                <option value="" disabled selected>Categoría</option>
                                @foreach ($categorias as $categoria)
                                    <option value="{{ $categoria['id'] }}">{{ $categoria['nombre'] }}</option>
                                @endforeach
                            </select>

                            <select form="form-upload" id="subcategoria_id" name="subcategoria_id" disabled>
                                <option value="" disabled selected>Subcategoría</option>
                            </select>
                            <div class="flex">
                                <button form="form-upload" type="button" class="openModal" data-modal="1"><span><i class="fa-solid fa-plus"></i></span>Categoría</button>
                                <button form="form-upload" type="button" class="openModal" data-modal="2"><span><i class="fa-solid fa-plus"></i></span>Subcategoría</button>
                            </div>
                        </fieldset>

                        <fieldset>
                            <legend>Datos principales</legend>
                            <div class="flex">
                                <label for="codigo">Codigo</label>
                                <input type="text" id="codigo" name="codigo" class="{{ $errors->has('codigo') ? 'form-error' : '' }}" value="{{ old('codigo') }}" required>
                                @if ($errors->has('codigo'))
                                    <p class="field-validation-msg"><i class="fa-solid fa-triangle-exclamation"></i> {{ $errors->first('codigo') }}</p>
                                @endif
                            </div>
                            <div class="flex">
                                <label for="nombre">Nombre</label>
                                <input type="text" id="nombre" name="nombre" class="{{ $errors->has('nombre') ? 'form-error' : '' }}" value="{{ old('nombre') }}" required>
                                @if ($errors->has('nombre'))
                                    <p class="field-validation-msg"><i class="fa-solid fa-triangle-exclamation"></i> {{ $errors->first('nombre') }}</p>
                                @endif
                            </div>
                            <div class="flex">
                                <label for="descripcion">Descripción</label>
                                <input type="text" id="descripcion" name="descripcion" class="{{ $errors->has('descripcion') ? 'form-error' : '' }}" value="{{ old('descripcion') }}" required>
                                @if ($errors->has('descripcion'))
                                    <p class="field-validation-msg"><i class="fa-solid fa-triangle-exclamation"></i> {{ $errors->first('descripcion') }}</p>
                                @endif
                            </div>
                        </fieldset>

                        <fieldset>
                            <legend>Datos principales</legend>
                            <div class="flex">
                                <label for="precio">Precio</label>
                                <input type="text" id="precio" name="precio" class="{{ $errors->has('precio') ? 'form-error' : '' }}" value="{{ old('precio') }}" required>
                                @if ($errors->has('precio'))
                                    <p class="field-validation-msg"><i class="fa-solid fa-triangle-exclamation"></i> {{ $errors->first('precio') }}</p>
                                @endif
                            </div>
                            <div class="flex">
                                <label for="moneda">Moneda</label>
                                <select id="moneda" name="moneda" class="{{ $errors->has('moneda') ? 'form-error' : '' }}" required>
                                    <option value="" disabled selected>Seleccione...</option>
                                    <option value="1" {{ old('moneda') == 1 ? 'selected' : '' }}>Pesos</option>
                                    <option value="2" {{ old('moneda') == 2 ? 'selected' : '' }}>Dólares</option>
                                </select>
                                @if ($errors->has('moneda'))
                                    <p class="field-validation-msg"><i class="fa-solid fa-triangle-exclamation"></i> {{ $errors->first('moneda') }}</p>
                                @endif
                            </div>
                            <p class="nota">El precio del dólar se actualiza todos los días a las: FALTA</p>
                        </fieldset>

                        <fieldset>
                            <legend>Atributos</legend>
                            <div id="clone" class="flex row">
                                <select name="talles[]">
                                    <option value="" disabled selected>Talles</option>
                                    @foreach ($talles as $talle)
                                        <option value="{{ $talle['id'] }}">{{ $talle['talle'] }}</option>
                                    @endforeach
                                </select>
                                <input form="form-upload" type="number" name="stock[]" placeholder="Stock" min="1" required>
                                <input form="form-upload" type="color"  name="color[]">
                                <button class="btn-danger" onclick="eliminarAtributo(this.parentNode);" style="width: 70px; display: block"><i class="fa-solid fa-trash-can"></i></button>
                            </div>
                            <button form="form-upload" type="button" onclick="agregarAtributo();"><span><i class="fa-solid fa-plus"></i></span>Atributo</button>
                        </fieldset>

                        <script>
                            function agregarAtributo() {
                                const cloneDiv = document.querySelector("#clone");
                                let clone = cloneDiv.cloneNode(true);
                                clone.children[1].value = "";
                                clone.children[2].value = "";
                                clone.removeAttribute("id");
                                cloneDiv.after(clone);
                            }

                            function eliminarAtributo(element) {
                                if (element.id != "clone")
                                    element.remove();
                            }
                        </script>

                        <fieldset>
                            <legend>Presentación</legend>
                            <label for="detalle">Detalle del artículo</label>
                            <textarea id="detalle" name="detalle" form="form-upload">{{ old('detalle') }}</textarea>
                        </fieldset>

                        <button form="form-upload" type="submit" class="btn-primary"><span><i class="fa-solid fa-plus"></i></span>Publicar artículo</button>
                    </div>
                </div>
            </div>

            <div class="col-span-6 col-span-900p-12">
                <div class="panel">
                    <div class="panel-title">Imágenes</div>
                    <div class="panel-content">
                        <legend>Imagen principal</legend>
                        <div class="cropme" id="landscape" style="width: 100%; height: 285px; border: 1px dashed #ddd; background: #f1f1f1;">
                            <a href="javascript:;" id="crop-image" class="d-inline-block mybtn1"><i class="icofont-upload-alt"></i> Upload Image Here</a>
                        </div>
                        <input type="hidden" id="feature_photo" name="photo" value="">
                    </div>
                </div>
            </div>
        </div>

        <form id="form-upload" method="post" enctype="multipart/form-data" action="{{ route('articulos.store') }}">@csrf</form>
    </div>


    <script>
        document.addEventListener("DOMContentLoaded", load, false);

        $('.cropme').simpleCropper();

        const selectCategorias          = document.getElementById("categoria");
        const selectSubcategorias       = document.getElementById("subcategoria");
        
        const botonAgregarCategoria     = document.getElementById("modal_button_agregar_categoria");
        const botonAgregarSubcategoria  = document.getElementById("modal_button_agregar_subcategoria");
        
        function load()
        {
            botonAgregarCategoria.addEventListener("click", agregarCategoriaClick, false);
            botonAgregarSubcategoria.addEventListener("click", agregarSubcategoriaClick, false);
            selectCategorias.addEventListener("change", categoriasChangeEvent, false);
        }

        function agregarCategoriaClick()
        {
            //Controles del modal
            let inputName           = document.getElementById("modal_nombre_categoria");
            let inputDescripcion    = document.getElementById("modal_descripcion_categoria");
            let buttonLabel 	    = botonAgregarCategoria.innerHTML;

            botonAgregarCategoria.disabled 	= true;
            botonAgregarCategoria.innerHTML = "";
            botonAgregarCategoria.classList.add("button--loading");
            
            let xhttp 	    = new XMLHttpRequest()
            let url 	    = "/admin/ajax/agregaCategoria";
            let parametros  = {};
            
            parametros["nombre"]        = inputName.value;
            parametros["descripcion"]   = inputDescripcion.value;
            
            xhttp.onreadystatechange = function()
            {
                if(this.readyState == 4 && this.status == 200)
                {
                    //Reset boton agregar
                    botonAgregarCategoria.classList.remove("button--loading");
                    botonAgregarCategoria.innerHTML = buttonLabel;
                    botonAgregarCategoria.disabled = false;

                    //Reset controles
                    inputName.value         = "";
                    inputDescripcion.value  = "";
                    
                    //Reset select categorías
                    selectCategorias.disabled        = true;
                    selectCategorias.options.length  = 0;
                    addOption(selectCategorias,"","Categoría",true,true);
                    
                    //Reset select subcategorías
                    selectSubcategorias.disabled        = true;
                    selectSubcategorias.options.length  = 0;
                    addOption(selectSubcategorias,"","Subcategoría",true,true);
                    
                    //Recarga categorías
                    const array = JSON.parse(this.responseText);
                    for(let i=0;i<array.length;++i)
                        addOption(selectCategorias, array[i]["id"], array[i]["nombre"], false, false);

                    //Selecciona la nueva categoría

                    //Habilita select categorías y cierra el modal
                    selectCategorias.disabled = false;
                    modalClose(1);

                    createAlert("success", "Categoría creada exitosamente");
                }
            }

            xhttp.open("POST", url, true);
            xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            xhttp.send("parametros=" + JSON.stringify(parametros));
        }

        function agregarSubcategoriaClick()
        {
            //Controles del modal
            let modalSelectCategoria    = document.getElementById("modal_categoria");
            let inputName               = document.getElementById("modal_nombre_subcategoria");
            let inputDescripcion        = document.getElementById("modal_descripcion_subcategoria");
            let buttonLabel 	        = botonAgregarSubcategoria.innerHTML;

            botonAgregarSubcategoria.disabled   = true;
            botonAgregarSubcategoria.innerHTML 	= "";
            botonAgregarSubcategoria.classList.add("button--loading");

            let xhttp 	= new XMLHttpRequest()
            let url 	= "/admin/ajax/agregaSubcategoria";
            
            let parametros = {};
            parametros["idCategoria"]   = modalSelectCategoria.value;
            parametros["nombre"]        = inputName.value;
            parametros["descripcion"]   = inputDescripcion.value;

            xhttp.onreadystatechange = function()
            {
                if(this.readyState == 4 && this.status == 200)
                {             
                    //Reset boton agregar
                    botonAgregarSubcategoria.classList.remove("button--loading");
                    botonAgregarSubcategoria.innerHTML = buttonLabel;
                    botonAgregarSubcategoria.disabled = false;

                    //Reset controles
                    modalSelectCategoria.value  = "";
                    inputName.value             = "";
                    inputDescripcion.value      = "";

                    //Reset select subcategorías
                    selectSubcategorias.disabled        = true;
                    selectSubcategorias.options.length  = 0;
                    addOption(selectSubcategorias,"","Subcategoría",true,true);
                    
                    //Recarga subcategorías
                    const array = JSON.parse(this.responseText);
                    for(let i=0;i<array.length;++i)
                        addOption(selectSubcategorias, array[i]["nombre"], array[i]["descripcion"], false, false);

                    selectSubcategorias.disabled = false;
                    modalClose(2);

                    createAlert("success","Subcategoría creada exitosamente");
                }
            }

            xhttp.open("POST", url, true);
            xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            xhttp.send("parametros=" + JSON.stringify(parametros));
        }

        function addOption(selectElement,value,text,disabled,selected)
        {
            let option      = document.createElement("option");
            option.value    = value;
            option.text     = text;
            option.disabled = disabled;
            option.selected = selected;

            selectElement.add(option);
        }

        function categoriasChangeEvent()
        {
            let parametros  = {};
            let xhttp 	    = new XMLHttpRequest()
            let url 	    = "/admin/ajax/listadoSubcategorias";
            
            //Reset select subcategorías
            selectSubcategorias.disabled        = true;
            selectSubcategorias.options.length  = 0;
            addOption(selectSubcategorias,"","Subcategoría",true,true);

            parametros["categoria_id"] = selectCategorias.value;
            xhttp.onreadystatechange = function()
            {
                if(this.readyState == 4 && this.status == 200)
                {             
                    const array = JSON.parse(this.responseText);
                    if(array.length>0)
                    {
                        for(let i=0;i<array.length;++i)
                            addOption(selectSubcategorias, array[i]["id"], array[i]["nombre"], false, false);

                        selectSubcategorias.disabled = false;
                    }
                }
            }

            xhttp.open("POST", url, true);
            xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            xhttp.send("parametros=" + JSON.stringify(parametros));
        }

    </script>

@endsection
