<?php
#este código define una extensión de Twig que proporciona un filtro personalizado llamado currency para formatear números como valores de moneda en las plantillas Twig.

namespace App\Twig;
use Twig\Extension\AbstractExtension;
use Twig\TwigFilter;

class CurrencyFilterExtension extends AbstractExtension
{
    // esta funcion es obligatoria para que twig reconozca el filtro que hemos creado en la clase CurrencyFilterExtension y lo pueda usar en las vistas twig
    public function getFilters()
    {
        // el primer parametro es el nombre del filtro que vamos a usar en las vistas twig y el segundo es el nombre de la funcion que hemos creado en la clase CurrencyFilterExtension
        return [
            new TwigFilter('currency', [$this, 'formatCurrency']),
        ];
    }

    // esta funcion es la que se ejecuta cuando llamamos al filtro currency en las vistas twig
    public function formatCurrency($number, $currency = 'EUR')
    {
        // number_format es una funcion de php que formatea un numero con decimales y le podemos pasar el numero de decimales que queremos que tenga 
        return '$' . number_format($number, 2) . ' ' . $currency;
    }
}
