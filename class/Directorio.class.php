<?php
class Directorio
{
    private $directorioRaiz;

    public function __construct($directorio)
    {
        $realPath = realpath($directorio);
        if (!$realPath || !is_dir($realPath)) {
            throw new Exception("La ruta proporcionada no es un directorio válido.");
        }
        $this->directorioRaiz = str_replace('\\', '/', $realPath);
    }

    public function arbolTransversal()
    {
        return $this->escanearDirectorio($this->directorioRaiz);
    }

    private function escanearDirectorio($directorio)
    {
        $contenidos = [];
        $elementos = scandir($directorio);

        foreach ($elementos as $elemento) {
            if ($elemento === '.' || $elemento === '..') {
                continue;
            }

            $ruta = $directorio . '/' . $elemento;

            if (is_dir($ruta)) {
                $contenidos[$elemento] = $this->escanearDirectorio($ruta);
            } else {
                $contenidos[] = $elemento;
            }
        }
        return $contenidos;
    }

    public function imprimirArbol($arbol = null, $prefijo = "", $rutaBase = "")
    {
        if ($arbol === null) {
            $arbol = $this->arbolTransversal();
            $rutaBase = $this->directorioRaiz;
        }

        $docRoot = str_replace('\\', '/', $_SERVER["DOCUMENT_ROOT"]);

        foreach ($arbol as $llave => $valor) {
            if (is_array($valor)) {
                $rutaDirectorio = $rutaBase . "/" . $llave;
                echo $prefijo . "<u><img style='width:16px; margin-right: 5px;' src='imgs/folder.jpg' border=0>" . $llave . "</u><br>" . PHP_EOL;
                $this->imprimirArbol($valor, $prefijo . "&nbsp;&nbsp;&nbsp;&nbsp;", $rutaDirectorio);
            } else {
                $rutaFisicaArchivo = $rutaBase . "/" . $valor;

                $rutaLimpia = str_replace('\\', '/', $rutaFisicaArchivo);
                $rutaRelativa = str_replace($docRoot, "", $rutaLimpia);
                $urlFinal = "http://" . $_SERVER["HTTP_HOST"] . $rutaRelativa;

                // --- NUEVA LÓGICA: OBTENER TAMAÑO Y FECHA ---
                $tamanoArchivo = filesize($rutaFisicaArchivo);
                $tamanoFormateado = $this->formatearTamanoArchivo($tamanoArchivo);

                // Obtenemos la fecha de última modificación (más fiable que ctime en muchos SO)
                $fechaUnix = filemtime($rutaFisicaArchivo);
                $fechaFormateada = date("d/m/Y H:i", $fechaUnix);

                echo $prefijo . "<a target='_blank' href='" . $urlFinal . "'> " . $valor . "</a> ";
                echo "<span style='color: #666; font-size: 0.9em;'>(" . $tamanoFormateado . " - " . $fechaFormateada . ")</span><br>" . PHP_EOL;
            }
        }
    }

    private function formatearTamanoArchivo($bytes)
    {
        if ($bytes >= 1073741824) {
            return number_format($bytes / 1073741824, 2) . ' GB';
        } elseif ($bytes >= 1048576) {
            return number_format($bytes / 1048576, 2) . ' MB';
        } elseif ($bytes >= 1024) {
            return number_format($bytes / 1024, 2) . ' KB';
        } else {
            return $bytes . ' bytes';
        }
    }
}
?>