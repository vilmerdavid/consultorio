<?php

use App\Models\Enfermedad;
use App\Models\Sintoma;
use App\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;
class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();
        $role=Role::where('name','Doctor')->first();
        if(!$role){
            $role = Role::create(['name' => 'Doctor']);
        }
        
        $email='mary@gmail.com';

        $user=User::where('email',$email)->first();

        if(!$user){
            $user=new User();

            $user->name = $email;
            $user->email = $email;
            $user->password = Hash::make($email);
            $user->save();
        }

        $user->assignRole($role);

        // aqui los nombres de las enfermedades
        $enfermdades = array('Amigdalitis','Bronquitis','Neumonia','Rinifaringitis','Otros');
        foreach ($enfermdades as $enf) {
            $e=Enfermedad::where('nombre',$enf)->first();
            if(!$e){
                $e=new Enfermedad();
                $e->nombre=$enf;
                $e->save();
            }
        }


        $sintomas = array(
            'Amígdalas rojas e inflamadas',
            'Parches o recubrimientos blancos o amarillos en las amígdalas',
            'Dolor de garganta',
            'Dificultad o dolor al tragar',
            'Fiebre',
            'Glándulas sensibles y dilatadas (ganglios linfáticos) en el cuello',
            'Una voz rasposa, apagada o ronca',
            'Mal aliento',
            'Dolor estomacal, en especial en los niños pequeños',
            'Rigidez en el cuello',
            'Dolor de cabeza',
            'Tos',
            'Producción de mucosidad (esputo), que puede ser transparente, blanca, de color gris amarillento o verde rara vez, puede presentar manchas de sangre',
            'Fatiga',
            'Dificultad para respirar',
            'Fiebre ligera y escalofríos',
            'Molestia en el pecho',
            'Dolor en el pecho al respirar o toser',
            'Desorientación o cambios de percepción mental (en adultos de 65 años o más).',
            'Tos que puede producir flema',
            'Fiebre, transpiración y escalofríos con temblor',
            'Temperatura corporal más baja de lo normal (en adultos mayores de 65 años y personas con un sistema inmunitario débil)',
            'Náuseas, vómitos o diarrea',    
            'Toser',
            'Congestión',
            'Dolores corporales o dolor de cabeza leves',
            'Estornudos',
            'Fiebre baja',
            'En general, no sentirse bien (malestar general)',
            'Enrojecimiento de la faringe',
            'Ganglios cervicales inflamados.',
            'Fiebre mayor que 100 °F (38 °C), aunque no todas las personas con gripe tienen fiebre',
            'Tos o dolor de garganta',
            'Goteo o congestión nasal',
            'Dolores musculares',
            'Escalofríos',
            'Náuseas, vómitos o diarrea (más común en los niños)',
        );

        foreach ($sintomas as $sin) {
            $s=Sintoma::where('nombre',$sin)->first();
            if(!$s){
                $s=new Sintoma();
                $s->nombre=$sin;
                $s->save();
            }
        }
        
    }
}
