<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use CodeIgniter\HTTP\CLIRequest;
use CodeIgniter\HTTP\IncomingRequest;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use Psr\Log\LoggerInterface;
use App\Models\Categoria_model;

/**
 * Class BaseController
 *
 * BaseController provides a convenient place for loading components
 * and performing functions that are needed by all your controllers.
 * Extend this class in any new controllers:
 *     class Home extends BaseController
 *
 * For security be sure to declare any new methods as protected or private.
 */
abstract class BaseController extends Controller
{
    /**
     * Instance of the main Request object.
     *
     * @var CLIRequest|IncomingRequest
     */
    protected $request;

    /**
     * An array of helpers to be loaded automatically upon
     * class instantiation. These helpers will be available
     * to all other controllers that extend BaseController.
     *
     * @var list<string>
     */
    protected $helpers = [];

    /**
     * Be sure to declare properties for any property fetch you initialized.
     * The creation of dynamic property is deprecated in PHP 8.2.
     */
    // protected $session;

    /**
     * @return void
     */
    public function initController(RequestInterface $request, ResponseInterface $response, LoggerInterface $logger)
    {
        // Do Not Edit This Line
        parent::initController($request, $response, $logger);

        // Preload any models, libraries, etc, here.

        // E.g.: $this->session = service('session');
    }

    protected function renderizarConNavbar(string $vista, array $datos = []): string
    {
        $navbar = $this->obtenerNavbar();
        $datosNavbar = ['categorias' => $this->obtenerCategoriasConProductosActivos()];

        return view($navbar, $datosNavbar)
            . view($vista, $datos)
            . view('layout/footer');
    }


    protected function obtenerNavbar(): string
    {
        $perfil = session()->get('perfil_id');

        if (session()->get('logueado')) {
            if ($perfil == 1) {
                if (session()->get('modo_cliente')) {
                    return 'layout/navbarAdminVisitante';
                }
                return 'layout/navbarAdmin';
            } elseif ($perfil == 2) {
                return 'layout/navbarCliente';
            }
        }

        return 'layout/navbar';
    }

    protected function obtenerCategoriasConProductosActivos(): array
    {
        $productoModel = new \App\Models\Producto_model();

        $resultados = $productoModel
            ->select('categorias.id_categoria, categorias.categoria_nombre')
            ->join('categorias', 'categorias.id_categoria = productos.categoria_id')
            ->where('productos.producto_estado', 1)
            ->groupBy('categorias.id_categoria, categorias.categoria_nombre')
            ->orderBy('categorias.categoria_nombre', 'ASC') // ✅ Ordena alfabéticamente
            ->findAll();

        return $resultados;
    }
}
