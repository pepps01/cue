<?php

namespace Database\Seeders;

use App\Models\CarListing;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CarListingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $cars = [
            [
                "id" => 9632,
                "year" => 2018,
                "make" => "GMC",
                "model" => "Sierra 2500 HD Crew Cab",
                "type" => "Pickup"
            ],
            [
                "id" => 9633,
                "year" => 1994,
                "make" => "Audi",
                "model" => "100",
                "type" => "Sedan, Wagon"
            ],
            [
                "id" => 9634,
                "year" => 2001,
                "make" => "BMW",
                "model" => "Z8",
                "type" => "Convertible"
            ],
            [
                "id" => 9635,
                "year" => 1999,
                "make" => "Pontiac",
                "model" => "Grand Am",
                "type" => "Sedan, Coupe"
            ],
            [
                "id" => 9636,
                "year" => 2015,
                "make" => "Mercedes-Benz",
                "model" => "GL-Class",
                "type" => "SUV"
            ],
            [
                "id" => 9637,
                "year" => 2011,
                "make" => "Nissan",
                "model" => "Titan Crew Cab",
                "type" => "Pickup"
            ],
            [
                "id" => 9638,
                "year" => 2019,
                "make" => "Land Rover",
                "model" => "Range Rover Sport",
                "type" => "SUV"
            ],
            [
                "id" => 9639,
                "year" => 2008,
                "make" => "Subaru",
                "model" => "Tribeca",
                "type" => "SUV"
            ],
            [
                "id" => 9640,
                "year" => 2007,
                "make" => "Jeep",
                "model" => "Grand Cherokee",
                "type" => "SUV"
            ],
            [
                "id" => 9641,
                "year" => 1994,
                "make" => "Dodge",
                "model" => "Dakota Regular Cab",
                "type" => "Pickup"
            ],
            [
                "id" => 9642,
                "year" => 1995,
                "make" => "Honda",
                "model" => "del Sol",
                "type" => "Coupe"
            ],
            [
                "id" => 9643,
                "year" => 2010,
                "make" => "MAZDA",
                "model" => "RX-8",
                "type" => "Coupe"
            ],
            [
                "id" => 9644,
                "year" => 2012,
                "make" => "Chevrolet",
                "model" => "Tahoe",
                "type" => "SUV"
            ],
            [
                "id" => 9645,
                "year" => 2017,
                "make" => "Land Rover",
                "model" => "Range Rover Evoque",
                "type" => "SUV"
            ],
            ["id" => 9646, "year" => 2005, "make" => "GMC", "model" => "Envoy", "type" => "SUV"],
            ["id" => 9647, "year" => 2013, "make" => "GMC", "model" => "Yukon", "type" => "SUV"],
            [
                "id" => 9648,
                "year" => 2011,
                "make" => "Suzuki",
                "model" => "Grand Vitara",
                "type" => "SUV"
            ],
            [
                "id" => 9649,
                "year" => 1995,
                "make" => "Dodge",
                "model" => "Ram 3500 Club Cab",
                "type" => "Pickup"
            ],
            [
                "id" => 9650,
                "year" => 2007,
                "make" => "Toyota",
                "model" => "Tacoma Access Cab",
                "type" => "Pickup"
            ],
            [
                "id" => 9651,
                "year" => 2019,
                "make" => "Ford",
                "model" => "Transit 150 Wagon",
                "type" => "Van/Minivan"
            ],
            ["id" => 9652, "year" => 2016, "make" => "Acura", "model" => "MDX", "type" => "SUV"],
            [
                "id" => 9653,
                "year" => 2013,
                "make" => "Nissan",
                "model" => "Quest",
                "type" => "Van/Minivan"
            ],
            [
                "id" => 9654,
                "year" => 2019,
                "make" => "Jaguar",
                "model" => "XF",
                "type" => "Sedan, Wagon"
            ],
            [
                "id" => 9655,
                "year" => 1998,
                "make" => "Chevrolet",
                "model" => "Camaro",
                "type" => "Coupe, Convertible"
            ],
            [
                "id" => 9656,
                "year" => 2006,
                "make" => "Ford",
                "model" => "F350 Super Duty Super Cab",
                "type" => "Pickup"
            ],
            ["id" => 9657, "year" => 2017, "make" => "Audi", "model" => "A4", "type" => "Sedan"],
            [
                "id" => 9658,
                "year" => 1995,
                "make" => "Acura",
                "model" => "Integra",
                "type" => "Sedan, Hatchback"
            ],
            ["id" => 9659, "year" => 2006, "make" => "Saturn", "model" => "VUE", "type" => "SUV"],
            [
                "id" => 9660,
                "year" => 2020,
                "make" => "Chrysler",
                "model" => "Voyager",
                "type" => "Van/Minivan"
            ],
            [
                "id" => 9661,
                "year" => 2013,
                "make" => "Cadillac",
                "model" => "SRX",
                "type" => "SUV"
            ],
            [
                "id" => 9662,
                "year" => 2003,
                "make" => "Hyundai",
                "model" => "Elantra",
                "type" => "Sedan, Hatchback"
            ],
            [
                "id" => 9663,
                "year" => 1997,
                "make" => "Isuzu",
                "model" => "Hombre Regular Cab",
                "type" => "Pickup"
            ],
            [
                "id" => 9664,
                "year" => 2000,
                "make" => "Dodge",
                "model" => "Ram 3500 Quad Cab",
                "type" => "Pickup"
            ],
            [
                "id" => 9665,
                "year" => 2005,
                "make" => "Ford",
                "model" => "Escape",
                "type" => "SUV"
            ],
            [
                "id" => 9666,
                "year" => 2000,
                "make" => "Chevrolet",
                "model" => "3500 Extended Cab",
                "type" => "Pickup"
            ],
            [
                "id" => 9667,
                "year" => 2015,
                "make" => "GMC",
                "model" => "Sierra 3500 HD Regular Cab",
                "type" => "Pickup"
            ],
            [
                "id" => 9668,
                "year" => 2005,
                "make" => "Nissan",
                "model" => "Maxima",
                "type" => "Sedan"
            ],
            [
                "id" => 9669,
                "year" => 2004,
                "make" => "Toyota",
                "model" => "4Runner",
                "type" => "SUV"
            ],
            [
                "id" => 9670,
                "year" => 2013,
                "make" => "Dodge",
                "model" => "Dart",
                "type" => "Sedan"
            ],
            [
                "id" => 9671,
                "year" => 2005,
                "make" => "GMC",
                "model" => "Envoy XL",
                "type" => "SUV"
            ],
            [
                "id" => 9672,
                "year" => 1997,
                "make" => "Honda",
                "model" => "Civic",
                "type" => "Sedan, Coupe, Hatchback"
            ],
            [
                "id" => 9673,
                "year" => 2016,
                "make" => "Hyundai",
                "model" => "Tucson",
                "type" => "SUV"
            ],
            [
                "id" => 9674,
                "year" => 1994,
                "make" => "Hyundai",
                "model" => "Excel",
                "type" => "Sedan, Hatchback"
            ],
            [
                "id" => 9675,
                "year" => 2006,
                "make" => "Honda",
                "model" => "Accord",
                "type" => "Sedan, Coupe"
            ],
            [
                "id" => 9676,
                "year" => 2019,
                "make" => "Ford",
                "model" => "Transit 250 Van",
                "type" => "Van/Minivan"
            ],
            [
                "id" => 9677,
                "year" => 1992,
                "make" => "Honda",
                "model" => "Accord",
                "type" => "Sedan, Coupe, Wagon"
            ],
            [
                "id" => 9678,
                "year" => 2009,
                "make" => "Chevrolet",
                "model" => "Silverado 2500 HD Regular Cab",
                "type" => "Pickup"
            ],
            [
                "id" => 9679,
                "year" => 2004,
                "make" => "Chevrolet",
                "model" => "Silverado 3500 Extended Cab",
                "type" => "Pickup"
            ],
            [
                "id" => 9680,
                "year" => 2015,
                "make" => "BMW",
                "model" => "i3",
                "type" => "Hatchback"
            ],
            [
                "id" => 9681,
                "year" => 2020,
                "make" => "Ford",
                "model" => "Expedition",
                "type" => "SUV"
            ],
            [
                "id" => 9682,
                "year" => 2018,
                "make" => "Cadillac",
                "model" => "CTS-V",
                "type" => "Sedan"
            ],
            [
                "id" => 9683,
                "year" => 2010,
                "make" => "Jeep",
                "model" => "Wrangler",
                "type" => "SUV"
            ],
            [
                "id" => 9684,
                "year" => 2007,
                "make" => "Suzuki",
                "model" => "SX4",
                "type" => "Hatchback"
            ],
            [
                "id" => 9685,
                "year" => 2006,
                "make" => "Mercedes-Benz",
                "model" => "SLK-Class",
                "type" => "Convertible"
            ],
            [
                "id" => 9686,
                "year" => 2014,
                "make" => "Bentley",
                "model" => "Mulsanne",
                "type" => "Sedan"
            ],
            ["id" => 9687, "year" => 2016, "make" => "Audi", "model" => "S8", "type" => "Sedan"],
            [
                "id" => 9688,
                "year" => 2011,
                "make" => "GMC",
                "model" => "Savana 2500 Passenger",
                "type" => "Van/Minivan"
            ],
            [
                "id" => 9689,
                "year" => 2017,
                "make" => "Hyundai",
                "model" => "Ioniq Hybrid",
                "type" => "Hatchback"
            ],
            [
                "id" => 9690,
                "year" => 2012,
                "make" => "GMC",
                "model" => "Savana 2500 Passenger",
                "type" => "Van/Minivan"
            ],
            [
                "id" => 9691,
                "year" => 2015,
                "make" => "Mercedes-Benz",
                "model" => "B-Class",
                "type" => "Hatchback"
            ],
            [
                "id" => 9692,
                "year" => 2008,
                "make" => "Chevrolet",
                "model" => "Silverado 3500 HD Crew Cab",
                "type" => "Pickup"
            ],
            [
                "id" => 9693,
                "year" => 2009,
                "make" => "Ferrari",
                "model" => "430 Scuderia",
                "type" => "Coupe, Convertible"
            ],
            [
                "id" => 9694,
                "year" => 2018,
                "make" => "Nissan",
                "model" => "NV200",
                "type" => "Van/Minivan"
            ],
            [
                "id" => 9695,
                "year" => 2014,
                "make" => "Chevrolet",
                "model" => "Impala Limited",
                "type" => "Sedan"
            ],
            ["id" => 9696, "year" => 2011, "make" => "Audi", "model" => "Q5", "type" => "SUV"],
            [
                "id" => 9697,
                "year" => 2013,
                "make" => "Land Rover",
                "model" => "Range Rover",
                "type" => "SUV"
            ],
            [
                "id" => 9698,
                "year" => 2013,
                "make" => "Jaguar",
                "model" => "XF",
                "type" => "Sedan"
            ],
            [
                "id" => 9699,
                "year" => 2019,
                "make" => "Tesla",
                "model" => "Model 3",
                "type" => "Sedan"
            ],
            [
                "id" => 9700,
                "year" => 2005,
                "make" => "Nissan",
                "model" => "Altima",
                "type" => "Sedan"
            ],
            [
                "id" => 9701,
                "year" => 2007,
                "make" => "Cadillac",
                "model" => "SRX",
                "type" => "SUV"
            ],
            ["id" => 9702, "year" => 2010, "make" => "Lexus", "model" => "LS", "type" => "Sedan"],
            [
                "id" => 9703,
                "year" => 2004,
                "make" => "Nissan",
                "model" => "350Z",
                "type" => "Coupe, Convertible"
            ],
            [
                "id" => 9704,
                "year" => 1998,
                "make" => "GMC",
                "model" => "Savana 1500 Passenger",
                "type" => "Van/Minivan"
            ],
            ["id" => 9705, "year" => 2017, "make" => "BMW", "model" => "i8", "type" => "Coupe"],
            [
                "id" => 9706,
                "year" => 2013,
                "make" => "Chevrolet",
                "model" => "Suburban 1500",
                "type" => "SUV"
            ],
            [
                "id" => 9707,
                "year" => 1999,
                "make" => "Lincoln",
                "model" => "Continental",
                "type" => "Sedan"
            ],
            [
                "id" => 9708,
                "year" => 2018,
                "make" => "Lincoln",
                "model" => "MKZ",
                "type" => "Sedan"
            ],
            [
                "id" => 9709,
                "year" => 2009,
                "make" => "Toyota",
                "model" => "FJ Cruiser",
                "type" => "SUV"
            ],
            [
                "id" => 9710,
                "year" => 1996,
                "make" => "Chevrolet",
                "model" => "Lumina",
                "type" => "Sedan"
            ],
            [
                "id" => 9711,
                "year" => 2017,
                "make" => "FIAT",
                "model" => "124 Spider",
                "type" => "Convertible"
            ],
            [
                "id" => 9712,
                "year" => 1996,
                "make" => "Acura",
                "model" => "NSX",
                "type" => "Coupe, Convertible"
            ],
            [
                "id" => 9713,
                "year" => 2006,
                "make" => "Dodge",
                "model" => "Sprinter 2500 Passenger",
                "type" => "Van/Minivan"
            ],
            [
                "id" => 9714,
                "year" => 2015,
                "make" => "Kia",
                "model" => "Rio",
                "type" => "Sedan, Hatchback"
            ],
            [
                "id" => 9715,
                "year" => 2005,
                "make" => "Chevrolet",
                "model" => "Silverado 1500 Regular Cab",
                "type" => "Pickup"
            ],
            [
                "id" => 9716,
                "year" => 2015,
                "make" => "Chevrolet",
                "model" => "Spark EV",
                "type" => "Hatchback"
            ],
            [
                "id" => 9717,
                "year" => 2016,
                "make" => "Subaru",
                "model" => "Crosstrek",
                "type" => "SUV"
            ],
            [
                "id" => 9718,
                "year" => 2010,
                "make" => "Chevrolet",
                "model" => "Express 1500 Passenger",
                "type" => "Van/Minivan"
            ],
            [
                "id" => 9719,
                "year" => 1996,
                "make" => "Ford",
                "model" => "Econoline E250 Cargo",
                "type" => "Van/Minivan"
            ],
            [
                "id" => 9720,
                "year" => 2010,
                "make" => "INFINITI",
                "model" => "M",
                "type" => "Sedan"
            ],
            [
                "id" => 9721,
                "year" => 2008,
                "make" => "Chevrolet",
                "model" => "Express 3500 Passenger",
                "type" => "Van/Minivan"
            ],
            [
                "id" => 9722,
                "year" => 1993,
                "make" => "Nissan",
                "model" => "Maxima",
                "type" => "Sedan"
            ],
            [
                "id" => 9723,
                "year" => 2010,
                "make" => "Ford",
                "model" => "Ranger Regular Cab",
                "type" => "Pickup"
            ],
            [
                "id" => 9724,
                "year" => 2017,
                "make" => "GMC",
                "model" => "Canyon Crew Cab",
                "type" => "Pickup"
            ],
            [
                "id" => 9725,
                "year" => 2007,
                "make" => "GMC",
                "model" => "Savana 1500 Passenger",
                "type" => "Van/Minivan"
            ],
            [
                "id" => 9726,
                "year" => 2010,
                "make" => "Bentley",
                "model" => "Azure T",
                "type" => "Convertible"
            ],
            [
                "id" => 9727,
                "year" => 2006,
                "make" => "Chevrolet",
                "model" => "SSR",
                "type" => "Pickup"
            ],
            ["id" => 9728, "year" => 2018, "make" => "GMC", "model" => "Yukon", "type" => "SUV"],
            [
                "id" => 9729,
                "year" => 1992,
                "make" => "Isuzu",
                "model" => "Spacecab",
                "type" => "Pickup"
            ],
            [
                "id" => 9730,
                "year" => 2014,
                "make" => "GMC",
                "model" => "Sierra 1500 Crew Cab",
                "type" => "Pickup"
            ],
            [
                "id" => 9731,
                "year" => 1999,
                "make" => "Ford",
                "model" => "F150 Super Cab",
                "type" => "Pickup"
            ],
            [
                "id" => 9732,
                "year" => 2005,
                "make" => "Volkswagen",
                "model" => "Passat",
                "type" => "Sedan, Wagon"
            ],
            [
                "id" => 9733,
                "year" => 1998,
                "make" => "GMC",
                "model" => "Sonoma Regular Cab",
                "type" => "Pickup"
            ],
            [
                "id" => 9734,
                "year" => 2006,
                "make" => "Land Rover",
                "model" => "Range Rover Sport",
                "type" => "SUV"
            ],
            [
                "id" => 9735,
                "year" => 2009,
                "make" => "Bentley",
                "model" => "Azure",
                "type" => "Convertible"
            ],
            [
                "id" => 9736,
                "year" => 2009,
                "make" => "Nissan",
                "model" => "Versa",
                "type" => "Sedan, Hatchback"
            ],
            [
                "id" => 9737,
                "year" => 2006,
                "make" => "Mitsubishi",
                "model" => "Eclipse",
                "type" => "Coupe"
            ],
            [
                "id" => 9738,
                "year" => 1999,
                "make" => "Cadillac",
                "model" => "DeVille",
                "type" => "Sedan"
            ],
            [
                "id" => 9739,
                "year" => 1998,
                "make" => "Dodge",
                "model" => "Dakota Regular Cab",
                "type" => "Pickup"
            ],
            [
                "id" => 9740,
                "year" => 2013,
                "make" => "Volvo",
                "model" => "XC70",
                "type" => "Wagon"
            ],
            [
                "id" => 9741,
                "year" => 2005,
                "make" => "Ford",
                "model" => "Expedition",
                "type" => "SUV"
            ],
            [
                "id" => 9742,
                "year" => 2010,
                "make" => "Audi",
                "model" => "A6",
                "type" => "Sedan, Wagon"
            ],
            [
                "id" => 9743,
                "year" => 2012,
                "make" => "Audi",
                "model" => "A5",
                "type" => "Coupe, Convertible"
            ],
            [
                "id" => 9744,
                "year" => 1998,
                "make" => "Ford",
                "model" => "F250 Super Cab",
                "type" => "Pickup"
            ],
            [
                "id" => 9745,
                "year" => 2009,
                "make" => "Chevrolet",
                "model" => "Cobalt",
                "type" => "Sedan, Coupe"
            ],
            [
                "id" => 9746,
                "year" => 1994,
                "make" => "Chevrolet",
                "model" => "2500 Extended Cab",
                "type" => "Pickup"
            ],
            [
                "id" => 9747,
                "year" => 1993,
                "make" => "Oldsmobile",
                "model" => "Achieva",
                "type" => "Sedan, Coupe"
            ],
            [
                "id" => 9748,
                "year" => 2018,
                "make" => "Ford",
                "model" => "F150 Regular Cab",
                "type" => "Pickup"
            ],
            [
                "id" => 9749,
                "year" => 2010,
                "make" => "Honda",
                "model" => "Civic",
                "type" => "Sedan, Coupe"
            ],
            [
                "id" => 9750,
                "year" => 2018,
                "make" => "Toyota",
                "model" => "Yaris",
                "type" => "Hatchback"
            ],
            [
                "id" => 9751,
                "year" => 1997,
                "make" => "Mitsubishi",
                "model" => "Eclipse",
                "type" => "Coupe, Convertible"
            ],
            [
                "id" => 9752,
                "year" => 2002,
                "make" => "GMC",
                "model" => "Safari Passenger",
                "type" => "Van/Minivan"
            ],
            [
                "id" => 9753,
                "year" => 2000,
                "make" => "Lincoln",
                "model" => "Navigator",
                "type" => "SUV"
            ],
            [
                "id" => 9754,
                "year" => 2004,
                "make" => "BMW",
                "model" => "3 Series",
                "type" => "Sedan, Coupe, Convertible, Wagon"
            ],
            [
                "id" => 9755,
                "year" => 2005,
                "make" => "Volkswagen",
                "model" => "Jetta",
                "type" => "Sedan, Wagon"
            ],
            [
                "id" => 9756,
                "year" => 2016,
                "make" => "Hyundai",
                "model" => "Sonata",
                "type" => "Sedan"
            ],
            ["id" => 9757, "year" => 2010, "make" => "Volvo", "model" => "XC60", "type" => "SUV"],
            [
                "id" => 9758,
                "year" => 2020,
                "make" => "Subaru",
                "model" => "Ascent",
                "type" => "SUV"
            ],
            [
                "id" => 9759,
                "year" => 2015,
                "make" => "Hyundai",
                "model" => "Equus",
                "type" => "Sedan"
            ],
            [
                "id" => 9760,
                "year" => 2006,
                "make" => "Chevrolet",
                "model" => "HHR",
                "type" => "Wagon"
            ],
            [
                "id" => 9761,
                "year" => 2005,
                "make" => "Chevrolet",
                "model" => "Uplander Passenger",
                "type" => "Van/Minivan"
            ],
            [
                "id" => 9762,
                "year" => 1997,
                "make" => "Jeep",
                "model" => "Wrangler",
                "type" => "SUV"
            ],
            [
                "id" => 9763,
                "year" => 1993,
                "make" => "GMC",
                "model" => "Rally Wagon 3500",
                "type" => "Van/Minivan"
            ],
            [
                "id" => 9764,
                "year" => 2017,
                "make" => "Ram",
                "model" => "1500 Quad Cab",
                "type" => "Pickup"
            ],
            [
                "id" => 9765,
                "year" => 2007,
                "make" => "Dodge",
                "model" => "Grand Caravan Cargo",
                "type" => "Van/Minivan"
            ],
            [
                "id" => 9766,
                "year" => 2004,
                "make" => "Hyundai",
                "model" => "Elantra",
                "type" => "Sedan, Hatchback"
            ],
            [
                "id" => 9767,
                "year" => 2000,
                "make" => "MAZDA",
                "model" => "B-Series Regular Cab",
                "type" => "Pickup"
            ],
            [
                "id" => 9768,
                "year" => 2008,
                "make" => "Ford",
                "model" => "Explorer",
                "type" => "SUV"
            ],
            [
                "id" => 9769,
                "year" => 2008,
                "make" => "Nissan",
                "model" => "Versa",
                "type" => "Sedan, Hatchback"
            ],
            [
                "id" => 9770,
                "year" => 2014,
                "make" => "Jeep",
                "model" => "Cherokee",
                "type" => "SUV"
            ],
            [
                "id" => 9771,
                "year" => 2000,
                "make" => "Ford",
                "model" => "Explorer Sport",
                "type" => "SUV"
            ],
            [
                "id" => 9772,
                "year" => 1994,
                "make" => "Eagle",
                "model" => "Summit",
                "type" => "Sedan, Coupe, Wagon"
            ],
            [
                "id" => 9773,
                "year" => 1997,
                "make" => "Volkswagen",
                "model" => "Cabrio",
                "type" => "Convertible"
            ],
            [
                "id" => 9774,
                "year" => 2010,
                "make" => "MINI",
                "model" => "Clubman",
                "type" => "Hatchback"
            ],
            [
                "id" => 9775,
                "year" => 2008,
                "make" => "BMW",
                "model" => "7 Series",
                "type" => "Sedan"
            ],
            [
                "id" => 9776,
                "year" => 2002,
                "make" => "Pontiac",
                "model" => "Firebird",
                "type" => "Coupe, Convertible"
            ],
            [
                "id" => 9777,
                "year" => 2019,
                "make" => "Nissan",
                "model" => "Titan King Cab",
                "type" => "Pickup"
            ],
            [
                "id" => 9778,
                "year" => 1997,
                "make" => "Chevrolet",
                "model" => "2500 HD Extended Cab",
                "type" => "Pickup"
            ],
            [
                "id" => 9779,
                "year" => 1992,
                "make" => "Pontiac",
                "model" => "Grand Prix",
                "type" => "Sedan, Coupe"
            ],
            [
                "id" => 9780,
                "year" => 2004,
                "make" => "Toyota",
                "model" => "Solara",
                "type" => "Coupe, Convertible"
            ],
            [
                "id" => 9781,
                "year" => 1996,
                "make" => "GMC",
                "model" => "2500 Club Coupe",
                "type" => "Pickup"
            ],
            [
                "id" => 9782,
                "year" => 2000,
                "make" => "Dodge",
                "model" => "Ram 1500 Quad Cab",
                "type" => "Pickup"
            ],
            ["id" => 9783, "year" => 2014, "make" => "Honda", "model" => "CR-V", "type" => "SUV"],
            [
                "id" => 9784,
                "year" => 2015,
                "make" => "INFINITI",
                "model" => "QX80",
                "type" => "SUV"
            ],
            [
                "id" => 9785,
                "year" => 1993,
                "make" => "Chevrolet",
                "model" => "Cavalier",
                "type" => "Coupe, Sedan, Wagon, Convertible"
            ],
            [
                "id" => 9786,
                "year" => 2019,
                "make" => "Kia",
                "model" => "Rio",
                "type" => "Sedan, Hatchback"
            ],
            [
                "id" => 9787,
                "year" => 2012,
                "make" => "Nissan",
                "model" => "Murano",
                "type" => "SUV"
            ],
            [
                "id" => 9788,
                "year" => 1993,
                "make" => "Jeep",
                "model" => "Cherokee",
                "type" => "SUV"
            ],
            [
                "id" => 9789,
                "year" => 2010,
                "make" => "Volkswagen",
                "model" => "New Beetle",
                "type" => "Convertible, Hatchback"
            ],
            [
                "id" => 9790,
                "year" => 2019,
                "make" => "Kia",
                "model" => "Cadenza",
                "type" => "Sedan"
            ],
            [
                "id" => 9791,
                "year" => 2016,
                "make" => "GMC",
                "model" => "Sierra 2500 HD Double Cab",
                "type" => "Pickup"
            ],
            [
                "id" => 9792,
                "year" => 1997,
                "make" => "Dodge",
                "model" => "Avenger",
                "type" => "Coupe"
            ],
            [
                "id" => 9793,
                "year" => 2007,
                "make" => "GMC",
                "model" => "Sierra 1500 Regular Cab",
                "type" => "Pickup"
            ],
            [
                "id" => 9794,
                "year" => 2008,
                "make" => "Dodge",
                "model" => "Ram 2500 Regular Cab",
                "type" => "Pickup"
            ],
            [
                "id" => 9795,
                "year" => 2015,
                "make" => "Volkswagen",
                "model" => "Jetta",
                "type" => "Sedan"
            ],
            [
                "id" => 9796,
                "year" => 2001,
                "make" => "Chevrolet",
                "model" => "Silverado 3500 Extended Cab",
                "type" => "Pickup"
            ],
            [
                "id" => 9797,
                "year" => 2008,
                "make" => "Hyundai",
                "model" => "Entourage",
                "type" => "Van/Minivan"
            ],
            [
                "id" => 9798,
                "year" => 1993,
                "make" => "Dodge",
                "model" => "Ramcharger",
                "type" => "SUV"
            ],
            [
                "id" => 9799,
                "year" => 1998,
                "make" => "Chevrolet",
                "model" => "Astro Passenger",
                "type" => "Van/Minivan"
            ],
            [
                "id" => 9800,
                "year" => 2003,
                "make" => "Chrysler",
                "model" => "PT Cruiser",
                "type" => "Wagon"
            ],
            [
                "id" => 9801,
                "year" => 2008,
                "make" => "Land Rover",
                "model" => "Range Rover",
                "type" => "SUV"
            ],
            [
                "id" => 9802,
                "year" => 1993,
                "make" => "Dodge",
                "model" => "Ram Wagon B250",
                "type" => "Van/Minivan"
            ],
            [
                "id" => 9803,
                "year" => 2004,
                "make" => "Porsche",
                "model" => "Cayenne",
                "type" => "SUV"
            ],
            [
                "id" => 9804,
                "year" => 2007,
                "make" => "HUMMER",
                "model" => "H2",
                "type" => "SUV, Pickup"
            ],
            [
                "id" => 9805,
                "year" => 2003,
                "make" => "Oldsmobile",
                "model" => "Aurora",
                "type" => "Sedan"
            ],
            [
                "id" => 9806,
                "year" => 2019,
                "make" => "Mercedes-Benz",
                "model" => "Mercedes-AMG GT",
                "type" => "Coupe, Sedan, Convertible"
            ],
            ["id" => 9807, "year" => 2018, "make" => "BMW", "model" => "M5", "type" => "Sedan"],
            [
                "id" => 9808,
                "year" => 2013,
                "make" => "Honda",
                "model" => "Crosstour",
                "type" => "SUV"
            ],
            ["id" => 9809, "year" => 1999, "make" => "Honda", "model" => "CR-V", "type" => "SUV"],
            [
                "id" => 9810,
                "year" => 1995,
                "make" => "Ford",
                "model" => "Taurus",
                "type" => "Sedan, Wagon"
            ],
            [
                "id" => 9811,
                "year" => 2009,
                "make" => "Mercury",
                "model" => "Grand Marquis",
                "type" => "Sedan"
            ],
            [
                "id" => 9812,
                "year" => 2008,
                "make" => "Dodge",
                "model" => "Ram 2500 Mega Cab",
                "type" => "Pickup"
            ],
            [
                "id" => 9813,
                "year" => 1992,
                "make" => "Hyundai",
                "model" => "Scoupe",
                "type" => "Coupe"
            ],
            [
                "id" => 9814,
                "year" => 2008,
                "make" => "Suzuki",
                "model" => "Reno",
                "type" => "Hatchback"
            ],
            [
                "id" => 9815,
                "year" => 2004,
                "make" => "Scion",
                "model" => "xB",
                "type" => "Hatchback"
            ],
            [
                "id" => 9816,
                "year" => 2000,
                "make" => "MAZDA",
                "model" => "Millenia",
                "type" => "Sedan"
            ],
            [
                "id" => 9817,
                "year" => 1997,
                "make" => "Chevrolet",
                "model" => "Camaro",
                "type" => "Coupe, Convertible"
            ],
            [
                "id" => 9818,
                "year" => 2008,
                "make" => "Dodge",
                "model" => "Charger",
                "type" => "Sedan"
            ],
            [
                "id" => 9819,
                "year" => 2007,
                "make" => "Kia",
                "model" => "Sedona",
                "type" => "Van/Minivan"
            ],
            [
                "id" => 9820,
                "year" => 1993,
                "make" => "Mercedes-Benz",
                "model" => "300 SE",
                "type" => "Sedan"
            ],
            [
                "id" => 9821,
                "year" => 2000,
                "make" => "Chrysler",
                "model" => "LHS",
                "type" => "Sedan"
            ],
            [
                "id" => 9822,
                "year" => 2010,
                "make" => "Ford",
                "model" => "Ranger Super Cab",
                "type" => "Pickup"
            ],
            [
                "id" => 9823,
                "year" => 2018,
                "make" => "GMC",
                "model" => "Sierra 3500 HD Regular Cab",
                "type" => "Pickup"
            ],
            [
                "id" => 9824,
                "year" => 1994,
                "make" => "Audi",
                "model" => "Cabriolet",
                "type" => "Convertible"
            ],
            [
                "id" => 9825,
                "year" => 1999,
                "make" => "Cadillac",
                "model" => "Escalade",
                "type" => "SUV"
            ],
            [
                "id" => 9826,
                "year" => 2018,
                "make" => "Jaguar",
                "model" => "XJ",
                "type" => "Sedan"
            ],
            ["id" => 9827, "year" => 2018, "make" => "Lexus", "model" => "IS", "type" => "Sedan"],
            [
                "id" => 9828,
                "year" => 1996,
                "make" => "GMC",
                "model" => "2500 Regular Cab",
                "type" => "Pickup"
            ],
            [
                "id" => 9829,
                "year" => 2018,
                "make" => "Volkswagen",
                "model" => "Golf Alltrack",
                "type" => "Wagon"
            ],
            [
                "id" => 9830,
                "year" => 2004,
                "make" => "Toyota",
                "model" => "Land Cruiser",
                "type" => "SUV"
            ],
            [
                "id" => 9831,
                "year" => 1996,
                "make" => "GMC",
                "model" => "Vandura G3500",
                "type" => "Van/Minivan"
            ],

            [
                "id" => 9832,
                "year" => 1995,
                "make" => "Ford",
                "model" => "F150 Regular Cab",
                "type" => "Pickup"
            ],
            [
                "id" => 9833,
                "year" => 2017,
                "make" => "Hyundai",
                "model" => "Sonata Hybrid",
                "type" => "Sedan"
            ],
            [
                "id" => 9834,
                "year" => 2005,
                "make" => "Lotus",
                "model" => "Elise",
                "type" => "Coupe"
            ],
            ["id" => 9835, "year" => 2011, "make" => "Lexus", "model" => "RX", "type" => "SUV"],
            [
                "id" => 9836,
                "year" => 2004,
                "make" => "HUMMER",
                "model" => "H1",
                "type" => "SUV, Wagon"
            ],
            ["id" => 9837, "year" => 2015, "make" => "Audi", "model" => "Q7", "type" => "SUV"],
            ["id" => 9838, "year" => 2007, "make" => "GMC", "model" => "Envoy", "type" => "SUV"],
            [
                "id" => 9839,
                "year" => 2014,
                "make" => "Lexus",
                "model" => "CT",
                "type" => "Hatchback"
            ],
            [
                "id" => 9840,
                "year" => 2005,
                "make" => "Ford",
                "model" => "Excursion",
                "type" => "SUV"
            ],
            ["id" => 9841, "year" => 2019, "make" => "Lexus", "model" => "UX", "type" => "SUV"],
            [
                "id" => 9842,
                "year" => 2018,
                "make" => "Ram",
                "model" => "ProMaster Cargo Van",
                "type" => "Van/Minivan"
            ],
            ["id" => 9843, "year" => 2007, "make" => "GMC", "model" => "Yukon", "type" => "SUV"],
            [
                "id" => 9844,
                "year" => 2019,
                "make" => "Subaru",
                "model" => "Forester",
                "type" => "SUV"
            ],
            [
                "id" => 9845,
                "year" => 2002,
                "make" => "Nissan",
                "model" => "Frontier Crew Cab",
                "type" => "Pickup"
            ],
            [
                "id" => 9846,
                "year" => 2019,
                "make" => "Nissan",
                "model" => "Sentra",
                "type" => "Sedan"
            ],
            ["id" => 9847, "year" => 2019, "make" => "BMW", "model" => "X6", "type" => "SUV"],
            [
                "id" => 9848,
                "year" => 2007,
                "make" => "Volkswagen",
                "model" => "New Beetle",
                "type" => "Convertible, Hatchback"
            ],
            [
                "id" => 9849,
                "year" => 2004,
                "make" => "Dodge",
                "model" => "Viper",
                "type" => "Convertible"
            ],
            [
                "id" => 9850,
                "year" => 1994,
                "make" => "INFINITI",
                "model" => "J",
                "type" => "Sedan"
            ],
            [
                "id" => 9851,
                "year" => 2004,
                "make" => "Chevrolet",
                "model" => "Suburban 1500",
                "type" => "SUV"
            ],

            [
                "id" => 9854,
                "year" => 2003,
                "make" => "GMC",
                "model" => "Sierra 1500 HD Crew Cab",
                "type" => "Pickup"
            ],
            [
                "id" => 9855,
                "year" => 1998,
                "make" => "Toyota",
                "model" => "T100 Xtracab",
                "type" => "Pickup"
            ],
            [
                "id" => 9856,
                "year" => 2018,
                "make" => "Jeep",
                "model" => "Cherokee",
                "type" => "SUV"
            ],
            [
                "id" => 9857,
                "year" => 1997,
                "make" => "Chevrolet",
                "model" => "Astro Passenger",
                "type" => "Van/Minivan"
            ],
            [
                "id" => 9858,
                "year" => 2019,
                "make" => "Chevrolet",
                "model" => "Blazer",
                "type" => "SUV"
            ],
            [
                "id" => 9859,
                "year" => 2019,
                "make" => "Mercedes-Benz",
                "model" => "Mercedes-AMG CLS",
                "type" => "Sedan"
            ],
            [
                "id" => 9860,
                "year" => 1992,
                "make" => "Plymouth",
                "model" => "Grand Voyager",
                "type" => "Van/Minivan"
            ],
            [
                "id" => 9861,
                "year" => 2008,
                "make" => "Ford",
                "model" => "F150 SuperCrew Cab",
                "type" => "Pickup"
            ],
            [
                "id" => 9862,
                "year" => 2015,
                "make" => "BMW",
                "model" => "M4",
                "type" => "Coupe, Convertible"
            ],
            [
                "id" => 9863,
                "year" => 2018,
                "make" => "Subaru",
                "model" => "Impreza",
                "type" => "Sedan, Wagon"
            ],
            [
                "id" => 9864,
                "year" => 2019,
                "make" => "Cadillac",
                "model" => "XT4",
                "type" => "SUV"
            ],
            [
                "id" => 9865,
                "year" => 1992,
                "make" => "Mercedes-Benz",
                "model" => "300 SD",
                "type" => "Sedan"
            ],
            [
                "id" => 9866,
                "year" => 2010,
                "make" => "Chevrolet",
                "model" => "Silverado 2500 HD Extended Cab",
                "type" => "Pickup"
            ],
            [
                "id" => 9867,
                "year" => 2005,
                "make" => "Mercedes-Benz",
                "model" => "SLK-Class",
                "type" => "Convertible"
            ],
            [
                "id" => 9868,
                "year" => 2005,
                "make" => "GMC",
                "model" => "Sierra 2500 HD Extended Cab",
                "type" => "Pickup"
            ],
            [
                "id" => 9869,
                "year" => 2002,
                "make" => "Chevrolet",
                "model" => "S10 Crew Cab",
                "type" => "Pickup"
            ],
            [
                "id" => 9870,
                "year" => 2014,
                "make" => "Ford",
                "model" => "F350 Super Duty Regular Cab",
                "type" => "Pickup"
            ],
            [
                "id" => 9871,
                "year" => 2014,
                "make" => "Hyundai",
                "model" => "Genesis Coupe",
                "type" => "Coupe"
            ],
            [
                "id" => 9872,
                "year" => 2010,
                "make" => "BMW",
                "model" => "6 Series",
                "type" => "Coupe, Convertible"
            ],
            [
                "id" => 9873,
                "year" => 2011,
                "make" => "Nissan",
                "model" => "Frontier King Cab",
                "type" => "Pickup"
            ],
            [
                "id" => 9874,
                "year" => 2002,
                "make" => "BMW",
                "model" => "Z3",
                "type" => "Coupe, Convertible"
            ],
            [
                "id" => 9875,
                "year" => 2018,
                "make" => "Kia",
                "model" => "Forte",
                "type" => "Sedan"
            ],
            [
                "id" => 9876,
                "year" => 2013,
                "make" => "Subaru",
                "model" => "BRZ",
                "type" => "Coupe"
            ],
            [
                "id" => 9877,
                "year" => 2004,
                "make" => "Chevrolet",
                "model" => "Tracker",
                "type" => "SUV"
            ],
            ["id" => 9878, "year" => 2015, "make" => "Audi", "model" => "S4", "type" => "Sedan"],

            [
                "id" => 9880,
                "year" => 2010,
                "make" => "Subaru",
                "model" => "Impreza",
                "type" => "Sedan, Wagon"
            ],
            [
                "id" => 9881,
                "year" => 2017,
                "make" => "Audi",
                "model" => "A3 Sportback e-tron",
                "type" => "Wagon"
            ],
            [
                "id" => 9882,
                "year" => 2003,
                "make" => "Mitsubishi",
                "model" => "Diamante",
                "type" => "Sedan"
            ],
            [
                "id" => 9883,
                "year" => 2013,
                "make" => "Ford",
                "model" => "F350 Super Duty Crew Cab",
                "type" => "Pickup"
            ],
            [
                "id" => 9884,
                "year" => 2020,
                "make" => "Nissan",
                "model" => "Altima",
                "type" => "Sedan"
            ],
            [
                "id" => 9885,
                "year" => 2018,
                "make" => "INFINITI",
                "model" => "QX30",
                "type" => "SUV"
            ],
            [
                "id" => 9886,
                "year" => 1995,
                "make" => "Chevrolet",
                "model" => "3500 Crew Cab",
                "type" => "Pickup"
            ],
            [
                "id" => 9887,
                "year" => 2020,
                "make" => "Mercedes-Benz",
                "model" => "GLE",
                "type" => "SUV"
            ],
            [
                "id" => 9888,
                "year" => 2015,
                "make" => "Kia",
                "model" => "Optima Hybrid",
                "type" => "Sedan"
            ],
            [
                "id" => 9889,
                "year" => 2003,
                "make" => "Subaru",
                "model" => "Baja",
                "type" => "Pickup"
            ],
            [
                "id" => 9890,
                "year" => 2012,
                "make" => "Chevrolet",
                "model" => "Colorado Crew Cab",
                "type" => "Pickup"
            ],
            [
                "id" => 9891,
                "year" => 1993,
                "make" => "Oldsmobile",
                "model" => "Cutlass Cruiser",
                "type" => "Wagon"
            ],
            [
                "id" => 9892,
                "year" => 2006,
                "make" => "Cadillac",
                "model" => "Escalade ESV",
                "type" => "SUV"
            ],
            [
                "id" => 9893,
                "year" => 1996,
                "make" => "Chevrolet",
                "model" => "Lumina Passenger",
                "type" => "Van/Minivan"
            ],
            [
                "id" => 9894,
                "year" => 2014,
                "make" => "Toyota",
                "model" => "4Runner",
                "type" => "SUV"
            ],
            [
                "id" => 9895,
                "year" => 2001,
                "make" => "Chevrolet",
                "model" => "Cavalier",
                "type" => "Sedan, Coupe"
            ],
            [
                "id" => 9896,
                "year" => 2008,
                "make" => "Porsche",
                "model" => "Cayenne",
                "type" => "SUV"
            ],
            [
                "id" => 9897,
                "year" => 1993,
                "make" => "Toyota",
                "model" => "Xtra Cab",
                "type" => "Pickup"
            ],
            ["id" => 9898, "year" => 2008, "make" => "Ford", "model" => "Edge", "type" => "SUV"],
            [
                "id" => 9899,
                "year" => 2019,
                "make" => "Volkswagen",
                "model" => "Passat",
                "type" => "Sedan"
            ],
            [
                "id" => 9900,
                "year" => 1995,
                "make" => "Chevrolet",
                "model" => "Cavalier",
                "type" => "Coupe, Sedan, Convertible"
            ],
            [
                "id" => 9901,
                "year" => 1996,
                "make" => "Dodge",
                "model" => "Avenger",
                "type" => "Coupe"
            ],
            ["id" => 9902, "year" => 2009, "make" => "GMC", "model" => "Acadia", "type" => "SUV"],
            [
                "id" => 9903,
                "year" => 2006,
                "make" => "Ferrari",
                "model" => "612 Scaglietti",
                "type" => "Coupe"
            ],
            [
                "id" => 9904,
                "year" => 2011,
                "make" => "Toyota",
                "model" => "Tacoma Double Cab",
                "type" => "Pickup"
            ],
            [
                "id" => 9905,
                "year" => 1993,
                "make" => "MAZDA",
                "model" => "626",
                "type" => "Sedan"
            ],
            [
                "id" => 9906,
                "year" => 2014,
                "make" => "Toyota",
                "model" => "Camry",
                "type" => "Sedan"
            ],
            [
                "id" => 9907,
                "year" => 2014,
                "make" => "Toyota",
                "model" => "Avalon",
                "type" => "Sedan"
            ],
            [
                "id" => 9908,
                "year" => 2015,
                "make" => "Ferrari",
                "model" => "458 Italia",
                "type" => "Coupe"
            ],
            [
                "id" => 9909,
                "year" => 2015,
                "make" => "Ford",
                "model" => "Fiesta",
                "type" => "Sedan, Hatchback"
            ],
            [
                "id" => 9910,
                "year" => 1992,
                "make" => "Volvo",
                "model" => "240",
                "type" => "Sedan, Wagon"
            ],
            [
                "id" => 9911,
                "year" => 2008,
                "make" => "Ford",
                "model" => "Taurus X",
                "type" => "SUV"
            ],
            ["id" => 9912, "year" => 2020, "make" => "BMW", "model" => "X5", "type" => "SUV"],
            [
                "id" => 9913,
                "year" => 2014,
                "make" => "Chevrolet",
                "model" => "Equinox",
                "type" => "SUV"
            ],
            [
                "id" => 9914,
                "year" => 2015,
                "make" => "Mercedes-Benz",
                "model" => "GLA-Class",
                "type" => "SUV"
            ],
            [
                "id" => 9915,
                "year" => 2015,
                "make" => "Freightliner",
                "model" => "Sprinter 3500 Cargo",
                "type" => "Van/Minivan"
            ],
            [
                "id" => 9916,
                "year" => 2016,
                "make" => "Mercedes-Benz",
                "model" => "Mercedes-AMG GT",
                "type" => "Coupe"
            ],
            [
                "id" => 9917,
                "year" => 2014,
                "make" => "BMW",
                "model" => "2 Series",
                "type" => "Coupe"
            ],
            [
                "id" => 9918,
                "year" => 2004,
                "make" => "GMC",
                "model" => "Savana 1500 Cargo",
                "type" => "Van/Minivan"
            ],
            [
                "id" => 9919,
                "year" => 2004,
                "make" => "Acura",
                "model" => "NSX",
                "type" => "Coupe"
            ],
            [
                "id" => 9920,
                "year" => 2012,
                "make" => "Ram",
                "model" => "2500 Mega Cab",
                "type" => "Pickup"
            ],
            ["id" => 9921, "year" => 2010, "make" => "Lexus", "model" => "HS", "type" => "Sedan"],
            [
                "id" => 9922,
                "year" => 2006,
                "make" => "Suzuki",
                "model" => "Forenza",
                "type" => "Sedan, Wagon"
            ],
            ["id" => 9923, "year" => 2009, "make" => "Lexus", "model" => "IS", "type" => "Sedan"],
            [
                "id" => 9924,
                "year" => 2009,
                "make" => "Mercedes-Benz",
                "model" => "S-Class",
                "type" => "Sedan"
            ],

            [
                "id" => 9926,
                "year" => 2015,
                "make" => "Toyota",
                "model" => "4Runner",
                "type" => "SUV"
            ],
            [
                "id" => 9927,
                "year" => 2015,
                "make" => "Lincoln",
                "model" => "MKC",
                "type" => "SUV"
            ],
            [
                "id" => 9928,
                "year" => 2019,
                "make" => "Cadillac",
                "model" => "CT6",
                "type" => "Sedan"
            ],
            [
                "id" => 9929,
                "year" => 2003,
                "make" => "BMW",
                "model" => "M3",
                "type" => "Coupe, Convertible"
            ],
            ["id" => 9930, "year" => 2015, "make" => "MAZDA", "model" => "CX-9", "type" => "SUV"],
            [
                "id" => 9931,
                "year" => 2007,
                "make" => "Kia",
                "model" => "Spectra",
                "type" => "Sedan, Hatchback"
            ],
            ["id" => 9932, "year" => 2017, "make" => "MAZDA", "model" => "CX-5", "type" => "SUV"],
            [
                "id" => 9933,
                "year" => 1994,
                "make" => "Pontiac",
                "model" => "Sunbird",
                "type" => "Sedan, Coupe, Convertible"
            ],
            [
                "id" => 9934,
                "year" => 2002,
                "make" => "Toyota",
                "model" => "Tacoma Double Cab",
                "type" => "Pickup"
            ],
            [
                "id" => 9935,
                "year" => 2015,
                "make" => "Chevrolet",
                "model" => "Traverse",
                "type" => "SUV"
            ],
            ["id" => 9936, "year" => 2013, "make" => "Acura", "model" => "ZDX", "type" => "SUV"],
            [
                "id" => 9937,
                "year" => 1992,
                "make" => "Dodge",
                "model" => "D350 Club Cab",
                "type" => "Pickup"
            ],
            [
                "id" => 9938,
                "year" => 2008,
                "make" => "Lexus",
                "model" => "SC",
                "type" => "Convertible"
            ],
            [
                "id" => 9939,
                "year" => 2008,
                "make" => "Ford",
                "model" => "Expedition EL",
                "type" => "SUV"
            ],
            [
                "id" => 9940,
                "year" => 2009,
                "make" => "Nissan",
                "model" => "cube",
                "type" => "Wagon"
            ],
            [
                "id" => 9941,
                "year" => 2018,
                "make" => "Chevrolet",
                "model" => "Equinox",
                "type" => "SUV"
            ],
            [
                "id" => 9942,
                "year" => 2002,
                "make" => "Volvo",
                "model" => "V70",
                "type" => "Wagon"
            ],
            [
                "id" => 9943,
                "year" => 2013,
                "make" => "Ram",
                "model" => "2500 Regular Cab",
                "type" => "Pickup"
            ],
            [
                "id" => 9944,
                "year" => 2011,
                "make" => "Kia",
                "model" => "Sedona",
                "type" => "Van/Minivan"
            ],
            [
                "id" => 9945,
                "year" => 2015,
                "make" => "Mitsubishi",
                "model" => "Mirage",
                "type" => "Hatchback"
            ],
            [
                "id" => 9946,
                "year" => 2019,
                "make" => "Ford",
                "model" => "EcoSport",
                "type" => "SUV"
            ],
            ["id" => 9947, "year" => 2015, "make" => "Ford", "model" => "Flex", "type" => "SUV"],
            [
                "id" => 9948,
                "year" => 2014,
                "make" => "Lincoln",
                "model" => "MKS",
                "type" => "Sedan"
            ],
            [
                "id" => 9949,
                "year" => 2007,
                "make" => "Chevrolet",
                "model" => "Impala",
                "type" => "Sedan"
            ],
            [
                "id" => 9950,
                "year" => 2004,
                "make" => "Toyota",
                "model" => "Tacoma Double Cab",
                "type" => "Pickup"
            ],
            [
                "id" => 9951,
                "year" => 2015,
                "make" => "Freightliner",
                "model" => "Sprinter 2500 Passenger",
                "type" => "Van/Minivan"
            ],
            [
                "id" => 9952,
                "year" => 2015,
                "make" => "Mercedes-Benz",
                "model" => "S-Class",
                "type" => "Sedan, Coupe"
            ],
            [
                "id" => 9953,
                "year" => 1998,
                "make" => "Oldsmobile",
                "model" => "Regency",
                "type" => "Sedan"
            ],
            [
                "id" => 9954,
                "year" => 1996,
                "make" => "Toyota",
                "model" => "RAV4",
                "type" => "SUV"
            ],
            [
                "id" => 9955,
                "year" => 2008,
                "make" => "Dodge",
                "model" => "Sprinter 2500 Passenger",
                "type" => "Van/Minivan"
            ],
            [
                "id" => 9956,
                "year" => 2018,
                "make" => "Honda",
                "model" => "Civic Type R",
                "type" => "Hatchback"
            ],
            [
                "id" => 9957,
                "year" => 2016,
                "make" => "Chevrolet",
                "model" => "Express 2500 Cargo",
                "type" => "Van/Minivan"
            ],
            [
                "id" => 9958,
                "year" => 1995,
                "make" => "GMC",
                "model" => "3500 Club Coupe",
                "type" => "Pickup"
            ],
            [
                "id" => 9959,
                "year" => 2015,
                "make" => "Toyota",
                "model" => "Tacoma Access Cab",
                "type" => "Pickup"
            ],
            [
                "id" => 9960,
                "year" => 1997,
                "make" => "Nissan",
                "model" => "Altima",
                "type" => "Sedan"
            ],
            [
                "id" => 9961,
                "year" => 2003,
                "make" => "Mitsubishi",
                "model" => "Lancer",
                "type" => "Sedan"
            ],
            [
                "id" => 9962,
                "year" => 1999,
                "make" => "Chevrolet",
                "model" => "2500 HD Extended Cab",
                "type" => "Pickup"
            ],
            [
                "id" => 9963,
                "year" => 1994,
                "make" => "MAZDA",
                "model" => "MX-3",
                "type" => "Hatchback"
            ],

            [
                "id" => 9965,
                "year" => 2019,
                "make" => "Nissan",
                "model" => "TITAN XD Crew Cab",
                "type" => "Pickup"
            ],
            ["id" => 9966, "year" => 2008, "make" => "Lexus", "model" => "LS", "type" => "Sedan"],
            [
                "id" => 9967,
                "year" => 2009,
                "make" => "INFINITI",
                "model" => "G",
                "type" => "Coupe, Sedan, Convertible"
            ],
            [
                "id" => 9968,
                "year" => 2014,
                "make" => "Rolls-Royce",
                "model" => "Phantom",
                "type" => "Sedan, Coupe, Convertible"
            ],
            [
                "id" => 9969,
                "year" => 2009,
                "make" => "Volkswagen",
                "model" => "Eos",
                "type" => "Convertible"
            ],
            ["id" => 9970, "year" => 2017, "make" => "BMW", "model" => "M3", "type" => "Sedan"],
            [
                "id" => 9971,
                "year" => 2002,
                "make" => "Mercury",
                "model" => "Grand Marquis",
                "type" => "Sedan"
            ],
            [
                "id" => 9972,
                "year" => 2005,
                "make" => "Subaru",
                "model" => "Outback",
                "type" => "Sedan, Wagon"
            ],
            [
                "id" => 9973,
                "year" => 2016,
                "make" => "Lincoln",
                "model" => "Navigator L",
                "type" => "SUV"
            ],
            [
                "id" => 9974,
                "year" => 1998,
                "make" => "Chevrolet",
                "model" => "G-Series 1500",
                "type" => "Van/Minivan"
            ],
            [
                "id" => 9975,
                "year" => 2008,
                "make" => "MAZDA",
                "model" => "RX-8",
                "type" => "Coupe"
            ],
            [
                "id" => 9976,
                "year" => 2005,
                "make" => "Hyundai",
                "model" => "Accent",
                "type" => "Sedan, Hatchback"
            ],
            [
                "id" => 9977,
                "year" => 1997,
                "make" => "Dodge",
                "model" => "Neon",
                "type" => "Sedan, Coupe"
            ],
            [
                "id" => 9978,
                "year" => 2013,
                "make" => "Ford",
                "model" => "Expedition EL",
                "type" => "SUV"
            ],
            [
                "id" => 9979,
                "year" => 2019,
                "make" => "Chevrolet",
                "model" => "Sonic",
                "type" => "Sedan, Hatchback"
            ],
            [
                "id" => 9980,
                "year" => 2014,
                "make" => "MAZDA",
                "model" => "MX-5 Miata",
                "type" => "Convertible"
            ],
            [
                "id" => 9981,
                "year" => 2020,
                "make" => "Ford",
                "model" => "F150 SuperCrew Cab",
                "type" => "Pickup"
            ],
            [
                "id" => 9982,
                "year" => 2010,
                "make" => "Chevrolet",
                "model" => "Silverado 3500 HD Extended Cab",
                "type" => "Pickup"
            ],
            [
                "id" => 9983,
                "year" => 1999,
                "make" => "Hyundai",
                "model" => "Sonata",
                "type" => "Sedan"
            ],
            [
                "id" => 9984,
                "year" => 2004,
                "make" => "Dodge",
                "model" => "Caravan Cargo",
                "type" => "Van/Minivan"
            ],
            [
                "id" => 9985,
                "year" => 2003,
                "make" => "INFINITI",
                "model" => "G",
                "type" => "Sedan, Coupe"
            ],
            [
                "id" => 9986,
                "year" => 2007,
                "make" => "Toyota",
                "model" => "Land Cruiser",
                "type" => "SUV"
            ],
            [
                "id" => 9987,
                "year" => 2017,
                "make" => "Chevrolet",
                "model" => "Suburban",
                "type" => "SUV"
            ],
            [
                "id" => 9988,
                "year" => 2005,
                "make" => "Hyundai",
                "model" => "Sonata",
                "type" => "Sedan"
            ],
            [
                "id" => 9989,
                "year" => 2003,
                "make" => "Lexus",
                "model" => "SC",
                "type" => "Convertible"
            ],
            [
                "id" => 9990,
                "year" => 2004,
                "make" => "Dodge",
                "model" => "Stratus",
                "type" => "Sedan, Coupe"
            ],
            [
                "id" => 9991,
                "year" => 2008,
                "make" => "Chrysler",
                "model" => "300",
                "type" => "Sedan"
            ],
            [
                "id" => 9992,
                "year" => 2000,
                "make" => "Chevrolet",
                "model" => "Silverado 2500 HD Extended Cab",
                "type" => "Pickup"
            ],
            [
                "id" => 9993,
                "year" => 2004,
                "make" => "GMC",
                "model" => "Envoy XL",
                "type" => "SUV"
            ],
            [
                "id" => 9994,
                "year" => 1996,
                "make" => "Chevrolet",
                "model" => "Tahoe",
                "type" => "SUV"
            ],
            [
                "id" => 9995,
                "year" => 2003,
                "make" => "Jeep",
                "model" => "Liberty",
                "type" => "SUV"
            ],
            [
                "id" => 9996,
                "year" => 2011,
                "make" => "Volvo",
                "model" => "V50",
                "type" => "Wagon"
            ],
            [
                "id" => 9997,
                "year" => 1995,
                "make" => "Chrysler",
                "model" => "LHS",
                "type" => "Sedan"
            ],
            [
                "id" => 9998,
                "year" => 2003,
                "make" => "Kia",
                "model" => "Spectra",
                "type" => "Sedan, Hatchback"
            ],
            [
                "id" => 9999,
                "year" => 2014,
                "make" => "Jeep",
                "model" => "Compass",
                "type" => "SUV"
            ],
            [
                "id" => 10000,
                "year" => 2014,
                "make" => "GMC",
                "model" => "Savana 3500 Passenger",
                "type" => "Van/Minivan"
            ],
            [
                "id" => 10001,
                "year" => 2004,
                "make" => "Nissan",
                "model" => "Titan Crew Cab",
                "type" => "Pickup"
            ],
            [
                "id" => 10002,
                "year" => 2013,
                "make" => "SRT",
                "model" => "Viper",
                "type" => "Coupe"
            ],
            ["id" => 10003, "year" => 2012, "make" => "Ford", "model" => "Edge", "type" => "SUV"],
            [
                "id" => 10004,
                "year" => 2001,
                "make" => "BMW",
                "model" => "M3",
                "type" => "Coupe, Convertible"
            ],
            [
                "id" => 10005,
                "year" => 2000,
                "make" => "Saturn",
                "model" => "L-Series",
                "type" => "Sedan, Wagon"
            ],
            [
                "id" => 10006,
                "year" => 2019,
                "make" => "Toyota",
                "model" => "Highlander Hybrid",
                "type" => "SUV"
            ],
            [
                "id" => 10007,
                "year" => 1999,
                "make" => "Cadillac",
                "model" => "Seville",
                "type" => "Sedan"
            ],
            [
                "id" => 10008,
                "year" => 2017,
                "make" => "Hyundai",
                "model" => "Elantra GT",
                "type" => "Hatchback"
            ],
            [
                "id" => 10009,
                "year" => 2003,
                "make" => "Cadillac",
                "model" => "Seville",
                "type" => "Sedan"
            ],
            [
                "id" => 10010,
                "year" => 2004,
                "make" => "Chrysler",
                "model" => "300M",
                "type" => "Sedan"
            ],
            [
                "id" => 10011,
                "year" => 1993,
                "make" => "Plymouth",
                "model" => "Colt",
                "type" => "Sedan, Coupe"
            ],
            [
                "id" => 10012,
                "year" => 2005,
                "make" => "Ford",
                "model" => "F250 Super Duty Crew Cab",
                "type" => "Pickup"
            ],
            [
                "id" => 10013,
                "year" => 2008,
                "make" => "Lincoln",
                "model" => "MKX",
                "type" => "SUV"
            ],
            [
                "id" => 10014,
                "year" => 2008,
                "make" => "Toyota",
                "model" => "Land Cruiser",
                "type" => "SUV"
            ],
            [
                "id" => 10015,
                "year" => 2010,
                "make" => "Toyota",
                "model" => "Highlander",
                "type" => "SUV"
            ],
            [
                "id" => 10016,
                "year" => 2002,
                "make" => "Lincoln",
                "model" => "Blackwood",
                "type" => "Pickup"
            ],
            [
                "id" => 10017,
                "year" => 2000,
                "make" => "Dodge",
                "model" => "Intrepid",
                "type" => "Sedan"
            ],
            [
                "id" => 10018,
                "year" => 2008,
                "make" => "Chevrolet",
                "model" => "Silverado 1500 Regular Cab",
                "type" => "Pickup"
            ],
            [
                "id" => 10019,
                "year" => 1997,
                "make" => "Pontiac",
                "model" => "Grand Am",
                "type" => "Sedan, Coupe"
            ],
            [
                "id" => 10020,
                "year" => 2020,
                "make" => "Nissan",
                "model" => "NV3500 HD Cargo",
                "type" => "Van/Minivan"
            ],
            [
                "id" => 10021,
                "year" => 2011,
                "make" => "Ford",
                "model" => "E350 Super Duty Passenger",
                "type" => "Van/Minivan"
            ],
            [
                "id" => 10022,
                "year" => 2004,
                "make" => "Isuzu",
                "model" => "Ascender",
                "type" => "SUV"
            ],
            [
                "id" => 10023,
                "year" => 1996,
                "make" => "MAZDA",
                "model" => "MX-5 Miata",
                "type" => "Convertible"
            ],
            [
                "id" => 10024,
                "year" => 2006,
                "make" => "Chevrolet",
                "model" => "Silverado 2500 HD Crew Cab",
                "type" => "Pickup"
            ],
            [
                "id" => 10025,
                "year" => 2002,
                "make" => "INFINITI",
                "model" => "QX",
                "type" => "SUV"
            ],
            [
                "id" => 10026,
                "year" => 2008,
                "make" => "Chevrolet",
                "model" => "Express 2500 Passenger",
                "type" => "Van/Minivan"
            ],
            [
                "id" => 10027,
                "year" => 2011,
                "make" => "Ram",
                "model" => "Dakota Extended Cab",
                "type" => "Pickup"
            ],
            [
                "id" => 10028,
                "year" => 1996,
                "make" => "Chevrolet",
                "model" => "S10 Regular Cab",
                "type" => "Pickup"
            ],
            [
                "id" => 10029,
                "year" => 2019,
                "make" => "BMW",
                "model" => "Z4",
                "type" => "Convertible"
            ],
            [
                "id" => 10030,
                "year" => 2009,
                "make" => "Mitsubishi",
                "model" => "Lancer",
                "type" => "Sedan"
            ],
            [
                "id" => 10031,
                "year" => 2004,
                "make" => "Acura",
                "model" => "RSX",
                "type" => "Coupe"
            ],
            [
                "id" => 10032,
                "year" => 2006,
                "make" => "GMC",
                "model" => "Canyon Crew Cab",
                "type" => "Pickup"
            ],
            [
                "id" => 10033,
                "year" => 1999,
                "make" => "Isuzu",
                "model" => "Amigo",
                "type" => "SUV"
            ],
            [
                "id" => 10034,
                "year" => 2002,
                "make" => "Pontiac",
                "model" => "Grand Prix",
                "type" => "Sedan, Coupe"
            ],
            [
                "id" => 10035,
                "year" => 2017,
                "make" => "Kia",
                "model" => "Niro",
                "type" => "Wagon"
            ],
            ["id" => 10036, "year" => 2019, "make" => "Audi", "model" => "Q5", "type" => "SUV"],
            [
                "id" => 10037,
                "year" => 2018,
                "make" => "Cadillac",
                "model" => "ATS",
                "type" => "Sedan, Coupe"
            ],
            [
                "id" => 10038,
                "year" => 2007,
                "make" => "Isuzu",
                "model" => "i-370 Extended Cab",
                "type" => "Pickup"
            ],
            [
                "id" => 10039,
                "year" => 2004,
                "make" => "Dodge",
                "model" => "Grand Caravan Passenger",
                "type" => "Van/Minivan"
            ],
            [
                "id" => 10040,
                "year" => 2007,
                "make" => "Toyota",
                "model" => "Solara",
                "type" => "Coupe, Convertible"
            ],
            [
                "id" => 10041,
                "year" => 2003,
                "make" => "Jaguar",
                "model" => "XK",
                "type" => "Coupe, Convertible"
            ],
            [
                "id" => 10042,
                "year" => 1994,
                "make" => "Chevrolet",
                "model" => "Corvette",
                "type" => "Convertible, Hatchback"
            ],
            [
                "id" => 10043,
                "year" => 2012,
                "make" => "Mercedes-Benz",
                "model" => "Sprinter 2500 Cargo",
                "type" => "Van/Minivan"
            ],
            [
                "id" => 10044,
                "year" => 2001,
                "make" => "Volkswagen",
                "model" => "Passat (New)",
                "type" => "Sedan, Wagon"
            ],
            [
                "id" => 10045,
                "year" => 2016,
                "make" => "Hyundai",
                "model" => "Accent",
                "type" => "Sedan, Hatchback"
            ],
            [
                "id" => 10046,
                "year" => 2016,
                "make" => "Dodge",
                "model" => "Grand Caravan Passenger",
                "type" => "Van/Minivan"
            ],
            [
                "id" => 10047,
                "year" => 1998,
                "make" => "MAZDA",
                "model" => "B-Series Regular Cab",
                "type" => "Pickup"
            ],
            [
                "id" => 10048,
                "year" => 2009,
                "make" => "Ford",
                "model" => "Explorer Sport Trac",
                "type" => "Pickup"
            ],
            [
                "id" => 10049,
                "year" => 1999,
                "make" => "Cadillac",
                "model" => "Eldorado",
                "type" => "Coupe"
            ],
            [
                "id" => 10050,
                "year" => 2015,
                "make" => "Subaru",
                "model" => "WRX",
                "type" => "Sedan"
            ],
            [
                "id" => 10051,
                "year" => 2018,
                "make" => "Acura",
                "model" => "RLX",
                "type" => "Sedan"
            ],
            [
                "id" => 10052,
                "year" => 1992,
                "make" => "Plymouth",
                "model" => "Sundance",
                "type" => "Hatchback"
            ],
            ["id" => 10053, "year" => 2008, "make" => "Audi", "model" => "Q7", "type" => "SUV"],
            [
                "id" => 10054,
                "year" => 2001,
                "make" => "Dodge",
                "model" => "Ram Wagon 2500",
                "type" => "Van/Minivan"
            ],
            [
                "id" => 10055,
                "year" => 1992,
                "make" => "Nissan",
                "model" => "240SX",
                "type" => "Coupe, Convertible, Hatchback"
            ],
            [
                "id" => 10056,
                "year" => 2015,
                "make" => "Hyundai",
                "model" => "Genesis",
                "type" => "Sedan"
            ],
            [
                "id" => 10057,
                "year" => 1997,
                "make" => "MAZDA",
                "model" => "MPV",
                "type" => "Van/Minivan"
            ],
            [
                "id" => 10058,
                "year" => 1994,
                "make" => "Isuzu",
                "model" => "Trooper",
                "type" => "SUV"
            ],
            [
                "id" => 10059,
                "year" => 1999,
                "make" => "Suzuki",
                "model" => "Swift",
                "type" => "Hatchback"
            ],
            [
                "id" => 10060,
                "year" => 1997,
                "make" => "Volvo",
                "model" => "960",
                "type" => "Sedan, Wagon"
            ],
            [
                "id" => 10061,
                "year" => 2008,
                "make" => "Hyundai",
                "model" => "Elantra",
                "type" => "Sedan"
            ],
            [
                "id" => 10062,
                "year" => 2014,
                "make" => "Mercedes-Benz",
                "model" => "CLS-Class",
                "type" => "Coupe"
            ],
            [
                "id" => 10063,
                "year" => 2017,
                "make" => "Toyota",
                "model" => "Tundra CrewMax",
                "type" => "Pickup"
            ],
            [
                "id" => 10064,
                "year" => 1999,
                "make" => "Chrysler",
                "model" => "300",
                "type" => "Sedan"
            ],
            [
                "id" => 10065,
                "year" => 2008,
                "make" => "Nissan",
                "model" => "Frontier King Cab",
                "type" => "Pickup"
            ],
            [
                "id" => 10066,
                "year" => 2018,
                "make" => "Hyundai",
                "model" => "Elantra",
                "type" => "Sedan"
            ],
            [
                "id" => 10067,
                "year" => 2019,
                "make" => "MAZDA",
                "model" => "MAZDA3",
                "type" => "Sedan, Hatchback"
            ],

            [
                "id" => 10069,
                "year" => 1999,
                "make" => "Chrysler",
                "model" => "Concorde",
                "type" => "Sedan"
            ],
            [
                "id" => 10070,
                "year" => 1995,
                "make" => "Mitsubishi",
                "model" => "3000GT",
                "type" => "Convertible, Hatchback"
            ],
            [
                "id" => 10071,
                "year" => 1992,
                "make" => "Chevrolet",
                "model" => "S10 Extended Cab",
                "type" => "Pickup"
            ],
            ["id" => 10072, "year" => 2018, "make" => "Audi", "model" => "Q5", "type" => "SUV"],
            [
                "id" => 10073,
                "year" => 1998,
                "make" => "Isuzu",
                "model" => "Trooper",
                "type" => "SUV"
            ],
            [
                "id" => 10074,
                "year" => 1992,
                "make" => "Ford",
                "model" => "Ranger Super Cab",
                "type" => "Pickup"
            ],
            [
                "id" => 10075,
                "year" => 1998,
                "make" => "Plymouth",
                "model" => "Breeze",
                "type" => "Sedan"
            ],
            [
                "id" => 10076,
                "year" => 2003,
                "make" => "Porsche",
                "model" => "Cayenne",
                "type" => "SUV"
            ],
            [
                "id" => 10077,
                "year" => 1999,
                "make" => "Subaru",
                "model" => "Legacy",
                "type" => "Sedan, Wagon"
            ],
            [
                "id" => 10078,
                "year" => 1996,
                "make" => "Chevrolet",
                "model" => "Express 2500 Passenger",
                "type" => "Van/Minivan"
            ],
            ["id" => 10079, "year" => 2016, "make" => "BMW", "model" => "i8", "type" => "Coupe"],
            [
                "id" => 10080,
                "year" => 2007,
                "make" => "Aston Martin",
                "model" => "Vantage",
                "type" => "Coupe, Convertible"
            ],
            [
                "id" => 10081,
                "year" => 2002,
                "make" => "Land Rover",
                "model" => "Discovery Series II",
                "type" => "SUV"
            ],
            [
                "id" => 10082,
                "year" => 1997,
                "make" => "MAZDA",
                "model" => "B-Series Regular Cab",
                "type" => "Pickup"
            ],
            [
                "id" => 10083,
                "year" => 1998,
                "make" => "Jaguar",
                "model" => "XK",
                "type" => "Coupe, Convertible"
            ],
            [
                "id" => 10084,
                "year" => 2016,
                "make" => "Ford",
                "model" => "Expedition EL",
                "type" => "SUV"
            ],
            [
                "id" => 10085,
                "year" => 1996,
                "make" => "Ford",
                "model" => "Bronco",
                "type" => "SUV"
            ],
            [
                "id" => 10086,
                "year" => 2006,
                "make" => "Lotus",
                "model" => "Elise",
                "type" => "Coupe"
            ],
            [
                "id" => 10087,
                "year" => 1993,
                "make" => "GMC",
                "model" => "3500 Crew Cab",
                "type" => "Pickup"
            ],
            [
                "id" => 10088,
                "year" => 1995,
                "make" => "Cadillac",
                "model" => "Eldorado",
                "type" => "Coupe"
            ],
            [
                "id" => 10089,
                "year" => 2011,
                "make" => "Suzuki",
                "model" => "Equator Crew Cab",
                "type" => "Pickup"
            ],
            ["id" => 10090, "year" => 2015, "make" => "Audi", "model" => "Q3", "type" => "SUV"],
            [
                "id" => 10091,
                "year" => 1994,
                "make" => "Ford",
                "model" => "F250 Super Cab",
                "type" => "Pickup"
            ],
            [
                "id" => 10092,
                "year" => 2016,
                "make" => "Honda",
                "model" => "Fit",
                "type" => "Hatchback"
            ],
            [
                "id" => 10093,
                "year" => 2017,
                "make" => "Mercedes-Benz",
                "model" => "Sprinter 2500 Cargo",
                "type" => "Van/Minivan"
            ],
            [
                "id" => 10094,
                "year" => 2010,
                "make" => "Volkswagen",
                "model" => "Passat",
                "type" => "Sedan, Wagon"
            ],
            [
                "id" => 10095,
                "year" => 2000,
                "make" => "GMC",
                "model" => "Sierra (Classic) 2500 HD Extended Cab",
                "type" => "Pickup"
            ],
            [
                "id" => 10096,
                "year" => 2020,
                "make" => "Nissan",
                "model" => "Maxima",
                "type" => "Sedan"
            ],
            [
                "id" => 10097,
                "year" => 2016,
                "make" => "Hyundai",
                "model" => "Genesis",
                "type" => "Sedan"
            ],
            [
                "id" => 10098,
                "year" => 1998,
                "make" => "INFINITI",
                "model" => "QX",
                "type" => "SUV"
            ],
            [
                "id" => 10099,
                "year" => 2013,
                "make" => "Acura",
                "model" => "ILX",
                "type" => "Sedan"
            ],
            [
                "id" => 10100,
                "year" => 1999,
                "make" => "Oldsmobile",
                "model" => "Bravada",
                "type" => "SUV"
            ],
            [
                "id" => 10101,
                "year" => 1996,
                "make" => "GMC",
                "model" => "Sonoma Regular Cab",
                "type" => "Pickup"
            ],
            [
                "id" => 10102,
                "year" => 2009,
                "make" => "MINI",
                "model" => "Clubman",
                "type" => "Hatchback"
            ],
            [
                "id" => 10103,
                "year" => 1997,
                "make" => "Plymouth",
                "model" => "Breeze",
                "type" => "Sedan"
            ],
            [
                "id" => 10104,
                "year" => 2013,
                "make" => "Chevrolet",
                "model" => "Sonic",
                "type" => "Sedan, Hatchback"
            ],
            [
                "id" => 10105,
                "year" => 2008,
                "make" => "Volkswagen",
                "model" => "Touareg 2",
                "type" => "SUV"
            ],
            [
                "id" => 10106,
                "year" => 2002,
                "make" => "HUMMER",
                "model" => "H1",
                "type" => "SUV, Wagon"
            ],
            [
                "id" => 10107,
                "year" => 2007,
                "make" => "Volkswagen",
                "model" => "Eos",
                "type" => "Convertible"
            ],
            [
                "id" => 10108,
                "year" => 1992,
                "make" => "GMC",
                "model" => "3500 Regular Cab",
                "type" => "Pickup"
            ],
            [
                "id" => 10109,
                "year" => 2010,
                "make" => "Toyota",
                "model" => "Tundra CrewMax",
                "type" => "Pickup"
            ],
            [
                "id" => 10110,
                "year" => 2011,
                "make" => "Ford",
                "model" => "Taurus",
                "type" => "Sedan"
            ],
            [
                "id" => 10111,
                "year" => 1993,
                "make" => "Saab",
                "model" => "900",
                "type" => "Sedan, Convertible, Hatchback"
            ],
            [
                "id" => 10112,
                "year" => 2010,
                "make" => "Hyundai",
                "model" => "Azera",
                "type" => "Sedan"
            ],
            [
                "id" => 10113,
                "year" => 2012,
                "make" => "Nissan",
                "model" => "Sentra",
                "type" => "Sedan"
            ],
            [
                "id" => 10114,
                "year" => 1996,
                "make" => "Ford",
                "model" => "Explorer",
                "type" => "SUV"
            ],
            [
                "id" => 10115,
                "year" => 2012,
                "make" => "Aston Martin",
                "model" => "DBS",
                "type" => "Coupe, Convertible"
            ],
            [
                "id" => 10116,
                "year" => 1995,
                "make" => "MAZDA",
                "model" => "MPV",
                "type" => "Van/Minivan"
            ],
            [
                "id" => 10117,
                "year" => 2018,
                "make" => "Mercedes-Benz",
                "model" => "Mercedes-AMG SLC",
                "type" => "Convertible"
            ],
            [
                "id" => 10118,
                "year" => 1992,
                "make" => "Nissan",
                "model" => "King Cab",
                "type" => "Pickup"
            ],
            [
                "id" => 10119,
                "year" => 1998,
                "make" => "Chevrolet",
                "model" => "Suburban 2500",
                "type" => "SUV"
            ],
            [
                "id" => 10120,
                "year" => 1994,
                "make" => "Dodge",
                "model" => "Ram Van B150",
                "type" => "Van/Minivan"
            ],

            [
                "id" => 10122,
                "year" => 2006,
                "make" => "Ford",
                "model" => "Crown Victoria",
                "type" => "Sedan"
            ],
            [
                "id" => 10123,
                "year" => 2013,
                "make" => "Ford",
                "model" => "Fusion",
                "type" => "Sedan"
            ],
            [
                "id" => 10124,
                "year" => 2006,
                "make" => "Chrysler",
                "model" => "Crossfire",
                "type" => "Coupe, Convertible"
            ],
            [
                "id" => 10125,
                "year" => 2019,
                "make" => "Nissan",
                "model" => "Titan Crew Cab",
                "type" => "Pickup"
            ],
            [
                "id" => 10126,
                "year" => 1998,
                "make" => "Chevrolet",
                "model" => "2500 HD Extended Cab",
                "type" => "Pickup"
            ],
            [
                "id" => 10127,
                "year" => 2019,
                "make" => "Mercedes-Benz",
                "model" => "GLC Coupe",
                "type" => "SUV"
            ],
            [
                "id" => 10128,
                "year" => 2016,
                "make" => "Volvo",
                "model" => "XC70",
                "type" => "Wagon"
            ],
            [
                "id" => 10129,
                "year" => 1994,
                "make" => "Toyota",
                "model" => "MR2",
                "type" => "Coupe"
            ],
            [
                "id" => 10130,
                "year" => 2002,
                "make" => "Audi",
                "model" => "A4",
                "type" => "Sedan, Wagon"
            ],
            ["id" => 10131, "year" => 2017, "make" => "BMW", "model" => "X1", "type" => "SUV"],
            [
                "id" => 10132,
                "year" => 2007,
                "make" => "Volvo",
                "model" => "S40",
                "type" => "Sedan"
            ],
            [
                "id" => 10133,
                "year" => 2012,
                "make" => "Porsche",
                "model" => "Boxster",
                "type" => "Convertible"
            ],
            [
                "id" => 10134,
                "year" => 2019,
                "make" => "Volkswagen",
                "model" => "Tiguan",
                "type" => "SUV"
            ],
            [
                "id" => 10135,
                "year" => 1994,
                "make" => "Mercury",
                "model" => "Topaz",
                "type" => "Sedan"
            ],
            [
                "id" => 10136,
                "year" => 2018,
                "make" => "Chevrolet",
                "model" => "Express 3500 Cargo",
                "type" => "Van/Minivan"
            ],
            [
                "id" => 10137,
                "year" => 1996,
                "make" => "Dodge",
                "model" => "Stealth",
                "type" => "Hatchback"
            ],
            [
                "id" => 10138,
                "year" => 1998,
                "make" => "Chrysler",
                "model" => "Sebring",
                "type" => "Coupe, Convertible"
            ],
            [
                "id" => 10139,
                "year" => 1998,
                "make" => "Isuzu",
                "model" => "Hombre Regular Cab",
                "type" => "Pickup"
            ],
            [
                "id" => 10140,
                "year" => 2011,
                "make" => "BMW",
                "model" => "1 Series",
                "type" => "Coupe, Convertible"
            ],
            [
                "id" => 10141,
                "year" => 1999,
                "make" => "Volvo",
                "model" => "S80",
                "type" => "Sedan"
            ],
            [
                "id" => 10142,
                "year" => 2019,
                "make" => "Ford",
                "model" => "F350 Super Duty Super Cab",
                "type" => "Pickup"
            ],
            [
                "id" => 10143,
                "year" => 1997,
                "make" => "Oldsmobile",
                "model" => "Regency",
                "type" => "Sedan"
            ],
            [
                "id" => 10144,
                "year" => 2018,
                "make" => "Nissan",
                "model" => "Versa",
                "type" => "Sedan"
            ],
            [
                "id" => 10145,
                "year" => 2009,
                "make" => "Maybach",
                "model" => "62",
                "type" => "Sedan"
            ],
            [
                "id" => 10146,
                "year" => 2020,
                "make" => "Jeep",
                "model" => "Cherokee",
                "type" => "SUV"
            ],
            [
                "id" => 10147,
                "year" => 1996,
                "make" => "Dodge",
                "model" => "Ram 1500 Club Cab",
                "type" => "Pickup"
            ],
            [
                "id" => 10148,
                "year" => 2013,
                "make" => "GMC",
                "model" => "Yukon XL 1500",
                "type" => "SUV"
            ],
            [
                "id" => 10149,
                "year" => 2004,
                "make" => "Ford",
                "model" => "Crown Victoria",
                "type" => "Sedan"
            ],
            [
                "id" => 10150,
                "year" => 2001,
                "make" => "Ford",
                "model" => "Windstar Cargo",
                "type" => "Van/Minivan"
            ],
            [
                "id" => 10151,
                "year" => 2011,
                "make" => "Chevrolet",
                "model" => "Suburban 1500",
                "type" => "SUV"
            ],
            [
                "id" => 10152,
                "year" => 2019,
                "make" => "Ford",
                "model" => "Fusion",
                "type" => "Sedan"
            ],
            ["id" => 10153, "year" => 2015, "make" => "Ford", "model" => "Edge", "type" => "SUV"],
            [
                "id" => 10154,
                "year" => 2018,
                "make" => "Chevrolet",
                "model" => "Express 2500 Passenger",
                "type" => "Van/Minivan"
            ],
            [
                "id" => 10155,
                "year" => 2001,
                "make" => "Toyota",
                "model" => "Tundra Regular Cab",
                "type" => "Pickup"
            ],
            [
                "id" => 10156,
                "year" => 2007,
                "make" => "Volvo",
                "model" => "S80",
                "type" => "Sedan"
            ],
            [
                "id" => 10157,
                "year" => 2011,
                "make" => "Hyundai",
                "model" => "Accent",
                "type" => "Sedan, Hatchback"
            ],
            [
                "id" => 10158,
                "year" => 2016,
                "make" => "Chevrolet",
                "model" => "Corvette",
                "type" => "Coupe, Convertible"
            ],
            [
                "id" => 10159,
                "year" => 2002,
                "make" => "Chevrolet",
                "model" => "Silverado 1500 Extended Cab",
                "type" => "Pickup"
            ],
            ["id" => 10160, "year" => 2004, "make" => "Lexus", "model" => "GX", "type" => "SUV"],
            [
                "id" => 10161,
                "year" => 2005,
                "make" => "Kia",
                "model" => "Rio",
                "type" => "Sedan, Wagon"
            ],
            [
                "id" => 10162,
                "year" => 2009,
                "make" => "Nissan",
                "model" => "Titan King Cab",
                "type" => "Pickup"
            ],
            [
                "id" => 10163,
                "year" => 2003,
                "make" => "GMC",
                "model" => "Sierra 2500 Extended Cab",
                "type" => "Pickup"
            ],
            [
                "id" => 10164,
                "year" => 1999,
                "make" => "Mercury",
                "model" => "Cougar",
                "type" => "Coupe"
            ],
            [
                "id" => 10165,
                "year" => 2017,
                "make" => "Mercedes-Benz",
                "model" => "Mercedes-Maybach S-Class",
                "type" => "Sedan"
            ],
            [
                "id" => 10166,
                "year" => 2001,
                "make" => "Ford",
                "model" => "F150 SuperCrew Cab",
                "type" => "Pickup"
            ],
            [
                "id" => 10167,
                "year" => 2008,
                "make" => "Land Rover",
                "model" => "LR3",
                "type" => "SUV"
            ],
            [
                "id" => 10168,
                "year" => 2001,
                "make" => "Mercedes-Benz",
                "model" => "C-Class",
                "type" => "Sedan"
            ],
            [
                "id" => 10169,
                "year" => 1998,
                "make" => "Nissan",
                "model" => "Quest",
                "type" => "Van/Minivan"
            ],
            [
                "id" => 10170,
                "year" => 2017,
                "make" => "GMC",
                "model" => "Terrain",
                "type" => "SUV"
            ],
            [
                "id" => 10171,
                "year" => 2002,
                "make" => "Dodge",
                "model" => "Stratus",
                "type" => "Sedan, Coupe"
            ],
            [
                "id" => 10172,
                "year" => 2006,
                "make" => "Hyundai",
                "model" => "Sonata",
                "type" => "Sedan"
            ],
            [
                "id" => 10173,
                "year" => 1997,
                "make" => "Ford",
                "model" => "Escort",
                "type" => "Sedan, Wagon"
            ],
            [
                "id" => 10174,
                "year" => 2014,
                "make" => "Ram",
                "model" => "1500 Quad Cab",
                "type" => "Pickup"
            ],
            [
                "id" => 10175,
                "year" => 2011,
                "make" => "Ford",
                "model" => "E150 Cargo",
                "type" => "Van/Minivan"
            ],
            [
                "id" => 10176,
                "year" => 2005,
                "make" => "Audi",
                "model" => "TT",
                "type" => "Coupe, Convertible"
            ],
            [
                "id" => 10177,
                "year" => 1999,
                "make" => "Volvo",
                "model" => "S70",
                "type" => "Sedan"
            ],
            [
                "id" => 10178,
                "year" => 2008,
                "make" => "Nissan",
                "model" => "Quest",
                "type" => "Van/Minivan"
            ],
            [
                "id" => 10179,
                "year" => 2000,
                "make" => "GMC",
                "model" => "Sierra (Classic) 2500 HD Regular Cab",
                "type" => "Pickup"
            ],
            [
                "id" => 10180,
                "year" => 2006,
                "make" => "Mitsubishi",
                "model" => "Montero",
                "type" => "SUV"
            ],
            [
                "id" => 10181,
                "year" => 2001,
                "make" => "Volkswagen",
                "model" => "Cabrio",
                "type" => "Convertible"
            ],
            [
                "id" => 10182,
                "year" => 1993,
                "make" => "Plymouth",
                "model" => "Laser",
                "type" => "Hatchback"
            ],
            [
                "id" => 10183,
                "year" => 2005,
                "make" => "Dodge",
                "model" => "Dakota Quad Cab",
                "type" => "Pickup"
            ],
            [
                "id" => 10184,
                "year" => 2019,
                "make" => "Ram",
                "model" => "ProMaster City",
                "type" => "Van/Minivan"
            ],
            [
                "id" => 10185,
                "year" => 2017,
                "make" => "Chevrolet",
                "model" => "Colorado Crew Cab",
                "type" => "Pickup"
            ],
            [
                "id" => 10186,
                "year" => 1993,
                "make" => "Toyota",
                "model" => "Supra",
                "type" => "Hatchback"
            ],
            [
                "id" => 10187,
                "year" => 2009,
                "make" => "Lotus",
                "model" => "Elise",
                "type" => "Coupe"
            ],
            [
                "id" => 10188,
                "year" => 2018,
                "make" => "Ford",
                "model" => "Explorer",
                "type" => "SUV"
            ],
            [
                "id" => 10189,
                "year" => 2020,
                "make" => "MAZDA",
                "model" => "MAZDA3",
                "type" => "Sedan, Hatchback"
            ],
            [
                "id" => 10190,
                "year" => 2017,
                "make" => "Volvo",
                "model" => "V90",
                "type" => "Wagon"
            ],
            [
                "id" => 10191,
                "year" => 1999,
                "make" => "Land Rover",
                "model" => "Discovery",
                "type" => "SUV"
            ],
            [
                "id" => 10192,
                "year" => 2006,
                "make" => "Suzuki",
                "model" => "Grand Vitara",
                "type" => "SUV"
            ],
            [
                "id" => 10193,
                "year" => 2006,
                "make" => "Nissan",
                "model" => "350Z",
                "type" => "Coupe, Convertible"
            ],
            [
                "id" => 10194,
                "year" => 2016,
                "make" => "Ferrari",
                "model" => "FF",
                "type" => "Coupe"
            ],
            [
                "id" => 10195,
                "year" => 2015,
                "make" => "Honda",
                "model" => "Crosstour",
                "type" => "SUV"
            ],
            [
                "id" => 10196,
                "year" => 2013,
                "make" => "Ram",
                "model" => "3500 Mega Cab",
                "type" => "Pickup"
            ],
            [
                "id" => 10197,
                "year" => 2007,
                "make" => "Mitsubishi",
                "model" => "Raider Extended Cab",
                "type" => "Pickup"
            ],
            [
                "id" => 10198,
                "year" => 2014,
                "make" => "Kia",
                "model" => "Cadenza",
                "type" => "Sedan"
            ],
            ["id" => 10199, "year" => 2013, "make" => "Lexus", "model" => "LX", "type" => "SUV"],
            [
                "id" => 10200,
                "year" => 2007,
                "make" => "Toyota",
                "model" => "Tacoma Double Cab",
                "type" => "Pickup"
            ],
            [
                "id" => 10201,
                "year" => 1996,
                "make" => "INFINITI",
                "model" => "I",
                "type" => "Sedan"
            ],
            [
                "id" => 10202,
                "year" => 2012,
                "make" => "GMC",
                "model" => "Yukon XL 1500",
                "type" => "SUV"
            ],
            [
                "id" => 10203,
                "year" => 2019,
                "make" => "Nissan",
                "model" => "NV1500 Cargo",
                "type" => "Van/Minivan"
            ],
            [
                "id" => 10204,
                "year" => 2003,
                "make" => "GMC",
                "model" => "Yukon XL 1500",
                "type" => "SUV"
            ],
            [
                "id" => 10205,
                "year" => 2018,
                "make" => "Honda",
                "model" => "Clarity Fuel Cell",
                "type" => "Sedan"
            ],
            [
                "id" => 10206,
                "year" => 2012,
                "make" => "MAZDA",
                "model" => "CX-7",
                "type" => "SUV"
            ],
            [
                "id" => 10207,
                "year" => 1995,
                "make" => "Lincoln",
                "model" => "Continental",
                "type" => "Sedan"
            ],
            [
                "id" => 10208,
                "year" => 2006,
                "make" => "Jeep",
                "model" => "Grand Cherokee",
                "type" => "SUV"
            ],
            [
                "id" => 10209,
                "year" => 1996,
                "make" => "Volvo",
                "model" => "960",
                "type" => "Sedan, Wagon"
            ],
            [
                "id" => 10210,
                "year" => 2016,
                "make" => "Toyota",
                "model" => "Tundra Double Cab",
                "type" => "Pickup"
            ],
            [
                "id" => 10211,
                "year" => 1994,
                "make" => "Chrysler",
                "model" => "Town & Country",
                "type" => "Van/Minivan"
            ],
            [
                "id" => 10212,
                "year" => 2011,
                "make" => "Toyota",
                "model" => "Tundra CrewMax",
                "type" => "Pickup"
            ],

            [
                "id" => 10214,
                "year" => 2018,
                "make" => "Chevrolet",
                "model" => "Sonic",
                "type" => "Sedan, Hatchback"
            ],
            [
                "id" => 10215,
                "year" => 2008,
                "make" => "GMC",
                "model" => "Savana 2500 Cargo",
                "type" => "Van/Minivan"
            ],
            [
                "id" => 10216,
                "year" => 2002,
                "make" => "GMC",
                "model" => "Safari Cargo",
                "type" => "Van/Minivan"
            ],
            [
                "id" => 10217,
                "year" => 2013,
                "make" => "Kia",
                "model" => "Rio",
                "type" => "Sedan, Hatchback"
            ],
            [
                "id" => 10218,
                "year" => 2018,
                "make" => "Audi",
                "model" => "A5",
                "type" => "Sedan, Coupe, Convertible"
            ],
            [
                "id" => 10219,
                "year" => 2019,
                "make" => "Honda",
                "model" => "Accord",
                "type" => "Sedan"
            ],
            [
                "id" => 10220,
                "year" => 2002,
                "make" => "Saab",
                "model" => "5-Sep",
                "type" => "Sedan, Wagon"
            ],
            [
                "id" => 10221,
                "year" => 2007,
                "make" => "Nissan",
                "model" => "350Z",
                "type" => "Coupe, Convertible"
            ],
            [
                "id" => 10222,
                "year" => 2018,
                "make" => "Ford",
                "model" => "Transit 350 HD Van",
                "type" => "Van/Minivan"
            ],
            [
                "id" => 10223,
                "year" => 2001,
                "make" => "Lincoln",
                "model" => "Town Car",
                "type" => "Sedan"
            ],
            [
                "id" => 10224,
                "year" => 1999,
                "make" => "Nissan",
                "model" => "Quest",
                "type" => "Van/Minivan"
            ],
            [
                "id" => 10225,
                "year" => 2004,
                "make" => "Lincoln",
                "model" => "Aviator",
                "type" => "SUV"
            ],
            [
                "id" => 10226,
                "year" => 1992,
                "make" => "Volkswagen",
                "model" => "Jetta",
                "type" => "Sedan"
            ],
            [
                "id" => 10227,
                "year" => 2004,
                "make" => "GMC",
                "model" => "Savana 3500 Cargo",
                "type" => "Van/Minivan"
            ],
            [
                "id" => 10228,
                "year" => 2013,
                "make" => "Ferrari",
                "model" => "California",
                "type" => "Convertible"
            ],
            [
                "id" => 10229,
                "year" => 2006,
                "make" => "Chevrolet",
                "model" => "Silverado 2500 HD Regular Cab",
                "type" => "Pickup"
            ],
            [
                "id" => 10230,
                "year" => 2003,
                "make" => "Pontiac",
                "model" => "Bonneville",
                "type" => "Sedan"
            ],
            [
                "id" => 10231,
                "year" => 2000,
                "make" => "Chevrolet",
                "model" => "Express 3500 Passenger",
                "type" => "Van/Minivan"
            ],
            [
                "id" => 10232,
                "year" => 1994,
                "make" => "Ford",
                "model" => "Aerostar Passenger",
                "type" => "Van/Minivan"
            ],
            ["id" => 10233, "year" => 2014, "make" => "BMW", "model" => "X5", "type" => "SUV"],
            [
                "id" => 10234,
                "year" => 2000,
                "make" => "Nissan",
                "model" => "Frontier King Cab",
                "type" => "Pickup"
            ],
            ["id" => 10235, "year" => 2009, "make" => "Ford", "model" => "Edge", "type" => "SUV"],
            [
                "id" => 10236,
                "year" => 1997,
                "make" => "Hyundai",
                "model" => "Accent",
                "type" => "Sedan, Hatchback"
            ],
            [
                "id" => 10237,
                "year" => 2005,
                "make" => "Hyundai",
                "model" => "Santa Fe",
                "type" => "SUV"
            ],
            [
                "id" => 10238,
                "year" => 1998,
                "make" => "Chevrolet",
                "model" => "Venture Passenger",
                "type" => "Van/Minivan"
            ],
            [
                "id" => 10239,
                "year" => 2005,
                "make" => "Ford",
                "model" => "F150 SuperCrew Cab",
                "type" => "Pickup"
            ],
            [
                "id" => 10240,
                "year" => 1994,
                "make" => "GMC",
                "model" => "Vandura 2500",
                "type" => "Van/Minivan"
            ],
            [
                "id" => 10241,
                "year" => 2003,
                "make" => "Land Rover",
                "model" => "Range Rover",
                "type" => "SUV"
            ],
            [
                "id" => 10242,
                "year" => 1996,
                "make" => "Eagle",
                "model" => "Vision",
                "type" => "Sedan"
            ],
            [
                "id" => 10243,
                "year" => 2005,
                "make" => "Ford",
                "model" => "F150 Regular Cab",
                "type" => "Pickup"
            ],
            [
                "id" => 10244,
                "year" => 1993,
                "make" => "MAZDA",
                "model" => "B-Series Cab Plus",
                "type" => "Pickup"
            ],
            [
                "id" => 10245,
                "year" => 2016,
                "make" => "Chevrolet",
                "model" => "Spark",
                "type" => "Hatchback"
            ],
            [
                "id" => 10246,
                "year" => 2003,
                "make" => "Dodge",
                "model" => "Grand Caravan Cargo",
                "type" => "Van/Minivan"
            ],
            [
                "id" => 10247,
                "year" => 2016,
                "make" => "Alfa Romeo",
                "model" => "4C",
                "type" => "Coupe"
            ],
            [
                "id" => 10248,
                "year" => 2016,
                "make" => "Cadillac",
                "model" => "CTS",
                "type" => "Sedan"
            ],
            [
                "id" => 10249,
                "year" => 2012,
                "make" => "Hyundai",
                "model" => "Accent",
                "type" => "Sedan, Hatchback"
            ],
            [
                "id" => 10250,
                "year" => 2010,
                "make" => "Dodge",
                "model" => "Journey",
                "type" => "SUV"
            ],
            [
                "id" => 10251,
                "year" => 2013,
                "make" => "Audi",
                "model" => "A5",
                "type" => "Coupe, Convertible"
            ],
            [
                "id" => 10252,
                "year" => 2006,
                "make" => "Nissan",
                "model" => "Quest",
                "type" => "Van/Minivan"
            ],
            [
                "id" => 10253,
                "year" => 2017,
                "make" => "Ram",
                "model" => "2500 Mega Cab",
                "type" => "Pickup"
            ],

            [
                "id" => 10255,
                "year" => 2017,
                "make" => "Porsche",
                "model" => "Panamera",
                "type" => "Sedan"
            ],
            [
                "id" => 10256,
                "year" => 1992,
                "make" => "Chevrolet",
                "model" => "S10 Regular Cab",
                "type" => "Pickup"
            ],
            [
                "id" => 10257,
                "year" => 2019,
                "make" => "Lincoln",
                "model" => "Navigator",
                "type" => "SUV"
            ],
            [
                "id" => 10258,
                "year" => 1995,
                "make" => "Honda",
                "model" => "Prelude",
                "type" => "Coupe"
            ],
            [
                "id" => 10259,
                "year" => 2001,
                "make" => "Jeep",
                "model" => "Cherokee",
                "type" => "SUV"
            ],
            [
                "id" => 10260,
                "year" => 2018,
                "make" => "Chevrolet",
                "model" => "Malibu",
                "type" => "Sedan"
            ],
            [
                "id" => 10261,
                "year" => 2019,
                "make" => "Volkswagen",
                "model" => "Golf Alltrack",
                "type" => "Wagon"
            ],
            [
                "id" => 10262,
                "year" => 1995,
                "make" => "Chevrolet",
                "model" => "Astro Passenger",
                "type" => "Van/Minivan"
            ],
            [
                "id" => 10263,
                "year" => 1997,
                "make" => "Oldsmobile",
                "model" => "Cutlass",
                "type" => "Sedan"
            ],
            [
                "id" => 10264,
                "year" => 2010,
                "make" => "Volkswagen",
                "model" => "Routan",
                "type" => "Van/Minivan"
            ],
            [
                "id" => 10265,
                "year" => 2018,
                "make" => "Lincoln",
                "model" => "Navigator L",
                "type" => "SUV"
            ],
            [
                "id" => 10266,
                "year" => 2013,
                "make" => "Porsche",
                "model" => "Panamera",
                "type" => "Sedan"
            ],
            [
                "id" => 10267,
                "year" => 1994,
                "make" => "Toyota",
                "model" => "Xtra Cab",
                "type" => "Pickup"
            ],
            [
                "id" => 10268,
                "year" => 1999,
                "make" => "Chevrolet",
                "model" => "Silverado 1500 Regular Cab",
                "type" => "Pickup"
            ],
            [
                "id" => 10269,
                "year" => 2016,
                "make" => "GMC",
                "model" => "Sierra 3500 HD Double Cab",
                "type" => "Pickup"
            ],
            [
                "id" => 10270,
                "year" => 2002,
                "make" => "Dodge",
                "model" => "Caravan Passenger",
                "type" => "Van/Minivan"
            ],
            [
                "id" => 10271,
                "year" => 1992,
                "make" => "Dodge",
                "model" => "Grand Caravan Passenger",
                "type" => "Van/Minivan"
            ],
            [
                "id" => 10272,
                "year" => 2005,
                "make" => "Dodge",
                "model" => "Viper",
                "type" => "Convertible"
            ],
            [
                "id" => 10273,
                "year" => 1999,
                "make" => "BMW",
                "model" => "5 Series",
                "type" => "Sedan, Wagon"
            ],
            [
                "id" => 10274,
                "year" => 2010,
                "make" => "Bentley",
                "model" => "Continental",
                "type" => "Sedan, Coupe, Convertible"
            ],
            [
                "id" => 10275,
                "year" => 1993,
                "make" => "Land Rover",
                "model" => "Range Rover",
                "type" => "SUV"
            ],
            [
                "id" => 10276,
                "year" => 2018,
                "make" => "Nissan",
                "model" => "Rogue Sport",
                "type" => "SUV"
            ],
            [
                "id" => 10277,
                "year" => 2006,
                "make" => "Suzuki",
                "model" => "Aerio",
                "type" => "Sedan, Wagon"
            ],
            [
                "id" => 10278,
                "year" => 1998,
                "make" => "Isuzu",
                "model" => "Oasis",
                "type" => "Van/Minivan"
            ],
            [
                "id" => 10279,
                "year" => 2007,
                "make" => "GMC",
                "model" => "Sierra (Classic) 1500 Regular Cab",
                "type" => "Pickup"
            ],
            [
                "id" => 10280,
                "year" => 2016,
                "make" => "Chevrolet",
                "model" => "Silverado 1500 Double Cab",
                "type" => "Pickup"
            ],
            [
                "id" => 10281,
                "year" => 2018,
                "make" => "Mercedes-Benz",
                "model" => "Mercedes-AMG SL",
                "type" => "Convertible"
            ],
            [
                "id" => 10282,
                "year" => 2018,
                "make" => "Cadillac",
                "model" => "XT5",
                "type" => "SUV"
            ],
            [
                "id" => 10283,
                "year" => 2011,
                "make" => "Lexus",
                "model" => "HS",
                "type" => "Sedan"
            ],
            [
                "id" => 10284,
                "year" => 2000,
                "make" => "BMW",
                "model" => "5 Series",
                "type" => "Sedan, Wagon"
            ],
            [
                "id" => 10285,
                "year" => 2017,
                "make" => "Ram",
                "model" => "1500 Crew Cab",
                "type" => "Pickup"
            ],
            [
                "id" => 10286,
                "year" => 1992,
                "make" => "Isuzu",
                "model" => "Impulse",
                "type" => "Hatchback"
            ],
            [
                "id" => 10287,
                "year" => 2020,
                "make" => "Toyota",
                "model" => "86",
                "type" => "Coupe"
            ],
            [
                "id" => 10288,
                "year" => 2002,
                "make" => "Dodge",
                "model" => "Ram Van 3500",
                "type" => "Van/Minivan"
            ],
            [
                "id" => 10289,
                "year" => 2005,
                "make" => "Pontiac",
                "model" => "GTO",
                "type" => "Coupe"
            ],
            [
                "id" => 10290,
                "year" => 1993,
                "make" => "GMC",
                "model" => "Vandura 3500",
                "type" => "Van/Minivan"
            ],
            [
                "id" => 10291,
                "year" => 2017,
                "make" => "Bentley",
                "model" => "Flying Spur",
                "type" => "Sedan"
            ],
            ["id" => 10292, "year" => 2008, "make" => "GMC", "model" => "Envoy", "type" => "SUV"],
            [
                "id" => 10293,
                "year" => 2003,
                "make" => "Nissan",
                "model" => "Frontier King Cab",
                "type" => "Pickup"
            ],
            [
                "id" => 10294,
                "year" => 1995,
                "make" => "Ford",
                "model" => "Thunderbird",
                "type" => "Coupe"
            ],
            [
                "id" => 10295,
                "year" => 2019,
                "make" => "Chevrolet",
                "model" => "Colorado Extended Cab",
                "type" => "Pickup"
            ],
            [
                "id" => 10296,
                "year" => 2015,
                "make" => "Lexus",
                "model" => "CT",
                "type" => "Hatchback"
            ],
            ["id" => 10297, "year" => 2019, "make" => "Audi", "model" => "A8", "type" => "Sedan"],
            [
                "id" => 10298,
                "year" => 2007,
                "make" => "Honda",
                "model" => "Odyssey",
                "type" => "Van/Minivan"
            ],
            [
                "id" => 10299,
                "year" => 2004,
                "make" => "Audi",
                "model" => "TT",
                "type" => "Coupe, Convertible"
            ],
            [
                "id" => 10300,
                "year" => 2005,
                "make" => "Chevrolet",
                "model" => "Silverado 1500 Extended Cab",
                "type" => "Pickup"
            ],
            [
                "id" => 10301,
                "year" => 2008,
                "make" => "Dodge",
                "model" => "Ram 3500 Mega Cab",
                "type" => "Pickup"
            ],
            [
                "id" => 10302,
                "year" => 2010,
                "make" => "Honda",
                "model" => "Odyssey",
                "type" => "Van/Minivan"
            ],
            [
                "id" => 10303,
                "year" => 2008,
                "make" => "Chevrolet",
                "model" => "Express 1500 Passenger",
                "type" => "Van/Minivan"
            ],
            [
                "id" => 10304,
                "year" => 2018,
                "make" => "Subaru",
                "model" => "Outback",
                "type" => "SUV"
            ],
            [
                "id" => 10305,
                "year" => 2013,
                "make" => "Ram",
                "model" => "2500 Crew Cab",
                "type" => "Pickup"
            ],
            [
                "id" => 10306,
                "year" => 2006,
                "make" => "Jeep",
                "model" => "Liberty",
                "type" => "SUV"
            ],
            [
                "id" => 10307,
                "year" => 2010,
                "make" => "Jeep",
                "model" => "Patriot",
                "type" => "SUV"
            ],
            [
                "id" => 10308,
                "year" => 2010,
                "make" => "Dodge",
                "model" => "Ram 3500 Crew Cab",
                "type" => "Pickup"
            ],
            [
                "id" => 10309,
                "year" => 2006,
                "make" => "Hyundai",
                "model" => "Azera",
                "type" => "Sedan"
            ],
            [
                "id" => 10310,
                "year" => 2010,
                "make" => "Hyundai",
                "model" => "Santa Fe",
                "type" => "SUV"
            ],
            [
                "id" => 10311,
                "year" => 2018,
                "make" => "Hyundai",
                "model" => "Accent",
                "type" => "Sedan"
            ],
            [
                "id" => 10312,
                "year" => 1993,
                "make" => "Dodge",
                "model" => "D350 Regular Cab",
                "type" => "Pickup"
            ],
            [
                "id" => 10313,
                "year" => 2011,
                "make" => "Lotus",
                "model" => "Exige",
                "type" => "Coupe"
            ],
            [
                "id" => 10314,
                "year" => 2000,
                "make" => "INFINITI",
                "model" => "QX",
                "type" => "SUV"
            ],
            [
                "id" => 10315,
                "year" => 1994,
                "make" => "Lexus",
                "model" => "GS",
                "type" => "Sedan"
            ],
            [
                "id" => 10316,
                "year" => 2003,
                "make" => "Ford",
                "model" => "F350 Super Duty Regular Cab",
                "type" => "Pickup"
            ],
            [
                "id" => 10317,
                "year" => 2015,
                "make" => "Jaguar",
                "model" => "XK",
                "type" => "Coupe, Convertible"
            ],
            [
                "id" => 10318,
                "year" => 1995,
                "make" => "Chevrolet",
                "model" => "Corsica",
                "type" => "Sedan"
            ],
            [
                "id" => 10319,
                "year" => 2012,
                "make" => "Ford",
                "model" => "F150 SuperCrew Cab",
                "type" => "Pickup"
            ],
            [
                "id" => 10320,
                "year" => 2002,
                "make" => "Ford",
                "model" => "Crown Victoria",
                "type" => "Sedan"
            ],
            [
                "id" => 10321,
                "year" => 2002,
                "make" => "Lexus",
                "model" => "SC",
                "type" => "Convertible"
            ],
            [
                "id" => 10322,
                "year" => 1992,
                "make" => "Chevrolet",
                "model" => "2500 Regular Cab",
                "type" => "Pickup"
            ],
            [
                "id" => 10323,
                "year" => 1995,
                "make" => "Porsche",
                "model" => "968",
                "type" => "Coupe, Convertible"
            ],
            [
                "id" => 10324,
                "year" => 1996,
                "make" => "Mercury",
                "model" => "Villager",
                "type" => "Van/Minivan"
            ],
            [
                "id" => 10325,
                "year" => 2016,
                "make" => "Toyota",
                "model" => "Corolla",
                "type" => "Sedan"
            ],
            [
                "id" => 10326,
                "year" => 2015,
                "make" => "Toyota",
                "model" => "Prius v",
                "type" => "Wagon"
            ],
            [
                "id" => 10327,
                "year" => 2004,
                "make" => "Chevrolet",
                "model" => "Express 1500 Cargo",
                "type" => "Van/Minivan"
            ],
            [
                "id" => 10328,
                "year" => 2006,
                "make" => "Acura",
                "model" => "TSX",
                "type" => "Sedan"
            ],
            [
                "id" => 10329,
                "year" => 2004,
                "make" => "Nissan",
                "model" => "Titan King Cab",
                "type" => "Pickup"
            ],
            [
                "id" => 10330,
                "year" => 2019,
                "make" => "Kia",
                "model" => "Optima Plug-in Hybrid",
                "type" => "Sedan"
            ],
            [
                "id" => 10331,
                "year" => 1995,
                "make" => "Mercedes-Benz",
                "model" => "SL-Class",
                "type" => "Convertible"
            ],
            [
                "id" => 10332,
                "year" => 1994,
                "make" => "Ford",
                "model" => "F350 Regular Cab",
                "type" => "Pickup"
            ],
            [
                "id" => 10333,
                "year" => 2012,
                "make" => "Ford",
                "model" => "Transit Connect Cargo",
                "type" => "Van/Minivan"
            ],
            [
                "id" => 10334,
                "year" => 1992,
                "make" => "Dodge",
                "model" => "Viper",
                "type" => "Convertible"
            ],
            [
                "id" => 10335,
                "year" => 2003,
                "make" => "Dodge",
                "model" => "Ram 3500 Quad Cab",
                "type" => "Pickup"
            ],
            [
                "id" => 10336,
                "year" => 2002,
                "make" => "Chevrolet",
                "model" => "Astro Passenger",
                "type" => "Van/Minivan"
            ],
            [
                "id" => 10337,
                "year" => 1999,
                "make" => "BMW",
                "model" => "3 Series",
                "type" => "Sedan, Coupe, Convertible, Hatchback"
            ],
            [
                "id" => 10338,
                "year" => 2005,
                "make" => "Mitsubishi",
                "model" => "Lancer",
                "type" => "Sedan"
            ],
            [
                "id" => 10339,
                "year" => 2000,
                "make" => "Ford",
                "model" => "Taurus",
                "type" => "Sedan, Wagon"
            ],
            [
                "id" => 10340,
                "year" => 2018,
                "make" => "FIAT",
                "model" => "500c",
                "type" => "Convertible"
            ],
            [
                "id" => 10341,
                "year" => 2008,
                "make" => "Bentley",
                "model" => "Arnage",
                "type" => "Sedan"
            ],
            [
                "id" => 10342,
                "year" => 2016,
                "make" => "GMC",
                "model" => "Sierra 2500 HD Crew Cab",
                "type" => "Pickup"
            ],
            [
                "id" => 10343,
                "year" => 2000,
                "make" => "Land Rover",
                "model" => "Discovery Series II",
                "type" => "SUV"
            ],
            [
                "id" => 10344,
                "year" => 1997,
                "make" => "Chevrolet",
                "model" => "Malibu",
                "type" => "Sedan"
            ],
            ["id" => 10345, "year" => 2001, "make" => "Kia", "model" => "Rio", "type" => "Sedan"],
            ["id" => 10346, "year" => 2015, "make" => "BMW", "model" => "M5", "type" => "Sedan"],
            [
                "id" => 10347,
                "year" => 2016,
                "make" => "Ford",
                "model" => "Transit Connect Cargo",
                "type" => "Van/Minivan"
            ],
            [
                "id" => 10348,
                "year" => 1993,
                "make" => "Lexus",
                "model" => "LS",
                "type" => "Sedan"
            ],
            [
                "id" => 10349,
                "year" => 1996,
                "make" => "Geo",
                "model" => "Prizm",
                "type" => "Sedan"
            ],
            [
                "id" => 10350,
                "year" => 1999,
                "make" => "Mercury",
                "model" => "Grand Marquis",
                "type" => "Sedan"
            ],
            ["id" => 10351, "year" => 2006, "make" => "GMC", "model" => "Envoy", "type" => "SUV"],
            [
                "id" => 10352,
                "year" => 1994,
                "make" => "MAZDA",
                "model" => "323",
                "type" => "Hatchback"
            ],
            [
                "id" => 10353,
                "year" => 2020,
                "make" => "Land Rover",
                "model" => "Discovery Sport",
                "type" => "SUV"
            ],
            [
                "id" => 10354,
                "year" => 2005,
                "make" => "Acura",
                "model" => "NSX",
                "type" => "Coupe"
            ],
            ["id" => 10355, "year" => 2018, "make" => "Audi", "model" => "A6", "type" => "Sedan"],
            ["id" => 10356, "year" => 2013, "make" => "Audi", "model" => "S6", "type" => "Sedan"],
            [
                "id" => 10357,
                "year" => 2002,
                "make" => "Acura",
                "model" => "RSX",
                "type" => "Coupe"
            ],
            [
                "id" => 10358,
                "year" => 2004,
                "make" => "Ford",
                "model" => "Ranger Super Cab",
                "type" => "Pickup"
            ],
            [
                "id" => 10359,
                "year" => 2016,
                "make" => "Mercedes-Benz",
                "model" => "Mercedes-AMG GLA",
                "type" => "SUV"
            ],
            [
                "id" => 10360,
                "year" => 2001,
                "make" => "Kia",
                "model" => "Spectra",
                "type" => "Hatchback"
            ],
            [
                "id" => 10361,
                "year" => 1996,
                "make" => "Mitsubishi",
                "model" => "Mirage",
                "type" => "Sedan, Coupe"
            ],
            [
                "id" => 10362,
                "year" => 2002,
                "make" => "GMC",
                "model" => "Sonoma Regular Cab",
                "type" => "Pickup"
            ],
            [
                "id" => 10363,
                "year" => 2008,
                "make" => "Chevrolet",
                "model" => "TrailBlazer",
                "type" => "SUV"
            ],
            [
                "id" => 10364,
                "year" => 2000,
                "make" => "Chevrolet",
                "model" => "Astro Cargo",
                "type" => "Van/Minivan"
            ],
            ["id" => 10365, "year" => 2013, "make" => "BMW", "model" => "M5", "type" => "Sedan"],
            [
                "id" => 10366,
                "year" => 2009,
                "make" => "Mercedes-Benz",
                "model" => "GL-Class",
                "type" => "SUV"
            ],
            [
                "id" => 10367,
                "year" => 1992,
                "make" => "Chevrolet",
                "model" => "Lumina",
                "type" => "Sedan, Coupe"
            ],
            [
                "id" => 10368,
                "year" => 2014,
                "make" => "Hyundai",
                "model" => "Genesis",
                "type" => "Sedan"
            ],
            [
                "id" => 10369,
                "year" => 2012,
                "make" => "Subaru",
                "model" => "Legacy",
                "type" => "Sedan"
            ],
            [
                "id" => 10370,
                "year" => 2020,
                "make" => "Toyota",
                "model" => "Highlander Hybrid",
                "type" => "SUV"
            ],
            [
                "id" => 10371,
                "year" => 2002,
                "make" => "Dodge",
                "model" => "Ram Van 1500",
                "type" => "Van/Minivan"
            ],
            [
                "id" => 10372,
                "year" => 2001,
                "make" => "Chevrolet",
                "model" => "Express 3500 Cargo",
                "type" => "Van/Minivan"
            ],
            [
                "id" => 10373,
                "year" => 2014,
                "make" => "FIAT",
                "model" => "500 Abarth",
                "type" => "Convertible, Hatchback"
            ],
            [
                "id" => 10374,
                "year" => 2017,
                "make" => "Jeep",
                "model" => "Wrangler",
                "type" => "SUV"
            ],
            [
                "id" => 10375,
                "year" => 2005,
                "make" => "Dodge",
                "model" => "Caravan Passenger",
                "type" => "Van/Minivan"
            ],
            [
                "id" => 10376,
                "year" => 2004,
                "make" => "Chevrolet",
                "model" => "Colorado Regular Cab",
                "type" => "Pickup"
            ],
            [
                "id" => 10377,
                "year" => 1998,
                "make" => "Ford",
                "model" => "Econoline E250 Cargo",
                "type" => "Van/Minivan"
            ],
            [
                "id" => 10378,
                "year" => 1996,
                "make" => "Plymouth",
                "model" => "Voyager",
                "type" => "Van/Minivan"
            ],
            [
                "id" => 10379,
                "year" => 2017,
                "make" => "GMC",
                "model" => "Savana 2500 Cargo",
                "type" => "Van/Minivan"
            ],
            [
                "id" => 10380,
                "year" => 2014,
                "make" => "Porsche",
                "model" => "Cayman",
                "type" => "Coupe"
            ],
            ["id" => 10381, "year" => 2018, "make" => "Audi", "model" => "Q7", "type" => "SUV"],
            [
                "id" => 10382,
                "year" => 2013,
                "make" => "Mercedes-Benz",
                "model" => "Sprinter 2500 Passenger",
                "type" => "Van/Minivan"
            ],
            [
                "id" => 10383,
                "year" => 2019,
                "make" => "BMW",
                "model" => "8 Series",
                "type" => "Coupe, Convertible"
            ],
            [
                "id" => 10384,
                "year" => 2001,
                "make" => "Chevrolet",
                "model" => "Camaro",
                "type" => "Coupe, Convertible"
            ],
            [
                "id" => 10385,
                "year" => 2012,
                "make" => "Chevrolet",
                "model" => "Cruze",
                "type" => "Sedan"
            ],
            [
                "id" => 10386,
                "year" => 2012,
                "make" => "Ram",
                "model" => "C/V",
                "type" => "Van/Minivan"
            ],
            [
                "id" => 10387,
                "year" => 2004,
                "make" => "Kia",
                "model" => "Optima",
                "type" => "Sedan"
            ],
            [
                "id" => 10388,
                "year" => 2003,
                "make" => "Cadillac",
                "model" => "Escalade",
                "type" => "SUV"
            ],
            ["id" => 10389, "year" => 1994, "make" => "Audi", "model" => "S4", "type" => "Sedan"],
            [
                "id" => 10390,
                "year" => 2005,
                "make" => "Toyota",
                "model" => "Sequoia",
                "type" => "SUV"
            ],
            ["id" => 10391, "year" => 2016, "make" => "Audi", "model" => "S7", "type" => "Sedan"],
            [
                "id" => 10392,
                "year" => 2019,
                "make" => "Chevrolet",
                "model" => "Express 2500 Passenger",
                "type" => "Van/Minivan"
            ],
            [
                "id" => 10393,
                "year" => 1993,
                "make" => "Dodge",
                "model" => "Viper",
                "type" => "Convertible"
            ],
            [
                "id" => 10394,
                "year" => 2000,
                "make" => "Dodge",
                "model" => "Ram 1500 Regular Cab",
                "type" => "Pickup"
            ],
            [
                "id" => 10395,
                "year" => 2007,
                "make" => "Ford",
                "model" => "F250 Super Duty Super Cab",
                "type" => "Pickup"
            ],
            [
                "id" => 10396,
                "year" => 2008,
                "make" => "Toyota",
                "model" => "Tacoma Access Cab",
                "type" => "Pickup"
            ],
            [
                "id" => 10397,
                "year" => 2009,
                "make" => "Hyundai",
                "model" => "Tucson",
                "type" => "SUV"
            ],
            [
                "id" => 10398,
                "year" => 2016,
                "make" => "Volvo",
                "model" => "S60",
                "type" => "Sedan"
            ],
            [
                "id" => 10399,
                "year" => 1995,
                "make" => "Ford",
                "model" => "Econoline E350 Cargo",
                "type" => "Van/Minivan"
            ],
            ["id" => 10400, "year" => 2019, "make" => "Audi", "model" => "S3", "type" => "Sedan"],
            [
                "id" => 10401,
                "year" => 2017,
                "make" => "BMW",
                "model" => "7 Series",
                "type" => "Sedan"
            ],
            [
                "id" => 10402,
                "year" => 2007,
                "make" => "BMW",
                "model" => "Z4",
                "type" => "Coupe, Convertible"
            ],
            [
                "id" => 10403,
                "year" => 2005,
                "make" => "Pontiac",
                "model" => "Sunfire",
                "type" => "Coupe"
            ],
            [
                "id" => 10404,
                "year" => 2006,
                "make" => "BMW",
                "model" => "6 Series",
                "type" => "Coupe, Convertible"
            ],
            [
                "id" => 10405,
                "year" => 2011,
                "make" => "Nissan",
                "model" => "Armada",
                "type" => "SUV"
            ],
            [
                "id" => 10406,
                "year" => 2019,
                "make" => "Subaru",
                "model" => "Ascent",
                "type" => "SUV"
            ],
            [
                "id" => 10407,
                "year" => 1994,
                "make" => "Ford",
                "model" => "Econoline E150 Cargo",
                "type" => "Van/Minivan"
            ],
            ["id" => 10408, "year" => 2010, "make" => "Audi", "model" => "A3", "type" => "Wagon"],
            [
                "id" => 10409,
                "year" => 2015,
                "make" => "Chevrolet",
                "model" => "Volt",
                "type" => "Sedan"
            ],
            [
                "id" => 10410,
                "year" => 1995,
                "make" => "Mercedes-Benz",
                "model" => "C-Class",
                "type" => "Sedan"
            ],
            [
                "id" => 10411,
                "year" => 2006,
                "make" => "Scion",
                "model" => "xB",
                "type" => "Hatchback"
            ],
            ["id" => 10412, "year" => 2012, "make" => "Lexus", "model" => "RX", "type" => "SUV"],
            [
                "id" => 10413,
                "year" => 2006,
                "make" => "Dodge",
                "model" => "Stratus",
                "type" => "Sedan"
            ],
            [
                "id" => 10414,
                "year" => 2009,
                "make" => "Chevrolet",
                "model" => "Aveo",
                "type" => "Sedan, Hatchback"
            ],
            [
                "id" => 10415,
                "year" => 2012,
                "make" => "Nissan",
                "model" => "Altima",
                "type" => "Sedan, Coupe"
            ],
            [
                "id" => 10416,
                "year" => 2014,
                "make" => "GMC",
                "model" => "Acadia",
                "type" => "SUV"
            ],
            [
                "id" => 10417,
                "year" => 2011,
                "make" => "smart",
                "model" => "fortwo",
                "type" => "Convertible, Hatchback"
            ],
            [
                "id" => 10418,
                "year" => 1992,
                "make" => "Nissan",
                "model" => "Maxima",
                "type" => "Sedan"
            ],

            [
                "id" => 10420,
                "year" => 2002,
                "make" => "Mercury",
                "model" => "Mountaineer",
                "type" => "SUV"
            ],
            [
                "id" => 10421,
                "year" => 2000,
                "make" => "Chevrolet",
                "model" => "Tracker",
                "type" => "SUV"
            ],
            [
                "id" => 10422,
                "year" => 2009,
                "make" => "Mercedes-Benz",
                "model" => "SLK-Class",
                "type" => "Convertible"
            ],
            [
                "id" => 10423,
                "year" => 2016,
                "make" => "BMW",
                "model" => "M4",
                "type" => "Coupe, Convertible"
            ],
            [
                "id" => 10424,
                "year" => 2008,
                "make" => "Subaru",
                "model" => "Outback",
                "type" => "Wagon"
            ],
            [
                "id" => 10425,
                "year" => 2012,
                "make" => "Dodge",
                "model" => "Charger",
                "type" => "Sedan"
            ],
            [
                "id" => 10426,
                "year" => 2016,
                "make" => "Ferrari",
                "model" => "California",
                "type" => "Convertible"
            ],
            [
                "id" => 10427,
                "year" => 2003,
                "make" => "Ford",
                "model" => "F150 Regular Cab",
                "type" => "Pickup"
            ],
            [
                "id" => 10428,
                "year" => 2017,
                "make" => "Nissan",
                "model" => "Altima",
                "type" => "Sedan"
            ],
            [
                "id" => 10429,
                "year" => 2000,
                "make" => "GMC",
                "model" => "Sierra (Classic) 3500 Extended Cab",
                "type" => "Pickup"
            ],
            [
                "id" => 10430,
                "year" => 2007,
                "make" => "Saturn",
                "model" => "Ion",
                "type" => "Sedan, Coupe"
            ],
            [
                "id" => 10431,
                "year" => 1999,
                "make" => "Toyota",
                "model" => "4Runner",
                "type" => "SUV"
            ],
            [
                "id" => 10432,
                "year" => 2016,
                "make" => "Rolls-Royce",
                "model" => "Ghost",
                "type" => "Sedan"
            ],
            ["id" => 10433, "year" => 2000, "make" => "BMW", "model" => "X5", "type" => "SUV"],
            [
                "id" => 10434,
                "year" => 2006,
                "make" => "Volkswagen",
                "model" => "Golf",
                "type" => "Hatchback"
            ],
            [
                "id" => 10435,
                "year" => 1998,
                "make" => "Ford",
                "model" => "Ranger Super Cab",
                "type" => "Pickup"
            ],
            [
                "id" => 10436,
                "year" => 2019,
                "make" => "Honda",
                "model" => "Clarity Electric",
                "type" => "Sedan"
            ],
            [
                "id" => 10437,
                "year" => 2018,
                "make" => "Ford",
                "model" => "F350 Super Duty Regular Cab",
                "type" => "Pickup"
            ],
            [
                "id" => 10438,
                "year" => 1998,
                "make" => "Dodge",
                "model" => "Caravan Passenger",
                "type" => "Van/Minivan"
            ],
            [
                "id" => 10439,
                "year" => 2000,
                "make" => "Chevrolet",
                "model" => "Silverado 2500 Extended Cab",
                "type" => "Pickup"
            ],
            [
                "id" => 10440,
                "year" => 2003,
                "make" => "Pontiac",
                "model" => "Montana",
                "type" => "Van/Minivan"
            ],
            [
                "id" => 10441,
                "year" => 2007,
                "make" => "Chevrolet",
                "model" => "Colorado Crew Cab",
                "type" => "Pickup"
            ],
            [
                "id" => 10442,
                "year" => 2007,
                "make" => "Dodge",
                "model" => "Dakota Club Cab",
                "type" => "Pickup"
            ],
            [
                "id" => 10443,
                "year" => 2007,
                "make" => "Chevrolet",
                "model" => "Corvette",
                "type" => "Coupe, Convertible"
            ],
            [
                "id" => 10444,
                "year" => 2004,
                "make" => "Suzuki",
                "model" => "Aerio",
                "type" => "Sedan, Wagon"
            ],
            [
                "id" => 10445,
                "year" => 1999,
                "make" => "Toyota",
                "model" => "Corolla",
                "type" => "Sedan"
            ],
            [
                "id" => 10446,
                "year" => 1994,
                "make" => "Land Rover",
                "model" => "Discovery",
                "type" => "SUV"
            ],
            ["id" => 10447, "year" => 2015, "make" => "Audi", "model" => "A8", "type" => "Sedan"],
            [
                "id" => 10448,
                "year" => 2001,
                "make" => "Daewoo",
                "model" => "Leganza",
                "type" => "Sedan"
            ],
            [
                "id" => 10449,
                "year" => 1993,
                "make" => "Pontiac",
                "model" => "Bonneville",
                "type" => "Sedan"
            ],
            [
                "id" => 10450,
                "year" => 2005,
                "make" => "Honda",
                "model" => "Pilot",
                "type" => "SUV"
            ],
            [
                "id" => 10451,
                "year" => 2002,
                "make" => "GMC",
                "model" => "Savana 3500 Passenger",
                "type" => "Van/Minivan"
            ],
            [
                "id" => 10452,
                "year" => 2020,
                "make" => "Kia",
                "model" => "Optima Plug-in Hybrid",
                "type" => "Sedan"
            ],
            [
                "id" => 10453,
                "year" => 2010,
                "make" => "Subaru",
                "model" => "Legacy",
                "type" => "Sedan"
            ],
            [
                "id" => 10454,
                "year" => 2011,
                "make" => "Hyundai",
                "model" => "Equus",
                "type" => "Sedan"
            ],
            [
                "id" => 10455,
                "year" => 2012,
                "make" => "Volvo",
                "model" => "S80",
                "type" => "Sedan"
            ],
            [
                "id" => 10456,
                "year" => 2001,
                "make" => "GMC",
                "model" => "Sonoma Extended Cab",
                "type" => "Pickup"
            ],
            [
                "id" => 10457,
                "year" => 2009,
                "make" => "Lexus",
                "model" => "IS F",
                "type" => "Sedan"
            ],
            [
                "id" => 10458,
                "year" => 2017,
                "make" => "Hyundai",
                "model" => "Elantra",
                "type" => "Sedan"
            ],
            [
                "id" => 10459,
                "year" => 2003,
                "make" => "Subaru",
                "model" => "Impreza",
                "type" => "Sedan, Wagon"
            ],
            [
                "id" => 10460,
                "year" => 2000,
                "make" => "GMC",
                "model" => "Savana 2500 Cargo",
                "type" => "Van/Minivan"
            ],
            [
                "id" => 10461,
                "year" => 2003,
                "make" => "Toyota",
                "model" => "Land Cruiser",
                "type" => "SUV"
            ],
            [
                "id" => 10462,
                "year" => 2005,
                "make" => "Saab",
                "model" => "3-Sep",
                "type" => "Sedan, Convertible"
            ],
            [
                "id" => 10463,
                "year" => 2005,
                "make" => "Toyota",
                "model" => "4Runner",
                "type" => "SUV"
            ],
            [
                "id" => 10464,
                "year" => 2016,
                "make" => "Volvo",
                "model" => "XC60",
                "type" => "SUV"
            ],
            [
                "id" => 10465,
                "year" => 2007,
                "make" => "Chevrolet",
                "model" => "Silverado (Classic) 1500 Extended Cab",
                "type" => "Pickup"
            ],
            [
                "id" => 10466,
                "year" => 2004,
                "make" => "Chrysler",
                "model" => "Crossfire",
                "type" => "Coupe"
            ],
            [
                "id" => 10467,
                "year" => 2013,
                "make" => "BMW",
                "model" => "6 Series",
                "type" => "Coupe, Convertible"
            ],
            [
                "id" => 10468,
                "year" => 2003,
                "make" => "Chrysler",
                "model" => "Sebring",
                "type" => "Sedan, Coupe, Convertible"
            ],
            [
                "id" => 10469,
                "year" => 1996,
                "make" => "Geo",
                "model" => "Metro",
                "type" => "Sedan, Hatchback"
            ],
            [
                "id" => 10470,
                "year" => 2012,
                "make" => "Nissan",
                "model" => "Frontier Crew Cab",
                "type" => "Pickup"
            ],
            [
                "id" => 10471,
                "year" => 1993,
                "make" => "Plymouth",
                "model" => "Grand Voyager",
                "type" => "Van/Minivan"
            ],
            [
                "id" => 10472,
                "year" => 2010,
                "make" => "Cadillac",
                "model" => "Escalade EXT",
                "type" => "Pickup"
            ],
            ["id" => 10473, "year" => 2019, "make" => "BMW", "model" => "X2", "type" => "SUV"],
            [
                "id" => 10474,
                "year" => 2006,
                "make" => "Kia",
                "model" => "Optima",
                "type" => "Sedan"
            ],
            [
                "id" => 10475,
                "year" => 2018,
                "make" => "Ford",
                "model" => "Expedition",
                "type" => "SUV"
            ],
            [
                "id" => 10476,
                "year" => 1992,
                "make" => "Lexus",
                "model" => "LS",
                "type" => "Sedan"
            ],
            [
                "id" => 10477,
                "year" => 2019,
                "make" => "Ford",
                "model" => "Mustang",
                "type" => "Coupe, Convertible"
            ],
            [
                "id" => 10478,
                "year" => 1998,
                "make" => "Chrysler",
                "model" => "Town & Country",
                "type" => "Van/Minivan"
            ],
            [
                "id" => 10479,
                "year" => 2018,
                "make" => "Ferrari",
                "model" => "812 Superfast",
                "type" => "Coupe"
            ],
            [
                "id" => 10480,
                "year" => 2015,
                "make" => "BMW",
                "model" => "2 Series",
                "type" => "Coupe, Convertible"
            ],
            [
                "id" => 10481,
                "year" => 1998,
                "make" => "BMW",
                "model" => "7 Series",
                "type" => "Sedan"
            ],
            [
                "id" => 10482,
                "year" => 1992,
                "make" => "Chrysler",
                "model" => "Town & Country",
                "type" => "Van/Minivan"
            ],
            [
                "id" => 10483,
                "year" => 2016,
                "make" => "Chevrolet",
                "model" => "Suburban",
                "type" => "SUV"
            ],
            [
                "id" => 10484,
                "year" => 1992,
                "make" => "Ford",
                "model" => "Aerostar Passenger",
                "type" => "Van/Minivan"
            ],
            [
                "id" => 10485,
                "year" => 2015,
                "make" => "GMC",
                "model" => "Sierra 2500 HD Double Cab",
                "type" => "Pickup"
            ],
            [
                "id" => 10486,
                "year" => 2019,
                "make" => "Toyota",
                "model" => "RAV4 Hybrid",
                "type" => "SUV"
            ],
            [
                "id" => 10487,
                "year" => 2014,
                "make" => "Chevrolet",
                "model" => "Spark",
                "type" => "Hatchback"
            ],
            [
                "id" => 10488,
                "year" => 2010,
                "make" => "Lotus",
                "model" => "Elise",
                "type" => "Coupe"
            ],
            [
                "id" => 10489,
                "year" => 2008,
                "make" => "Chevrolet",
                "model" => "Malibu",
                "type" => "Sedan"
            ],
            [
                "id" => 10490,
                "year" => 2014,
                "make" => "Ford",
                "model" => "F250 Super Duty Regular Cab",
                "type" => "Pickup"
            ],
            [
                "id" => 10491,
                "year" => 2002,
                "make" => "Mercedes-Benz",
                "model" => "SL-Class",
                "type" => "Convertible"
            ],
            [
                "id" => 10492,
                "year" => 2002,
                "make" => "Volvo",
                "model" => "S40",
                "type" => "Sedan"
            ],
            ["id" => 10493, "year" => 2011, "make" => "Lexus", "model" => "GX", "type" => "SUV"],
            [
                "id" => 10494,
                "year" => 1996,
                "make" => "Acura",
                "model" => "RL",
                "type" => "Sedan"
            ],
            [
                "id" => 10495,
                "year" => 2001,
                "make" => "GMC",
                "model" => "Sierra 3500 Extended Cab",
                "type" => "Pickup"
            ],
            [
                "id" => 10496,
                "year" => 2008,
                "make" => "Lincoln",
                "model" => "Town Car",
                "type" => "Sedan"
            ],
            [
                "id" => 10497,
                "year" => 1992,
                "make" => "Chevrolet",
                "model" => "Sportvan G30",
                "type" => "Van/Minivan"
            ],
            [
                "id" => 10498,
                "year" => 2016,
                "make" => "Freightliner",
                "model" => "Sprinter 2500 Crew",
                "type" => "Van/Minivan"
            ],
            ["id" => 10499, "year" => 2015, "make" => "Audi", "model" => "S7", "type" => "Sedan"],
            [
                "id" => 10500,
                "year" => 2012,
                "make" => "Chrysler",
                "model" => "300",
                "type" => "Sedan"
            ],
            ["id" => 10501, "year" => 2018, "make" => "Lexus", "model" => "NX", "type" => "SUV"],
            [
                "id" => 10502,
                "year" => 2012,
                "make" => "MAZDA",
                "model" => "CX-9",
                "type" => "SUV"
            ],
            [
                "id" => 10503,
                "year" => 1994,
                "make" => "Chevrolet",
                "model" => "Corsica",
                "type" => "Sedan"
            ],
            [
                "id" => 10504,
                "year" => 1994,
                "make" => "Lincoln",
                "model" => "Continental",
                "type" => "Sedan"
            ],
            [
                "id" => 10505,
                "year" => 2000,
                "make" => "Ford",
                "model" => "Focus",
                "type" => "Sedan, Hatchback, Wagon"
            ],
            [
                "id" => 10506,
                "year" => 2015,
                "make" => "Ford",
                "model" => "F350 Super Duty Super Cab",
                "type" => "Pickup"
            ],
            [
                "id" => 10507,
                "year" => 1998,
                "make" => "Dodge",
                "model" => "Ram Van 2500",
                "type" => "Van/Minivan"
            ],
            [
                "id" => 10508,
                "year" => 2017,
                "make" => "Chevrolet",
                "model" => "Express 2500 Cargo",
                "type" => "Van/Minivan"
            ],
            [
                "id" => 10509,
                "year" => 2016,
                "make" => "Toyota",
                "model" => "Prius c",
                "type" => "Hatchback"
            ],
            [
                "id" => 10510,
                "year" => 2014,
                "make" => "Hyundai",
                "model" => "Elantra",
                "type" => "Sedan, Coupe, Hatchback"
            ],
            ["id" => 10511, "year" => 2014, "make" => "BMW", "model" => "X6", "type" => "SUV"],
            [
                "id" => 10512,
                "year" => 2006,
                "make" => "Volvo",
                "model" => "V70",
                "type" => "Wagon"
            ],
            ["id" => 10513, "year" => 2009, "make" => "Acura", "model" => "MDX", "type" => "SUV"],
            [
                "id" => 10514,
                "year" => 2018,
                "make" => "Ford",
                "model" => "F250 Super Duty Regular Cab",
                "type" => "Pickup"
            ],
            ["id" => 10515, "year" => 2010, "make" => "Audi", "model" => "Q5", "type" => "SUV"],
            [
                "id" => 10516,
                "year" => 2011,
                "make" => "Dodge",
                "model" => "Journey",
                "type" => "SUV"
            ],
            [
                "id" => 10517,
                "year" => 2015,
                "make" => "Dodge",
                "model" => "Journey",
                "type" => "SUV"
            ],
            [
                "id" => 10518,
                "year" => 1992,
                "make" => "Chevrolet",
                "model" => "1500 Regular Cab",
                "type" => "Pickup"
            ],
            [
                "id" => 10519,
                "year" => 2002,
                "make" => "Toyota",
                "model" => "Tundra Access Cab",
                "type" => "Pickup"
            ],
            [
                "id" => 10520,
                "year" => 2004,
                "make" => "Ford",
                "model" => "E150 Super Duty Cargo",
                "type" => "Van/Minivan"
            ],
            [
                "id" => 10521,
                "year" => 2007,
                "make" => "Subaru",
                "model" => "Legacy",
                "type" => "Sedan, Wagon"
            ],
            [
                "id" => 10522,
                "year" => 2011,
                "make" => "Toyota",
                "model" => "Tacoma Access Cab",
                "type" => "Pickup"
            ],
            [
                "id" => 10523,
                "year" => 2005,
                "make" => "Saab",
                "model" => "9-2X",
                "type" => "Wagon"
            ],
            [
                "id" => 10524,
                "year" => 2017,
                "make" => "Chevrolet",
                "model" => "Volt",
                "type" => "Hatchback"
            ],
            [
                "id" => 10525,
                "year" => 2004,
                "make" => "Pontiac",
                "model" => "Aztek",
                "type" => "SUV"
            ],
            [
                "id" => 10526,
                "year" => 1997,
                "make" => "Chevrolet",
                "model" => "Lumina",
                "type" => "Sedan"
            ],
            [
                "id" => 10527,
                "year" => 2016,
                "make" => "Hyundai",
                "model" => "Sonata Plug-in Hybrid",
                "type" => "Sedan"
            ],
            [
                "id" => 10528,
                "year" => 1998,
                "make" => "MAZDA",
                "model" => "Protege",
                "type" => "Sedan"
            ],
            ["id" => 10529, "year" => 2014, "make" => "Audi", "model" => "S8", "type" => "Sedan"],
            [
                "id" => 10530,
                "year" => 2009,
                "make" => "Dodge",
                "model" => "Durango",
                "type" => "SUV"
            ],
            [
                "id" => 10531,
                "year" => 2017,
                "make" => "Porsche",
                "model" => "911",
                "type" => "Coupe, Convertible"
            ],
            [
                "id" => 10532,
                "year" => 2012,
                "make" => "Nissan",
                "model" => "JUKE",
                "type" => "SUV"
            ],

            [
                "id" => 10534,
                "year" => 1993,
                "make" => "GMC",
                "model" => "3500 Club Coupe",
                "type" => "Pickup"
            ],
            [
                "id" => 10535,
                "year" => 2000,
                "make" => "Isuzu",
                "model" => "Hombre Spacecab",
                "type" => "Pickup"
            ],
            [
                "id" => 10536,
                "year" => 1993,
                "make" => "Mercedes-Benz",
                "model" => "600 SL",
                "type" => "Convertible"
            ],
            [
                "id" => 10537,
                "year" => 1993,
                "make" => "Ford",
                "model" => "Aerostar Passenger",
                "type" => "Van/Minivan"
            ],
            ["id" => 10538, "year" => 2011, "make" => "BMW", "model" => "X5 M", "type" => "SUV"],
            [
                "id" => 10539,
                "year" => 2009,
                "make" => "Volkswagen",
                "model" => "New Beetle",
                "type" => "Convertible, Hatchback"
            ],
            ["id" => 10540, "year" => 2010, "make" => "Audi", "model" => "Q7", "type" => "SUV"],
            [
                "id" => 10541,
                "year" => 2019,
                "make" => "Mercedes-Benz",
                "model" => "GLC",
                "type" => "SUV"
            ],
            [
                "id" => 10542,
                "year" => 2016,
                "make" => "Ford",
                "model" => "C-MAX Energi",
                "type" => "Wagon"
            ],
            [
                "id" => 10543,
                "year" => 2017,
                "make" => "Chevrolet",
                "model" => "Spark",
                "type" => "Hatchback"
            ],
            [
                "id" => 10544,
                "year" => 2008,
                "make" => "Lincoln",
                "model" => "MKZ",
                "type" => "Sedan"
            ],
            [
                "id" => 10545,
                "year" => 2017,
                "make" => "Kia",
                "model" => "Soul EV",
                "type" => "Wagon"
            ],
            [
                "id" => 10546,
                "year" => 2011,
                "make" => "Toyota",
                "model" => "Corolla",
                "type" => "Sedan"
            ],
            [
                "id" => 10547,
                "year" => 2005,
                "make" => "Mercury",
                "model" => "Mariner",
                "type" => "SUV"
            ],
            [
                "id" => 10548,
                "year" => 1998,
                "make" => "Toyota",
                "model" => "Camry",
                "type" => "Sedan"
            ],
            [
                "id" => 10549,
                "year" => 2016,
                "make" => "Kia",
                "model" => "Forte Koup",
                "type" => "Coupe"
            ],
            [
                "id" => 10550,
                "year" => 1997,
                "make" => "Toyota",
                "model" => "Previa",
                "type" => "Van/Minivan"
            ],
            [
                "id" => 10551,
                "year" => 2012,
                "make" => "Land Rover",
                "model" => "LR2",
                "type" => "SUV"
            ],
            [
                "id" => 10552,
                "year" => 2017,
                "make" => "Toyota",
                "model" => "Tacoma Access Cab",
                "type" => "Pickup"
            ],
            [
                "id" => 10553,
                "year" => 2007,
                "make" => "Chrysler",
                "model" => "Sebring",
                "type" => "Sedan"
            ],
            [
                "id" => 10554,
                "year" => 1996,
                "make" => "Jaguar",
                "model" => "XJ",
                "type" => "Sedan, Convertible"
            ],
            [
                "id" => 10555,
                "year" => 2002,
                "make" => "Toyota",
                "model" => "Tacoma Regular Cab",
                "type" => "Pickup"
            ],
            [
                "id" => 10556,
                "year" => 2008,
                "make" => "Ford",
                "model" => "Mustang",
                "type" => "Coupe, Convertible"
            ],
            [
                "id" => 10557,
                "year" => 2010,
                "make" => "Ferrari",
                "model" => "458 Italia",
                "type" => "Coupe"
            ],
            [
                "id" => 10558,
                "year" => 2002,
                "make" => "Nissan",
                "model" => "Altima",
                "type" => "Sedan"
            ],
            [
                "id" => 10559,
                "year" => 2003,
                "make" => "Pontiac",
                "model" => "Grand Prix",
                "type" => "Sedan"
            ],
            [
                "id" => 10560,
                "year" => 2004,
                "make" => "Mitsubishi",
                "model" => "Galant",
                "type" => "Sedan"
            ],
            [
                "id" => 10561,
                "year" => 2017,
                "make" => "Dodge",
                "model" => "Viper",
                "type" => "Coupe"
            ],
            [
                "id" => 10562,
                "year" => 2008,
                "make" => "INFINITI",
                "model" => "FX",
                "type" => "SUV"
            ],
            [
                "id" => 10563,
                "year" => 1998,
                "make" => "INFINITI",
                "model" => "Q",
                "type" => "Sedan"
            ],
            [
                "id" => 10564,
                "year" => 1998,
                "make" => "Ford",
                "model" => "Crown Victoria",
                "type" => "Sedan"
            ],
            [
                "id" => 10565,
                "year" => 1995,
                "make" => "Ford",
                "model" => "F250 Super Cab",
                "type" => "Pickup"
            ],
            [
                "id" => 10566,
                "year" => 2017,
                "make" => "Mercedes-Benz",
                "model" => "Mercedes-AMG GLA",
                "type" => "SUV"
            ],
            [
                "id" => 10567,
                "year" => 2005,
                "make" => "Chevrolet",
                "model" => "SSR",
                "type" => "Pickup"
            ],
            ["id" => 10568, "year" => 2019, "make" => "Acura", "model" => "RDX", "type" => "SUV"],
            [
                "id" => 10569,
                "year" => 2005,
                "make" => "Chevrolet",
                "model" => "Cobalt",
                "type" => "Sedan, Coupe"
            ],
            [
                "id" => 10570,
                "year" => 2019,
                "make" => "Subaru",
                "model" => "BRZ",
                "type" => "Coupe"
            ],
            [
                "id" => 10571,
                "year" => 2011,
                "make" => "Jeep",
                "model" => "Grand Cherokee",
                "type" => "SUV"
            ],
            [
                "id" => 10572,
                "year" => 2019,
                "make" => "GMC",
                "model" => "Sierra 2500 HD Double Cab",
                "type" => "Pickup"
            ],
            [
                "id" => 10573,
                "year" => 2005,
                "make" => "Acura",
                "model" => "TL",
                "type" => "Sedan"
            ],
            [
                "id" => 10574,
                "year" => 2013,
                "make" => "Cadillac",
                "model" => "Escalade",
                "type" => "SUV"
            ],
            [
                "id" => 10575,
                "year" => 1999,
                "make" => "Hyundai",
                "model" => "Elantra",
                "type" => "Sedan, Wagon"
            ],
            [
                "id" => 10576,
                "year" => 2009,
                "make" => "Dodge",
                "model" => "Grand Caravan Passenger",
                "type" => "Van/Minivan"
            ],
            [
                "id" => 10577,
                "year" => 2004,
                "make" => "Nissan",
                "model" => "Sentra",
                "type" => "Sedan"
            ],
            [
                "id" => 10578,
                "year" => 1997,
                "make" => "Mercury",
                "model" => "Mountaineer",
                "type" => "SUV"
            ],
            [
                "id" => 10579,
                "year" => 2005,
                "make" => "Isuzu",
                "model" => "Ascender",
                "type" => "SUV"
            ],
            [
                "id" => 10580,
                "year" => 2000,
                "make" => "GMC",
                "model" => "Sierra (Classic) 2500 Crew Cab",
                "type" => "Pickup"
            ],
            [
                "id" => 10581,
                "year" => 2019,
                "make" => "Ram",
                "model" => "3500 Regular Cab",
                "type" => "Pickup"
            ]
        ];

        foreach ($cars as $car) {
            CarListing::create([
                'manufacturer' => $car['make'],
                'model' => $car['model'],
                'year' => $car['year'],
                'type' => $car['type'],
                'list_id' => $car['id'],
            ]);
        }
    }
}
