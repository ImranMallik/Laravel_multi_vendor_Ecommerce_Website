<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\VendorProfile;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class VendorShopProfileSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $vendor = new VendorProfile();
        $user = User::where('email', 'vendor@gmail.com')->first();

        $vendor->banner = 'uploads/1234.jpg';
        $vendor->shope_name = 'Vendor Shop';
        $vendor->phone = '8116334';
        $vendor->email = 'vendor@gmail.com';
        $vendor->address = 'Osmanpur';
        $vendor->description = 'Shop Description';
        $vendor->user_id = $user->id;
        $vendor->save();
    }
}
