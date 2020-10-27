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
        
        $email='consulmed@andinanet.net';

        $user=User::where('email',$email)->first();

        if(!$user){
            $user=new User();

            $user->name = $email;
            $user->email = $email;
            $user->password = Hash::make('consulmed');
            $user->save();
        }

        $user->assignRole($role);

        // aqui los nombres de las enfermedades
        $enfermdades = array('Amigdalitis','Bronquitis','Neumonia','Rinofaringitis','Otros');
        foreach ($enfermdades as $enf) {
            $e=Enfermedad::where('nombre',$enf)->first();
            if(!$e){
                $e=new Enfermedad();
                $e->nombre=$enf;
                $e->save();
            }
        }


        $sintomasPaciente = array(
            'Dolor de garganta',
            'Dificultad o dolor al tragar',
            'Fiebre',
            'Una voz rasposa, apagada o ronca',
            'Mal aliento',
            'Dolor estomacal, en especial en los niños pequeños',
            'Rigidez en el cuello',
            'Dolor de cabeza',
            'Tos',
            'Producción de mucosidad (esputo), que puede ser transparente, blanca, de color gris amarillento o verde rara vez, puede presentar manchas de sangre',
            'Fatiga',
            'Dificultad para respirar',
            'Escalofríos',
            'Molestia en el pecho',
            'Dolor en el pecho al respirar o toser',
            'Desorientación o cambios de percepción mental (en adultos de 65 años o más).',
            'Náuseas',
            'Vómitos',
            'Diarrea',
            'Dolores corporales',
            'Estornudos',
            'Malestar general',
            'Enrojecimiento de la faringe',
            'Ganglios cervicales inflamados.',
            'Dolor de garganta',
            'Goteo',
            'Congestión nasal'
        );

        foreach ($sintomasPaciente as $sin) {
            $s=Sintoma::where(['nombre'=>$sin,'tipo'=>'paciente'])->first();
            if(!$s){
                $s=new Sintoma();
                $s->nombre=$sin;
                $s->tipo='paciente';
                $s->save();
            }
        }


        $sintomasDoctor = array(
            'Amígdalas rojas e inflamadas',
            'Parches o recubrimientos blancos o amarillos en las amígdalas',
            'Glándulas sensibles y dilatadas (ganglios linfáticos) en el cuello',
            'Dolor en el pecho al respirar o toser',
            'Congestión nasal',
            'Enrojecimiento de la faringe',
            'Ganglios cervicales inflamados.',
            'Taquicardía',
            'Ruidos anormales en pulmones',
            
        );
        foreach ($sintomasDoctor as $sinD) {
            $s_d=Sintoma::where(['nombre'=>$sinD,'tipo'=>'doctor'])->first();
            if(!$s_d){
                $s_d=new Sintoma();
                $s_d->nombre=$sinD;
                $s_d->tipo='doctor';
                $s_d->save();
            }
        }
        
    }
}
