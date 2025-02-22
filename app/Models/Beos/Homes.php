<?php 

namespace App\Models\Beos;

use Illuminate\Database\Eloquent\Model;

class Homes extends Model
{
 protected $fillable = [
     'code',
     'portfolio_id',
     'city_id',
     'town_id',
     'district_id',
     'neighborhood_id',
     'area_m2',
     'land_no',
     'parcel_no',
     'total_area',
     'room_count',
     'year',
     'usage_status',
     'building_status',
     'floor_count',
     'which_floor',
     'heating',
     'entrance_gate_count',
     'arrival_date',
 ];
}