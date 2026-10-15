<?php
session_start();
require __DIR__ . '/controllers/LibroController.php';
require __DIR__ . '/controllers/SocioController.php';
require __DIR__ . '/controllers/PrestamoController.php';
require __DIR__ . '/controllers/UsuarioController.php';



$accion = $_GET['accion'] ?? 'listar';

switch ($accion) {
    // LIBROS
    case 'listar':
        listarLibros();
        break;
    case 'formCrear':
        formCrearLibro();
        break;
    case 'crear':
        crearLibro();
        break;
    case 'formEditar':
        formEditarLibro();
        break;
    case 'editar':
        editarLibro();
        break;
    case 'eliminar':
        eliminarLibro();
        break;

    // SOCIOS
    case 'listarSocios':
        listarSocios();
        break;
    case 'formCrearSocio':
        formCrearSocio();
        break;
    case 'crearSocio':
        crearSocio();
        break;
    case 'formEditarSocio':
        formEditarSocio();
        break;
    case 'editarSocio':
        editarSocio();
        break;
    case 'eliminarSocio':
        eliminarSocio();
        break;

        // PRESTAMOS

    case 'listarPrestamos':
        listarPrestamos();
        break;
    case 'formCrearPrestamo':
        formCrearPrestamo();
        break;
    case 'crearPrestamo':
        crearPrestamo();
        break;
    case 'formEditarPrestamo':
        formEditarPrestamo();
        break;
    case 'editarPrestamo':
        editarPrestamo();
        break;
    case 'eliminarPrestamo':
        eliminarPrestamo();
        break;

        /// USUARIOS

        case 'listarUsuarios':
        listarUsuarios();
        break;
    case 'formCrearUsuario':
        formCrearUsuario();
        break;
    case 'crearUsuario':
        crearUsuario();
        break;
    case 'formEditarUsuario':
        formEditarUsuario();
        break;
    case 'editarUsuario':
        editarUsuario();
        break;
    case 'eliminarUsuario':
        eliminarUsuario();
        break;

        ///

        case 'login':
    formLogin();
    break;
case 'autenticar':
    login();
    break;
case 'logout':
    logout();
    break;

    default:
        http_response_code(404);
        echo 'Página no encontrada';
}
