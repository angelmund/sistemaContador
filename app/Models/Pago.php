<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Pago
 * 
 * @property int $id
 * @property Carbon $fecha
 * @property Carbon $hora
 * @property float $monto
 * @property string $referencia_pago
 * @property string $descripcion
 * @property int $id_cliente
 * @property int $id_proyecto
 * @property int $id_usuario
 * 
 * @property Inscripcione $inscripcione
 * @property Proyecto $proyecto
 * @property User $user
 *
 * @package App\Models
 */
class Pago extends Model
{
	protected $table = 'pagos';
	public $timestamps = false;

	protected $casts = [
		'fecha' => 'datetime',
		'hora' => 'datetime',
		'monto' => 'float',
		'id_cliente' => 'int',
		'id_proyecto' => 'int',
		'id_usuario' => 'int',
		'estado' => 'int'
	];

	protected $fillable = [
		'fecha',
		'hora',
		'monto',
		'referencia_pago',
		'descripcion',
		'id_cliente',
		'id_proyecto',
		'id_usuario',
		'estado' => 'int'
	];

	public function inscripcione()
	{
		return $this->belongsTo(Inscripcione::class, 'id_cliente');
	}

	public function proyecto()
	{
		return $this->belongsTo(Proyecto::class, 'id_proyecto');
	}

	public function user()
	{
		return $this->belongsTo(User::class, 'id_usuario');
	}
}
