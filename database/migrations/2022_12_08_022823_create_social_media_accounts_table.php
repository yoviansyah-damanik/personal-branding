<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('social_media_accounts', function (Blueprint $table) {
            $table->id();
            $table->enum('type', ['facebook', 'twitter', 'linkedin', 'googleplus', 'youtube', 'github', 'discord', 'wordpress', 'stack-overflow', 'tiktok', 'instagram', 'steam', 'pinterest', 'telegram', 'whatsapp', 'line', 'skype', 'twitch', 'yahoo', 'snapchat']);
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
