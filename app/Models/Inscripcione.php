<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Inscripcione
 * 
 * @property int $id
 * @property string $nombre_completo
 * @property string $direccion
 * @property string $clave_proyecto
 * @property string $nombre
 * @property string|null $comite
 * @property string $alcaldia
 * @property string $telefono
 * @property string $concepto
 * @property float $importe
 * @property string $numero_solicitud
 * @property Carbon $fecha_deposito
 * @property Carbon|null $fecha_registro
 * @property string $url_foto_cliente
 * @property string $url_foto_ine
 * @property Carbon|null $hora_registro
 * @property int $estado
 * 
 * @property Proyecto $proyecto
 * @property Collection|Cheque[] $cheques
 * @property Collection|Pago[] $pagos
 *
 * @package App\Models
 */
class Inscripcione extends Model
{
	protected $table = 'inscripciones';
	public $timestamps = false;

	protected $casts = [
		'importe' => 'float',
		'fecha_deposito' => 'datetime',
		'fecha_registro' => 'datetime',
		'hora_registro' => 'datetime',
		'estado' => 'int'
	];

	protected $fillable = [
		'nombre_completo',
		'direccion',
		'clave_proyecto',
		'nombre',
		'comite',
		'alcaldia',
		'telefono',
		'concepto',
		'importe',
		'numero_solicitud',
		'fecha_deposito',
		'fecha_registro',
		'url_foto_cliente',
		'url_foto_ine',
		'hora_registro',
		'estado'
	];

	public function proyecto()
	{
		return $this->belongsTo(Proyecto::class, 'clave_proyecto', 'clave_proyecto');
	}

	public function cheques()
	{
		return $this->hasMany(Cheque::class, 'id_cliente');
	}

	public function pagos()
	{
		return $this->hasMany(Pago::class, 'id_cliente');
	}
}
