<?php


namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\marca;

class MarcaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * 
     */
    public function run()
    {

  
        $marcs =[
        [
          'id'  => 100,    
          'nombre'=>'Valvoline',
          'creacion'=>'1866-01-01'
        ],
 
       [
          'id'  => 101, 
         'nombre'=>'Brembo',
         'creacion'=>'1961-05-15'
        ],
 
       [
          'id'  => 102, 
         'nombre'=>'Ohlins',
         'creacion'=>'1976-03-10'
        ],
 
       [
          'id'  => 103, 
         'nombre'=>'Mann-Filter',
         'creacion'=> '1941-04-10'
        ],
 
       [
          'id'  => 104, 
         'nombre'=>'Philips',
         'creacion'=>'1891-02-01'
        ],
 
       [
          'id'  => 105, 
         'nombre'=>'DID',
         'creacion'=>'1866-05-23'
        ],
 
       [
          'id'  => 106, 
         'nombre'=>'Pirelli',
         'creacion'=>'1866-02-21'
        ],
 
        [
          'id'  => 107, 
         'nombre'=>'Oxford',
         'creacion'=>'1866-10-04'
        ],
        
      ];
      marca::insert($marcs);
  }

}






      //  marca::create([
      //    'Nombre'=>"Valvoline",
      //    'Creacion'=>"1866-01-01"
      //  ]);

      //  marca::create([
      //   'Nombre'=>"Brembo",
      //   'Creacion'=>"1961-05-15"
      //  ]);

      //  marca::create([
      //   'Nombre'=>"Ohlins",
      //   'Creacion'=>"1976-03-10"
      //  ]);

      //  marca::create([
      //   'Nombre'=>"Mann-Filter",
      //   'Creacion'=> "1941-04-10"
      //  ]);

      //  marca::create([
      //   'Nombre'=>"Philips",
      //   'Creacion'=>"1891-02-01"
      //  ]);

      //  marca::create([
      //   'Nombre'=>"DID",
      //   'Creacion'=>"1866-05-23"
      //  ]);

      //  marca::create([
      //   'Nombre'=>"Pirelli",
      //   'Creacion'=>"1866-02-21"
      //  ]);

      //  marca::create([
      //   'Nombre'=>"Oxford",
      //   'Creacion'=>"1866-10-04"
      //  ]);

   

    

