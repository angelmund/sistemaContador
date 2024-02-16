<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Proyecto
 * 
 * @property int $id
 * @property string $clave_proyecto
 * @property string $nombre
 * @property string|null $descripcion
 * @property string|null $encargado
 * @property string|null $ubicacion
 * @property int|null $cantMaxParticipantes
 * @property float|null $presupuesto
 * @property Carbon|null $fecha_registro
 * @property int $estado
 * 
 * @property Collection|Cheque[] $cheques
 * @property Collection|Inscripcione[] $inscripciones
 * @property Collection|Pago[] $pagos
 *
 * @package App\Models
 */
class Proyecto extends Model
{
	protected $table = 'proyectos';
	public $timestamps = false;

	protected $casts = [
		'cantMaxParticipantes' => 'int',
		'presupuesto' => 'float',
		'fecha_registro' => 'datetime',
		'estado' => 'int'
	];

	protected $fillable = [
		'clave_proyecto',
		'nombre',
		'descripcion',
		'encargado',
		'ubicacion',
		'cantMaxParticipantes',
		'presupuesto',
		'fecha_registro',
		'estado'
	];

	public function cheques()
	{
		return $this->hasMany(Cheque::class, 'id_proyecto');
	}

	public function inscripciones()
	{
		return $this->hasMany(Inscripcione::class, 'clave_proyecto', 'clave_proyecto');
	}

	public function pagos()
	{
		return $this->hasMany(Pago::class, 'id_proyecto');
	}
}
