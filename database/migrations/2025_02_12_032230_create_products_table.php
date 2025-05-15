<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug')->unique();
            $table->text('description')->nullable();
            $table->string('image')->nullable();
            $table->decimal('price', 10, 2);
            $table->integer('stock');
            $table->json('sizes')->nullable()->comment('Available sizes in ml with their prices'); // Store as JSON with size:price pairs
            $table->string('default_size')->nullable()->comment('Default size in ml');

            // Perfume-specific attributes
            $table->string('brand')->nullable();
            $table->string('concentration')->nullable()->comment('EDT, EDP, Parfum, etc.'); // Konsentrasi parfum mengacu pada konsentrasi minyak esensial dalam campuran parfum. Ini mempengaruhi kekuatan dan daya tahan aroma parfum. Misalnya, Eau de Toilette (EDT) memiliki konsentrasi minyak esensial yang lebih rendah dibandingkan dengan Eau de Parfum (EDP), sehingga EDT biasanya lebih ringan dan kurang tahan lama daripada EDP.
            $table->json('scent_notes')->nullable()->comment('Top, middle, base notes'); // Scent Note adalah kombinasi dari aroma yang membentuk karakteristik parfum
            $table->string('gender')->nullable()->comment('Male, Female, Unisex');
            $table->string('fragrance_family')->nullable()->comment('Floral, Oriental, Woody, etc.'); // Keluarga aroma adalah kategori yang lebih besar yang mencakup beberapa aroma yang memiliki kesamaan tertentu. Misalnya, keluarga floral mencakup aroma bunga seperti mawar, melati, dan lily, sementara keluarga oriental mencakup aroma rempah-rempah dan resin seperti vanila, kayu manis, dan amber.

            // Marketing information
            $table->boolean('is_featured')->default(false); // Featured products berisi produk-produk yang sedang promo
            $table->boolean('is_new')->default(false); // Produk baru
            $table->boolean('is_bestseller')->default(false); // Produk terlaris

            // Base attributes
            $table->boolean('is_active')->default(true);
            $table->foreignId('category_id')->constrained()->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
