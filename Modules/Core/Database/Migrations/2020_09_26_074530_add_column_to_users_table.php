<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnToUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('name')->nullable()->change();
            $table->foreignId('account_id')->index();
            $table->string('username')->unique();
            $table->string('slug')->unique();
            $table->string('name_title', 10)->nullable();
            $table->string('first_name', 25);
            $table->string('middle_name', 25)->nullable();
            $table->string('last_name', 25);
            $table->string('name_extension', 25)->nullable();
            $table->string('gender')->nullable();
            $table->date('birth_date')->nullable();
            $table->date('mobile_number')->nullable();
            $table->date('phone_number')->nullable();
            $table->boolean('owner')->default(false);
            $table->boolean('is_superuser')->default(false);
            $table->boolean('is_staff')->default(false);
            $table->boolean('is_active')->default(true);
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('account_id');
            $table->dropColumn('username');
            $table->dropColumn('slug');
            $table->dropColumn('name_title');
            $table->dropColumn('first_name');
            $table->dropColumn('middle_name');
            $table->dropColumn('last_name');
            $table->dropColumn('name_extension');
            $table->dropColumn('gender');
            $table->dropColumn('birth_date');
            $table->dropColumn('mobile_number');
            $table->dropColumn('phone_number');
            $table->dropColumn('owner');
            $table->dropColumn('is_superuser');
            $table->dropColumn('is_staff');
            $table->dropColumn('is_active');
        });
    }
}
