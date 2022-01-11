<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Form;
use Illuminate\Support\Facades\DB;

class FormDemoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $campaign = [
            0 => "promoodonto",
            1 => "promoestetica",
        ];

        for ($i=1; $i<=100; $i++) {

            $commune = DB::table('communes')
                                ->inRandomOrder()
                                ->first();

            $form = new Form();
            $form->name = 'demo'.$i;
            $form->lastname = 'lastname'.$i;
            $form->phone = '1111'.$i;
            $form->email = 'demo'.$i.'@drsmile.cl';
            $form->commune_string = $commune->commune;
            $form->details = 'asdsad';
            $form->status_service = rand(0,2);
            $form->campaign = $campaign[rand(0,1)];
            $form->save();

        }
    }
}
