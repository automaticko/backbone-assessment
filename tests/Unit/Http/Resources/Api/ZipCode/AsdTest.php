<?php

namespace Tests\Unit\Http\Resources\Api\ZipCode;

use App\Models\ZipCode;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AsdTest
{
    use RefreshDatabase;

    /** @test */
    public function it_has_correct_fields()
    {
        $row = 1;
        if (($handle = fopen(base_path("data.csv"), "r")) !== false) {
            while (($data = fgetcsv($handle, 1000, "|")) !== false) {
                if ($row === 1) {
                    $row++;
                    continue;
                }

                /*
    00 d_codigo Código Postal asentamiento
    01 d_asenta Nombre asentamiento
    02 d_tipo_asenta Tipo de asentamiento (Catálogo SEPOMEX)
    03 D_mnpio Nombre Municipio (INEGI, Marzo 2013)
    04 d_estado Nombre Entidad (INEGI, Marzo 2013)
    05 d_ciudad Nombre Ciudad (Catálogo SEPOMEX)
    06 d_CP Código Postal de la Administración Postal que reparte al asentamiento
    07 c_estado Clave Entidad (INEGI, Marzo 2013)
    08 c_oficina Código Postal de la Administración Postal que reparte al asentamiento
    09 c_CP Campo Vacio
    10 c_tipo_asenta Clave Tipo de asentamiento (Catálogo SEPOMEX)
    11 c_mnpio Clave Municipio (INEGI, Marzo 2013)
    12 id_asenta_cpcons Identificador único del asentamiento (nivel municipal)
    13 d_zona Zona en la que se ubica el asentamiento (Urbano/Rural)
    14 c_cve_ciudad Clave Ciudad (Catálogo SEPOMEX)
                 */ //$zipCode = new ZipCode([
                //]);

                /** @var ZipCode $zipCode */
                $zipCode = ZipCode::whereZipCode($data[0])->firstOrCreate([
                    'zip_code'            => (int) $data[0],
                    'locality'            => utf8_encode($data[5]),
                    'federal_entity_key'  => (int) $data[7],
                    'federal_entity_name' => utf8_encode($data[4]),
                    'municipality_key'    => (int) $data[11],
                    'municipality_name'   => utf8_encode($data[3]),
                ]);

                $zipCode->settlements()->create([
                    'key' => (int) $data[10],
                    'name' => utf8_encode($data[1]),
                    'zone' => utf8_encode($data[13]),
                    'type' => utf8_encode($data[2]),
                ]);

                $row++;

                if ($row == 20) {
                    break;
                }
            }
            fclose($handle);
        }
    }
}
