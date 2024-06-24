<?php

namespace Database\Seeders;


use App\Models\Invoice;
use App\Models\Repair;
use App\Models\Role;
use App\Models\SparePart;
use App\Models\User;
use App\Models\Vehicle;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $roles = Role::all();

        User::factory(10)->create()->each(function ($user) use ($roles) {
            $randomRoleId = $roles->random(1)->first()->id;
            $user->roles()->attach($randomRoleId);
        });


        // Fill user_roles table
        $users = User::all();
        $users->each(function ($user) use ($roles) {
            $userRoles = $roles->random(rand(1, $roles->count()))->pluck('id')->toArray();
            $user->roles()->sync($userRoles);
        });




        $users = User::all();

        foreach ($users as $user) {
            $user->vehicles()->saveMany(
                Vehicle::factory()->count(rand(0, 3))->make()
            );
        }



        Invoice::factory()->count(200)->create()->each(function ($invoice) use ($users) {
            $randomUser = $users->random(1)[0];
            $invoice->user_id = $randomUser->id;
            $invoice->save();
        });

        $users = User::all();


        SparePart::factory()->count(100)->create();

        $invoices = Invoice::all();
        $cars = Vehicle::all();
        $mechanics = User::whereHas('roles', function ($query) {
            $query->where('name', 'mechanic');
        })->get();

        Repair::factory()->count(50)->create()->each(function ($repair) use ($invoices, $mechanics, $cars) {
            $randomInvoice = $invoices->random();
            $randomCar = $cars->random();
            $randomMechanic = $mechanics->random();

            $repair->invoice_id = $randomInvoice->id;
            $repair->vehicle_id = $randomCar->id;
            $repair->mechanic_id = $randomMechanic->id;
            $repair->save();
        });
        $spareParts = SparePart::all();

        $repairs = Repair::all();

        $repairs->each(function ($repair) use ($spareParts) {
            $sparePartsToAdd = $spareParts->random(rand(0, $spareParts->count()));

            $pivotData = $sparePartsToAdd->mapWithKeys(function ($sparePart) {
                return [$sparePart->id => ['quantity' => rand(1, 100)]];
            });

            $repair->spareParts()->syncWithoutDetaching($pivotData);
        });

    }
}
