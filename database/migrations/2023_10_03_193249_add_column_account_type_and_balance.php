<?php

use App\enums\AccountTypeEnum;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            if (! Schema::hasColumns('users', ['balance','account_type'])) {
                $table->enum('account_type',[AccountTypeEnum::INDIVIDUAL->value,AccountTypeEnum::BUSINESS->value])->after('name');
                $table->double('balance')->after('account_type');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            if (Schema::hasColumns('users', ['account_type','balance'])) {
                $table->dropColumn('account_type');
                $table->dropColumn('balance');
            }
        });
    }
};
