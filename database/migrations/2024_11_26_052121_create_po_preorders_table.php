<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class() extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {

        Schema::create('po_preorders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('product_id');
            $table->string('customer_name')->nullable();
            $table->string('customer_phone')->nullable();
            $table->string('customer_email')->nullable();
            $table->integer('quantity')->nullable();
            $table->float('total_amount')->nullable();
            $table->boolean('status')->default(true);
            $table->softDeletes();
            $table->bigInteger('deleted_by_id')->nullable();
            $table->timestamps();
        });

        if (DB::getDriverName() === 'pgsql') {
            DB::statement('CREATE EXTENSION IF NOT EXISTS pg_trgm');

            DB::statement('CREATE INDEX po_preorders_email_idx ON po_preorders USING GIN (email gin_trgm_ops)');

            DB::statement('CREATE INDEX po_preorders_name_idx ON po_preorders (name)');

            DB::statement("
                CREATE INDEX po_preorders_fulltext_idx 
                ON po_preorders USING GIN (to_tsvector('english', coalesce(name, '') || ' ' || coalesce(email, '')))
            ");
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        if (DB::getDriverName() === 'pgsql') {
            DB::statement('DROP INDEX IF EXISTS po_preorders_email_idx');
            DB::statement('DROP INDEX IF EXISTS po_preorders_name_idx');
            DB::statement('DROP INDEX IF EXISTS po_preorders_fulltext_idx');
        }

        Schema::dropIfExists('pre_order_products');
    }
};