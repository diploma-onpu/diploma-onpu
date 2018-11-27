<?php

namespace App\Http\Controllers;

use App\Models\DeviceParams;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;

class ContentController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /*
     * 1 килобайт (КБ) - 256 итераций тк параметр 'N' - беззнаковый long (всегда 32 бита, порядок big endian)
     * 1 МБ - 1024 КБ или всего 262144 итераций.
     * 3 Мб = 3145728 Б
     * Во время кодирования в JSON каждый бинарный символ увеличивается в 6 раз
     * поэтому кол-во итераций уменьшим в 6 раз (увеличение скорости).
     * Генерим 3 МБ
     * В результате будет строка размером 3145756 байт, где погрешность составит 28 байт поэтому
     * кол-во итераций уменьшим на 1, в результате погрешность составит всего 4 байта, а размер будет 3145732 байт
     * */
    public function determineSpeed(Request $request)
    {
        $data = '';
        for ($i = 0; $i < 131071; $i++) {
            $data .= pack('N', 1);
        }

        $t = microtime(true) * 1000;

        echo \json_encode([(int)$t, $data]);
    }
}
