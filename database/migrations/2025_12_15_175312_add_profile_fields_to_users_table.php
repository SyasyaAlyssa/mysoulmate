<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            if (!Schema::hasColumn('users', 'phone')) {
                $table->string('phone')->nullable();
            }

            if (!Schema::hasColumn('users', 'dob')) {
                $table->date('dob')->nullable();
            }

            if (!Schema::hasColumn('users', 'kulliyyah')) {
                $table->string('kulliyyah')->nullable();
            }

            if (!Schema::hasColumn('users', 'study_level')) {
                $table->string('study_level')->nullable();
            }

            if (!Schema::hasColumn('users', 'nationality')) {
                $table->string('nationality')->nullable();
            }

            if (!Schema::hasColumn('users', 'hobby')) {
                $table->string('hobby')->nullable();
            }

            if (!Schema::hasColumn('users', 'looking_for')) {
                $table->string('looking_for')->nullable();
            }

            if (!Schema::hasColumn('users', 'about_me')) {
                $table->text('about_me')->nullable();
            }
        });
    }

    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn([
                'phone',
                'dob',
                'kulliyyah',
                'study_level',
                'nationality',
                'hobby',
                'looking_for',
                'about_me',
            ]);
        });
    }
};
