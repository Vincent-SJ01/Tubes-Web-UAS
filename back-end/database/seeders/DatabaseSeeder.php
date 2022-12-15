<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;
use App\Models\Paket;
use App\Models\Kurir;
use App\Models\DropPoint;
use App\Models\Service;
use App\Models\StatusPaket;
use App\Models\User;
use App\Models\JenisPaket;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->role();
        $this->jenisPaket();
        $this->service();
        $this->statusPaket();
        $this->droppoint();
        $this->status();
        $this->gender();
        // \App\Models\User::factory(10)->create();
        $faker = Faker::create();
        foreach(range(1, 10) as $index)
        {
            DB::table('users')->insert([
                'nama' => $faker->name,
                'username' => $faker->username,
                'password' => $faker->password,
                'email' => $faker->email,
                'alamat' => $faker->address,
                'idRole' => 1,
                'idStatus' => $faker->numberBetween(1, 0),
            ]);
        }

        $faker = Faker::create();
        foreach(range(1, 10) as $index)
        {
            DB::table('kurirs')->insert([
                'nik' => $faker->unique(true)->numberBetween(1000000, 9999999),
                'nama' => $faker->name,
                'username' => $faker->username,
                'password' => $faker->password,
                'email' => $faker->email,
                'alamat' => $faker->address,
                'tanggalLahir' => $faker->date,
                'noTelp' => $faker->phoneNumber,
                'gender' => $faker->numberBetween(1, 0),
                'idRole' => 1,
                'idStatus' => $faker->numberBetween(1, 0),
            ]);
        }

        $faker = Faker::create();
        foreach(range(1, 10) as $index)
        {
            $user = User::pluck('id')->toArray();
            $jenisPaket = JenisPaket::pluck('id')->toArray();
            $idService = Service::pluck('id')->toArray();
            $idStatusPaket = StatusPaket::pluck('id')->toArray();
            DB::table('pakets')->insert([
                'noResi' => $faker->unique(true)->numberBetween(1000000, 9999999),
                'idPengirim' => $faker->randomElement($user),
                'idService' => $faker->randomElement($idService),
                'jenisPaket' => $faker->randomElement($jenisPaket),
                'berat' => $faker->numberBetween(1, 100),
                'volume' => $faker->numberBetween(1, 100),
                'namaPenerima' => $faker->name,
                'noTelpPenerima' => $faker->phoneNumber,
                'AlamatTujuan' => $faker->address,
                'idStatus' => $faker->randomElement($idStatusPaket),
            ]);
        }

        $faker = Faker::create();
        foreach(range(1, 10) as $index)
        {
            $noResi = Paket::pluck('noResi')->toArray();
            $idKurir = Kurir::pluck('nik')->toArray();
            $idDroppoint = DropPoint::pluck('id')->toArray();
            DB::table('pengantarans')->insert([
                'noResi' => $faker->randomElement($noResi),
                'nikKurir' => $faker->randomElement($idKurir),
                'idDropPoint' => $faker->randomElement($idDroppoint),
                'keterangan' => $faker->text,
            ]);
        }
    }

    public function role(){
        $role = [
            [
                'id' => 1,
                'namaRole' => 'Admin',
            ],[
                'id' => 2,
                'namaRole' => 'Kurir',
            ],[
                'id' => 3,
                'namaRole' => 'User',
            ]
        ];

        DB::table('roles')->insert($role);
    }

    public function status(){
        $status = [
            [
                'id' => 0,
                'namaStatus' => 'Tidak Aktif',
            ],[
                'id' => 1,
                'namaStatus' => 'Aktif',
            ]
        ];

        DB::table('statuses')->insert($status);
    }

    public function gender(){
        $gender = [
            [
                'id' => 0,
                'namaGender' => 'Perempuan',
            ],[
                'id' => 1,
                'namaGender' => 'Laki-laki',
            ]
        ];
        
        DB::table('genders')->insert($gender);
    }

    public function jenisPaket(){
        $jenisPaket = [
            [
                'id' => 1,
                'namaJenisPaket' => 'Reguler',
            ],[
                'id' => 2,
                'namaJenisPaket' => 'Kilat',
            ]
        ];
        
        DB::table('jenis_pakets')->insert($jenisPaket);
    }

    public function service(){
        $service = [
            [
                'id' => 1,
                'nama' => 'Same Day Delivery',
                'estimatedTime' => '1 hari'
            ],[
                'id' => 2,
                'nama' => 'Regular Delivery',
                'estimatedTime' => '2-5 hari'
            ],[
                'id' => 3,
                'nama' => 'Late Game Delivery',
                'estimatedTime' => '5-7 hari'
            ]
        ];
        
        DB::table('services')->insert($service);
    }

    public function kota(){
        $kota = [
            [
                'id' => 1,
                'namaKota' => 'Jakarta',
            ],[
                'id' => 2,
                'namaKota' => 'Bandung',
            ],[
                'id' => 3,
                'namaKota' => 'Surabaya',
            ],[
                'id' => 4,
                'namaKota' => 'Bali',
            ],[
                'id' => 5,
                'namaKota' => 'Medan',
            ],[
                'id' => 6,
                'namaKota' => 'Palembang',
            ],[
                'id' => 7,
                'namaKota' => 'Semarang',
            ],[
                'id' => 8,
                'namaKota' => 'Yogyakarta',
            ]
        ];

        DB::table('kotas')->insert($kota);
    }

    public function droppoint(){
        $this->kota();

        $droppoint = [
            [
                'id' => 1,
                'namaDroppoint' => 'Droppoint 1',
                'alamat' => 'Jl. Raya Bogor KM 42, Cibinong, Bogor',
                'idKota' => 1,
            ],[
                'id' => 2,
                'namaDroppoint' => 'Droppoint 2',
                'alamat' => 'Jl. Raya Bogor KM 42, Cibinong, Bogor',
                'idKota' => 2,
            ],[
                'id' => 3,
                'namaDroppoint' => 'Droppoint 3',
                'alamat' => 'Jl. Raya Bogor KM 42, Cibinong, Bogor',
                'idKota' => 1,
            ],[
                'id' => 4,
                'namaDroppoint' => 'Droppoint 4',
                'alamat' => 'Jl. Raya Bogor KM 42, Cibinong, Bogor',
                'idKota' => 2,
            ],[
                'id' => 5,
                'namaDroppoint' => 'Droppoint 5',
                'alamat' => 'Jl. Raya Bogor KM 42, Cibinong, Bogor',
                'idKota' => 1,
            ],[
                'id' => 6,
                'namaDroppoint' => 'Droppoint 6',
                'alamat' => 'Jl. Raya Bogor KM 42, Cibinong, Bogor',
                'idKota' => 1,
            ],[
                'id' => 7,
                'namaDroppoint' => 'Droppoint 7',
                'alamat' => 'Jl. Raya Bogor KM 42, Cibinong, Bogor',
                'idKota' => 4,
            ],[
                'id' => 8,
                'namaDroppoint' => 'Droppoint 8',
                'alamat' => 'Jl. Raya Bogor KM 42, Cibinong, Bogor',
                'idKota' => 3,
            ]
        ];

        DB::table('drop_points')->insert($droppoint);
    }

    public function statusPaket(){
        $statusPaket = [
            [
                'id' => 1,
                'status' => 'Pending',
            ],[
                'id' => 2,
                'status' => 'Dijemput',
            ],[
                'id' => 3,
                'status' => 'Diterima',
            ],[
                'id' => 4,
                'status' => 'Diantar',
            ],[
                'id' => 5,
                'status' => 'Selesai',
            ],[
                'id' => 6,
                'status' => 'Batal',
            ]
        ];

        DB::table('status_pakets')->insert($statusPaket);
    }
}
