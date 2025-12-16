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
    \Illuminate\Support\Facades\DB::statement('ALTER TABLE users MODIFY email VARCHAR(255) NULL;');
    \Illuminate\Support\Facades\DB::statement('ALTER TABLE users DROP INDEX users_email_unique;');
}

public function down()
{
    \Illuminate\Support\Facades\DB::statement('ALTER TABLE users MODIFY email VARCHAR(255) NOT NULL;');
    \Illuminate\Support\Facades\DB::statement('ALTER TABLE users ADD UNIQUE(users_email_unique);');
}

};
