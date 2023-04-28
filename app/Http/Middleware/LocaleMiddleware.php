<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;

class LocaleMiddleware
{
    /**
     * Handle an incoming request.
     * 
     * La función handle és el método que se ejecuta cada vez que se recibe una solicitud HTTP
     * Esta función comprueba si la session del usuario tiene una variable de idioma 'locale' definida,
     * si es correcto App::setLocale() establece el idioma de la aplicación a ese valor, de lo contrario se mantiene el idioma por defecto
     * finalmente utilizamos $next para continuar con la ejecución de la tarea i torna la sol·licitud HTTP amb l'idioma de locale.
     * 
     * $request representa la solicitud HTTP entrante
     * Closure $next representa una función de cierre que és la siguiente acción que se debe ejecutar en la cadena del middleware
     *
     * @param  \Illuminate\Http\Request  $request 
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if(Session::has('locale')) {
        App::setLocale(Session::get('locale'));
        }

        return $next($request);
    }
}
