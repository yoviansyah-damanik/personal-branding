<?php

use App\Models\Icon;
use App\Helpers\GeneralHelper;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $type = GeneralHelper::icon_names()->toArray();

        Schema::create('social_media_accounts', function (Blueprint $table) use ($type) {
            $table->id();
            $table->string('name');
            $table->foreignId('social_media_icon_id');
            $table->text('url');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('social_media_accounts');
    }
};
