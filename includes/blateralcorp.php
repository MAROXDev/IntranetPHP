<?php
$current_page = basename($_SERVER['PHP_SELF']);
?>

<aside class="menuadmin">		 	
    <strong><p class="naranja"><i class="bi bi-archive-fill"></i> Contenido</p></strong>
    <ul class="slist">
        <a href="administrador.php"><li class="colgray <?php echo ($current_page == 'administrador.php') ? 'menadactve' : ''; ?>">Comunicados</li></a>
        <a href="adminwebinars.php"><li class="colgray <?php echo ($current_page == 'adminwebinars.php') ? 'menadactve' : ''; ?>">Webinars</li></a>
        <a href="adminproveedores.php"><li class="colgray <?php echo ($current_page == 'adminproveedores.php') ? 'menadactve' : ''; ?>">Proveedores</li></a>
        <a href="admindirectorio.php"><li class="colgray <?php echo ($current_page == 'admindirectorio.php') ? 'menadactve' : ''; ?>">Directorio</li></a>
        <a href="adminflyers.php"><li class="colgray <?php echo ($current_page == 'adminflyers.php') ? 'menadactve' : ''; ?>">Flyers</li></a>
        <a href="adminsala.php"><li class="colgray <?php echo ($current_page == 'adminsala.php') ? 'menadactve' : ''; ?>">Sala de Aprendizaje</li></a>
        <a href="admincertificaciones.php"><li class="colgray <?php echo ($current_page == 'admincertificaciones.php') ? 'menadactve' : ''; ?>">Certificaciones</li></a>
        <a href="adminherramientas.php"><li class="colgray <?php echo ($current_page == 'adminherramientas.php') ? 'menadactve' : ''; ?>">Herramientas</li></a>
    </ul>	 

    <strong><p class="naranja"><i class="bi bi-file-earmark-plus-fill"></i> Documentos Corporativo</p></strong>
    <ul class="slist">
        <a href="adminformatos.php"><li class="colgray <?php echo ($current_page == 'adminformatos.php') ? 'menadactve' : ''; ?>">Formatos</li></a>
        <a href="admincontratos.php"><li class="colgray <?php echo ($current_page == 'admincontratos.php') ? 'menadactve' : ''; ?>">Contratos</li></a>			 		
    </ul>	

    <strong><p class="naranja"><i class="bi bi-airplane-fill"></i> Agencias</p></strong>
    <ul class="slist">
        <a href="adminagencias.php"><li class="colgray <?php echo ($current_page == 'adminagencias.php') ? 'menadactve' : ''; ?>">Agencias Gani</li></a>
        <a href="admincorporativo.php"><li class="colgray <?php echo ($current_page == 'admincorporativo.php') ? 'menadactve' : ''; ?>">Documentos Corporativos</li></a>	
        <a href="adminpromocionales.php"><li class="colgray <?php echo ($current_page == 'adminpromocionales.php') ? 'menadactve' : ''; ?>">Promocionales</li></a>		 		
    </ul>

    <strong><p class="naranja"><i class="bi bi-people-fill"></i> Usuarios</p></strong>
    <ul class="slist">
        <a href="adminusuarios.php"><li class="colgray <?php echo ($current_page == 'adminusuarios.php') ? 'menadactve' : ''; ?>">Lista de Usuarios</li></a>		 		
    </ul>		 			
</aside>
