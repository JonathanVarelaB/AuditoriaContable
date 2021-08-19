angular.module('moduleSesion',[]);
angular.module('moduleBitacora',[]);

angular.module('moduleUsuarios', ['ngRoute'])
        .config(function ($routeProvider) {
            $routeProvider
                    .when('/', {
                        controller: 'controlUsuarioExistente',
                        templateUrl: 'usuarioExistente.php'
                    })
                    .when('/nuevo', {
                        controller: 'controlNuevoUsuario',
                        templateUrl: 'controlUsuarios/nuevoUsuario.php'
                    })
                    .when('/existente', {
                        controller: 'controlUsuarioExistente',
                        templateUrl: 'usuarioExistente.php'
                    })
                    .otherwise('/');
        });
angular.module('moduleCuentas',[]);

angular.module('RouteContribuyente', ['ngRoute'])
        .config(function ($routeProvider) {
            $routeProvider
                    .when('/', {
                        controller: 'controlContribuyenteExistente',
                        templateUrl: 'contribuyentes/contribuyenteExistente.php'
                    })
                    .when('/nuevo', {
                        controller: 'controlNuevoContribuyente',
                        templateUrl: 'contribuyentes/nuevoContribuyente.php'
                    })
                    .when('/existente', {
                        controller: 'controlContribuyenteExistente',
                        templateUrl: 'contribuyentes/contribuyenteExistente.php'
                    })
                    .when('/rangoImpuesto', {
                        controller: 'controlContribuyenteRango',
                        templateUrl: 'contribuyentes/rangoImpuesto.php'
                    })
                    .otherwise('/');
        });
angular.module('RouteAdministrar', ['ngRoute'])
        .config(function ($routeProvider) {
            $routeProvider
                    .when('/', {
                        controller: 'controlPrincipalPeriodo',
                        templateUrl: 'administrar/principal.php'
                    })
            $routeProvider
                    .when('/declaracionAnterior', {
                        controller: 'controlDeclaracion',
                        templateUrl: 'administrar/declaracionAnterior.php'
                    })
                    .when('/movimientos', {
                        controller: 'controlMovimientos',
                        templateUrl: 'administrar/movimientosPeriodo.php'
                    })
                    .when('/anticipos', {
                        controller: 'controlAnticipos',
                        templateUrl: 'administrar/anticipos.php'
                    })
                    .when('/mensual', {
                        controller: 'controlMensual',
                        templateUrl: 'reportes/mensual.php'
                    })
                    .when('/estadoResultados', {
                        controller: 'controlEstadoResultados',
                        templateUrl: 'reportes/estadoResultados.php'
                    })
                    .when('/balance', {
                        controller: 'controlBalanceGeneral',
                        templateUrl: 'reportes/balanceGeneral.php'
                    })
                    .when('/porcentuales', {
                        controller: 'controlPorcentuales',
                        templateUrl: 'reportes/porcentuales.php'
                    })
                    .when('/declaracionJurada', {
                        controller: 'controlDeclaracionJurada',
                        templateUrl: 'reportes/declaracionJurada.php'
                    })
                    .otherwise('/');
        });
        
angular.module('RoutePermanentes', ['ngRoute'])
        .config(function ($routeProvider) {
            $routeProvider
                    .when('/', {
                        controller: 'controlActivoFijo',
                        templateUrl: 'permanentes/activoFijo.php'
                    })
                    .when('/pasivo', {
                        controller: 'controlPasivo',
                        templateUrl: 'permanentes/pasivo.php'
                    })
                    .when('/patrimonio', {
                        controller: 'controlPatrimonio',
                        templateUrl: 'permanentes/patrimonio.php'
                    })
                    .when('/inversion', {
                        controller: 'controlInversion',
                        templateUrl: 'permanentes/inversion.php'
                    })
                    .otherwise('/');
        });