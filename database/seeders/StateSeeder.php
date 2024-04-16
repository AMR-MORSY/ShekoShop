<?php

namespace Database\Seeders;

use App\Models\State;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class StateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $Alexstates = [
            "Al Hadrah Qebli", "Amreya", "Anfoushi", "Asafra", "Azarita", "Bahary", "Bakos", "Baucalis", "Bolkly", "Camp Chezar", "Cleopatra", "Dekhela", "Downtown", "Alexandria", "El Atareen", "El Gomrok", "El Ibrahimiya",
            "El Labban", "El Maamora Beach", "El Maamora", "El Mandara", "El Manshiyya", "El Max, Alexandria", "El Qabary", "El Saraya", "El Soyof", "Fleming", "Gianaclis", "Glim", "Kafr Abdu", "Karmoz", "Kom El Deka", "Louran", "Mahatet El Raml", "Miami", "Moharam Bek", "Montaza", "Roshdy", "Saba Pasha", "Safar", "San Stefano", "Shatby", "Shods", "Sidi Bishr", "Sidi Gaber", "Smouha", "Sporting", "Stanley", "Tharwat", "Victoria", "Wardeyan", "Zezenia"
        ];
        $cairoStates = [
            "Abbassia", "Al-Darbal-Ahmar", "AinShams", "Azbakeya", "Badr", "Bulaq", "Daher", "Downtown", "El Rehab", "El Marg", "El Manial", "El Qobbah", "El Shorouk", "El Sakkakini", "Faggala", "Fifth Settlement", "First Settlement", "Fustat", "Garden City", "Helwan", "Heliopolis", "15th of May", "Madinaty", "Matareya", "Mokattam", "Maadi", "Manshiyat Naser", "Nasr City", "New Heliopolis", "Rhoda", "Rod El Farag", "Shubra", "ShubraEl Sahel", "Third Setelment", "Zeitoun", "Zamalek"
        ];
        $gizeStates = ["Agoza", "Atfeh", "Bulaq", "Dokki", "El Ayyat", "El Badrashein", "El Hawamdeya", "El Omraniya", "El Wahat El Bahariya", "El Saff", "El Warraq", "Faisal", "Haram", "Imbaba", "Mohandseen", "Kerdasa", "Sheikh Zayed City", "Talbia", "Ossim", "6th of October City"];
        foreach ($Alexstates as $state) {
            State::create([

                "state_name" => $state,
                "govern_id" => 1,
                "shipping_rate" => 75


            ]);
        }
        foreach ($cairoStates as $state) {
            State::create([

                "state_name" => $state,
                "govern_id" => 2,
                "shipping_rate" => 50


            ]);
        }
        foreach ($gizeStates as $state) {
            State::create([

                "state_name" => $state,
                "govern_id" => 3,
                "shipping_rate" => 50


            ]);
        }
    }
}
